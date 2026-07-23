<?php
/**
 * Migra dados PostgreSQL → MySQL (mysql_novo).
 * Não altera DB_CONNECTION default do app.
 *
 * Uso: php database/mysql_novo/migrate_data.php
 */

$root = dirname(__DIR__, 2);
$cfg = [];
foreach (file($root . '/.env') as $line) {
    $line = trim($line);
    if ($line === '' || $line[0] === '#') {
        continue;
    }
    if (preg_match('/^(DB_[A-Z_]+)=(.*)$/', $line, $m)) {
        $cfg[$m[1]] = trim($m[2], "\"'");
    }
}

$batchSize = 5000;
$log = function ($msg) {
    echo '[' . date('H:i:s') . "] {$msg}\n";
};

$pg = new PDO(
    sprintf('pgsql:host=%s;port=%s;dbname=%s', $cfg['DB_HOST'], $cfg['DB_PORT'] ?? '5432', $cfg['DB_DATABASE']),
    $cfg['DB_USERNAME'],
    $cfg['DB_PASSWORD'],
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
);

$my = new PDO(
    sprintf(
        'mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4',
        $cfg['DB_HOST_NOVO'],
        $cfg['DB_PORT_NOVO'] ?? '3306',
        $cfg['DB_DATABASE_NOVO']
    ),
    $cfg['DB_USERNAME_NOVO'],
    $cfg['DB_PASSWORD_NOVO'],
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]
);

function convertValue($value, $mysqlType)
{
    if ($value === null) {
        return null;
    }

    $type = strtolower((string) $mysqlType);

    if (strpos($type, 'tinyint(1)') !== false) {
        if (is_bool($value)) {
            return $value ? 1 : 0;
        }
        if ($value === 't' || $value === 'true' || $value === '1' || $value === 1) {
            return 1;
        }
        if ($value === 'f' || $value === 'false' || $value === '0' || $value === 0 || $value === '') {
            return 0;
        }
        return (int) ((bool) $value);
    }

    if (is_bool($value)) {
        return $value ? 1 : 0;
    }

    // PostgreSQL resource/stream for bytea
    if (is_resource($value)) {
        return stream_get_contents($value);
    }

    return $value;
}

function mysqlColumns(PDO $my, $table)
{
    $cols = [];
    $stmt = $my->query("SHOW COLUMNS FROM `{$table}`");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $cols[] = [
            'Field' => $row['Field'],
            'Type' => $row['Type'],
            'Key' => $row['Key'],
            'Extra' => $row['Extra'],
        ];
    }
    return $cols;
}

function primaryKey(array $cols)
{
    $pk = [];
    foreach ($cols as $c) {
        if ($c['Key'] === 'PRI') {
            $pk[] = $c['Field'];
        }
    }
    return $pk;
}

$tables = $pg->query("SELECT tablename FROM pg_tables WHERE schemaname='public' ORDER BY tablename")
    ->fetchAll(PDO::FETCH_COLUMN);

$my->exec('SET FOREIGN_KEY_CHECKS=0');
$my->exec('SET UNIQUE_CHECKS=0');
$my->exec('SET NAMES utf8mb4');

$summary = [];
$errors = [];

foreach ($tables as $table) {
    $started = microtime(true);
    $colsMeta = mysqlColumns($my, $table);
    if (!$colsMeta) {
        $errors[] = "{$table}: sem colunas no MySQL";
        continue;
    }

    $colNames = array_column($colsMeta, 'Field');
    $typeByCol = [];
    foreach ($colsMeta as $c) {
        $typeByCol[$c['Field']] = $c['Type'];
    }

    $my->exec("TRUNCATE TABLE `{$table}`");

    $quotedPgCols = implode(', ', array_map(function ($c) {
        return '"' . $c . '"';
    }, $colNames));

    $pgCount = (int) $pg->query('SELECT COUNT(*) FROM "' . $table . '"')->fetchColumn();
    if ($pgCount === 0) {
        $summary[$table] = ['pg' => 0, 'mysql' => 0, 'sec' => round(microtime(true) - $started, 2)];
        $log("{$table}: 0 rows");
        continue;
    }

    $placeholders = '(' . implode(',', array_fill(0, count($colNames), '?')) . ')';
    $insertSql = 'INSERT INTO `' . $table . '` (`' . implode('`,`', $colNames) . '`) VALUES ';

    $pk = primaryKey($colsMeta);
    $copied = 0;

    // Cursor-like pagination: single PK numeric preferred; else OFFSET
    $useKeyset = count($pk) === 1;
    $lastPk = null;

    while (true) {
        if ($useKeyset) {
            $pkCol = $pk[0];
            if ($lastPk === null) {
                $sql = 'SELECT ' . $quotedPgCols . ' FROM "' . $table . '" ORDER BY "' . $pkCol . '" ASC LIMIT ' . (int) $batchSize;
                $rows = $pg->query($sql)->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $stmt = $pg->prepare(
                    'SELECT ' . $quotedPgCols . ' FROM "' . $table . '" WHERE "' . $pkCol . '" > ? ORDER BY "' . $pkCol . '" ASC LIMIT ' . (int) $batchSize
                );
                $stmt->execute([$lastPk]);
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        } else {
            $sql = 'SELECT ' . $quotedPgCols . ' FROM "' . $table . '" ORDER BY 1 LIMIT ' . (int) $batchSize . ' OFFSET ' . (int) $copied;
            $rows = $pg->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        }

        if (!$rows) {
            break;
        }

        $valuesSql = [];
        $bind = [];
        foreach ($rows as $row) {
            $valuesSql[] = $placeholders;
            foreach ($colNames as $col) {
                $bind[] = convertValue(array_key_exists($col, $row) ? $row[$col] : null, $typeByCol[$col]);
            }
            if ($useKeyset) {
                $lastPk = $row[$pk[0]];
            }
        }

        $stmt = $my->prepare($insertSql . implode(',', $valuesSql));
        try {
            $stmt->execute($bind);
        } catch (Throwable $e) {
            // fallback row-by-row to isolate bad rows
            $single = $my->prepare(
                'INSERT INTO `' . $table . '` (`' . implode('`,`', $colNames) . '`) VALUES ' . $placeholders
            );
            foreach ($rows as $row) {
                $params = [];
                foreach ($colNames as $col) {
                    $params[] = convertValue(array_key_exists($col, $row) ? $row[$col] : null, $typeByCol[$col]);
                }
                try {
                    $single->execute($params);
                    $copied++;
                } catch (Throwable $e2) {
                    $errors[] = "{$table}: " . $e2->getMessage();
                    $log("ERR {$table}: " . $e2->getMessage());
                }
            }
            if (count($rows) < $batchSize) {
                break;
            }
            continue;
        }

        $copied += count($rows);

        if ($copied % 10000 === 0 || $copied === $pgCount) {
            $log("{$table}: {$copied}/{$pgCount}");
        }

        if (count($rows) < $batchSize) {
            break;
        }
    }

    // Reset AUTO_INCREMENT
    foreach ($colsMeta as $c) {
        if (stripos($c['Extra'], 'auto_increment') !== false) {
            $max = (int) $my->query('SELECT COALESCE(MAX(`' . $c['Field'] . '`), 0) FROM `' . $table . '`')->fetchColumn();
            $my->exec('ALTER TABLE `' . $table . '` AUTO_INCREMENT=' . ($max + 1));
        }
    }

    $myCount = (int) $my->query('SELECT COUNT(*) FROM `' . $table . '`')->fetchColumn();
    $summary[$table] = [
        'pg' => $pgCount,
        'mysql' => $myCount,
        'sec' => round(microtime(true) - $started, 2),
        'ok' => $pgCount === $myCount,
    ];
    $status = $pgCount === $myCount ? 'OK' : 'MISMATCH';
    $log("{$table}: pg={$pgCount} mysql={$myCount} {$status} (" . $summary[$table]['sec'] . 's)');
}

$my->exec('SET UNIQUE_CHECKS=1');
$my->exec('SET FOREIGN_KEY_CHECKS=1');

$mismatches = array_filter($summary, function ($s) {
    return empty($s['ok']) && (($s['pg'] ?? 0) > 0 || ($s['mysql'] ?? 0) > 0);
});

$log('---- RESUMO ----');
$log('Tabelas: ' . count($summary));
$log('Mismatches: ' . count($mismatches));
$log('Erros: ' . count($errors));

$report = [
    'generated_at' => date('c'),
    'summary' => $summary,
    'errors' => $errors,
];
file_put_contents(__DIR__ . '/migrate_data_report.json', json_encode($report, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
$log('Relatório: database/mysql_novo/migrate_data_report.json');

if ($mismatches || $errors) {
    exit(1);
}

exit(0);

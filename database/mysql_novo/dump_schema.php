<?php
/**
 * Regenera database/mysql_novo/schema.sql a partir do MySQL (mysql_novo).
 *
 * Uso:
 *   php database/mysql_novo/dump_schema.php
 *
 * Não altera a conexão default do app (Postgres).
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

$my = new PDO(
    sprintf(
        'mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4',
        $cfg['DB_HOST_NOVO'],
        $cfg['DB_PORT_NOVO'] ?? '3306',
        $cfg['DB_DATABASE_NOVO']
    ),
    $cfg['DB_USERNAME_NOVO'],
    $cfg['DB_PASSWORD_NOVO'],
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
);

$tables = $my->query('SHOW TABLES')->fetchAll(PDO::FETCH_COLUMN);
$out = [
    '-- Schema MySQL (mysql_novo) espelhado do PostgreSQL',
    '-- Gerado em: ' . date('c'),
    'SET NAMES utf8mb4;',
    'SET FOREIGN_KEY_CHECKS=0;',
    '',
];

foreach ($tables as $t) {
    $row = $my->query('SHOW CREATE TABLE `' . $t . '`')->fetch(PDO::FETCH_ASSOC);
    $create = array_values($row)[1];
    $out[] = "DROP TABLE IF EXISTS `{$t}`;";
    $out[] = $create . ';';
    $out[] = '';
}

$out[] = 'SET FOREIGN_KEY_CHECKS=1;';

$target = __DIR__ . '/schema.sql';
file_put_contents($target, implode("\n", $out) . "\n");

$fk = (int) $my->query(
    "SELECT COUNT(*) FROM information_schema.TABLE_CONSTRAINTS
     WHERE CONSTRAINT_SCHEMA = DATABASE() AND CONSTRAINT_TYPE = 'FOREIGN KEY'"
)->fetchColumn();

echo "Wrote {$target}\n";
echo 'Tables: ' . count($tables) . " | Foreign keys: {$fk}\n";

<?php

namespace App\Services\Clima;

class SeasonalityCalculator
{
    /**
     * Calcula indicadores mensais a partir de registros históricos normalizados.
     *
     * @param array $mensalLista cada item: mes, precipitacao_media, dias_com_chuva, temperatura_media, vento_medio
     * @return array
     */
    public function calculate(array $mensalLista)
    {
        $cfg = config('clima.sazonalidade');
        $pesos = $cfg['pesos'];
        $metodologia = config('clima.metodologia_sazonalidade', 'v1');
        $resultados = [];

        foreach ($mensalLista as $mesData) {
            $scores = [];
            $fatores = [];

            $precip = isset($mesData['precipitacao_media']) ? $mesData['precipitacao_media'] : null;
            $diasChuva = isset($mesData['dias_com_chuva']) ? $mesData['dias_com_chuva'] : null;
            $temp = isset($mesData['temperatura_media']) ? $mesData['temperatura_media'] : null;
            $vento = isset($mesData['vento_medio']) ? $mesData['vento_medio'] : null;

            $scores['precipitacao'] = $this->scoreLinearInverse(
                $precip,
                $cfg['precip_ideal_mm'],
                $cfg['precip_max_mm']
            );
            if ($scores['precipitacao'] !== null && $scores['precipitacao'] < 55 && $precip !== null) {
                $fatores[] = sprintf('precipitação média de %.0f mm', $precip);
            }

            $scores['dias_chuva'] = $this->scoreLinearInverse(
                $diasChuva,
                $cfg['dias_chuva_ideal'],
                $cfg['dias_chuva_max']
            );
            if ($scores['dias_chuva'] !== null && $scores['dias_chuva'] < 55 && $diasChuva !== null) {
                $fatores[] = sprintf('cerca de %.0f dias com chuva', $diasChuva);
            }

            $scores['temperatura'] = $this->scoreTemperature(
                $temp,
                $cfg['temp_ideal_c'],
                $cfg['temp_tolerancia_c']
            );
            if ($scores['temperatura'] !== null && $scores['temperatura'] < 55 && $temp !== null) {
                $fatores[] = sprintf('temperatura média de %.0f °C', $temp);
            }

            $scores['vento'] = $this->scoreLinearInverse(
                $vento,
                $cfg['vento_ideal_kmh'],
                $cfg['vento_max_kmh']
            );
            if ($scores['vento'] !== null && $scores['vento'] < 55 && $vento !== null) {
                $fatores[] = sprintf('vento médio de %.0f km/h', $vento);
            }

            $indice = $this->weightedAverage($scores, $pesos);
            $classificacao = $this->classify($indice, $cfg['limiares']);
            $justificativa = $this->buildJustificativa($classificacao, $fatores, $indice);

            $resultados[] = [
                'mes' => (int) $mesData['mes'],
                'indice' => $indice,
                'classificacao' => $classificacao,
                'justificativa' => $justificativa,
                'metodologia' => $metodologia,
            ];
        }

        return $resultados;
    }

    /**
     * @param float|null $value
     * @param float $ideal
     * @param float $max
     * @return float|null
     */
    private function scoreLinearInverse($value, $ideal, $max)
    {
        if ($value === null) {
            return null;
        }

        if ($value <= $ideal) {
            return 100.0;
        }

        if ($value >= $max) {
            return 0.0;
        }

        $ratio = ($value - $ideal) / max(0.0001, ($max - $ideal));

        return round(100 * (1 - $ratio), 2);
    }

    /**
     * @param float|null $temp
     * @param float $ideal
     * @param float $tolerancia
     * @return float|null
     */
    private function scoreTemperature($temp, $ideal, $tolerancia)
    {
        if ($temp === null) {
            return null;
        }

        $desvio = abs($temp - $ideal);
        if ($desvio <= 2) {
            return 100.0;
        }

        if ($desvio >= $tolerancia) {
            return 0.0;
        }

        $ratio = ($desvio - 2) / max(0.0001, ($tolerancia - 2));

        return round(100 * (1 - $ratio), 2);
    }

    /**
     * @param array $scores
     * @param array $pesos
     * @return float
     */
    private function weightedAverage(array $scores, array $pesos)
    {
        $soma = 0.0;
        $pesoTotal = 0.0;

        foreach ($pesos as $chave => $peso) {
            if (!isset($scores[$chave]) || $scores[$chave] === null) {
                continue;
            }
            $soma += $scores[$chave] * $peso;
            $pesoTotal += $peso;
        }

        if ($pesoTotal <= 0) {
            return 0.0;
        }

        return round($soma / $pesoTotal, 2);
    }

    /**
     * @param float $indice
     * @param array $limiares
     * @return string
     */
    private function classify($indice, array $limiares)
    {
        if ($indice >= $limiares['excelente']) {
            return 'excelente';
        }
        if ($indice >= $limiares['boa']) {
            return 'boa';
        }
        if ($indice >= $limiares['moderada']) {
            return 'moderada';
        }

        return 'desfavoravel';
    }

    /**
     * @param string $classificacao
     * @param array $fatores
     * @param float $indice
     * @return string
     */
    private function buildJustificativa($classificacao, array $fatores, $indice)
    {
        $labels = [
            'excelente' => 'Condições historicamente favoráveis para atividades ao ar livre',
            'boa' => 'Condições geralmente favoráveis, com atenção pontual ao clima',
            'moderada' => 'Condições que exigem maior planejamento',
            'desfavoravel' => 'Maior frequência histórica de condições meteorológicas adversas',
        ];

        $base = isset($labels[$classificacao]) ? $labels[$classificacao] : 'Classificação climática histórica';
        $base .= sprintf(' (índice %.0f/100).', $indice);

        if (!empty($fatores)) {
            $fatores = array_slice(array_unique($fatores), 0, 2);
            $base .= ' Fatores relevantes: ' . implode('; ', $fatores) . '.';
        }

        $base .= ' Baseado em médias históricas, não é garantia de condições no dia da visita.';

        return $base;
    }
}

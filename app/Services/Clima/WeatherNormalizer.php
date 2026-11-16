<?php

namespace App\Services\Clima;

use Carbon\Carbon;

class WeatherNormalizer
{
    /**
     * Mapa WMO weather interpretation codes → rótulo e ícone Font Awesome.
     *
     * @var array
     */
    private static $wmoMap = [
        0 => ['label' => 'Céu limpo', 'icon' => 'fa-sun-o'],
        1 => ['label' => 'Principalmente limpo', 'icon' => 'fa-sun-o'],
        2 => ['label' => 'Parcialmente nublado', 'icon' => 'fa-cloud'],
        3 => ['label' => 'Nublado', 'icon' => 'fa-cloud'],
        45 => ['label' => 'Nevoeiro', 'icon' => 'fa-cloud'],
        48 => ['label' => 'Nevoeiro com geada', 'icon' => 'fa-cloud'],
        51 => ['label' => 'Garoa leve', 'icon' => 'fa-tint'],
        53 => ['label' => 'Garoa moderada', 'icon' => 'fa-tint'],
        55 => ['label' => 'Garoa intensa', 'icon' => 'fa-tint'],
        56 => ['label' => 'Garoa congelante leve', 'icon' => 'fa-tint'],
        57 => ['label' => 'Garoa congelante intensa', 'icon' => 'fa-tint'],
        61 => ['label' => 'Chuva fraca', 'icon' => 'fa-umbrella'],
        63 => ['label' => 'Chuva moderada', 'icon' => 'fa-umbrella'],
        65 => ['label' => 'Chuva forte', 'icon' => 'fa-umbrella'],
        66 => ['label' => 'Chuva congelante leve', 'icon' => 'fa-umbrella'],
        67 => ['label' => 'Chuva congelante forte', 'icon' => 'fa-umbrella'],
        71 => ['label' => 'Neve fraca', 'icon' => 'fa-snowflake-o'],
        73 => ['label' => 'Neve moderada', 'icon' => 'fa-snowflake-o'],
        75 => ['label' => 'Neve forte', 'icon' => 'fa-snowflake-o'],
        77 => ['label' => 'Grãos de neve', 'icon' => 'fa-snowflake-o'],
        80 => ['label' => 'Pancadas fracas', 'icon' => 'fa-umbrella'],
        81 => ['label' => 'Pancadas moderadas', 'icon' => 'fa-umbrella'],
        82 => ['label' => 'Pancadas fortes', 'icon' => 'fa-umbrella'],
        85 => ['label' => 'Pancadas de neve fracas', 'icon' => 'fa-snowflake-o'],
        86 => ['label' => 'Pancadas de neve fortes', 'icon' => 'fa-snowflake-o'],
        95 => ['label' => 'Trovoada', 'icon' => 'fa-bolt'],
        96 => ['label' => 'Trovoada com granizo leve', 'icon' => 'fa-bolt'],
        99 => ['label' => 'Trovoada com granizo forte', 'icon' => 'fa-bolt'],
    ];

    /**
     * @param int|null $code
     * @return array{label:string,icon:string}
     */
    public static function interpretWeatherCode($code)
    {
        $code = (int) $code;

        if (isset(self::$wmoMap[$code])) {
            return self::$wmoMap[$code];
        }

        return ['label' => 'Condição indefinida', 'icon' => 'fa-question-circle'];
    }

    /**
     * Normaliza resposta de forecast Open-Meteo.
     *
     * @param array $payload
     * @return array{elevation:?float,current:array,daily:array}
     */
    public function normalizeForecast(array $payload)
    {
        $daily = [];
        $dates = isset($payload['daily']['time']) ? $payload['daily']['time'] : [];

        foreach ($dates as $i => $date) {
            $code = $this->idx($payload, 'daily.weather_code', $i);
            $meta = self::interpretWeatherCode($code);

            $sunrise = $this->idx($payload, 'daily.sunrise', $i);
            $sunset = $this->idx($payload, 'daily.sunset', $i);

            $daily[] = [
                'data' => $date,
                'temperatura_minima' => $this->num($this->idx($payload, 'daily.temperature_2m_min', $i)),
                'temperatura_maxima' => $this->num($this->idx($payload, 'daily.temperature_2m_max', $i)),
                'precipitacao_probabilidade' => $this->num($this->idx($payload, 'daily.precipitation_probability_max', $i)),
                'precipitacao_volume' => $this->num($this->idx($payload, 'daily.precipitation_sum', $i)),
                'velocidade_vento' => $this->num($this->idx($payload, 'daily.wind_speed_10m_max', $i)),
                'rajada_vento' => $this->num($this->idx($payload, 'daily.wind_gusts_10m_max', $i)),
                'indice_uv' => $this->num($this->idx($payload, 'daily.uv_index_max', $i)),
                'nascer_sol' => $this->hora($sunrise),
                'por_sol' => $this->hora($sunset),
                'codigo_condicao' => $code !== null ? (int) $code : null,
                'condicao_label' => $meta['label'],
                'condicao_icon' => $meta['icon'],
            ];
        }

        $currentCode = isset($payload['current']['weather_code'])
            ? $payload['current']['weather_code']
            : null;
        $currentMeta = self::interpretWeatherCode($currentCode);

        $current = [
            'temperatura' => $this->num(isset($payload['current']['temperature_2m']) ? $payload['current']['temperature_2m'] : null),
            'umidade' => $this->num(isset($payload['current']['relative_humidity_2m']) ? $payload['current']['relative_humidity_2m'] : null),
            'nebulosidade' => $this->num(isset($payload['current']['cloud_cover']) ? $payload['current']['cloud_cover'] : null),
            'velocidade_vento' => $this->num(isset($payload['current']['wind_speed_10m']) ? $payload['current']['wind_speed_10m'] : null),
            'rajada_vento' => $this->num(isset($payload['current']['wind_gusts_10m']) ? $payload['current']['wind_gusts_10m'] : null),
            'codigo_condicao' => $currentCode !== null ? (int) $currentCode : null,
            'condicao_label' => $currentMeta['label'],
            'condicao_icon' => $currentMeta['icon'],
            'observado_em' => isset($payload['current']['time']) ? $payload['current']['time'] : null,
        ];

        // Injeta temperatura/umidade/nebulosidade atuais no dia de hoje quando possível
        if (!empty($daily) && !empty($current['temperatura'])) {
            $hoje = Carbon::now(config('clima.timezone'))->toDateString();
            foreach ($daily as &$dia) {
                if ($dia['data'] === $hoje) {
                    $dia['temperatura_atual'] = $current['temperatura'];
                    $dia['umidade'] = $current['umidade'];
                    $dia['nebulosidade'] = $current['nebulosidade'];
                    if ($dia['codigo_condicao'] === null && $current['codigo_condicao'] !== null) {
                        $dia['codigo_condicao'] = $current['codigo_condicao'];
                        $dia['condicao_label'] = $current['condicao_label'];
                        $dia['condicao_icon'] = $current['condicao_icon'];
                    }
                }
            }
            unset($dia);
        }

        return [
            'elevation' => isset($payload['elevation']) ? $this->num($payload['elevation']) : null,
            'current' => $current,
            'daily' => $daily,
            'fonte' => config('clima.fonte', 'open-meteo'),
        ];
    }

    /**
     * Agrega séries diárias do archive em médias mensais (1–12).
     *
     * @param array $payload
     * @param int $anoInicio
     * @param int $anoFim
     * @return array
     */
    public function normalizeArchiveMonthly(array $payload, $anoInicio, $anoFim)
    {
        $buckets = [];
        for ($m = 1; $m <= 12; $m++) {
            $buckets[$m] = [
                'temp' => [],
                'temp_min' => [],
                'temp_max' => [],
                'precip' => [],
                'dias_chuva' => 0,
                'dias_total' => 0,
                'umidade' => [],
                'vento' => [],
            ];
        }

        $dates = isset($payload['daily']['time']) ? $payload['daily']['time'] : [];

        foreach ($dates as $i => $date) {
            $mes = (int) Carbon::parse($date)->month;
            $buckets[$mes]['dias_total']++;

            $temp = $this->num($this->idx($payload, 'daily.temperature_2m_mean', $i));
            $tmin = $this->num($this->idx($payload, 'daily.temperature_2m_min', $i));
            $tmax = $this->num($this->idx($payload, 'daily.temperature_2m_max', $i));
            $precip = $this->num($this->idx($payload, 'daily.precipitation_sum', $i));
            $umidade = $this->num($this->idx($payload, 'daily.relative_humidity_2m_mean', $i));
            $vento = $this->num($this->idx($payload, 'daily.wind_speed_10m_mean', $i));

            if ($temp !== null) {
                $buckets[$mes]['temp'][] = $temp;
            }
            if ($tmin !== null) {
                $buckets[$mes]['temp_min'][] = $tmin;
            }
            if ($tmax !== null) {
                $buckets[$mes]['temp_max'][] = $tmax;
            }
            if ($precip !== null) {
                $buckets[$mes]['precip'][] = $precip;
                if ($precip > 0.1) {
                    $buckets[$mes]['dias_chuva']++;
                }
            }
            if ($umidade !== null) {
                $buckets[$mes]['umidade'][] = $umidade;
            }
            if ($vento !== null) {
                $buckets[$mes]['vento'][] = $vento;
            }
        }

        $resultado = [];
        foreach ($buckets as $mes => $b) {
            $diasComChuvaMedio = $b['dias_total'] > 0
                ? round(($b['dias_chuva'] / $b['dias_total']) * 30.4, 1)
                : null;

            // Precipitação média mensal = soma diária média * ~dias do mês
            $precipMediaDiaria = $this->avg($b['precip']);
            $precipMediaMensal = $precipMediaDiaria !== null
                ? round($precipMediaDiaria * 30.4, 1)
                : null;

            $resultado[] = [
                'mes' => (int) $mes,
                'ano_inicio' => (int) $anoInicio,
                'ano_fim' => (int) $anoFim,
                'temperatura_media' => $this->avg($b['temp']),
                'temperatura_minima_media' => $this->avg($b['temp_min']),
                'temperatura_maxima_media' => $this->avg($b['temp_max']),
                'precipitacao_media' => $precipMediaMensal,
                'dias_com_chuva' => $diasComChuvaMedio,
                'umidade_media' => $this->avg($b['umidade']),
                'vento_medio' => $this->avg($b['vento']),
                'fonte' => config('clima.fonte', 'open-meteo'),
            ];
        }

        return [
            'elevation' => isset($payload['elevation']) ? $this->num($payload['elevation']) : null,
            'mensal' => $resultado,
        ];
    }

    /**
     * @param array $data
     * @param string $path dot notation with numeric leaf index handled separately
     * @param int $index
     * @return mixed|null
     */
    private function idx(array $data, $path, $index)
    {
        $parts = explode('.', $path);
        $cursor = $data;
        foreach ($parts as $part) {
            if (!is_array($cursor) || !array_key_exists($part, $cursor)) {
                return null;
            }
            $cursor = $cursor[$part];
        }

        if (!is_array($cursor) || !array_key_exists($index, $cursor)) {
            return null;
        }

        return $cursor[$index];
    }

    /**
     * @param mixed $value
     * @return float|null
     */
    private function num($value)
    {
        if ($value === null || $value === '') {
            return null;
        }

        return round((float) $value, 2);
    }

    /**
     * @param array $values
     * @return float|null
     */
    private function avg(array $values)
    {
        if (empty($values)) {
            return null;
        }

        return round(array_sum($values) / count($values), 2);
    }

    /**
     * @param string|null $iso
     * @return string|null H:i
     */
    private function hora($iso)
    {
        if (empty($iso)) {
            return null;
        }

        try {
            return Carbon::parse($iso)->format('H:i');
        } catch (\Exception $e) {
            return null;
        }
    }
}

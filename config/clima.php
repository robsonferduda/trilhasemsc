<?php

return [

    'fonte' => 'open-meteo',
    'fonte_nome' => 'Open-Meteo',
    'fonte_url' => 'https://open-meteo.com/',
    'timezone' => env('CLIMA_TIMEZONE', 'America/Sao_Paulo'),
    'grid_decimals' => (int) env('CLIMA_GRID_DECIMALS', 3),
    'request_delay_ms' => (int) env('CLIMA_REQUEST_DELAY_MS', 200),
    'historico_anos' => (int) env('CLIMA_HISTORICO_ANOS', 10),
    'metodologia_sazonalidade' => 'v1',

    'open_meteo' => [
        'forecast_url' => env('OPEN_METEO_FORECAST_URL', 'https://api.open-meteo.com/v1/forecast'),
        'archive_url' => env('OPEN_METEO_ARCHIVE_URL', 'https://archive-api.open-meteo.com/v1/archive'),
        'timeout' => (int) env('OPEN_METEO_TIMEOUT', 30),
    ],

    'sazonalidade' => [
        'pesos' => [
            'precipitacao' => 0.35,
            'dias_chuva' => 0.25,
            'temperatura' => 0.25,
            'vento' => 0.15,
        ],
        // Referências para caminhada em SC (valores típicos mensais)
        'precip_ideal_mm' => 80,
        'precip_max_mm' => 300,
        'dias_chuva_ideal' => 8,
        'dias_chuva_max' => 22,
        'temp_ideal_c' => 18,
        'temp_tolerancia_c' => 10,
        'vento_ideal_kmh' => 10,
        'vento_max_kmh' => 35,
        'limiares' => [
            'excelente' => 75,
            'boa' => 55,
            'moderada' => 35,
        ],
    ],

    'recomendacoes' => [
        'precip_prob_alerta' => 50,
        'precip_mm_alerta' => 5,
        'vento_alerta_kmh' => 30,
        'rajada_alerta_kmh' => 45,
        'uv_alerta' => 7,
        'temp_baixa_c' => 10,
        'temp_alta_c' => 30,
    ],

];

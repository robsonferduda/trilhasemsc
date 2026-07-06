<?php

return [
    'peru_2026' => [
        'expedicao_id' => env('PERU_2026_EXPEDICAO_ID'),
        // 1 sol peruano = X reais (ex.: 1,52 → R$ 1,52 por S/)
        'cambio_soles_brl' => env('PERU_2026_CAMBIO_SOLES_BRL', 1.52),
    ],
];

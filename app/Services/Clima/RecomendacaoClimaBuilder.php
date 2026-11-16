<?php

namespace App\Services\Clima;

use Illuminate\Support\Collection;

class RecomendacaoClimaBuilder
{
    /**
     * Gera recomendações objetivas a partir da previsão local (coleção ClimaPrevisao).
     *
     * @param Collection|\App\ClimaPrevisao[] $previsoes
     * @return array
     */
    public function build($previsoes)
    {
        $cfg = config('clima.recomendacoes');
        $recs = [];

        if ($previsoes === null || count($previsoes) === 0) {
            return $recs;
        }

        $hoje = $previsoes->first();
        $maxPrecipProb = $previsoes->max('nu_precip_prob_clp');
        $maxPrecipMm = $previsoes->max('nu_precip_mm_clp');
        $maxVento = $previsoes->max('nu_vento_kmh_clp');
        $maxRajada = $previsoes->max('nu_rajada_kmh_clp');
        $maxUv = $previsoes->max('nu_indice_uv_clp');
        $minTemp = $previsoes->min('nu_temp_min_clp');
        $maxTemp = $previsoes->max('nu_temp_max_clp');

        if ($maxPrecipProb !== null && $maxPrecipProb >= $cfg['precip_prob_alerta']) {
            $recs[] = 'Atenção à possibilidade de chuva durante o percurso. Leve capa ou poncho impermeável.';
        } elseif ($maxPrecipMm !== null && $maxPrecipMm >= $cfg['precip_mm_alerta']) {
            $recs[] = 'Há volume de chuva previsto nos próximos dias. Avalie trechos escorregadios e rios.';
        }

        if (($maxVento !== null && $maxVento >= $cfg['vento_alerta_kmh'])
            || ($maxRajada !== null && $maxRajada >= $cfg['rajada_alerta_kmh'])) {
            $recs[] = 'Verifique a previsão de vento antes de realizar trilhas em áreas expostas ou de crista.';
        }

        if ($maxUv !== null && $maxUv >= $cfg['uv_alerta']) {
            $recs[] = 'Considere proteção solar: índice UV elevado previsto para o período.';
        }

        if ($minTemp !== null && $minTemp <= $cfg['temp_baixa_c']) {
            $recs[] = 'Temperaturas baixas previstas: leve vestimentas adequadas em camadas.';
        }

        if ($maxTemp !== null && $maxTemp >= $cfg['temp_alta_c']) {
            $recs[] = 'Temperaturas elevadas previstas: hidrate-se com frequência e evite o pico de calor.';
        }

        if ($hoje && $hoje->hr_nascer_sol_clp && $hoje->hr_por_sol_clp) {
            $recs[] = sprintf(
                'Nascer do sol às %s e pôr do sol às %s (horário local). Planeje a duração da trilha com margem de luz natural.',
                $hoje->hr_nascer_sol_clp,
                $hoje->hr_por_sol_clp
            );
        }

        $recs[] = 'Consulte novamente a previsão antes de iniciar a atividade. Condições meteorológicas estão sujeitas a alterações.';

        return array_values(array_unique($recs));
    }
}

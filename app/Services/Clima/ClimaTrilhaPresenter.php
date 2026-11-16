<?php

namespace App\Services\Clima;

use App\ClimaHistorico;
use App\ClimaIndicador;
use App\ClimaPrevisao;
use App\LocalizacaoClima;
use App\Trilha;
use Carbon\Carbon;

class ClimaTrilhaPresenter
{
    /** @var RecomendacaoClimaBuilder */
    private $recomendacoes;

    public function __construct(RecomendacaoClimaBuilder $recomendacoes = null)
    {
        $this->recomendacoes = $recomendacoes ?: new RecomendacaoClimaBuilder();
    }

    /**
     * Monta payload de leitura local para a página da trilha (sem chamar API).
     *
     * @param Trilha $trilha
     * @return array|null
     */
    public function forTrilha(Trilha $trilha)
    {
        if (!$trilha->temCoordenadasClima()) {
            return null;
        }

        $decimals = (int) config('clima.grid_decimals', 3);
        $gridLat = round((float) $trilha->nu_latitude_tri, $decimals);
        $gridLng = round((float) $trilha->nu_longitude_tri, $decimals);

        $localizacao = LocalizacaoClima::where('nu_latitude_loc', $gridLat)
            ->where('nu_longitude_loc', $gridLng)
            ->first();

        if (!$localizacao) {
            return null;
        }

        $hoje = Carbon::now(config('clima.timezone'))->toDateString();

        $previsoes = ClimaPrevisao::where('id_localizacao_clima_loc', $localizacao->id_localizacao_clima_loc)
            ->where('dt_previsao_clp', '>=', $hoje)
            ->orderBy('dt_previsao_clp')
            ->limit(7)
            ->get();

        $historicos = ClimaHistorico::where('id_localizacao_clima_loc', $localizacao->id_localizacao_clima_loc)
            ->orderByDesc('nu_ano_fim_clh')
            ->orderBy('nu_mes_clh')
            ->get();

        $anoInicio = null;
        $anoFim = null;
        if ($historicos->isNotEmpty()) {
            $anoInicio = (int) $historicos->max('nu_ano_inicio_clh');
            $anoFim = (int) $historicos->max('nu_ano_fim_clh');
            $historicos = $historicos->filter(function ($h) use ($anoInicio, $anoFim) {
                return (int) $h->nu_ano_inicio_clh === $anoInicio
                    && (int) $h->nu_ano_fim_clh === $anoFim;
            })->sortBy('nu_mes_clh')->values();
        }

        $metodologia = config('clima.metodologia_sazonalidade', 'v1');
        $indicadores = ClimaIndicador::where('id_localizacao_clima_loc', $localizacao->id_localizacao_clima_loc)
            ->where('ds_metodologia_cli', $metodologia)
            ->orderBy('nu_mes_cli')
            ->get();

        if ($previsoes->isEmpty() && $historicos->isEmpty() && $indicadores->isEmpty()) {
            return null;
        }

        $atual = $previsoes->first(function ($p) use ($hoje) {
            $data = $p->dt_previsao_clp instanceof Carbon
                ? $p->dt_previsao_clp->toDateString()
                : substr((string) $p->dt_previsao_clp, 0, 10);

            return $data === $hoje;
        });
        if (!$atual) {
            $atual = $previsoes->first();
        }

        $meses = [
            1 => 'Jan', 2 => 'Fev', 3 => 'Mar', 4 => 'Abr',
            5 => 'Mai', 6 => 'Jun', 7 => 'Jul', 8 => 'Ago',
            9 => 'Set', 10 => 'Out', 11 => 'Nov', 12 => 'Dez',
        ];
        $mesesCompletos = [
            1 => 'Janeiro', 2 => 'Fevereiro', 3 => 'Março', 4 => 'Abril',
            5 => 'Maio', 6 => 'Junho', 7 => 'Julho', 8 => 'Agosto',
            9 => 'Setembro', 10 => 'Outubro', 11 => 'Novembro', 12 => 'Dezembro',
        ];

        $chartLabels = [];
        $chartTempMedia = [];
        $chartTempMin = [];
        $chartTempMax = [];
        $chartPrecip = [];
        foreach ($historicos as $h) {
            $mes = (int) $h->nu_mes_clh;
            $chartLabels[] = isset($meses[$mes]) ? $meses[$mes] : (string) $mes;
            $chartTempMedia[] = $h->nu_temp_media_clh !== null ? (float) $h->nu_temp_media_clh : null;
            $chartTempMin[] = $h->nu_temp_min_media_clh !== null ? (float) $h->nu_temp_min_media_clh : null;
            $chartTempMax[] = $h->nu_temp_max_media_clh !== null ? (float) $h->nu_temp_max_media_clh : null;
            $chartPrecip[] = $h->nu_precip_media_clh !== null ? (float) $h->nu_precip_media_clh : null;
        }

        $calendario = [];
        foreach ($indicadores as $ind) {
            $mes = (int) $ind->nu_mes_cli;
            $calendario[] = [
                'mes' => $mes,
                'label' => isset($meses[$mes]) ? $meses[$mes] : (string) $mes,
                'label_completo' => isset($mesesCompletos[$mes]) ? $mesesCompletos[$mes] : (string) $mes,
                'indice' => (float) $ind->nu_indice_cli,
                'classificacao' => $ind->ds_classificacao_cli,
                'justificativa' => $ind->ds_justificativa_cli,
            ];
        }

        return [
            'localizacao' => $localizacao,
            'atual' => $atual,
            'previsoes' => $previsoes,
            'historicos' => $historicos,
            'indicadores' => $indicadores,
            'recomendacoes' => $this->recomendacoes->build($previsoes),
            'atualizado_em' => $localizacao->dt_previsao_atualizada_loc,
            'historico_atualizado_em' => $localizacao->dt_historico_atualizado_loc,
            'fonte_nome' => config('clima.fonte_nome', 'Open-Meteo'),
            'fonte_url' => config('clima.fonte_url', 'https://open-meteo.com/'),
            'ano_inicio' => $anoInicio,
            'ano_fim' => $anoFim,
            'chart' => [
                'labels' => $chartLabels,
                'temp_media' => $chartTempMedia,
                'temp_min' => $chartTempMin,
                'temp_max' => $chartTempMax,
                'precip' => $chartPrecip,
            ],
            'calendario' => $calendario,
            'tem_previsao' => $previsoes->isNotEmpty(),
            'tem_historico' => $historicos->isNotEmpty(),
            'tem_sazonalidade' => !empty($calendario),
        ];
    }
}

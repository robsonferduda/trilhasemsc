<?php

namespace App\Services\Clima;

use App\ClimaHistorico;
use App\ClimaIndicador;
use App\ClimaPrevisao;
use App\ClimaSyncLog;
use App\LocalizacaoClima;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;

class ClimaSyncService
{
    /** @var OpenMeteoClient */
    private $client;

    /** @var WeatherNormalizer */
    private $normalizer;

    /** @var LocalizacaoClimaResolver */
    private $resolver;

    /** @var SeasonalityCalculator */
    private $seasonality;

    public function __construct(
        OpenMeteoClient $client = null,
        WeatherNormalizer $normalizer = null,
        LocalizacaoClimaResolver $resolver = null,
        SeasonalityCalculator $seasonality = null
    ) {
        $this->client = $client ?: new OpenMeteoClient();
        $this->normalizer = $normalizer ?: new WeatherNormalizer();
        $this->resolver = $resolver ?: new LocalizacaoClimaResolver();
        $this->seasonality = $seasonality ?: new SeasonalityCalculator();
    }

    /**
     * @param callable|null $onProgress function(string $message)
     * @return array{sucesso:int,erro:int,total:int}
     */
    public function syncForecasts(callable $onProgress = null)
    {
        $locais = $this->resolver->collectFromPublishedTrilhas();
        $log = $this->startLog('previsao', $locais->count());
        $sucesso = 0;
        $erro = 0;
        $mensagens = [];

        foreach ($locais as $localizacao) {
            try {
                $this->syncForecastForLocation($localizacao);
                $sucesso++;
                $this->progress($onProgress, sprintf(
                    'Previsão OK loc #%d (%.3f, %.3f)',
                    $localizacao->id_localizacao_clima_loc,
                    $localizacao->nu_latitude_loc,
                    $localizacao->nu_longitude_loc
                ));
            } catch (Exception $e) {
                $erro++;
                $msg = sprintf(
                    'Previsão falhou loc #%d: %s',
                    $localizacao->id_localizacao_clima_loc,
                    $e->getMessage()
                );
                $mensagens[] = $msg;
                Log::warning($msg);
                $this->progress($onProgress, $msg);
            }

            $this->throttle();
        }

        $this->finishLog($log, $sucesso, $erro, $mensagens);

        return ['sucesso' => $sucesso, 'erro' => $erro, 'total' => $locais->count()];
    }

    /**
     * @param callable|null $onProgress
     * @return array{sucesso:int,erro:int,total:int}
     */
    public function syncHistories(callable $onProgress = null)
    {
        $locais = $this->resolver->collectFromPublishedTrilhas();
        $log = $this->startLog('historico', $locais->count());
        $sucesso = 0;
        $erro = 0;
        $mensagens = [];

        foreach ($locais as $localizacao) {
            try {
                $this->syncHistoryForLocation($localizacao);
                $this->syncIndicatorsForLocation($localizacao);
                $sucesso++;
                $this->progress($onProgress, sprintf(
                    'Histórico+indicadores OK loc #%d',
                    $localizacao->id_localizacao_clima_loc
                ));
            } catch (Exception $e) {
                $erro++;
                $msg = sprintf(
                    'Histórico falhou loc #%d: %s',
                    $localizacao->id_localizacao_clima_loc,
                    $e->getMessage()
                );
                $mensagens[] = $msg;
                Log::warning($msg);
                $this->progress($onProgress, $msg);
            }

            $this->throttle();
        }

        $this->finishLog($log, $sucesso, $erro, $mensagens);

        return ['sucesso' => $sucesso, 'erro' => $erro, 'total' => $locais->count()];
    }

    /**
     * @param callable|null $onProgress
     * @return array{sucesso:int,erro:int,total:int}
     */
    public function syncIndicators(callable $onProgress = null)
    {
        $locais = LocalizacaoClima::whereHas('historicos')->get();
        $log = $this->startLog('indicador', $locais->count());
        $sucesso = 0;
        $erro = 0;
        $mensagens = [];

        foreach ($locais as $localizacao) {
            try {
                $this->syncIndicatorsForLocation($localizacao);
                $sucesso++;
                $this->progress($onProgress, sprintf(
                    'Indicadores OK loc #%d',
                    $localizacao->id_localizacao_clima_loc
                ));
            } catch (Exception $e) {
                $erro++;
                $msg = sprintf(
                    'Indicadores falharam loc #%d: %s',
                    $localizacao->id_localizacao_clima_loc,
                    $e->getMessage()
                );
                $mensagens[] = $msg;
                Log::warning($msg);
                $this->progress($onProgress, $msg);
            }
        }

        $this->finishLog($log, $sucesso, $erro, $mensagens);

        return ['sucesso' => $sucesso, 'erro' => $erro, 'total' => $locais->count()];
    }

    /**
     * @param LocalizacaoClima $localizacao
     * @return void
     */
    public function syncForecastForLocation(LocalizacaoClima $localizacao)
    {
        $payload = $this->client->forecast(
            (float) $localizacao->nu_latitude_origem_loc,
            (float) $localizacao->nu_longitude_origem_loc
        );

        $normalized = $this->normalizer->normalizeForecast($payload);
        $agora = Carbon::now();

        if ($normalized['elevation'] !== null) {
            $localizacao->nu_altitude_api_loc = $normalized['elevation'];
        }

        foreach ($normalized['daily'] as $dia) {
            ClimaPrevisao::updateOrCreate(
                [
                    'id_localizacao_clima_loc' => $localizacao->id_localizacao_clima_loc,
                    'dt_previsao_clp' => $dia['data'],
                ],
                [
                    'nu_temp_min_clp' => $dia['temperatura_minima'],
                    'nu_temp_max_clp' => $dia['temperatura_maxima'],
                    'nu_temp_atual_clp' => isset($dia['temperatura_atual']) ? $dia['temperatura_atual'] : null,
                    'nu_precip_prob_clp' => $dia['precipitacao_probabilidade'],
                    'nu_precip_mm_clp' => $dia['precipitacao_volume'],
                    'nu_umidade_clp' => isset($dia['umidade']) ? $dia['umidade'] : null,
                    'nu_vento_kmh_clp' => $dia['velocidade_vento'],
                    'nu_rajada_kmh_clp' => $dia['rajada_vento'],
                    'nu_nebulosidade_clp' => isset($dia['nebulosidade']) ? $dia['nebulosidade'] : null,
                    'nu_indice_uv_clp' => $dia['indice_uv'],
                    'hr_nascer_sol_clp' => $dia['nascer_sol'],
                    'hr_por_sol_clp' => $dia['por_sol'],
                    'cd_condicao_clp' => $dia['codigo_condicao'],
                    'ds_fonte_clp' => $normalized['fonte'],
                    'dt_atualizado_clp' => $agora,
                ]
            );
        }

        // Se o dia de hoje não recebeu temp atual via daily match, atualiza pelo current
        $hoje = Carbon::now(config('clima.timezone'))->toDateString();
        if (!empty($normalized['current']['temperatura'])) {
            $row = ClimaPrevisao::where('id_localizacao_clima_loc', $localizacao->id_localizacao_clima_loc)
                ->where('dt_previsao_clp', $hoje)
                ->first();
            if ($row) {
                $row->nu_temp_atual_clp = $normalized['current']['temperatura'];
                if ($row->nu_umidade_clp === null) {
                    $row->nu_umidade_clp = $normalized['current']['umidade'];
                }
                if ($row->nu_nebulosidade_clp === null) {
                    $row->nu_nebulosidade_clp = $normalized['current']['nebulosidade'];
                }
                $row->save();
            }
        }

        $localizacao->dt_previsao_atualizada_loc = $agora;
        $localizacao->save();
    }

    /**
     * @param LocalizacaoClima $localizacao
     * @return void
     */
    public function syncHistoryForLocation(LocalizacaoClima $localizacao)
    {
        $anos = (int) config('clima.historico_anos', 10);
        $fim = Carbon::now(config('clima.timezone'))->subDays(5);
        $inicio = (clone $fim)->subYears($anos)->startOfYear();
        $anoInicio = (int) $inicio->year;
        $anoFim = (int) $fim->year;

        $payload = $this->client->archive(
            (float) $localizacao->nu_latitude_origem_loc,
            (float) $localizacao->nu_longitude_origem_loc,
            $inicio->toDateString(),
            $fim->toDateString()
        );

        $normalized = $this->normalizer->normalizeArchiveMonthly($payload, $anoInicio, $anoFim);
        $agora = Carbon::now();

        if ($normalized['elevation'] !== null) {
            $localizacao->nu_altitude_api_loc = $normalized['elevation'];
        }

        foreach ($normalized['mensal'] as $mes) {
            ClimaHistorico::updateOrCreate(
                [
                    'id_localizacao_clima_loc' => $localizacao->id_localizacao_clima_loc,
                    'nu_mes_clh' => $mes['mes'],
                    'nu_ano_inicio_clh' => $mes['ano_inicio'],
                    'nu_ano_fim_clh' => $mes['ano_fim'],
                ],
                [
                    'nu_temp_media_clh' => $mes['temperatura_media'],
                    'nu_temp_min_media_clh' => $mes['temperatura_minima_media'],
                    'nu_temp_max_media_clh' => $mes['temperatura_maxima_media'],
                    'nu_precip_media_clh' => $mes['precipitacao_media'],
                    'nu_dias_chuva_clh' => $mes['dias_com_chuva'],
                    'nu_umidade_media_clh' => $mes['umidade_media'],
                    'nu_vento_medio_clh' => $mes['vento_medio'],
                    'ds_fonte_clh' => $mes['fonte'],
                    'dt_atualizado_clh' => $agora,
                ]
            );
        }

        $localizacao->dt_historico_atualizado_loc = $agora;
        $localizacao->save();
    }

    /**
     * @param LocalizacaoClima $localizacao
     * @return void
     */
    public function syncIndicatorsForLocation(LocalizacaoClima $localizacao)
    {
        $historicos = ClimaHistorico::where('id_localizacao_clima_loc', $localizacao->id_localizacao_clima_loc)
            ->orderBy('nu_mes_clh')
            ->get();

        if ($historicos->isEmpty()) {
            return;
        }

        // Usa a janela de anos mais recente
        $anoInicio = $historicos->max('nu_ano_inicio_clh');
        $anoFim = $historicos->max('nu_ano_fim_clh');

        $mensal = $historicos
            ->filter(function ($h) use ($anoInicio, $anoFim) {
                return (int) $h->nu_ano_inicio_clh === (int) $anoInicio
                    && (int) $h->nu_ano_fim_clh === (int) $anoFim;
            })
            ->map(function ($h) {
                return [
                    'mes' => (int) $h->nu_mes_clh,
                    'precipitacao_media' => $h->nu_precip_media_clh !== null ? (float) $h->nu_precip_media_clh : null,
                    'dias_com_chuva' => $h->nu_dias_chuva_clh !== null ? (float) $h->nu_dias_chuva_clh : null,
                    'temperatura_media' => $h->nu_temp_media_clh !== null ? (float) $h->nu_temp_media_clh : null,
                    'vento_medio' => $h->nu_vento_medio_clh !== null ? (float) $h->nu_vento_medio_clh : null,
                ];
            })
            ->values()
            ->all();

        $indicadores = $this->seasonality->calculate($mensal);
        $agora = Carbon::now();
        $metodologia = config('clima.metodologia_sazonalidade', 'v1');

        foreach ($indicadores as $ind) {
            ClimaIndicador::updateOrCreate(
                [
                    'id_localizacao_clima_loc' => $localizacao->id_localizacao_clima_loc,
                    'nu_mes_cli' => $ind['mes'],
                    'ds_metodologia_cli' => $metodologia,
                ],
                [
                    'nu_indice_cli' => $ind['indice'],
                    'ds_classificacao_cli' => $ind['classificacao'],
                    'ds_justificativa_cli' => $ind['justificativa'],
                    'dt_atualizado_cli' => $agora,
                ]
            );
        }
    }

    /**
     * @param string $tipo
     * @param int $total
     * @return ClimaSyncLog
     */
    private function startLog($tipo, $total)
    {
        return ClimaSyncLog::create([
            'ds_tipo_csl' => $tipo,
            'ds_status_csl' => 'em_andamento',
            'nu_total_csl' => $total,
            'nu_sucesso_csl' => 0,
            'nu_erro_csl' => 0,
            'dt_inicio_csl' => Carbon::now(),
        ]);
    }

    /**
     * @param ClimaSyncLog $log
     * @param int $sucesso
     * @param int $erro
     * @param array $mensagens
     * @return void
     */
    private function finishLog(ClimaSyncLog $log, $sucesso, $erro, array $mensagens)
    {
        $status = 'ok';
        if ($erro > 0 && $sucesso > 0) {
            $status = 'parcial';
        } elseif ($erro > 0 && $sucesso === 0) {
            $status = 'erro';
        }

        $log->ds_status_csl = $status;
        $log->nu_sucesso_csl = $sucesso;
        $log->nu_erro_csl = $erro;
        $log->ds_mensagem_csl = empty($mensagens) ? null : implode("\n", array_slice($mensagens, 0, 20));
        $log->dt_fim_csl = Carbon::now();
        $log->save();
    }

    /**
     * @return void
     */
    private function throttle()
    {
        $ms = (int) config('clima.request_delay_ms', 200);
        if ($ms > 0) {
            usleep($ms * 1000);
        }
    }

    /**
     * @param callable|null $onProgress
     * @param string $message
     * @return void
     */
    private function progress($onProgress, $message)
    {
        if (is_callable($onProgress)) {
            $onProgress($message);
        }
    }
}

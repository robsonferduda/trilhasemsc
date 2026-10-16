<?php

namespace App\Console\Commands;

use App\Exceptions\CadasturIndisponivelException;
use App\Guia;
use App\Mail\CadasturVencimentoAviso;
use App\Services\CadasturService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class VerificarCadasturGuias extends Command
{
    protected $signature = 'guias:verificar-cadastur {--limite=200 : Máximo de consultas à API por execução}';

    protected $description = 'Expira selos Cadastur vencidos, reconsulta a base do Ministério do Turismo e avisa guias com vencimento próximo';

    public function handle(CadasturService $cadastur)
    {
        $vencidos = $cadastur->marcarVencidos();
        $this->info("{$vencidos} selo(s) marcados como vencidos pela data de validade.");

        if ($cadastur->habilitado()) {
            $this->reconsultar($cadastur);
        } else {
            $this->warn('API do Cadastur não configurada (CADASTUR_CLIENT_ID, CADASTUR_CLIENT_SECRET, CADASTUR_CPF_USUARIO). Reconsulta ignorada.');
        }

        $this->avisarVencimentos();

        return 0;
    }

    private function reconsultar(CadasturService $cadastur)
    {
        $guias = Guia::with('user')
            ->whereNotNull('nu_cadastur_gui')
            ->where('nu_cadastur_gui', '!=', '')
            ->where(function ($query) {
                $query->whereNull('sg_cadastur_situacao_gui')
                    ->orWhere('sg_cadastur_situacao_gui', CadasturService::PENDENTE)
                    ->orWhereNull('dt_cadastur_consulta_gui')
                    ->orWhere('dt_cadastur_consulta_gui', '<', now()->subDays(7))
                    ->orWhere(function ($query) {
                        $query->where('sg_cadastur_situacao_gui', CadasturService::CONFERIDO)
                            ->whereDate('dt_cadastur_validade_gui', '<=', today()->addDays(30)->toDateString());
                    });
            })
            ->orderBy('dt_cadastur_consulta_gui')
            ->limit((int) $this->option('limite'))
            ->get();

        $consultados = 0;
        $falhasSeguidas = 0;

        foreach ($guias as $guia) {
            try {
                $cadastur->verificar($guia);
                $consultados++;
                $falhasSeguidas = 0;
            } catch (CadasturIndisponivelException $e) {
                $falhasSeguidas++;
                \Log::warning('Consulta ao Cadastur indisponível', [
                    'guia_id' => $guia->id_guia_gui,
                    'error' => $e->getMessage(),
                ]);

                if ($falhasSeguidas >= 3) {
                    $this->error('API do Cadastur falhou 3 vezes seguidas: ' . $e->getMessage());
                    break;
                }
            }

            usleep(200000);
        }

        $this->info("{$consultados} de {$guias->count()} guia(s) reconsultados na API do Cadastur.");
    }

    private function avisarVencimentos()
    {
        $guias = Guia::with('user')
            ->where('fl_ativo_gui', true)
            ->where('sg_cadastur_situacao_gui', CadasturService::CONFERIDO)
            ->whereDate('dt_cadastur_validade_gui', '>=', today()->toDateString())
            ->whereDate('dt_cadastur_validade_gui', '<=', today()->addDays(30)->toDateString())
            ->where(function ($query) {
                $query->whereNull('dt_cadastur_aviso_validade_gui')
                    ->orWhereColumn('dt_cadastur_aviso_validade_gui', '!=', 'dt_cadastur_validade_gui');
            })
            ->get();

        $avisados = 0;

        foreach ($guias as $guia) {
            $email = optional($guia->user)->email;

            if (empty($email)) {
                continue;
            }

            try {
                Mail::to($email)->send(new CadasturVencimentoAviso($guia));
                $guia->dt_cadastur_aviso_validade_gui = $guia->dt_cadastur_validade_gui;
                $guia->save();
                $avisados++;
            } catch (\Exception $e) {
                \Log::error('Erro ao enviar aviso de vencimento do Cadastur', [
                    'guia_id' => $guia->id_guia_gui,
                    'error' => $e->getMessage(),
                ]);
            }
        }

        $this->info("{$avisados} guia(s) avisados sobre vencimento do Cadastur.");
    }
}

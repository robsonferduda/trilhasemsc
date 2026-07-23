<?php

namespace App\Jobs;

use App\Guia;
use App\Trilha;
use App\LogEmail;
use App\Trilheiro;
use App\Mail\ConviteTrilhaGuia;
use Illuminate\Bus\Queueable;
use App\Mail\ConviteTrilhaTrilheiro;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class EnviarConviteTrilhaLoteJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 1200;

    private $idTrilha;
    private $tipoEnvio;
    private $idsDestinatarios;

    public function __construct($idTrilha, $tipoEnvio, array $idsDestinatarios)
    {
        $this->idTrilha = (int) $idTrilha;
        $this->tipoEnvio = (int) $tipoEnvio;
        $this->idsDestinatarios = $idsDestinatarios;
    }

    public function handle()
    {
        $trilha = Trilha::with('foto')->find($this->idTrilha);

        if (!$trilha) {
            return;
        }

        $enviados = 0;

        if ($this->tipoEnvio === 1) {
            $destinatarios = Trilheiro::with('user')
                ->where('fl_newsletter_tri', true)
                ->whereIn('id_trilheiro_tri', $this->idsDestinatarios)
                ->get();

            foreach ($destinatarios as $trilheiro) {
                try {
                    $email = optional($trilheiro->user)->email;
                    if (empty($email)) {
                        continue;
                    }

                    $nome = $trilheiro->nm_trilheiro_tri ?: optional($trilheiro->user)->name;
                    Mail::to($email)->send(new ConviteTrilhaTrilheiro($trilha, $nome, false));
                    $enviados++;
                } catch (\Exception $e) {
                    \Log::error('Erro no lote de convite para trilheiro', [
                        'trilha_id' => $this->idTrilha,
                        'trilheiro_id' => $trilheiro->id_trilheiro_tri,
                        'error' => $e->getMessage(),
                    ]);
                }
            }
        }

        if ($this->tipoEnvio === 2) {
            $destinatarios = Guia::with('user')
                ->where('fl_ativo_gui', true)
                ->whereIn('id_guia_gui', $this->idsDestinatarios)
                ->get();

            foreach ($destinatarios as $guia) {
                try {
                    $email = optional($guia->user)->email;
                    if (empty($email)) {
                        continue;
                    }

                    $nome = $guia->nm_guia_gui ?: optional($guia->user)->name;
                    Mail::to($email)->send(new ConviteTrilhaGuia($trilha, $nome, false));
                    $enviados++;
                } catch (\Exception $e) {
                    \Log::error('Erro no lote de convite para guia', [
                        'trilha_id' => $this->idTrilha,
                        'guia_id' => $guia->id_guia_gui,
                        'error' => $e->getMessage(),
                    ]);
                }
            }
        }

        if ($enviados > 0) {
            LogEmail::create([
                'id_trilha_tri' => $this->idTrilha,
                'cd_tipo_envio_tie' => $this->tipoEnvio,
                'nu_total_envios_loe' => $enviados,
                'dt_envio_loe' => now(),
            ]);
        }
    }
}

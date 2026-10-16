<?php

namespace App\Jobs;

use App\Exceptions\CadasturIndisponivelException;
use App\Guia;
use App\Services\CadasturService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class VerificarCadasturGuiaJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 1;
    public $timeout = 60;

    private $idGuia;

    public function __construct($idGuia)
    {
        $this->idGuia = (int) $idGuia;
    }

    public function handle(CadasturService $cadastur)
    {
        if (!$cadastur->habilitado()) {
            return;
        }

        $guia = Guia::with('user')->find($this->idGuia);

        if (!$guia) {
            return;
        }

        try {
            $cadastur->verificar($guia);
        } catch (CadasturIndisponivelException $e) {
            \Log::warning('Consulta ao Cadastur indisponível', [
                'guia_id' => $this->idGuia,
                'error' => $e->getMessage(),
            ]);
        }
    }
}

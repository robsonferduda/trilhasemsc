<?php

namespace App\Console\Commands;

use App\Services\Clima\ClimaSyncService;
use Illuminate\Console\Command;

class SyncClimaIndicadores extends Command
{
    protected $signature = 'clima:sync-indicadores';

    protected $description = 'Recalcula indicadores de sazonalidade a partir do histórico climático armazenado';

    public function handle()
    {
        $this->info('Iniciando recálculo de indicadores de sazonalidade...');

        $service = new ClimaSyncService();
        $resultado = $service->syncIndicators(function ($message) {
            $this->line($message);
        });

        $this->info(sprintf(
            'Concluído: %d sucesso, %d erro, %d total.',
            $resultado['sucesso'],
            $resultado['erro'],
            $resultado['total']
        ));

        return $resultado['erro'] > 0 && $resultado['sucesso'] === 0 ? 1 : 0;
    }
}

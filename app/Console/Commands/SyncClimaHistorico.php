<?php

namespace App\Console\Commands;

use App\Services\Clima\ClimaSyncService;
use Illuminate\Console\Command;

class SyncClimaHistorico extends Command
{
    protected $signature = 'clima:sync-historico';

    protected $description = 'Atualiza histórico climático mensal e indicadores de sazonalidade (Open-Meteo Archive)';

    public function handle()
    {
        $this->info('Iniciando sync de histórico climático...');

        $service = new ClimaSyncService();
        $resultado = $service->syncHistories(function ($message) {
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

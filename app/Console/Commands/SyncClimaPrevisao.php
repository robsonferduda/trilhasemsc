<?php

namespace App\Console\Commands;

use App\Services\Clima\ClimaSyncService;
use Illuminate\Console\Command;

class SyncClimaPrevisao extends Command
{
    protected $signature = 'clima:sync-previsao';

    protected $description = 'Atualiza previsão meteorológica (Open-Meteo) para localizações das trilhas publicadas';

    public function handle()
    {
        $this->info('Iniciando sync de previsão climática...');

        $service = new ClimaSyncService();
        $resultado = $service->syncForecasts(function ($message) {
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

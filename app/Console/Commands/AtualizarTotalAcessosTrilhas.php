<?php

namespace App\Console\Commands;

use App\TotalAcessosTrilhas;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class AtualizarTotalAcessosTrilhas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'trilhas:atualizar-total-acessos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Atualiza a tabela de totalização de acessos por trilha (total_acessos_trilhas_tat)';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Iniciando atualização de total de acessos por trilha...');

        $dados = DB::table('estatistica_acesso_esa as t1')
            ->join('trilha_tri as t2', 't2.id_trilha_tri', '=', 't1.cd_monitoramento_esa')
            ->where('t1.cd_tipo_monitoramento_tim', 1)
            ->groupBy('t2.id_trilha_tri', 't2.nm_trilha_tri')
            ->select('t2.id_trilha_tri', 't2.nm_trilha_tri', DB::raw('count(*) as total'))
            ->get();

        $atualizados = 0;

        foreach ($dados as $dado) {
            TotalAcessosTrilhas::updateOrCreate(
                ['id_trilha_tri' => $dado->id_trilha_tri],
                [
                    'nm_trilha_tri'    => $dado->nm_trilha_tri,
                    'total_acessos_tat' => $dado->total,
                ]
            );
            $atualizados++;
        }

        $this->info("Concluído. {$atualizados} trilha(s) atualizadas.");

        return 0;
    }
}

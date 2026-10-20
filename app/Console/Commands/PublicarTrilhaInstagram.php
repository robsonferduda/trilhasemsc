<?php

namespace App\Console\Commands;

use App\Services\InstagramPublicadorTrilha;
use Carbon\Carbon;
use Illuminate\Console\Command;

class PublicarTrilhaInstagram extends Command
{
    /**
     * @var string
     */
    protected $signature = 'instagram:publicar-trilha
        {--trilha= : Id da trilha. Sem isso, a regra escolhe a próxima}
        {--dry-run : Monta a legenda e não publica}
        {--publish : Publica mesmo com INSTAGRAM_PUBLISH_ENABLED=false}
        {--ignorar-agenda : Publica fora dos dias configurados}
        {--ignorar-limite : Ignora o máximo de publicações do dia}';

    /**
     * @var string
     */
    protected $description = 'Publica um story no Instagram com uma trilha escolhida por regras de rodízio';

    /**
     * @param InstagramPublicadorTrilha $publicador
     * @return int
     */
    public function handle(InstagramPublicadorTrilha $publicador)
    {
        $publicar = $this->option('publish') || (config('services.instagram.publish.enabled') && !$this->option('dry-run'));
        if ($this->option('dry-run')) {
            $publicar = false;
        }

        if (!$this->option('ignorar-agenda') && !$this->diaPermitido()) {
            $this->info('Hoje não está na agenda de publicação (' . implode(',', config('services.instagram.publish.weekdays')) . ').');
            return 0;
        }

        $maximo = (int) config('services.instagram.publish.max_per_day', 1);
        $hoje = $publicador->publicacoesHoje();
        if (!$this->option('ignorar-limite') && $hoje >= $maximo) {
            $this->info(sprintf('Limite do dia atingido (%d de %d).', $hoje, $maximo));
            return 0;
        }

        $trilhaId = $this->option('trilha') ? (int) $this->option('trilha') : null;
        $trilha = $publicador->selecionar($trilhaId);
        if (!$trilha) {
            $this->error('Nenhuma trilha publicada com foto passou nas regras.');
            return 1;
        }

        $conteudo = $publicador->montar($trilha);

        $this->line('Trilha: ' . $trilha->nm_trilha_tri . ' (#' . $trilha->id_trilha_tri . ')');
        $this->line('Story: ' . $conteudo['imagem']);
        $this->line('Destino do link: ' . $conteudo['url']);

        if (!$publicar) {
            $this->info('Simulação concluída. Nada foi publicado.');
            return 0;
        }

        try {
            $registro = $publicador->publicar($trilha, $conteudo);
        } catch (\Throwable $exception) {
            $this->error('Falha ao publicar: ' . $exception->getMessage());
            return 1;
        }

        $this->info('Publicado. Registro #' . $registro->id_publicacao_ipu);
        if ($registro->ds_permalink_ipu) {
            $this->line($registro->ds_permalink_ipu);
        }

        return 0;
    }

    /**
     * @return bool
     */
    private function diaPermitido()
    {
        $dias = config('services.instagram.publish.weekdays', []);
        if (empty($dias)) {
            return true;
        }

        return in_array(Carbon::now()->dayOfWeek, $dias, true);
    }
}

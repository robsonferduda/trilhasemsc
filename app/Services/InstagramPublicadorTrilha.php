<?php

namespace App\Services;

use App\Foto;
use App\Guia;
use App\InstagramPublicacao;
use App\Trilha;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class InstagramPublicadorTrilha
{
    /**
     * @param int|null $trilhaId
     * @param int|null $guiaId
     * @return Trilha|Guia|null
     */
    public function selecionar($trilhaId = null, $guiaId = null)
    {
        if ($trilhaId) {
            $trilha = $this->consultaTrilhas()->where('id_trilha_tri', $trilhaId)->first();

            return ($trilha && $this->arquivoStory($trilha)) ? $trilha : null;
        }

        if ($guiaId) {
            $guia = $this->consultaGuias()->where('id_guia_gui', $guiaId)->first();

            return ($guia && $this->arquivoStory($guia)) ? $guia : null;
        }

        $candidatos = [];

        foreach ($this->trilhasDisponiveis() as $trilha) {
            if ($this->arquivoStory($trilha)) {
                $candidatos[] = $trilha;
            }
        }

        foreach ($this->guiasDisponiveis() as $guia) {
            if ($this->arquivoStory($guia)) {
                $candidatos[] = $guia;
            }
        }

        if (empty($candidatos)) {
            return null;
        }

        return $candidatos[array_rand($candidatos)];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private function consultaTrilhas()
    {
        $query = Trilha::with(['detalhes', 'nivel', 'cidade'])
            ->where('fl_publicacao_tri', 'S')
            ->whereNotNull('ds_path_story_instagram_tri')
            ->where('ds_path_story_instagram_tri', '!=', '');

        $categoria = config('services.instagram.publish.categoria_id');
        if ($categoria !== null && $categoria !== '') {
            $query->where('id_categoria_cat', $categoria);
        }

        return $query;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private function consultaGuias()
    {
        return Guia::with('origem')
            ->where('fl_ativo_gui', true)
            ->where('fl_perfil_moderado_gui', true)
            ->whereNotNull('ds_path_story_instagram_gui')
            ->where('ds_path_story_instagram_gui', '!=', '');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    private function trilhasDisponiveis()
    {
        $query = $this->consultaTrilhas();
        $recentes = $this->idsPublicadosRecentemente('id_trilha_tri');
        $emAndamento = $this->idsEmAndamento('id_trilha_tri');

        if (!empty($recentes)) {
            $query->whereNotIn('id_trilha_tri', $recentes);
        }

        if (!empty($emAndamento)) {
            $query->whereNotIn('id_trilha_tri', $emAndamento);
        }

        return $query->get();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    private function guiasDisponiveis()
    {
        $query = $this->consultaGuias();
        $recentes = $this->idsPublicadosRecentemente('id_guia_gui');
        $emAndamento = $this->idsEmAndamento('id_guia_gui');

        if (!empty($recentes)) {
            $query->whereNotIn('id_guia_gui', $recentes);
        }

        if (!empty($emAndamento)) {
            $query->whereNotIn('id_guia_gui', $emAndamento);
        }

        return $query->get();
    }

    /**
     * @param string $coluna
     * @return array
     */
    private function idsPublicadosRecentemente($coluna)
    {
        $cooldown = (int) config('services.instagram.publish.cooldown_days', 90);

        return InstagramPublicacao::query()
            ->where('ds_status_ipu', 'publicado')
            ->whereNotNull($coluna)
            ->where('dt_publicacao_ipu', '>=', Carbon::now()->subDays($cooldown))
            ->pluck($coluna)
            ->all();
    }

    /**
     * @param string $coluna
     * @return array
     */
    private function idsEmAndamento($coluna)
    {
        return InstagramPublicacao::query()
            ->where('ds_status_ipu', 'enviando')
            ->whereNotNull($coluna)
            ->where('created_at', '>=', Carbon::now()->subHours(2))
            ->pluck($coluna)
            ->all();
    }

    /**
     * @return int
     */
    public function publicacoesHoje()
    {
        return InstagramPublicacao::query()
            ->where('ds_status_ipu', 'publicado')
            ->whereDate('dt_publicacao_ipu', Carbon::today()->toDateString())
            ->count();
    }

    /**
     * @param Trilha|Guia $alvo
     * @return array
     */
    public function montar($alvo)
    {
        if (!$this->arquivoStory($alvo)) {
            throw new \RuntimeException('Não há imagem de story.');
        }

        $guia = $alvo instanceof Guia;
        $url = $guia ? $this->urlGuia($alvo) : $this->urlTrilha($alvo);

        return [
            'url' => $url,
            'imagem' => $this->urlStory($alvo),
            'legenda' => ($guia ? $alvo->nm_guia_gui : $alvo->nm_trilha_tri) . "\n" . $url,
            'tipo' => $guia ? 'Guia' : 'Trilha',
            'nome' => $guia ? $alvo->nm_guia_gui : $alvo->nm_trilha_tri,
            'id' => $guia ? $alvo->id_guia_gui : $alvo->id_trilha_tri,
        ];
    }

    /**
     * @param Trilha|Guia $alvo
     * @param array $conteudo
     * @return InstagramPublicacao
     */
    public function publicar($alvo, array $conteudo)
    {
        $accountId = config('services.instagram.account_id');
        $accessToken = config('services.instagram.access_token');
        $graphUrl = rtrim(config('services.instagram.graph_url'), '/');

        if (empty($accountId) || empty($accessToken)) {
            throw new \RuntimeException('Defina INSTAGRAM_IG_USER_ID e INSTAGRAM_ACCESS_TOKEN.');
        }

        $registro = InstagramPublicacao::create([
            'id_trilha_tri' => $alvo instanceof Trilha ? $alvo->id_trilha_tri : null,
            'id_guia_gui' => $alvo instanceof Guia ? $alvo->id_guia_gui : null,
            'ds_status_ipu' => 'enviando',
            'ds_legenda_ipu' => $conteudo['legenda'],
            'ds_imagem_ipu' => $conteudo['imagem'],
            'ds_url_trilha_ipu' => $conteudo['url'],
        ]);

        $client = new Client([
            'base_uri' => $graphUrl . '/',
            'timeout' => 40,
        ]);

        try {
            $container = $this->criarContainer($client, $accountId, $accessToken, $conteudo);
            $this->aguardarContainer($client, $container, $accessToken);
            $mediaId = $this->publicarContainer($client, $accountId, $accessToken, $container);
            $permalink = $this->buscarPermalink($client, $mediaId, $accessToken);

            $registro->update([
                'ds_status_ipu' => 'publicado',
                'cd_container_ipu' => $container,
                'cd_media_ipu' => $mediaId,
                'ds_permalink_ipu' => $permalink,
                'dt_publicacao_ipu' => Carbon::now(),
                'ds_erro_ipu' => null,
            ]);
        } catch (\Throwable $exception) {
            $registro->update([
                'ds_status_ipu' => 'erro',
                'ds_erro_ipu' => $this->mensagemErro($exception),
            ]);

            throw $exception;
        }

        return $registro->fresh();
    }

    /**
     * @param Trilha $trilha
     * @return Foto|null
     */
    public function resolverFoto(Trilha $trilha)
    {
        $fotos = $trilha->foto;
        if (!$fotos || $fotos->isEmpty()) {
            return null;
        }

        $principal = $fotos->first(function ($foto) {
            return (int) $foto->id_tipo_foto_tfo === 5 && !empty($foto->nm_path_fot);
        });

        if ($principal) {
            return $principal;
        }

        return $fotos->first(function ($foto) {
            return !empty($foto->nm_path_fot);
        });
    }

    /**
     * @param Trilha $trilha
     * @return string
     */
    public function urlTrilha(Trilha $trilha)
    {
        $path = ltrim((string) $trilha->ds_url_tri, '/');
        $url = $this->basePublica() . '/' . $path;
        $separador = strpos($url, '?') === false ? '?' : '&';

        return $url . $separador . http_build_query([
            'utm_source' => 'instagram',
            'utm_medium' => 'story',
            'utm_campaign' => 'trilha-' . $trilha->id_trilha_tri,
        ]);
    }

    /**
     * @param Guia $guia
     * @return string
     */
    public function urlGuia(Guia $guia)
    {
        $identificador = trim((string) $guia->nm_instagram_gui) !== ''
            ? $guia->nm_instagram_gui
            : $guia->id_guia_gui;
        $url = $this->basePublica() . '/guia/perfil/' . rawurlencode($identificador);

        return $url . '?' . http_build_query([
            'utm_source' => 'instagram',
            'utm_medium' => 'story',
            'utm_campaign' => 'guia-' . $guia->id_guia_gui,
        ]);
    }

    /**
     * @param Trilha|Guia $modelo
     * @return string
     */
    public function urlStory($modelo)
    {
        $nome = rawurlencode(basename($this->nomeArquivoStory($modelo)));

        return $this->basePublica() . '/img/instagram/stories/' . $nome;
    }

    /**
     * @param Trilha|Guia $modelo
     * @return string|null
     */
    public function arquivoStory($modelo)
    {
        $arquivo = $this->nomeArquivoStory($modelo);
        if ($arquivo === '') {
            return null;
        }

        $caminho = public_path('img/instagram/stories/' . basename($arquivo));

        return is_file($caminho) ? $caminho : null;
    }

    /**
     * @param Trilha|Guia $modelo
     * @return string
     */
    private function nomeArquivoStory($modelo)
    {
        if ($modelo instanceof Guia) {
            return (string) $modelo->ds_path_story_instagram_gui;
        }

        return (string) $modelo->ds_path_story_instagram_tri;
    }

    /**
     * @param Foto $foto
     * @return string
     */
    public function urlImagemOriginal(Foto $foto)
    {
        $pasta = ((int) $foto->id_tipo_foto_tfo === 5 || empty(optional($foto->tipo)->dc_path_tfp))
            ? 'detalhes-principal'
            : trim($foto->tipo->dc_path_tfp, '/');

        $partes = array_map('rawurlencode', explode('/', ltrim($foto->nm_path_fot, '/')));

        return $this->basePublica() . '/img/trilhas/' . $pasta . '/' . implode('/', $partes);
    }

    /**
     * @param Trilha $trilha
     * @param string $url
     * @return string
     */
    public function legenda(Trilha $trilha, $url)
    {
        $cidade = optional($trilha->cidade)->nm_cidade_cde;
        $nivel = optional($trilha->nivel)->dc_nivel_niv;
        $detalhe = $trilha->detalhes;
        $texto = $this->legendaComResumo($trilha, $url, $cidade, $nivel, $detalhe, 420, false);

        if (mb_strlen($texto) <= 2200) {
            return $texto;
        }

        return $this->legendaComResumo($trilha, $url, $cidade, $nivel, $detalhe, 160, true);
    }

    /**
     * @param Trilha $trilha
     * @param string $url
     * @param string|null $cidade
     * @param string|null $nivel
     * @param mixed $detalhe
     * @param int $limiteResumo
     * @param bool $cortar
     * @return string
     */
    private function legendaComResumo(Trilha $trilha, $url, $cidade, $nivel, $detalhe, $limiteResumo, $cortar)
    {
        $resumo = $this->resumo($trilha->ds_trilha_tri, $limiteResumo);
        $linhas = [$trilha->nm_trilha_tri, ''];
        if ($resumo !== '') {
            $linhas[] = $resumo;
            $linhas[] = '';
        }
        if ($cidade) {
            $linhas[] = '📍 ' . $cidade;
        }
        if ($nivel) {
            $linhas[] = '🥾 Nível: ' . $nivel;
        }
        if ($detalhe && $detalhe->nu_distancia_trd) {
            $linhas[] = '📏 Distância: ' . $this->numero($detalhe->nu_distancia_trd) . ' km';
        }
        if ($detalhe && $detalhe->duracao_trd) {
            $linhas[] = '⏱️ Duração: ' . $detalhe->duracao_trd;
        }
        if ($detalhe && $detalhe->nu_altitude_trd) {
            $linhas[] = '⛰️ Altitude: ' . $detalhe->nu_altitude_trd . ' m';
        }
        $linhas[] = '';
        $linhas[] = 'O passo a passo está no link da bio.';
        $linhas[] = $url;
        $linhas[] = '';
        $linhas[] = $this->hashtags($trilha, $cidade);
        $texto = trim(implode("\n", $linhas));

        return $cortar ? mb_substr($texto, 0, 2200) : $texto;
    }

    /**
     * @return string
     */
    private function basePublica()
    {
        return rtrim(config('services.instagram.publish.public_base_url'), '/');
    }

    /**
     * @param string $arquivo
     * @return string
     */
    private function fonte($arquivo)
    {
        $noProjeto = base_path('resources/fonts/' . $arquivo);
        if (is_file($noProjeto)) {
            return $noProjeto;
        }

        $noSistema = '/usr/share/fonts/truetype/dejavu/' . $arquivo;
        if (is_file($noSistema)) {
            return $noSistema;
        }

        throw new \RuntimeException('Fonte não encontrada para montar o story: ' . $arquivo);
    }

    /**
     * @param mixed $texto
     * @param int $limite
     * @return string
     */
    private function resumo($texto, $limite)
    {
        $limpo = trim(preg_replace('/\s+/', ' ', strip_tags(html_entity_decode((string) $texto))));

        return Str::limit($limpo, $limite, '...');
    }

    /**
     * @param mixed $valor
     * @return string
     */
    private function numero($valor)
    {
        if (!is_numeric($valor)) {
            return (string) $valor;
        }

        $numero = (float) $valor;
        if (floor($numero) == $numero) {
            return (string) (int) $numero;
        }

        return rtrim(rtrim(number_format($numero, 1, ',', ''), '0'), ',');
    }

    /**
     * @param Trilha $trilha
     * @param string|null $cidade
     * @return string
     */
    private function hashtags(Trilha $trilha, $cidade)
    {
        $base = explode(',', (string) config('services.instagram.publish.hashtags'));
        $tags = [];

        foreach ($base as $tag) {
            $this->adicionarHashtag($tags, $tag);
        }

        $this->adicionarHashtag($tags, $cidade);
        $this->adicionarHashtag($tags, $trilha->nm_trilha_tri);

        return implode(' ', array_slice($tags, 0, 20));
    }

    /**
     * @param array $tags
     * @param string|null $valor
     * @return void
     */
    private function adicionarHashtag(array &$tags, $valor)
    {
        $tag = Str::slug((string) $valor, '');
        if ($tag === '') {
            return;
        }

        $hashtag = '#' . $tag;
        if (!in_array($hashtag, $tags, true)) {
            $tags[] = $hashtag;
        }
    }

    /**
     * @param Foto $foto
     * @param Trilha $trilha
     * @return string
     */
    private function montarImagemStory(Foto $foto, Trilha $trilha)
    {
        $origem = $this->caminhoLocal($foto);
        if (!$origem || !is_file($origem)) {
            throw new \RuntimeException('A foto da trilha não está neste servidor, então o story não pode ser montado.');
        }

        $diretorio = public_path('img/instagram/trilhas');
        if (!is_dir($diretorio)) {
            mkdir($diretorio, 0775, true);
        }

        $nome = 'story-' . $trilha->id_trilha_tri . '-' . date('YmdHis') . '.jpg';
        $destino = $diretorio . DIRECTORY_SEPARATOR . $nome;

        $fonteNome = $this->fonte('DejaVuSans-Bold.ttf');
        $fonteLink = $this->fonte('DejaVuSans.ttf');
        $imagem = Image::make($origem)->fit(1080, 1920);

        $faixa = Image::canvas(1080, 560, '#000000');
        $faixa->opacity(62);
        $imagem->insert($faixa, 'bottom');

        $linhas = $this->quebrarTexto($trilha->nm_trilha_tri, $fonteNome, 54, 960);
        $host = parse_url($this->basePublica(), PHP_URL_HOST) ?: 'trilhasemsc.com.br';
        $link = $host . '/ig';
        $alturaBloco = (count($linhas) * 68) + 70;
        $y = (int) (1360 + ((560 - $alturaBloco) / 2) + 34);

        foreach ($linhas as $linha) {
            $imagem->text($linha, 540, $y, function ($font) use ($fonteNome) {
                $font->file($fonteNome);
                $font->size(54);
                $font->color('#ffffff');
                $font->align('center');
                $font->valign('middle');
            });
            $y += 68;
        }

        $imagem->text($link, 540, $y + 24, function ($font) use ($fonteLink) {
            $font->file($fonteLink);
            $font->size(34);
            $font->color('#f2f2f2');
            $font->align('center');
            $font->valign('middle');
        });

        $imagem->save($destino, 85, 'jpg');

        return $this->basePublica() . '/img/instagram/trilhas/' . rawurlencode($nome);
    }

    /**
     * @param string $texto
     * @param string $fonte
     * @param int $tamanho
     * @param int $larguraMaxima
     * @return array
     */
    private function quebrarTexto($texto, $fonte, $tamanho, $larguraMaxima)
    {
        $palavras = preg_split('/\s+/', trim((string) $texto));
        $linhas = [];
        $atual = '';

        foreach ($palavras as $palavra) {
            if ($palavra === '') {
                continue;
            }

            $tentativa = $atual === '' ? $palavra : $atual . ' ' . $palavra;
            $caixa = imagettfbbox($tamanho, 0, $fonte, $tentativa);
            $largura = abs($caixa[2] - $caixa[0]);

            if ($largura > $larguraMaxima && $atual !== '') {
                $linhas[] = $atual;
                $atual = $palavra;
            } else {
                $atual = $tentativa;
            }
        }

        if ($atual !== '') {
            $linhas[] = $atual;
        }

        if (count($linhas) <= 3) {
            return $linhas;
        }

        $linhas = array_slice($linhas, 0, 3);
        $linhas[2] = rtrim($linhas[2], '. ') . '…';

        return $linhas;
    }

    /**
     * @param Foto $foto
     * @return string|null
     */
    private function caminhoLocal(Foto $foto)
    {
        $arquivo = ltrim((string) $foto->nm_path_fot, '/');
        $pastas = ['detalhes-principal'];
        if (!empty(optional($foto->tipo)->dc_path_tfp)) {
            array_unshift($pastas, trim($foto->tipo->dc_path_tfp, '/'));
        }

        foreach ($pastas as $pasta) {
            $caminho = public_path('img/trilhas/' . $pasta . '/' . $arquivo);
            if (is_file($caminho)) {
                return $caminho;
            }
        }

        return null;
    }

    /**
     * @param Client $client
     * @param string $accountId
     * @param string $accessToken
     * @param array $conteudo
     * @return string
     */
    private function criarContainer(Client $client, $accountId, $accessToken, array $conteudo)
    {
        $response = $client->post($accountId . '/media', [
            'form_params' => [
                'image_url' => $conteudo['imagem'],
                'media_type' => 'STORIES',
                'access_token' => $accessToken,
            ],
        ]);

        $payload = json_decode($response->getBody()->getContents(), true);
        $id = Arr::get($payload, 'id');
        if (!$id) {
            throw new \RuntimeException('A API não devolveu o container da imagem.');
        }

        return $id;
    }

    /**
     * @param Client $client
     * @param string $containerId
     * @param string $accessToken
     * @return void
     */
    private function aguardarContainer(Client $client, $containerId, $accessToken)
    {
        for ($tentativa = 0; $tentativa < 10; $tentativa++) {
            $response = $client->get($containerId, [
                'query' => [
                    'fields' => 'status_code',
                    'access_token' => $accessToken,
                ],
            ]);
            $payload = json_decode($response->getBody()->getContents(), true);
            $status = Arr::get($payload, 'status_code');

            if ($status === 'FINISHED') {
                return;
            }

            if ($status === 'ERROR' || $status === 'EXPIRED') {
                throw new \RuntimeException('O Instagram recusou a imagem (status ' . $status . ').');
            }

            sleep(2);
        }

        throw new \RuntimeException('A imagem não ficou pronta a tempo para publicação.');
    }

    /**
     * @param Client $client
     * @param string $accountId
     * @param string $accessToken
     * @param string $containerId
     * @return string
     */
    private function publicarContainer(Client $client, $accountId, $accessToken, $containerId)
    {
        $response = $client->post($accountId . '/media_publish', [
            'form_params' => [
                'creation_id' => $containerId,
                'access_token' => $accessToken,
            ],
        ]);

        $payload = json_decode($response->getBody()->getContents(), true);
        $id = Arr::get($payload, 'id');
        if (!$id) {
            throw new \RuntimeException('A API não devolveu o id da publicação.');
        }

        return $id;
    }

    /**
     * @param Client $client
     * @param string $mediaId
     * @param string $accessToken
     * @return string|null
     */
    private function buscarPermalink(Client $client, $mediaId, $accessToken)
    {
        try {
            $response = $client->get($mediaId, [
                'query' => [
                    'fields' => 'permalink',
                    'access_token' => $accessToken,
                ],
            ]);
            $payload = json_decode($response->getBody()->getContents(), true);

            return Arr::get($payload, 'permalink');
        } catch (\Throwable $exception) {
            return null;
        }
    }

    /**
     * @param \Throwable $exception
     * @return string
     */
    private function mensagemErro(\Throwable $exception)
    {
        if (method_exists($exception, 'getResponse') && $exception->getResponse()) {
            $body = (string) $exception->getResponse()->getBody();
            $json = json_decode($body, true);
            if (!empty($json['error']['message'])) {
                return $json['error']['message'];
            }

            return Str::limit($body, 1000, '');
        }

        return $exception->getMessage();
    }
}

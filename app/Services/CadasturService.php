<?php

namespace App\Services;

use App\Exceptions\CadasturIndisponivelException;
use App\Guia;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class CadasturService
{
    const CONFERIDO = 'conferido';
    const VENCIDO = 'vencido';
    const IRREGULAR = 'irregular';
    const NAO_ENCONTRADO = 'nao_encontrado';
    const DIVERGENTE = 'divergente';
    const PENDENTE = 'pendente';

    const SITUACOES_OFICIAIS = [
        'Regular',
        'Vencido',
        'Cancelado',
        'Indeferido',
        'Em Implantação',
        'Suspenso de Ofício',
        'Suspenso a Pedido',
    ];

    const CACHE_TOKEN = 'cadastur.api.token';

    private $http;

    public function __construct(Client $http = null)
    {
        $this->http = $http ?: new Client(['timeout' => (int) config('services.cadastur.timeout', 15)]);
    }

    public function habilitado()
    {
        return config('services.cadastur.client_id')
            && config('services.cadastur.client_secret')
            && config('services.cadastur.cpf_usuario');
    }

    public static function somenteDigitos($numero)
    {
        return preg_replace('/\D/', '', (string) $numero);
    }

    /**
     * Consulta a API do Cadastur. Retorna null quando o certificado não existe na base.
     *
     * @throws CadasturIndisponivelException
     */
    public function consultar($numero)
    {
        $digitos = self::somenteDigitos($numero);

        if ($digitos === '') {
            return null;
        }

        $endpoint = strlen($digitos) === 14
            ? 'pessoa-juridica/obter-dados-atividade-pj'
            : 'guia-pessoa/obter-pessoa';

        try {
            $resposta = $this->http->post(rtrim(config('services.cadastur.base_url'), '/') . '/' . $endpoint, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->token(),
                    'x-cpf-usuario' => self::somenteDigitos(config('services.cadastur.cpf_usuario')),
                    'Accept' => 'application/json',
                ],
                'json' => ['cpfCnpj' => $digitos],
                'http_errors' => false,
            ]);
        } catch (GuzzleException $e) {
            throw new CadasturIndisponivelException('Falha de conexão com a API do Cadastur: ' . $e->getMessage(), 0, $e);
        }

        $status = $resposta->getStatusCode();

        if (in_array($status, [204, 404, 412], true)) {
            return null;
        }

        if ($status === 401) {
            Cache::forget(self::CACHE_TOKEN);
        }

        if ($status !== 200) {
            throw new CadasturIndisponivelException("API do Cadastur respondeu HTTP {$status}.");
        }

        $corpo = json_decode((string) $resposta->getBody(), true);

        if (is_array($corpo) && isset($corpo[0])) {
            $corpo = $corpo[0];
        }

        if (empty($corpo) || !is_array($corpo)) {
            return null;
        }

        return $this->normalizar($corpo);
    }

    /**
     * Consulta a API e grava o resultado no guia.
     *
     * @throws CadasturIndisponivelException
     */
    public function verificar(Guia $guia)
    {
        if (self::somenteDigitos($guia->nu_cadastur_gui) === '') {
            return $this->reiniciar($guia);
        }

        return $this->aplicar($guia, $this->consultar($guia->nu_cadastur_gui));
    }

    public function aplicar(Guia $guia, $dados)
    {
        $guia->dt_cadastur_consulta_gui = now();

        if ($dados === null) {
            $guia->ds_cadastur_situacao_oficial_gui = null;
            $guia->nm_cadastur_titular_gui = null;
            $guia->nm_cadastur_categoria_gui = null;
            $guia->dt_cadastur_emissao_gui = null;
            $guia->dt_cadastur_validade_gui = null;
            $guia->fl_cadastur_nome_confere_gui = null;
        } else {
            $titular = isset($dados['titulares'][0]) ? Str::limit($dados['titulares'][0], 150, '') : null;
            $mesmoTitularConfirmado = $titular !== null
                && $guia->nm_cadastur_titular_gui === $titular
                && $guia->fl_cadastur_nome_confere_gui === true;

            if ($mesmoTitularConfirmado) {
                $nomeConfere = true;
            } elseif (empty($dados['titulares'])) {
                $nomeConfere = null;
            } else {
                $nomeConfere = $this->nomeConfere($dados['titulares'], [$guia->nm_guia_gui, optional($guia->user)->name]);
            }

            $guia->ds_cadastur_situacao_oficial_gui = $dados['situacao'] !== null ? Str::limit((string) $dados['situacao'], 40, '') : null;
            $guia->nm_cadastur_titular_gui = $titular;
            $guia->nm_cadastur_categoria_gui = $dados['categoria'];
            $guia->dt_cadastur_emissao_gui = $dados['emissao'];
            $guia->dt_cadastur_validade_gui = $dados['validade'];
            $guia->fl_cadastur_nome_confere_gui = $nomeConfere;
        }

        $guia->sg_cadastur_situacao_gui = $this->classificar($guia);
        $guia->save();

        return $guia;
    }

    public function aplicarManual(Guia $guia, $situacaoOficial, $validade, $titularConfere)
    {
        $guia->ds_cadastur_situacao_oficial_gui = $situacaoOficial ?: null;
        $guia->dt_cadastur_validade_gui = $validade ? Carbon::parse($validade)->startOfDay() : null;
        $guia->fl_cadastur_nome_confere_gui = (bool) $titularConfere;
        $guia->dt_cadastur_consulta_gui = now();
        $guia->sg_cadastur_situacao_gui = $this->classificar($guia);
        $guia->save();

        return $guia;
    }

    public function reiniciar(Guia $guia)
    {
        $guia->sg_cadastur_situacao_gui = self::somenteDigitos($guia->nu_cadastur_gui) === '' ? null : self::PENDENTE;
        $guia->ds_cadastur_situacao_oficial_gui = null;
        $guia->nm_cadastur_titular_gui = null;
        $guia->nm_cadastur_categoria_gui = null;
        $guia->dt_cadastur_emissao_gui = null;
        $guia->dt_cadastur_validade_gui = null;
        $guia->dt_cadastur_consulta_gui = null;
        $guia->fl_cadastur_nome_confere_gui = null;
        $guia->dt_cadastur_aviso_validade_gui = null;
        $guia->save();

        return $guia;
    }

    public function classificar(Guia $guia)
    {
        $oficial = Str::lower(Str::ascii(trim((string) $guia->ds_cadastur_situacao_oficial_gui)));

        if ($oficial === '') {
            return self::NAO_ENCONTRADO;
        }

        if ($guia->fl_cadastur_nome_confere_gui === false) {
            return self::DIVERGENTE;
        }

        if ($oficial === 'em implantacao') {
            return self::PENDENTE;
        }

        if ($oficial === 'regular') {
            $validade = $guia->dt_cadastur_validade_gui;

            if (!$validade) {
                return self::PENDENTE;
            }

            return $validade->lt(today()) ? self::VENCIDO : self::CONFERIDO;
        }

        if ($oficial === 'vencido') {
            return self::VENCIDO;
        }

        return self::IRREGULAR;
    }

    public function marcarVencidos()
    {
        return Guia::where('sg_cadastur_situacao_gui', self::CONFERIDO)
            ->whereDate('dt_cadastur_validade_gui', '<', today()->toDateString())
            ->update(['sg_cadastur_situacao_gui' => self::VENCIDO]);
    }

    public function nomeConfere(array $titulares, array $candidatos)
    {
        foreach ($titulares as $titular) {
            $tokensTitular = self::tokens($titular);

            if (empty($tokensTitular)) {
                continue;
            }

            foreach ($candidatos as $candidato) {
                $tokensCandidato = self::tokens($candidato);

                if (empty($tokensCandidato)) {
                    continue;
                }

                if (self::extremosContidos($tokensTitular, $tokensCandidato)
                    || self::extremosContidos($tokensCandidato, $tokensTitular)) {
                    return true;
                }
            }
        }

        return false;
    }

    public static function tokens($nome)
    {
        $ignorar = ['da', 'das', 'de', 'do', 'dos', 'e', 'ltda', 'me', 'mei', 'epp', 'eireli', 'sa'];
        $partes = preg_split('/[^a-z0-9]+/', Str::lower(Str::ascii((string) $nome)), -1, PREG_SPLIT_NO_EMPTY);

        return array_values(array_filter($partes, function ($parte) use ($ignorar) {
            return strlen($parte) > 1 && !in_array($parte, $ignorar, true);
        }));
    }

    public static function data($valor)
    {
        if (empty($valor)) {
            return null;
        }

        $valor = trim((string) $valor);

        foreach (['d/m/Y', 'Ymd', 'Y-m-d'] as $formato) {
            $data = \DateTime::createFromFormat('!' . $formato, $valor);
            $erros = \DateTime::getLastErrors();

            if ($data && (!$erros || ($erros['warning_count'] === 0 && $erros['error_count'] === 0))) {
                return Carbon::instance($data)->startOfDay();
            }
        }

        try {
            return Carbon::parse($valor)->startOfDay();
        } catch (\Exception $e) {
            return null;
        }
    }

    private static function extremosContidos(array $origem, array $destino)
    {
        return in_array(reset($origem), $destino, true) && in_array(end($origem), $destino, true);
    }

    private function normalizar(array $corpo)
    {
        $campos = array_change_key_case($corpo, CASE_LOWER);

        $valor = function (array $chaves) use ($campos) {
            foreach ($chaves as $chave) {
                if (isset($campos[$chave]) && $campos[$chave] !== '') {
                    return $campos[$chave];
                }
            }

            return null;
        };

        $titulares = array_values(array_filter([
            $valor(['nome']),
            $valor(['nomerazaosocial']),
            $valor(['nomefantasia']),
        ], 'is_string'));

        return [
            'situacao' => $valor(['situacaocadastral']),
            'titulares' => $titulares,
            'categoria' => $this->categoria($campos),
            'emissao' => self::data($valor(['datadeemissao', 'dataemissao', 'datademaissao'])),
            'validade' => self::data($valor(['datadevalidade', 'datavalidade'])),
        ];
    }

    private function categoria(array $campos)
    {
        if (!empty($campos['categoriaguias']) && is_array($campos['categoriaguias'])) {
            $nomes = [];

            foreach ($campos['categoriaguias'] as $item) {
                $nomes[] = is_array($item) ? data_get($item, 'tipoCategoriaGuia.noCategoriaGuia') : $item;
            }

            $nomes = array_unique(array_filter($nomes, 'is_string'));

            return $nomes ? Str::limit(implode(', ', $nomes), 150, '') : null;
        }

        return isset($campos['noatividade']) ? Str::limit((string) $campos['noatividade'], 150, '') : null;
    }

    private function token()
    {
        $token = Cache::get(self::CACHE_TOKEN);

        if ($token) {
            return $token;
        }

        try {
            $resposta = $this->http->post(config('services.cadastur.token_url'), [
                'auth' => [config('services.cadastur.client_id'), config('services.cadastur.client_secret')],
                'form_params' => ['grant_type' => 'client_credentials'],
                'http_errors' => false,
            ]);
        } catch (GuzzleException $e) {
            throw new CadasturIndisponivelException('Falha ao obter token do Conecta gov.br: ' . $e->getMessage(), 0, $e);
        }

        $corpo = json_decode((string) $resposta->getBody(), true);

        if ($resposta->getStatusCode() !== 200 || empty($corpo['access_token'])) {
            throw new CadasturIndisponivelException('Conecta gov.br recusou o token (HTTP ' . $resposta->getStatusCode() . ').');
        }

        $expiraEm = isset($corpo['expires_in']) ? (int) $corpo['expires_in'] : 3600;
        Cache::put(self::CACHE_TOKEN, $corpo['access_token'], max(60, $expiraEm - 60));

        return $corpo['access_token'];
    }
}

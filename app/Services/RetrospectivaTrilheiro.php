<?php

namespace App\Services;

use App\EventoTrilheiro;
use App\GuiaFavorito;
use App\Trilheiro;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;

class RetrospectivaTrilheiro
{
    /**
     * História do ano para a tela do trilheiro, sem caminhos de arquivo.
     *
     * @param Trilheiro $trilheiro
     * @param int|null $ano
     * @return array
     */
    public function apresentar(Trilheiro $trilheiro, $ano = null)
    {
        $historia = $this->historia($trilheiro, $ano);
        $historia['slides'] = array_map(function ($slide) {
            unset($slide['foto']);

            return $slide;
        }, $historia['slides']);

        return $historia;
    }

    /**
     * JPEG 1080×1920 de um slide, pronto para story.
     *
     * @param Trilheiro $trilheiro
     * @param string $slideId
     * @param int|null $ano
     * @return \Intervention\Image\Image|null
     */
    public function imagem(Trilheiro $trilheiro, $slideId, $ano = null)
    {
        $historia = $this->historia($trilheiro, $ano);

        foreach ($historia['slides'] as $slide) {
            if ($slide['id'] === $slideId) {
                return $this->desenhar($slide, $historia['ano']);
            }
        }

        return null;
    }

    /**
     * @param Trilheiro $trilheiro
     * @param int|null $ano
     * @return array
     */
    private function historia(Trilheiro $trilheiro, $ano = null)
    {
        $ano = $ano ? (int) $ano : (int) date('Y');
        $primeiro = $this->primeiroNome($trilheiro);
        $eventos = $this->eventosDoAno($trilheiro, $ano);
        $marcadas = $this->trilhasMarcadas($trilheiro);
        $trilhasDoAno = $this->trilhasDosEventos($eventos);
        $slidesDeTrilha = $trilhasDoAno->isNotEmpty() ? $trilhasDoAno : $marcadas;
        $origemTrilha = $trilhasDoAno->isNotEmpty() ? 'ano' : 'perfil';
        $basePercurso = $trilhasDoAno->isNotEmpty() ? $trilhasDoAno : $marcadas;
        $percurso = $this->somarPercurso($basePercurso);
        $cidades = $this->cidades($eventos, $marcadas);
        $guia = $this->guiaDoAno($eventos, $trilheiro);

        $slides = [];
        $slides[] = $this->slideCapa($primeiro, $ano, $eventos->count(), $marcadas->count());
        $slides[] = $this->slideNumeros($ano, $eventos->count(), $marcadas->count(), $cidades, $percurso);
        $slides[] = $this->slidePercurso($ano, $percurso, $trilhasDoAno->isNotEmpty());

        foreach ($slidesDeTrilha as $trilha) {
            $vezes = $this->vezesNaTrilha($eventos, $trilha->id_trilha_tri);
            $slides[] = $this->slideTrilha($trilha, $ano, $origemTrilha, $vezes);
        }

        $slides[] = $this->slideGuia($guia, $ano);
        $slides[] = $this->slideFim($primeiro, $ano, $eventos->count() + $marcadas->count() > 0);

        return [
            'ano' => $ano,
            'nome' => $primeiro,
            'slides' => $slides,
        ];
    }

    private function eventosDoAno(Trilheiro $trilheiro, $ano)
    {
        return $trilheiro->evento()
            ->whereNull('evento_trilheiro_evt.deleted_at')
            ->where(function ($status) {
                $status->whereNull('evento_trilheiro_evt.st_inscricao_evt')
                    ->orWhereNotIn('evento_trilheiro_evt.st_inscricao_evt', [
                        EventoTrilheiro::RECUSADO,
                        EventoTrilheiro::CANCELADO,
                    ]);
            })
            ->whereYear('dt_realizacao_eve', $ano)
            ->whereDate('dt_realizacao_eve', '<=', Carbon::today()->toDateString())
            ->where(function ($cancelado) {
                $cancelado->where('fl_cancelado_eve', false)->orWhereNull('fl_cancelado_eve');
            })
            ->with(['guia', 'local', 'trilha.detalhes', 'trilha.cidade', 'trilha.nivel', 'trilha.foto.tipo'])
            ->orderBy('dt_realizacao_eve')
            ->get();
    }

    private function trilhasMarcadas(Trilheiro $trilheiro)
    {
        return $trilheiro->trilhas()
            ->with(['detalhes', 'cidade', 'nivel', 'foto.tipo'])
            ->orderBy('nm_trilha_tri')
            ->get();
    }

    private function trilhasDosEventos($eventos)
    {
        return $eventos
            ->pluck('trilha')
            ->filter()
            ->unique('id_trilha_tri')
            ->sortBy('nm_trilha_tri')
            ->values();
    }

    private function vezesNaTrilha($eventos, $trilhaId)
    {
        return $eventos->filter(function ($evento) use ($trilhaId) {
            return (int) $evento->id_trilha_tri === (int) $trilhaId;
        })->count();
    }

    private function somarPercurso($trilhas)
    {
        $km = 0.0;
        $subida = 0.0;
        $temKm = false;
        $temSubida = false;

        foreach ($trilhas as $trilha) {
            $detalhe = $trilha->detalhes;
            if ($detalhe && is_numeric($detalhe->nu_distancia_trd)) {
                $km += (float) $detalhe->nu_distancia_trd;
                $temKm = true;
            }
            if ($detalhe && is_numeric($detalhe->nu_altitude_trd)) {
                $subida += (float) $detalhe->nu_altitude_trd;
                $temSubida = true;
            }
        }

        return [
            'km' => $temKm ? $km : null,
            'subida' => $temSubida ? $subida : null,
            'trilhas' => $trilhas->count(),
        ];
    }

    private function cidades($eventos, $marcadas)
    {
        $nomes = [];

        foreach ($eventos as $evento) {
            $cidade = optional($evento->local)->nm_cidade_cde ?: optional(optional($evento->trilha)->cidade)->nm_cidade_cde;
            if ($cidade) {
                $nomes[$cidade] = true;
            }
        }

        foreach ($marcadas as $trilha) {
            $cidade = optional($trilha->cidade)->nm_cidade_cde;
            if ($cidade) {
                $nomes[$cidade] = true;
            }
        }

        return count($nomes);
    }

    private function guiaDoAno($eventos, Trilheiro $trilheiro)
    {
        $contagem = [];

        foreach ($eventos as $evento) {
            $guia = $evento->guia;
            if (!$guia) {
                continue;
            }
            $id = $guia->id_guia_gui;
            if (!isset($contagem[$id])) {
                $contagem[$id] = ['guia' => $guia, 'passeios' => 0];
            }
            $contagem[$id]['passeios']++;
        }

        if ($contagem) {
            uasort($contagem, function ($a, $b) {
                return $b['passeios'] <=> $a['passeios'];
            });
            $escolhido = reset($contagem);

            return [
                'nome' => $escolhido['guia']->nm_guia_gui,
                'passeios' => $escolhido['passeios'],
                'origem' => 'ano',
            ];
        }

        $favorito = GuiaFavorito::with('guia')
            ->where('id_trilheiro_tri', $trilheiro->id_trilheiro_tri)
            ->latest()
            ->first();

        if ($favorito && $favorito->guia) {
            return [
                'nome' => $favorito->guia->nm_guia_gui,
                'passeios' => 0,
                'origem' => 'favorito',
            ];
        }

        return null;
    }

    private function slideCapa($primeiro, $ano, $passeios, $marcadas)
    {
        if ($passeios > 0) {
            $linhas = ['Este é o retrato dos passeios que você fez em '.$ano.'.'];
        } elseif ($marcadas > 0) {
            $linhas = ['Você ainda não registrou passeio em '.$ano.'. As trilhas do seu perfil entram neste retrato.'];
        } else {
            $linhas = ['Quando você registrar um passeio ou marcar uma trilha, a história aparece aqui.'];
        }

        return [
            'id' => 'capa',
            'rotulo' => 'Capa',
            'kicker' => 'Retrospectiva '.$ano,
            'titulo' => $primeiro,
            'linhas' => $linhas,
            'destaques' => [],
            'foto' => null,
        ];
    }

    private function slideNumeros($ano, $passeios, $marcadas, $cidades, array $percurso)
    {
        return [
            'id' => 'numeros',
            'rotulo' => 'Números',
            'kicker' => 'Retrospectiva '.$ano,
            'titulo' => 'Seus números',
            'linhas' => ['O que já está registrado na sua conta.'],
            'destaques' => [
                ['valor' => (string) $passeios, 'rotulo' => $passeios === 1 ? 'passeio em '.$ano : 'passeios em '.$ano],
                ['valor' => (string) $marcadas, 'rotulo' => $marcadas === 1 ? 'trilha no perfil' : 'trilhas no perfil'],
                ['valor' => (string) $cidades, 'rotulo' => $cidades === 1 ? 'cidade' : 'cidades'],
                ['valor' => $percurso['km'] === null ? '—' : $this->numero($percurso['km']).' km', 'rotulo' => 'no percurso somado'],
            ],
            'foto' => null,
        ];
    }

    private function slidePercurso($ano, array $percurso, $veioDosPasseios)
    {
        $linhas = $veioDosPasseios
            ? ['Soma das trilhas vinculadas aos passeios de '.$ano.'.']
            : ['Soma das trilhas marcadas no seu perfil. Os passeios do ano ainda não têm trilha vinculada.'];

        if ($percurso['trilhas'] === 0) {
            $linhas = ['Ainda não há trilha com distância ou subida para somar.'];
        }

        return [
            'id' => 'percurso',
            'rotulo' => 'Percurso',
            'kicker' => 'Retrospectiva '.$ano,
            'titulo' => 'Percurso',
            'linhas' => $linhas,
            'destaques' => [
                ['valor' => $percurso['km'] === null ? '—' : $this->numero($percurso['km']).' km', 'rotulo' => 'de trilha'],
                ['valor' => $percurso['subida'] === null ? '—' : $this->numero($percurso['subida'], 0).' m', 'rotulo' => 'de subida'],
            ],
            'foto' => null,
        ];
    }

    private function slideTrilha($trilha, $ano, $origem, $vezes)
    {
        $linhas = [];
        $cidade = optional($trilha->cidade)->nm_cidade_cde;
        $nivel = optional($trilha->nivel)->dc_nivel_niv;
        $detalhe = $trilha->detalhes;

        if ($cidade) {
            $linhas[] = $cidade;
        }
        if ($nivel) {
            $linhas[] = 'Nível '.$nivel;
        }
        if ($detalhe && is_numeric($detalhe->nu_distancia_trd)) {
            $linha = $this->numero($detalhe->nu_distancia_trd).' km';
            if (is_numeric($detalhe->nu_altitude_trd)) {
                $linha .= ' · '.$this->numero($detalhe->nu_altitude_trd, 0).' m de subida';
            }
            $linhas[] = $linha;
        }
        if ($origem === 'ano' && $vezes > 1) {
            $linhas[] = 'Você foi '.$vezes.' vezes em '.$ano.'.';
        } elseif ($origem === 'perfil') {
            $linhas[] = 'Marcada no seu perfil.';
        }

        if (!$linhas) {
            $linhas[] = $origem === 'ano' ? 'Passeio de '.$ano.'.' : 'No seu perfil.';
        }

        return [
            'id' => 'trilha-'.$trilha->id_trilha_tri,
            'rotulo' => $trilha->nm_trilha_tri,
            'kicker' => $origem === 'ano' ? 'Passeio em '.$ano : 'No seu perfil',
            'titulo' => $trilha->nm_trilha_tri,
            'linhas' => $linhas,
            'destaques' => [],
            'foto' => $this->fotoTrilha($trilha),
        ];
    }

    private function slideGuia($guia, $ano)
    {
        if (!$guia) {
            return [
                'id' => 'guia',
                'rotulo' => 'Guia',
                'kicker' => 'Retrospectiva '.$ano,
                'titulo' => 'Seu guia',
                'linhas' => ['Nenhum guia acompanhou um passeio seu em '.$ano.', e não há favorito marcado.'],
                'destaques' => [],
                'foto' => null,
            ];
        }

        if ($guia['origem'] === 'favorito') {
            $linhas = [$guia['nome'].' está nos seus favoritos. Ainda não há passeio junto em '.$ano.'.'];
            $titulo = $guia['nome'];
        } else {
            $vezes = $guia['passeios'];
            $linhas = [
                $vezes === 1
                    ? 'Vocês caminharam juntos em 1 passeio de '.$ano.'.'
                    : 'Vocês caminharam juntos em '.$vezes.' passeios de '.$ano.'.',
            ];
            $titulo = $guia['nome'];
        }

        return [
            'id' => 'guia',
            'rotulo' => 'Guia',
            'kicker' => $guia['origem'] === 'ano' ? 'Guia do ano' : 'Guia favorito',
            'titulo' => $titulo,
            'linhas' => $linhas,
            'destaques' => [],
            'foto' => null,
        ];
    }

    private function slideFim($primeiro, $ano, $temRegistro)
    {
        $linhas = $temRegistro
            ? ['O que você registrar daqui para a frente entra no próximo retrato.']
            : ['Marque as trilhas que você já fez e registre presença nos passeios.'];

        return [
            'id' => 'fim',
            'rotulo' => 'Fechamento',
            'kicker' => 'Retrospectiva '.$ano,
            'titulo' => 'Até a próxima, '.$primeiro,
            'linhas' => $linhas,
            'destaques' => [],
            'foto' => null,
        ];
    }

    private function desenhar(array $slide, $ano)
    {
        $imagem = Image::canvas(1080, 1920, '#14261e');
        $this->fundo($imagem, isset($slide['foto']) ? $slide['foto'] : null);

        $fonte = $this->fonte(false);
        $fonteForte = $this->fonte(true);
        $y = 150;

        $imagem->rectangle(440, 96, 640, 108, function ($draw) {
            $draw->background('#e07826');
        });

        $y = $this->texto($imagem, [$slide['kicker']], $y, $fonte, 32, '#f0b27a', 48);
        $y += 28;
        $titulos = $this->quebrar($slide['titulo'], $fonteForte, 68, 920);
        $titulos = array_slice($titulos, 0, 4);
        $y = $this->texto($imagem, $titulos, $y, $fonteForte, 68, '#ffffff', 82);
        $y += 36;

        foreach ($slide['linhas'] as $linha) {
            $quebrada = $this->quebrar($linha, $fonte, 34, 900);
            $y = $this->texto($imagem, $quebrada, $y, $fonte, 34, '#e7f0ea', 48);
            $y += 12;
        }

        $y += 20;
        foreach ($slide['destaques'] as $item) {
            if ($y > 1680) {
                break;
            }
            $y = $this->texto($imagem, [$item['valor']], $y, $fonteForte, 64, '#ffffff', 74);
            $y = $this->texto($imagem, [$item['rotulo']], $y, $fonte, 30, '#f0b27a', 44);
            $y += 18;
        }

        $this->texto($imagem, ['Trilhas em SC · '.$ano], 1800, $fonte, 28, '#d5e2da', 36);

        return $imagem->encode('jpg', 85);
    }

    private function fundo($imagem, $foto)
    {
        if (!$foto || !is_file($foto)) {
            return;
        }

        try {
            $imagem->insert(Image::make($foto)->fit(1080, 1920));
            $velo = Image::canvas(1080, 1920, '#06140f');
            $velo->opacity(62);
            $imagem->insert($velo);
        } catch (\Exception $e) {
            // A foto da trilha fica de fora e o slide segue no fundo liso.
        }
    }

    private function texto($imagem, array $linhas, $y, $fonte, $tamanho, $cor, $passo)
    {
        foreach ($linhas as $linha) {
            $imagem->text($linha, 540, $y, function ($font) use ($fonte, $tamanho, $cor) {
                $font->file($fonte);
                $font->size($tamanho);
                $font->color($cor);
                $font->align('center');
                $font->valign('top');
            });
            $y += $passo;
        }

        return $y;
    }

    private function quebrar($texto, $fonte, $tamanho, $largura)
    {
        $palavras = preg_split('/\s+/u', trim((string) $texto), -1, PREG_SPLIT_NO_EMPTY);
        if (!$palavras) {
            return [];
        }

        $linhas = [];
        $atual = '';

        foreach ($palavras as $palavra) {
            $tentativa = $atual === '' ? $palavra : $atual.' '.$palavra;
            $caixa = imagettfbbox($tamanho, 0, $fonte, $tentativa);
            $ocupado = abs($caixa[2] - $caixa[0]);

            if ($ocupado > $largura && $atual !== '') {
                $linhas[] = $atual;
                $atual = $palavra;
            } else {
                $atual = $tentativa;
            }
        }

        if ($atual !== '') {
            $linhas[] = $atual;
        }

        return $linhas;
    }

    private function fotoTrilha($trilha)
    {
        $fotos = $trilha->relationLoaded('foto') ? $trilha->foto : $trilha->foto()->with('tipo')->get();

        foreach ($fotos as $foto) {
            $caminho = $this->caminhoFoto($foto);
            if ($caminho) {
                return $caminho;
            }
        }

        return null;
    }

    private function caminhoFoto($foto)
    {
        $arquivo = ltrim((string) $foto->nm_path_fot, '/');
        if ($arquivo === '') {
            return null;
        }

        $pastas = ['detalhes-principal'];
        if (!empty(optional($foto->tipo)->dc_path_tfp)) {
            array_unshift($pastas, trim($foto->tipo->dc_path_tfp, '/'));
        }

        foreach ($pastas as $pasta) {
            $caminho = public_path('img/trilhas/'.$pasta.'/'.$arquivo);
            if (is_file($caminho)) {
                return $caminho;
            }
        }

        return null;
    }

    private function primeiroNome(Trilheiro $trilheiro)
    {
        $nome = trim((string) $trilheiro->nm_trilheiro_tri);
        if ($nome === '') {
            $nome = trim((string) optional($trilheiro->user)->name);
        }

        $partes = preg_split('/\s+/u', $nome, -1, PREG_SPLIT_NO_EMPTY);

        return $partes ? $partes[0] : 'Trilheiro';
    }

    private function numero($valor, $casas = null)
    {
        $numero = (float) $valor;
        if ($casas === null) {
            $casas = abs($numero - round($numero)) < 0.05 ? 0 : 1;
        }

        return number_format($numero, $casas, ',', '.');
    }

    private function fonte($forte)
    {
        $arquivo = $forte ? 'DejaVuSans-Bold.ttf' : 'DejaVuSans.ttf';
        $caminho = '/usr/share/fonts/truetype/dejavu/'.$arquivo;

        if (!is_file($caminho)) {
            throw new \RuntimeException('Fonte não encontrada para a retrospectiva: '.$arquivo);
        }

        return $caminho;
    }
}

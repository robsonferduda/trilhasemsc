<?php

namespace App\Services;

use App\Guia;
use App\GuiaAviso;
use App\Mail\GuiaAcao;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AvisoAcaoGuia
{
    const PUBLICAR = 'publicar';
    const PRIMEIRO = 'primeiro';
    const VOLTAR = 'voltar';
    const PAINEL = 'painel';
    const ESPERA_DIAS = 30;

    public static function tipos()
    {
        return [self::PUBLICAR, self::PRIMEIRO, self::VOLTAR, self::PAINEL];
    }

    public static function assunto($tipo)
    {
        $conteudo = self::conteudo($tipo, new Guia(['nm_guia_gui' => 'Guia']), 2);

        return $conteudo ? $conteudo['assunto'] : '';
    }

    public static function conteudo($tipo, Guia $guia, $visitas)
    {
        $nome = self::primeiroNome($guia);
        $painel = url('guia-e-condutores/privado/painel');
        $novo = url('guia-e-condutores/privado/evento/novo');

        if ($tipo === self::PUBLICAR) {
            $visitas = (int) $visitas;
            $abertura = $visitas === 1
                ? 'No último mês, 1 pessoa abriu seu perfil no Trilhas em SC.'
                : 'No último mês, '.$visitas.' pessoas abriram seu perfil no Trilhas em SC.';

            return [
                'assunto' => 'Pessoas visitaram seu perfil no Trilhas em SC',
                'paragrafos' => [
                    'Olá, '.$nome.'.',
                    $abertura.' Você ainda não tem um passeio cadastrado.',
                    'Publique a próxima data. Quem marcou você como favorito recebe um aviso quando o passeio é salvo. A vaga só fecha depois da confirmação do pagamento.',
                ],
                'botao' => 'Publicar um passeio',
                'url' => $novo,
            ];
        }

        if ($tipo === self::PRIMEIRO) {
            return [
                'assunto' => 'Seu painel está pronto para o primeiro passeio',
                'paragrafos' => [
                    'Olá, '.$nome.'.',
                    'Você entrou no Trilhas em SC e ainda não cadastrou um passeio.',
                    'Informe a data, as vagas e o valor. A vaga só é ocupada depois que o pagamento é confirmado.',
                ],
                'botao' => 'Cadastrar o primeiro passeio',
                'url' => $novo,
            ];
        }

        if ($tipo === self::VOLTAR) {
            return [
                'assunto' => 'Sua agenda no Trilhas em SC pode ser atualizada',
                'paragrafos' => [
                    'Olá, '.$nome.'.',
                    'Faz um tempo que você não entra no painel. Seus passeios continuam no seu perfil.',
                    'Abra a agenda e lance a próxima data. Quem favoritou você é avisado quando um passeio novo é salvo.',
                ],
                'botao' => 'Abrir meu painel',
                'url' => $painel,
            ];
        }

        if ($tipo === self::PAINEL) {
            return [
                'assunto' => 'Seu painel de guia no Trilhas em SC',
                'paragrafos' => [
                    'Olá, '.$nome.'.',
                    'Você já cadastrou passeios no Trilhas em SC. O painel reúne a fila de interessados, as vagas confirmadas e os gastos de cada evento.',
                    'Entre com este e-mail para acompanhar.',
                ],
                'botao' => 'Entrar no painel',
                'url' => $painel,
            ];
        }

        return null;
    }

    public static function enviar($linhas, $adminId)
    {
        $enviados = 0;
        $pulados = 0;
        $semDestino = 0;
        $falhas = 0;

        foreach ($linhas as $linha) {
            if (empty($linha->codigo) || !self::conteudo($linha->codigo, $linha->guia, 0)) {
                continue;
            }

            $guia = $linha->guia;
            $email = trim((string) optional($guia->user)->email);
            if (!$guia->fl_ativo_gui || $email === '') {
                $semDestino++;
                continue;
            }

            if (self::avisadoRecentemente($guia->id_guia_gui, $linha->codigo)) {
                $pulados++;
                continue;
            }

            try {
                Mail::to($email, $guia->nm_guia_gui)->send(new GuiaAcao(
                    $guia,
                    self::conteudo($linha->codigo, $guia, $linha->visitas30)
                ));
                GuiaAviso::create([
                    'id_guia_gui' => $guia->id_guia_gui,
                    'sg_acao_gva' => $linha->codigo,
                    'id_user' => $adminId,
                ]);
                $enviados++;
            } catch (\Exception $e) {
                $falhas++;
                Log::error('Falha ao avisar guia', [
                    'guia' => $guia->id_guia_gui,
                    'acao' => $linha->codigo,
                    'erro' => $e->getMessage(),
                ]);
            }
        }

        return [
            'enviados' => $enviados,
            'pulados' => $pulados,
            'semDestino' => $semDestino,
            'falhas' => $falhas,
        ];
    }

    public static function avisadoRecentemente($idGuia, $tipo)
    {
        return GuiaAviso::where('id_guia_gui', $idGuia)
            ->where('sg_acao_gva', $tipo)
            ->where('created_at', '>=', now()->subDays(self::ESPERA_DIAS))
            ->exists();
    }

    private static function primeiroNome(Guia $guia)
    {
        $pedacos = preg_split('/\s+/', trim((string) $guia->nm_guia_gui));

        return ($pedacos && $pedacos[0] !== '') ? $pedacos[0] : 'guia';
    }
}

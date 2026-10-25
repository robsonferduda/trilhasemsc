<?php

namespace App\Http\Controllers;

use Auth;
use App\Evento;
use App\Trilha;
use App\Trilheiro;
use App\Cidade;
use App\Guia;
use App\Estatistica;
use App\EventoGasto;
use App\EventoTrilheiro;
use App\Mail\NovoEventoTrilheiroNotificacao;
use App\Services\AvisoFavoritosGuia;
use App\Mail\CancelamentoEventoTrilheiroNotificacao;
use Laracasts\Flash\Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class EventoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' =>
                            [
                                'index','detalhes'
                            ]
                        ]);
    }

    public function index()
    {
        $page_name = "Eventos e Trilhas em Santa Catarina";
        $eventos = Evento::with(['local', 'guia', 'trilha.detalhes'])->where('dt_realizacao_eve','>',date('Y-m-d H:i:s'))
            ->where('fl_ativo_eve',true)
            ->where('fl_cancelado_eve', false)
            ->where('fl_privado_eve', false)
            ->where(function($query) {
                $query->where('fl_privado_eve', false)
                      ->orWhereNull('fl_privado_eve');
            })
            ->orderBy('dt_realizacao_eve','ASC')->get();

        $cidades = Cidade::whereIn('cd_cidade_cde', Evento::select('cd_cidade_cde')->get())->orderBy('nm_cidade_cde')->select('cd_cidade_cde', 'nm_cidade_cde')->get();

        return view('eventos/index', ['page_name' => $page_name, 'eventos' => $eventos, 'cidades' => $cidades]);
    }

    public function listar()
    {
        $isAdmin = trim(Auth::user()->id_role) === 'ADMIN';

        if ($isAdmin) {
            $guia = null;
            $eventos = Evento::with(['eventoTrilheiros', 'trilheiros', 'gastos', 'guia', 'local', 'trilha.detalhes'])
                ->orderBy('dt_realizacao_eve','DESC')
                ->get();
        } else {
            $guia = Guia::where('id_user', Auth::user()->id)->first();
            $eventos = Evento::where('id_guia_gui', $guia->id_guia_gui)
                ->with(['eventoTrilheiros', 'trilheiros', 'gastos', 'local', 'trilha.detalhes'])
                ->orderBy('dt_realizacao_eve')
                ->get();
        }

        $this->enriquecerEventos($eventos);

        return view('admin/eventos/listar', compact('guia','eventos'));
    }

    public function eventos(Request $request)
    {
        if (Auth::guest() || trim(Auth::user()->id_role) !== 'GUIA') {
            return redirect('login');
        }

        $guia = Guia::where('id_user', Auth::user()->id)->first();
        if (!$guia) {
            return redirect('guia-e-condutores/privado/atualizar-cadastro');
        }

        $filtros = [
            'q' => trim((string) $request->get('q', '')),
            'quando' => in_array($request->get('quando'), ['proximos', 'realizados', 'todos'], true) ? $request->get('quando') : 'todos',
            'situacao' => in_array($request->get('situacao'), ['ativos', 'cancelados', 'todos'], true) ? $request->get('situacao') : 'ativos',
        ];

        $consulta = Evento::where('id_guia_gui', $guia->id_guia_gui)
            ->with(['eventoTrilheiros', 'trilheiros', 'gastos', 'local', 'trilha.detalhes']);

        if ($filtros['q'] !== '') {
            $consulta->where('nm_evento_eve', 'like', '%'.$filtros['q'].'%');
        }

        if ($filtros['situacao'] === 'ativos') {
            $consulta->where(function ($query) {
                $query->where('fl_cancelado_eve', false)->orWhereNull('fl_cancelado_eve');
            });
        } elseif ($filtros['situacao'] === 'cancelados') {
            $consulta->where('fl_cancelado_eve', true);
        }

        $hoje = now()->toDateString();
        if ($filtros['quando'] === 'proximos') {
            $consulta->whereDate('dt_realizacao_eve', '>=', $hoje);
        } elseif ($filtros['quando'] === 'realizados') {
            $consulta->whereDate('dt_realizacao_eve', '<', $hoje);
        }

        $eventos = $consulta->orderBy('dt_realizacao_eve', 'DESC')->get();

        $this->enriquecerEventos($eventos);

        return view('admin/eventos/listar', compact('guia','eventos','filtros'));
    }

    private function enriquecerEventos($eventos)
    {
        $ids = $eventos->pluck('id_evento_eve');
        $visualizacoes = Estatistica::whereIn('cd_monitoramento_esa', $ids)
            ->where('cd_tipo_monitoramento_tim', 2)
            ->groupBy('cd_monitoramento_esa')
            ->selectRaw('cd_monitoramento_esa, count(*) as total')
            ->pluck('total', 'cd_monitoramento_esa');

        // Adiciona contagem de participantes, vezes oferecido e visualizações para cada evento
        foreach ($eventos as $evento) {
            $evento->participantes_count = $evento->vagasOcupadas();

            // Contagem de visualizações da página do evento
            $evento->visualizacoes_count = $visualizacoes->get($evento->id_evento_eve, 0);

            // Verifica se este evento é original (sem id_unico_eve) ou clone (com id_unico_eve)
            if (empty($evento->id_unico_eve)) {
                // Evento original: conta ele mesmo (1) + todos os clones que apontam para ele
                $evento->vezes_oferecido = 1 + Evento::where('id_guia_gui', $evento->id_guia_gui)
                    ->where('id_unico_eve', $evento->id_evento_eve)
                    ->count();
            } else {
                // Evento clonado: conta o original + todos os clones (incluindo este)
                $evento->vezes_oferecido = 1 + Evento::where('id_guia_gui', $evento->id_guia_gui)
                    ->where('id_unico_eve', $evento->id_unico_eve)
                    ->where('id_evento_eve', '!=', $evento->id_evento_eve)
                    ->count();
            }
        }
    }

    public function visualizacoesPorDia($id)
    {
        $dados = Estatistica::where('cd_monitoramento_esa', $id)
            ->where('cd_tipo_monitoramento_tim', 2)
            ->selectRaw('DATE(created_at) as dia, count(*) as total')
            ->groupBy('dia')
            ->orderBy('dia', 'DESC')
            ->get();

        return response()->json($dados);
    }

    public function detalhes($slugOrId)
    {
        // Busca evento por slug ou ID (mantém compatibilidade)
        $evento = Evento::findBySlugOrId($slugOrId);
        
        // Se não encontrar, retorna 404
        if (!$evento) {
            abort(404, 'Evento não encontrado');
        }
        
        // Se foi acessado pelo ID antigo, redireciona para a URL com slug (SEO)
        if (is_numeric($slugOrId) && $evento->slug_eve) {
            return redirect()->route('evento.detalhes', ['slugOrId' => $evento->slug_eve], 301);
        }
        
        $page_name = "Eventos e Trilhas em Santa Catarina - ".$evento->nm_evento_eve;
        $cidades = Cidade::whereIn('cd_cidade_cde', Evento::select('cd_cidade_cde')->get())->orderBy('nm_cidade_cde')->select('cd_cidade_cde', 'nm_cidade_cde')->get();
        
        $dados = array('id_tipo_interacao_tin' => 5,
                       'id_guia_gui' => $evento->id_evento_eve);

        $usuario_logado = (Auth::user()) ? Auth::user()->id : null;

        if($usuario_logado){
            $trilheiro = Trilheiro::where('id_user', $usuario_logado)->first();
        }else{
            $trilheiro = null;
        }

        $estatistica = array('cd_usuario_usu' => $usuario_logado,
                            'cd_tipo_monitoramento_tim' => 2,
                            'cd_monitoramento_esa' => $evento->id_evento_eve);              

        Estatistica::create($estatistica);

        $evento->load(['eventoTrilheiros.trilheiro.user']);
        $inscricao = $trilheiro
            ? $evento->eventoTrilheiros->firstWhere('id_trilheiro_tri', $trilheiro->id_trilheiro_tri)
            : null;

        return view('eventos/detalhes', [
            'page_name' => $page_name,
            'evento' => $evento,
            'cidades' => $cidades,
            'trilheiro' => $trilheiro,
            'inscricao' => $inscricao,
        ]);
    }

    public function participar(Request $request, $id_evento)
    {
        $usuario = Auth::user();

        if (trim($usuario->id_role) === 'GUIA') {
            Flash::error('Apenas trilheiros podem participar de eventos.');
            return redirect('guia-e-condutores/privado/perfil');
        }

        $trilheiro = Trilheiro::where('id_user', $usuario->id)->first();
        $evento = Evento::where('id_evento_eve', $id_evento)->first();

        if (!$trilheiro) {
            Flash::error('Seu usuário não possui perfil de trilheiro. Complete seu cadastro para participar de eventos.');
            return redirect('cadastro/privado/escolher-perfil');
        }

        if (!$evento) {
            abort(404, 'Evento não encontrado');
        }

        if ($evento->fl_cancelado_eve) {
            Flash::error('Este evento foi cancelado.');
            return redirect($evento->url);
        }

        if ($evento->dt_realizacao_eve < date('Y-m-d')) {
            return redirect('trilheiro/privado/eventos/eu-fui/'.$id_evento);
        }

        $inscricao = EventoTrilheiro::withTrashed()
            ->where('id_evento_eve', $evento->id_evento_eve)
            ->where('id_trilheiro_tri', $trilheiro->id_trilheiro_tri)
            ->first();

        if ($inscricao && !$inscricao->trashed() && $inscricao->ativa() && count($inscricao->faltasParaConfirmar()) === 0 && !$request->isMethod('post')) {
            Flash::info('Seu interesse neste evento já está registrado. A vaga só fecha depois do pagamento.');
            return redirect('eventos/confirmacao/'.$id_evento);
        }

        $documentoAnterior = EventoTrilheiro::where('id_trilheiro_tri', $trilheiro->id_trilheiro_tri)
            ->whereNotNull('nr_documento_evt')
            ->orderBy('updated_at', 'desc')
            ->value('nr_documento_evt');

        if (!$request->isMethod('post')) {
            return view('eventos/candidatura', [
                'page_name' => 'Candidatura - '.$evento->nm_evento_eve,
                'evento' => $evento,
                'trilheiro' => $trilheiro,
                'documento' => old('nr_documento', ($inscricao && !$inscricao->trashed() ? $inscricao->nr_documento_evt : null) ?: $documentoAnterior),
                'pedeNome' => !EventoTrilheiro::nomeCompleto($trilheiro->nm_trilheiro_tri),
                'pedeNascimento' => empty($trilheiro->dt_nascimento),
            ]);
        }

        $documento = preg_replace('/\D/', '', (string) $request->nr_documento);
        $erros = [];

        if (!EventoTrilheiro::cpfValido($documento)) {
            $erros[] = 'Informe um CPF válido. Ele é usado no registro da inscrição e no seguro da atividade.';
        }

        $nome = trim((string) $trilheiro->nm_trilheiro_tri);
        if (!EventoTrilheiro::nomeCompleto($nome)) {
            $nome = trim((string) $request->nm_trilheiro_tri);
            if (!EventoTrilheiro::nomeCompleto($nome)) {
                $erros[] = 'Informe o nome completo, com nome e sobrenome.';
            }
        }

        $nascimento = $trilheiro->dt_nascimento;
        if (empty($nascimento)) {
            $informado = \DateTime::createFromFormat('d/m/Y', (string) $request->dt_nascimento);
            $dataValida = $informado && $informado->format('d/m/Y') === $request->dt_nascimento;
            if (!$dataValida || $informado->format('Y-m-d') > date('Y-m-d')) {
                $erros[] = 'Informe a data de nascimento.';
            } else {
                $nascimento = $informado->format('Y-m-d');
            }
        }

        if ($erros) {
            Flash::error(implode(' ', $erros));

            return redirect()->back()->withInput();
        }

        if ($nome !== $trilheiro->nm_trilheiro_tri || $nascimento !== $trilheiro->dt_nascimento) {
            $trilheiro->nm_trilheiro_tri = $nome;
            $trilheiro->dt_nascimento = $nascimento;
            $trilheiro->save();
        }

        $nova = !$inscricao || $inscricao->trashed() || !$inscricao->ativa();

        if (!$inscricao) {
            $inscricao = new EventoTrilheiro();
            $inscricao->id_evento_eve = $evento->id_evento_eve;
            $inscricao->id_trilheiro_tri = $trilheiro->id_trilheiro_tri;
        } elseif ($inscricao->trashed()) {
            $inscricao->restore();
        }

        if ($nova) {
            $inscricao->aplicarStatus(EventoTrilheiro::INTERESSADO);
        }

        $inscricao->nr_documento_evt = $documento;
        $inscricao->setRelation('trilheiro', $trilheiro);
        $inscricao->save();

        if ($nova) {
            Mail::send(new NovoEventoTrilheiroNotificacao($evento, $trilheiro, $usuario));
        }

        return redirect('eventos/confirmacao/'.$id_evento);
    }

    public function euFui($id_evento)
    {
        $usuario = Auth::user();

        if (trim($usuario->id_role) !== 'TRILHEIRO') {
            Flash::error('Apenas trilheiros podem marcar presença.');
            return redirect()->back();
        }

        $trilheiro = Trilheiro::where('id_user', $usuario->id)->first();
        $evento = Evento::where('id_evento_eve', $id_evento)->first();

        if (!$trilheiro) {
            Flash::error('Seu usuário não possui perfil de trilheiro. Complete seu cadastro para marcar presença.');
            return redirect('cadastro/privado/escolher-perfil');
        }

        if (!$evento) {
            abort(404, 'Evento não encontrado');
        }

        if ($evento->fl_cancelado_eve) {
            Flash::error('Este evento foi cancelado e não entra nas estatísticas.');
            return redirect()->back();
        }

        if ($evento->dt_realizacao_eve >= date('Y-m-d')) {
            return redirect('trilheiro/privado/eventos/participar/'.$id_evento);
        }

        $jaFoi = EventoTrilheiro::where('id_evento_eve', $evento->id_evento_eve)
            ->where('id_trilheiro_tri', $trilheiro->id_trilheiro_tri)
            ->exists();

        if (!$jaFoi) {
            $trilheiro->evento()->attach($evento->id_evento_eve);
        }

        Flash::success('Presença registrada. As estatísticas do guia foram atualizadas.');

        $guia = $evento->guia;
        $destino = ($guia && $guia->nm_instagram_gui)
            ? 'guia/trilhas-realizadas/'.$guia->nm_instagram_gui
            : 'guia/trilhas-realizadas/'.$evento->id_guia_gui;

        return redirect($destino);
    }

    public function confirmacao($id_evento)
    {
        $evento = Evento::where('id_evento_eve', $id_evento)->first();

        if (!$evento) {
            abort(404, 'Evento não encontrado');
        }

        $page_name = "Confirmação de Inscrição - " . $evento->nm_evento_eve;

        return view('eventos/confirmacao', [
            'page_name' => $page_name,
            'evento' => $evento,
            'podeReenviarEmail' => $this->trilheiroInscritoNoEvento($evento) !== null,
        ]);
    }

    public function reenviarEmailInscricao($id_evento)
    {
        $evento = Evento::where('id_evento_eve', $id_evento)->first();

        if (!$evento) {
            abort(404, 'Evento não encontrado');
        }

        $trilheiro = $this->trilheiroInscritoNoEvento($evento);

        if (!$trilheiro) {
            Flash::error('Só quem está inscrito neste evento pode reenviar o e-mail.');

            return redirect()->back();
        }

        try {
            Mail::send(new NovoEventoTrilheiroNotificacao($evento, $trilheiro, Auth::user()));
            Flash::success('E-mail de inscrição reenviado.');
        } catch (\Throwable $e) {
            \Log::error('Erro ao reenviar e-mail de inscrição no evento', [
                'id_evento' => $evento->id_evento_eve,
                'id_trilheiro' => $trilheiro->id_trilheiro_tri,
                'erro' => $e->getMessage(),
            ]);
            Flash::error('Não foi possível reenviar o e-mail agora. Tente novamente em instantes.');
        }

        return redirect()->back();
    }

    private function trilheiroInscritoNoEvento(Evento $evento)
    {
        $usuario = Auth::user();

        if (!$usuario || trim($usuario->id_role) === 'GUIA') {
            return null;
        }

        $trilheiro = Trilheiro::where('id_user', $usuario->id)->first();

        if (!$trilheiro) {
            return null;
        }

        $inscricao = EventoTrilheiro::where('id_evento_eve', $evento->id_evento_eve)
            ->where('id_trilheiro_tri', $trilheiro->id_trilheiro_tri)
            ->first();

        return ($inscricao && $inscricao->ativa()) ? $trilheiro : null;
    }

    public function cancelarParticipacao($id_evento)
    {
        $usuario = Auth::user();

        if (trim($usuario->id_role) === 'GUIA') {
            Flash::error('Apenas trilheiros podem cancelar participação em eventos.');
            return redirect('guia-e-condutores/privado/perfil');
        }

        $trilheiro = Trilheiro::where('id_user', $usuario->id)->first();
        $evento = Evento::where('id_evento_eve', $id_evento)->first();

        if (!$trilheiro) {
            Flash::error('Seu usuário não possui perfil de trilheiro. Complete seu cadastro para gerenciar participações.');
            return redirect('cadastro/privado/escolher-perfil');
        }

        if (!$evento) {
            abort(404, 'Evento não encontrado');
        }

        $inscricao = EventoTrilheiro::where('id_evento_eve', $evento->id_evento_eve)
            ->where('id_trilheiro_tri', $trilheiro->id_trilheiro_tri)
            ->first();

        if (!$inscricao || !$inscricao->ativa()) {
            Flash::error('Você não tem participação ativa neste evento.');
            return redirect($evento->url);
        }

        $inscricao->aplicarStatus(EventoTrilheiro::CANCELADO);
        $inscricao->save();

        Mail::send(new CancelamentoEventoTrilheiroNotificacao($evento, $trilheiro, $usuario));

        return redirect('eventos/cancelamento/'.$id_evento);
    }

    public function confirmacaoCancelamento($id_evento)
    {
        $evento = Evento::where('id_evento_eve', $id_evento)->first();
        $page_name = "Cancelamento de Inscrição - " . $evento->nm_evento_eve;

        return view('eventos/cancelamento', ['page_name' => $page_name, 'evento' => $evento]);
    }

    public function participantes($id_evento)
    {
        $evento = $this->eventoGerenciavel($id_evento);
        $evento->load('gastos');
        $inscricoes = $this->inscricoesOrdenadas($evento);

        return view('admin/eventos/participantes', compact('evento', 'inscricoes'));
    }

    public function gastos(Request $request, $id_evento)
    {
        $evento = $this->eventoGerenciavel($id_evento);
        $evento->load('gastos');
        $gasto = null;

        if ($request->filled('editar')) {
            $gasto = $this->gastoDoEvento($evento, $request->editar);
        }

        $resumo = $evento->resumoFinanceiro();

        return view('admin/eventos/gastos', compact('evento', 'gasto', 'resumo'));
    }

    public function salvarGasto(Request $request, $id_evento)
    {
        $evento = $this->eventoGerenciavel($id_evento);
        $gasto = $request->filled('cd_evento_gasto_evg')
            ? $this->gastoDoEvento($evento, $request->cd_evento_gasto_evg)
            : new EventoGasto();

        $valor = EventoGasto::interpretarValor($request->vl_gasto_evg);
        $categoria = (string) $request->ds_categoria_evg;
        $pagador = trim((string) $request->nm_pagador_evg);

        if (!isset(EventoGasto::CATEGORIAS[$categoria])) {
            Flash::error('Escolha a categoria do gasto.');
            return redirect()->back()->withInput();
        }
        if ($valor === null || $valor <= 0) {
            Flash::error('Informe um valor maior que zero.');
            return redirect()->back()->withInput();
        }
        if ($pagador === '') {
            Flash::error('Informe quem pagou.');
            return redirect()->back()->withInput();
        }

        if ($request->hasFile('comprovante')) {
            $arquivo = $request->file('comprovante');
            $extensao = strtolower($arquivo->getClientOriginalExtension());
            if (!in_array($extensao, ['jpg', 'jpeg', 'png', 'webp', 'pdf'], true) || $arquivo->getSize() > 5 * 1024 * 1024) {
                Flash::error('O comprovante precisa ser uma imagem ou PDF de até 5 MB.');
                return redirect()->back()->withInput();
            }
            if ($gasto->ds_comprovante_evg) {
                Storage::disk('eventos')->delete($gasto->ds_comprovante_evg);
            }
            $nome = 'comprovante_'.$evento->id_evento_eve.'_'.date('YmdHis').'.'.$extensao;
            $arquivo->storeAs('', $nome, 'eventos');
            $gasto->ds_comprovante_evg = $nome;
        }

        $gasto->id_evento_eve = $evento->id_evento_eve;
        $gasto->ds_categoria_evg = $categoria;
        $gasto->vl_gasto_evg = $valor;
        $gasto->nm_pagador_evg = $pagador;
        $gasto->ds_descricao_evg = trim((string) $request->ds_descricao_evg) ?: null;
        $gasto->fl_rateio_evg = $request->has('fl_rateio_evg');
        $gasto->fl_estimado_evg = $request->has('fl_estimado_evg');
        $gasto->save();

        Flash::success($request->filled('cd_evento_gasto_evg') ? 'Gasto atualizado.' : 'Gasto lançado.');

        return redirect('guia-e-condutores/privado/eventos/gastos/'.$evento->id_evento_eve);
    }

    public function excluirGasto($id_evento, $id_gasto)
    {
        $evento = $this->eventoGerenciavel($id_evento);
        $gasto = $this->gastoDoEvento($evento, $id_gasto);

        if ($gasto->ds_comprovante_evg) {
            Storage::disk('eventos')->delete($gasto->ds_comprovante_evg);
        }
        $gasto->delete();
        Flash::success('Gasto excluído.');

        return redirect('guia-e-condutores/privado/eventos/gastos/'.$evento->id_evento_eve);
    }

    public function aceitarInscricao($id_evento, $id_inscricao)
    {
        $evento = $this->eventoGerenciavel($id_evento);
        $inscricao = $this->inscricaoDoEvento($evento, $id_inscricao);

        if ($evento->fl_cancelado_eve) {
            Flash::error('Este evento está cancelado.');
            return redirect()->back();
        }

        if ($inscricao->st_inscricao_evt !== EventoTrilheiro::INTERESSADO) {
            Flash::error('Só dá para aceitar quem está como interessado.');
            return redirect()->back();
        }

        $inscricao->aplicarStatus(EventoTrilheiro::ACEITO);
        $inscricao->save();

        if ($evento->temVaga()) {
            Flash::success('Interesse aceito. A vaga fecha quando o pagamento for confirmado.');
        } else {
            Flash::warning('Interesse aceito. As vagas pagas já estão no limite, então o pagamento só poderá ser confirmado quando uma vaga for liberada.');
        }

        return redirect()->back();
    }

    public function recusarInscricao($id_evento, $id_inscricao)
    {
        $evento = $this->eventoGerenciavel($id_evento);
        $inscricao = $this->inscricaoDoEvento($evento, $id_inscricao);

        if (!in_array($inscricao->st_inscricao_evt, [EventoTrilheiro::INTERESSADO, EventoTrilheiro::ACEITO], true)) {
            Flash::error('Quem já está com a vaga confirmada precisa ter o pagamento desfeito antes de ser recusado.');
            return redirect()->back();
        }

        $inscricao->aplicarStatus(EventoTrilheiro::RECUSADO);
        $inscricao->save();
        Flash::success('Interesse recusado.');

        return redirect()->back();
    }

    public function confirmarPagamento($id_evento, $id_inscricao)
    {
        $evento = $this->eventoGerenciavel($id_evento);

        if ($evento->fl_cancelado_eve) {
            Flash::error('Este evento está cancelado.');
            return redirect()->back();
        }

        try {
            DB::transaction(function () use ($evento, $id_inscricao) {
                $inscricao = EventoTrilheiro::where('cd_evento_trilheiro_evt', $id_inscricao)
                    ->where('id_evento_eve', $evento->id_evento_eve)
                    ->lockForUpdate()
                    ->first();

                if (!$inscricao) {
                    throw new \RuntimeException('Inscrição não encontrada.');
                }

                if ($inscricao->st_inscricao_evt === EventoTrilheiro::PAGO) {
                    return;
                }

                if ($inscricao->st_inscricao_evt !== EventoTrilheiro::ACEITO) {
                    throw new \RuntimeException('Confirme o pagamento só depois de aceitar o interesse.');
                }

                $inscricao->load('trilheiro');
                $faltas = $inscricao->faltasParaConfirmar();
                if ($faltas) {
                    throw new \RuntimeException('A vaga só pode ser confirmada com nome completo, data de nascimento e CPF. Falta: '.implode(', ', $faltas).'.');
                }

                $ocupadas = EventoTrilheiro::where('id_evento_eve', $evento->id_evento_eve)
                    ->where('st_inscricao_evt', EventoTrilheiro::PAGO)
                    ->lockForUpdate()
                    ->count();

                if (!EventoTrilheiro::cabeVaga($ocupadas, $evento->limiteVagas())) {
                    throw new \RuntimeException('Não há vaga livre. O limite deste evento já foi atingido pelos pagamentos confirmados.');
                }

                $inscricao->aplicarStatus(EventoTrilheiro::PAGO);
                $inscricao->save();
            });
        } catch (\RuntimeException $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }

        Flash::success('Pagamento confirmado. A vaga desta pessoa está fechada.');

        return redirect()->back();
    }

    public function desfazerPagamento($id_evento, $id_inscricao)
    {
        $evento = $this->eventoGerenciavel($id_evento);
        $inscricao = $this->inscricaoDoEvento($evento, $id_inscricao);

        if ($inscricao->st_inscricao_evt !== EventoTrilheiro::PAGO) {
            Flash::error('Esta inscrição não está com a vaga confirmada.');
            return redirect()->back();
        }

        $inscricao->aplicarStatus(EventoTrilheiro::ACEITO);
        $inscricao->save();
        Flash::success('Pagamento desfeito. A vaga voltou a ficar livre e a pessoa segue aceita, aguardando pagamento.');

        return redirect()->back();
    }

    private function eventoGerenciavel($id_evento)
    {
        $evento = Evento::where('id_evento_eve', $id_evento)->first();

        if (!$evento) {
            abort(404, 'Evento não encontrado');
        }

        $papel = trim((string) Auth::user()->id_role);

        if ($papel === 'ADMIN') {
            return $evento;
        }

        $guia = Guia::where('id_user', Auth::user()->id)->first();

        if ($papel !== 'GUIA' || !$guia || (int) $guia->id_guia_gui !== (int) $evento->id_guia_gui) {
            abort(403);
        }

        return $evento;
    }

    private function inscricaoDoEvento(Evento $evento, $id_inscricao)
    {
        $inscricao = EventoTrilheiro::where('cd_evento_trilheiro_evt', $id_inscricao)
            ->where('id_evento_eve', $evento->id_evento_eve)
            ->first();

        if (!$inscricao) {
            abort(404, 'Inscrição não encontrada');
        }

        return $inscricao;
    }

    private function gastoDoEvento(Evento $evento, $id_gasto)
    {
        $gasto = EventoGasto::where('cd_evento_gasto_evg', $id_gasto)
            ->where('id_evento_eve', $evento->id_evento_eve)
            ->first();

        if (!$gasto) {
            abort(404, 'Gasto não encontrado');
        }

        return $gasto;
    }

    private function inscricoesOrdenadas(Evento $evento)
    {
        $ordem = [
            EventoTrilheiro::INTERESSADO => 0,
            EventoTrilheiro::ACEITO => 1,
            EventoTrilheiro::PAGO => 2,
            EventoTrilheiro::RECUSADO => 3,
            EventoTrilheiro::CANCELADO => 4,
        ];

        return $evento->eventoTrilheiros()
            ->with(['trilheiro.origem', 'trilheiro.indice', 'trilheiro.user'])
            ->get()
            ->sortBy(function ($inscricao) use ($ordem) {
                return sprintf(
                    '%d-%s',
                    isset($ordem[$inscricao->st_inscricao_evt]) ? $ordem[$inscricao->st_inscricao_evt] : 9,
                    $inscricao->created_at
                );
            })
            ->values();
    }

    public function cadastro()
    {
        $evento = null;
        $guia = Guia::where('id_user', Auth::user()->id)->first();
        $cidades = Cidade::where('cd_estado_est', 42)->orderBy('nm_cidade_cde')->get();
        $trilhas = Trilha::orderBy('nm_trilha_tri')
            ->select('id_trilha_tri', 'nm_trilha_tri')
            ->get();

        return view('admin/eventos/cadastro', compact('guia','cidades','evento','trilhas'));
    }

    public function editar($id)
    {
        $guia = Guia::where('id_user', Auth::user()->id)->first();
        $cidades = Cidade::where('cd_estado_est', 42)->orderBy('nm_cidade_cde')->get();
        $evento = Evento::where('id_evento_eve', $id)->first();
        $trilhas = Trilha::orderBy('nm_trilha_tri')
            ->select('id_trilha_tri', 'nm_trilha_tri')
            ->orderBy('nm_trilha_tri')
            ->select('trilha_tri.id_trilha_tri', 'trilha_tri.nm_trilha_tri')
            ->get();

        return view('admin/eventos/cadastro', compact('guia','cidades','evento','trilhas'));
    }

    public function cadastrar(Request $request)
    {
        if (Auth::guest() or trim(Auth::user()->id_role) != 'GUIA') {
            return redirect('login');
        }
        
        $guia = Guia::where('id_user', Auth::user()->id)->first();

        $request->merge(['dt_realizacao_eve' => date('Y-m-d', strtotime(str_replace('/', '-', $request->dt_realizacao_eve)))]);
        $request->merge(['dt_termino_eve' => date('Y-m-d', strtotime(str_replace('/', '-', $request->dt_termino_eve)))]);

        $dados = array('id_guia_gui' => $guia->id_guia_gui,
                        'cd_cidade_cde' => $request->cd_cidade_cde,
                        'nm_evento_eve' => $request->nm_evento_eve,
                        'ds_fone_contato_eve' => $request->ds_fone_contato_eve,
                        'dt_realizacao_eve' => $request->dt_realizacao_eve,
                        'dt_termino_eve' => $request->dt_termino_eve,
                        'valor_eve' =>  $request->valor_eve,
                        'total_participantes_eve' => $request->total_participantes_eve,
                        'descricao' => $this->descricaoSegura($request->descricao),                           
                        'fl_ativo_eve' => null,
                        'fl_privado_eve' => $request->has('fl_privado_eve') ? true : false,
                        'fl_cancelado_eve' => false,
                        'hora_inicio_eve' => $request->hora_inicio_eve,
                        'hora_fim_eve' => $request->hora_fim_eve,
                        'id_trilha_tri' => $request->id_trilha_tri ?: null);

        if($request->hasFile('img_instagram')) {
            $extension = $request->file('img_instagram')->getClientOriginalExtension();
            $filename = 'instagram_'.$guia->id_guia_gui.'_'.date("YmdHis").'.' . $extension;
            $imagem = $request->img_instagram->storeAs('', $filename, 'eventos');
            $dados['ds_imagem_vertical_eve'] = $filename;
        }

        if($request->hasFile('img_evento')) {
            $extension = $request->file('img_evento')->getClientOriginalExtension();
            $filename = 'evento_'.$guia->id_guia_gui.'_'.date("YmdHis").'.' . $extension;
            $imagem = $request->img_evento->storeAs('', $filename, 'eventos');
            $dados['ds_imagem_horizontal_eve'] = $filename;
        }

        if($request->hasFile('img_grupo')) {
            $extension = $request->file('img_grupo')->getClientOriginalExtension();
            $filename = 'grupo_'.$guia->id_guia_gui.'_'.date("YmdHis").'.' . $extension;
            $request->img_grupo->storeAs('', $filename, 'eventos');
            $dados['ds_imagem_grupo_eve'] = $filename;
        }

        $evento = Evento::create($dados);

        if($evento){
            AvisoFavoritosGuia::aoLancar($evento->load('local'));
            Flash::success('<i class="fa fa-check"></i> Evento cadastrado com sucesso');
            return redirect('guia-e-condutores/privado/eventos');
        }else{
            Flash::error("Ocorreu um erro ao cadastrar o evento. Revise os dados e tente novamente");
            return redirect('guia-e-condutores/privado/evento/novo');
        }
    }

    public function update(Request $request)
    {
        if (Auth::guest() or trim(Auth::user()->id_role) != 'GUIA') {
            return redirect('login');
        }
        
        $guia = Guia::where('id_user', Auth::user()->id)->first();
        $evento = Evento::where('id_evento_eve', $request->id_evento_eve)->first();
        $request->merge(['dt_realizacao_eve' => date('Y-m-d', strtotime(str_replace('/', '-', $request->dt_realizacao_eve)))]);
        $request->merge(['dt_termino_eve' => date('Y-m-d', strtotime(str_replace('/', '-', $request->dt_termino_eve)))]);

        $evento->cd_cidade_cde = $request->cd_cidade_cde;
        $evento->nm_evento_eve = $request->nm_evento_eve;
        $evento->ds_fone_contato_eve = $request->ds_fone_contato_eve;
        $evento->dt_realizacao_eve = $request->dt_realizacao_eve;
        $evento->dt_termino_eve = $request->dt_termino_eve;
        $evento->valor_eve =  $request->valor_eve;
        $evento->total_participantes_eve = $request->total_participantes_eve;
        $evento->descricao = $this->descricaoSegura($request->descricao);                           
        $evento->fl_ativo_eve = null;
        $evento->fl_privado_eve = $request->has('fl_privado_eve') ? true : false;
        $evento->fl_cancelado_eve = $request->has('fl_cancelado_eve') ? true : false;
        $evento->hora_inicio_eve = $request->hora_inicio_eve;
        $evento->hora_fim_eve = $request->hora_fim_eve;
        $evento->id_trilha_tri = $request->id_trilha_tri ?: null;

        if($request->hasFile('img_instagram')) {
            $extension = $request->file('img_instagram')->getClientOriginalExtension();
            $filename = 'instagram_'.$guia->id_guia_gui.'_'.date("YmdHis").'.' . $extension;
            $imagem = $request->img_instagram->storeAs('', $filename, 'eventos');
            $evento->ds_imagem_vertical_eve = $filename;
        }

        if($request->hasFile('img_evento')) {
            $extension = $request->file('img_evento')->getClientOriginalExtension();
            $filename = 'evento_'.$guia->id_guia_gui.'_'.date("YmdHis").'.' . $extension;
            $imagem = $request->img_evento->storeAs('', $filename, 'eventos');
            $evento->ds_imagem_horizontal_eve = $filename;
        }

        if($request->hasFile('img_grupo')) {
            $extension = $request->file('img_grupo')->getClientOriginalExtension();
            $filename = 'grupo_'.$guia->id_guia_gui.'_'.date("YmdHis").'.' . $extension;
            $request->img_grupo->storeAs('', $filename, 'eventos');
            $evento->ds_imagem_grupo_eve = $filename;
        } elseif ($request->input('img_deletada_grupo') === 'true') {
            $evento->ds_imagem_grupo_eve = null;
        }
        
        $evento->save();
        AvisoFavoritosGuia::aoLancar($evento->load('local'));

        return redirect('guia-e-condutores/privado/eventos');
    }

    /**
     * Clona um evento existente
     * 
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function clonar($id)
    {
        if (Auth::guest() or trim(Auth::user()->id_role) != "GUIA") {
            return redirect("login");
        }
        
        $guia = Guia::where("id_user", Auth::user()->id)->first();
        $evento = Evento::where("id_evento_eve", $id)
                        ->where("id_guia_gui", $guia->id_guia_gui)
                        ->first();

        if (!$evento) {
            Flash::error("Evento não encontrado ou você não tem permissão para cloná-lo.");
            return redirect("guia-e-condutores/privado/eventos");
        }

        try {
            $novoEvento = $evento->clonar();
            
            Flash::success("Evento clonado com sucesso! Edite as informações necessárias.");
            return redirect("guia-e-condutores/privado/evento/editar/" . $novoEvento->id_evento_eve);
            
        } catch (\Exception $e) {
            Flash::error("Erro ao clonar evento: " . $e->getMessage());
            return redirect("guia-e-condutores/privado/eventos");
        }
    }

    public function imagemDescricao(Request $request)
    {
        $funcNum = (int) $request->input('CKEditorFuncNum');
        if (Auth::guest() || trim(Auth::user()->id_role) !== 'GUIA') {
            return $this->respostaCkeditor($funcNum, '', 'Entre como guia para enviar a imagem.');
        }

        $guia = Guia::where('id_user', Auth::id())->first();
        $arquivo = $request->file('upload');
        if (!$guia || !$arquivo) {
            return $this->respostaCkeditor($funcNum, '', 'Envie uma imagem.');
        }

        $mime = $arquivo->getMimeType();
        $extensoes = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'];
        if (!isset($extensoes[$mime]) || !@getimagesize($arquivo->getRealPath())) {
            return $this->respostaCkeditor($funcNum, '', 'Use uma imagem JPG, PNG ou WEBP.');
        }
        if ($arquivo->getSize() > 5 * 1024 * 1024) {
            return $this->respostaCkeditor($funcNum, '', 'A imagem deve ter no máximo 5 MB.');
        }

        $nome = 'descricao_'.$guia->id_guia_gui.'_'.date('YmdHis').'_'.bin2hex(random_bytes(3)).'.'.$extensoes[$mime];
        $arquivo->storeAs('', $nome, 'eventos');

        return $this->respostaCkeditor($funcNum, asset('img/eventos/'.$nome), '');
    }

    private function descricaoSegura($html)
    {
        $html = trim((string) $html);
        $html = preg_replace('#<(script|style|iframe|object|embed|form|link|meta)\b[^>]*>.*?</\1>#is', '', $html);
        $html = preg_replace('#<(script|style|iframe|object|embed|form|link|meta)\b[^>]*/?>#is', '', $html);
        $html = strip_tags($html, '<p><br><strong><b><em><i><u><ul><ol><li><h1><h2><h3><h4><a><blockquote><img>');
        $html = preg_replace('/\s(on\w+|style|formaction|xmlns)\s*=\s*("[^"]*"|\'[^\']*\'|[^\s>]+)/i', '', $html);
        $html = preg_replace('/href\s*=\s*([\'"])\s*(javascript:|data:)[^\'"]*\1/i', 'href="#"', $html);
        $html = preg_replace_callback('#<img\b([^>]*)>#i', function ($encontrado) {
            return $this->imagemDescricaoPermitida($encontrado[1]);
        }, $html);

        return $html;
    }

    private function imagemDescricaoPermitida($atributos)
    {
        if (!preg_match('/src\s*=\s*([\'"])([^\'"]+)\1/i', $atributos, $origem)) {
            return '';
        }

        $url = $origem[2];
        $host = parse_url($url, PHP_URL_HOST);
        $hosts = array_filter([
            parse_url(config('app.url'), PHP_URL_HOST),
            request()->getHost(),
        ]);
        if ($host && !in_array($host, $hosts, true)) {
            return '';
        }

        $caminho = parse_url($url, PHP_URL_PATH);
        if (!$caminho || !preg_match('#/img/eventos/descricao_[A-Za-z0-9._-]+$#', $caminho)) {
            return '';
        }

        $alt = '';
        if (preg_match('/alt\s*=\s*([\'"])([^\'"]*)\1/i', $atributos, $texto)) {
            $alt = htmlspecialchars($texto[2], ENT_QUOTES, 'UTF-8');
        }

        return '<img src="'.htmlspecialchars($url, ENT_QUOTES, 'UTF-8').'" alt="'.$alt.'">';
    }

    private function respostaCkeditor($funcNum, $url, $mensagem)
    {
        $script = '<script>window.parent.CKEDITOR.tools.callFunction('
            .(int) $funcNum.','
            .json_encode($url).','
            .json_encode($mensagem)
            .');</script>';

        return response($script, 200, ['Content-Type' => 'text/html; charset=utf-8']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Cidade;
use App\Evento;
use App\EventoTrilheiro;
use App\Exceptions\CadasturIndisponivelException;
use App\Fone;
use App\Guia;
use App\GuiaTrilha;
use App\Trilheiro;
use App\Trilha;
use App\Interacao;
use App\Jobs\VerificarCadasturGuiaJob;
use App\Mail\GuiaConfirmacao;
use App\Services\CadasturService;
use App\UnidadeConservacao;
use App\Mail\GuiaModeracao;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Laracasts\Flash\Flash;

class GuiaController extends Controller
{
    public function index(Request $request)
    {
        $page_name = "Guias e Condutores em Santa Catarina";
        $titulo = 'Guias e Condutores';

        $id_cidade = $request->cidade;
        $cidades = Cidade::whereIn('cd_cidade_cde', Guia::select('cd_cidade_origem_gui')->get())->orderBy('nm_cidade_cde')->select('cd_cidade_cde', 'nm_cidade_cde')->get();

        if (!empty($id_cidade)) {
            $cidade = Cidade::whereRaw("unaccent(replace(lower(nm_cidade_cde),' ','-')) = '".$id_cidade."'")->where('cd_estado_est', 42)->first();
            $guias = Guia::inRandomOrder()->where('fl_perfil_moderado_gui', true)->where('cd_cidade_origem_gui', $cidade->cd_cidade_cde)->where('fl_ativo_gui', true)->get();
        }else{
            $guias = Guia::inRandomOrder()->where('fl_perfil_moderado_gui', true)->where('fl_ativo_gui', true)->get();
        }

        return view('guias/index', ['page_name' => $page_name, 'guias' => $guias, 'titulo' => $titulo, 'cidades' => $cidades]);
    }

    public function perfil($identificador)
    {
        $titulo = 'Guias e Condutores';
        $subtitulo = "Perfil";
        $page_name = "Perfil";
        
        if(is_numeric($identificador))
            $guia = Guia::where('id_guia_gui', $identificador)->first();
        else
            $guia = Guia::where('nm_instagram_gui', $identificador)->first();

        if($guia){
            $this->registrarVisitaPerfil($guia);

            return view('guias/perfil', [
                'page_name' => $page_name,
                'guia' => $guia,
                'titulo' => $titulo,
                'subtitulo' => $subtitulo,
                'eventos_futuros' => $this->eventosFuturos($guia),
            ]);
        }else{
            return view('guias/guia-not-found', ['page_name' => $page_name, 'guia' => $guia, 'titulo' => $titulo, 'subtitulo' => $subtitulo ]);
        }        
    }

    private function resumoAno(Guia $guia)
    {
        $eventos = Evento::with(['eventoTrilheiros.trilheiro.user'])
            ->where('id_guia_gui', $guia->id_guia_gui)
            ->where('fl_cancelado_eve', false)
            ->orderBy('dt_realizacao_eve', 'DESC')
            ->get();

        $porTrilheiro = [];

        foreach ($eventos as $evento) {
            foreach ($evento->eventoTrilheiros as $participacao) {
                if (!$participacao->ativa()) {
                    continue;
                }

                $trilheiro = $participacao->trilheiro;
                if (!$trilheiro) {
                    continue;
                }

                $id = $trilheiro->id_trilheiro_tri;
                if (!isset($porTrilheiro[$id])) {
                    $nome = trim((string) $trilheiro->nm_trilheiro_tri) ?: 'Trilheiro';
                    $foto = $trilheiro->nm_path_foto_tri ?: optional($trilheiro->user)->dc_foto_perfil;
                    $caminho = $foto ? public_path('img/trilheiros/'.$foto) : null;
                    $porTrilheiro[$id] = [
                        'nome' => explode(' ', $nome)[0],
                        'foto' => ($caminho && is_file($caminho)) ? asset('img/trilheiros/'.$foto) : asset('img/usuarios/perfil.png'),
                        'eventos' => [],
                    ];
                }
                $porTrilheiro[$id]['eventos'][$evento->id_evento_eve] = true;
            }
        }

        $lista = collect($porTrilheiro)->map(function ($pessoa) {
            $pessoa['trilhas'] = count($pessoa['eventos']);
            unset($pessoa['eventos']);

            return $pessoa;
        })->sortByDesc('trilhas')->values();

        return [
            'pessoas' => $lista->count(),
            'trilhas' => $eventos->count(),
            'destaque' => $lista->first(),
            'demais' => $lista->slice(1)->values(),
        ];
    }

    public function estatisticas($tipo, $identificador)
    {
        $url = null;
        $interacao = 0;

        if(is_numeric($identificador))
            $guia = Guia::where('id_guia_gui', $identificador)->first();
        else
            $guia = Guia::where('nm_instagram_gui', $identificador)->first();

        if(!$guia){
            Flash::warning('Perfil não encontrado.');

            return redirect('guias-e-condutores');
        }

        $fone = ($guia->fone) ? preg_replace('/[(\)\-\" "]+/', '', $guia->fone->nu_fone_fon) : '';

        switch ($tipo) {
            case 'instagram':
                $interacao = 1;
                $url = 'https://www.instagram.com/'.$guia->nm_instagram_gui;
                break;
            
            case 'telefone':
                $interacao = 2;
                $url = 'https://api.whatsapp.com/send?phone=55'.$fone.'&text=Olá! Vi seu perfil no https://trilhasemsc.com.br/guias-e-condutores e fiquei interessado. Pode me dar mais informações?';
                break;

            case 'perfil':
                $interacao = 3;
                $url = 'guia/perfil/'.$identificador;
                break;
        }

        if ($interacao && $tipo !== 'perfil') {
            Interacao::create([
                'id_tipo_interacao_tin' => $interacao,
                'id_guia_gui' => $guia->id_guia_gui,
            ]);
        }
        
        Flash::warning('Você está sendo redirecionado...');

        return redirect($url);
    }

    public function registrarInteracao($tipo, $identificador)
    {
        if (is_numeric($identificador)) {
            $guia = Guia::where('id_guia_gui', $identificador)->first();
        } else {
            $guia = Guia::where('nm_instagram_gui', $identificador)->first();
        }

        $mapa = ['instagram' => 1, 'telefone' => 2];
        if ($guia && isset($mapa[$tipo])) {
            Interacao::create([
                'id_tipo_interacao_tin' => $mapa[$tipo],
                'id_guia_gui' => $guia->id_guia_gui,
            ]);
        }

        return response('', 204);
    }

    public function cadastro(Request $request)
    {
        if($request->isMethod('post')) {

            $validated= $request->validate(['tipo_cadastro' => 'required'],['tipo_cadastro.required' => 'É obrigatório selecionar uma atividade']);

            switch ($request->tipo_cadastro) {

                case 'guia':

                    $validated= $request->validate([
                        'name' => 'required',
                        'email' => 'required',
                        'password' => 'required|confirmed',
                        'term' => 'required',
                        recaptchaFieldName() => recaptchaRuleName()
                    ], [
                        'name.required' => 'O campo "Nome" é obrigatório.',
                        'email.required' => 'O campo "Email" é obrigatório.',
                        'password.required' => 'O campo "Senha" é obrigatório.',
                        'password.confirmed' => 'O campo "Senha" e "Confirme a Senha" possuem valores divergentes.',
                        'g-recaptcha-response.recaptcha' => 'O campo "Não sou um robô" é obrigatório.',
                        'term.required' => 'O campo "Termo de Uso" é obrigatório.'
                    ]);
        
                    $user = \App\User::where('email', trim($request->email))->first();
        
                    if($user) {
                        Flash::error("Usuário já cadastrado no sistema.");

                        return redirect('guias-e-condutores/cadastro');
                    } else {

                        $usuario = User::create([
                            'name' => $request->name,
                            'email' => trim($request->email),
                            'password' => Hash::make($request->password)
                        ]);
        
                        $usuario->id_role = 'GUIA';
                        $usuario->save();

                        if($usuario){
                            $guia = Guia::create([
                                'id_user' => $usuario->id,
                                'nm_guia_gui' => $usuario->name,
                                'nu_cadastur_gui' => $request->cadastur
                            ]);
                        }

                        Flash::success("Cadastro realizado com sucesso. Complete seu perfil para que os trilheiros possam te encontrar.");

                        Auth::login($usuario);
                    }
                    
                    return redirect('guia-e-condutores/privado/atualizar-cadastro');

                    break;

                case 'trilheiro':

                    $validated= $request->validate([
                        'name' => 'required',
                        'email' => 'required',
                        'password' => 'required|confirmed',
                        'term' => 'required'
                        //recaptchaFieldName() => recaptchaRuleName()
                    ], [
                        'name.required' => 'O campo "Nome" é obrigatório.',
                        'email.required' => 'O campo "Email" é obrigatório.',
                        'password.required' => 'O campo "Senha" é obrigatório.',
                        'password.confirmed' => 'O campo "Senha" e "Confirme a Senha" possuem valores divergentes.',
                        'g-recaptcha-response.recaptcha' => 'O campo "Não sou um robô" é obrigatório.',
                        'term.required' => 'O campo "Termo de Uso" é obrigatório.'
                    ]);
        
                    $user = \App\User::where('email', trim($request->email))->first();
        
                    if($user) {
                        Flash::error("Usuário já cadastrado no sistema.");
                    } else {
                        $usuario = User::create([
                            'name' => $request->name,
                            'email' => trim($request->email),
                            'password' => Hash::make($request->password)
                        ]);
        
                        $usuario->id_role = 'TRILHEIRO';
                        $usuario->save();

                        if($usuario){
                            $trilheiro = Trilheiro::create([
                                'id_user' => $usuario->id,
                                'nm_trilheiro_tri' => $usuario->name
                            ]);

                            // Envia email de notificação para o administrador
                            try {
                                Mail::send(new \App\Mail\NovoTrilheiroNotificacao($usuario, $trilheiro));
                                
                                // Log de sucesso
                                \Log::info('Email de novo trilheiro enviado com sucesso (cadastro guia)', [
                                    'trilheiro_id' => $trilheiro->id_trilheiro_tri,
                                    'user_id' => $usuario->id,
                                    'user_email' => $usuario->email,
                                    'user_name' => $usuario->name,
                                    'origem' => 'cadastro_guia',
                                    'timestamp' => now()
                                ]);
                            } catch (\Exception $e) {
                                // Log do erro mas não interrompe o cadastro
                                \Log::error('Erro ao enviar email de notificação de novo trilheiro (cadastro guia)', [
                                    'error' => $e->getMessage(),
                                    'trilheiro_id' => $trilheiro->id_trilheiro_tri ?? null,
                                    'user_id' => $usuario->id,
                                    'user_email' => $usuario->email,
                                    'origem' => 'cadastro_guia',
                                    'timestamp' => now(),
                                    'trace' => $e->getTraceAsString()
                                ]);
                            }
                        }
                        Flash::success("Usuário cadastrado com sucesso. Deixe seu perfil completo para que os guias possam te encontrar.");
                    }

                    Auth::login($usuario);
                    
                    return redirect('trilheiro/privado/atualizar-cadastro');

                    break;
                default:
                    # code...
                    break;
            }

            return redirect('login');

        }
        return view('guias.cadastro-novo');
    }

    public function atualizarCadastro(Request $request)
    {
        if (Auth::guest() or trim(Auth::user()->id_role) != 'GUIA') {
            return redirect('login');
        }
        //dd($request);
        $guia = Guia::where('id_user', Auth::user()->id)->first();

        if(empty($guia)) {
            $guia = Guia::create([
                'id_user' => Auth::user()->id,
                'nm_guia_gui' => Auth::user()->name
            ]);
        }

        if($request->isMethod('post')) {

            $validated = $request->validate([
                'nome' => 'required',
                'email' => 'required',
                'cidade_origem' => 'required',
                'cidades_atuacao' => 'required',
                'biografia' => 'required',
                'cadastur' => 'required'
            ]);

            $nome = $request->nome;
            $email = $request->email;
            $instagram = $request->instagram;
            $site = $request->site;
            $cidadeOrigem = $request->cidade_origem;
            $cidadesAtuacao = $request->cidades_atuacao;
            $unidades_conservacao = $request->unidades_conservacao;
            $biografia = $request->biografia;
            $celular = $request->celular;
            $whatsap = $request->whatsap;
            $imagem_deletada = $request->imagem_deletada;
            $cadastur = $request->cadastur;
            $cadasturAlterado = CadasturService::somenteDigitos($cadastur) !== CadasturService::somenteDigitos($guia->nu_cadastur_gui);
            $verificarCadastur = $cadasturAlterado || $guia->sg_cadastur_situacao_gui === null;

            $guia->update([
                'cd_cidade_origem_gui' => $cidadeOrigem,
                'nm_guia_gui' => $nome,
                'nm_instagram_gui' => $instagram,
                'nm_site_gui' => $site,
                'dc_biografia_gui' => $biografia,
                'fl_perfil_completo_gui' => true,
                'fl_perfil_moderado_gui' => false,
                'fl_ativo_gui' => isset($request->ativo),
                'nu_cadastur_gui' => $request->cadastur
            ]);

            $guia->cidadesAtuacao()->sync($cidadesAtuacao);
            $guia->unidadesConservacao()->sync($unidades_conservacao);

            $servicoCadastur = app(CadasturService::class);

            if ($cadasturAlterado) {
                $servicoCadastur->reiniciar($guia);
            }

            if ($verificarCadastur && $servicoCadastur->habilitado()) {
                VerificarCadasturGuiaJob::dispatch($guia->id_guia_gui);
            }

            $imagem = null;

            if ($request->hasFile('imagem')) {
                $extension = $request->file('imagem')->getClientOriginalExtension();
                $filename = $guia->id_guia_gui . '.' . $extension;
                $imagem = $request->imagem->storeAs('', $filename, 'guias');
            }

            if($request->hasFile('imagem')) {
                $guia->update(['nm_path_logo_gui' => $imagem]);
            } else {

                if($imagem_deletada == "true") {
                    $guia->update(['nm_path_logo_gui' => $imagem]);
                }
            }

            if($celular) {
                Fone::updateOrCreate([
                   'id_guia_gui' => $guia->id_guia_gui,
                   'id_tipo_fone_tif' => 1
                ],['nu_fone_fon' => $celular]);
            }

            if($whatsap) {
                Fone::updateOrCreate([
                    'id_guia_gui' => $guia->id_guia_gui,
                    'id_tipo_fone_tif' => 2
                ],['nu_fone_fon' => $whatsap]);
            }

            Auth::user()->update(['name' =>  $nome, 'dc_foto_perfil' => $imagem]);

            if(isset($request->ativo)) {
                Mail::send(new GuiaModeracao($guia));
            }
            
        }

        $usuario = Auth::user();

        $cidades = Cidade::where('cd_estado_est', 42)->orderBy('nm_cidade_cde')->get();
        $ucs = UnidadeConservacao::orderBy('nome_unc')->get();
        //$trilhas = Trilha::with('cidade')->where('fl_publicacao_tri', 'S')->get()->sortBy('cidade.nm_cidade_cde');

        return view('guias/atualizar-cadastro', compact('usuario', 'cidades', 'guia', 'ucs'));
    }

    public function painel()
    {
        if (Auth::guest() || trim(Auth::user()->id_role) !== 'GUIA') {
            return redirect('login');
        }

        $guia = Guia::where('id_user', Auth::id())->first();
        if (empty($guia)) {
            return redirect('guia-e-condutores/privado/atualizar-cadastro');
        }

        $proximos = $guia->eventos()
            ->with(['local', 'eventoTrilheiros.trilheiro', 'gastos'])
            ->where('fl_cancelado_eve', false)
            ->where('dt_realizacao_eve', '>=', now()->toDateString())
            ->orderBy('dt_realizacao_eve')
            ->orderBy('hora_inicio_eve')
            ->get();

        $interessados = 0;
        $aceitos = 0;
        $semDados = 0;
        $receita = 0.0;
        $sobra = 0.0;
        $fila = [];

        foreach ($proximos as $evento) {
            $resumo = $evento->resumoFinanceiro();
            $receita += $resumo['receita'];
            $sobra += $resumo['sobra'];

            foreach ($evento->eventoTrilheiros as $inscricao) {
                if ($inscricao->st_inscricao_evt === EventoTrilheiro::INTERESSADO) {
                    $interessados++;
                } elseif ($inscricao->st_inscricao_evt === EventoTrilheiro::ACEITO) {
                    $aceitos++;
                }

                if (!$inscricao->ativa()) {
                    continue;
                }

                $faltas = $inscricao->faltasParaConfirmar();
                if ($faltas) {
                    $semDados++;
                }

                $esperaDecisao = in_array($inscricao->st_inscricao_evt, [EventoTrilheiro::INTERESSADO, EventoTrilheiro::ACEITO], true);
                if (!$esperaDecisao && !$faltas) {
                    continue;
                }

                if ($inscricao->st_inscricao_evt === EventoTrilheiro::INTERESSADO) {
                    $acao = 'Aceitar ou recusar';
                    $ordem = 0;
                } elseif ($inscricao->st_inscricao_evt === EventoTrilheiro::ACEITO) {
                    $acao = 'Confirmar pagamento';
                    $ordem = 1;
                } else {
                    $acao = 'Completar dados do seguro';
                    $ordem = 2;
                }

                $fila[] = [
                    'nome' => trim((string) optional($inscricao->trilheiro)->nm_trilheiro_tri) ?: 'Trilheiro',
                    'evento' => $evento->nm_evento_eve,
                    'quando' => $evento->dt_realizacao_eve,
                    'acao' => $acao,
                    'faltas' => $faltas,
                    'ordem' => $ordem,
                    'url' => url('guia-e-condutores/privado/eventos/participantes/'.$evento->id_evento_eve),
                ];
            }
        }

        usort($fila, function ($a, $b) {
            $data = strcmp((string) $a['quando'], (string) $b['quando']);
            if ($data !== 0) {
                return $data;
            }

            return $a['ordem'] <=> $b['ordem'];
        });

        return view('guias.painel', [
            'guia' => $guia,
            'proximos' => $proximos,
            'fila' => $fila,
            'interessados' => $interessados,
            'aceitos' => $aceitos,
            'semDados' => $semDados,
            'receita' => $receita,
            'sobra' => $sobra,
        ]);
    }

    public function minhasEstatisticas()
    {
        if (Auth::guest() or trim(Auth::user()->id_role) != 'GUIA') {
            return redirect('login');
        }

        $guia = Guia::where('id_user', Auth::user()->id)->first();
        if (empty($guia)) {
            return redirect('guia-e-condutores/privado/atualizar-cadastro');
        }

        $resumoAno = $this->resumoAno($guia);
        $eventos_realizados = $this->eventosRealizados($guia);
        $totais = $this->totaisPercurso($eventos_realizados);

        return view('guias/estatisticas', compact('guia', 'resumoAno', 'eventos_realizados', 'totais'));
    }

    public function acessos()
    {
        if (Auth::guest() || trim(Auth::user()->id_role) !== 'GUIA') {
            return redirect('login');
        }

        $guia = Guia::where('id_user', Auth::id())->first();
        if (empty($guia)) {
            return redirect('guia-e-condutores/privado/atualizar-cadastro');
        }

        $inicio = now()->subDays(29)->startOfDay();
        $totais = $this->contagemInteracoes($guia->id_guia_gui);
        $recentes = $this->contagemInteracoes($guia->id_guia_gui, $inicio);

        $linhas = Interacao::query()
            ->select(DB::raw('DATE(created_at) as dia'), DB::raw('COUNT(*) as total'))
            ->where('id_guia_gui', $guia->id_guia_gui)
            ->where('id_tipo_interacao_tin', 3)
            ->where('created_at', '>=', $inicio)
            ->groupBy(DB::raw('DATE(created_at)'))
            ->get();

        $porDia = [];
        foreach ($linhas as $linha) {
            $porDia[substr((string) $linha->dia, 0, 10)] = (int) $linha->total;
        }

        $dias = [];
        $maior = 1;
        for ($i = 0; $i < 30; $i++) {
            $data = $inicio->copy()->addDays($i);
            $total = $porDia[$data->format('Y-m-d')] ?? 0;
            $dias[] = ['rotulo' => $data->format('d/m'), 'total' => $total];
            if ($total > $maior) {
                $maior = $total;
            }
        }

        return view('guias.acessos', [
            'guia' => $guia,
            'visitas' => $totais[3],
            'visitas30' => $recentes[3],
            'whatsapp' => $totais[2],
            'whatsapp30' => $recentes[2],
            'instagram' => $totais[1],
            'instagram30' => $recentes[1],
            'dias' => $dias,
            'maior' => $maior,
        ]);
    }

    private function registrarVisitaPerfil(Guia $guia)
    {
        if (Auth::check() && (int) Auth::id() === (int) $guia->id_user) {
            return;
        }

        Interacao::create([
            'id_tipo_interacao_tin' => 3,
            'id_guia_gui' => $guia->id_guia_gui,
        ]);
    }

    private function contagemInteracoes($idGuia, $desde = null)
    {
        $consulta = Interacao::query()
            ->select('id_tipo_interacao_tin', DB::raw('COUNT(*) as total'))
            ->where('id_guia_gui', $idGuia)
            ->whereIn('id_tipo_interacao_tin', [1, 2, 3])
            ->groupBy('id_tipo_interacao_tin');

        if ($desde) {
            $consulta->where('created_at', '>=', $desde);
        }

        $mapa = [1 => 0, 2 => 0, 3 => 0];
        foreach ($consulta->get() as $linha) {
            $mapa[(int) $linha->id_tipo_interacao_tin] = (int) $linha->total;
        }

        return $mapa;
    }

    public function previaPerfil()
    {
        $titulo = 'Guias e Condutores';
        $subtitulo = "Perfil";

        if (Auth::guest() or trim(Auth::user()->id_role) != 'GUIA') {
            return redirect('login');
        }

        $guia = Guia::where('id_user', Auth::user()->id)->where('fl_perfil_completo_gui', true)->first();

        $page_name = "Perfil";

        if(empty($guia)) {
            Flash::error('Perfil incompleto! Preencha o restante das informações.');
            return redirect('guia-e-condutores/privado/atualizar-cadastro');
        }

        return view('guias/perfil', [
            'page_name' => $page_name,
            'guia' => $guia,
            'titulo' => $titulo,
            'subtitulo' => $subtitulo,
            'eventos_futuros' => $this->eventosFuturos($guia),
        ]);
    }

    public function trilhasRealizadas($identificador)
    {
        if (is_numeric($identificador)) {
            $guia = Guia::where('id_guia_gui', $identificador)->first();
        } else {
            $guia = Guia::where('nm_instagram_gui', $identificador)->first();
        }

        if (!$guia) {
            return view('guias/guia-not-found', [
                'page_name' => 'Trilhas realizadas',
                'guia' => null,
                'titulo' => 'Guias e Condutores',
                'subtitulo' => 'Trilhas realizadas',
            ]);
        }

        $eventos_realizados = $this->eventosRealizados($guia);

        $presencas = collect();
        if (Auth::check()) {
            $trilheiro = Trilheiro::where('id_user', Auth::id())->first();
            if ($trilheiro) {
                $presencas = $trilheiro->evento()->pluck('evento_eve.id_evento_eve');
            }
        }

        return view('guias/trilhas-realizadas', [
            'page_name' => 'Trilhas realizadas',
            'guia' => $guia,
            'eventos_realizados' => $eventos_realizados,
            'presencas' => $presencas,
        ]);
    }

    private function eventosRealizados(Guia $guia)
    {
        return $guia->eventos()
            ->with(['local', 'trilha.detalhes'])
            ->where('fl_cancelado_eve', false)
            ->where('dt_realizacao_eve', '<', now()->toDateString())
            ->orderBy('dt_realizacao_eve', 'desc')
            ->get();
    }

    private function totaisPercurso($eventos)
    {
        $km = 0;
        $subida = 0;
        $comKm = 0;
        $comSubida = 0;
        $cidades = [];

        foreach ($eventos as $evento) {
            $cidade = trim((string) optional($evento->local)->nm_cidade_cde);
            if ($cidade !== '') {
                $cidades[$cidade] = true;
            }

            $detalhe = optional($evento->trilha)->detalhes;
            if (!$detalhe) {
                continue;
            }

            if ($detalhe->nu_distancia_trd !== null && $detalhe->nu_distancia_trd !== '' && is_numeric($detalhe->nu_distancia_trd)) {
                $km += (float) $detalhe->nu_distancia_trd;
                $comKm++;
            }

            if ($detalhe->nu_altitude_trd !== null && $detalhe->nu_altitude_trd !== '' && is_numeric($detalhe->nu_altitude_trd)) {
                $subida += (float) $detalhe->nu_altitude_trd;
                $comSubida++;
            }
        }

        $total = $eventos->count();

        return [
            'km' => $this->formatarTotal($km),
            'subida' => $this->formatarTotal($subida, 0),
            'cidades' => count($cidades),
            'parcial' => $total > 0 && ($comKm < $total || $comSubida < $total),
        ];
    }

    private function formatarTotal($numero, $casas = null)
    {
        if ($casas === null) {
            $casas = abs($numero - round($numero)) < 0.001 ? 0 : 1;
        }

        return number_format($numero, $casas, ',', '.');
    }

    private function eventosFuturos(Guia $guia)
    {
        return $guia->eventos()
            ->with('trilha')
            ->where('fl_ativo_eve', true)
            ->where('fl_cancelado_eve', false)
            ->where('dt_realizacao_eve', '>=', now()->toDateString())
            ->orderBy('dt_realizacao_eve')
            ->get();
    }

    public function aprovar()
    {
        if (Auth::guest() or trim(Auth::user()->id_role) != 'ADMIN') {
            return redirect('login');
        }

        $guias_pendentes = Guia::where('fl_perfil_moderado_gui', false)->where('fl_perfil_recusado_gui', false)->get();
        $cadasturApi = app(CadasturService::class)->habilitado();

        return view('admin/guia/aprovar', compact('guias_pendentes', 'cadasturApi'));
    }

    public function conferirCadastur(Request $request, CadasturService $cadastur, $id)
    {
        if (Auth::guest() or trim(Auth::user()->id_role) != 'ADMIN') {
            return redirect('login');
        }

        $guia = Guia::with('user')->findOrFail($id);

        if ($request->acao === 'reconsultar') {
            if (!$cadastur->habilitado()) {
                Flash::error('API do Cadastur não configurada.');
                return redirect()->back();
            }

            try {
                $cadastur->verificar($guia);
                Flash::success('Cadastur de ' . e($guia->nm_guia_gui) . ' consultado: ' . str_replace('_', ' ', $guia->sg_cadastur_situacao_gui) . '.');
            } catch (CadasturIndisponivelException $e) {
                Flash::error('API do Cadastur indisponível: ' . e($e->getMessage()));
            }

            return redirect()->back();
        }

        $request->validate([
            'situacao' => 'nullable|in:' . implode(',', CadasturService::SITUACOES_OFICIAIS),
            'validade' => 'nullable|date|required_if:situacao,Regular,Vencido',
        ], [
            'validade.required_if' => 'Informe a validade do certificado para a situação ":value".',
        ]);

        $cadastur->aplicarManual($guia, $request->situacao, $request->validade, $request->has('titular_confere'));

        Flash::success('Conferência do Cadastur de ' . e($guia->nm_guia_gui) . ' salva: ' . str_replace('_', ' ', $guia->sg_cadastur_situacao_gui) . '.');

        return redirect()->back();
    }

    public function listar()
    {
        if (Auth::guest() or trim(Auth::user()->id_role) != 'ADMIN') {
            return redirect('login');
        }

        $page_name = "Guias e Condutores em Santa Catarina";
        $titulo = 'Guias e Condutores';
        
        $guias = Guia::with('user')->get();
        $cadasturApi = app(CadasturService::class)->habilitado();

        return view('admin/guia/listar', ['page_name' => $page_name, 'guias' => $guias, 'cadasturApi' => $cadasturApi]);
    }

    public function ativar($guia_id)
    {
        if (Auth::guest() or trim(Auth::user()->id_role) != 'ADMIN') {
            return redirect('login');
        }

        $guia = Guia::where('id_guia_gui', $guia_id)->update(['fl_perfil_moderado_gui' => true]);
        
        if($guia) {
            Mail::send(new GuiaConfirmacao(Guia::where('id_guia_gui', $guia_id)->first()));
        }

        return redirect('guias-e-condutores');

    }

    public function recusar($guia)
    {
        if (Auth::guest() or trim(Auth::user()->id_role) != 'ADMIN') {
            return redirect('login');
        }

        Guia::where('id_guia_gui', $guia)->update(['fl_perfil_moderado_gui' => false, 'fl_perfil_recusado_gui' => true]);

        return redirect('guias-e-condutores');

    }

    public function trilhas(Request $request)
    {
        if (Auth::guest() or trim(Auth::user()->id_role) != 'GUIA') {
            return redirect('login');
        }
        //dd($request);
        $guia = Guia::where('id_user', Auth::user()->id)->first();

        if($request->isMethod('post')) {
            GuiaTrilha::where('id_guia_gui',$guia->id_guia_gui)->delete();

            if(isset($request->trilhas)) {
                foreach($request->trilhas as $id){
                    GuiaTrilha::create([
                        'id_trilha_tri' => $id,
                        'id_guia_gui' => $guia->id_guia_gui
                    ]);
                }
            }

            Flash::success('Trilhas atualizadas com sucesso!');
        }

        $cidades = Cidade::has('trilhas')->with(['trilhas' => function($query){
            $query->orderBy('nm_trilha_tri');
        }])->orderBy('nm_cidade_cde')->get();

        $qtdGuiasPorTrilha = null;
        DB::table('guia_trilha_gut')->selectRaw('id_trilha_tri, count(*) as qtd_guias')->where('id_guia_gui','!=',$guia->id_guia_gui)->groupBy('id_trilha_tri')->get()->map(function($item) use(&$qtdGuiasPorTrilha) {
            $qtdGuiasPorTrilha[$item->id_trilha_tri] = $item->qtd_guias;
        });

        $trilhasGuia = GuiaTrilha::where('id_guia_gui',$guia->id_guia_gui)->pluck('id_trilha_tri')->toArray();

        return view('guias/trilhas', compact('cidades', 'trilhasGuia', 'qtdGuiasPorTrilha', 'guia'));
    }

    public function salvarStory(Request $request, $id)
    {
        if (Auth::guest() or trim(Auth::user()->id_role) != 'ADMIN') {
            return redirect('login');
        }

        $guia = Guia::findOrFail($id);

        if ($request->filled('remover_story') && $request->input('remover_story') == '1') {
            $this->removerImagemStory($guia);
            $guia->update(['ds_path_story_instagram_gui' => null]);
            Flash::success('Imagem do story removida.');
        }

        if (!$request->hasFile('imagem_story')) {
            return redirect()->back();
        }

        $arquivo = $request->file('imagem_story');
        $extensao = strtolower($arquivo->getClientOriginalExtension());

        if (!in_array($extensao, ['jpg', 'jpeg', 'png', 'webp'], true)) {
            Flash::error('A imagem do story deve ser JPG, PNG ou WEBP.');
            return redirect()->back();
        }

        if ($arquivo->getSize() > 8 * 1024 * 1024) {
            Flash::error('A imagem do story deve ter no máximo 8 MB.');
            return redirect()->back();
        }

        $dir = public_path('img/instagram/stories');
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $fileName = 'guia-' . $guia->id_guia_gui . '-story-' . date('YmdHis') . '.jpg';
        $this->removerImagemStory($guia);

        $imagem = \Image::make($arquivo->getRealPath());
        if (function_exists('exif_read_data')) {
            $imagem->orientate();
        }
        $imagem->encode('jpg', 90)->save($dir . DIRECTORY_SEPARATOR . $fileName);

        $guia->update(['ds_path_story_instagram_gui' => $fileName]);
        Flash::success('Imagem do story salva com sucesso.');

        return redirect()->back();
    }

    private function removerImagemStory(Guia $guia)
    {
        if (empty($guia->ds_path_story_instagram_gui)) {
            return;
        }

        $caminho = public_path('img/instagram/stories/' . basename($guia->ds_path_story_instagram_gui));
        if (is_file($caminho)) {
            @unlink($caminho);
        }
    }

}
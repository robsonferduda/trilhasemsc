<?php

namespace App\Http\Controllers;

use App\Cidade;
use App\Fone;
use App\Guia;
use App\GuiaTrilha;
use App\Trilheiro;
use App\Trilha;
use App\Interacao;
use App\Mail\GuiaConfirmacao;
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
            return view('guias/perfil', ['page_name' => $page_name, 'guia' => $guia, 'titulo' => $titulo, 'subtitulo' => $subtitulo ]);
        }else{
            return view('guias/guia-not-found', ['page_name' => $page_name, 'guia' => $guia, 'titulo' => $titulo, 'subtitulo' => $subtitulo ]);
        }        
    }

    public function estatisticas($tipo, $identificador)
    {
        $url = null;
        $interacao = 0;

        if(is_numeric($identificador))
            $guia = Guia::where('id_guia_gui', $identificador)->first();
        else
            $guia = Guia::where('nm_instagram_gui', $identificador)->first();

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

        $dados = array('id_tipo_interacao_tin' => $interacao,
                       'id_guia_gui' => $guia->id_guia_gui);

        Interacao::create($dados);

        return redirect($url);
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
                                'cadastur' => $request->cadastur
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
                    
                    return redirect('trilheiro/privado/perfil');

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

        return view('guias/perfil', ['page_name' => $page_name, 'guia' => $guia, 'titulo' => $titulo, 'subtitulo' => $subtitulo ]);
    }

    public function aprovar()
    {
        if (Auth::guest() or trim(Auth::user()->id_role) != 'ADMIN') {
            return redirect('login');
        }

        $guias_pendentes = Guia::where('fl_perfil_moderado_gui', false)->where('fl_perfil_recusado_gui', false)->get();

        return view('admin/guia/aprovar', compact('guias_pendentes'));
    }

    public function listar()
    {
        if (Auth::guest() or trim(Auth::user()->id_role) != 'ADMIN') {
            return redirect('login');
        }

        $page_name = "Guias e Condutores em Santa Catarina";
        $titulo = 'Guias e Condutores';
        
        $guias = Guia::all();

        return view('admin/guia/listar', ['page_name' => $page_name, 'guias' => $guias]);
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

            if(isset($request->trilhas) == false || count($request->trilhas) < 6) {
                GuiaTrilha::where('id_guia_gui',$guia->id_guia_gui)->delete();

                if(isset($request->trilhas)) {            
                    foreach($request->trilhas as $id){
                        GuiaTrilha::create([
                            'id_trilha_tri' => $id,
                            'id_guia_gui' => $guia->id_guia_gui
                        ]);
                    }
                }
            } else {
                
                Flash::error('Limite de trilhas excedido!');                
            }
                             
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


}
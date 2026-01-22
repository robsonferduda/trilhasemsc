<?php

namespace App\Http\Controllers;

use App\Cidade;
use App\Estado;
use App\Fone;
use App\Corrida;
use App\Guia;
use App\Evento;
use App\Trilheiro;
use App\Distancia;
use App\Elevacao;
use App\Trilha;
use App\Interacao;
use App\Questionario;
use App\Mail\GuiaConfirmacao;
use App\UnidadeConservacao;
use App\Mail\GuiaModeracao;
use App\Mail\BoasVindasTrilheiro;
use App\TrilheiroTrilha;
use App\User;
use Auth;
use Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Laracasts\Flash\Flash;

class TrilheiroController extends Controller
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

    public function show($id)
    {
        $titulo = 'Guias e Condutores';
        $subtitulo = "Perfil";
        $page_name = "Perfil";
        
        $trilheiro = Trilheiro::where('id_trilheiro_tri', $id)->first();

        return view('trilheiro/perfil', ['page_name' => $page_name, 'trilheiro' => $trilheiro, 'titulo' => $titulo, 'subtitulo' => $subtitulo ]);
    }

    public function eventos()
    {
        $trilheiro = Trilheiro::where('id_user', Auth::user()->id)->first();
        $eventos = $trilheiro->evento()->withPivot('fl_aceito_guia_evt', 'fl_pago_evt')->get();

        return view('admin/eventos/trilheiro', compact('trilheiro','eventos'));
    }

    public function perfil()
    {
        $titulo = 'Guias e Condutores';
        $subtitulo = "Perfil";
        $page_name = "Perfil";
        
        $trilheiro = Trilheiro::where('id_user', Auth::user()->id)->first();

        return view('trilheiro/perfil', ['page_name' => $page_name, 'trilheiro' => $trilheiro, 'titulo' => $titulo, 'subtitulo' => $subtitulo ]);
    }

    public function score()
    {
        if (Auth::guest() or trim(Auth::user()->id_role) != 'TRILHEIRO') {
            return redirect('login');
        }

        $page_name = "Guias e Condutores em Santa Catarina";
        $titulo = 'Guias e Condutores';
        
        $corridas = Corrida::all();
        $elevacoes = Elevacao::all();
        $distancias = Distancia::all();
        $trilheiro = Trilheiro::where('id_user', Auth::user()->id)->first();
        $questionario = Questionario::where('cd_trilheiro_tri', $trilheiro->id_trilheiro_tri)->first();

        return view('trilheiro/score', ['page_name' => $page_name, 'trilheiro' => $trilheiro, 'elevacoes' => $elevacoes, 'distancias' => $distancias, 'questionario' => $questionario, 'corridas' => $corridas]);
    }

    public function listar(Request $request)
    {
        if (Auth::guest() or trim(Auth::user()->id_role) != 'ADMIN') {
            return redirect('login');
        }

        $page_name = "Guias e Condutores em Santa Catarina";
        $titulo = 'Guias e Condutores';
        
        // Primeira carga - apenas estrutura
        $trilheiros = collect();

        return view('admin/trilheiro/listar', ['page_name' => $page_name, 'trilheiros' => $trilheiros]);
    }

    public function listarAjax(Request $request)
    {
        if (Auth::guest() or trim(Auth::user()->id_role) != 'ADMIN') {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        try {
            $query = Trilheiro::with(['user', 'origem', 'indice']);
            
            $temFiltros = false;
            
            // Filtros de busca
            if ($request->has('nome') && $request->nome) {
                $query->where('nm_trilheiro_tri', 'ILIKE', '%' . $request->nome . '%');
                $temFiltros = true;
            }
            
            if ($request->has('email') && $request->email) {
                $query->whereHas('user', function($q) use ($request) {
                    $q->where('email', 'ILIKE', '%' . $request->email . '%');
                });
                $temFiltros = true;
            }
            
            if ($request->has('cidade') && $request->cidade) {
                $query->whereHas('origem', function($q) use ($request) {
                    $q->where('nm_cidade_cde', 'ILIKE', '%' . $request->cidade . '%');
                });
                $temFiltros = true;
            }
            
            if ($request->filled('newsletter')) {
                $query->where('fl_newsletter_tri', $request->newsletter == '1');
                $temFiltros = true;
            }
            
            // Se não houver filtros, limita aos 10 últimos cadastrados
            if (!$temFiltros) {
                $trilheiros = $query->orderBy('created_at','DESC')->limit(10)->paginate(10);
            } else {
                $trilheiros = $query->orderBy('created_at','DESC')->paginate(10);
            }
            
            return response()->json([
                'success' => true,
                'html' => view('admin/trilheiro/partials/lista', compact('trilheiros'))->render()
            ]);
        } catch (\Exception $e) {
            \Log::error('Erro ao carregar trilheiros AJAX', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function atualizarCadastro(Request $request)
    {
        if (Auth::guest() or trim(Auth::user()->id_role) != 'TRILHEIRO') {
            return redirect('login');
        }
        
        $usuario = Auth::user();
        $trilheiro = Trilheiro::where('id_user', Auth::user()->id)->first();

        $trilheiroNovo = false;

        if(empty($trilheiro)) {
            $trilheiro = Trilheiro::create([
                'id_user' => Auth::user()->id,
                'nm_trilheiro_tri' => Auth::user()->name
            ]);

            // Carrega o relacionamento user
            $trilheiro->load('user');
            
            $trilheiroNovo = true;
        }

        $estados = Estado::orderBy('nm_estado_est')->get();

        $cidades = Cidade::where('cd_estado_est', 42)->orderBy('nm_cidade_cde')->get();

        if($request->isMethod('post')) {

            $validated = $request->validate([
                'nome' => 'required',
                'email' => 'required',
                'cidade_origem' => 'required'
            ]);

            $nome = $request->nome;
            $email = $request->email;
            $cidadeOrigem = $request->cidade_origem;
            $imagem_deletada = $request->imagem_deletada;
            $estado = $request->estado_origem;
            $sexo = $request->sexo;
            $objetivos = $request->objetivos;
            $dt_nascimento = date('Y-m-d', strtotime(str_replace('/', '-', $request->dt_nascimento)));

            $trilheiro->update([
                'cd_cidade_tri' => $cidadeOrigem,
                'nm_trilheiro_tri' => $nome,
                'cd_estado_est' => $estado,
                'cd_sexo_sex' => $sexo,
                'dt_nascimento' => $dt_nascimento,
                'ds_objetivos_tri' => $objetivos
            ]);

            $imagem = null;

            $base64Image = $request->input('cropped_image');

            if ($base64Image) {
                $base64Image = preg_replace('/^data:image\/\w+;base64,/', '', $base64Image);
                $base64Image = base64_decode($base64Image);

                $croppedPath = Storage::disk('trilheiros')->put($trilheiro->id_trilheiro_tri.'.jpg', $base64Image);

                $trilheiro->update(['nm_path_foto_tri' => $trilheiro->id_trilheiro_tri.'.jpg']);
            }

            /*
            if ($request->hasFile('imagem')) {
                $extension = $request->file('imagem')->getClientOriginalExtension();
                $filename = $trilheiro->id_trilheiro_tri . '.' . $extension;
                $imagem = $request->imagem->storeAs('', $filename, 'trilheiros');
            }else{
                $imagem = $trilheiro->nm_path_foto_tri;
            }

            if($request->hasFile('imagem')) {
                $trilheiro->update(['nm_path_foto_tri' => $imagem]);
            } else {

                if($imagem_deletada == "true") {
                    $trilheiro->update(['nm_path_foto_tri' => null]);
                }
            }*/

            Auth::user()->update(['name' =>  $nome, 'dc_foto_perfil' => $trilheiro->id_trilheiro_tri.'.jpg']);

            // Envia email de boas-vindas se for um novo trilheiro
            if ($trilheiroNovo) {
                try {
                    Mail::to(Auth::user()->email)->send(new BoasVindasTrilheiro($trilheiro));
                    
                    \Log::info('Email de boas-vindas enviado com sucesso', [
                        'trilheiro_id' => $trilheiro->id_trilheiro_tri,
                        'user_email' => Auth::user()->email,
                        'timestamp' => now()
                    ]);
                } catch (\Exception $e) {
                    \Log::error('Erro ao enviar email de boas-vindas', [
                        'error' => $e->getMessage(),
                        'trilheiro_id' => $trilheiro->id_trilheiro_tri,
                        'user_email' => Auth::user()->email,
                    ]);
                }
            }

            // Envia email de notificação para o administrador
            $tipoNotificacao = $trilheiroNovo ? 'Novo Trilheiro' : 'Atualização de Cadastro';
            
            try {
                Mail::send(new \App\Mail\NovoTrilheiroNotificacao(Auth::user(), $trilheiro));
                
                // Log de sucesso
                \Log::info('Email de notificação enviado com sucesso', [
                    'tipo' => $tipoNotificacao,
                    'trilheiro_id' => $trilheiro->id_trilheiro_tri,
                    'user_id' => Auth::user()->id,
                    'user_email' => Auth::user()->email,
                    'user_name' => $nome,
                    'cidade' => $cidadeOrigem,
                    'estado' => $estado,
                    'timestamp' => now()
                ]);
            } catch (\Exception $e) {
                // Log do erro mas não interrompe o processo
                \Log::error('Erro ao enviar email de notificação', [
                    'tipo' => $tipoNotificacao,
                    'error' => $e->getMessage(),
                    'trilheiro_id' => $trilheiro->id_trilheiro_tri ?? null,
                    'user_id' => Auth::user()->id,
                    'user_email' => Auth::user()->email,
                    'timestamp' => now(),
                    'trace' => $e->getTraceAsString()
                ]);
            }

            return redirect('trilheiro/privado/perfil')->withInput();
        }

        return view('trilheiro/atualizar-cadastro', compact('estados', 'cidades','trilheiro','usuario'));
    }

    public function calcularScore(Request $request)
    {
        $score = 0;
        $trilheiro = Trilheiro::where('id_user', Auth::user()->id)->first();
        $chave = array('cd_trilheiro_tri' => $trilheiro->id_trilheiro_tri);

        $dados = array('cd_distancia_dis' => $request->escala_distancia,
                       'cd_elevacao_ele' => $request->escala_elevacao,
                        'cd_corrida_cor' => $request->escala_corrida,
                        'fl_musculacao_que' => $request->fl_musculacao_que,
                        'fl_travessia_que' => $request->fl_travessia,
                        'fl_trilhas_que' => $request->fl_trilhas,
                        'fl_trekking_que' => $request->fl_trekking,
                        'fl_areia_que' => $request->fl_areia,
                        'fl_altura_que' => !$request->fl_altura,
                        'nu_distancia_que' => $request->nu_distancia,
                        'nu_altura_que' => $request->altura,
                        'nu_peso_que' => $request->peso);

        $questionario = Questionario::updateOrCreate($chave, $dados);

        if($questionario){
            $score = $this->calculaScore($trilheiro, $questionario);
            $trilheiro->id_indice_ind = $this->calculaIndice($score);
            $trilheiro->save();

            Flash::success('<i class="fa fa-check"></i> Questionário atualizado com sucesso. Seu score é <strong>'.$score.'</strong> e seu Índice de Experiência em Trilha (IET) é <strong>'.$trilheiro->indice->ds_indice_ind.'</strong>');
        }else{
            Flash::error('Erro ao atualizar questionário');
        }

        return redirect('trilheiro/privado/perfil');
    }

    public function calculaScore($trilheiro, $questionario){
        
        $score = 0;

        $score += $this->calculaIMC($questionario->nu_altura_que, $questionario->nu_peso_que); //150
        $score += $this->calculaDistancia($questionario->nu_distancia_que); //60
        $score += $questionario->distancia->nu_score_dis; //200
        $score += $questionario->elevacao->nu_score_ele; //200
        $score += $questionario->corrida->nu_score_cor; //100

        if($questionario->fl_musculacao_que){
            $score += 100;
        }

        if($questionario->fl_areia_que){
            $score += 30;
        }

        if($questionario->fl_travessia_que){
            $score += 30;
        }

        if(!$questionario->fl_altura_que){
            $score += 30;
        }

        if($questionario->fl_trekking_que){
            $score += 100;
        }

        $trilheiro->nr_score_tri = $score;
        $trilheiro->save();
        
        return $score;
    }


    public function calculaDistancia($distancia){

        $score = 0;

        $dicionario = [
            0 => 0,
            5 => 20,
            10 => 40
        ];

        foreach($dicionario as $key => $value){
            if($distancia > 10){
                return 60;
            }else{
                if($distancia <= $key){
                    return $value;
                    break;
                }
            }
        }

    }

    public function calculaIndice($score){
        
        $indice = 1;

        $dicionario = [
            280 => 2,
            410 => 3,
            810 => 4,
            935 => 5,
            1000 => 6
        ];

        foreach($dicionario as $key => $value){
            if($score >= $key){
                $indice = $value;
            }
        }

        return $indice;
    }

    public function calculaIMC($altura, $peso){

        $imc = $peso / ($altura * 2);

        $dicionario = [
            "18.5" => 135,
            "24.9" => 150,
            "29.9" => 135,
            "34.9" => 120,
            "39.9" => 100,
            "40.0" => 80
        ];

        foreach($dicionario as $key => $value){
        
            if((float) $key < 40.0){
                if($imc <= (float) $key){
                    return $value;
                    break;
                }
            }else{ 
                return $value;
            }
        }
    }

    public function trilhas(Request $request)
    {

        if (Auth::guest() or trim(Auth::user()->id_role) != 'TRILHEIRO') {
            return redirect('login');
        }
       
        $trilheiro = Trilheiro::where('id_user', Auth::user()->id)->first();

        if($request->isMethod('post')) {

            $experiencia = 0;
            
            TrilheiroTrilha::where('id_trilheiro_tri',$trilheiro->id_trilheiro_tri)->delete();

            if(isset($request->trilhas)) {            
                foreach($request->trilhas as $id){
                    TrilheiroTrilha::create([
                        'id_trilha_tri' => $id,
                        'id_trilheiro_tri' => $trilheiro->id_trilheiro_tri
                    ]);
                }
            }  

            $trilhasTrilheiro = TrilheiroTrilha::where('id_trilheiro_tri',$trilheiro->id_trilheiro_tri)->pluck('id_trilha_tri')->toArray();
            $trilhasIndice = Trilha::whereIn('id_trilha_tri',$trilhasTrilheiro)->get();

            foreach($trilhasIndice as $trilha){

                if($trilha->complemento){
                    $experiencia += $trilha->complemento->nu_pontos_con;
                }
            }

            $trilheiro->nu_pontos_experiencia_tri = $experiencia;
            $trilheiro->save();
            
            return redirect('trilheiro/privado/perfil');
        }

        $trilhasTrilheiro = TrilheiroTrilha::where('id_trilheiro_tri',$trilheiro->id_trilheiro_tri)->pluck('id_trilha_tri')->toArray();

        $cidades = Cidade::has('trilhas')->with(['trilhas' => function($query){
            $query->orderBy('nm_trilha_tri');
        }])->orderBy('nm_cidade_cde')->get();
      
        return view('trilheiro/trilhas', compact('cidades', 'trilhasTrilheiro', 'trilheiro'));
    }

    public function enviarEmailBoasVindas($id)
    {
        try {
            $trilheiro = Trilheiro::with("user")->findOrFail($id);
            
            if (!$trilheiro->user) {
                Flash::error("Trilheiro não possui usuário associado.");
                return redirect()->back();
            }

            Mail::to($trilheiro->user->email)->send(new BoasVindasTrilheiro($trilheiro));
            
            \Log::info("Email de boas-vindas enviado via admin", [
                "trilheiro_id" => $trilheiro->id_trilheiro_tri,
                "user_email" => $trilheiro->user->email,
                "admin_user_id" => Auth::user()->id,
                "timestamp" => now()
            ]);
            
            Flash::success("Email de boas-vindas enviado com sucesso para " . $trilheiro->user->email);
            
        } catch (\Exception $e) {
            \Log::error("Erro ao enviar email de boas-vindas via admin", [
                "error" => $e->getMessage(),
                "trilheiro_id" => $id,
                "admin_user_id" => Auth::user()->id,
            ]);
            
            Flash::error("Erro ao enviar email: " . $e->getMessage());
        }
        
        return redirect()->back();
    }

    public function enviarEmailQuestionario($id)
    {
        try {
            $trilheiro = Trilheiro::with("user")->findOrFail($id);
            
            if (!$trilheiro->user) {
                Flash::error("Trilheiro não possui usuário associado.");
                return redirect()->back();
            }

            Mail::to($trilheiro->user->email)->send(new \App\Mail\ConviteQuestionarioScore($trilheiro));
            
            \Log::info("Email de convite ao questionário enviado via admin", [
                "trilheiro_id" => $trilheiro->id_trilheiro_tri,
                "user_email" => $trilheiro->user->email,
                "admin_user_id" => Auth::user()->id,
                "timestamp" => now()
            ]);
            
            Flash::success("Email de convite ao questionário enviado com sucesso para " . $trilheiro->user->email);
            
        } catch (\Exception $e) {
            \Log::error("Erro ao enviar email de convite ao questionário via admin", [
                "error" => $e->getMessage(),
                "trilheiro_id" => $id,
                "admin_user_id" => Auth::user()->id,
            ]);
            
            Flash::error("Erro ao enviar email: " . $e->getMessage());
        }
        
        return redirect()->back();
    }

    public function enviarEmailQuestionarioEmMassa()
    {
        try {
            // Busca trilheiros sem score (null ou 0) e com usuário associado
            $trilheiros = Trilheiro::with('user')
                ->whereHas('user')
                ->where(function($query) {
                    $query->whereNull('nr_score_tri')
                          ->orWhere('nr_score_tri', 0);
                })
                ->get();
            
            if ($trilheiros->isEmpty()) {
                Flash::warning("Não há trilheiros sem score para enviar emails.");
                return redirect()->back();
            }

            $enviados = 0;
            $erros = 0;

            foreach ($trilheiros as $trilheiro) {
                try {
                    Mail::to($trilheiro->user->email)->send(new \App\Mail\ConviteQuestionarioScore($trilheiro));
                    $enviados++;
                    
                    \Log::info("Email de convite ao questionário enviado em massa", [
                        "trilheiro_id" => $trilheiro->id_trilheiro_tri,
                        "user_email" => $trilheiro->user->email
                    ]);
                } catch (\Exception $e) {
                    $erros++;
                    \Log::error("Erro ao enviar email em massa", [
                        "trilheiro_id" => $trilheiro->id_trilheiro_tri,
                        "error" => $e->getMessage()
                    ]);
                }
            }
            
            if ($erros > 0) {
                Flash::warning("Emails enviados: {$enviados}. Erros: {$erros}. Verifique os logs para mais detalhes.");
            } else {
                Flash::success("Emails enviados com sucesso para {$enviados} trilheiro(s) sem score!");
            }
            
        } catch (\Exception $e) {
            \Log::error("Erro geral no envio em massa de emails de questionário", [
                "error" => $e->getMessage(),
                "admin_user_id" => Auth::user()->id,
            ]);
            
            Flash::error("Erro ao enviar emails: " . $e->getMessage());
        }
        
        return redirect()->back();
    }
}
<?php

namespace App\Http\Controllers;

use App\Cidade;
use App\Estado;
use App\Fone;
use App\Corrida;
use App\Guia;
use App\Trilheiro;
use App\Distancia;
use App\Elevacao;
use App\Trilha;
use App\Interacao;
use App\Questionario;
use App\Mail\GuiaConfirmacao;
use App\UnidadeConservacao;
use App\Mail\GuiaModeracao;
use App\User;
use Auth;
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

    public function listar()
    {
        if (Auth::guest() or trim(Auth::user()->id_role) != 'ADMIN') {
            return redirect('login');
        }

        $page_name = "Guias e Condutores em Santa Catarina";
        $titulo = 'Guias e Condutores';
        
        $trilheiros = Trilheiro::orderBy('created_at','DESC')->get();

        return view('admin/trilheiro/listar', ['page_name' => $page_name, 'trilheiros' => $trilheiros]);
    }

    public function atualizarCadastro(Request $request)
    {
        if (Auth::guest() or trim(Auth::user()->id_role) != 'TRILHEIRO') {
            return redirect('login');
        }
        
        $usuario = Auth::user();
        $trilheiro = Trilheiro::where('id_user', Auth::user()->id)->first();

        if(empty($trilheiro)) {
            $trilheiro = Trilheiro::create([
                'id_user' => Auth::user()->id,
                'nm_trilheiro_tri' => Auth::user()->name
            ]);
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
            $dt_nascimento = date('Y-m-d', strtotime(str_replace('/', '-', $request->dt_nascimento)));

            $trilheiro->update([
                'cd_cidade_tri' => $cidadeOrigem,
                'nm_trilheiro_tri' => $nome,
                'cd_estado_est' => $estado,
                'cd_sexo_sex' => $sexo,
                'dt_nascimento' => $dt_nascimento
            ]);

            $imagem = null;

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
            }

            Auth::user()->update(['name' =>  $nome, 'dc_foto_perfil' => $imagem]);
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

        return redirect('trilheiro/privado/meu-score');
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
}
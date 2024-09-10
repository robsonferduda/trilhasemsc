<?php

namespace App\Http\Controllers;

use App\Cidade;
use App\Estado;
use App\Fone;
use App\Guia;
use App\Trilheiro;
use App\Trilha;
use App\Interacao;
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
        
        $trilheiros = Trilheiro::all();

        return view('trilheiro/score', ['page_name' => $page_name, 'trilheiros' => $trilheiros]);
    }

    public function listar()
    {
        if (Auth::guest() or trim(Auth::user()->id_role) != 'ADMIN') {
            return redirect('login');
        }

        $page_name = "Guias e Condutores em Santa Catarina";
        $titulo = 'Guias e Condutores';
        
        $trilheiros = Trilheiro::all();

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

            $trilheiro->update([
                'cd_cidade_tri' => $cidadeOrigem,
                'nm_trilheiro_tri' => $nome,
                'cd_estado_est' => $estado,
                'cd_sexo_sex' => $sexo
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
                    $trilheiro->update(['nm_path_foto_tri' => $imagem]);
                }
            }

            Auth::user()->update(['name' =>  $nome, 'dc_foto_perfil' => $imagem]);
        }

        return view('trilheiro/atualizar-cadastro', compact('estados', 'cidades','trilheiro','usuario'));
    }

    public function calcularScore(Request $request)
    {
        dd($request->all());
    }
}
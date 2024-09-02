<?php

namespace App\Http\Controllers;

use App\Cidade;
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

class CadastroController extends Controller
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
        
    }

    public function selecionarPerfil(Request $request)
    {
        if (Auth::guest() or trim(Auth::user()->id_role) != 'SOCIAL') {
            return redirect('login');
        }
        
        $usuario = User::find(Auth::user()->id);
        
        $cidades = Cidade::where('cd_estado_est', 42)->orderBy('nm_cidade_cde')->get();

        if($request->isMethod('post')) {

            $validated = $request->validate([
                'tipo_cadastro' => 'required'
            ],['tipo_cadastro.required' => "Obrigatório escolher a atividade"]);

            $tipo = $request->tipo_cadastro;
         
            switch ($tipo) {
                case 'guia':
                    $usuario->id_role = "GUIA";
                    $usuario->save();

                    return redirect('guia-e-condutores/privado/atualizar-cadastro');
                    break;
                case 'trilheiro':
                    $usuario->id_role = "TRILHEIRO";
                    $usuario->save();

                    return redirect('trilheiro/privado/atualizar-cadastro');
                    break;
                default:
                    # code...
                    break;
            }
            
        }

        return view('cadastro/selecionar-perfil', compact('cidades','usuario'));
    }
}
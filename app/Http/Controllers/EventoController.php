<?php

namespace App\Http\Controllers;

use Auth;
use App\Evento;
use App\Cidade;
use App\Guia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class EventoController extends Controller
{
    public function index()
    {
        $page_name = "Eventos e Trilhas em Santa Catarina";
        $eventos = Evento::all();
        $cidades = Cidade::whereIn('cd_cidade_cde', Evento::select('cd_cidade_cde')->get())->orderBy('nm_cidade_cde')->select('cd_cidade_cde', 'nm_cidade_cde')->get();

        return view('eventos/index', ['page_name' => $page_name, 'eventos' => $eventos, 'cidades' => $cidades]);
    }

    public function detalhes($id)
    {
        $evento = Evento::find($id);
        $page_name = "Eventos e Trilhas em Santa Catarina - ".$evento->nm_evento_eve;
        
        $dados = array('id_tipo_interacao_tin' => 5,
                       'id_guia_gui' => $id);

        return view('eventos/detalhes', ['page_name' => $page_name, 'evento' => $evento]);
    }

    public function eventos()
    {
        $guia = Guia::where('id_user', Auth::user()->id)->first();

        return view('admin/eventos/listar', compact('guia'));
    }

    public function cadastro()
    {
        $guia = Guia::where('id_user', Auth::user()->id)->first();
        $cidades = Cidade::where('cd_estado_est', 42)->orderBy('nm_cidade_cde')->get();

        return view('admin/eventos/cadastro', compact('guia','cidades'));
    }

    public function cadastrar(Request $request)
    {
        if (Auth::guest() or trim(Auth::user()->id_role) != 'GUIA') {
            return redirect('login');
        }
        //dd($request);
        $guia = Guia::where('id_user', Auth::user()->id)->first();

        dd($guia);
    }
}
<?php

namespace App\Http\Controllers;

use App\Evento;
use App\Cidade;
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
}
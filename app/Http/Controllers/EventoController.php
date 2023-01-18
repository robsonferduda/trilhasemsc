<?php

namespace App\Http\Controllers;

use App\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class EventoController extends Controller
{
    public function index()
    {
        $page_name = "Eventos";
        $eventos = Evento::all();

        return view('eventos/index', ['page_name' => $page_name, 'eventos' => $eventos]);
    }

    public function detalhes($id)
    {
        $evento = Evento::find($id);
        $page_name = "Detalhes";
        
        $dados = array('id_tipo_interacao_tin' => 5,
                       'id_guia_gui' => $id);

        return view('eventos/detalhes', ['page_name' => $page_name, 'evento' => $evento]);
    }
}
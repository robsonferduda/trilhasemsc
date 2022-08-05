<?php

namespace App\Http\Controllers;

use App\Guia;
use App\Interacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class GuiaController extends Controller
{
    public function index()
    {
        $page_name = "Guias";
        $guias = Guia::orderBy("nm_guia_gui")->get();

        return view('guias/index', ['page_name' => $page_name, 'guias' => $guias]);
    }

    public function estatisticas($tipo, $id)
    {
        $interacao = 0;

        switch ($tipo) {
            case 'instagram':
                $interacao = 1;
                break;
            
            case 'telefone':
                $interacao = 2;
                break;
        }

        $dados = array('id_tipo_interacao_tin' => $interacao,
                       'id_guia_gui' => $id);

        Interacao::create($dados);
    }
}
<?php

namespace App\Http\Controllers;

use DB;
use App\UnidadeConservacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UCController extends Controller
{
    
    public function index()
    {
        $page_name = "Unidades de Conservação em Santa Catarina";
        $unidades = UnidadeConservacao::all();

        return view('unidades/index', compact('page_name','unidades'));
    }

    public function detalhes($sigla)
    {
        $unidade = UnidadeConservacao::where('sigla_unc',$sigla)->first();
        $page_name = "Unidades de Conservação em Santa Catarina ".$unidade->nm_unidade_conservacao_instancia_uci;

        return view('unidades/detalhes', compact('page_name','unidade'));
    }
  
}
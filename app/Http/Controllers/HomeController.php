<?php

namespace App\Http\Controllers;

use App\Trilha;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        /* 
            - Criar Enun para Categoria
            - Criar tabelas de Galeria de Fotos
        */
        
        $totais = array('trilha'  => Trilha::where('id_categoria_cat',1)->count(),
                        'camping' => Trilha::where('id_categoria_cat',2)->count(),
                        'galeria' => null );

        $ultimas = Trilha::with('foto')->orderBy('created_at','DESC')->take(2)->get();
        $preferidas = Trilha::with('foto')->orderBy('total_votos_tri','ASC')->take(4)->get();

        return view('home',['totais' => $totais, 'ultimas' => $ultimas, 'preferidas' => $preferidas, 'teste' => 'teste']);
    }
}

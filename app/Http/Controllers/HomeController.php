<?php

namespace App\Http\Controllers;

use App\Trilha;
use App\Cidade;
use App\Nivel;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        /* 
            - Criar Enun para Categoria
            - Criar tabelas de Galeria de Fotos
        */
        $page_name = "Trilha";
        
        $totais = array('trilha'  => Trilha::where('id_categoria_cat',1)->count(),
                        'camping' => Trilha::where('id_categoria_cat',2)->count(),
                        'galeria' => null );

        $cidades = Cidade::whereIn('cd_cidade_cde',Trilha::select('cd_cidade_cde')->get())->orderBy('nm_cidade_cde')->select('cd_cidade_cde','nm_cidade_cde')->get();

        $niveis = Nivel::get();

        $ultimas = Trilha::with('foto')->orderBy('created_at','DESC')->take(2)->get();
        $preferidas = Trilha::with('foto')->orderBy('total_votos_tri','ASC')->take(5)->get();

        return view('home',['totais' => $totais, 'ultimas' => $ultimas, 'preferidas' => $preferidas ,'cidades' => $cidades, 'niveis' => $niveis, 'page_name' => $page_name]);
    }

    public function guia()
    {
        $page_name = "Guia";

        return view('guia',['page_name' => $page_name]);
    }

    public function sobre()
    {
        $page_name = "Sobre";

        return view('sobre',['page_name' => $page_name]);
    }

    public function camping()
    {
        $page_name = "Camping";

        return view('camping',['page_name' => $page_name]);
    }

    public function contato()
    {
        $page_name = "Contato";

        return view('contato',['page_name' => $page_name]);
    }
}
<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use URL;
use App\Tag;
use App\Trilha;
use App\Comentario;
use Laracasts\Flash\Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\ComentarioRequest;

class CampingController extends Controller
{
    public function __construct()
    {
        //
    }

    public function index()
    {
       
    }

    public function campings()
    {
        $titulo = 'Camping';
        $subtitulo = "Lista de Camping";

        $busca_cidade = Trilha::with('cidade')
        ->select('cd_cidade_cde', DB::raw('count(*) as total'))
        ->groupBy('cd_cidade_cde')
        ->get();

        return view('camping/index',['titulo' => $titulo, 'subtitulo' => $subtitulo, 'busca_cidade' => $busca_cidade, 'page_name' => 'Camping']);
    }

    public function anitaGaribaldi()
    {
        $titulo = 'Camping Mirante da Ponte Anita Garibaldi';
        $subtitulo = "Camping em Laguna";

        $busca_cidade = Trilha::with('cidade')
                                ->select('cd_cidade_cde', DB::raw('count(*) as total'))
                                ->groupBy('cd_cidade_cde')
                                ->get();

        return view('camping/camping-mirante-anita-garibaldi',['titulo' => $titulo, 'subtitulo' => $subtitulo, 'busca_cidade' => $busca_cidade, 'page_name' => 'Camping']);
    }

    public function campingMirante()
    {
        $titulo = 'Camping Mirante';
        $subtitulo = "Camping em Grão-Pará";

        $busca_cidade = Trilha::with('cidade')
                                ->select('cd_cidade_cde', DB::raw('count(*) as total'))
                                ->groupBy('cd_cidade_cde')
                                ->get();

        return view('camping/camping-mirante',['titulo' => $titulo, 'subtitulo' => $subtitulo, 'busca_cidade' => $busca_cidade, 'page_name' => 'Camping']);
    }

    public function picoRinoceronte()
    {
        $titulo = 'Pico do Rinoceronte';
        $subtitulo = "Camping em Bom Jardim da Serra";

        $busca_cidade = Trilha::with('cidade')
                                ->select('cd_cidade_cde', DB::raw('count(*) as total'))
                                ->groupBy('cd_cidade_cde')
                                ->get();

        return view('camping/pico-rinoceronte',['titulo' => $titulo, 'subtitulo' => $subtitulo, 'busca_cidade' => $busca_cidade, 'page_name' => 'Camping']);
    }

    public function monteCrista()
    {
        $titulo = 'Monte Crista';
        $subtitulo = "Camping em Garuva";

        $busca_cidade = Trilha::with('cidade')
        ->select('cd_cidade_cde', DB::raw('count(*) as total'))
        ->groupBy('cd_cidade_cde')
        ->get();

        return view('camping/monte-crista',['titulo' => $titulo, 'subtitulo' => $subtitulo, 'busca_cidade' => $busca_cidade, 'page_name' => 'Camping']);
    }

    public function altoBoaVista()
    {
        $titulo = 'Mirante Alto da Boa Vista';
        $subtitulo = "Camping em Rancho Queimado";

        $busca_cidade = Trilha::with('cidade')
        ->select('cd_cidade_cde', DB::raw('count(*) as total'))
        ->groupBy('cd_cidade_cde')
        ->get();

        return view('camping/alto-da-boa-vista',['titulo' => $titulo, 'subtitulo' => $subtitulo, 'busca_cidade' => $busca_cidade, 'page_name' => 'Camping']);
    }
}
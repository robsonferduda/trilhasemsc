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

        return view('camping/index',['titulo' => $titulo, 'subtitulo' => $subtitulo, 'busca_cidade' => $busca_cidade]);
    }

    public function monteCrista()
    {
        $titulo = 'Monte Crista';
        $subtitulo = "Camping em Joinville";

        $busca_cidade = Trilha::with('cidade')
        ->select('cd_cidade_cde', DB::raw('count(*) as total'))
        ->groupBy('cd_cidade_cde')
        ->get();

        return view('camping/monte-crista',['titulo' => $titulo, 'subtitulo' => $subtitulo, 'busca_cidade' => $busca_cidade]);
    }
}
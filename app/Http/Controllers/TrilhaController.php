<?php

namespace App\Http\Controllers;

use App\Trilha;
use Illuminate\Http\Request;

class TrilhaController extends Controller
{
    
    public function __construct()
    {
        //
    }

    public function show($cidade, $categoria, $url)
    {
    	$trilha = Trilha::with('foto')->where('ds_url_tri', 'like', '%'.$url)->first();

        $titulo = $trilha->nm_trilha_tri;
        $subtitulo = "Um pedacinho do paraíso em Florianópolis";

    	return view('trilhas/detalhes',['trilha' => $trilha, 'titulo' => $titulo, 'subtitulo' => $subtitulo]);
    }

    public function search(Request $request){

        $nivel  = $request->nivel;
        $cidade = $request->cidade;

        $trilhas = Trilha::with('foto')
                          ->when($request->nivel, function($query) use ($nivel){
                                $query->where('id_nivel_niv',$nivel);
                          })
                          ->when($request->cidade, function($query) use ($cidade){
                                $query->where('cd_cidade_cde',$cidade);
                          })     
        ->get();

    	return view('trilhas/lista', ['trilhas' => $trilhas]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Trilha;
use App\Cidade;
use App\Nivel;
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
                          ->with('nivel')
                          ->with('cidade')
                          ->when($request->nivel, function($query) use ($nivel){
                                $query->where('id_nivel_niv',$nivel);
                          })
                          ->when($request->cidade, function($query) use ($cidade){
                                $query->where('cd_cidade_cde',$cidade);
                          })     
        ->get();

        $cidades = Cidade::whereIn('cd_cidade_cde',Trilha::select('cd_cidade_cde')->get())->orderBy('nm_cidade_cde')->select('cd_cidade_cde','nm_cidade_cde')->get();

        $niveis = Nivel::get();

        $ultimas = Trilha::with('foto')->orderBy('created_at','DESC')->take(2)->get();

    	return view('trilhas/lista', ['trilhas' => $trilhas, 'cidades' => $cidades, 'niveis' => $niveis, 'cidade_p' => $cidade, 'nivel_p' => $nivel, 'ultimas' => $ultimas]);
    }
}

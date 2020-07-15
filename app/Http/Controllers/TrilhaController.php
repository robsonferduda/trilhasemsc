<?php

namespace App\Http\Controllers;

use DB;
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
    	  $trilha = Trilha::with('foto')->with('cidade')->with('user')->where('ds_url_tri', 'like', '%'.$cidade.'/'.$categoria.'/'.$url)->first();

        $titulo = $trilha->nm_trilha_tri;
        $subtitulo = "Trilha em ".$trilha->cidade->nm_cidade_cde;

        $busca_cidade = Trilha::with('cidade')
           ->select('cd_cidade_cde', DB::raw('count(*) as total'))
           ->groupBy('cd_cidade_cde')
           ->get();

    	return view('trilhas/detalhes',['trilha' => $trilha, 'titulo' => $titulo, 'subtitulo' => $subtitulo, 'busca_cidade' => $busca_cidade]);
    }

    public function search(Request $request){

        $nivel  = $request->nivel;
        $cidade = $request->cidade;
        $nome   = $request->nome;

        $trilhas = Trilha::with('foto')
                          ->with('nivel')
                          ->with('cidade')
                          ->when($request->nivel, function($query) use ($nivel){
                                $query->where('id_nivel_niv',$nivel);
                          })
                          ->when($request->cidade, function($query) use ($cidade){
                                $query->where('cd_cidade_cde',$cidade);
                          })    
                          ->when($request->nome,function($query) use ($nome){
                                $query->where('nm_trilha_tri', 'ilike', '%' . $nome . '%');
                          })
        ->get();

        $cidades = Cidade::whereIn('cd_cidade_cde',Trilha::select('cd_cidade_cde')->get())->orderBy('nm_cidade_cde')->select('cd_cidade_cde','nm_cidade_cde')->get();

        $niveis = Nivel::get();

        $ultimas = Trilha::with('foto')->orderBy('created_at','DESC')->take(2)->get();

    	return view('trilhas/lista', ['trilhas' => $trilhas, 'cidades' => $cidades, 'niveis' => $niveis, 'cidade_p' => $cidade, 'nivel_p' => $nivel, 'ultimas' => $ultimas]);
    }
}

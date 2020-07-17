<?php

namespace App\Http\Controllers;

use DB;
use App\Tag;
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

    public function searchTrilha($cidade, $nivel, $trilha)
    {
        $url = $cidade.'/trilhas/'.$nivel.'/'.$trilha;

    	  $trilha = Trilha::with('foto')->with('cidade')->with('user')->where('ds_url_tri',$url)->first();

        $titulo = $trilha->nm_trilha_tri;
        $subtitulo = "Trilha em ".$trilha->cidade->nm_cidade_cde;

        $busca_cidade = Trilha::with('cidade')
           ->select('cd_cidade_cde', DB::raw('count(*) as total'))
           ->groupBy('cd_cidade_cde')
           ->get();

    	return view('trilhas/detalhes',['trilha' => $trilha, 'titulo' => $titulo, 'subtitulo' => $subtitulo, 'busca_cidade' => $busca_cidade]);
    }


    public function searchTrilhas(Request $request){

        return $this->search(null,null,$request->termo);
        
    }

    public function searchTrilhasCidade($cidade){

        return $this->search($cidade);
        
    }

    public function searchTrilhasNivel($nivel){

        return $this->search(null,$nivel);
        
    }

    public function searchTrilhasCidadeNivel($cidade,$nivel){

        return $this->search($cidade,$nivel);
        
    }

    public function searchTrilhasTag($tag){
        return $this->search(null,null,null,null,$tag);
    }

    private function search($cidade = '', $nivel = '', $termo = '', $url = '', $tag = ''){

        $nivel    = $nivel;
        $cidade   = $cidade;
        $termo     = $termo;
        $idNivel  = '';
        $idCidade = '';
        $url      = $url;

        if(!empty($cidade))
            $idCidade = Cidade::whereRaw("unaccent(replace(lower(nm_cidade_cde),' ','-')) = '".$cidade."'")
                  ->where('cd_estado_est',42)->first()->cd_cidade_cde;

        if(!empty($nivel))
            $idNivel = Nivel::whereRaw("unaccent(replace(lower(dc_nivel_niv),' ','-')) = '".$nivel."'")->first()->id_nivel_niv;

        $trilhas = Trilha::with('foto')
                          ->with('nivel')
                          ->with('cidade')
                          ->when($nivel, function($query) use ($idNivel){
                                $query->where('id_nivel_niv',$idNivel);
                          })
                          ->when($cidade, function($query) use ($idCidade){
                                $query->where('cd_cidade_cde',$idCidade);
                          })    
                          ->when($termo,function($query) use ($termo){
                                $query->whereRaw("unaccent(lower(nm_trilha_tri)) like '%".strtolower($termo)."%'");
                          })
                          ->when($tag, function($query) use ($tag){
                            $query->whereHas('tags', function($query) use ($tag){
                                $query->whereRaw("unaccent(replace(lower(ds_tag_tag),' ','-')) = '".$tag."'");
                            });
                          })
        ->get();

        $cidades = Cidade::whereIn('cd_cidade_cde',Trilha::select('cd_cidade_cde')->get())->orderBy('nm_cidade_cde')->select('cd_cidade_cde','nm_cidade_cde')->get();

        $niveis = Nivel::get();

        $ultimas = Trilha::with('foto')->orderBy('created_at','DESC')->take(2)->get();

    	return view('trilhas/lista', ['trilhas' => $trilhas, 'cidades' => $cidades, 'niveis' => $niveis, 'cidade_p' => $cidade, 'nivel_p' => $nivel, 'ultimas' => $ultimas, 'termo' => $termo]);
    }

    public function addTags()
    {
      /*
        $trilha = Trilha::find(1);
        $trilha->tags()->attach(4);
      */
    }
}

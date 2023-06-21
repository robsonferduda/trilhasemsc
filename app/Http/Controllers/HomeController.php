<?php

namespace App\Http\Controllers;

use DB;
use App\Nivel;
use App\Trilha;
use App\Cidade;
use App\Galeria;
use App\Guia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function indexOld()
    {
        /*
            - Criar Enun para Categoria
            - Criar tabelas de Galeria de Fotos
        */
        $page_name = "Trilha";
        
        $totais = array('trilha'  => Trilha::where('id_categoria_cat', 1)->where('fl_publicacao_tri', 'S')->count(),
                        'camping' => 4,
                        'galeria' => Galeria::all()->count() );

        $cidades = Cidade::whereIn('cd_cidade_cde', Trilha::select('cd_cidade_cde')->get())->orderBy('nm_cidade_cde')->select('cd_cidade_cde', 'nm_cidade_cde')->get();

        $niveis = Nivel::get();

        $ultimas = Trilha::with('foto')->where('fl_publicacao_tri', 'S')->orderBy('created_at', 'DESC')->take(2)->get();
        $preferidas = Trilha::with('foto')->where('fl_publicacao_tri', 'S')->orderBy('total_votos_tri', 'DESC')->take(5)->get();

        return view('home', ['totais' => $totais, 'ultimas' => $ultimas, 'preferidas' => $preferidas ,'cidades' => $cidades, 'niveis' => $niveis, 'page_name' => $page_name]);
    }

    public function index()
    {
        $page_name = "Trilhas em Santa Catarina";
        $cidades = Cidade::whereIn('cd_cidade_cde', Trilha::select('cd_cidade_cde')->get())->orderBy('nm_cidade_cde')->select('cd_cidade_cde', 'nm_cidade_cde')->get();
        $niveis = Nivel::orderBy('ordem_niv', 'ASC')->get();
        $guias = Guia::where('fl_ativo_gui', true)->where('fl_perfil_moderado_gui', true)->inRandomOrder()->take(4)->get();
        $preferidas = Trilha::with('foto')->where('fl_publicacao_tri', 'S')->where('total_votos_tri','>',0)->orderBy('total_votos_tri', 'DESC')->take(7)->get();
        $ultimas = Trilha::with('foto')->where('fl_destaque_tri', true)->where('fl_publicacao_tri', 'S')->orderBy('created_at', 'DESC')->take(3)->get();

        return view('inicio', compact('ultimas','cidades','niveis','guias','preferidas','page_name'));
    }

    public function dashboard()
    {
        return view('admin/dashboard');
    }

    public function perfil($id)
    {
        $cidades = Cidade::whereIn('cd_cidade_cde', Trilha::select('cd_cidade_cde')->get())->orderBy('nm_cidade_cde')->select('cd_cidade_cde', 'nm_cidade_cde')->get();
        $niveis = Nivel::get();
        $guias = Guia::inRandomOrder()->take(4)->get();
        $preferidas = Trilha::with('foto')->where('fl_publicacao_tri', 'S')->orderBy('total_votos_tri', 'DESC')->take(7)->get();
        $guia = Guia::find($id);

        $ultimas = Trilha::with('foto')->where('fl_destaque_tri', true)->where('fl_publicacao_tri', 'S')->orderBy('created_at', 'DESC')->take(3)->get();

        return view('perfil', compact('ultimas','cidades','niveis','guias','preferidas','guia'));
    }

    public function guia()
    {
        $page_name = "Guia";

        return view('guia', ['page_name' => $page_name]);
    }

    public function sobre()
    {
        $page_name = "Sobre";

        return view('sobre', ['page_name' => $page_name]);
    }

    public function camping()
    {
        $page_name = "Camping";

        $busca_cidade = Trilha::with('cidade')
           ->select('cd_cidade_cde', DB::raw('count(*) as total'))
           ->groupBy('cd_cidade_cde')
           ->get();


        $titulo = 'Vale da Utopia';
        $subtitulo = "Camping em Palhoça";

        return view('camping', ['page_name' => $page_name, 'busca_cidade' => $busca_cidade, 'titulo' => $titulo, 'subtitulo' => $subtitulo]);
    }

    public function contato()
    {
        $page_name = "Contato";

        return view('contato', ['page_name' => $page_name]);
    }
}

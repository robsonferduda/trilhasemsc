<?php

namespace App\Http\Controllers;

use DB;
use URL;
use Auth;
use App\User;
use App\Tag;
use App\Trilha;
use App\Cidade;
use App\Nivel;
use App\Foto;
use App\Categoria;
use App\Complemento;
use App\TipoFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;

class TrilhaController extends Controller
{
    public function __construct()
    {
        //
    }

    public function index()
    {
        if (Auth::guest() or trim(Auth::user()->id_role) != 'ADMIN') {
            return redirect('login');
        }

        $trilhas = Trilha::all();
        return view('admin/trilha/index', ['trilhas' => $trilhas]);
    }

    public function editar($id)
    {
        $trilha = Trilha::where('id_trilha_tri', $id)
                          ->with(array('foto' => function ($q) {
                              $q->with('tipo');
                          }))
                          ->first();

        $usuarios = User::all();
        $niveis = Nivel::orderBy('dc_nivel_niv')->get();
        $cidades = Cidade::where('cd_estado_est', 42)->orderBy('nm_cidade_cde')->get();
        $categorias = Categoria::all();
        $complementos = Complemento::orderBy('id_complemento_nivel_con')->get();
        $tags   = Tag::orderBy('ds_tag_tag')->get();

        return view('admin/trilha/editar', compact('trilha', 'niveis', 'cidades', 'complementos', 'categorias', 'usuarios', 'tags'));
    }

    public function novo()
    {
        $usuarios = User::all();
        $niveis = Nivel::orderBy('dc_nivel_niv')->get();
        $cidades = Cidade::where('cd_estado_est', 42)->orderBy('nm_cidade_cde')->get();
        $categorias = Categoria::all();
        $complementos = Complemento::orderBy('id_complemento_nivel_con')->get();
        $tags   = Tag::orderBy('ds_tag_tag')->get();

        return view('admin/trilha/novo', compact('niveis', 'cidades', 'complementos', 'categorias', 'usuarios', 'tags'));
    }

    public function create(Request $request)
    {
        $trilha = Trilha::create($request->all());
        if ($trilha) {
            if (!empty($request->tags)) {
                $trilha->tags()->sync($request->tags);
            }

            return redirect('admin/listar-trilhas');
        } else {
            dd("Erro");
        }
    }

    public function insertFoto(Request $request)
    {
        $tipoFoto = TipoFoto::find($request->id_tipo_foto_tfo);
        $trilha = Trilha::find($request->id_trilha_tri);

        // Categoria Trilha
        if ($trilha->id_categoria_cat === 1) {
            $path = $tipoFoto->dc_path_tfp;

            if (count(explode('/', $request->nm_path_fot)) > 1) {
                $path = $path.'/'.explode('/', $request->nm_path_fot)[0];
            }

            $pathArray = explode('/', $request->nm_path_fot);
            $fileName = end($pathArray);

            $request->file('imagem')->storeAs($path, $fileName, 'trilhas');

            if (!empty($request->height) && !empty($request->width)) {
                \Image::make('public/img/trilhas/'.$path.'/'.$fileName)->resize($request->width, $request->height)->save();
            }
            \ImageOptimizer::optimize('public/img/trilhas/'.$path.'/'.$fileName);
        }

        // Categoria Camping
        if ($trilha->id_categoria_cat === 2) {
            exit;
        }

        if (Foto::create($request->all())) {
            return redirect('admin/editar-trilha/'.$request->id_trilha_tri);
        } else {
            dd("Erro");
        }
    }

    public function update(Request $request)
    {
        $trilha = Trilha::where('id_trilha_tri', $request->id_trilha_tri)->first();

        if ($trilha->update($request->all())) {
            if (!empty($request->tags)) {
                $trilha->tags()->sync($request->tags);
            }
            
            return redirect(URL::previous());
        } else {
            dd("Erro");
        }
    }

    public function searchTrilha($cidade, $nivel, $trilha)
    {
        $url = $cidade.'/trilhas/'.$nivel.'/'.$trilha;

        $trilha = Trilha::with('foto')->with('cidade')->with('user')->with('nivel')->with('complemento')->where('ds_url_tri', $url)->first();

        $titulo = $trilha->nm_trilha_tri;
        $subtitulo = "Trilha em ".$trilha->cidade->nm_cidade_cde;

        $busca_cidade = Trilha::with('cidade')
           ->select('cd_cidade_cde', DB::raw('count(*) as total'))
           ->where('fl_publicacao_tri', 'S')
           ->groupBy('cd_cidade_cde')
           ->get()->sortBy('cidade.nm_cidade_cde');

        return view('trilhas/detalhes', ['trilha' => $trilha, 'titulo' => $titulo, 'subtitulo' => $subtitulo, 'busca_cidade' => $busca_cidade]);
    }


    public function searchTrilhas(Request $request)
    {
        return $this->search(null, null, $request->termo);
    }

    public function searchTrilhasCidade($cidade)
    {
        return $this->search($cidade);
    }

    public function searchTrilhasNivel($nivel)
    {
        return $this->search(null, $nivel);
    }

    public function searchTrilhasCidadeNivel($cidade, $nivel)
    {
        return $this->search($cidade, $nivel);
    }

    public function searchTrilhasTag($tag)
    {
        return $this->search(null, null, null, null, $tag);
    }

    private function search($cidade = '', $nivel = '', $termo = '', $url = '', $tag = '')
    {
        $nivel    = $nivel;
        $cidade   = $cidade;
        $termo     = $termo;
        $idNivel  = '';
        $idCidade = '';
        $url      = $url;

        if (!empty($cidade)) {
            $idCidade = Cidade::whereRaw("unaccent(replace(lower(nm_cidade_cde),' ','-')) = '".$cidade."'")
                  ->where('cd_estado_est', 42)->first()->cd_cidade_cde;
        }

        if (!empty($nivel)) {
            $idNivel = Nivel::whereRaw("unaccent(replace(lower(dc_nivel_niv),' ','-')) = '".$nivel."'")->first()->id_nivel_niv;
        }

        $trilhas = Trilha::with('foto')
                          ->with('nivel')
                          ->with('cidade')
                          ->when($nivel, function ($query) use ($idNivel) {
                              $query->where('id_nivel_niv', $idNivel);
                          })
                          ->when($cidade, function ($query) use ($idCidade) {
                              $query->where('cd_cidade_cde', $idCidade);
                          })
                          ->when($termo, function ($query) use ($termo) {
                              $query->whereRaw("unaccent(lower(nm_trilha_tri)) like '%".strtolower($termo)."%'");
                          })
                          ->when($tag, function ($query) use ($tag) {
                              $query->whereHas('tags', function ($query) use ($tag) {
                                  $query->whereRaw("unaccent(replace(lower(ds_tag_tag),' ','-')) = '".$tag."'");
                              });
                          })
                          ->where('fl_publicacao_tri', 'S')
        ->paginate(10);

        $cidades = Cidade::whereIn('cd_cidade_cde', Trilha::select('cd_cidade_cde')->get())->orderBy('nm_cidade_cde')->select('cd_cidade_cde', 'nm_cidade_cde')->get();

        $niveis = Nivel::get();

        #dd($trilhas->nextPageUrl());

        return view('trilhas/lista', ['trilhas' => $trilhas, 'cidades' => $cidades, 'niveis' => $niveis, 'cidade_p' => $cidade, 'nivel_p' => $nivel, 'termo' => $termo]);
    }


    public function trilhasLeste()
    {
        $titulo = 'Trilhas em Florianópolis';
        $subtitulo = "A Região Leste da Ilha da Magia";

        $busca_cidade = Trilha::with('cidade')
        ->select('cd_cidade_cde', DB::raw('count(*) as total'))
        ->groupBy('cd_cidade_cde')
        ->get()->sortBy('cidade.nm_cidade_cde');

        return view('trilhas/leste',['titulo' => $titulo, 'subtitulo' => $subtitulo, 'busca_cidade' => $busca_cidade]);
    }

    public function regioes()
    {
        $titulo = 'Trilhas';
        $subtitulo = "Por Região";

        return view('trilhas/regioes',['titulo' => $titulo, 'subtitulo' => $subtitulo, 'page_name' => 'Trilhas']);
    }

    public function brasil()
    {
        $titulo = 'Trilhas';
        $subtitulo = "no Brasil";

        return view('trilhas/brasil',['titulo' => $titulo, 'subtitulo' => $subtitulo, 'page_name' => 'Trilhas']);
    }

    public function chapada()
    {
        $titulo = 'Trilhas no Brasil';
        $subtitulo = "Chapada Diamantina";

        $busca_cidade = Trilha::with('cidade')
                        ->select('cd_cidade_cde', DB::raw('count(*) as total'))
                        ->groupBy('cd_cidade_cde')
                        ->get()->sortBy('cidade.nm_cidade_cde');

        return view('trilhas/brasil/regioes/nordeste/chapada',['titulo' => $titulo, 'subtitulo' => $subtitulo, 'busca_cidade' => $busca_cidade, 'page_name' => 'Trilhas']);
    }

    public function trilhasNorte()
    {
        $titulo = 'Trilhas em Florianópolis';
        $subtitulo = "A Região Norte da Ilha da Magia";

        $busca_cidade = Trilha::with('cidade')
        ->select('cd_cidade_cde', DB::raw('count(*) as total'))
        ->groupBy('cd_cidade_cde')
        ->get()->sortBy('cidade.nm_cidade_cde');

        return view('trilhas/norte',['titulo' => $titulo, 'subtitulo' => $subtitulo, 'busca_cidade' => $busca_cidade]);
    }

    public function trilhasSul()
    {
        $titulo = 'Trilhas em Florianópolis';
        $subtitulo = "A Região Sul da Ilha da Magia";

        $busca_cidade = Trilha::with('cidade')
        ->select('cd_cidade_cde', DB::raw('count(*) as total'))
        ->groupBy('cd_cidade_cde')
        ->get()->sortBy('cidade.nm_cidade_cde');

        return view('trilhas/sul',['titulo' => $titulo, 'subtitulo' => $subtitulo, 'busca_cidade' => $busca_cidade]);
    }

    public function regioesSC()
    {
        $titulo = 'Trilhas em Santa Catarina';
        $subtitulo = "Região Serrana";

        $busca_cidade = Trilha::with('cidade')
        ->select('cd_cidade_cde', DB::raw('count(*) as total'))
        ->groupBy('cd_cidade_cde')
        ->get()->sortBy('cidade.nm_cidade_cde');

        return view('trilhas/santa-catarina/regioes',['titulo' => $titulo, 'subtitulo' => $subtitulo, 'busca_cidade' => $busca_cidade]);
    }

    public function serraCatarinense()
    {
        $titulo = 'Trilhas em Santa Catarina';
        $subtitulo = "Serra Catarinense";

        $busca_cidade = Trilha::with('cidade')
        ->select('cd_cidade_cde', DB::raw('count(*) as total'))
        ->groupBy('cd_cidade_cde')
        ->get()->sortBy('cidade.nm_cidade_cde');

        return view('trilhas/santa-catarina/serra',['titulo' => $titulo, 'subtitulo' => $subtitulo, 'busca_cidade' => $busca_cidade]);
    }
}

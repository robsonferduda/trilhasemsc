<?php

namespace App\Http\Controllers;

use DB;
use URL;
use Auth;
use App\User;
use App\Tag;
use App\Trilha;
use App\Evento;
use App\Cidade;
use App\Nivel;
use App\Foto;
use App\Guia;
use App\Trilheiro;
use App\Estatistica;
use App\Categoria;
use App\Complemento;
use App\TipoFoto;
use App\Mail\ConviteTrilhaGuia;
use App\Mail\ConviteTrilhaTrilheiro;
use Laracasts\Flash\Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;

class TrilhaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only([
            'index',
            'editar',
            'novo',
            'update',
            'create',
            'insertFoto',
            'enviarEmailTesteConvite',
            'enviarEmailConviteTrilheiros',
            'enviarEmailConviteGuias',
        ]);
    }

    public function index()
    {
        if (Auth::guest() or trim(Auth::user()->id_role) != 'ADMIN') {
            return redirect('login');
        }

        $visitasSubquery = DB::table('total_acessos_trilhas_tat')
            ->select('id_trilha_tri', DB::raw('MAX(total_acessos_tat) as total_visitas'))
            ->groupBy('id_trilha_tri');

        $trilhas = Trilha::with('nivel')
            ->leftJoinSub($visitasSubquery, 'tat', function ($join) {
                $join->on('trilha_tri.id_trilha_tri', '=', 'tat.id_trilha_tri');
            })
            ->select('trilha_tri.*', DB::raw('COALESCE(tat.total_visitas, 0) as total_visitas'))
            ->orderBy('nm_trilha_tri')
            ->paginate(12);

        return view('admin/trilha/index', ['trilhas' => $trilhas]);
    }

    public function editar($id)
    {
        if (Auth::guest() or trim(Auth::user()->id_role) != 'ADMIN') {
            return redirect('login');
        }

        $trilha = Trilha::where('id_trilha_tri', $id)
                          ->with(array('foto' => function ($q) {
                              $q->with('tipo');
                          }))
                          ->first();

        $usuarios = User::where("id_role","ADMIN")->orderBy("name")->get();
        $niveis = Nivel::orderBy('dc_nivel_niv')->get();
        $cidades = Cidade::where('cd_estado_est', 42)->orderBy('nm_cidade_cde')->get();
        $categorias = Categoria::all();
        $complementos = Complemento::orderBy('id_complemento_nivel_con')->get();
        $tags   = Tag::orderBy('ds_tag_tag')->get();

        $totalTrilheirosNewsletter = Trilheiro::where('fl_newsletter_tri', true)
            ->whereHas('user', function ($q) {
                $q->whereNotNull('email')->where('email', '!=', '');
            })
            ->count();

        $totalGuiasAtivos = Guia::where('fl_ativo_gui', true)
            ->where('fl_perfil_moderado_gui', true)
            ->whereHas('user', function ($q) {
                $q->whereNotNull('email')->where('email', '!=', '');
            })
            ->count();

        return view('admin/trilha/editar', compact(
            'trilha',
            'niveis',
            'cidades',
            'complementos',
            'categorias',
            'usuarios',
            'tags',
            'totalTrilheirosNewsletter',
            'totalGuiasAtivos'
        ));
    }

    public function novo()
    {
        if (Auth::guest() or trim(Auth::user()->id_role) != 'ADMIN') {
            return redirect('login');
        }

        $usuarios = User::where("id_role","ADMIN")->orderBy("name")->get();
        $niveis = Nivel::orderBy('dc_nivel_niv')->get();
        $cidades = Cidade::where('cd_estado_est', 42)->orderBy('nm_cidade_cde')->get();
        $categorias = Categoria::all();
        $complementos = Complemento::orderBy('id_complemento_nivel_con')->get();
        $tags   = Tag::orderBy('ds_tag_tag')->get();

        return view('admin/trilha/novo', compact('niveis', 'cidades', 'complementos', 'categorias', 'usuarios', 'tags'));
    }

    public function create(Request $request)
    {
        if (Auth::guest() or trim(Auth::user()->id_role) != 'ADMIN') {
            return redirect('login');
        }

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
        if (Auth::guest() or trim(Auth::user()->id_role) != 'ADMIN') {
            return redirect('login');
        }

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
        if (Auth::guest() or trim(Auth::user()->id_role) != 'ADMIN') {
            return redirect('login');
        }

        $trilha = Trilha::where('id_trilha_tri', $request->id_trilha_tri)->first();

        if ($trilha->update($request->all())) {
            if (!empty($request->tags)) {
                $trilha->tags()->sync($request->tags);
            }

            Flash::success('<i class="fa fa-check"></i> Trilha atualizada com sucesso');

            return redirect('admin/editar-trilha/'.$trilha->id_trilha_tri);
        } else {
            dd("Erro");
        }
    }

    public function enviarEmailTesteConvite(Request $request, $id)
    {
        if (Auth::guest() or trim(Auth::user()->id_role) != 'ADMIN') {
            return redirect('login');
        }

        $tipo = $request->input('tipo');
        if (!in_array($tipo, ['trilheiro', 'guia'], true)) {
            Flash::error('Tipo de email inválido.');
            return redirect()->back();
        }

        try {
            $trilha = Trilha::with(['cidade', 'nivel', 'foto'])->findOrFail($id);
            $adminEmail = Auth::user()->email;

            if (empty($adminEmail)) {
                Flash::error('Seu usuário administrativo não possui email cadastrado.');
                return redirect()->back();
            }

            if ($tipo === 'trilheiro') {
                Mail::to($adminEmail)->send(new ConviteTrilhaTrilheiro($trilha, Auth::user()->name, true));
            } else {
                Mail::to($adminEmail)->send(new ConviteTrilhaGuia($trilha, Auth::user()->name, true));
            }

            Flash::success('Email de teste (' . $tipo . ') enviado para ' . $adminEmail);
        } catch (\Exception $e) {
            \Log::error('Erro ao enviar email de teste de convite de trilha', [
                'trilha_id' => $id,
                'tipo' => $tipo,
                'error' => $e->getMessage(),
            ]);
            Flash::error('Erro ao enviar email de teste: ' . $e->getMessage());
        }

        return redirect('admin/editar-trilha/' . $id);
    }

    public function enviarEmailConviteTrilheiros($id)
    {
        if (Auth::guest() or trim(Auth::user()->id_role) != 'ADMIN') {
            return redirect('login');
        }

        try {
            $trilha = Trilha::with(['cidade', 'nivel', 'foto'])->findOrFail($id);

            $trilheiros = Trilheiro::with('user')
                ->where('fl_newsletter_tri', true)
                ->whereHas('user', function ($q) {
                    $q->whereNotNull('email')->where('email', '!=', '');
                })
                ->get();

            if ($trilheiros->isEmpty()) {
                Flash::warning('Não há trilheiros com newsletter ativa e email válido para envio.');
                return redirect('admin/editar-trilha/' . $id);
            }

            $enviados = 0;
            $erros = 0;

            foreach ($trilheiros as $trilheiro) {
                try {
                    $nome = $trilheiro->nm_trilheiro_tri ?: optional($trilheiro->user)->name;
                    Mail::to($trilheiro->user->email)->send(new ConviteTrilhaTrilheiro($trilha, $nome, false));
                    $enviados++;
                } catch (\Exception $e) {
                    $erros++;
                    \Log::error('Erro ao enviar convite de trilha para trilheiro', [
                        'trilheiro_id' => $trilheiro->id_trilheiro_tri,
                        'trilha_id' => $id,
                        'error' => $e->getMessage(),
                    ]);
                }
            }

            if ($erros > 0) {
                Flash::warning("Convites enviados para {$enviados} trilheiro(s). Erros: {$erros}.");
            } else {
                Flash::success("Convites enviados com sucesso para {$enviados} trilheiro(s).");
            }
        } catch (\Exception $e) {
            \Log::error('Erro geral no envio de convites para trilheiros', [
                'trilha_id' => $id,
                'error' => $e->getMessage(),
            ]);
            Flash::error('Erro ao enviar convites: ' . $e->getMessage());
        }

        return redirect('admin/editar-trilha/' . $id);
    }

    public function enviarEmailConviteGuias($id)
    {
        if (Auth::guest() or trim(Auth::user()->id_role) != 'ADMIN') {
            return redirect('login');
        }

        try {
            $trilha = Trilha::with(['cidade', 'nivel', 'foto'])->findOrFail($id);

            $guias = Guia::with('user')
                ->where('fl_ativo_gui', true)
                ->where('fl_perfil_moderado_gui', true)
                ->whereHas('user', function ($q) {
                    $q->whereNotNull('email')->where('email', '!=', '');
                })
                ->get();

            if ($guias->isEmpty()) {
                Flash::warning('Não há guias ativos com email válido para envio.');
                return redirect('admin/editar-trilha/' . $id);
            }

            $enviados = 0;
            $erros = 0;

            foreach ($guias as $guia) {
                try {
                    Mail::to($guia->user->email)->send(new ConviteTrilhaGuia($trilha, $guia->nm_guia_gui, false));
                    $enviados++;
                } catch (\Exception $e) {
                    $erros++;
                    \Log::error('Erro ao enviar convite de trilha para guia', [
                        'guia_id' => $guia->id_guia_gui,
                        'trilha_id' => $id,
                        'error' => $e->getMessage(),
                    ]);
                }
            }

            if ($erros > 0) {
                Flash::warning("Convites enviados para {$enviados} guia(s). Erros: {$erros}.");
            } else {
                Flash::success("Convites enviados com sucesso para {$enviados} guia(s).");
            }
        } catch (\Exception $e) {
            \Log::error('Erro geral no envio de convites para guias', [
                'trilha_id' => $id,
                'error' => $e->getMessage(),
            ]);
            Flash::error('Erro ao enviar convites: ' . $e->getMessage());
        }

        return redirect('admin/editar-trilha/' . $id);
    }

    public function searchTrilha($cidade, $nivel, $trilha)
    {
        // Validar e sanitizar parâmetros de entrada
        $cidade = trim($cidade);
        $nivel = trim($nivel);
        $trilhaSlug = trim($trilha);
        
        if (empty($cidade) || empty($nivel) || empty($trilhaSlug)) {
            abort(404, 'Parâmetros inválidos');
        }

        $url = $cidade.'/trilhas/'.$nivel.'/'.$trilhaSlug;

        // Buscar trilha e verificar se existe
        $trilhaEncontrada = Trilha::with(['foto', 'cidade', 'user', 'nivel', 'complemento'])
            ->where('ds_url_tri', $url)
            ->first();

        // Verificar se a trilha foi encontrada
        if (!$trilhaEncontrada) {
            abort(404, 'Trilha não encontrada');
        }

        // Verificar se a cidade existe (relacionamento)
        if (!$trilhaEncontrada->cidade) {
            abort(404, 'Cidade da trilha não encontrada');
        }

        // Registrar estatística apenas se tudo estiver OK
        try {
            $usuario_logado = Auth::check() ? Auth::user()->id : null;

            $estatistica = array(
                'cd_usuario_usu' => $usuario_logado,
                'cd_tipo_monitoramento_tim' => 1,
                'cd_monitoramento_esa' => $trilhaEncontrada->id_trilha_tri
            );

            Estatistica::create($estatistica);
        } catch (\Exception $e) {
            // Log do erro mas não interrompe a visualização
            \Log::error('Erro ao criar estatística: ' . $e->getMessage());
        }

        $titulo = $trilhaEncontrada->nm_trilha_tri;
        $subtitulo = "Trilha em ".$trilhaEncontrada->cidade->nm_cidade_cde;
        $page_name = $trilhaEncontrada->nm_trilha_tri;

        $busca_cidade = Trilha::with('cidade')
           ->select('cd_cidade_cde', DB::raw('count(*) as total'))
           ->where('fl_publicacao_tri', 'S')
           ->groupBy('cd_cidade_cde')
           ->get()->sortBy('cidade.nm_cidade_cde');

        $proximosEventos = Evento::where('id_trilha_tri', $trilhaEncontrada->id_trilha_tri)
            ->where('dt_realizacao_eve', '>=', date('Y-m-d'))
            ->where('fl_ativo_eve', true)
            ->orderBy('dt_realizacao_eve', 'ASC')
            ->get();

        // Calcula chamas de popularidade (1 a 5) usando escala logarítmica
        // Isso evita que trilhas com poucos acessos fiquem todas com 1 chama
        // quando há outliers com acessos muito altos (escala linear seria injusta)
        $maxAcessos = \App\TotalAcessosTrilhas::max('total_acessos_tat') ?? 1;
        $acessosTrilha = \App\TotalAcessosTrilhas::where('id_trilha_tri', $trilhaEncontrada->id_trilha_tri)->value('total_acessos_tat') ?? 0;
        $chamasPreenchidas = ($maxAcessos > 1 && $acessosTrilha > 0)
            ? (int) round((log($acessosTrilha + 1) / log($maxAcessos + 1)) * 5)
            : 1;
        $chamasPreenchidas = max(1, min(5, $chamasPreenchidas)); // garante entre 1 e 5

        return view('trilhas/detalhes-novo', ['trilha' => $trilhaEncontrada, 'titulo' => $titulo, 'subtitulo' => $subtitulo, 'busca_cidade' => $busca_cidade, 'page_name' => $page_name, 'chamasPreenchidas' => $chamasPreenchidas, 'totalAcessosTrilha' => $acessosTrilha, 'proximosEventos' => $proximosEventos]);
    }


    public function searchTrilhas(Request $request)
    {
        return $this->search($request->cidade, $request->nivel, $request->termo);
    }

    public function searchTrilhasCidadeDetalhes($id_cidade)
    {

        if (!empty($id_cidade)) {
            $cidade = Cidade::whereRaw("unaccent(replace(lower(nm_cidade_cde),' ','-')) = '".$id_cidade."'")->where('cd_estado_est', 42)->first();
        }

        $trilhas = Trilha::with('foto')
                ->with('nivel')
                ->with('cidade')
                ->when($cidade, function ($query) use ($cidade) {
                    $query->where('cd_cidade_cde', $cidade->cd_cidade_cde);
                })
                ->where('fl_publicacao_tri', 'S')
                ->paginate(10);

        return view('trilhas/cidades', compact(['trilhas', 'cidade']));
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

        $page_name = "Trilhas em Santa Catarina";

        if (!empty($cidade)) {

            $objCidade = Cidade::whereRaw("unaccent(replace(lower(nm_cidade_cde),' ','-')) = '".$cidade."'")->where('cd_estado_est', 42)->first();
            
            if (!$objCidade) {
                abort(404, 'Cidade não encontrada');
            }

            $idCidade = $objCidade->cd_cidade_cde;

            $page_name = "Trilhas em ".$objCidade->nm_cidade_cde;
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
                              $query->where('nm_trilha_tri', 'ILIKE', '%'.trim($termo).'%');
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

        return view('trilhas/lista', ['trilhas' => $trilhas, 'cidades' => $cidades, 'niveis' => $niveis, 'cidade_p' => $cidade, 'nivel_p' => $nivel, 'termo' => $termo, 'page_name' => $page_name]);
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

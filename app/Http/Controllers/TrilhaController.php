<?php

namespace App\Http\Controllers;

use DB;
use URL;
use Auth;
use Flash;
use App\User;
use App\Tag;
use App\Trilha;
use App\Guia;
use App\Evento;
use App\Cidade;
use App\Nivel;
use App\Foto;
use App\LogEmail;
use App\Trilheiro;
use App\Estatistica;
use App\Categoria;
use App\Complemento;
use App\TipoFoto;
use App\Detalhe;
use App\Mail\ConviteTrilhaGuia;
use App\Mail\ConviteTrilhaTrilheiro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class TrilhaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['index', 'detalhes', 'editar', 'novo', 'update', 'create', 'insertFoto', 'enviarEmailTesteConvite', 'enviarEmailConviteTrilheiros', 'enviarEmailConviteGuias']);
    }

    public function index(Request $request)
    {
        if (Auth::guest() or trim(Auth::user()->id_role) != 'ADMIN') {
            return redirect('login');
        }

        $nome = trim((string) $request->input('nome', ''));
        $publicado = trim((string) $request->input('publicado', ''));

        $visitasSubquery = DB::table('total_acessos_trilhas_tat')
            ->select('id_trilha_tri', DB::raw('MAX(total_acessos_tat) as total_visitas'))
            ->groupBy('id_trilha_tri');

        $trilhas = Trilha::with('nivel')
            ->leftJoinSub($visitasSubquery, 'tat', function ($join) {
                $join->on('trilha_tri.id_trilha_tri', '=', 'tat.id_trilha_tri');
            })
            ->when($nome !== '', function ($query) use ($nome) {
                $query->where('trilha_tri.nm_trilha_tri', 'like', '%'.$nome.'%');
            })
            ->when(in_array($publicado, ['S', 'N']), function ($query) use ($publicado) {
                $query->where('trilha_tri.fl_publicacao_tri', $publicado);
            })
            ->select('trilha_tri.*', DB::raw('COALESCE(tat.total_visitas, 0) as total_visitas'))
            ->orderBy('nm_trilha_tri')
            ->paginate(12);

        $trilhas->appends($request->only(['nome', 'publicado']));

        return view('admin/trilha/index', [
            'trilhas' => $trilhas,
            'filtroNome' => $nome,
            'filtroPublicado' => $publicado,
        ]);
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
                          ->with('detalhes')
                          ->first();

        $usuarios = User::where("id_role","ADMIN")->orderBy("name")->get();
        $niveis = Nivel::orderBy('dc_nivel_niv')->get();
        $cidades = Cidade::where('cd_estado_est', 42)->orderBy('nm_cidade_cde')->get();
        $categorias = Categoria::all();
        $complementos = Complemento::orderBy('id_complemento_nivel_con')->get();
        $tags   = Tag::orderBy('ds_tag_tag')->get();
        $tiposFotoObrigatorios = TipoFoto::whereIn('id_tipo_foto_tfo', [5, 7])
            ->get()
            ->keyBy('id_tipo_foto_tfo');
        $fotoBusca = $trilha->foto->where('id_tipo_foto_tfo', 7)->first();
        $fotoPrincipal = $trilha->foto->where('id_tipo_foto_tfo', 5)->first();
        $slugArquivoFoto = $this->slugArquivoFotoTrilha($trilha);

        return view('admin/trilha/editar', compact(
            'trilha',
            'niveis',
            'cidades',
            'complementos',
            'categorias',
            'usuarios',
            'tags',
            'tiposFotoObrigatorios',
            'fotoBusca',
            'fotoPrincipal',
            'slugArquivoFoto'
        ));
    }

    public function detalhes(Request $request, $id)
    {
        if (Auth::guest() or trim(Auth::user()->id_role) != 'ADMIN') {
            return redirect('login');
        }

        $periodo = (int) $request->input('periodo', 30);
        $periodosValidos = [7, 30, 90, 180, 365];

        if (!in_array($periodo, $periodosValidos)) {
            $periodo = 30;
        }

        $trilha = Trilha::with(['nivel', 'cidade', 'categoria', 'complemento', 'user'])->findOrFail($id);

        $totalAcessos = (int) DB::table('total_acessos_trilhas_tat')
            ->where('id_trilha_tri', $trilha->id_trilha_tri)
            ->max('total_acessos_tat');

        $inicioPeriodo = now()->subDays($periodo - 1)->startOfDay();

        $acessosAgrupados = Estatistica::query()
            ->select(DB::raw('DATE(created_at) as dia'), DB::raw('COUNT(*) as total'))
            ->where('cd_tipo_monitoramento_tim', 1)
            ->where('cd_monitoramento_esa', $trilha->id_trilha_tri)
            ->where('created_at', '>=', $inicioPeriodo)
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy(DB::raw('DATE(created_at)'))
            ->get();

        $mapaAcessos = [];
        foreach ($acessosAgrupados as $acesso) {
            $mapaAcessos[$acesso->dia] = (int) $acesso->total;
        }

        $labelsAcessos = [];
        $valoresAcessos = [];
        $totalPeriodo = 0;

        for ($i = 0; $i < $periodo; $i++) {
            $data = $inicioPeriodo->copy()->addDays($i);
            $dataIso = $data->format('Y-m-d');
            $valorDia = $mapaAcessos[$dataIso] ?? 0;

            $labelsAcessos[] = $data->format('d/m');
            $valoresAcessos[] = $valorDia;
            $totalPeriodo += $valorDia;
        }

        $totalTrilheirosNewsletter = Trilheiro::where('fl_newsletter_tri', true)->count();
        $totalGuiasAtivos = Guia::where('fl_ativo_gui', true)->count();
        $historicoEnvios = LogEmail::where('id_trilha_tri', $trilha->id_trilha_tri)
            ->orderBy('dt_envio_loe', 'desc')
            ->orderBy('cd_log_email_loe', 'desc')
            ->get();

        return view('admin/trilha/detalhes', [
            'trilha' => $trilha,
            'periodo' => $periodo,
            'periodosValidos' => $periodosValidos,
            'totalAcessos' => $totalAcessos,
            'totalPeriodo' => $totalPeriodo,
            'labelsAcessos' => $labelsAcessos,
            'valoresAcessos' => $valoresAcessos,
            'totalTrilheirosNewsletter' => $totalTrilheirosNewsletter,
            'totalGuiasAtivos' => $totalGuiasAtivos,
            'historicoEnvios' => $historicoEnvios,
        ]);
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

        $dados = $request->except($this->camposExcetoTrilha());
        $dados['nu_latitude_tri'] = $this->normalizeCoordenada($request->input('nu_latitude_tri'));
        $dados['nu_longitude_tri'] = $this->normalizeCoordenada($request->input('nu_longitude_tri'));

        $trilha = Trilha::create($dados);
        if ($trilha) {
            if (!empty($request->tags)) {
                $trilha->tags()->sync($request->tags);
            }

            $this->salvarArquivoGpx($request, $trilha);
            $this->salvarImagemStory($request, $trilha);
            $this->salvarDetalhesTrilha($request, $trilha);

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

        $request->validate([
            'id_trilha_tri' => 'required|integer',
            'id_tipo_foto_tfo' => 'required|integer|in:5,7',
            'imagem' => 'required|image|mimes:jpeg,jpg,png,webp|max:8192',
        ], [
            'imagem.required' => 'Selecione uma imagem para enviar.',
            'imagem.image' => 'O arquivo precisa ser uma imagem.',
            'imagem.mimes' => 'Use JPG, PNG ou WEBP.',
            'imagem.max' => 'A imagem deve ter no máximo 8 MB.',
            'id_tipo_foto_tfo.in' => 'Tipo de foto inválido para o template novo.',
        ]);

        $trilha = Trilha::findOrFail($request->id_trilha_tri);
        $tipoFoto = TipoFoto::findOrFail($request->id_tipo_foto_tfo);

        if ((int) $trilha->id_categoria_cat !== 1) {
            Flash::error('Upload de foto disponível apenas para trilhas.');
            return redirect('admin/editar-trilha/'.$trilha->id_trilha_tri);
        }

        $slug = $this->slugArquivoFotoTrilha($trilha);
        $extensao = strtolower($request->file('imagem')->getClientOriginalExtension() ?: 'jpg');
        if ($extensao === 'jpeg') {
            $extensao = 'jpg';
        }

        $fileName = $slug.'.'.$extensao;
        $pasta = $tipoFoto->dc_path_tfp;
        $caminhoRelativo = $pasta.'/'.$fileName;
        $caminhoAbsoluto = public_path('img/trilhas/'.$caminhoRelativo);

        $fotoExistente = Foto::where('id_trilha_tri', $trilha->id_trilha_tri)
            ->where('id_tipo_foto_tfo', $tipoFoto->id_tipo_foto_tfo)
            ->first();

        if ($fotoExistente && !empty($fotoExistente->nm_path_fot)) {
            $this->removerArquivoFotoTrilha($tipoFoto, $fotoExistente->nm_path_fot, $fileName);
        }

        $request->file('imagem')->storeAs($pasta, $fileName, 'trilhas');

        if (!empty($tipoFoto->width_tfo) && !empty($tipoFoto->height_tfo) && File::exists($caminhoAbsoluto)) {
            \Image::make($caminhoAbsoluto)
                ->fit((int) $tipoFoto->width_tfo, (int) $tipoFoto->height_tfo)
                ->save($caminhoAbsoluto);
        }

        if (File::exists($caminhoAbsoluto)) {
            \ImageOptimizer::optimize($caminhoAbsoluto);
        }

        $dados = [
            'id_trilha_tri' => $trilha->id_trilha_tri,
            'id_tipo_foto_tfo' => $tipoFoto->id_tipo_foto_tfo,
            'nm_foto_fot' => $trilha->nm_trilha_tri,
            'nm_path_fot' => $fileName,
            'dc_alt_fot' => $trilha->nm_trilha_tri,
        ];

        if ($fotoExistente) {
            $fotoExistente->update($dados);
        } else {
            Foto::create($dados);
        }

        Flash::success('Foto "'.$tipoFoto->nm_tipo_foto_tfo.'" salva como '.$fileName.'.');
        return redirect('admin/editar-trilha/'.$trilha->id_trilha_tri);
    }

    private function slugArquivoFotoTrilha(Trilha $trilha)
    {
        $slug = basename(trim((string) $trilha->ds_url_tri, '/'));
        if ($slug === '' || $slug === '.' || $slug === '..') {
            $slug = Str::slug($trilha->nm_trilha_tri);
        }

        return $slug ?: 'trilha-'.$trilha->id_trilha_tri;
    }

    private function removerArquivoFotoTrilha(TipoFoto $tipoFoto, $nmPathFot, $novoArquivo = null)
    {
        $nmPathFot = trim((string) $nmPathFot);
        if ($nmPathFot === '') {
            return;
        }

        $parts = explode('/', $nmPathFot);
        if (count($parts) > 1) {
            $caminho = public_path('img/trilhas/'.$tipoFoto->dc_path_tfp.'/'.$nmPathFot);
        } else {
            $caminho = public_path('img/trilhas/'.$tipoFoto->dc_path_tfp.'/'.$nmPathFot);
        }

        if ($novoArquivo && basename($caminho) === $novoArquivo) {
            return;
        }

        if (File::isFile($caminho)) {
            File::delete($caminho);
        }
    }

    public function update(Request $request)
    {
        if (Auth::guest() or trim(Auth::user()->id_role) != 'ADMIN') {
            return redirect('login');
        }

        $trilha = Trilha::where('id_trilha_tri', $request->id_trilha_tri)->first();

        $dados = $request->except($this->camposExcetoTrilha());
        $dados['nu_latitude_tri'] = $this->normalizeCoordenada($request->input('nu_latitude_tri'));
        $dados['nu_longitude_tri'] = $this->normalizeCoordenada($request->input('nu_longitude_tri'));

        if ($request->filled('remover_story') && $request->input('remover_story') == '1') {
            $this->removerImagemStory($trilha);
            $dados['ds_path_story_instagram_tri'] = null;
        }

        if ($request->filled('remover_gpx') && $request->input('remover_gpx') == '1') {
            $this->removerArquivoGpx($trilha);
            $dados['nm_arquivo_gpx_tri'] = null;
        }

        if ($trilha->update($dados)) {
            if (!empty($request->tags)) {
                $trilha->tags()->sync($request->tags);
            }

            $this->salvarArquivoGpx($request, $trilha->fresh());
            $this->salvarImagemStory($request, $trilha->fresh());
            $this->salvarDetalhesTrilha($request, $trilha->fresh());

            return redirect(URL::previous());
        } else {
            dd("Erro");
        }
    }

    /**
     * Aceita "-27.757661" ou vazio; normaliza vírgula decimal e retorna null se em branco.
     */
    private function normalizeCoordenada($valor)
    {
        if ($valor === null) {
            return null;
        }

        $valor = trim((string) $valor);
        if ($valor === '') {
            return null;
        }

        $valor = str_replace(',', '.', $valor);

        return is_numeric($valor) ? $valor : null;
    }

    private function salvarArquivoGpx(Request $request, Trilha $trilha)
    {
        if (!$request->hasFile('arquivo_gpx')) {
            return;
        }

        $arquivo = $request->file('arquivo_gpx');
        $extensao = strtolower($arquivo->getClientOriginalExtension());

        if ($extensao !== 'gpx') {
            Flash::error('O arquivo de trajeto deve estar no formato .gpx');
            return;
        }

        if ($arquivo->getSize() > 10 * 1024 * 1024) {
            Flash::error('O arquivo GPX deve ter no máximo 10 MB.');
            return;
        }

        $dir = public_path('gpx/trilhas');
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $nomeBase = pathinfo($arquivo->getClientOriginalName(), PATHINFO_FILENAME);
        $nomeBase = preg_replace('/[^a-zA-Z0-9\-_]+/', '-', $nomeBase);
        $nomeBase = trim($nomeBase, '-') ?: 'trilha';
        $fileName = $trilha->id_trilha_tri . '-' . strtolower($nomeBase) . '.gpx';

        if (!empty($trilha->nm_arquivo_gpx_tri) && $trilha->nm_arquivo_gpx_tri !== $fileName) {
            $this->removerArquivoGpx($trilha);
        }

        $arquivo->move($dir, $fileName);

        $caminho = $dir . DIRECTORY_SEPARATOR . $fileName;
        $ponto = $this->extrairPrimeiroPontoGpx($caminho);

        $update = ['nm_arquivo_gpx_tri' => $fileName];
        if ($ponto) {
            if (empty($trilha->nu_latitude_tri)) {
                $update['nu_latitude_tri'] = $ponto['lat'];
            }
            if (empty($trilha->nu_longitude_tri)) {
                $update['nu_longitude_tri'] = $ponto['lng'];
            }
        }

        $trilha->update($update);
        Flash::success('Arquivo GPX salvo com sucesso.');
    }

    private function salvarImagemStory(Request $request, Trilha $trilha)
    {
        if (!$request->hasFile('imagem_story')) {
            return;
        }

        $arquivo = $request->file('imagem_story');
        $extensao = strtolower($arquivo->getClientOriginalExtension());

        if (!in_array($extensao, ['jpg', 'jpeg', 'png', 'webp'], true)) {
            Flash::error('A imagem do story deve ser JPG, PNG ou WEBP.');
            return;
        }

        if ($arquivo->getSize() > 8 * 1024 * 1024) {
            Flash::error('A imagem do story deve ter no máximo 8 MB.');
            return;
        }

        $dir = public_path('img/instagram/stories');
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $fileName = $trilha->id_trilha_tri . '-story-' . date('YmdHis') . '.jpg';
        $this->removerImagemStory($trilha);

        $imagem = \Image::make($arquivo->getRealPath());
        if (function_exists('exif_read_data')) {
            $imagem->orientate();
        }
        $imagem->encode('jpg', 90)->save($dir . DIRECTORY_SEPARATOR . $fileName);

        $trilha->update(['ds_path_story_instagram_tri' => $fileName]);
        Flash::success('Imagem do story salva com sucesso.');
    }

    private function removerImagemStory(Trilha $trilha)
    {
        if (empty($trilha->ds_path_story_instagram_tri)) {
            return;
        }

        $caminho = public_path('img/instagram/stories/' . basename($trilha->ds_path_story_instagram_tri));
        if (is_file($caminho)) {
            @unlink($caminho);
        }
    }

    private function removerArquivoGpx(Trilha $trilha)
    {
        if (empty($trilha->nm_arquivo_gpx_tri)) {
            return;
        }

        $caminho = public_path('gpx/trilhas/' . $trilha->nm_arquivo_gpx_tri);
        if (is_file($caminho)) {
            @unlink($caminho);
        }
    }

    private function extrairPrimeiroPontoGpx($caminho)
    {
        if (!is_file($caminho)) {
            return null;
        }

        $xml = @simplexml_load_file($caminho);
        if ($xml === false) {
            return null;
        }

        $xml->registerXPathNamespace('g', 'http://www.topografix.com/GPX/1/1');

        $pontos = $xml->xpath('//g:trkpt');
        if (empty($pontos)) {
            $pontos = $xml->xpath('//trkpt');
        }
        if (empty($pontos)) {
            $pontos = $xml->xpath('//g:rtept') ?: $xml->xpath('//rtept');
        }
        if (empty($pontos)) {
            $pontos = $xml->xpath('//g:wpt') ?: $xml->xpath('//wpt');
        }
        if (empty($pontos)) {
            return null;
        }

        $lat = (string) $pontos[0]['lat'];
        $lng = (string) $pontos[0]['lon'];

        if (!is_numeric($lat) || !is_numeric($lng)) {
            return null;
        }

        return ['lat' => $lat, 'lng' => $lng];
    }

    private function camposExcetoTrilha()
    {
        return [
            'arquivo_gpx',
            'imagem_story',
            'tags',
            '_token',
            'remover_gpx',
            'remover_story',
            'nu_distancia_trd',
            'nu_altitude_trd',
            'duracao_trd',
            'ds_exposicao_trd',
            'ds_esforco_trd',
            'ds_orientacao_trd',
        ];
    }

    private function salvarDetalhesTrilha(Request $request, Trilha $trilha)
    {
        $distanciaRaw = $request->input('nu_distancia_trd');
        $distancia = null;

        if ($distanciaRaw !== null && trim((string) $distanciaRaw) !== '') {
            $distanciaNormalizada = str_replace(',', '.', trim((string) $distanciaRaw));
            if (is_numeric($distanciaNormalizada)) {
                $distancia = (float) $distanciaNormalizada;
            }
        }

        $altitudeRaw = $request->input('nu_altitude_trd');
        $altitude = null;

        if ($altitudeRaw !== null && trim((string) $altitudeRaw) !== '') {
            $altitudeNormalizada = str_replace(',', '.', trim((string) $altitudeRaw));
            if (is_numeric($altitudeNormalizada)) {
                $altitude = (int) round((float) $altitudeNormalizada);
            }
        }

        $duracao = $this->normalizeDuracaoTrilha($request->input('duracao_trd'));
        $niveisDetalhe = ['Nível 1', 'Nível 2', 'Nível 3', 'Nível 4', 'Nível 5'];
        $exposicao = $this->normalizeNivelDetalhe($request->input('ds_exposicao_trd'), $niveisDetalhe);
        $esforco = $this->normalizeNivelDetalhe($request->input('ds_esforco_trd'), $niveisDetalhe);
        $orientacao = $this->normalizeNivelDetalhe($request->input('ds_orientacao_trd'), $niveisDetalhe);

        $detalhe = Detalhe::withTrashed()->firstOrNew(['id_trilha_tri' => $trilha->id_trilha_tri]);

        if ($detalhe->trashed()) {
            $detalhe->restore();
        }

        $detalhe->id_trilha_tri = $trilha->id_trilha_tri;
        $detalhe->nu_distancia_trd = $distancia;
        $detalhe->nu_altitude_trd = $altitude;
        $detalhe->duracao_trd = $duracao;
        $detalhe->ds_exposicao_trd = $exposicao;
        $detalhe->ds_esforco_trd = $esforco;
        $detalhe->ds_orientacao_trd = $orientacao;
        $detalhe->save();
    }

    private function normalizeDuracaoTrilha($valor)
    {
        if ($valor === null) {
            return null;
        }

        $valor = trim((string) $valor);
        if ($valor === '') {
            return null;
        }

        if (!preg_match('/^(\d{1,2}):([0-5]\d)(?::([0-5]\d))?$/', $valor, $partes)) {
            return null;
        }

        return sprintf(
            '%02d:%02d:%02d',
            (int) $partes[1],
            (int) $partes[2],
            isset($partes[3]) ? (int) $partes[3] : 0
        );
    }

    private function normalizeNivelDetalhe($valor, array $niveisPermitidos)
    {
        if ($valor === null) {
            return null;
        }

        $valor = trim((string) $valor);
        if ($valor === '' || !in_array($valor, $niveisPermitidos, true)) {
            return null;
        }

        return $valor;
    }

    public function enviarEmailTesteConvite(Request $request, $id)
    {
        if (Auth::guest() or trim(Auth::user()->id_role) != 'ADMIN') {
            return redirect('login');
        }

        $tipo = trim((string) $request->input('tipo', 'trilheiro'));

        if (!in_array($tipo, ['trilheiro', 'guia'])) {
            Flash::error('Tipo de teste inválido.');
            return redirect()->back();
        }

        try {
            $trilha = Trilha::with('foto')->findOrFail($id);
            $emailDestino = Auth::user()->email;
            $nomeDestino = Auth::user()->name ?: 'Administrador';

            if ($tipo === 'guia') {
                Mail::to($emailDestino)->send(new ConviteTrilhaGuia($trilha, $nomeDestino, true));
            } else {
                Mail::to($emailDestino)->send(new ConviteTrilhaTrilheiro($trilha, $nomeDestino, true));
            }

            Flash::success('Email de teste enviado com sucesso para ' . $emailDestino . '.');
        } catch (\Exception $e) {
            \Log::error('Erro ao enviar email de teste de convite de trilha', [
                'trilha_id' => $id,
                'tipo' => $tipo,
                'admin_user_id' => Auth::id(),
                'error' => $e->getMessage(),
            ]);

            Flash::error('Erro ao enviar email de teste: ' . $e->getMessage());
        }

        return redirect()->back();
    }

    public function enviarEmailConviteTrilheiros(Request $request, $id)
    {
        return $this->enviarConvitesEmLotesHttp($request, $id, 1);
    }

    public function enviarEmailConviteGuias(Request $request, $id)
    {
        return $this->enviarConvitesEmLotesHttp($request, $id, 2);
    }

    /**
     * Envia poucos emails por requisição para funcionar sem queue worker.
     * O navegador chama este endpoint repetidamente e mantém a tela aberta.
     */
    private function enviarConvitesEmLotesHttp(Request $request, $idTrilha, $tipoEnvio)
    {
        if (Auth::guest() || trim(Auth::user()->id_role) !== 'ADMIN') {
            return response()->json(['message' => 'Acesso não autorizado.'], 403);
        }

        try {
            $trilha = Trilha::with('foto')->findOrFail($idTrilha);
            $tipoEnvio = (int) $tipoEnvio;
            $cursorInformado = max(0, (int) $request->input('cursor', 0));
            $chaveSessao = 'envio_convite_trilha_'.$idTrilha.'_'.$tipoEnvio.'_'.Auth::id();

            if ($request->boolean('reiniciar')) {
                Session::forget($chaveSessao);
            }

            $estado = Session::get($chaveSessao);
            if (!$estado) {
                if ($cursorInformado !== 0) {
                    return response()->json([
                        'message' => 'A sessão do envio expirou. Inicie novamente.',
                    ], 409);
                }

                $total = $this->queryDestinatariosConvite($tipoEnvio)->count();
                $estado = [
                    'cursor' => 0,
                    'total' => $total,
                    'processados' => 0,
                    'enviados' => 0,
                    'falhas' => 0,
                    'concluido' => false,
                    'log_registrado' => false,
                ];
                Session::put($chaveSessao, $estado);
            }

            if (!empty($estado['concluido'])) {
                return response()->json(array_merge($estado, [
                    'message' => 'Envio concluído.',
                ]));
            }

            // Evita reenvio quando o navegador repetir uma requisição já concluída.
            if ($cursorInformado !== (int) $estado['cursor']) {
                return response()->json(array_merge($estado, [
                    'message' => 'Continuando do último lote confirmado.',
                ]));
            }

            $chavePrimaria = $tipoEnvio === 1 ? 'id_trilheiro_tri' : 'id_guia_gui';
            $destinatarios = $this->queryDestinatariosConvite($tipoEnvio)
                ->where($chavePrimaria, '>', $estado['cursor'])
                ->orderBy($chavePrimaria)
                ->take(3)
                ->get();

            foreach ($destinatarios as $destinatario) {
                $estado['cursor'] = (int) $destinatario->{$chavePrimaria};
                $estado['processados']++;

                try {
                    $email = optional($destinatario->user)->email;
                    if (empty($email)) {
                        $estado['falhas']++;
                        continue;
                    }

                    if ($tipoEnvio === 1) {
                        $nome = $destinatario->nm_trilheiro_tri ?: optional($destinatario->user)->name;
                        Mail::to($email)->send(new ConviteTrilhaTrilheiro($trilha, $nome, false));
                    } else {
                        $nome = $destinatario->nm_guia_gui ?: optional($destinatario->user)->name;
                        Mail::to($email)->send(new ConviteTrilhaGuia($trilha, $nome, false));
                    }

                    $estado['enviados']++;
                } catch (\Exception $e) {
                    $estado['falhas']++;
                    \Log::error('Erro no envio HTTP de convite de trilha', [
                        'trilha_id' => $idTrilha,
                        'tipo_envio' => $tipoEnvio,
                        'destinatario_id' => $estado['cursor'],
                        'error' => $e->getMessage(),
                    ]);
                }
            }

            $temProximo = $this->queryDestinatariosConvite($tipoEnvio)
                ->where($chavePrimaria, '>', $estado['cursor'])
                ->exists();
            $concluido = !$temProximo;

            if ($concluido) {
                $estado['concluido'] = true;
                if ($estado['enviados'] > 0 && empty($estado['log_registrado'])) {
                    $this->registrarLogEmail($idTrilha, $tipoEnvio, $estado['enviados']);
                    $estado['log_registrado'] = true;
                }
            }
            Session::put($chaveSessao, $estado);

            return response()->json(array_merge($estado, [
                'message' => $concluido
                    ? 'Envio concluído.'
                    : 'Lote enviado. Preparando o próximo...',
            ]));
        } catch (\Exception $e) {
            \Log::error('Erro ao processar envio HTTP de convites', [
                'trilha_id' => $idTrilha,
                'tipo_envio' => $tipoEnvio,
                'admin_user_id' => Auth::id(),
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'message' => 'Erro ao enviar o lote: '.$e->getMessage(),
            ], 500);
        }
    }

    private function queryDestinatariosConvite($tipoEnvio)
    {
        if ((int) $tipoEnvio === 1) {
            return Trilheiro::with('user')
                ->where('fl_newsletter_tri', true)
                ->whereHas('user', function ($query) {
                    $query->whereNotNull('email')->where('email', '<>', '');
                });
        }

        return Guia::with('user')
            ->where('fl_ativo_gui', true)
            ->whereHas('user', function ($query) {
                $query->whereNotNull('email')->where('email', '<>', '');
            });
    }

    private function registrarLogEmail($idTrilha, $tipoEnvio, $totalEnvios)
    {
        LogEmail::create([
            'id_trilha_tri' => $idTrilha,
            'cd_tipo_envio_tie' => $tipoEnvio,
            'nu_total_envios_loe' => $totalEnvios,
            'dt_envio_loe' => now(),
        ]);
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
            ->where('fl_cancelado_eve', false)
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


    public function mapa()
    {
        $trilhas = Trilha::with(['nivel', 'cidade', 'foto', 'detalhes'])
            ->where('fl_publicacao_tri', 'S')
            ->where(function ($query) {
                $query->where(function ($q) {
                    $q->whereNotNull('nu_latitude_tri')
                      ->whereNotNull('nu_longitude_tri');
                })->orWhereNotNull('nm_arquivo_gpx_tri');
            })
            ->orderBy('nm_trilha_tri')
            ->get();

        $marcadores = $trilhas->map(function ($trilha) {
            $foto = $trilha->foto->where('id_tipo_foto_tfo', 5)->first();
            $img = !empty($foto->nm_path_fot) ? $foto->nm_path_fot : 'padrao.jpg';
            $alt = !empty($foto->dc_alt_fot) ? $foto->dc_alt_fot : 'Foto principal da trilha';
            $distancia = optional($trilha->detalhes)->nu_distancia_trd;

            return [
                'id' => $trilha->id_trilha_tri,
                'nome' => $trilha->nm_trilha_tri,
                'lat' => $trilha->nu_latitude_tri !== null ? (float) $trilha->nu_latitude_tri : null,
                'lng' => $trilha->nu_longitude_tri !== null ? (float) $trilha->nu_longitude_tri : null,
                'url' => url($trilha->ds_url_tri),
                'cidade' => optional($trilha->cidade)->nm_cidade_cde,
                'nivel' => optional($trilha->nivel)->dc_nivel_niv,
                'cor' => optional($trilha->nivel)->dc_color_nivel_niv ?: '#989898',
                'imagem' => asset('img/trilhas/detalhes-principal/' . $img),
                'imagemAlt' => $alt,
                'gpx' => $trilha->url_gpx,
                'distancia' => $distancia !== null && $distancia !== '' ? (float) $distancia : null,
            ];
        })->values();

        $niveis = Nivel::orderBy('ordem_niv')->orderBy('id_nivel_niv')->get();

        return view('trilhas.mapa', compact('marcadores', 'niveis'));
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
                              $query->where('nm_trilha_tri', 'like', '%'.trim($termo).'%');
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

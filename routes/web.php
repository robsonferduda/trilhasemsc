<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'HomeController@index')->name('index');
Route::get('home', 'HomeController@index')->name('home');
Route::get('novo', 'HomeController@novo')->name('novo');
Route::get('perfil/{id}', 'HomeController@perfil')->name('perfil');

Route::get('camping', 'HomeController@camping');
Route::get('campings', 'CampingController@campings');
Route::get('{cidade}/camping/{nivel}/{url}', 'CampingController@detalhes');

//Route::get('laguna/campings/selvagem/camping-mirante-anita-garibaldi', 'CampingController@anitaGaribaldi');
//Route::get('bom-jardim-da-serra/campings/selvagem/camping-pico-do-rinoceronte', 'CampingController@picoRinoceronte');
//Route::get('grao-para/campings/estruturado/camping-mirante','CampingController@campingMirante');
//Route::get('garuva/campings/selvagem/camping-monte-crista', 'CampingController@monteCrista');
//Route::get('rancho-queimado/campings/estruturado/camping-mirante-do-alto-da-boa-vista','CampingController@altoBoaVista');

Route::get('rastreio/mostra-dados', 'PublicidadeController@localizacao');
Route::get('rastreio/{codigo}', 'QRCodeController@rastreio');
Route::get('rastreio/publicidade/{codigo}', 'PublicidadeController@rastreio');

Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider')->name('social.redirect');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback')->name('social.callback');

// Newsletter - Descadastro
Route::get('newsletter/descadastrar/{trilheiro}/{token}', 'NewsletterController@showUnsubscribe')->name('newsletter.show-unsubscribe');
Route::post('newsletter/descadastrar/{trilheiro}/{token}', 'NewsletterController@unsubscribe')->name('newsletter.unsubscribe');
Route::get('newsletter/reinscrever/{trilheiro}/{token}', 'NewsletterController@resubscribe')->name('newsletter.resubscribe');

Route::post('comentario/novo', 'ComentarioController@store');

Route::post('estado/{estado}/cidades', 'HomeController@getCidades');

Route::get('trilhas/brasil', 'TrilhaController@brasil');
Route::get('trilhas/regioes', 'TrilhaController@regioes');
Route::get('trilha/add-tags', 'TrilhaController@addTags');
Route::get('trilhas', 'TrilhaController@searchTrilhas');
Route::get('{cidade}/trilhas', 'TrilhaController@searchTrilhasCidade');
Route::get('trilhas/{nivel}', 'TrilhaController@searchTrilhasNivel');
Route::get('{cidade}/trilhas/{nivel}', 'TrilhaController@searchTrilhasCidadeNivel');
Route::get('{cidade}/trilhas/{nivel}/{trilha}', 'TrilhaController@searchTrilha');
Route::get('trilhas/tag/{tag}', 'TrilhaController@searchTrilhasTag');
Route::get('trilhas-em-{cidade}', 'TrilhaController@searchTrilhasCidadeDetalhes');

Route::get('eventos', 'EventoController@index');
// Nova rota com slug (aceita tanto slug quanto ID)
Route::get('eventos/{slugOrId}', 'EventoController@detalhes')
    ->where('slugOrId', '[a-zA-Z0-9\-]+')
    ->name('evento.detalhes');
// Rota antiga mantida para compatibilidade
Route::get('eventos/detalhes/{id}', 'EventoController@detalhes')->where('id', '[0-9]+');
Route::get('eventos/confirmacao/{id}', 'EventoController@confirmacao');
Route::get('eventos/cancelamento/{id}', 'EventoController@confirmacaoCancelamento');

Route::get('guia/{id}/ativar', 'GuiaController@ativar');
Route::get('guia/{id}/recusar', 'GuiaController@recusar');
Route::get('guia/perfil/{id}', 'GuiaController@perfil');
Route::get('guia/perfil/estatistica/{tipo}/{id}', 'GuiaController@estatisticas');
Route::match(['GET', 'POST'],'guias-e-condutores', 'GuiaController@index');
Route::match(['GET', 'POST'],'guias-e-condutores/cadastro', 'GuiaController@cadastro');

Route::get('guia-de-dificuldade-em-trilhas', 'DificuldadeController@index');
Route::get('guia-de-dificuldade-em-trilhas/abnt', 'DificuldadeController@abnt');
Route::get('guia-de-dificuldade-em-trilhas/femerj', 'DificuldadeController@femerj');

Route::get('galerias', 'GaleriaController@index');
Route::get('galerias/{nome}', 'GaleriaController@buscar');
Route::get('contato', 'HomeController@contato');

Route::get('guia', 'HomeController@guia');
Route::get('sobre-nos', 'HomeController@sobre');

Route::get('grupos', 'GrupoController@index');

Route::get('nacional/{regiao}/estado/{estado}/{trilha}', 'NacionalController@trilha');

Route::get('praias', 'PraiaController@index');
Route::get('praias/florianopolis', 'PraiaController@index');
Route::get('praias/florianopolis/sul', 'PraiaController@index');
Route::get('praias/florianopolis/sul/{nome}', 'PraiaController@getPraia');

Route::get('trilhas/florianopolis/regioes/leste', 'TrilhaController@trilhasLeste');
Route::get('trilhas/florianopolis/regioes/norte', 'TrilhaController@trilhasNorte');
Route::get('trilhas/florianopolis/regioes/sul', 'TrilhaController@trilhasSul');
Route::get('trilhas/santa-catarina/regioes','TrilhaController@regioesSC');
Route::get('trilhas/santa-catarina/regioes/serra-catarinense','TrilhaController@serraCatarinense');

Route::get('trilhas/brasil/regioes/nordeste/chapada', 'TrilhaController@chapada');

Route::get('unidades-de-conservacao', 'UCController@index');
Route::get('unidades-de-conservacao/detalhes/{id}', 'UCController@detalhes');

Route::get('sitemap', 'SiteMapController@gerar');
Route::get('sitemap/visualizar/{tipo}', 'SiteMapController@visualizar');
Route::get('sitemap/visualizar/{tipo}', 'SiteMapController@visualizar');

Route::get('dicas-de-seguranca', function () {
    return view('dicas-de-seguranca');
})->name('dicas-de-seguranca');

Route::get('indice-experiencia-trilhas', function () {
    return view('indice');
})->name('indice');

Route::get('politica-de-privacidade', function () {
    return view('politica-de-privacidade');
})->name('politica-de-privacidade');

Route::get('termos-de-uso', function () {
    return view('termos-de-uso');
})->name('termos-de-uso');

Route::get('caneca', function () {
    return view('caneca');
})->name('caneca');

Route::group(['middleware' => ['web']], function () {

    Route::get('usuario/add', 'UserController@store');
    Route::get('usuario/update', 'UserController@update');
    Route::get('usuarios', 'UserController@index');

    Route::get('tag/add', 'TagController@store');
    Route::get('tags', 'TagController@index');

    Route::get('tags', 'TagController@index');

    Route::get('login/facebook', 'FacebookController@redirectToProvider');
    Route::get('login/facebook/callback', 'FacebookController@handleProviderCallback');

    Route::get('login/google', 'GoogleController@redirectToProvider');
    Route::get('login/google/callback', 'GoogleController@handleProviderCallback');

    Route::prefix('admin')->group(function () {

        Route::get('dashboard', 'HomeController@dashboard');

        Route::get('eventos/listar', 'EventoController@listar');

        Route::get('guias', 'GuiaController@listar');
        Route::get('guias/aprovar', 'GuiaController@aprovar');
        Route::get('guias/listar', 'GuiaController@listar');

        Route::get('trilheiros/listar', 'TrilheiroController@listar')->name('admin.trilheiros.listar');
        Route::get('trilheiros/ajax', 'TrilheiroController@listarAjax')->name('admin.trilheiros.ajax');
        Route::get('trilheiro/perfil/{id}', 'TrilheiroController@show');
        Route::post('trilheiro/{id}/enviar-email-boas-vindas', 'TrilheiroController@enviarEmailBoasVindas')->name('admin.trilheiro.enviar-email');
        Route::post('trilheiro/{id}/enviar-email-questionario', 'TrilheiroController@enviarEmailQuestionario')->name('admin.trilheiro.enviar-email-questionario');
        Route::post('trilheiros/enviar-email-questionario-massa', 'TrilheiroController@enviarEmailQuestionarioEmMassa')->name('admin.trilheiros.enviar-email-questionario-massa');

        Route::get('listar-trilhas', 'TrilhaController@index');
        Route::get('editar-trilha/{id}', 'TrilhaController@editar');
        Route::get('nova-trilha', 'TrilhaController@novo');
        Route::post('update-trilha', 'TrilhaController@update');
        Route::post('create-trilha', 'TrilhaController@create');
        Route::post('insert-foto', 'TrilhaController@insertFoto');
    });
    
    Route::prefix('guia-e-condutores/privado')->group(function () {
        Route::match(['GET', 'POST'], 'atualizar-cadastro', 'GuiaController@atualizarCadastro');
        Route::get('perfil', 'GuiaController@previaPerfil');
        Route::get('eventos', 'EventoController@eventos');
        Route::get('eventos/participantes/{id}', 'EventoController@participantes');
        Route::get('evento/novo', 'EventoController@cadastro');
        Route::get('evento/editar/{id}', 'EventoController@editar');
        Route::post('evento/update', 'EventoController@update');
        Route::post('evento/cadastrar', 'EventoController@cadastrar');
        Route::post('evento/clonar/{id}', 'EventoController@clonar')->name('evento.clonar');
        Route::match(['GET', 'POST'],'trilhas', 'GuiaController@trilhas');
    });

    Route::prefix('trilheiro/privado')->group(function () {
        Route::get('perfil', 'TrilheiroController@perfil');
        Route::get('eventos', 'TrilheiroController@eventos');
        Route::get('meu-nivel', 'TrilheiroController@score');
        Route::get('eventos/participar/{evento}', 'EventoController@participar');
        Route::get('eventos/cancelar/{evento}', 'EventoController@cancelarParticipacao');
        Route::post('score', 'TrilheiroController@calcularScore');
        Route::match(['GET', 'POST'], 'atualizar-cadastro', 'TrilheiroController@atualizarCadastro');      
        Route::match(['GET', 'POST'],'trilhas', 'TrilheiroController@trilhas'); 
    });

    Route::prefix('cadastro/privado')->group(function () {
        Route::match(['GET', 'POST'], 'escolher-perfil', 'CadastroController@selecionarPerfil');
    });
});
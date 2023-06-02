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
Route::get('home', 'HomeController@index')->name('index');
Route::get('novo', 'HomeController@novo')->name('novo');
Route::get('perfil/{id}', 'HomeController@perfil')->name('perfil');

Route::post('comentario/novo', 'ComentarioController@store');

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
Route::get('eventos/detalhes/{id}', 'EventoController@detalhes');

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
Route::get('camping', 'HomeController@camping');
Route::get('guia', 'HomeController@guia');
Route::get('sobre-nos', 'HomeController@sobre');

Route::get('grupos', 'GrupoController@index');

Route::get('campings', 'CampingController@campings');
Route::get('laguna/campings/selvagem/camping-mirante-anita-garibaldi', 'CampingController@anitaGaribaldi');
Route::get('bom-jardim-da-serra/campings/selvagem/camping-pico-do-rinoceronte', 'CampingController@picoRinoceronte');
Route::get('grao-para/campings/estruturado/camping-mirante','CampingController@campingMirante');
Route::get('garuva/campings/selvagem/camping-monte-crista', 'CampingController@monteCrista');
Route::get('rancho-queimado/campings/estruturado/camping-mirante-do-alto-da-boa-vista','CampingController@altoBoaVista');
Route::get('trilhas/florianopolis/regioes/leste', 'TrilhaController@trilhasLeste');
Route::get('trilhas/florianopolis/regioes/norte', 'TrilhaController@trilhasNorte');
Route::get('trilhas/florianopolis/regioes/sul', 'TrilhaController@trilhasSul');
Route::get('trilhas/santa-catarina/regioes','TrilhaController@regioesSC');
Route::get('trilhas/santa-catarina/regioes/serra-catarinense','TrilhaController@serraCatarinense');

Route::get('trilhas/brasil/regioes/nordeste/chapada', 'TrilhaController@chapada');

Route::get('sitemap', 'SiteMapController@gerar');
Route::get('sitemap/visualizar/{tipo}', 'SiteMapController@visualizar');
Route::get('sitemap/visualizar/{tipo}', 'SiteMapController@visualizar');

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
    });

});

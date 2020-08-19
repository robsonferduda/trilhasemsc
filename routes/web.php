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

Route::post('comentario/novo', 'ComentarioController@store');

Route::get('trilha/add-tags', 'TrilhaController@addTags');
Route::get('trilhas', 'TrilhaController@searchTrilhas');
Route::get('{cidade}/trilhas', 'TrilhaController@searchTrilhasCidade');
Route::get('trilhas/{nivel}', 'TrilhaController@searchTrilhasNivel');
Route::get('{cidade}/trilhas/{nivel}', 'TrilhaController@searchTrilhasCidadeNivel');
Route::get('{cidade}/trilhas/{nivel}/{trilha}', 'TrilhaController@searchTrilha');
Route::get('trilhas/tag/{tag}', 'TrilhaController@searchTrilhasTag');

Route::get('guia-de-dificuldade-em-trilhas', 'DificuldadeController@index');
Route::get('guia-de-dificuldade-em-trilhas/abnt', 'DificuldadeController@abnt');
Route::get('guia-de-dificuldade-em-trilhas/femerj', 'DificuldadeController@femerj');

Route::get('galerias', 'GaleriaController@index');
Route::get('contato', 'HomeController@contato');
Route::get('camping', 'HomeController@camping');
Route::get('guia', 'HomeController@guia');
Route::get('sobre-nos', 'HomeController@sobre');

Route::get('usuario/add', 'UserController@store');
Route::get('usuario/update', 'UserController@update');
Route::get('usuarios', 'UserController@index');

Route::get('tag/add', 'TagController@store');
Route::get('tags', 'TagController@index');

Route::get('tags', 'TagController@index');

Route::get('login/facebook', 'FacebookController@redirectToProvider');
Route::get('login/facebook/callback', 'FacebookController@handleProviderCallback');

Route::prefix('admin')->group(function () {
    Route::get('listar-trilhas', 'TrilhaController@index');
    Route::get('editar-trilha/{id}', 'TrilhaController@editar');
    Route::get('nova-trilha', 'TrilhaController@novo');
    Route::post('update-trilha', 'TrilhaController@update');
    Route::post('create-trilha', 'TrilhaController@create');
});

Route::get('sitemap', 'SiteMapController@gerar');
Route::get('sitemap/visualizar/{tipo}', 'SiteMapController@visualizar');
Route::get('sitemap/visualizar/{tipo}', 'SiteMapController@visualizar');

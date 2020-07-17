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

Route::get('trilhas', 'TrilhaController@searchTrilhas');
Route::get('{cidade}/trilhas', 'TrilhaController@searchTrilhasCidade');
Route::get('trilhas/{nivel}', 'TrilhaController@searchTrilhasNivel');
Route::get('{cidade}/trilhas/{nivel}', 'TrilhaController@searchTrilhasCidadeNivel');
Route::get('{cidade}/trilhas/{nivel}/{trilha}', 'TrilhaController@searchTrilha');

Route::get('usuario/add', 'UserController@store');
Route::get('usuarios', 'UserController@index');

Route::get('tag/add', 'TagController@store');
Route::get('tags', 'TagController@index');

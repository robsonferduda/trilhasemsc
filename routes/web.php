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
Route::get('{cidade}/{categoria}/{trilha}', 'TrilhaController@show')->name('detalhes');
Route::get('trilhas', 'TrilhaController@search');


Route::get('usuarios/add', 'UserController@store');
Route::get('usuarios', 'UserController@index');

Route::get('tag/add', 'TagController@store');
Route::get('tags', 'TagController@index');

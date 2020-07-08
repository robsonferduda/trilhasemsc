<?php

namespace App\Http\Controllers;

use App\Trilha;
use Illuminate\Http\Request;

class TrilhaController extends Controller
{
    
    public function __construct()
    {
        //
    }

    public function show($cidade, $categoria, $url)
    {
    	$trilha = Trilha::where('ds_url_tri', $url)->first();
    	return view('trilhas/detalhes',['trilha' => $trilha]);
    }

    public function search(Request $request){

    	dd($request);

    	$trilhas = Trilha::get();

    	dd($trilhas);

    	return view('trilhas/lista');
    }
}

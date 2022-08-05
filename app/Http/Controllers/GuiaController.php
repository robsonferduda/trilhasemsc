<?php

namespace App\Http\Controllers;

use DB;
use App\Nivel;
use App\Trilha;
use App\Cidade;
use App\Guia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class GuiaController extends Controller
{
    public function index()
    {
        $page_name = "Guias";
        $guias = Guia::orderBy("nm_guia_gui")->get();

        return view('guias/index', ['page_name' => $page_name, 'guias' => $guias]);
    }
}
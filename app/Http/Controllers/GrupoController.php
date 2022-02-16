<?php

namespace App\Http\Controllers;

use DB;
use App\Nivel;
use App\Trilha;
use App\Cidade;
use App\Galeria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class GrupoController extends Controller
{
    public function index()
    {
        $page_name = "Grupos";
        return view('grupo/index', ['page_name' => $page_name]);
    }
}
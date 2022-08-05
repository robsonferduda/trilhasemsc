<?php

namespace App\Http\Controllers;

use DB;
use App\Nivel;
use App\Trilha;
use App\Cidade;
use App\Galeria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class GuiaController extends Controller
{
    public function index()
    {
        $page_name = "Guias";
        return view('guias/index', ['page_name' => $page_name]);
    }
}
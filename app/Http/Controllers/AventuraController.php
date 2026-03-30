<?php

namespace App\Http\Controllers;

use DB;
use App\Nivel;
use App\Trilha;
use App\Cidade;
use App\Evento;
use App\Galeria;
use App\Guia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AventuraController extends Controller
{
    public function index()
    {
        
    }

    public function peru()
    {
        return view('aventuras.peru');
    }
}
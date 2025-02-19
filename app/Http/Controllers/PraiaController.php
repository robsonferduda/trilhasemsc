<?php

namespace App\Http\Controllers;

use DB;
use URL;
use Auth;
use App\User;
use App\Tag;
use App\Trilha;
use App\Cidade;
use App\Nivel;
use App\Foto;
use App\Estatistica;
use App\Categoria;
use App\Complemento;
use App\TipoFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;

class PraiaController extends Controller
{
    public function __construct()
    {
        //
    }

    public function index()
    {
        if (Auth::guest() or trim(Auth::user()->id_role) != 'ADMIN') {
            return redirect('login');
        }

        $trilhas = Trilha::all();
        return view('admin/trilha/index', ['trilhas' => $trilhas]);
    }

    public function getPraia($nome)
    {
        
    }
}
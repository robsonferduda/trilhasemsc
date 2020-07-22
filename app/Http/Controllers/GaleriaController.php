<?php

namespace App\Http\Controllers;

use App\Galeria;
use Illuminate\Http\Request;

class GaleriaController extends Controller
{
    
    public function __construct()
    {
        //
    }

    public function index()
    {
        $page_name = "Galerias";
        $galerias = Galeria::orderBy('nm_galeria_gal')->get();

        return view('galeria',['page_name' => $page_name, 'galerias' => $galerias]);
    }   
}
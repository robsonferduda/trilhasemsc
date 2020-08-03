<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DificuldadeController extends Controller
{

    public function index()
    {
        $page_name = "Guia";

        return view('dificuldade/index',['page_name' => $page_name]);
    }

    public function abnt()
    {
        $page_name = "Guia";

        return view('dificuldade/abnt',['page_name' => $page_name]);
    }

    public function femerj()
    {
        $page_name = "Guia";

        return view('dificuldade/femerj',['page_name' => $page_name]);
    }
}
<?php

namespace App\Http\Controllers;

use DB;
use URL;
use Auth;
use App\Praia;
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

    public function getPraia($url)
    {

        $praia = Praia::where('ds_url_pra', $url)->first();

        dd($praia);

        return view('praias/detalhes', ['praia' => $praia]);
    }
}
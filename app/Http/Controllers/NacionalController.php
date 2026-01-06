<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class NacionalController extends Controller
{
    public function trilha($regiao, $estado, $trilha)
    {
        switch ($trilha) {
            case 'pantanal':
                $trilha = 'Pantanal';
                $view = 'pantanal';
                break;
            default:
                abort(404);
        }

        return view("nacional.$view", compact('regiao', 'estado', 'trilha'));
    }
}
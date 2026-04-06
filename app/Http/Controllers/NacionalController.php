<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Estatistica;

class NacionalController extends Controller
{
    // IDs artificiais para páginas de aventura (cd_tipo_monitoramento_tim = 3)
    const AVENTURA_IDS = [
        'pantanal' => 1000,
    ];

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

        // Registrar estatística de acesso
        try {
            Estatistica::create([
                'cd_usuario_usu'           => Auth::check() ? Auth::user()->id : null,
                'cd_tipo_monitoramento_tim' => 3,
                'cd_monitoramento_esa'      => self::AVENTURA_IDS[$view] ?? 0,
            ]);
        } catch (\Exception $e) {
            \Log::error('Erro ao registrar estatística NacionalController: ' . $e->getMessage());
        }

        return view("nacional.$view", compact('regiao', 'estado', 'trilha'));
    }
}
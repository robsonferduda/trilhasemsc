<?php

namespace App\Http\Controllers;

use App\Guia;
use App\Interacao;
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

    public function perfil($id)
    {
        $page_name = "Perfil";
        $guia = Guia::find($id);

        return view('guias/perfil', ['page_name' => $page_name, 'guia' => $guia]);
    }

    public function estatisticas($tipo, $id)
    {
        $url = null;
        $interacao = 0;
        $guia = Guia::find($id);
        $fone = ($guia->fone) ? preg_replace('/[(\)\-\" "]+/', '', $guia->fone->nu_fone_fon) : '';

        switch ($tipo) {
            case 'instagram':
                $interacao = 1;
                $url = 'https://www.instagram.com/'.$guia->nm_instagram_gui;
                break;
            
            case 'telefone':
                $interacao = 2;
                $url = 'https://api.whatsapp.com/send?phone=55'.$fone.'&text=Olá! Vi seu perfil no https://trilhasemsc.com.br/guias-e-condutores e fiquei interessado. Pode me dar mais informações?';
                break;

            case 'perfil':
                $interacao = 3;
                $url = 'guia/perfil/'.$id;
                break;
        }

        $dados = array('id_tipo_interacao_tin' => $interacao,
                       'id_guia_gui' => $id);

        Interacao::create($dados);

        return redirect($url);
    }
}
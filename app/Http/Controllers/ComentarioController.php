<?php

namespace App\Http\Controllers;

use Auth;
use URL;
use App\Tag;
use App\Comentario;
use Laracasts\Flash\Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\ComentarioRequest;

class ComentarioController extends Controller
{
    public function __construct()
    {
        //
    }

    public function index()
    {
        foreach (Tag::all() as $tag) {
            echo "<pre>";
            echo $tag;
            echo "</pre>";
        }
    }

    public function store(ComentarioRequest $request)
    {
        $request->merge(['id_user_usu' => Auth::user()->id]);

        if (Comentario::create($request->all())) {
            Flash::success('Seu comentário foi enviado com sucesso! Obrigado por compartilhar sua experiência!');
        } else {
            Flash::error('Ops... Ocorreu um erro ao enviar seu comentário.');
        }
        
        return redirect(URL::previous().'#comentarios');
    }
}

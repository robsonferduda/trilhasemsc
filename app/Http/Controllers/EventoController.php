<?php

namespace App\Http\Controllers;

use Auth;
use App\Evento;
use App\Cidade;
use App\Guia;
use Laracasts\Flash\Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class EventoController extends Controller
{
    public function index()
    {
        $page_name = "Eventos e Trilhas em Santa Catarina";
        $eventos = Evento::all();
        $cidades = Cidade::whereIn('cd_cidade_cde', Evento::select('cd_cidade_cde')->get())->orderBy('nm_cidade_cde')->select('cd_cidade_cde', 'nm_cidade_cde')->get();

        return view('eventos/index', ['page_name' => $page_name, 'eventos' => $eventos, 'cidades' => $cidades]);
    }

    public function detalhes($id)
    {
        $evento = Evento::find($id);
        $page_name = "Eventos e Trilhas em Santa Catarina - ".$evento->nm_evento_eve;
        
        $dados = array('id_tipo_interacao_tin' => 5,
                       'id_guia_gui' => $id);

        return view('eventos/detalhes', ['page_name' => $page_name, 'evento' => $evento]);
    }

    public function eventos()
    {
        $guia = Guia::where('id_user', Auth::user()->id)->first();
        $eventos = Evento::where('id_guia_gui', $guia->id_guia_gui)->orderBy('dt_realizacao_eve')->get();

        return view('admin/eventos/listar', compact('guia','eventos'));
    }

    public function cadastro()
    {
        $guia = Guia::where('id_user', Auth::user()->id)->first();
        $cidades = Cidade::where('cd_estado_est', 42)->orderBy('nm_cidade_cde')->get();

        return view('admin/eventos/cadastro', compact('guia','cidades'));
    }

    public function cadastrar(Request $request)
    {
        if (Auth::guest() or trim(Auth::user()->id_role) != 'GUIA') {
            return redirect('login');
        }
        
        $guia = Guia::where('id_user', Auth::user()->id)->first();

        $dados = array('id_guia_gui' => $guia->id_guia_gui,
                        'cd_cidade_cde' => $request->cd_cidade_cde,
                        'nm_evento_eve' => $request->nm_evento_eve,
                        'ds_fone_contato_eve' => $request->ds_fone_contato_eve,
                        'dt_realizacao_eve' => $request->dt_realizacao_eve,
                        'dt_termino_eve' => $request->dt_realizacao_eve,
                        'valor_eve' =>  $request->valor_eve,
                        'total_participantes_eve' => $request->total_participantes_eve,
                        'descricao' => $request->descricao,                           
                        'ds_imagem_vertical_eve' => null,
                        'ds_imagem_horizontal_eve' => null,
                        'fl_ativo_eve' => null,
                        'hora_inicio_eve' => $request->hora_inicio_eve,
                        'hora_fim_eve' => $request->hora_fim_eve);

        $evento = Evento::create($dados);

        if($evento){
            Flash::success('<i class="fa fa-check"></i> Evento cadastrado com sucesso');
            return redirect('guia-e-condutores/privado/eventos');
        }else{
            Flash::error("Ocorreu um erro ao cadastrar o evento. Revise os dados e tente novamente");
            return redirect('guia-e-condutores/privado/evento/novo');
        }
    }
}
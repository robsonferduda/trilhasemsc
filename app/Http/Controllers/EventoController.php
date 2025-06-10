<?php

namespace App\Http\Controllers;

use Auth;
use App\Evento;
use App\Trilheiro;
use App\Cidade;
use App\Guia;
use App\Estatistica;
use Laracasts\Flash\Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class EventoController extends Controller
{
    public function index()
    {
        $page_name = "Eventos e Trilhas em Santa Catarina";
        $eventos = Evento::where('dt_realizacao_eve','>',date('Y-m-d H:i:s'))->orderBy('dt_realizacao_eve','ASC')->get();
        $cidades = Cidade::whereIn('cd_cidade_cde', Evento::select('cd_cidade_cde')->get())->orderBy('nm_cidade_cde')->select('cd_cidade_cde', 'nm_cidade_cde')->get();

        return view('eventos/index', ['page_name' => $page_name, 'eventos' => $eventos, 'cidades' => $cidades]);
    }

    public function detalhes($id)
    {
        $evento = Evento::find($id);
        $page_name = "Eventos e Trilhas em Santa Catarina - ".$evento->nm_evento_eve;
        $cidades = Cidade::whereIn('cd_cidade_cde', Evento::select('cd_cidade_cde')->get())->orderBy('nm_cidade_cde')->select('cd_cidade_cde', 'nm_cidade_cde')->get();
        
        $dados = array('id_tipo_interacao_tin' => 5,
                       'id_guia_gui' => $id);

        $usuario_logado = (Auth::user()) ? Auth::user()->id : null;

        if($usuario_logado){
            $trilheiro = Trilheiro::where('id_user', $usuario_logado)->first();
        }else{
            $trilheiro = null;
        }

        $estatistica = array('cd_usuario_usu' => $usuario_logado,
                            'cd_tipo_monitoramento_tim' => 2,
                            'cd_monitoramento_esa' => $id);              

        Estatistica::create($estatistica);

        return view('eventos/detalhes', ['page_name' => $page_name, 'evento' => $evento, 'cidades' => $cidades, 'trilheiro' => $trilheiro]);
    }

    public function eventos()
    {
        $guia = Guia::where('id_user', Auth::user()->id)->first();
        $eventos = Evento::where('id_guia_gui', $guia->id_guia_gui)->withTrashed()->orderBy('dt_realizacao_eve')->get();

        return view('admin/eventos/listar', compact('guia','eventos'));
    }

    public function participar($id_evento)
    {
        if(Auth::user()){

            $trilheiro = Trilheiro::where('id_user', Auth::user()->id)->first();
            $evento = Evento::where('id_evento_eve', $id_evento)->first();

            $trilheiro->evento()->sync($id_evento);

            return redirect('eventos/detalhes/'.$id_evento);

        }else{
            return redirect('login');
        }
    }

    public function cadastro()
    {
        $evento = null;
        $guia = Guia::where('id_user', Auth::user()->id)->first();
        $cidades = Cidade::where('cd_estado_est', 42)->orderBy('nm_cidade_cde')->get();

        return view('admin/eventos/cadastro', compact('guia','cidades','evento'));
    }

    public function editar($id)
    {
        $guia = Guia::where('id_user', Auth::user()->id)->first();
        $cidades = Cidade::where('cd_estado_est', 42)->orderBy('nm_cidade_cde')->get();
        $evento = Evento::where('id_evento_eve', $id)->first();

        return view('admin/eventos/cadastro', compact('guia','cidades','evento'));
    }

    public function cadastrar(Request $request)
    {
        if (Auth::guest() or trim(Auth::user()->id_role) != 'GUIA') {
            return redirect('login');
        }
        
        $guia = Guia::where('id_user', Auth::user()->id)->first();

        $request->merge(['dt_realizacao_eve' => date('Y-m-d', strtotime(str_replace('/', '-', $request->dt_realizacao_eve)))]);
        $request->merge(['dt_termino_eve' => date('Y-m-d', strtotime(str_replace('/', '-', $request->dt_termino_eve)))]);

        $dados = array('id_guia_gui' => $guia->id_guia_gui,
                        'cd_cidade_cde' => $request->cd_cidade_cde,
                        'nm_evento_eve' => $request->nm_evento_eve,
                        'ds_fone_contato_eve' => $request->ds_fone_contato_eve,
                        'dt_realizacao_eve' => $request->dt_realizacao_eve,
                        'dt_termino_eve' => $request->dt_termino_eve,
                        'valor_eve' =>  $request->valor_eve,
                        'total_participantes_eve' => $request->total_participantes_eve,
                        'descricao' => $request->descricao,                           
                        'fl_ativo_eve' => null,
                        'hora_inicio_eve' => $request->hora_inicio_eve,
                        'hora_fim_eve' => $request->hora_fim_eve);

        if($request->hasFile('img_instagram')) {
            $extension = $request->file('img_instagram')->getClientOriginalExtension();
            $filename = 'instagram_'.$guia->id_guia_gui.'_'.date("YmdHis").'.' . $extension;
            $imagem = $request->img_instagram->storeAs('', $filename, 'eventos');
            $dados['ds_imagem_vertical_eve'] = $filename;
        }

        if($request->hasFile('img_evento')) {
            $extension = $request->file('img_evento')->getClientOriginalExtension();
            $filename = 'evento_'.$guia->id_guia_gui.'_'.date("YmdHis").'.' . $extension;
            $imagem = $request->img_evento->storeAs('', $filename, 'eventos');
            $dados['ds_imagem_horizontal_eve'] = $filename;
        }

        $evento = Evento::create($dados);

        if($evento){
            Flash::success('<i class="fa fa-check"></i> Evento cadastrado com sucesso');
            return redirect('guia-e-condutores/privado/eventos');
        }else{
            Flash::error("Ocorreu um erro ao cadastrar o evento. Revise os dados e tente novamente");
            return redirect('guia-e-condutores/privado/evento/novo');
        }
    }

    public function update(Request $request)
    {
        if (Auth::guest() or trim(Auth::user()->id_role) != 'GUIA') {
            return redirect('login');
        }
        
        $guia = Guia::where('id_user', Auth::user()->id)->first();
        $evento = Evento::where('id_evento_eve', $request->id_evento_eve)->first();
        $request->merge(['dt_realizacao_eve' => date('Y-m-d', strtotime(str_replace('/', '-', $request->dt_realizacao_eve)))]);
        $request->merge(['dt_termino_eve' => date('Y-m-d', strtotime(str_replace('/', '-', $request->dt_termino_eve)))]);

        $evento->cd_cidade_cde = $request->cd_cidade_cde;
        $evento->nm_evento_eve = $request->nm_evento_eve;
        $evento->ds_fone_contato_eve = $request->ds_fone_contato_eve;
        $evento->dt_realizacao_eve = $request->dt_realizacao_eve;
        $evento->dt_termino_eve = $request->dt_termino_eve;
        $evento->valor_eve =  $request->valor_eve;
        $evento->total_participantes_eve = $request->total_participantes_eve;
        $evento->descricao = $request->descricao;                           
        $evento->fl_ativo_eve = null;
        $evento->hora_inicio_eve = $request->hora_inicio_eve;
        $evento->hora_fim_eve = $request->hora_fim_eve;

        if($request->hasFile('img_instagram')) {
            $extension = $request->file('img_instagram')->getClientOriginalExtension();
            $filename = 'instagram_'.$guia->id_guia_gui.'_'.date("YmdHis").'.' . $extension;
            $imagem = $request->img_instagram->storeAs('', $filename, 'eventos');
            $evento->ds_imagem_vertical_eve = $filename;
        }

        if($request->hasFile('img_evento')) {
            $extension = $request->file('img_evento')->getClientOriginalExtension();
            $filename = 'evento_'.$guia->id_guia_gui.'_'.date("YmdHis").'.' . $extension;
            $imagem = $request->img_evento->storeAs('', $filename, 'eventos');
            $evento->ds_imagem_horizontal_eve = $filename;
        }
        
        $evento->save();

        return redirect('guia-e-condutores/privado/eventos');
    }
}
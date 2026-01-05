@extends('layouts.site')
@section('content')
@include('layouts/partes/header-eventos')
<section class="pt-1 pb-0 mt-3 mb-5">
    <div class="container">
       <div class="row mb-2">
          <div class="col-md-7">
             <h3 class="text-success">Eventos e Trilhas em Santa Catarina</h3>
          </div>
       </div>
       <div class="card card-plain card-blog ml-2 mr-2">
            <div class="row">
                <div class="col-lg-2 col-md-2 mt-2 mb-4 position-relative text-center d-xs-block d-sm-block d-md-none">
                    <h5>Guia Responsável</h5>
                    @if($evento->guia->nm_path_logo_gui)
                      <img class="avatar avatar-xxl shadow-lg rounded-circle mx-auto" src="{{ asset('img/guias/'.$evento->guia->nm_path_logo_gui) }}" alt="Logo Guia {{ $evento->guia->nm_guia_gui }}">
                    @else
                      <img class="avatar avatar-xxl shadow-lg rounded-circle mx-auto" src="{{ asset('img/guias/default.png') }}" alt="Logo Guia {{ $evento->guia->nm_guia_gui }}">
                    @endif
                </div>
                <div class="col-lg-10 col-md-10">
                    <h4>
                        <a href="" class="text-danger text-decoration-underline-none">{{ $evento->nm_evento_eve }}</a>
                    </h4>
                    <p class="mb-1"><strong>Responsável</strong>: <a href="{{ url("guia/perfil/estatistica/perfil", $evento->guia->nm_instagram_gui) }}">{{ $evento->guia->nm_guia_gui }}</a></p>
                    <p class="mb-1"><strong>Cidade</strong>: {{ $evento->local->nm_cidade_cde }}</p>
                    <p class="mb-1"><strong>Data/Horário Início</strong>: {{ \Carbon\Carbon::parse($evento->dt_realizacao_eve)->format('d/m/Y')}} - {{ \Carbon\Carbon::parse($evento->hora_inicio_eve)->format('H:i') }}</p>
                    <p class="mb-1"><strong>Data/Horário Término</strong>: {{ \Carbon\Carbon::parse($evento->dt_termino_eve)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($evento->hora_fim_eve)->format('H:i') }}</p>
                    <p class="mb-1"><strong>Valor</strong>: {!! ($evento->valor_eve) ? "R$ ".$evento->valor_eve : '<strong class="text-success">Gratuita</strong>' !!}</p>
                    <p class="mb-1"><strong>Contato</strong>: {{ $evento->ds_fone_contato_eve }}</p>
                </div>

                <div class="col-lg-2 col-md-2 position-relative text-center d-none d-md-block">
                    <h5>Guia Responsável</h5>
                    @if($evento->guia->nm_path_logo_gui)
                      <img class="avatar avatar-xxl shadow-lg rounded-circle mx-auto" src="{{ asset('img/guias/'.$evento->guia->nm_path_logo_gui) }}" alt="Logo Guia {{ $evento->guia->nm_guia_gui }}">
                    @else
                      <img class="avatar avatar-xxl shadow-lg rounded-circle mx-auto" src="{{ asset('img/guias/default.png') }}" alt="Logo Guia {{ $evento->guia->nm_guia_gui }}">
                    @endif
                </div>
                <div class="col-lg-12 col-md-12">
                    <p>
                        <strong>Detalhes</strong>: {!! nl2br($evento->descricao) !!}
                    </p>
                </div>
                <div class="col-lg-12 col-md-12">
                    @if($evento->ds_imagem_horizontal_eve)
                        <img src="{{ asset('img/eventos/'.$evento->ds_imagem_horizontal_eve) }}" alt="img-blur-shadow" class="img-fluid shadow border-radius-lg">
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 mt-4 text-center">
            @if(Auth::user())
                @if(trim(Auth::user()->id_role) == 'GUIA')
                    <a href="{{ url('guia-e-condutores/privado/eventos') }}" type="button" class="btn btn-outline-danger btn-sm">Meus Eventos</a>
                @endif
            @endif
            @if(Auth::user() and $trilheiro)
                @if($trilheiro->evento->contains($evento->id_evento_eve))
                    <button type="button" class="btn btn-outline-success btn-sm"><i class="fa fa-check"></i> Presença Confirmada</button>
                    <a href="{{ url('trilheiro/privado/eventos/cancelar/'.$evento->id_evento_eve) }}" type="button" class="btn btn-outline-danger btn-sm" onclick="return confirm('Tem certeza que deseja cancelar sua participação neste evento?')"><i class="fa fa-times"></i> Cancelar Participação</a>
                @else
                    <a href="{{ url('trilheiro/privado/eventos/participar/'.$evento->id_evento_eve) }}" type="button" class="btn btn-outline-primary btn-sm"><i class="fa fa-check"></i> Participar do Evento</a>
                @endif
            @else
                <a href="{{ url('trilheiro/privado/eventos/participar/'.$evento->id_evento_eve) }}" type="button" class="btn btn-outline-primary btn-sm"><i class="fa fa-check"></i> Participar do Evento</a>
            @endif
            <a href="{{ url('eventos') }}" type="button" class="btn btn-outline-info btn-sm">Todos os Eventos</a>
            <a href="{{ url('/') }}" type="button" class="btn btn-outline-warning btn-sm">Início</a>
        </div>
    </div>
 </section>
@endsection
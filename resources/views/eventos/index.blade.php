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
       <div class="row">
            @forelse($eventos as $key => $evento)
                <div class="row mb-1">
                    <div class="col-lg-2 col-md-2 mt-2 mb-4 position-relative text-center d-xs-block d-sm-block d-md-none">
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
                        <p class="mb-1"><strong>Valor</strong>: R$ {{ $evento->valor_eve }}</p>
                        <p class="mb-1"><strong>Contato</strong>: {{ $evento->local->nm_cidade_cde }}</p>
                    </div>
                    <div class="col-lg-2 col-md-2 position-relative text-center d-none d-md-block">
                        @if($evento->guia->nm_path_logo_gui)
                        <img class="avatar avatar-xxl shadow-lg rounded-circle mx-auto" src="{{ asset('img/guias/'.$evento->guia->nm_path_logo_gui) }}" alt="Logo Guia {{ $evento->guia->nm_guia_gui }}">
                        @else
                        <img class="avatar avatar-xxl shadow-lg rounded-circle mx-auto" src="{{ asset('img/guias/default.png') }}" alt="Logo Guia {{ $evento->guia->nm_guia_gui }}">
                        @endif
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <!--
                        <p>
                            <strong>Detalhes</strong>: {!! nl2br($evento->descricao) !!}
                        </p>
                    -->
                        <div class="center">
                            <a href="{{ url('eventos/detalhes', $evento->id_evento_eve) }}" type="button" class="btn btn-outline-info btn-sm">Ver Detalhes</a>
                        </div>
                    </div>
                </div>  
                @if($key < count($eventos)-1)  
                    <hr class="mb-4"/>      
                @endif
            @empty
                <h6 class="center">Nenhum evento disponível no momento. Aguarde por mais aventuras!</h6>
            @endforelse
            <div class="col-lg-12 col-md-12 mt-4 text-center">
                <a href="{{ url('/') }}" type="button" class="btn btn-outline-warning btn-sm">Voltar ao Início</a>
            </div>
       </div>
    </div>
 </section>
@endsection
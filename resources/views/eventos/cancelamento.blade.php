@extends('layouts.site')
@section('content')
@include('layouts/partes/header-eventos')
<section class="pt-1 pb-0 mt-3 mb-5">
    <div class="container">
       <div class="row mb-2">
          <div class="col-md-12 text-center">
             <h3 class="text-danger">
                <i class="fa fa-times-circle"></i> Participação Cancelada com Sucesso!
             </h3>
          </div>
       </div>

       <!-- Mensagem de Cancelamento -->
       <div class="row mb-4">
          <div class="col-md-12">
             <div class="alert text-center" role="alert" style="border: 2px solid #dc3545; background-color: transparent;">
                <h5 class="alert-heading text-danger">Sua participação foi cancelada!</h5>
                <hr>
                <p class="mb-0">
                   Sua inscrição no evento foi removida do sistema. Você pode se inscrever novamente 
                   a qualquer momento, caso mude de ideia.
                </p>
             </div>
          </div>
       </div>

       <!-- Dados do Evento -->
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
                        <a href="{{ url('eventos/detalhes/'.$evento->id_evento_eve) }}" class="text-danger text-decoration-underline-none">{{ $evento->nm_evento_eve }}</a>
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
                
                @if($evento->ds_imagem_horizontal_eve)
                <div class="col-lg-12 col-md-12 mt-3">
                    <img src="{{ asset('img/eventos/'.$evento->ds_imagem_horizontal_eve) }}" alt="img-blur-shadow" class="img-fluid shadow border-radius-lg">
                </div>
                @endif
            </div>
        </div>

        <!-- Botões de Ação -->
        <div class="col-lg-12 col-md-12 mt-4 text-center">
            <a href="{{ url('eventos/detalhes/'.$evento->id_evento_eve) }}" type="button" class="btn btn-outline-primary btn-sm">
                <i class="fa fa-info-circle"></i> Ver Detalhes Completos
            </a>
            <a href="{{ url('eventos') }}" type="button" class="btn btn-outline-info btn-sm">
                <i class="fa fa-calendar"></i> Todos os Eventos
            </a>
            <a href="{{ url('/') }}" type="button" class="btn btn-outline-warning btn-sm">
                <i class="fa fa-home"></i> Início
            </a>
        </div>
    </div>
 </section>
@endsection

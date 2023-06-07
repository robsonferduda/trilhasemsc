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
            @foreach($eventos as $key => $evento)
                <div class="card card-plain card-blog">
                    <div class="row">
                        <div class="col-lg-3 col-md-3">
                            <div class="card-image position-relative border-radius-lg">
                                <a href=""><img class="img border-radius-lg" src="{{ asset('img/eventos/'.$evento->id_evento_eve.'.png') }}" alt=""></a>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9">
                            <h4>
                                <a href="{{ url('eventos/detalhes', $evento->id_evento_eve) }}" class="text-success text-decoration-underline-none">{{ $evento->nm_evento_eve }}</a>
                            </h4>
                            <p><strong>Responsável</strong>: <a href="{{ url("guia/perfil/estatistica/perfil", $evento->id_guia_gui) }}">{{ $evento->guia->nm_guia_gui }}</a></p>
                            <p><strong>Cidade</strong>: {{ $evento->local->nm_cidade_cde }}</p>
                            <p><strong>Data/Horário</strong>: {{ \Carbon\Carbon::parse($evento->dt_realizacao_eve)->format('d/m/Y H:i:s')}}</p>
                            <p><strong>Horário Término</strong>: {{ \Carbon\Carbon::parse($evento->dt_termino_eve)->format('H:i') }}</p>
                            <p><strong>Valor</strong>: R$ {{ $evento->valor_eve }}</p>
                            <p><strong>Contato</strong>: {{ $evento->local->nm_cidade_cde }}</p>
                        </div>
                    </div>
                </div>            
            @endforeach
            <div class="col-lg-12 col-md-12 mt-4 text-center">
                <a href="{{ url('/') }}" type="button" class="btn btn-outline-warning btn-sm">Voltar ao Início</a>
            </div>
       </div>
    </div>
 </section>
@endsection
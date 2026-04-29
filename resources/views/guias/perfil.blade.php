@extends('layouts.site')
@section('content')
@include('layouts/partes/header-condutores-perfil')
<section class="pt-1 pb-0 mt-3 mb-5">
    <div class="container">
       <div class="row mb-2">
          <div class="col-md-7">
             <h3 class="text-info">Mais Informações</h3>
          </div>
       </div>
       <div class="row">
         <div class="col-md-12">
            <h4>{{ $guia->nm_guia_gui }}</h4>
            <p><i class="fa fa-instagram"></i> <a href="{{ url("guia/perfil/estatistica/instagram", $guia->nm_instagram_gui) }}">{{ $guia->nm_instagram_gui }}</a></p>
            @if($guia->nu_cadastur_gui)
               <p><strong>Cadastur</strong>: {{ $guia->nu_cadastur_gui }} </p>
            @endif
            @if(count($guia->unidadesConservacao) > 0)
               <p><strong>Unidades de Conservação</strong>: {{ count($guia->unidadesConservacao) > 0 ? implode(', ',$guia->unidadesConservacao->pluck('nome_unc')->toArray()) : ''}}</p>
            @endif
            <p><strong>Cidades de Atuação</strong>: {{ count($guia->cidadesAtuacao) > 0 ? implode(', ',$guia->cidadesAtuacao->pluck('nm_cidade_cde')->toArray()) : $guia->ds_atuacao_gui }}</p>
            <p>
                {{ $guia->dc_biografia_gui }}
            </p>
         </div>

         @if(isset($eventos_futuros) && $eventos_futuros->count() > 0)
         <div class="row mt-4 mb-2">
            <div class="col-md-12">
               <h3 class="text-info"><i class="fa fa-calendar" aria-hidden="true"></i> Agenda</h3>
               <hr>
            </div>
            @foreach($eventos_futuros as $evento)
            <div class="col-md-12 mb-3">
               <div class="card border-info h-100">
                  @if($evento->ds_imagem_horizontal_eve)
                  <img class="card-img-top" src="{{ asset('storage/eventos/'.$evento->ds_imagem_horizontal_eve) }}" alt="{{ $evento->nm_evento_eve }}" style="max-height:160px; object-fit:cover;">
                  @endif
                  <div class="card-body">
                     <h5 class="card-title">{{ $evento->nm_evento_eve }}</h5>
                     <p class="card-text text-muted mb-1">
                        <i class="fa fa-calendar-o" aria-hidden="true"></i>
                        <strong>{{ \Carbon\Carbon::parse($evento->dt_realizacao_eve)->format('d/m/Y') }}</strong>
                        @if($evento->hora_inicio_eve)
                           &nbsp;<i class="fa fa-clock-o" aria-hidden="true"></i> {{ substr($evento->hora_inicio_eve, 0, 5) }}
                           @if($evento->hora_fim_eve)
                              &nbsp;às {{ substr($evento->hora_fim_eve, 0, 5) }}
                           @endif
                        @endif
                     </p>
                     @if($evento->dt_termino_eve && $evento->dt_termino_eve != $evento->dt_realizacao_eve)
                     <p class="card-text text-muted mb-1">
                        <i class="fa fa-calendar-check-o" aria-hidden="true"></i> Término: {{ \Carbon\Carbon::parse($evento->dt_termino_eve)->format('d/m/Y') }}
                     </p>
                     @endif
                     @if($evento->valor_eve)
                     <p class="card-text mb-1">
                        <i class="fa fa-ticket" aria-hidden="true"></i>
                        @if($evento->valor_eve > 0)
                           R$ {{ number_format($evento->valor_eve, 2, ',', '.') }}
                        @else
                           <span class="text-success">Gratuito</span>
                        @endif
                     </p>
                     @endif
                  </div>
                  <div class="card-footer bg-transparent border-0">
                     <a href="{{ route('evento.detalhes', $evento->slug_eve) }}" class="btn btn-outline-info btn-sm">
                        <i class="fa fa-info-circle" aria-hidden="true"></i> Ver Detalhes
                     </a>
                  </div>
               </div>
            </div>
            @endforeach
         </div>
         @endif

         <div class="col-md-12 mb-3 mt-3">
            <div class="row">
               @forelse ($guia->unidadesConservacao as $key => $uc)
                  <div class="col col-xl-2 col-md-2 mb-3 mt-3 center">
                     <p class="center"><strong>{{ Str::upper($uc->sigla_unc) }}</strong></p>
                     <img class="img-fluid w-75" src=" {{ asset('img/logos-uc/'.$uc->logo_unc) }}" alt="Logo {{ $uc->nome_uc }}">
                  </div>
               @empty
               
               @endforelse
            </div>
         </div>
         <div class="col-md-12 mt-2 center">
            <a class="btn btn-success" href="{{ url("guia/perfil/estatistica/telefone", $guia->nm_instagram_gui) }}"><i class="fa fa-whatsapp" aria-hidden="true"></i> Enviar Mensagem</a>
            <a class="btn btn-primary mr-2 ml-3" href="{{ url("guias-e-condutores") }}"><i class="fa fa-users" aria-hidden="true"></i> Todos os Guias</a>
         </div> 
         @include('layouts/partes/publicidade-google')

         
         
       </div>
    </div>
 </section>
@endsection
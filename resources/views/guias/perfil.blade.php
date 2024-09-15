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
         <div class="col-md-12 mb-3 mt-3">
            <div class="row">
               @forelse ($guia->unidadesConservacao as $key => $uc)
                  <div class="col col-xl-2 col-md-2 mb-3 mt-3">
                     <p class="center">{{ Str::upper($uc->sigla_unc) }}</p>
                     <img class="img-fluid" src=" {{ asset('img/logos-uc/'.$uc->logo_unc) }}" alt="Logo {{ $uc->nome_uc }}">
                  </div>
               @empty
               
               @endforelse
            </div>
         </div>
         <div class="col-md-12 mt-2">
            <a class="btn btn-success" href="{{ url("guia/perfil/estatistica/telefone", $guia->nm_instagram_gui) }}"><i class="fa fa-whatsapp" aria-hidden="true"></i> Enviar Mensagem</a>
            <a class="btn btn-primary mr-2 ml-3" href="{{ url("guias-e-condutores") }}"><i class="fa fa-users" aria-hidden="true"></i> Todos os Guias</a>
         </div> 
         @include('layouts/partes/publicidade-google')         
       </div>
    </div>
 </section>
@endsection
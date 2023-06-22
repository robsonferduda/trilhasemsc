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
            <p><i class="fa fa-instagram"></i> <a href="{{ url("guia/perfil/estatistica/instagram", $guia->id_guia_gui) }}">{{ $guia->nm_instagram_gui }}</a></p>
            @if($guia->nu_cadastur_gui)
               <p><strong>Cadastur</strong>: {{ $guia->nu_cadastur_gui }} </p>
            @endif
            <p><strong>Cidades de Atuação</strong>: {{ count($guia->cidadesAtuacao) > 0 ? implode(', ',$guia->cidadesAtuacao->pluck('nm_cidade_cde')->toArray()) : $guia->ds_atuacao_gui }}</p>
            <p>
                {{ $guia->dc_biografia_gui }}
            </p>
         </div>
         <div class="col-md-12 mt-2">
            <a class="btn btn-success" href="{{ url("guia/perfil/estatistica/telefone", $guia->id_guia_gui) }}"><i class="fa fa-whatsapp" aria-hidden="true"></i> Enviar Mensagem</a>
            <a class="btn btn-primary mr-2 ml-3" href="{{ url("guias-e-condutores") }}"><i class="fa fa-users" aria-hidden="true"></i> Todos os Guias</a>
         </div>          
       </div>
    </div>
 </section>
@endsection
@extends('layouts.site')
@section('content')
    @include('layouts/partes/header-uc')
    <div class="container">
        <div class="row mb-2 mt-3">
            <div class="col-md-12">
               <h3 class="text-info">Unidades de Conservação</h3>
               <p>Listagens das Unidades de Conservação municipais, estaduais e federais em Santa Catarina.</p>
            </div>
         </div>
        <div class="row">
            @foreach($unidades as $key => $unidade)

            <div class="col-lg-3 col-md-3  mb-5">
                <div class="card card-profile" style="min-height: 450px;">
                  
                  <div class="card-body justify-content-center text-center">
                    <a href="{{ url("unidades-de-conservacao/detalhes", $unidade->id_unidade_conservacao_unc) }}">
                        <img class="card-image mx-auto w-100" src="{{ asset('img/logos-uc/'.$unidade->logo_unc) }}">
                    </a>
                    <h6 class="mb-0 mt-2">{{ $unidade->nome_unc }}</h6>
                    <p>{{ ($unidade) ? $unidade->instancia->nm_unidade_conservacao_instancia_uci : 'Santa Catarina' }}</p>
                  </div>
                </div>
              </div>           
            @endforeach
            <div class="col-lg-12 col-md-12 mt-4">
                <a href="{{ url('/') }}" type="button" class="btn btn-outline-warning btn-sm">Voltar ao Início</a>
            </div>
        </div>
     </div>
@endsection
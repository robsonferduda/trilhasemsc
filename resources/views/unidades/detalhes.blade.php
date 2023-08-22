@extends('layouts.site')
@section('content')
    @include('layouts/partes/header-uc')
    <div class="container">
        <div class="row mb-2 mt-3">
            <div class="col-md-12">
               <h3 class="text-info">Unidades de Conservação</h3>
            </div>
         </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 mt-4">
                <div class="row">
                    <div class="col-lg-3 justify-content-center d-flex flex-column">
                        <div class="card">
                            <img src="{{ asset('img/logos-uc/'.$unidade->logo_unc) }}" alt="img-blur-shadow-blog-2" class="img-fluid border-radius-lg">
                        </div>
                    </div>
                    <div class="col-lg-9 d-flex flex-column pl-lg-5 pt-lg-0 pt-3">
                        <h4 class="card-title">{{ $unidade->nome_unc }}</h4>
                        <h6 class="category text-primary">{{ ($unidade) ? $unidade->instancia->nm_unidade_conservacao_instancia_uci : 'Santa Catarina' }}</h6>
                        <div class="card-description">
                            {!! $unidade->descricao_unc !!}
                        </div>
                    </div>
                </div>
            </div>            
            <div class="col-lg-12 col-md-12 mt-4">
                <a href="{{ url('unidades-de-conservacao') }}" type="button" class="btn btn-outline-info btn-sm">Todas as Unidades</a>
            </div>
        </div>
     </div>
@endsection
@extends('layouts.template')

@section('content')
    <div class="block-header">
        <div class="row">
            <div class="col-lg-5 col-md-8 col-sm-12">
                <h2>Guias e Condutores</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><i class="fa fa-id-card"></i> Guias e Condutores</li>
                    <li class="breadcrumb-item">Eventos</li>
                    <li class="breadcrumb-item">Listar Eventos</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12">
            <div class="card planned_task">
                <div class="header no-padding-bottom">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <h2>Listagem de Eventos</h2>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <a href="{{ url('guia-e-condutores/privado/evento/novo') }}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Novo Evento</a>
                        </div> 
                    </div>
                </div>
                
                <div class="body">
                    @include('layouts.mensagens')
                    
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(function() {
            
        });
    </script>
@endsection
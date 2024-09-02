@extends('layouts.template')
@section('content')
    <div class="block-header">
        <div class="row">
            <div class="col-lg-5 col-md-8 col-sm-12">
                <h2>Trilheiros</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><i class="fa fa-map"></i> Trilheiros</li>
                    <li class="breadcrumb-item">Atualizar Cadastro</li>
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
                            <h2>Dados do Trilheiro</h2>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 text-right">
                            <h2><a href="{{ url('/trilheiro/privado/atualizar-cadastro') }}"><i class="fa fa-edit"></i> Editar Dados</a></h2>
                        </div>
                    </div>
                </div>
               
                <div class="body">
                    @include('layouts.mensagens')
                    <div class="col-lg-3 col-md-3">
                        <div class="card profile-header">
                            <div class="body">
                                <div class="profile-image center mb-4">
                                    @switch(trim(Auth::user()->id_role))
                                        @case('GUIA')
                                            <img src="{{ Auth::user()->dc_foto_perfil ? asset('img/guias/'.Auth::user()->dc_foto_perfil) : asset('images/user.png') }}" class="rounded-circle w-50 " alt="Foto de Perfil">
                                            @break
                                        @case('TRILHEIRO')
                                            <img src="{{ Auth::user()->dc_foto_perfil ? asset('img/trilheiros/'.Auth::user()->dc_foto_perfil) : asset('images/user.png') }}" class="rounded-circle w-50" alt="Foto de Perfil">
                                            @break
                                        @default
                                            <img src="{{ asset('images/user.png') }}" class="rounded-circle o" alt="Foto de Perfil">
                                    @endswitch
                                </div>
                                <div class="center">
                                    <h5 class="m-b-0">{{ $trilheiro->nm_trilheiro_tri }}</h5>
                                    <span>{{ ($trilheiro->origem) ? $trilheiro->origem->nm_cidade_cde : '' }}</span>
                                </div>                       
                            </div>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(function() {
            $('#form-guia').parsley();

            $('.phone').mask('(99) 999-999999');

            var drEvent = $('#dropify-event').dropify();

            drEvent.on('dropify.afterClear', function(event, element) {
                $('#imagem_deletada').val(true);
            });
        });
    </script>
@endsection
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
                        <div class="col col-lg-6 col-md-6 col-sm-4">
                            <h2>Dados do Trilheiro</h2>
                        </div>
                        <div class="col col-lg-6 col-md-6 col-sm-4 text-right">
                            <h2><a href="{{ url('/trilheiro/privado/atualizar-cadastro') }}"><i class="fa fa-edit"></i> Editar Dados</a></h2>
                        </div>
                    </div>
                </div>               
                <div class="body">
                    @include('layouts.mensagens')
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-12">
                            <div class="card profile-header">
                                <div class="body">
                                    <div class="profile-image center mb-4">
                                        @switch(trim(Auth::user()->id_role))
                                            @case('ADMIN')
                                                <img src="{{ $trilheiro->nm_path_foto_tri ? asset('img/trilheiros/'.$trilheiro->nm_path_foto_tri) : asset('images/user.png') }}" class="rounded-circle w-50 " alt="Foto de Perfil">
                                                @break
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
                                        <h2 class="mb-0">{{ $trilheiro->nr_score_tri }}</h2>
                                        @if(!$trilheiro->nr_score_tri)
                                            <p class="mb-0"><a href="{{ url('trilheiro/privado/meu-nivel') }}">Clique para calcular</a></p>
                                        @endif
                                        <span>{{ $trilheiro->indice->ds_indice_ind }}</span>
                                        <img src="{{ asset('img/nivel/'.$trilheiro->indice->img_indice_ind) }}" class="w-100" alt="Índice de Experiência em Trilhas">
                                        <strong>Índice de Experiência em Trilhas</strong>
                                        @if($trilheiro->nr_score_tri)
                                            <p class="mt-2 mb-2"><a href="{{ url('trilheiro/privado/meu-nivel') }}">Atualizar Índice</a></p>
                                        @endif
                                        <p class="mt-0 mb-0 text-danger"><a href="{{ url('indice-experiencia-trilhas') }}" class="text-danger" target="BLANK">Entenda o Índice</a></p>
                                    </div>                       
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9">
                            <div class="card profile-header">
                                <div class="body">
                                    <div class="d-none d-md-block">
                                        @if($trilheiro->nu_pontos_experiencia_tri)
                                            <h6 class="mb-2"><i class="fa fa-star text-warning" aria-hidden="true"></i> <strong>{{ $trilheiro->nu_pontos_experiencia_tri }}</strong> Pontos de Experiência</h6>
                                        @else
                                            <p class="mb-2"><i class="fa fa-star" aria-hidden="true"></i> Você não possui nenhum ponto por experiência em trilhas.</p>
                                        @endif
                                        <p class="mt-2"><a href="{{ url('trilheiro/privado/trilhas') }}" style="position: absolute; right: 10px; top: 15px;">Clique aqui para selecionar suas trilhas</a></p>
                                    </div>
                                    <div class="d-block center d-md-none">
                                        @if($trilheiro->nu_pontos_experiencia_tri)
                                            <h6 class="mb-2"><i class="fa fa-star text-warning" aria-hidden="true"></i> <strong>{{ $trilheiro->nu_pontos_experiencia_tri }}</strong> Pontos de Experiência</h6>
                                        @else
                                            <p class="mb-2"><i class="fa fa-star" aria-hidden="true"></i> Você não possui nenhum ponto por experiência em trilhas.</p>
                                        @endif
                                        <p class="mt-2 center"><a href="{{ url('trilheiro/privado/trilhas') }}">Clique aqui para selecionar suas trilhas</a></p>
                                    </div>
                                    @foreach($trilheiro->trilhas as $key => $trilha)
                                        <div class="row mb-3 mt-3">
                                            <div class="col-lg-1 col-md-1 mr-0 ml-0 px-2 d-none d-sm-none d-md-block">
                                                <img class="img-fluid mt-2" src="{{ asset('img/trilhas/nivel/'.$trilha->nivel->dc_icone_niv) }}" alt="Grau de dificuldade da trilha {{ $trilha->nivel->dc_nivel_niv }}">
                                            </div>
                                            <div class="col-lg-9 col-md-9 d-none d-md-block">
                                                <h6>{{ $trilha->nm_trilha_tri }}</h6>
                                                <p>{{ $trilha->nivel->dc_nivel_niv }} - {{ $trilha->complemento->nm_complemento_nivel_con }} </p>
                                            </div>
                                            <div class="col-lg-2 col-md-2 d-none d-md-block">
                                                <h5 class="float-right mt-2">+{{ $trilha->complemento->nu_pontos_con }}</h5>
                                            </div>

                                            <div class="col-sm-12 mr-0 ml-0 px-2 d-block d-md-none center">
                                                <img class="img-fluid mt-2 w-50" src="{{ asset('img/trilhas/nivel/'.$trilha->nivel->dc_icone_niv) }}" alt="Grau de dificuldade da trilha {{ $trilha->nivel->dc_nivel_niv }}">
                                            </div>
                                            <div class="col-sm-12 d-block d-md-none center mb-0">
                                                <h6 class="mt-2">{{ $trilha->nm_trilha_tri }}</h6>
                                                <p class="mb-0">{{ $trilha->nivel->dc_nivel_niv }} - {{ $trilha->complemento->nm_complemento_nivel_con }} </p>
                                            </div>
                                            <div class="col-sm-12 col-md-2 mt-0 d-block d-md-none center">
                                                <h6 class="center mt-0">+{{ $trilha->complemento->nu_pontos_con }}</h6>
                                            </div>
                                        </div>
                                    @endforeach
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
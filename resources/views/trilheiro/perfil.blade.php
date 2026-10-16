@extends('layouts.admin')
@section('content')
@php
    $ehDono = Auth::user() && (int) $trilheiro->id_user === (int) Auth::user()->id;
    $ehAdmin = Auth::user() && trim(Auth::user()->id_role) === 'ADMIN';
@endphp
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
                        <div class="col col-lg-6 col-md-6 col-sm-12 perfil-acoes">
                            @if($ehDono)
                                <a href="{{ url('trilheiro/privado/atualizar-cadastro') }}" class="btn btn-primary"><i class="fa fa-edit"></i> Editar dados</a>
                            @elseif($ehAdmin)
                                <a href="{{ url('admin/trilheiros/listar') }}" class="btn btn-default">Voltar</a>
                                <a href="{{ route('admin.trilheiro.questionario', $trilheiro->id_trilheiro_tri) }}" class="btn btn-primary"><i class="fa fa-clipboard"></i> Questionário</a>
                            @endif
                        </div>
                    </div>
                </div>               
                <div class="body">
                    @include('layouts.mensagens')
                    @if($ehDono && $trilheiro && !$trilheiro->perfilBasicoCompleto())
                        <div class="alert alert-warning">
                            <i class="fa fa-exclamation-triangle"></i>
                            Seu cadastro está incompleto.
                            <a href="{{ url('trilheiro/privado/atualizar-cadastro') }}" class="alert-link">Complete seus dados</a>
                            para continuar.
                        </div>
                    @elseif($ehDono && $trilheiro && !$trilheiro->possuiScore())
                        <div class="alert alert-info">
                            <i class="fa fa-tachometer"></i>
                            Você ainda não calculou seu Índice de Experiência em Trilhas.
                            <a href="{{ url('trilheiro/privado/meu-nivel') }}" class="alert-link">Responder questionário agora</a>
                            (leva poucos minutos).
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-12">
                            <div class="pa-perfil-identidade">
                                @switch(trim(Auth::user()->id_role))
                                    @case('ADMIN')
                                        <img src="{{ $trilheiro->nm_path_foto_tri ? asset('img/trilheiros/'.$trilheiro->nm_path_foto_tri).'?v='.(@filemtime(public_path('img/trilheiros/'.$trilheiro->nm_path_foto_tri)) ?: time()) : asset('images/user.png') }}" class="rounded-circle pa-perfil-foto" alt="Foto de {{ $trilheiro->nm_trilheiro_tri }}">
                                        @break
                                    @case('GUIA')
                                        <img src="{{ Auth::user()->dc_foto_perfil ? asset('img/guias/'.Auth::user()->dc_foto_perfil).'?v='.(@filemtime(public_path('img/guias/'.Auth::user()->dc_foto_perfil)) ?: time()) : asset('images/user.png') }}" class="rounded-circle pa-perfil-foto" alt="Foto de {{ $trilheiro->nm_trilheiro_tri }}">
                                        @break
                                    @case('TRILHEIRO')
                                        <img src="{{ Auth::user()->dc_foto_perfil ? asset('img/trilheiros/'.Auth::user()->dc_foto_perfil).'?v='.(@filemtime(public_path('img/trilheiros/'.Auth::user()->dc_foto_perfil)) ?: time()) : asset('images/user.png') }}" class="rounded-circle pa-perfil-foto" alt="Foto de {{ $trilheiro->nm_trilheiro_tri }}">
                                        @break
                                    @default
                                        <img src="{{ asset('images/user.png') }}" class="rounded-circle pa-perfil-foto" alt="Foto de perfil">
                                @endswitch
                                <h3 class="pa-perfil-nome">{{ $trilheiro->nm_trilheiro_tri }}</h3>
                                @if($trilheiro->origem)
                                    <p class="pa-perfil-cidade">{{ $trilheiro->origem->nm_cidade_cde }}</p>
                                @endif
                                <p class="pa-perfil-score">{{ $trilheiro->nr_score_tri ?: '—' }}</p>
                                @if($ehDono && !$trilheiro->nr_score_tri)
                                    <a class="pa-perfil-calcular" href="{{ url('trilheiro/privado/meu-nivel') }}">Clique para calcular</a>
                                @endif
                                @if($trilheiro->indice)
                                    <p class="pa-perfil-nivel">{{ $trilheiro->indice->ds_indice_ind }}</p>
                                    <figure class="pa-perfil-iet">
                                        <img src="{{ asset('img/nivel/'.$trilheiro->indice->img_indice_ind) }}" class="pa-perfil-indice" alt="">
                                        <figcaption>Índice de Experiência em Trilhas</figcaption>
                                    </figure>
                                @endif
                                <div class="pa-perfil-links">
                                    @if($ehDono && $trilheiro->nr_score_tri)
                                        <a class="btn btn-primary btn-sm" href="{{ url('trilheiro/privado/meu-nivel') }}">Atualizar Índice</a>
                                    @endif
                                    <a class="btn btn-default btn-sm" href="{{ url('indice-experiencia-trilhas') }}" target="_blank" rel="noopener">Entenda o Índice</a>
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
                                        @if($ehDono)
                                            <p class="mt-2 mb-3"><a href="{{ url('trilheiro/privado/trilhas') }}">Selecionar trilhas</a></p>
                                        @endif
                                    </div>
                                    <div class="d-block center d-md-none">
                                        @if($trilheiro->nu_pontos_experiencia_tri)
                                            <h6 class="mb-2"><i class="fa fa-star text-warning" aria-hidden="true"></i> <strong>{{ $trilheiro->nu_pontos_experiencia_tri }}</strong> Pontos de Experiência</h6>
                                        @else
                                            <p class="mb-2"><i class="fa fa-star" aria-hidden="true"></i> Você não possui nenhum ponto por experiência em trilhas.</p>
                                        @endif
                                        @if($ehDono)
                                            <p class="mt-2 center"><a href="{{ url('trilheiro/privado/trilhas') }}">Selecionar trilhas</a></p>
                                        @endif
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
            if ($.fn.parsley && $('#form-guia').length) {
                $('#form-guia').parsley();
            }

            if ($.fn.mask) {
                $('.phone').mask('(99) 999-999999');
            }

            if ($.fn.dropify && $('#dropify-event').length) {
                $('#dropify-event').dropify().on('dropify.afterClear', function() {
                    $('#imagem_deletada').val(true);
                });
            }
        });
    </script>
@endsection
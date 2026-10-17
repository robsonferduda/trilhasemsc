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
                        <div class="col-12 col-lg-3 col-md-3">
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
                        <div class="col-12 col-lg-9 col-md-9">
                            <div class="card profile-header">
                                <div class="body">
                                    <div class="pa-xp">
                                        <div class="pa-xp-topo">
                                            @if($trilheiro->nu_pontos_experiencia_tri)
                                                <div class="pa-xp-total">
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <div>
                                                        <strong>{{ $trilheiro->nu_pontos_experiencia_tri }}</strong>
                                                        <span>Pontos de Experiência</span>
                                                    </div>
                                                </div>
                                            @else
                                                <p class="pa-xp-vazio"><i class="fa fa-star" aria-hidden="true"></i> Você não possui nenhum ponto por experiência em trilhas.</p>
                                            @endif
                                            @if($ehDono)
                                                <a class="btn btn-primary btn-sm" href="{{ url('trilheiro/privado/trilhas') }}">Selecionar trilhas</a>
                                            @endif
                                        </div>
                                        @if($trilheiro->trilhas->count())
                                            <div class="pa-xp-lista">
                                                @foreach($trilheiro->trilhas as $trilha)
                                                    <article class="pa-xp-item">
                                                        <img class="pa-xp-icone" src="{{ asset('img/trilhas/nivel/'.$trilha->nivel->dc_icone_niv) }}" alt="Grau de dificuldade da trilha {{ $trilha->nivel->dc_nivel_niv }}">
                                                        <div class="pa-xp-texto">
                                                            <strong>{{ $trilha->nm_trilha_tri }}</strong>
                                                            <span>
                                                                @if($trilha->nivel->dc_color_nivel_niv)
                                                                    <i class="pa-xp-dot" style="background: {{ $trilha->nivel->dc_color_nivel_niv }}"></i>
                                                                @endif
                                                                {{ $trilha->nivel->dc_nivel_niv }}
                                                                @if($trilha->complemento->nm_complemento_nivel_con)
                                                                    <em>{{ $trilha->complemento->nm_complemento_nivel_con }}</em>
                                                                @endif
                                                            </span>
                                                        </div>
                                                        <span class="pa-xp-pontos">+{{ $trilha->complemento->nu_pontos_con }}</span>
                                                    </article>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
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
@extends('layouts.template')

@section('content')
    <div class="block-header">
        <div class="row">
            <div class="col-lg-5 col-md-8 col-sm-12">
                <h2>Guias e Condutores</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><i class="fa fa-id-card"></i> Guias e Condutores</li>
                    <li class="breadcrumb-item">Eventos</li>
                    <li class="breadcrumb-item">Participantes</li>
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
                            <h2><i class="fa fa-tags"></i> Meus Eventos</h2>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <a href="{{ url('guia-e-condutores/privado/eventos') }}" class="btn btn-primary pull-right"><i class="fa fa-list"></i> Meus Eventos</a>
                        </div> 
                    </div>
                </div>
                
                <div class="body mt-0 pt-0">
                    @include('layouts.mensagens')

                    @forelse($evento->trilheiros as $key => $trilheiro)
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="card">
                                <div class="row p-3">
                                    <div class="col-lg-1 col-md-2 col-sm-12">
                                        <a href="{{ url('admin/trilheiro/perfil/'.$trilheiro->id_trilheiro_tri) }}"><img src="{{ $trilheiro->nm_path_foto_tri ? asset('img/trilheiros/'.$trilheiro->nm_path_foto_tri) : asset('images/user.png') }}" class="rounded-circle user-photo w-100" alt="Foto de Perfil"></a>
                                        <p class="mb-2 text-center mt-2 mb-0"><i class="fa fa-star text-warning" aria-hidden="true"></i> <strong>{{ $trilheiro->nu_pontos_experiencia_tri }}</strong> XP</p>
                                    </div>
                                    <div class="col-lg-10 col-md-8 col-sm-12">
                                        <div class="row">
                                            <div class="col-lg-9 col-md-9 col-sm-12">
                                                <div class="text" style="font-size: 16px;">{{ $trilheiro->nm_trilheiro_tri }}</div>
                                                <p class="mt-2 mb-2"><strong>Cidade de Origem</strong>: {!! ($trilheiro->origem) ? $trilheiro->origem->nm_cidade_cde : '<span class="text-danger">Não Informada</span>' !!}</p>
                                                <p class="mb-2"><strong>Data de Nascimento</strong>: {{ ($trilheiro->dt_nascimento) ? \Carbon\Carbon::parse($trilheiro->dt_nascimento)->format('d/m/Y').' - '.\Carbon\Carbon::parse($trilheiro->dt_nascimento)->age.' Anos' : 'Não Informada' }}</p>
                                                <p class="mb-2">Cadastro realizado em {{ \Carbon\Carbon::parse($trilheiro->created_at)->format('d/m/Y H:i:s') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-1 col-md-2 col-sm-12 center">
                                        <h2 class="mb-0">{{ $trilheiro->nr_score_tri }}</h2>
                                        <span>{{ $trilheiro->indice->ds_indice_ind }}</span>
                                        <img src="{{ asset('img/nivel/'.$trilheiro->indice->img_indice_ind) }}" class="w-100" alt="Foto de Perfil">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="card rounded shadow">
                            <div class="body">
                                <div class="row">
                                    <div class="col-6">
                                        <h6>Nenhum trilheiro cadastrado neste evento</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforelse 
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
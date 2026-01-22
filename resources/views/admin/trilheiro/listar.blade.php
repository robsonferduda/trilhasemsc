@extends('layouts.template')

@section('content')
 <div class="block-header">
    <div class="row">
        <div class="col-lg-5 col-md-8 col-sm-12">                        
            <h2 class="mb-2"><i class="fa fa-dashboard"></i> Dashboard</h2>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item">Dashboard</li>
                <li class="breadcrumb-item">Trilheiros</li>
            </ul>
        </div>           
    </div>
</div>

@if(session('flash_message'))
<div class="row">
    <div class="col-12">
        <div class="alert alert-{{ session('flash_level', 'info') }} alert-dismissible fade show" role="alert">
            <strong>{{ session('flash_message') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
</div>
@endif

<div class="row clearfix">
    <div class="col-lg-12 col-md-12">
        <div class="row clearfix">
            @forelse($trilheiros as $trilheiro)
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
                                        <p class="mt-2 mb-2"><strong>E-mail:</strong> <a href="mailto:{{ $trilheiro->user->email }}">{{ $trilheiro->user->email }}</a></p>
                                        <p class="mb-2"><strong>Cidade de Origem</strong>: {!! ($trilheiro->origem) ? $trilheiro->origem->nm_cidade_cde : '<span class="text-danger">Não Informada</span>' !!}</p>
                                        <p class="mb-2"><strong>Data de Nascimento</strong>: {{ ($trilheiro->dt_nascimento) ? \Carbon\Carbon::parse($trilheiro->dt_nascimento)->format('d/m/Y').' - '.\Carbon\Carbon::parse($trilheiro->dt_nascimento)->age.' Anos' : 'Não Informada' }}</p>
                                        <p class="mb-2">Cadastro realizado em {{ \Carbon\Carbon::parse($trilheiro->created_at)->format('d/m/Y H:i:s') }}</p>
                                        <p class="mb-2">
                                            <strong>Último Login:</strong> 
                                            @if($trilheiro->user->dt_last_login)
                                                {{ \Carbon\Carbon::parse($trilheiro->user->dt_last_login)->format('d/m/Y H:i:s') }} 
                                                <span class="text-muted">({{ \Carbon\Carbon::parse($trilheiro->user->dt_last_login)->diffForHumans() }})</span>
                                            @else
                                                <span class="text-warning">Nenhum login registrado</span>
                                            @endif
                                        </p>
                                        <div class="mt-3">
                                            <form action="{{ route('admin.trilheiro.enviar-email', $trilheiro->id_trilheiro_tri) }}" method="POST" style="display: inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-info" title="Enviar email de boas-vindas para teste">
                                                    <i class="fa fa-envelope"></i> Enviar Email Boas-Vindas
                                                </button>
                                            </form>
                                        </div>
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
                <h6 class="text-danger">Nenhum trilheiro cadastrado</h6>
            @endforelse
        </div>
	</div>       
</div>
@endsection
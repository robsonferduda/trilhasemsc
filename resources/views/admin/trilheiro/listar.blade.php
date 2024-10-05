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
<div class="row clearfix">
    <div class="col-lg-12 col-md-12">
        <div class="row clearfix">
            @forelse($trilheiros as $trilheiro)
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="row p-3">
                            <div class="col-lg-1 col-md-2 col-sm-12">
                                <a href="{{ url('admin/trilheiro/perfil/'.$trilheiro->id_trilheiro_tri) }}"><img src="{{ $trilheiro->nm_path_foto_tri ? asset('img/trilheiros/'.$trilheiro->nm_path_foto_tri) : asset('images/user.png') }}" class="rounded-circle user-photo w-100" alt="Foto de Perfil"></a>
                            </div>
                            <div class="col-lg-10 col-md-8 col-sm-12">
                                <div class="row">
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <div class="text">{{ $trilheiro->nm_trilheiro_tri }}</div>
                                        <p><strong>Cidade de Origem</strong>: {!! ($trilheiro->origem) ? $trilheiro->origem->nm_cidade_cde : '<span class="text-danger">Não Informada</span>' !!}</p>
                                        <p><strong>Data de Nascimento</strong>: {{ ($trilheiro->dt_nascimento) ? \Carbon\Carbon::parse($trilheiro->dt_nascimento)->format('d/m/Y').' '.Carbon::parse($trilheiro->dt_nascimento)->age : 'Não Informada' }}</p>
                                        <p>Cadastro realizado em {{ \Carbon\Carbon::parse($trilheiro->created_at)->format('d/m/Y H:i:s') }}</p>
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
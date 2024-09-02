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
                        <div class="row p-5">
                            <div class="col-lg-2 col-md-2 col-sm-12">
                                <img src="{{ $trilheiro->nm_path_foto_tri ? asset('img/trilheiros/'.$trilheiro->nm_path_foto_tri) : asset('images/user.png') }}" class="rounded-circle user-photo w-100" alt="Foto de Perfil">
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-12">
                                <div class="row">
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <div class="text">{{ $trilheiro->nm_trilheiro_tri }}</div>
                                        <p><strong>Cidade de Origem</strong>: {!! ($trilheiro->origem) ? $trilheiro->origem->nm_cidade_cde : '<span class="text-danger">Não Informada</span>' !!}</p>
                                    </div>
                                </div>
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
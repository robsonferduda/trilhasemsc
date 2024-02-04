@extends('layouts.template')

@section('content')
 <div class="block-header">
    <div class="row">
        <div class="col-lg-5 col-md-8 col-sm-12">                        
            <h2 class="mb-2"><i class="fa fa-dashboard"></i> Dashboard</h2>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item">Dashboard</li>
                <li class="breadcrumb-item">Guias</li>
            </ul>
        </div>           
    </div>
</div>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12">
        <div class="row clearfix">
            @forelse($guias as $guia)
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="row p-5">
                            <div class="col-lg-2 col-md-2 col-sm-12">
                                <img src="{{ $guia->nm_path_logo_gui ? asset('img/guias/'.$guia->nm_path_logo_gui) : asset('images/user.png') }}" class="rounded-circle user-photo w-100" alt="Foto de Perfil">
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-12">
                                <div class="row">
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <div class="text">{{ $guia->nm_guia_gui }}</div>
                                        <p><i class="fa fa-instagram"></i> <a href="{{ url("guia/perfil/estatistica/instagram", $guia->id_guia_gui) }}">{{ $guia->nm_instagram_gui }}</a></p>
                                        <p><strong>Cidades de Origem</strong>: {{ ($guia->origem) ? $guia->origem->nm_cidade_cde : 'Santa Catarina' }}</p>
                                        <p><strong>Cidades de Atuação</strong>: {{ count($guia->cidadesAtuacao) > 0 ? implode(', ',$guia->cidadesAtuacao->pluck('nm_cidade_cde')->toArray()) : $guia->ds_atuacao_gui }}</p>
                                        <p><strong>Bibliografia</strong>{{ $guia->dc_biografia_gui }}</p>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12">
                                        <div style="position: absolute; right: 0;">
                                            @if($guia->fl_ativo_gui)
                                                <a href="#" class="btn btn-success disabled mr-1 mt-1"><i class="fa fa-check-circle"></i> Ativar</a>
                                                <a href="{{ url('guia/'.$guia->id_guia_gui.'/recusar') }}" class="btn btn-danger mr-1 mt-1"><i class="fa fa-ban"></i> Recusar</a>
                                            @else
                                                <a href="{{ url('guia/'.$guia->id_guia_gui.'/ativar') }}" class="btn btn-success mr-1 mt-1"><i class="fa fa-check-circle"></i> Ativar</a>
                                                <a href="#" class="btn btn-danger disabled mr-1 mt-1"><i class="fa fa-ban"></i> Recusar</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <h6 class="text-danger">Não existem guias pendentes de aprovação.</h6>
            @endforelse
        </div>
	</div>       
</div>
@endsection
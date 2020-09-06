@extends('layouts.template')

@section('content')
 <div class="block-header">
    <div class="row">
        <div class="col-lg-5 col-md-8 col-sm-12">                        
            <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Trilhas</h2>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-leaf"></i> Trilhas</li>
                <li class="breadcrumb-item">Listar</li>
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
                        <h2>Trilhas</h2>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <a href="{{ url('admin/nova-trilha') }}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Novo</a>
                    </div> 
                </div>
	        </div>
	        <div class="body">
                @include('layouts.mensagens')
	            <div class="table-responsive">
                    <table class="table table-hover js-basic-example dataTable table-custom">
                        <thead>
                            <tr>
                                <th class="center" style="width: 12%">Nível</th>
                                <th>Trilha</th>
                                <th>URL</th>
                                <th>Publicado</th>
                                <th class="center" style="width: 10%">Ações</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Nível</th>
                                <th>Trilha</th>
                                <th>URL</th>
                                <th>Publicado</th>
                                <th>Ações</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($trilhas as $trilha)
                                <tr>
                                    <td class="center">
                                        <img width="50%" src="{{ asset('img/trilhas/nivel/'.$trilha->nivel->dc_icone_niv) }}"><br/>
                                        {{ $trilha->nivel->dc_nivel_niv }}
                                    </td>
                                    <td>{{ $trilha->nm_trilha_tri }}</td>
                                    <td>{{ $trilha->ds_url_tri }}</td>
                                    <td>
                                        @if($trilha->fl_publicacao_tri == 'S')
                                            <span class="badge badge-success">SIM</span>
                                        @else
                                            <span class="badge badge-danger">NÃO</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-warning" href="{{ url('https://trilhasemsc.com.br/'.$trilha->ds_url_tri) }}"><i class="fa fa-search"></i></a>
                                        <a class="btn btn-primary" href="{{ url('admin/editar-trilha/'.$trilha->id_trilha_tri) }}"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>           
	        </div>
	    </div>
	</div>       
</div>
@endsection
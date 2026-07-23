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

                <form method="GET" action="{{ url('admin/listar-trilhas') }}" class="mb-4">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-12 mb-2">
                            <label for="nome" class="mb-1">Nome da trilha</label>
                            <input
                                type="text"
                                name="nome"
                                id="nome"
                                class="form-control"
                                placeholder="Digite o nome"
                                value="{{ $filtroNome ?? '' }}"
                            >
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-12 mb-2">
                            <label for="publicado" class="mb-1">Publicado</label>
                            <select name="publicado" id="publicado" class="form-control">
                                <option value="">Todos</option>
                                <option value="S" {{ ($filtroPublicado ?? '') === 'S' ? 'selected' : '' }}>Sim</option>
                                <option value="N" {{ ($filtroPublicado ?? '') === 'N' ? 'selected' : '' }}>Não</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-12 mb-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary mr-2 w-50"><i class="fa fa-search"></i> Filtrar</button>
                            <a href="{{ url('admin/listar-trilhas') }}" class="btn btn-outline-secondary w-50">Limpar</a>
                        </div>
                    </div>
                </form>

	            @if($trilhas->count())
                    <div class="row clearfix">
                        @foreach($trilhas as $trilha)
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="card mb-3">
                                    <div class="body" style="position: relative; padding-bottom: 72px;">
                                        <div class="d-flex align-items-center">
                                            <div class="mr-3 text-center" style="min-width: 90px;">
                                                <img width="58" src="{{ asset('img/trilhas/nivel/'.$trilha->nivel->dc_icone_niv) }}" alt="Nível {{ $trilha->nivel->dc_nivel_niv }}"><br>
                                                <small class="text-muted">{{ $trilha->nivel->dc_nivel_niv }}</small>
                                            </div>

                                            <div class="flex-grow-1">
                                                <h5 class="mb-1">{{ $trilha->nm_trilha_tri }}</h5>
                                                <p class="mb-2 text-muted">{{ $trilha->ds_url_tri }}</p>

                                                <div class="mb-2">
                                                    @if($trilha->fl_publicacao_tri == 'S')
                                                        <span class="badge badge-success">Publicado: SIM</span>
                                                    @else
                                                        <span class="badge badge-danger">Publicado: NÃO</span>
                                                    @endif
                                                    <span class="badge badge-info ml-1"><i class="fa fa-eye"></i> {{ number_format($trilha->total_visitas ?? 0, 0, ',', '.') }} visitas</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div style="position: absolute; left: 20px; bottom: 16px;">
                                            <a class="btn btn-warning" href="{{ url('https://trilhasemsc.com.br/'.$trilha->ds_url_tri) }}" target="_blank" rel="noopener">
                                                <i class="fa fa-search"></i> Ver trilha
                                            </a>
                                            <a class="btn btn-primary" href="{{ url('admin/editar-trilha/'.$trilha->id_trilha_tri) }}">
                                                <i class="fa fa-edit"></i> Editar
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-3">
                        {{ $trilhas->links() }}
                    </div>
                @else
                    <div class="alert alert-info mb-0">Nenhuma trilha encontrada.</div>
                @endif
	        </div>
	    </div>
	</div>       
</div>
@endsection
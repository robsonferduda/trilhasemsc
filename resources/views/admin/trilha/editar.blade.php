@extends('layouts.template')

@section('content')
 <div class="block-header">
    <div class="row">
        <div class="col-lg-5 col-md-8 col-sm-12">                        
            <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Trilhas</h2>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-leaf"></i> Trilhas</li>
                <li class="breadcrumb-item">Editar</li>
                <li class="breadcrumb-item"><strong>{{ $trilha->nm_trilha_tri }}</strong></li>
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
                        <a href="{{ url('admin/listar-trilhas') }}" class="btn btn-default pull-right"><i class="icon-list"></i> Listar</a>
                    </div> 
                </div>
	        </div>
	        <div class="body">
                @include('layouts.mensagens')
                    <form action="{{ url('admin/update-trilha') }}" method="post">
                        @csrf
                        <div class="sign-in-form">
                            <input type="hidden" name="id_trilha_tri" value="{{ $trilha->id_trilha_tri }}">
                            <div class="form-group">
                                <label for="nm_trilha_tri">Nome</label>
                                <input type="text" name="nm_trilha_tri" id="nm_trilha_tri" value="{{ ($trilha) ? $trilha->nm_trilha_tri : old('nm_trilha_tri') }}" class="form-control" required data-parsley-error-message="Campo nome é obrigatório">
                            </div>
                            <div class="form-group">
                                <label for="ds_url_tri">URL</label>
                                <input type="text" name="ds_url_tri" id="ds_url_tri" value="{{ ($trilha) ? $trilha->ds_url_tri : old('ds_url_tri') }}" class="form-control" required data-parsley-error-message="Campo nome é obrigatório">
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="cd_cidade_cde">Cidade</label>
                                        <select name="cd_cidade_cde" id="cd_cidade_cde" class="form-control select2">
                                            <option value="0">Selecione uma cidade</option>
                                            @foreach($cidades as $cidade)
                                                <option value="{{ $cidade->cd_cidade_cde }}" {{ ($trilha->cd_cidade_cde == $cidade->cd_cidade_cde) ? 'selected' : '' }}>{{ $cidade->nm_cidade_cde }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="id_nivel_niv">Nível</label>
                                        <select name="id_nivel_niv" id="id_nivel_niv" class="form-control select2">
                                            <option value="0">Selecione um nível</option>
                                            @foreach($niveis as $nivel)
                                                <option value="{{ $nivel->id_nivel_niv }}" {{ ($trilha->id_nivel_niv == $nivel->id_nivel_niv) ? 'selected' : '' }}>{{ $nivel->dc_nivel_niv }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <textarea name="ds_trilha_tri" id="ckeditor" rows="15" style="width: 100%;">
                                {{ $trilha->ds_trilha_tri }}
                            </textarea>  
                            <div style="text-align: center; margin-top:15px; ">
                                <a href="{{ url('admin/listar-trilhas') }}" class="btn btn-danger"><i class="fa fa-times"></i> Cancelar</a>
                                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Salvar</button>
                            </div>
                        </div>
                    </form>
                </div>
	    </div>
	</div>       
</div>
@endsection
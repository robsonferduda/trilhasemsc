@extends('layouts.template')

@section('content')
 <div class="block-header">
    <div class="row">
        <div class="col-lg-5 col-md-8 col-sm-12">                        
            <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Trilhas</h2>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-leaf"></i> Trilhas</li>
                <li class="breadcrumb-item">Novo</li>
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
                    <form action="{{ url('admin/create-trilha') }}" method="post">
                        @csrf
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <h4>Dados da Trilha</h4>
                                <div class="form-group">
                                    <label for="nm_trilha_tri">Nome</label>
                                    <input type="text" name="nm_trilha_tri" id="nm_trilha_tri" value="{{ old('nm_trilha_tri') }}" class="form-control" required data-parsley-error-message="Campo nome é obrigatório">
                                </div>
                                <div class="form-group">
                                    <label for="ds_url_tri">URL</label>
                                    <input type="text" name="ds_url_tri" id="ds_url_tri" value="{{ old('ds_url_tri') }}" class="form-control" required data-parsley-error-message="Campo nome é obrigatório">
                                </div>
                                <div class="form-group">
                                    <label for="id_user_usu">Autor</label>
                                    <select name="id_user_usu" id="id_user_usu" class="form-control select2">
                                        <option value="0">Selecione um autor</option>
                                        @foreach($usuarios as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-3 col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label for="cd_cidade_cde">Cidade</label>
                                            <select name="cd_cidade_cde" id="cd_cidade_cde" class="form-control select2">
                                                <option value="0">Selecione uma cidade</option>
                                                @foreach($cidades as $cidade)
                                                    <option value="{{ $cidade->cd_cidade_cde }}">{{ $cidade->nm_cidade_cde }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label for="id_categoria_cat">Categoria</label>
                                            <select name="id_categoria_cat" id="id_categoria_cat" class="form-control select2">
                                                <option value="0">Selecione uma categoria</option>
                                                @foreach($categorias as $categoria)
                                                    <option value="{{ $categoria->id_categoria_cat }}">{{ $categoria->nm_categoria_cat }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-12">
                                        <div class="form-group">
                                            <label for="id_nivel_niv">Nível</label>
                                            <select name="id_nivel_niv" id="id_nivel_niv" class="form-control select2">
                                                <option value="0">Selecione um nível</option>
                                                @foreach($niveis as $nivel)
                                                    <option value="{{ $nivel->id_nivel_niv }}">{{ $nivel->dc_nivel_niv }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-12">
                                        <div class="form-group">
                                            <label for="id_complemento_nivel_con">Complemento</label>
                                            <select name="id_complemento_nivel_con" id="id_complemento_nivel_con" class="form-control select2">
                                                <option value="0">Selecione um complemento</option>
                                                @foreach($complementos as $complemento)
                                                    <option value="{{ $complemento->id_complemento_nivel_con }}">{{ $complemento->nm_complemento_nivel_con }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-12">
                                        <div class="form-group">
                                            <label for="fl_publicacao_tri">Publicado</label>
                                            <select name="fl_publicacao_tri" id="fl_publicacao_tri" class="form-control select2">
                                                <option value="0">Selecione</option>
                                                <option value="N">Não</option>
                                                <option value="S">Sim</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">    
                                     <label for="tags[]">TAGs</label>
                                     <select name="tags[]" multiple="multiple" class="form-control select2">
                                        @foreach($tags as $tag)
                                            <option value="{{ $tag->cd_tag_tag }}">{{ $tag->ds_tag_tag }}</option>
                                        @endforeach
                                    </select> 
                                </div>                               
                                <div class="form-group">
                                    <label for="id_nivel_niv">Geolocalização (Wikiloc, Strava, Relive)</label>
                                    <textarea name="url_geolocalizacao_tri" id="url_geolocalizacao_tri" rows="6" style="width: 100%;">
                                    
                                    </textarea>  
                                </div>
                                <textarea name="ds_trilha_tri" id="ckeditor" rows="15" style="width: 100%;"></textarea>                                  
                            </div> 
                        </div>
                        <div style="text-align: center; margin-top:15px; ">
                            <a href="{{ url('admin/listar-trilhas') }}" class="btn btn-danger"><i class="fa fa-times"></i> Cancelar</a>
                            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Salvar</button>
                        </div>
                    </form>
                </div>
	    </div>
	</div>       
</div>
@endsection
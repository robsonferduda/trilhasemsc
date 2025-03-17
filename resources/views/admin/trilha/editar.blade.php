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
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <h4>Dados da Trilha</h4>
                                <input type="hidden" name="id_trilha_tri" value="{{ $trilha->id_trilha_tri }}">
                                <div class="form-group">
                                    <label for="nm_trilha_tri">Nome</label>
                                    <input type="text" name="nm_trilha_tri" id="nm_trilha_tri" value="{{ ($trilha) ? $trilha->nm_trilha_tri : old('nm_trilha_tri') }}" class="form-control" required data-parsley-error-message="Campo nome é obrigatório">
                                </div>
                                <div class="form-group">
                                    <label for="ds_url_tri">URL</label>
                                    <input type="text" name="ds_url_tri" id="ds_url_tri" value="{{ ($trilha) ? $trilha->ds_url_tri : old('ds_url_tri') }}" class="form-control" required data-parsley-error-message="Campo nome é obrigatório">
                                </div>
                                <div class="form-group">
                                    <label for="id_user_usu">Autor</label>
                                    <select name="id_user_usu" id="id_user_usu" class="form-control select2">
                                        <option value="0">Selecione um autor </option>
                                        @foreach($usuarios as $user)
                                            <option value="{{ $user->id }}" {{ ($trilha->id_user_usu == $user->id ) ? 'selected' : '' }}>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-3 col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label for="id_categoria_cat">Categoria</label>
                                            <select name="id_categoria_cat" id="id_categoria_cat" class="form-control select2">
                                                <option value="0">Selecione uma categoria</option>
                                                @foreach($categorias as $categoria)
                                                    <option value="{{ $categoria->id_categoria_cat }}" {{ ($trilha->id_categoria_cat == $categoria->id_categoria_cat) ? 'selected' : '' }}>{{ $categoria->nm_categoria_cat }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12">
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
                                    <div class="col-lg-2 col-md-2 col-sm-12">
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
                                    <div class="col-lg-2 col-md-2 col-sm-12">
                                        <div class="form-group">
                                            <label for="id_complemento_nivel_con">Complemento</label>
                                            <select name="id_complemento_nivel_con" id="id_complemento_nivel_con" class="form-control select2">
                                                <option value="0">Selecione um complemento</option>
                                                @foreach($complementos as $complemento)
                                                    <option value="{{ $complemento->id_complemento_nivel_con }}" {{ ($trilha->id_complemento_nivel_con == $complemento->id_complemento_nivel_con) ? 'selected' : '' }}>{{ $complemento->nm_complemento_nivel_con }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-12">
                                        <div class="form-group">
                                            <label for="fl_publicacao_tri">Publicado</label>
                                            <select name="fl_publicacao_tri" id="fl_publicacao_tri" class="form-control select2">
                                                <option value="0">Selecione</option>
                                                <option value="N" {{ ($trilha->fl_publicacao_tri == 'N') ? 'selected' : '' }}>Não</option>
                                                <option value="S" {{ ($trilha->fl_publicacao_tri == 'S') ? 'selected' : '' }}>Sim</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">    
                                     <label for="tags[]">TAGs</label>
                                     <select name="tags[]" multiple="multiple" class="form-control select2">
                                        @foreach($tags as $tag)
                                            <option {{ in_array($tag->cd_tag_tag, $trilha->tags->pluck('cd_tag_tag')->toArray()) ? 'selected' : '' }} value="{{ $tag->cd_tag_tag }}">{{ $tag->ds_tag_tag }}</option>
                                        @endforeach
                                    </select> 
                                </div>  
                                <div class="form-group">
                                    <label for="id_nivel_niv">Geolocalização (Wikiloc, Strava, Relive)</label>
                                    <textarea name="url_geolocalizacao_tri" id="url_geolocalizacao_tri" rows="6" style="width: 100%;">{{ $trilha->url_geolocalizacao_tri }}</textarea>  
                                </div>
                                <textarea name="ds_trilha_tri" id="ckeditor" rows="15" style="width: 100%;">
                                    {{ $trilha->ds_trilha_tri }}
                                </textarea> 
                            </div> 
                        </div>
                        <div style="text-align: center; margin-top:15px; ">
                            <a href="{{ url('admin/listar-trilhas') }}" class="btn btn-danger"><i class="fa fa-times"></i> Cancelar</a>
                            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Salvar</button>
                        </div>
                    </form>

                    <form action="{{ url('admin/insert-foto') }}" method="post" enctype="multipart/form-data">
                        @csrf
                            <h4>Dados da Foto</h4>
                            <h6>Tipos obrigatórios para publicar: [Busca - Miniatura, Principais Aventuras - Miniatura, Principais Aventuras - Principal, Últimas Trilhas, Detalhes - Principal]</h6>
                            <div class="row clearfix">
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <input type="hidden" name="id_trilha_tri" value="{{ $trilha->id_trilha_tri }}">
                                        <label for="id_tipo_foto_tfo">Tipo</label>
                                        <select name="id_tipo_foto_tfo" id="id_tipo_foto_tfo" class="form-control select2">
                                            <option value="0">Selecione um tipo</option>
                                            @foreach(\App\TipoFoto::all() as $tipo)
                                                <option  data-height="{{ $tipo->height_tfo }}" data-width="{{ $tipo->width_tfo }}"  value="{{ $tipo->id_tipo_foto_tfo }}">{{ $tipo->nm_tipo_foto_tfo }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-1 col-md-1 col-sm-12">
                                    <div class="form-group">   
                                        <label for="width">Width</label>                                      
                                        <input type="text" name="width" id="width" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-lg-1 col-md-1 col-sm-12">
                                    <div class="form-group">     
                                        <label for="height">Height</label>                                  
                                        <input type="text" name="height" id="height" class="form-control" >                
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="nm_foto_fot">Nome</label>
                                        <input type="text" name="nm_foto_fot" id="nm_foto_fot" class="form-control" required data-parsley-error-message="Campo nome é obrigatório">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="nm_path_fot">Caminho (Ex.: trilha-de-naufragados.jpg)</label>
                                        <input type="text" name="nm_path_fot" id="nm_path_fot" class="form-control" required data-parsley-error-message="Campo caminho é obrigatório">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="dc_alt_fot">Descrição</label>
                                        <input type="text" name="dc_alt_fot" id="dc_alt_fot" class="form-control" required data-parsley-error-message="Campo descrição é obrigatório">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <input required type="file" name="imagem">
                                </div>
                            </div>

                        <div style="text-align: center; margin-top:15px; ">
                            <a href="{{ url('admin/listar-trilhas') }}" class="btn btn-danger"><i class="fa fa-times"></i> Cancelar</a>
                            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Salvar</button>
                        </div>
                    </form>

                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12" style="margin-top: 20px;">
                            <h5>Fotos da Trilha</h5>
                            <div class="table-responsive">
                                        <table class="table table-hover table-custo">
                                            <thead>
                                                <tr>
                                                    <th>Foto</th>
                                                    <th>Tipo</th>
                                                    <th>Descrição</th>
                                                    <th class="center" style="width: 10%">Detalhes</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>Foto</th>
                                                    <th>Tipo</th>
                                                    <th>Descrição</th>
                                                    <th class="center">Detalhes</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                @forelse($trilha->foto as $foto)
                                                    <tr>
                                                        <td>{{ $foto->nm_foto_fot }}</td>
                                                        <td>{{ $foto->tipo->nm_tipo_foto_tfo }}</td>
                                                        <td>{{ $foto->dc_alt_fot }}</td>
                                                        <td class="center">
                                                            <button type="button" class="btn btn-default btn-view-img" data-url="{{ asset('img/trilhas/'.$foto->tipo->dc_path_tfp.'/'.$foto->nm_path_fot) }}"><i class="fa fa-image"></i></button>
                                                        </td>
                                                    </tr>
                                                @empty

                                                @endforelse
                                            </tbody>
                                        </table>
                            </div>           
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12" style="margin-top: 20px;">
                            <h5>Fotos para Postagem</h5>
                                <textarea rows="10" style="width: 100%;">
                                    @forelse($trilha->foto as $foto)
                                        <p><img alt="{{ $foto->nm_foto_fot }}" src="https://trilhasemsc.com.br/public/img/trilhas/descricao/{{ $foto->nm_path_fot }}" /></p>
                                    @empty
                                        Nenhuma foto cadastrada
                                    @endforelse
                                </textarea>
                            </div>           
                        </div>
                    </div>
                </div>
	    </div>
	</div>       
</div>
<div class="modal fade" id="modal-img" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="defaultModalLabel">Imagem da Trilha</h4>
            </div>
            <div class="modal-body">
                <img style="width: 100%; " src="" alt="Imagem da Trilha">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function(){
        $('#id_tipo_foto_tfo').on('change', function() {
            $("#height").val($(this).find(':selected').data('height'));
            $("#width").val($(this).find(':selected').data('width'));
        });
    });

</script>
    
@endsection
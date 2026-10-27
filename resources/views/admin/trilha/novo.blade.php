@extends('layouts.admin')

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
                    <form action="{{ url('admin/create-trilha') }}" method="post" enctype="multipart/form-data">
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
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nu_latitude_tri">Latitude (início)</label>
                                            <input type="text" name="nu_latitude_tri" id="nu_latitude_tri" class="form-control" placeholder="-27.757661" value="{{ old('nu_latitude_tri') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nu_longitude_tri">Longitude (início)</label>
                                            <input type="text" name="nu_longitude_tri" id="nu_longitude_tri" class="form-control" placeholder="-48.496013" value="{{ old('nu_longitude_tri') }}">
                                        </div>
                                    </div>
                                </div>
                                @php
                                    $niveisMedida = ['Nível 1', 'Nível 2', 'Nível 3', 'Nível 4', 'Nível 5'];
                                @endphp
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nu_distancia_trd">Distância (km)</label>
                                            <input type="number" step="0.1" min="0" name="nu_distancia_trd" id="nu_distancia_trd" class="form-control" placeholder="Ex: 6.8" value="{{ old('nu_distancia_trd') }}">
                                            <small class="form-text text-muted">Aparece no mapa e nos detalhes.</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nu_altitude_trd">Altitude (m de subida)</label>
                                            <input type="number" step="1" min="0" name="nu_altitude_trd" id="nu_altitude_trd" class="form-control" placeholder="Ex: 8" value="{{ old('nu_altitude_trd') }}">
                                            <small class="form-text text-muted">Ganho de elevação.</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="duracao_trd">Duração (somente ida)</label>
                                            <input type="time" name="duracao_trd" id="duracao_trd" class="form-control" value="{{ old('duracao_trd') }}">
                                            <small class="form-text text-muted">Exibida como HH:MM (somente ida).</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="ds_exposicao_trd">Exposição</label>
                                            <select name="ds_exposicao_trd" id="ds_exposicao_trd" class="form-control select2">
                                                <option value="">Selecione</option>
                                                @foreach($niveisMedida as $nivelMedida)
                                                    <option value="{{ $nivelMedida }}" {{ old('ds_exposicao_trd') === $nivelMedida ? 'selected' : '' }}>{{ $nivelMedida }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="ds_esforco_trd">Esforço</label>
                                            <select name="ds_esforco_trd" id="ds_esforco_trd" class="form-control select2">
                                                <option value="">Selecione</option>
                                                @foreach($niveisMedida as $nivelMedida)
                                                    <option value="{{ $nivelMedida }}" {{ old('ds_esforco_trd') === $nivelMedida ? 'selected' : '' }}>{{ $nivelMedida }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="ds_orientacao_trd">Orientação</label>
                                            <select name="ds_orientacao_trd" id="ds_orientacao_trd" class="form-control select2">
                                                <option value="">Selecione</option>
                                                @foreach($niveisMedida as $nivelMedida)
                                                    <option value="{{ $nivelMedida }}" {{ old('ds_orientacao_trd') === $nivelMedida ? 'selected' : '' }}>{{ $nivelMedida }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="arquivo_gpx">Arquivo GPX (trajeto da trilha)</label>
                                    <input type="file" name="arquivo_gpx" id="arquivo_gpx" class="form-control" accept=".gpx,application/gpx+xml,application/xml,text/xml">
                                    <small class="form-text text-muted">
                                        Aceita .gpx (máx. 10 MB). Se latitude/longitude estiverem vazias, o início do track preenche automaticamente.
                                    </small>
                                </div>
                                <div class="form-group">
                                    <label for="imagem_story">Imagem do story do Instagram</label>
                                    <input type="file" name="imagem_story" id="imagem_story" class="form-control" accept="image/jpeg,image/png,image/webp">
                                    <small class="form-text text-muted">
                                        Use uma imagem vertical, de preferência 1080×1920. Só trilhas com esta imagem entram na publicação automática. JPG, PNG ou WEBP, até 8 MB.
                                    </small>
                                </div>
                                <div class="form-group">
                                    <label for="url_geolocalizacao_tri">Geolocalização (Wikiloc, Strava, Relive)</label>
                                    <textarea name="url_geolocalizacao_tri" id="url_geolocalizacao_tri" rows="6" style="width: 100%;">{{ old('url_geolocalizacao_tri') }}</textarea>  
                                </div>
                                <div class="form-group">
                                    <label for="ds_trilha_tri">Descrição</label>
                                    <textarea name="ds_trilha_tri" id="ds_trilha_tri" class="form-control" rows="15">{{ old('ds_trilha_tri') }}</textarea>
                                </div>                                  
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
@section('script')
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(function () {
        if (window.CKEDITOR) {
            CKEDITOR.replace('ds_trilha_tri', {
                height: 420,
                language: 'pt-br',
                versionCheck: false,
                removePlugins: 'elementspath',
                allowedContent: true,
                extraAllowedContent: '*(*);*{*}',
                pasteFilter: null,
                toolbar: [
                    { name: 'styles', items: ['Format'] },
                    { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'RemoveFormat'] },
                    { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent'] },
                    { name: 'links', items: ['Link', 'Unlink'] },
                    { name: 'insert', items: ['Image'] },
                    { name: 'clipboard', items: ['Undo', 'Redo'] },
                    { name: 'document', items: ['Source'] }
                ],
                format_tags: 'p;h1;h2;h3;h4;pre',
                enterMode: CKEDITOR.ENTER_P,
                shiftEnterMode: CKEDITOR.ENTER_BR
            });
        }

        $('form').on('submit', function () {
            if (window.CKEDITOR && CKEDITOR.instances['ds_trilha_tri']) {
                CKEDITOR.instances['ds_trilha_tri'].updateElement();
            }
        });
    });
</script>
@endsection
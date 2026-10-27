@extends('layouts.admin')

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
                    <form action="{{ url('admin/update-trilha') }}" method="post" enctype="multipart/form-data">
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
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nu_latitude_tri">Latitude (início)</label>
                                            <input type="text" name="nu_latitude_tri" id="nu_latitude_tri" class="form-control" placeholder="-27.757661" value="{{ $trilha->nu_latitude_tri }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nu_longitude_tri">Longitude (início)</label>
                                            <input type="text" name="nu_longitude_tri" id="nu_longitude_tri" class="form-control" placeholder="-48.496013" value="{{ $trilha->nu_longitude_tri }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nu_distancia_trd">Distância (km)</label>
                                            <input type="number" step="0.1" min="0" name="nu_distancia_trd" id="nu_distancia_trd" class="form-control" placeholder="Ex: 5.0" value="{{ optional($trilha->detalhes)->nu_distancia_trd }}">
                                            <small class="form-text text-muted">Aparece no mapa e na página de detalhes da trilha.</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nu_altitude_trd">Altitude (m)</label>
                                            <input type="number" step="1" min="0" name="nu_altitude_trd" id="nu_altitude_trd" class="form-control" placeholder="Ex: 450" value="{{ optional($trilha->detalhes)->nu_altitude_trd }}">
                                            <small class="form-text text-muted">Ganho de elevação, em metros de subida.</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="arquivo_gpx">Arquivo GPX (trajeto da trilha)</label>
                                    <input type="file" name="arquivo_gpx" id="arquivo_gpx" class="form-control" accept=".gpx,application/gpx+xml,application/xml,text/xml">
                                    <small class="form-text text-muted">
                                        Aceita .gpx (máx. 10 MB). Se latitude/longitude estiverem vazias, o início do track preenche automaticamente.
                                    </small>
                                    @if(!empty($trilha->nm_arquivo_gpx_tri))
                                        <div class="mt-2">
                                            <a href="{{ asset('gpx/trilhas/'.$trilha->nm_arquivo_gpx_tri) }}" target="_blank" class="btn btn-sm btn-info">
                                                <i class="fa fa-download"></i> {{ $trilha->nm_arquivo_gpx_tri }}
                                            </a>
                                            <label class="ml-3" style="font-weight: normal;">
                                                <input type="checkbox" name="remover_gpx" value="1"> Remover GPX atual
                                            </label>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="imagem_story">Imagem do story do Instagram</label>
                                    <input type="file" name="imagem_story" id="imagem_story" class="form-control" accept="image/jpeg,image/png,image/webp">
                                    <small class="form-text text-muted">
                                        Use uma imagem vertical, de preferência 1080×1920. Só trilhas com esta imagem entram na publicação automática. JPG, PNG ou WEBP, até 8 MB.
                                    </small>
                                    @if(!empty($trilha->ds_path_story_instagram_tri))
                                        <div class="mt-2">
                                            <img src="{{ asset('img/instagram/stories/'.$trilha->ds_path_story_instagram_tri) }}" alt="Story de {{ $trilha->nm_trilha_tri }}" style="max-height: 220px;">
                                            <label class="ml-3" style="font-weight: normal;">
                                                <input type="checkbox" name="remover_story" value="1"> Remover imagem do story
                                            </label>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="url_geolocalizacao_tri">Geolocalização (Wikiloc, Strava, Relive)</label>
                                    <textarea name="url_geolocalizacao_tri" id="url_geolocalizacao_tri" rows="6" style="width: 100%;">{{ $trilha->url_geolocalizacao_tri }}</textarea>  
                                </div>
                                <div class="form-group">
                                    <label for="ds_trilha_tri">Descrição</label>
                                    <textarea name="ds_trilha_tri" id="ds_trilha_tri" class="form-control" rows="15">{{ $trilha->ds_trilha_tri }}</textarea>
                                </div> 
                            </div> 
                        </div>
                        <div style="text-align: center; margin-top:15px; ">
                            <a href="{{ url('admin/listar-trilhas') }}" class="btn btn-danger"><i class="fa fa-times"></i> Cancelar</a>
                            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Salvar</button>
                        </div>
                    </form>

                    <div class="row clearfix" style="margin-top: 30px;">
                        <div class="col-lg-12">
                            <div class="alert alert-info mb-0">
                                Convites por email e gráfico de acessos agora estão na tela de detalhes da trilha.
                                <a href="{{ route('admin.trilha.detalhes', $trilha->id_trilha_tri) }}" class="btn btn-info btn-sm ml-2">
                                    <i class="fa fa-bar-chart"></i> Ir para detalhes
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix" style="margin-top: 30px;">
                        <div class="col-lg-12">
                            <h4>Fotos obrigatórias</h4>
                            <p class="text-muted mb-3">
                                Para publicar no template novo, envie apenas estas duas imagens.
                                Nome do arquivo gerado automaticamente: <code>{{ $slugArquivoFoto }}.jpg</code>
                                (a extensão segue o arquivo enviado).
                            </p>
                        </div>
                    </div>

                    @php
                        $blocosFoto = [
                            [
                                'tipoId' => 7,
                                'foto' => $fotoBusca,
                                'titulo' => 'Busca - Miniatura',
                                'uso' => 'Aparece na listagem de trilhas',
                                'botao' => 'Salvar miniatura',
                            ],
                            [
                                'tipoId' => 5,
                                'foto' => $fotoPrincipal,
                                'titulo' => 'Detalhes - Principal',
                                'uso' => 'Aparece na página de detalhes da trilha',
                                'botao' => 'Salvar foto principal',
                            ],
                        ];
                    @endphp

                    <div class="row clearfix">
                        @foreach($blocosFoto as $bloco)
                            @php
                                $tipo = $tiposFotoObrigatorios->get($bloco['tipoId']);
                                $fotoAtual = $bloco['foto'];
                                $urlAtual = $fotoAtual && $tipo
                                    ? asset('img/trilhas/'.$tipo->dc_path_tfp.'/'.$fotoAtual->nm_path_fot)
                                    : null;
                            @endphp
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <form action="{{ url('admin/insert-foto') }}" method="post" enctype="multipart/form-data" class="mb-4">
                                    @csrf
                                    <input type="hidden" name="id_trilha_tri" value="{{ $trilha->id_trilha_tri }}">
                                    <input type="hidden" name="id_tipo_foto_tfo" value="{{ $bloco['tipoId'] }}">

                                    <div class="form-group">
                                        <label class="d-block">{{ $bloco['titulo'] }}</label>
                                        <small class="form-text text-muted mt-0 mb-2">
                                            {{ $bloco['uso'] }}
                                            @if($tipo && $tipo->width_tfo && $tipo->height_tfo)
                                                · {{ $tipo->width_tfo }}×{{ $tipo->height_tfo }} px
                                            @endif
                                        </small>

                                        @if($urlAtual)
                                            <div class="mb-2">
                                                <img src="{{ $urlAtual }}" alt="{{ $fotoAtual->dc_alt_fot }}" style="max-width: 100%; max-height: 180px; object-fit: cover;">
                                                <div>
                                                    <small class="text-muted">Arquivo atual: {{ $fotoAtual->nm_path_fot }}</small>
                                                    <button type="button" class="btn btn-sm btn-default btn-view-img ml-2" data-url="{{ $urlAtual }}">
                                                        <i class="fa fa-image"></i> Ampliar
                                                    </button>
                                                </div>
                                            </div>
                                        @else
                                            <div class="alert alert-warning py-2">Ainda não enviada</div>
                                        @endif

                                        <input type="file" name="imagem" class="form-control" accept="image/jpeg,image/png,image/webp" required>
                                    </div>

                                    <button type="submit" class="btn btn-success">
                                        <i class="fa fa-save"></i> {{ $bloco['botao'] }}
                                    </button>
                                </form>
                            </div>
                        @endforeach
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
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
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

        $('form[action*="update-trilha"]').on('submit', function () {
            if (window.CKEDITOR && CKEDITOR.instances['ds_trilha_tri']) {
                CKEDITOR.instances['ds_trilha_tri'].updateElement();
            }
        });
    });
</script>
@endsection
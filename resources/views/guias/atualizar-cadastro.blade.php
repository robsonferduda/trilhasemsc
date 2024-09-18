@extends('layouts.template')

@section('content')
    <div class="block-header">
        <div class="row">
            <div class="col-lg-5 col-md-8 col-sm-12">
                <h2>Guias e Condutores</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><i class="fa fa-id-card"></i> Guias e Condutores</li>
                    <li class="breadcrumb-item">Atualizar Cadastro</li>
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
                            <h2>Dados do Condutor</h2>
                        </div>
                    </div>
                </div>
                <div class="row ml-2 mr-2">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        @if($guia->fl_perfil_completo_gui == true and $guia->fl_ativo_gui == false)
                            <h6 class="text-danger"> Seu perfil está desativado, para ativar selecione o campo "Ativo".</h6>
                        @endif
                        @if($guia->fl_perfil_completo_gui == true and $guia->fl_perfil_moderado_gui == false and $guia->fl_ativo_gui == true)
                            <h6 class="text-danger"> Seu perfil está pendente de aceite. Assim que o aceite for dado você receberá um email. Perfis sem Cadastur não serão aprovados.</h6>
                        @endif
                    </div>
                </div>
                <div class="body">
                    @include('layouts.mensagens')
                    <form action="{{ url('guia-e-condutores/privado/atualizar-cadastro') }}" enctype="multipart/form-data" method="post" id="form-guia">
                        @csrf
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="nome">Número do Cadastur</label><span class="text-danger"> Obrigatório</span>
                                    <input type="text" name="cadastur" id="cadastur" value="{{ $guia->nu_cadastur_gui }}" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="nome">Nome</label><span class="text-danger"> Obrigatório</span>
                                    <input type="text" name="nome" id="nome" value="{{ $guia->nm_guia_gui }}" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="email">E-mail</label>
                                    <input type="text" name="email" id="email" value="{{ $usuario->email }}" class="form-control" required readonly>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="site">Celular</label>
                                    <input type="text" name="celular" id="celular" value="{{ $guia->fone ? $guia->fone->nu_fone_fon : ''  }}" placeholder="(99) 999-9999" class="form-control phone" >
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-43 col-sm-12">
                                <div class="form-group">
                                    <label for="site">Whatsap</label>
                                    <input type="text" name="whatsap" id="whatsap" value="{{ $guia->whatsap ? $guia->whatsap->nu_fone_fon : ''  }}"  placeholder="(99) 999-9999" class="form-control phone" >
                                </div>
                            </div>            
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="site">Site</label>
                                    <input type="text" name="site" id="site" value="{{ $guia->nm_site_gui ?: ''  }}" placeholder="Ex: https://site.com.br" class="form-control" >
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                          
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="instagram">Instagram </label><span class="text-info"> Somente o nome do perfil</span>
                                    <input type="text" name="instagram" id="instagram" value="{{ $guia->nm_instagram_gui ?: ''  }}" placeholder="Ex: trilhasemsc" class="form-control" >
                                    <span class="text-danger"> Não use arroba ou URL. Ex.: trilhasemsc</span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="cidade_origem">Cidade de Origem</label><span class="text-danger"> Obrigatório</span>
                                    <select name="cidade_origem" id="cidade_origem" class="form-control select2" data-parsley-errors-container="#error-cidade-origem" required>
                                        <option value="">Selecione uma cidade</option>
                                        @foreach($cidades as $cidade)
                                            <option {!! $guia->cd_cidade_origem_gui == $cidade->cd_cidade_cde ? 'selected' : '' !!}  value="{{ $cidade->cd_cidade_cde }}">{{ $cidade->nm_cidade_cde }}</option>
                                        @endforeach
                                    </select>
                                    <span id="error-cidade-origem"></span>
                                </div>

                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="cidades_atuacao">Cidades de Atuação</label><span class="text-danger"> Obrigatório</span>
                                    <select name="cidades_atuacao[]" id="cidades_atuacao" class="form-control select2" multiple="multiple" data-parsley-errors-container="#error-cidade-atuacao" required>
                                        @foreach($cidades as $cidade)
                                            <option {!! in_array($cidade->cd_cidade_cde,$guia->cidadesAtuacao->pluck('cd_cidade_cde')->toArray()) ? 'selected' : '' !!}  value="{{ $cidade->cd_cidade_cde }}">{{ $cidade->nm_cidade_cde }}</option>
                                        @endforeach
                                    </select>
                                    <span id="error-cidade-atuacao"></span>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="unidades_conservacao">Unidades de Conservação</label><span class="text-info"> Marque as unidades que você possui autorização para guiar</span>
                                    <select name="unidades_conservacao[]" id="unidades_conservacao" class="form-control select2" multiple="multiple" data-parsley-errors-container="#error-unidades_conservacao" required>
                                        @foreach($ucs as $uc)
                                            <option {!! in_array($uc->id_unidade_conservacao_unc, $guia->unidadesConservacao->pluck('id_unidade_conservacao_unc')->toArray()) ? 'selected' : '' !!}  value="{{ $uc->id_unidade_conservacao_unc }}">{{ $uc->nome_unc }}</option>
                                        @endforeach
                                    </select>
                                    <span id="error-cidade-atuacao"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <label class="fancy-checkbox">
                                    <input type="checkbox" {!! $guia->fl_ativo_gui ? 'checked' : '' !!} name="ativo">
                                        <span>Ativo</span><span class="text-info"> Utilize essa opção para alterar sua visualização no site. Guias inativos não são mostrados.</span>
                                </label>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="biografia">Biografia</label><span class="text-danger"> Obrigatório</span>
                                    <textarea name="biografia" id="biografia" rows="10" style="width: 100%;" data-parsley-minlength="100" required>{{ $guia->dc_biografia_gui ?: ''  }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="dropify-event">Faça aqui o upload da sua foto de perfil</label><span class="text-info"> Preferencialmente foto em formato quadrado</span>
                                    <input name="imagem" type="file" id="dropify-event"  data-default-file="{{  $guia->nm_path_logo_gui ? asset('img/guias/'.$guia->nm_path_logo_gui) : asset('img/guias/default.png') }}">
                                    <input name="imagem_deletada" id="imagem_deletada" type="hidden" value='false' >
                                </div>
                            </div>
                        </div>
                        {{-- <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="card">
                                    <div class="header">
                                        <h2>Trilhas</h2>                                      
                                    </div>
                                    <div class="body">
                                        <select id="optgroup" class="ms" multiple="multiple" name=trilhas>
                                            @php
                                               $codigoCidade = '';
                                               $primeiraPassada = true;
                                            @endphp
                                            
                                            @foreach($trilhas as $trilha)
                                                
                                                @if($trilha->cidade->cd_cidade_cde != $codigoCidade) 
                                                    @if($primeiraPassada)
                                                        </optgroup>
                                                    @endif
                                                    <optgroup label="{{ $trilha->cidade->nm_cidade_cde }}">
                                                @endif
                                                <option value="{{ $trilha->id_trilha_tri }}">{{ $trilha->nm_trilha_tri }}</option>
                                                @php
                                                    $codigoCidade = $trilha->cidade->cd_cidade_cde;
                                                    $primeiraPassada = false;
                                                @endphp
                                                
                                            @endforeach                                                                                                                           
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <div style="text-align: center; margin-top:15px; ">
{{--                            <a href="{{ url('admin/listar-trilhas') }}" class="btn btn-danger"><i class="fa fa-times"></i> Cancelar</a>--}}
                            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(function() {
            $('#form-guia').parsley();

            $('.phone').mask('(99) 999-999999');

            var drEvent = $('#dropify-event').dropify();

            drEvent.on('dropify.afterClear', function(event, element) {
                $('#imagem_deletada').val(true);
            });

            //$('#optgroup').multiSelect({ selectableOptgroup: true });
        });
    </script>
@endsection
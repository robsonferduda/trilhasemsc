@extends('layouts.template')

@section('content')
    <div class="block-header">
        <div class="row">
            <div class="col-lg-5 col-md-8 col-sm-12">
                <h2>Guias e Condutores</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><i class="fa fa-id-card"></i> Guias e Condutores</li>
                    <li class="breadcrumb-item">Eventos</li>
                    <li class="breadcrumb-item">Cadastrar Eventos</li>
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
                            <h2><i class="fa fa-tags"></i> Cadastro de Eventos</h2>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <a href="{{ url('guia-e-condutores/privado/eventos') }}" class="btn btn-primary pull-right"><i class="fa fa-tags"></i> Meus Eventos</a>
                        </div> 
                    </div>
                </div>
                
                <div class="body no-padding-top pt-0">
                    @include('layouts.mensagens')
                    @if($evento)
                        <form action="{{ url('guia-e-condutores/privado/evento/update') }}" enctype="multipart/form-data" method="post" id="form-guia">
                        <input type="hidden" name="id_evento_eve" value="{{ $evento->id_evento_eve }}"/>
                    @else
                        <form action="{{ url('guia-e-condutores/privado/evento/cadastrar') }}" enctype="multipart/form-data" method="post" id="form-guia">
                    @endif
                        @csrf
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="nome">Nome do Evento</label><span class="text-danger"> Obrigatório</span>
                                    <input type="text" name="nm_evento_eve" id="nm_evento_eve" value="{{ ($evento) ? $evento->nm_evento_eve : old('nm_evento_eve') }}" class="form-control" placeholder="Nome do evento. Ex.: Trilha do Cambierela" required>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="cidade_origem">Cidade de Origem</label><span class="text-info"> Somente eventos em Santa Catarina</span><span class="text-danger"> Obrigatório</span>
                                    <select name="cd_cidade_cde" id="cd_cidade_cde" class="form-control select2" data-parsley-errors-container="#error-cidade-origem" required>
                                        <option value="">Selecione uma cidade</option>
                                        @foreach($cidades as $cidade)
                                            <option value="{{ $cidade->cd_cidade_cde }}" {{ ($evento and $evento->cd_cidade_cde == $cidade->cd_cidade_cde) ? 'selected' : '' }}>{{ $cidade->nm_cidade_cde }}</option>
                                        @endforeach
                                    </select>
                                    <span id="error-cidade-origem"></span>
                                </div>

                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="dt_realizacao_eve">Data de Realização</label><span class="text-danger"> Obrigatório</span>
                                    <input type="text" name="dt_realizacao_eve" id="dt_realizacao_eve" value="{{ ($evento) ? \Carbon\Carbon::parse($evento->dt_realizacao_eve)->format('d/m/Y') : old('dt_realizacao_eve') }}" placeholder="DD/MM/AAAA" class="form-control data" >
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="hora_inicio_eve">Horário de Início</label><span class="text-danger"> Obrigatório</span>
                                    <input type="text" name="hora_inicio_eve" id="hora_inicio_eve" value="{{ ($evento) ? $evento->hora_inicio_eve : old('hora_inicio_eve') }}" placeholder="00:00" class="form-control hora" >
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="dt_termino_eve">Data de Término</label><span class="text-danger"> Obrigatório</span>
                                    <input type="text" name="dt_termino_eve" id="dt_termino_eve" value="{{ ($evento) ? \Carbon\Carbon::parse($evento->dt_termino_eve)->format('d/m/Y') : old('dt_termino_eve') }}" placeholder="DD/MM/AAAA" class="form-control data" >
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="hora_fim_eve">Horário de Término</label><span class="text-danger"> Obrigatório</span>
                                    <input type="text" name="hora_fim_eve" id="hora_fim_eve" value="{{ ($evento) ? $evento->hora_fim_eve : old('hora_fim_eve') }}" placeholder="00:00" class="form-control hora" >
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="valor_eve">Valor</label><span class="text-danger"> Obrigatório</span>
                                    <input type="text" name="valor_eve" id="valor_eve" value="{{ ($evento) ? $evento->valor_eve : old('valor_eve') }}" placeholder="0.00" class="form-control" >
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="ds_fone_contato_eve">Contato</label><span class="text-danger"> Obrigatório</span>
                                    <input type="text" name="ds_fone_contato_eve" id="ds_fone_contato_eve" value="{{ ($evento) ? $evento->ds_fone_contato_eve : old('ds_fone_contato_eve') }}" placeholder="(99) 99999-9999" class="form-control phone" >
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="total_participantes_eve">Máximo de Participantes</label><span class="text-primary"> Opcional</span>
                                    <input type="text" name="total_participantes_eve" id="total_participantes_eve" value="{{ ($evento) ? $evento->total_participantes_eve : old('total_participantes_eve') }}" placeholder="" class="form-control" >
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="fl_privado_eve">Visibilidade</label>
                                    <div class="fancy-checkbox mt-2">
                                        <label>
                                            <input type="checkbox" name="fl_privado_eve" id="fl_privado_eve" value="1" {{ ($evento and $evento->fl_privado_eve) ? 'checked' : '' }}>
                                            <span>Evento Privado</span>
                                        </label>
                                    </div>
                                    <small class="form-text text-muted">Se marcado, o evento não será exibido publicamente</small>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="biografia">Descrição do Evento</label><span class="text-danger"> Obrigatório</span>
                                    <textarea name="descricao" id="descricao" rows="10" style="width: 100%;" data-parsley-minlength="100" required>{{ ($evento) ? $evento->descricao : old('descricao') }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label class="mb-0" for="img_instagram">Faça aqui o upload da imagem de divulgação no Instagram</label> <span class="text-danger">Obrigatório</span>
                                    <p class="mt-0 mb-0 text-info">Imagem em formato vertical, para ser postada nos storys do Instagram</p>
                                    <input name="img_instagram" type="file" id="img_instagram"  data-default-file="{{  ($evento and $evento->ds_imagem_vertical_eve) ? asset('img/eventos/'.$evento->ds_imagem_vertical_eve) : asset('img/eventos/evento_story.png') }}">
                                    <input name="img_deletada_instagram" id="img_deletada_instagram" type="hidden" value='false' >
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label class="mb-0" for="img_evento">Faça aqui o upload da imagem de divulgação do evento</label> <span class="text-danger">Obrigatório</span>
                                    <p class="mt-0 mb-0 text-info">Imagem em formato horizontal, para ser postada na página do evento.</p>
                                    <input name="img_evento" type="file" id="img_evento"  data-default-file="{{  ($evento and $evento->ds_imagem_horizontal_eve)? asset('img/eventos/'.$evento->ds_imagem_horizontal_eve) : asset('img/eventos/fundo_evento.jpg') }}">
                                    <input name="img_deletada_evento" id="img_deletada_evento" type="hidden" value='false' >
                                </div>
                            </div>
                        </div>
                        <div style="text-align: center; margin-top:15px; ">
                            <a href="{{ url('guia-e-condutores/privado/eventos') }}" class="btn btn-danger"><i class="fa fa-times"></i> Cancelar</a>
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

        $('.phone').mask('(99) 99999-9999');
        $('.hora').mask('99:99');
        $('.data').mask('99/99/9999');
        $('#valor_eve').maskMoney({thousands:'', decimal:'.'});

        var drEvent = $('#img_instagram').dropify();

        drEvent.on('dropify.afterClear', function(event, element) {
            $('#img_deletada_instagram').val(true);
        });

        var drEvent = $('#img_evento').dropify();

        drEvent.on('dropify.afterClear', function(event, element) {
            $('#img_deletada_evento').val(true);
        });
    });
</script>
@endsection
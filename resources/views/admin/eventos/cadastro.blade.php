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
                            <h2>Cadastro de Eventos</h2>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <a href="{{ url('guia-e-condutores/privado/eventos') }}" class="btn btn-primary pull-right"><i class="fa fa-tags"></i> Meus Eventos</a>
                        </div> 
                    </div>
                </div>
                
                <div class="body no-padding-top">
                    @include('layouts.mensagens')
                    <form action="{{ url('guia-e-condutores/privado/evento/cadastrar') }}" enctype="multipart/form-data" method="post" id="form-guia">
                        @csrf
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="nome">Nome do Evento</label><span class="text-danger"> Obrigatório</span>
                                    <input type="text" name="nm_evento_eve" id="nm_evento_eve" value="" class="form-control" placeholder="Nome do evento. Ex.: Trilha do Cambierela" required>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="site">Data de Realização</label><span class="text-danger"> Obrigatório</span>
                                    <input type="text" name="dt_realizacao_eve" id="dt_realizacao_eve" value="" placeholder="DD/MM/AAAA" class="form-control data" >
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="site">Horário de Início</label><span class="text-danger"> Obrigatório</span>
                                    <input type="text" name="hora_inicio_eve" id="hora_inicio_eve" value="" placeholder="00:00" class="form-control hora" >
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="site">Horário de Término</label><span class="text-danger"> Obrigatório</span>
                                    <input type="text" name="hora_fim_eve" id="hora_fim_eve" value="" placeholder="00:00" class="form-control hora" >
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="site">Valor</label><span class="text-danger"> Obrigatório</span>
                                    <input type="text" name="valor_eve" id="valor_eve" value="" placeholder="R$ 999,99" class="form-control" >
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="cidade_origem">Cidade de Origem</label><span class="text-danger"> Obrigatório</span>
                                    <select name="cd_cidade_cde" id="cd_cidade_cde" class="form-control select2" data-parsley-errors-container="#error-cidade-origem" required>
                                        <option value="">Selecione uma cidade</option>
                                        @foreach($cidades as $cidade)
                                            <option value="{{ $cidade->cd_cidade_cde }}">{{ $cidade->nm_cidade_cde }}</option>
                                        @endforeach
                                    </select>
                                    <span id="error-cidade-origem"></span>
                                </div>

                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="site">Contato</label><span class="text-danger"> Obrigatório</span>
                                    <input type="text" name="ds_fone_contato_eve" id="ds_fone_contato_eve" value="" placeholder="(99) 99999-9999" class="form-control phone" >
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="site">Total Máximo de Participantes</label><span class="text-primary"> Opcional</span>
                                    <input type="text" name="total_participantes_eve" id="total_participantes_eve" value="" placeholder="" class="form-control" >
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="biografia">Descrição do Evento</label><span class="text-danger"> Obrigatório</span>
                                    <textarea name="descricao" id="descricao" rows="10" style="width: 100%;" data-parsley-minlength="100" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="dropify-event">Faça aqui o upload da imagem de divulgação no Instagram</label> <span class="text-danger">Obrigatório</span>
                                    <input name="imagem" type="file" id="dropify-event"  data-default-file="{{  $guia->nm_path_logo_gui ? asset('img/eventos/'.$guia->nm_path_logo_gui) : asset('img/eventos/default.png') }}">
                                    <input name="imagem_deletada" id="imagem_deletada" type="hidden" value='false' >
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

        var drEvent = $('#dropify-event').dropify();

        drEvent.on('dropify.afterClear', function(event, element) {
            $('#imagem_deletada').val(true);
        });
    });
</script>
@endsection
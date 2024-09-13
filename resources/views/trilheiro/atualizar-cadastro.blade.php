@extends('layouts.template')
@section('content')
    <div class="block-header">
        <div class="row">
            <div class="col-lg-5 col-md-8 col-sm-12">
                <h2>Trilheiros</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><i class="fa fa-map"></i> Trilheiros</li>
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
                            <h2>Dados do Trilheiro</h2>
                        </div>
                    </div>
                </div>
               
                <div class="body">
                    @include('layouts.mensagens')
                    <form action="{{ url('trilheiro/privado/atualizar-cadastro') }}" enctype="multipart/form-data" method="post" id="form-trilheiro">
                        @csrf
                        <div class="row clearfix">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="nome">Nome</label><span class="text-danger"> Obrigatório</span>
                                    <input type="text" name="nome" id="nome" value="{{ $trilheiro->nm_trilheiro_tri }}" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="email">E-mail</label>
                                    <input type="text" name="email" id="email" value="{{ $usuario->email }}" class="form-control" required readonly>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="email">Sexo</label><span class="text-danger"> Obrigatório</span>
                                    <select name="sexo" id="sexo" class="form-control select2" data-parsley-errors-container="#error-sexo" required>
                                        <option value="">Selecione uma opção</option>
                                        <option value="F" {!! $trilheiro->cd_sexo_sex == 'F' ? 'selected' : '' !!}>Feminino</option>
                                        <option value="M" {!! $trilheiro->cd_sexo_sex == 'M' ? 'selected' : '' !!}>Masculino</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="estado_origem">Estado de Origem</label><span class="text-danger"> Obrigatório</span>
                                    <select name="estado_origem" id="estado_origem" class="form-control select2" data-parsley-errors-container="#error-estado-origem" required>
                                        <option value="">Selecione um estado</option>
                                        @foreach($estados as $estado)
                                            <option {!! $trilheiro->cd_estado_est == $estado->cd_estado_est ? 'selected' : '' !!}  value="{{ $estado->cd_estado_est }}">{{ $estado->nm_estado_est }}</option>
                                        @endforeach
                                    </select>
                                    <span id="error-estado-origem"></span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="cidade_origem">Cidade de Origem</label><span class="text-danger"> Obrigatório</span>
                                    <select name="cidade_origem" id="cidade_origem" class="form-control select2" data-parsley-errors-container="#error-cidade-origem" required>
                                        <option value="">Selecione uma cidade</option>
                                        @foreach($cidades as $cidade)
                                            <option {!! $trilheiro->cd_cidade_tri == $cidade->cd_cidade_cde ? 'selected' : '' !!}  value="{{ $cidade->cd_cidade_cde }}">{{ $cidade->nm_cidade_cde }}</option>
                                        @endforeach
                                    </select>
                                    <span id="error-cidade-origem"></span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="dt_nascimento">Data de Nascimento</label><span class="text-danger"> Obrigatório</span>
                                    <input type="text" name="dt_nascimento" id="dt_nascimento" value="{{ $usuario->email }}" class="form-control" placeholder="__/__/____" required>
                                </div>
                            </div>                            
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="dropify-event">Faça aqui o upload da sua foto de perfil</label><span class="text-info"> Preferencialmente foto em formato quadrado</span>
                                    <input name="imagem" type="file" id="dropify-event"  data-default-file="{{  $trilheiro->nm_path_foto_tri ? asset('img/trilheiros/'.$trilheiro->nm_path_foto_tri) : asset('img/trilheiros/default.png') }}">
                                    <input name="imagem_deletada" id="imagem_deletada" type="hidden" value='false' >
                                </div>
                            </div>
                        </div>
                        <div style="text-align: center; margin-top:15px; ">
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
            $('#form-trilheiro').parsley();

            $('.phone').mask('(99) 999-999999');

            var drEvent = $('#dropify-event').dropify();

            drEvent.on('dropify.afterClear', function(event, element) {
                $('#imagem_deletada').val(true);
            });
        });
    </script>
@endsection
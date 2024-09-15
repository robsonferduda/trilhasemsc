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
                    <form action="{{ url('trilheiro/privado/score') }}" enctype="multipart/form-data" method="post" id="form-trilheiro">
                        @csrf
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <p class="text-info"><i class="fa fa-exclamation-circle"></i> Atualize seus dados para calcular o score. O cálculo será realizado quando todas as perguntas forem respondidas ou as respostas atualizadas.</p>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <h6 class="text-primary"><i class="fa fa-user-circle-o text-primary" aria-hidden="true"></i> Dados Básicos</h6>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="nome">Altura</label><span class="text-danger"> Obrigatório</span>
                                    <input type="text" name="altura" id="altura" value="" class="form-control" required>
                                    <p class="text-info">Digite somente números</p>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="nome">Peso</label><span class="text-danger"> Obrigatório</span>
                                    <input type="text" name="peso" id="peso" value="" class="form-control" required>
                                    <p class="text-info">Digite somente números</p>
                                </div>
                            </div> 
                            <hr/>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <h6 class="text-danger"><i class="fa fa-heartbeat text-danger" aria-hidden="true"></i> Condicionamento Físico</h6>
                            </div>   
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group mb-0">
                                    <label>Pratica corrida ou caminhada?</label>
                                    <br>
                                    <label class="fancy-radio">
                                        <input type="radio" name="gender" value="male" required="" data-parsley-errors-container="#error-radio" data-parsley-multiple="gender">
                                        <span><i></i>Sim</span>
                                    </label>
                                    <label class="fancy-radio">
                                        <input type="radio" name="gender" value="female" data-parsley-multiple="gender">
                                        <span><i></i>Não</span>
                                    </label>
                                    <p id="error-radio"></p>
                                </div>
                                <div class="form-group mt-0">
                                    <label for="nome">Distância média feita por semana (caminhada + corrida) (Indicar em km)</label><span class="text-danger"> Obrigatório</span>
                                    <input type="text" name="nome" id="nome" value="" class="form-control w-1" required style="width: 10%;">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Faz Musculação?</label>
                                    <br>
                                    <label class="fancy-radio">
                                        <input type="radio" name="gender" value="male" required="" data-parsley-errors-container="#error-radio" data-parsley-multiple="gender">
                                        <span><i></i>Sim</span>
                                    </label>
                                    <label class="fancy-radio">
                                        <input type="radio" name="gender" value="female" data-parsley-multiple="gender">
                                        <span><i></i>Não</span>
                                    </label>
                                    <p id="error-radio"></p>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <h6 class="text-success"><i class="fa fa-tachometer text-success" aria-hidden="true"></i> Experiência em Trilhas</h6>
                            </div>  
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Já fez trilhas anteriormente?</label>
                                    <br>
                                    <label class="fancy-radio">
                                        <input type="radio" name="gender" value="male" required="" data-parsley-errors-container="#error-radio" data-parsley-multiple="gender">
                                        <span><i></i>Sim</span>
                                    </label>
                                    <label class="fancy-radio">
                                        <input type="radio" name="gender" value="female" data-parsley-multiple="gender">
                                        <span><i></i>Não</span>
                                    </label>
                                    <p id="error-radio"></p>
                                </div>
                            </div>  
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Já fez trilhas na areia?</label>
                                    <br>
                                    <label class="fancy-radio">
                                        <input type="radio" name="gender" value="male" required="" data-parsley-errors-container="#error-radio" data-parsley-multiple="gender">
                                        <span><i></i>Sim</span>
                                    </label>
                                    <label class="fancy-radio">
                                        <input type="radio" name="gender" value="female" data-parsley-multiple="gender">
                                        <span><i></i>Não</span>
                                    </label>
                                    <p id="error-radio"></p>
                                </div>
                            </div>   
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Já fez trilhas com travessias de rio?</label>
                                    <br>
                                    <label class="fancy-radio">
                                        <input type="radio" name="gender" value="male" required="" data-parsley-errors-container="#error-radio" data-parsley-multiple="gender">
                                        <span><i></i>Sim</span>
                                    </label>
                                    <label class="fancy-radio">
                                        <input type="radio" name="gender" value="female" data-parsley-multiple="gender">
                                        <span><i></i>Não</span>
                                    </label>
                                    <p id="error-radio"></p>
                                </div>
                            </div>   
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Tem medo/fobia de altura?</label>
                                    <br>
                                    <label class="fancy-radio">
                                        <input type="radio" name="gender" value="male" required="" data-parsley-errors-container="#error-radio" data-parsley-multiple="gender">
                                        <span><i></i>Sim</span>
                                    </label>
                                    <label class="fancy-radio">
                                        <input type="radio" name="gender" value="female" data-parsley-multiple="gender">
                                        <span><i></i>Não</span>
                                    </label>
                                    <p id="error-radio"></p>
                                </div>
                            </div>   
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Tem experiência em <i>trekking</i>?</label>
                                    <br>
                                    <label class="fancy-radio">
                                        <input type="radio" name="gender" value="male" required="" data-parsley-errors-container="#error-radio" data-parsley-multiple="gender">
                                        <span><i></i>Sim</span>
                                    </label>
                                    <label class="fancy-radio">
                                        <input type="radio" name="gender" value="female" data-parsley-multiple="gender">
                                        <span><i></i>Não</span>
                                    </label>
                                    <p id="error-radio"></p>
                                </div>
                            </div>  
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="email">Em relação à distância das trilhas</label><span class="text-danger"> Obrigatório</span>
                                    <select name="escala_distancia" id="escala_distancia" class="form-control" data-parsley-errors-container="#error-sexo" required>
                                        <option value="">Selecione uma opção</option>
                                        
                                    </select>
                                </div>
                            </div>  
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="email">Em relação à elevação das trilhas</label><span class="text-danger"> Obrigatório</span>
                                    <select name="escala_elevacao" id="escala_elevacao" class="form-control" data-parsley-errors-container="#error-sexo" required>
                                        <option value="">Selecione uma opção</option>
                                        
                                    </select>
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

            $('#altura').mask('9.99', {reverse: true});
            $('#peso').mask("#,##0.0", {reverse: true});

            var drEvent = $('#dropify-event').dropify();

            drEvent.on('dropify.afterClear', function(event, element) {
                $('#imagem_deletada').val(true);
            });
        });
    </script>
@endsection
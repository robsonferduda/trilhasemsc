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
                                    <input type="text" name="altura" id="altura" value="{{ ($questionario and $questionario->nu_altura_que) ? $questionario->nu_altura_que : old("altura") }}" class="form-control" required>
                                    <p class="text-info">Digite somente números</p>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="nome">Peso</label><span class="text-danger"> Obrigatório</span>
                                    <input type="text" name="peso" id="peso" value="{{ ($questionario and $questionario->nu_peso_que) ? number_format($questionario->nu_peso_que, 1)  : old("peso") }}" class="form-control" required>
                                    <p class="text-info">Digite somente números</p>
                                </div>
                            </div> 
                            <hr/>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <h6 class="text-danger"><i class="fa fa-heartbeat text-danger" aria-hidden="true"></i> Condicionamento Físico</h6>
                            </div>  
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="email">Pratica corrida ou caminhada?</label><span class="text-danger"> Obrigatório</span>
                                    <select name="escala_corrida" id="escala_corrida" class="form-control" data-parsley-errors-container="#error-corrida" required>
                                        <option value="">Selecione uma opção</option>
                                        @foreach($corridas as $key => $corrida)
                                            <option value="{{ $corrida->cd_corrida_cor }}" {{ ($questionario and $questionario->corrida and $questionario->cd_corrida_cor == $corrida->cd_corrida_cor) ? 'selected' : '' }}>{{ $corrida->ds_corrida_cor }}</option> 
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mt-0">
                                    <label for="nu_distancia">Distância média feita por semana (caminhada + corrida) (Indicar em km)</label><span class="text-danger"> Obrigatório</span>
                                    <input type="number" name="nu_distancia" id="nu_distancia" value="{{ ($questionario and $questionario->nu_distancia_que) ? $questionario->nu_distancia_que : old("nu_distancia") }}" class="form-control w-1" required style="width: 10%;">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Faz Musculação?</label>
                                    <br>
                                    <label class="fancy-radio">
                                        <input type="radio" name="fl_musculacao_que" value="true" {{ ($questionario and $questionario->fl_musculacao_que) ? 'checked' : '' }} required data-parsley-errors-container="#error-radio-musculacao" data-parsley-multiple="fl_musculacao_que">
                                        <span><i></i>Sim</span>
                                    </label>
                                    <label class="fancy-radio">
                                        <input type="radio" name="fl_musculacao_que" value="false" {{ ($questionario and !$questionario->fl_musculacao_que) ? 'checked' : '' }}  data-parsley-multiple="fl_musculacao_que">
                                        <span><i></i>Não</span>
                                    </label>
                                    <p id="error-radio-musculacao"></p>
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
                                        <input type="radio" name="fl_trilhas" value="true" {{ ($questionario and $questionario->fl_trilhas_que) ? 'checked' : '' }} required data-parsley-errors-container="#error-radio-trilhas" data-parsley-multiple="fl_trilhas">
                                        <span><i></i>Sim</span>
                                    </label>
                                    <label class="fancy-radio">
                                        <input type="radio" name="fl_trilhas" value="false" {{ ($questionario and !$questionario->fl_trilhas_que) ? 'checked' : '' }} data-parsley-multiple="fl_trilhas">
                                        <span><i></i>Não</span>
                                    </label>
                                    <p id="error-radio-trilhas"></p>
                                </div>
                            </div>  
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Já fez trilhas na areia?</label>
                                    <br>
                                    <label class="fancy-radio">
                                        <input type="radio" name="fl_areia" value="true" {{ ($questionario and $questionario->fl_areia_que) ? 'checked' : '' }} required data-parsley-errors-container="#error-radio-areia" data-parsley-multiple="fl_areia">
                                        <span><i></i>Sim</span>
                                    </label>
                                    <label class="fancy-radio">
                                        <input type="radio" name="fl_areia" value="false" {{ ($questionario and !$questionario->fl_areia_que) ? 'checked' : '' }} data-parsley-multiple="fl_areia">
                                        <span><i></i>Não</span>
                                    </label>
                                    <p id="error-radio-areia"></p>
                                </div>
                            </div>   
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Já fez trilhas com travessias de rio?</label>
                                    <br>
                                    <label class="fancy-radio">
                                        <input type="radio" name="fl_travessia" value="true" {{ ($questionario and $questionario->fl_travessia_que) ? 'checked' : '' }} required data-parsley-errors-container="#error-radio-travessia" data-parsley-multiple="fl_travessia">
                                        <span><i></i>Sim</span>
                                    </label>
                                    <label class="fancy-radio">
                                        <input type="radio" name="fl_travessia" value="false" {{ ($questionario and !$questionario->fl_travessia_que) ? 'checked' : '' }} data-parsley-multiple="fl_travessia">
                                        <span><i></i>Não</span>
                                    </label>
                                    <p id="error-radio-travessia"></p>
                                </div>
                            </div>   
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Tem medo/fobia de altura?</label>
                                    <br>
                                    <label class="fancy-radio">
                                        <input type="radio" name="fl_altura" value="true" {{ ($questionario and $questionario->fl_altura_que) ? 'checked' : '' }} required data-parsley-errors-container="#error-radio-altura" data-parsley-multiple="fl_altura">
                                        <span><i></i>Sim</span>
                                    </label>
                                    <label class="fancy-radio">
                                        <input type="radio" name="fl_altura" value="false" {{ ($questionario and !$questionario->fl_altura_que) ? 'checked' : '' }}  data-parsley-multiple="fl_altura">
                                        <span><i></i>Não</span>
                                    </label>
                                    <p id="error-radio-altura"></p>
                                </div>
                            </div>   
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Tem experiência em <i>trekking</i>?</label>
                                    <br>
                                    <label class="fancy-radio">
                                        <input type="radio" name="fl_trekking" value="true" {{ ($questionario and $questionario->fl_trekking_que) ? 'checked' : '' }} required data-parsley-errors-container="#error-radio-trekking" data-parsley-multiple="fl_trekking">
                                        <span><i></i>Sim</span>
                                    </label>
                                    <label class="fancy-radio">
                                        <input type="radio" name="fl_trekking" value="false" {{ ($questionario and !$questionario->fl_trekking_que) ? 'checked' : '' }} data-parsley-multiple="fl_trekking">
                                        <span><i></i>Não</span>
                                    </label>
                                    <p id="error-radio-trekking"></p>
                                </div>
                            </div>  
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="email">Em relação à distância das trilhas</label><span class="text-danger"> Obrigatório</span>
                                    <select name="escala_distancia" id="escala_distancia" class="form-control" data-parsley-errors-container="#error-sexo" required>
                                        <option value="">Selecione uma opção</option>
                                        @foreach($distancias as $key => $distancia)
                                            <option value="{{ $distancia->cd_distancia_dis }}" {{ ($questionario and $questionario->distancia and $questionario->cd_distancia_dis == $distancia->cd_distancia_dis) ? 'selected' : '' }}>{{ $distancia->ds_distancia_dis }}</option> 
                                        @endforeach
                                    </select>
                                </div>
                            </div>  
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="email">Em relação à elevação das trilhas</label><span class="text-danger"> Obrigatório</span>
                                    <select name="escala_elevacao" id="escala_elevacao" class="form-control" data-parsley-errors-container="#error-sexo" required>
                                        <option value="">Selecione uma opção</option>
                                        @foreach($elevacoes as $key => $elevacao)
                                            <option value="{{ $elevacao->cd_elevacao_ele }}" {{ ($questionario and $questionario->elevacao and $questionario->cd_elevacao_ele == $elevacao->cd_elevacao_ele) ? 'selected' : '' }}>{{ $elevacao->ds_elevacao_ele }}</option> 
                                        @endforeach
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
            $('#peso').mask("#,###.#", {reverse: true});

            var drEvent = $('#dropify-event').dropify();

            drEvent.on('dropify.afterClear', function(event, element) {
                $('#imagem_deletada').val(true);
            });
        });
    </script>
@endsection
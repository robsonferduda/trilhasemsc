@extends('layouts.site')
@section('pageTitle','Cadastro de Guias e Condutores')
@section('description', 'Guia de trilhas e camping em Santa Catarina, trazendo informações de localização, trajetos e grau de dificuldade para quem quer conhecer e desfrutar das praias, serras e montanhas desse belo estado do Sul do Brasil' )

@section('content')
<div class="row mt-n6 mb-5">
    <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
        <div class="card z-index-0">
            <div class="card-header text-center pt-4 mt-2 mb-0 pb-0">
              <h5>Cadastre-se no Trilhas em SC</h5>
           </div>
           <div class="card-body">
               @include('layouts/mensagens-novo')
                <form action="{{ url('cadastro/privado/escolher-perfil') }}" method="post" >
                    @csrf
                    <div class="row center">
                        <div class="row"> 
                            <div class="col-xl-12 col-lg-12 col-md-12">
                               <p class="center"><strong>Escolha sua atividade</strong></p>
                            </div>
                         </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 ml-0 mr-0">
                           <label class="custom-radio-button__container w-45">
                              <input class="tipo_cadastro" type="radio" name="tipo_cadastro" value="guia" {{ (old('tipo_cadastro') and old('tipo_cadastro') == 'guia') ? 'checked' : '' }}>
                              <span class="custom-radio-button designer">

                                 <div class="svg-designer"><i class="fa fa-id-card-o" aria-hidden="true"></i></div>
                                 
                                <h5>Guia/Condutor</h5>
                              </span>
                            </label>
         
                            <label class="custom-radio-button__container w-45">
                              <input class="tipo_cadastro" type="radio" name="tipo_cadastro" value="trilheiro" {{ (old('tipo_cadastro') and old('tipo_cadastro') == 'trilheiro') ? 'checked' : '' }}>
                              <span class="custom-radio-button">
                                 <div class="svg-designer"><i class="fa fa-map" aria-hidden="true"></i></div>
                                <h5>Trilheiro</h5>
                              </span>
                            </label>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn bg-gradient-dark w-40 my-4 mb-2 btn-cadastrar">Finalizar Cadastro</button>
                         </div>
                    </div>
                </form>
           </div>
        </div>
     </div>
</div>
@endsection
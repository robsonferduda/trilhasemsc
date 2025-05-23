@extends('layouts.site')
@section('pageTitle', '{{ $camping->ds_nome_cam }}' )
@section('description', "")
@section('content')
<header class="position-relative">
    <div class="container">
        <div class="row bg-white shadow mt-n5 border-radius-lg pb-3 p-3 mx-sm-0 mx-1 position-relative">
            <div class="col-md-12 z-index-2 position-relative px-md-2 px-sm-5 mt-sm-0 mt-4 text-center">
                <h2 class="mt-2">{{ $camping->ds_nome_cam }}</h2>
                <h5><i class="ni ni-pin-3 text-danger mb-1"></i> {{ $camping->cidade->nm_cidade_cde }}</h5>
            </div>
       </div>
    </div>
 </header>
<section class="pt-1 pb-0 mt-3 mb-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-2">
                <div class="col-md-12">
                    <a href="#"><img class="border-radius-xl shadow w-100" src="{{ $camping->ds_capa_cam }}" alt=""></a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-9 mt-2">
                <div class="row">
                    <div class="col-md-9 mt-3">
                        <h4 class="mt-2">{{ $camping->ds_nome_cam }}</h4>
                        <h6>
                            <i class="ni ni-pin-3 text-danger"></i> {{ $camping->cidade->nm_cidade_cde }} 
                            <span class=""><a href="https://www.instagram.com/trilhasemsc/?hl=pt-br" target="_BLANK" style="color: #e73177;"><i class="fa fa-instagram" aria-hidden="true"></i> @trilhasemsc</a></span>
                        </h6>                  
                    </div> 
                    <div class="col-md-3 mt-3">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 center">
                                <img src="{{ url('img/icon/'.$camping->tipo->ds_img_tic) }}" alt="Ícone indicador de camping {{ ucfirst(trans($camping->tipo->ds_tipo_tic)) }}" class="img w-25">
                            </div>
                            <div class="col-lg-12 col-md-12 center">
                                <p class="my-auto mx-auto" style="font-weight: bold;">{{ $camping->tipo->ds_tipo_tic }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-1">
                    <p class="mb-1">
                        (Fique sempre atento à data de atualização dos textos. Eles são feitos com base em nossas trilhas e podem estar desatualizados em razão do tempo da última visita.)
                    </p> 
                    <p class="text-info mb-0"><i class="fa fa-info" aria-hidden="true"></i> Última atualização em 27 de agosto de 2022</p>
                    <p class="text-danger mb-0"><i class="fa fa-trash" aria-hidden="true"></i> Não jogue lixo</p>
                    <p class="text-warning mb-1"><i class="fa fa-fire" aria-hidden="true"></i> Não faça fogueiras em locais proibidos</p>
                    <p class="text-success mb-2"><i class="fa fa-leaf" aria-hidden="true"></i> Proteja a natureza e os animais selvagens</p>                 
                    <div class="mt-0 conteudo">
                        {!! nl2br($camping->ds_descricao_cam) !!}                        
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12" style="text-align: center">
                            <h5 class="mb-2 mt-2">Gostou do conteúdo?</h5>                          
                            <p class="mb-2">Que tal nos pagar um café?</p>
                            <a href="https://pag.ae/7-dSqqaS8" class="btn btn-sm bg-gradient-info btn-round mb-0 me-1"><i class="fa fa-coffee" style="font-size: 12px;" aria-hidden="true"></i> Pagar um café!</a>                            
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12" style="text-align: center">
                            <h5 class="mb-2 mt-2">Também pode ser um PIX</h5>   
                            <p class="mb-2">Chave: trilhasemsc@gmail.com</p>     
                            <img class="mx-auto" src="{{ asset('img/qrcode.png') }}" style="width: 80%;" alt="PIX TrilhasemSC">                                              
                        </div>
                        <!--
                            <div class="col-lg-12 col-md-12 mt-5">
                                <p><i class="fa fa-road text-success"></i> <strong>Distância</strong>: </p>
                                <p><i class="fa fa-clock-o text-info"></i> <strong>Duração</strong>: </p>
                                <p><i class="fa fa-sun text-warning"></i> <strong>Exposição</strong>: </p>
                                <p><i class="fa fa-heartbeat text-danger"></i> <strong>Esforço</strong>: </p>
                                <p><i class="fa fa-compass text-info"></i> <strong>Orientação</strong>: </p>
                                <p><a href="{{ url('guia-de-dificuldade-em-trilhas/abnt') }}">Clique e entenda as medidas</a></p>
                            </div>
                        -->
                    </div>
                </div>
               
                @include('layouts/partes/publicidade-google')
                <div class="row mb-3">
                    <div class="col-lg-12 col-sm-12 mb-sm-0 mb-4">
                       <div class="info-horizontal bg-gradient-primary border-radius-lg p-3">
                          <i class="ni ni-calendar-grid-58 h4 text-white icon"></i>
                          <div class="description ps-3">
                             <h5 class="text-white">Atualização das Informações</h5>
                             <p class="text-white">Fique sempre atento à data de atualização dos textos. Os textos são feitos com base em nossas trilhas e podem estar desatualizados em razão do tempo da última visita.</p>
                          </div>
                       </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-sm-12 mb-sm-0 mb-4">
                        <div class="info-horizontal bg-gradient-info border-radius-lg p-3">
                           <i class="ni ni-compass-04 h4 text-white icon"></i>
                           <div class="description ps-3">
                              <h5 class="text-white">Contrate um Condutor</h5>
                              <p class="text-white">Sempre que visitar um local desconhecido, procure por condutores locais autorizados. Faça turismo seguro.</p>
                              <a href="{{ url('guias-e-condutores') }}">Lista de Condutores</a>
                           </div>
                        </div>
                     </div>
                 </div>    
            </div>
            <div class="col-md-3">            
                <div class="col-lg-12 mt-4">
                    <h4 class="mt-0">Busca por Cidade</h4>                    
                        <label class="" style="font-size: 100%; margin: 0px;">Selecione a cidade</label>
                        <p class="mt-0 text-danger" style="font-size: 85%;">São mostradas somente cidades que possuem alguma trilha cadastrada.</p>
                        <select class="form-control mb-0" name="cidade" id="list-cidade">
                           <option value="">Selecione a cidade</option>
                           @if(isset($busca_cidade))
                              @forelse($busca_cidade as $busca)
                                 <option value="{{ url(stringToStringSeo($busca->cidade->nm_cidade_cde).'/trilhas/#lista') }}">{{ $busca->cidade->nm_cidade_cde }} ({{ $busca->total }})</option>
                              @empty
                                 <option selected value="">Nenhuma cidade disponível</option>
                              @endforelse
                           @endif
                        </select>
                        @include('layouts/partes/publicidade-google')
                </div>
            </div>         
       </div>
       <div class="row">
            <div class="col-md-9 mt-2">
            <!-- @env('production')
                <ins class="adsbygoogle"
                    style="display:block"
                    data-ad-client="ca-pub-1229685353625953"
                    data-ad-slot="7739149091"
                    data-ad-format="auto"
                    data-full-width-responsive="true"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>                
            @endenv -->
            </div>
       </div>
    </div>
 </section>
@endsection
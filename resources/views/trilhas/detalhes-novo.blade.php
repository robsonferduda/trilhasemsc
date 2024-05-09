@extends('layouts.site')
@section('pageTitle', $trilha->nm_trilha_tri )
@section('description', strip_tags(html_entity_decode(substr($trilha->ds_trilha_tri, 0, strpos($trilha->ds_trilha_tri, chr(10) ) - 1))) )
@section('content')
@php 
    $img = ($trilha->foto->where('id_tipo_foto_tfo',5)->first()) ? $trilha->foto->where('id_tipo_foto_tfo',5)->first()->nm_path_fot : 'padrao.jpg';
    $alt = ($trilha->foto->where('id_tipo_foto_tfo',5)->first()) ? $trilha->foto->where('id_tipo_foto_tfo',5)->first()->dc_alt_fot : 'Foto Principal da Trilha';
@endphp
@include('layouts/partes/header-trilhas-detalhes')
<section class="pt-1 pb-0 mt-3 mb-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-2">
                <div class="col-md-12">
                    <a href="#"><img class="border-radius-xl shadow w-100" src="{{ asset('img/trilhas/detalhes-principal/'.$img) }}" alt="{{ $alt }}"></a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-9 mt-2">
                <div class="col-md-12 mt-3">
                    <h4 class="mt-2">{{ $trilha->nm_trilha_tri }}</h4>
                    <h6>
                        <i class="ni ni-pin-3 text-danger"></i> {{ $trilha->cidade->nm_cidade_cde }} 
                        <span class=""><a href="https://www.instagram.com/trilhasemsc/?hl=pt-br" target="_BLANK" style="color: #e73177;"><i class="fa fa-instagram" aria-hidden="true"></i> @trilhasemsc</a></span>
                    </h6>
                    <p class="mb-1"><span class="text-success">Trilha cadastrada em {{ \Carbon\Carbon::parse($trilha->created_at)->format('d/m/Y') }}</span></p>
                    <p class="mb-1"><span class="text-primary">Última atualização em {{ \Carbon\Carbon::parse($trilha->updated_at)->format('d/m/Y') }}</span>
                        (Fique sempre atento à data de atualização dos textos. Eles são feitos com base em nossas trilhas e podem estar desatualizados em razão do tempo da última visita.)
                    </p>
                    <p class="text-info">
                        Sempre que visitar um local desconhecido, procure por condutores locais autorizados. Faça turismo seguro!
                    </p>            
                    @env('production')
                        <ins class="adsbygoogle"
                                        style="display:block"
                                        data-ad-client="ca-pub-1229685353625953"
                                        data-ad-slot="7739149091"
                                        data-ad-format="auto"
                                        data-full-width-responsive="true"></ins>
                                    <script>
                                        (adsbygoogle = window.adsbygoogle || []).push({});
                                    </script>
                    @endenv
                    <div class="mt-2 conteudo">
                        {!! $trilha->ds_trilha_tri !!}
                    </div>
                </div> 
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-12 position-relative my-auto justify-content-center text-center">
                            <img class="mx-auto" src="{{ asset('img/trilhas/nivel/'.$trilha->nivel->dc_icone_niv) }}" alt="Grau de dificuldade da trilha {{ $trilha->nivel->dc_nivel_niv }}">
                            <span style="color: white; background: {{ ($trilha->nivel) ? $trilha->nivel->dc_color_nivel_niv : '#989898' }};" class="badge badge-secondary">{{ $trilha->nivel->dc_nivel_niv }} {{ ($trilha->complemento) ? " - ".$trilha->complemento->nm_complemento_nivel_con : '' }}</span>
                            <p class="mt-3"><a href="{{ url('guia-de-dificuldade-em-trilhas/abnt') }}">Clique e entenda as medidas</a></p>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-12" style="text-align: right">
                            <h5 class="mb-2 mt-2">Gostou do conteúdo?</h5>                          
                            <p class="mb-2">Que tal nos pagar um café?</p>

                            <a href="https://pag.ae/7-dSqqaS8" class="btn btn-sm bg-gradient-info btn-round mb-0 me-1"><i class="fa fa-coffee" style="font-size: 12px;" aria-hidden="true"></i> Pagar um café!</a>
                            
                        </div>
                        <!--
                            <div class="col-lg-12 col-md-12 mt-5">
                                <p><i class="fa fa-road text-success"></i> <strong>Distância</strong>: </p>
                                <p><i class="fa fa-clock-o text-info"></i> <strong>Tempo Médio</strong>: </p>
                                <p><i class="fa fa-sun text-warning"></i> <strong>Exposição</strong>: </p>
                                <p><i class="fa fa-heartbeat text-danger"></i> <strong>Esforço</strong>: </p>
                                <p><i class="fa fa-compass text-info"></i> <strong>Orientação</strong>: </p>
                                <p><a href="{{ url('guia-de-dificuldade-em-trilhas/abnt') }}">Clique e entenda as medidas</a></p>
                            </div>
                        -->
                    </div>
                </div>
                    
                <div class="col-md-12 mt-2 mb-3">
                    <h4 class="text-success">
                        Use o Wikiloc
                    </h4>
                    <div class="geolocalizao">
                        {!! $trilha->url_geolocalizacao_tri !!}
                    </div>
                </div>
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
                        <ul class="flex-column ms-n3 nav">
                            @foreach($busca_cidade as $busca)
                                <li class="nav-item">
                                    <a class="nav-link text-secondary" href="{{url(stringToStringSeo($busca->cidade->nm_cidade_cde).'/trilhas/#lista')}}">
                                        <h6>{{ $busca->cidade->nm_cidade_cde }} ({{ $busca->total }})</h6>
                                    </a>
                                </li>
                            @endforeach
                      </ul>
                </div>
            </div>         
       </div>
       <div class="row">
        @env('production')
            <ins class="adsbygoogle"
                style="display:block"
                data-ad-client="ca-pub-1229685353625953"
                data-ad-slot="7739149091"
                data-ad-format="auto"
                data-full-width-responsive="true"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        @endenv
       </div>
    </div>
 </section>
@endsection
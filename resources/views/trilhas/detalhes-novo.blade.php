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
            <div class="col-md-9 mt-2">
                <div class="col-md-12">
                    <a href="#"><img class="border-radius-xl shadow w-100" src="{{ asset('img/trilhas/detalhes-principal/'.$img) }}" alt="{{ $alt }}"></a>
                </div>
            </div>
            <div class="col-md-3 mt-2">
                <div class="col-lg-12 col-md-12 position-relative my-auto justify-content-center text-center">
                    <img class="mx-auto" src="{{ asset('img/trilhas/nivel/'.$trilha->nivel->dc_icone_niv) }}" alt="Grau de dificuldade da trilha {{ $trilha->nivel->dc_nivel_niv }}">
                    <span style="color: white; background: {{ ($trilha->nivel) ? $trilha->nivel->dc_color_nivel_niv : '#989898' }};" class="badge badge-secondary">{{ $trilha->nivel->dc_nivel_niv }} {{ ($trilha->complemento) ? " - ".$trilha->complemento->nm_complemento_nivel_con : '' }}</span>
                </div>
                <div class="col-lg-12 col-md-12 mt-5">
                    <p><i class="fa fa-road text-success"></i> <strong>Distância</strong>: </p>
                    <p><i class="fa fa-clock-o text-info"></i> <strong>Tempo Médio</strong>: </p>
                    <p><i class="fa fa-sun text-warning"></i> <strong>Exposição</strong>: </p>
                    <p><i class="fa fa-heartbeat text-danger"></i> <strong>Esforço</strong>: </p>
                    <p><i class="fa fa-compass text-info"></i> <strong>Orientação</strong>: </p>
                    <p><a href="{{ url('guia-de-dificuldade-em-trilhas/abnt') }}">Clique e entenda as medidas</a></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-9 mt-2">
                <div class="col-md-12 mt-3">
                    <h4 class="mt-2">{{ $trilha->nm_trilha_tri }}</h4>
                    <h6><i class="ni ni-pin-3 text-danger"></i>{{ $trilha->cidade->nm_cidade_cde }} </h6>
                    <p class="mb-1"><span class="text-success">Trilha cadastrada em {{ \Carbon\Carbon::parse($trilha->created_at)->format('d/m/Y') }}</span></p>
                    <p class="mb-1"><span class="text-info">Última atualização em {{ \Carbon\Carbon::parse($trilha->updated_at)->format('d/m/Y') }}</span></p>
                    <p><span class="text-danger">
                        <span style="color: white; background: #a94442;" class="badge badge-secondary">Atenção!</span>
                                            Fique sempre atento à data de atualização dos textos. 
                                            Os textos são feitos com base em nossas trilhas e podem estar desatualizados em razão do tempo da última visita.</span>
                    </p>
                    <ins class="adsbygoogle"
                                        style="display:block"
                                        data-ad-client="ca-pub-1229685353625953"
                                        data-ad-slot="7739149091"
                                        data-ad-format="auto"
                                        data-full-width-responsive="true"></ins>
                                    <script>
                                        (adsbygoogle = window.adsbygoogle || []).push({});
                                    </script>
                    <div class="mt-2">
                        {!! $trilha->ds_trilha_tri !!}
                    </div>
                </div> 
                <div class="col-md-12 mt-2">
                    <h4 class="text-success">
                        Use o Wikiloc
                    </h4>
                    {!! $trilha->url_geolocalizacao_tri !!}
                </div>
            </div>
            <div class="col-md-3">            
                <div class="col-lg-12 mt-3">
                    <h4 class="mt-0">Busca por Cidade</h4>
                    @foreach($busca_cidade as $busca)
                        <a href="{{url(stringToStringSeo($busca->cidade->nm_cidade_cde).'/trilhas/#lista')}}">
                            <div class="card justify-content-center mb-3">
                            <div class="card-body p-3">
                            <h6 class="mb-0">{{ $busca->cidade->nm_cidade_cde }} ({{ $busca->total }})</h6>
                            </div>
                            <div class="position-absolute end-0 me-3 ">
                            <i class="fas fa-angle-right text-dark" aria-hidden="true"></i>
                            </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>         
       </div>
       <div class="row">
        <ins class="adsbygoogle"
            style="display:block"
            data-ad-client="ca-pub-1229685353625953"
            data-ad-slot="7739149091"
            data-ad-format="auto"
            data-full-width-responsive="true"></ins>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
       </div>
    </div>
 </section>
@endsection
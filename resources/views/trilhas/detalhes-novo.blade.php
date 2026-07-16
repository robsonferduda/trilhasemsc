@extends('layouts.site')
@php 
    $img = ($trilha->foto->where('id_tipo_foto_tfo',5)->first()) ? $trilha->foto->where('id_tipo_foto_tfo',5)->first()->nm_path_fot : 'padrao.jpg';
    $alt = ($trilha->foto->where('id_tipo_foto_tfo',5)->first()) ? $trilha->foto->where('id_tipo_foto_tfo',5)->first()->dc_alt_fot : 'Foto Principal da Trilha';
    $descricaoBase = trim(preg_replace('/\s+/', ' ', strip_tags(html_entity_decode($trilha->ds_trilha_tri ?? ''))));
    $descricaoSeo = \Illuminate\Support\Str::limit($descricaoBase, 160, '...');
    $cidadeSeo = optional($trilha->cidade)->nm_cidade_cde;
    $pageTitleSeo = $cidadeSeo
        ? $trilha->nm_trilha_tri . ' - ' . $cidadeSeo . ' | Trilhas em Santa Catarina'
        : $trilha->nm_trilha_tri . ' | Trilhas em Santa Catarina';
    $metaImageUrl = asset('img/trilhas/detalhes-principal/'.$img);
    $homeUrl = url('/');
    $trilhasUrl = url('trilhas');
@endphp
@section('pageTitle', $pageTitleSeo)
@section('description', $descricaoSeo)
@section('canonical', url()->current())
@section('metaImage', $metaImageUrl)
@section('ogType', 'article')
@section('keywords', 'trilha, aventura, ' . ($cidadeSeo ? strtolower($cidadeSeo) . ', ' : '') . 'santa catarina, trilhas em sc')
@section('structuredData')
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'Article',
    'headline' => $trilha->nm_trilha_tri,
    'description' => $descricaoSeo,
    'datePublished' => optional($trilha->created_at)->toAtomString(),
    'dateModified' => optional($trilha->updated_at)->toAtomString(),
    'mainEntityOfPage' => [
        '@type' => 'WebPage',
        '@id' => url()->current(),
    ],
    'image' => [$metaImageUrl],
    'author' => [
        '@type' => 'Person',
        'name' => optional($trilha->user)->name ?: 'Trilhas em Santa Catarina',
    ],
    'publisher' => [
        '@type' => 'Organization',
        'name' => 'Trilhas em Santa Catarina',
        'logo' => [
            '@type' => 'ImageObject',
            'url' => asset('img/apple-icon.png'),
        ],
    ],
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
</script>
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'BreadcrumbList',
    'itemListElement' => [
        [
            '@type' => 'ListItem',
            'position' => 1,
            'name' => 'Início',
            'item' => $homeUrl,
        ],
        [
            '@type' => 'ListItem',
            'position' => 2,
            'name' => 'Trilhas',
            'item' => $trilhasUrl,
        ],
        [
            '@type' => 'ListItem',
            'position' => 3,
            'name' => $trilha->nm_trilha_tri,
            'item' => url()->current(),
        ],
    ],
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
</script>
@endsection
@section('content')
@include('layouts/partes/header-trilhas-detalhes')
<section class="pt-1 pb-0 mt-3 mb-5">
    <div class="container">
        <div class="row">
            @if($trilha->detalhes)
                <div class="col-lg-9 col-md-9 col-sm-12 mt-2">
                    <div class="col-md-12">
                        <img class="border-radius-xl shadow w-100" src="{{ asset('img/trilhas/detalhes-principal/'.$img) }}" alt="{{ $alt }}" loading="eager" fetchpriority="high">
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 mt-2">
                    <div class="center mt-3">
                        <img class="mx-auto" src="{{ asset('img/trilhas/nivel/'.$trilha->nivel->dc_icone_niv) }}" alt="Grau de dificuldade da trilha {{ $trilha->nivel->dc_nivel_niv }}">
                        <span style="color: white; background: {{ ($trilha->nivel) ? $trilha->nivel->dc_color_nivel_niv : '#989898' }};" class="badge badge-secondary">{{ $trilha->nivel->dc_nivel_niv }} {{ ($trilha->complemento) ? " - ".$trilha->complemento->nm_complemento_nivel_con : '' }}</span>
                    </div>
                    <div class="mt-5">
                        <p><i class="fa fa-road text-success"></i> <strong>Distância</strong>: {{ $trilha->detalhes->nu_distancia_trd }} km</p>
                        <p><i class="fa fa-clock-o text-info"></i> <strong>Duração</strong>: {{ \Carbon\Carbon::parse($trilha->detalhes->duracao_trd)->format('H:i')}} (Somente ida)</p>
                        <p><i class="fa fa-sun text-warning"></i> <strong>Exposição</strong>: {{ $trilha->detalhes->ds_exposicao_trd }} </p>
                        <p><i class="fa fa-heartbeat text-danger"></i> <strong>Esforço</strong>: {{ $trilha->detalhes->ds_esforco_trd }} </p>
                        <p><i class="fa fa-compass text-info"></i> <strong>Orientação</strong>: {{ $trilha->detalhes->ds_orientacao_trd }} </p>
                        <p><a href="{{ url('guia-de-dificuldade-em-trilhas/abnt') }}">Clique e entenda as medidas</a></p>
                    </div>
                </div>
            @else
                <div class="col-lg-12 col-md-12 col-sm-12 mt-2">
                    <div class="col-md-12">
                        <img class="border-radius-xl shadow w-100" src="{{ asset('img/trilhas/detalhes-principal/'.$img) }}" alt="{{ $alt }}" loading="eager" fetchpriority="high">
                    </div>
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-9 mt-2">
                <div class="col-md-12 mt-3">
                    <h2 class="mt-2 h4">{{ $trilha->nm_trilha_tri }}</h2>
                    <p class="h6 d-flex align-items-center flex-wrap gap-2 mb-0">
                        <span><i class="ni ni-pin-3 text-danger"></i> {{ $trilha->cidade->nm_cidade_cde }}</span>
                        <span><a href="https://www.instagram.com/trilhasemsc/?hl=pt-br" target="_blank" rel="noopener noreferrer" style="color: #e73177;"><i class="fa fa-instagram" aria-hidden="true"></i> trilhasemsc</a></span>
                        <time datetime="{{ \Carbon\Carbon::parse($trilha->updated_at)->toDateString() }}" itemprop="dateModified" class="text-black" style="font-weight: 500;">
                            - Trilha publicada em {{ \Carbon\Carbon::parse($trilha->updated_at)->format('d/m/Y') }}
                        </time>
                    </p>
                </div> 
                @if(count($trilha->guias))
                    <div class="col-md-12 mt-1">
                        <h2 class="h6">Quem faz esta trilha?</h2>
                    </div>                    
                    <div class="row mt-0 mb-0">
                        @foreach($trilha->guias as $key => $guia)
                            <div class="col col-xs-1 col-sm-1 d-sm-block d-md-none mb-3">
                                <a href="{{ url("guia/perfil/estatistica/perfil", $guia->nm_instagram_gui) }}"><img class="avatar avatar-xl shadow-lg rounded-circle mx-auto" src="{{ asset('img/guias/'.$guia->nm_path_logo_gui) }}" alt="Logo Guia {{ $guia->nm_guia_gui }}"></a>
                            </div>
                        @endforeach
                    </div>
                    <div class="row">
                        @foreach($trilha->guias as $key => $guia)
                            <div class="col-sm-1 col-md-2 col-lg-2 d-none d-md-block">
                                <a href="{{ url("guia/perfil/estatistica/perfil", $guia->nm_instagram_gui) }}"><img class="avatar avatar-xxl shadow-lg rounded-circle mx-auto" src="{{ asset('img/guias/'.$guia->nm_path_logo_gui) }}" alt="Logo Guia {{ $guia->nm_guia_gui }}"></a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="h6">Acesse <a class="text-decoration-underline" href="{{ url("guias-e-condutores") }}">aqui</a> os guias e condutores cadastrados em nossa plataforma.</p>
                @endif

                @if(isset($proximosEventos) && $proximosEventos->count())
                    <div class="col-md-12 mt-3 mb-0">
                        <h2 class="h6"><i class="fa fa-calendar text-success mr-1"></i> Próximos Eventos</h2>
                        <div class="d-flex flex-wrap mt-2" style="gap: 12px;">
                            @foreach($proximosEventos as $ev)
                            <a href="{{ $ev->url }}" class="text-decoration-none">
                                <div class="text-center rounded shadow-sm p-2" style="min-width:80px; border:1px solid #e0e0e0; background:#f8f9fa;">
                                    <div class="rounded-top text-white font-weight-bold py-1 px-2" style="background:#28a745; font-size:.75rem; letter-spacing:.5px;">
                                        {{ strtoupper(\Carbon\Carbon::parse($ev->dt_realizacao_eve)->locale('pt_BR')->isoFormat('MMM')) }}
                                    </div>
                                    <div style="font-size:1.6rem; font-weight:700; line-height:1.1; color:#2d2d2d;">
                                        {{ \Carbon\Carbon::parse($ev->dt_realizacao_eve)->format('d') }}
                                    </div>
                                    <div style="font-size:.7rem; color:#666;">
                                        {{ \Carbon\Carbon::parse($ev->dt_realizacao_eve)->format('Y') }}
                                    </div>
                                    <div class="mt-1" style="font-size:.7rem; color:#333; max-width:80px; word-break:break-word; white-space:normal; line-height:1.2;">
                                        {{ \Illuminate\Support\Str::limit($ev->nm_evento_eve, 30) }}
                                    </div>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="col-md-12 mt-2">
                    <h2 class="h6">Detalhes da Aventura</h2>
                    <div class="d-flex align-items-center mb-2">
                        <img src="{{ asset('img/trilheiros/' . ($trilha->user->dc_foto_perfil ?? 'perfil.png')) }}" alt="Foto do usuário {{ $trilha->user->name ?? '' }}" class="rounded-circle me-2" style="width: 40px; height: 40px; object-fit: cover;">
                        <span class="text-secondary">Trilha registrada por {{ $trilha->user->name ?? 'Usuário desconhecido' }} em {{ \Carbon\Carbon::parse($trilha->created_at)->format('d/m/Y') }}, com última atualização em {{ \Carbon\Carbon::parse($trilha->updated_at)->format('d/m/Y') }}</span>
                    </div>    
                    <p class="mb-1 text-danger" style="font-size: 85%;">
                        Fique sempre atento à data de atualização dos textos. Eles são feitos com base em nossas trilhas e podem estar desatualizados em razão do tempo da última visita.
                    </p>  
                    <div class="mt-0 conteudo">
                        {!! $trilha->ds_trilha_tri !!}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12 position-relative my-auto justify-content-center text-center">
                            <img class="mx-auto" src="{{ asset('img/trilhas/nivel/'.$trilha->nivel->dc_icone_niv) }}" alt="Grau de dificuldade da trilha {{ $trilha->nivel->dc_nivel_niv }}">
                            <span style="color: white; background: {{ ($trilha->nivel) ? $trilha->nivel->dc_color_nivel_niv : '#989898' }};" class="badge badge-secondary">{{ $trilha->nivel->dc_nivel_niv }} {{ ($trilha->complemento) ? " - ".$trilha->complemento->nm_complemento_nivel_con : '' }}</span>
                            <p class="mt-3"><a href="{{ url('guia-de-dificuldade-em-trilhas/abnt') }}">Clique e entenda as medidas</a></p>
                        </div>
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
                <div class="col-md-12 mt-2 mb-3">
                    <h2 class="text-success h4">
                        Use o Wikiloc
                    </h2>
                    <div class="geolocalizao">
                        {!! $trilha->url_geolocalizacao_tri !!}
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
                    <h2 class="mt-0 h4">Busca por Cidade</h2>
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
                        @include('layouts/partes/publicidade-aberta-vertical')
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
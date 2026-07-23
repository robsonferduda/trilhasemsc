@extends('layouts.site')
@php
    $cidadeSeo = optional($evento->local)->nm_cidade_cde;
    $guiaSeo = optional($evento->guia)->nm_guia_gui;
    $descricaoBase = trim(preg_replace('/\s+/', ' ', strip_tags(html_entity_decode($evento->descricao ?? ''))));
    $descricaoSeo = $descricaoBase
        ? \Illuminate\Support\Str::limit($descricaoBase, 160, '...')
        : ('Evento de trilha ' . $evento->nm_evento_eve . ($cidadeSeo ? ' em ' . $cidadeSeo : '') . ($guiaSeo ? ' com ' . $guiaSeo : '') . ' | Trilhas em Santa Catarina');
    $pageTitleSeo = $cidadeSeo
        ? $evento->nm_evento_eve . ' - ' . $cidadeSeo . ' | Trilhas em Santa Catarina'
        : $evento->nm_evento_eve . ' | Trilhas em Santa Catarina';
    $canonicalUrl = $evento->url ?: url()->current();
    if ($evento->ds_imagem_horizontal_eve) {
        $metaImageUrl = asset('img/eventos/'.$evento->ds_imagem_horizontal_eve);
    } elseif (optional($evento->guia)->nm_path_logo_gui) {
        $metaImageUrl = asset('img/guias/'.$evento->guia->nm_path_logo_gui);
    } else {
        $metaImageUrl = asset('img/apple-icon.png');
    }
    $homeUrl = url('/');
    $eventosUrl = url('eventos');
    $guiasUrl = url('guias-e-condutores');
    $guiaPerfilUrl = optional($evento->guia)->nm_instagram_gui
        ? url('guia/perfil/'. $evento->guia->nm_instagram_gui)
        : $guiasUrl;
    $startDateIso = $evento->dt_realizacao_eve
        ? \Carbon\Carbon::parse($evento->dt_realizacao_eve)->format('Y-m-d') . ($evento->hora_inicio_eve ? 'T' . \Carbon\Carbon::parse($evento->hora_inicio_eve)->format('H:i:s') : '')
        : null;
    $endDateIso = $evento->dt_termino_eve
        ? \Carbon\Carbon::parse($evento->dt_termino_eve)->format('Y-m-d') . ($evento->hora_fim_eve ? 'T' . \Carbon\Carbon::parse($evento->hora_fim_eve)->format('H:i:s') : '')
        : null;
@endphp
@section('pageTitle', $pageTitleSeo)
@section('description', $descricaoSeo)
@section('canonical', $canonicalUrl)
@section('metaImage', $metaImageUrl)
@section('ogType', 'article')
@section('keywords', 'evento de trilha, ' . ($cidadeSeo ? strtolower($cidadeSeo) . ', ' : '') . 'guias, aventura, santa catarina, trilhas em sc')
@section('headExtra')
<link rel="preload" as="image" href="{{ $metaImageUrl }}" fetchpriority="high">
@endsection
@section('structuredData')
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'Event',
    'name' => $evento->nm_evento_eve,
    'description' => $descricaoSeo,
    'url' => $canonicalUrl,
    'image' => [$metaImageUrl],
    'startDate' => $startDateIso,
    'endDate' => $endDateIso,
    'eventAttendanceMode' => 'https://schema.org/OfflineEventAttendanceMode',
    'eventStatus' => 'https://schema.org/EventScheduled',
    'location' => [
        '@type' => 'Place',
        'name' => $cidadeSeo ?: 'Santa Catarina',
        'address' => [
            '@type' => 'PostalAddress',
            'addressLocality' => $cidadeSeo ?: 'Santa Catarina',
            'addressRegion' => 'SC',
            'addressCountry' => 'BR',
        ],
    ],
    'organizer' => [
        '@type' => 'Person',
        'name' => $guiaSeo ?: 'Trilhas em Santa Catarina',
        'url' => $guiaPerfilUrl,
    ],
    'offers' => [
        '@type' => 'Offer',
        'price' => $evento->valor_eve ? (float) $evento->valor_eve : 0,
        'priceCurrency' => 'BRL',
        'availability' => 'https://schema.org/InStock',
        'url' => $canonicalUrl,
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
            'name' => 'Eventos',
            'item' => $eventosUrl,
        ],
        [
            '@type' => 'ListItem',
            'position' => 3,
            'name' => $evento->nm_evento_eve,
            'item' => $canonicalUrl,
        ],
    ],
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
</script>
@endsection
@section('content')
@include('layouts/partes/header-eventos')
<section class="pt-1 pb-0 mt-3 mb-5">
    <div class="container">
       <div class="row mb-2">
          <div class="col-md-7">
             <h2 class="text-success h3">Eventos e Trilhas em Santa Catarina</h2>
          </div>
       </div>
       <div class="card card-plain card-blog ml-2 mr-2">
            <div class="row">
                <div class="col-lg-12 col-md-12 mt-4 text-center">
                    @if(Auth::user())
                        @if(trim(Auth::user()->id_role) == 'GUIA')
                            <a href="{{ url('guia-e-condutores/privado/eventos') }}" type="button" class="btn btn-outline-danger btn-sm">Meus Eventos</a>
                        @endif
                    @endif
                    @if(Auth::user() and $trilheiro)
                        @if($trilheiro->evento->contains($evento->id_evento_eve))
                            <button type="button" class="btn btn-outline-success btn-sm"><i class="fa fa-check"></i> Presença Confirmada</button>
                            <button type="button" class="btn btn-outline-danger btn-sm" id="btn-cancelar-participacao" data-url="{{ url('trilheiro/privado/eventos/cancelar/'.$evento->id_evento_eve) }}"><i class="fa fa-times"></i> Cancelar Participação</button>
                        @else
                            <a href="{{ url('trilheiro/privado/eventos/participar/'.$evento->id_evento_eve) }}" type="button" class="btn btn-outline-primary btn-sm"><i class="fa fa-check"></i> Participar do Evento</a>
                        @endif
                    @else
                        <a href="{{ url('trilheiro/privado/eventos/participar/'.$evento->id_evento_eve) }}" type="button" class="btn btn-outline-primary btn-sm"><i class="fa fa-check"></i> Participar do Evento</a>
                    @endif
                    <a href="{{ url('eventos') }}" type="button" class="btn btn-outline-info btn-sm">Todos os Eventos</a>
                    <a href="{{ url('/') }}" type="button" class="btn btn-outline-warning btn-sm">Início</a>
                </div>
                <div class="col-lg-2 col-md-2 mt-2 mb-4 position-relative text-center d-xs-block d-sm-block d-md-none">
                    <h2 class="h5">Guia Responsável</h2>
                    @if($evento->guia->nm_path_logo_gui)
                      <img class="avatar avatar-xxl shadow-lg rounded-circle mx-auto" src="{{ asset('img/guias/'.$evento->guia->nm_path_logo_gui) }}" alt="Logo Guia {{ $evento->guia->nm_guia_gui }}" loading="lazy" decoding="async">
                    @else
                      <img class="avatar avatar-xxl shadow-lg rounded-circle mx-auto" src="{{ asset('img/guias/default.png') }}" alt="Logo Guia {{ $evento->guia->nm_guia_gui }}" loading="lazy" decoding="async">
                    @endif
                </div>
                <div class="col-lg-9 col-md-9">
                    <h1 class="h4 text-danger">{{ $evento->nm_evento_eve }}</h1>
                    <p class="mb-1"><strong>Responsável</strong>: <a href="{{ url("guia/perfil/estatistica/perfil", $evento->guia->nm_instagram_gui) }}">{{ $evento->guia->nm_guia_gui }}</a></p>
                    <p class="mb-1"><strong>Cidade</strong>: {{ $evento->local->nm_cidade_cde }}</p>
                    <p class="mb-1"><strong>Data/Horário Início</strong>: {{ \Carbon\Carbon::parse($evento->dt_realizacao_eve)->format('d/m/Y')}} - {{ \Carbon\Carbon::parse($evento->hora_inicio_eve)->format('H:i') }}</p>
                    <p class="mb-1"><strong>Data/Horário Término</strong>: {{ \Carbon\Carbon::parse($evento->dt_termino_eve)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($evento->hora_fim_eve)->format('H:i') }}</p>
                    <p class="mb-1"><strong>Valor</strong>: {!! ($evento->valor_eve) ? "R$ ".$evento->valor_eve : '<strong class="text-success">Gratuita</strong>' !!}</p>
                    <p class="mb-1"><strong>Contato</strong>: {{ $evento->ds_fone_contato_eve }}</p>
                    <p class="small mb-0 mt-2">
                        Explore também:
                        <a href="{{ $eventosUrl }}" class="text-decoration-underline">outros eventos</a>,
                        <a href="{{ $guiaPerfilUrl }}" class="text-decoration-underline">perfil do guia</a>
                        e a lista de
                        <a href="{{ $guiasUrl }}" class="text-decoration-underline">guias e condutores</a>.
                    </p>
                </div>

                <div class="col-lg-3 col-md-3 position-relative text-center d-none d-md-block">
                    <h2 class="h5">Guia Responsável</h2>
                    @if($evento->guia->nm_path_logo_gui)
                      <img class="avatar avatar-xxl shadow-lg rounded-circle mx-auto" src="{{ asset('img/guias/'.$evento->guia->nm_path_logo_gui) }}" alt="Logo Guia {{ $evento->guia->nm_guia_gui }}" loading="lazy" decoding="async">
                    @else
                      <img class="avatar avatar-xxl shadow-lg rounded-circle mx-auto" src="{{ asset('img/guias/default.png') }}" alt="Logo Guia {{ $evento->guia->nm_guia_gui }}" loading="lazy" decoding="async">
                    @endif
                    <a href="{{ url("guia/perfil/estatistica/perfil", $evento->guia->nm_instagram_gui) }}" target="_blank" rel="noopener noreferrer"><h2 class="h6 mt-2">{{ $evento->guia->nm_guia_gui }}</h2></a>
                </div>

                @if($evento->id_trilha_tri && $evento->trilha)
                @php
                    $trilhaVinculada = $evento->trilha;
                    $fotoTrilhaVinculada = $trilhaVinculada->foto->where('id_tipo_foto_tfo', 5)->first();
                @endphp
                <div class="col-md-12 mt-3 mb-2">
                    <a href="{{ url($trilhaVinculada->ds_url_tri) }}" target="_blank" class="text-decoration-none d-block">
                        <div class="rounded overflow-hidden"
                             style="border:1px solid #e3e3e3; background:#fff; transition:box-shadow 0.2s;"
                             onmouseover="this.style.boxShadow='0 4px 18px rgba(0,0,0,0.10)'"
                             onmouseout="this.style.boxShadow='none'">
                            <div class="d-flex align-items-stretch">
                                <div class="flex-shrink-0" style="width:130px; min-height:88px;">
                                    @if($fotoTrilhaVinculada)
                                        <img src="{{ asset('img/trilhas/detalhes-principal/'.$fotoTrilhaVinculada->nm_path_fot) }}"
                                             alt="{{ $trilhaVinculada->nm_trilha_tri }}"
                                             style="width:130px; height:100%; min-height:88px; object-fit:cover; display:block;">
                                    @else
                                        <div class="d-flex align-items-center justify-content-center bg-secondary"
                                             style="width:130px; min-height:88px; height:100%;">
                                            <i class="fa fa-map-signs fa-2x text-white"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="px-3 py-2 flex-grow-1 d-flex flex-column justify-content-center">
                                    <small class="font-weight-bold text-uppercase text-muted"
                                           style="font-size:0.62rem; letter-spacing:0.09em;">Trilha Relacionada</small>
                                    <p class="mb-1 mt-1 font-weight-bold text-dark" style="font-size:0.95rem; line-height:1.3;">
                                        {{ $trilhaVinculada->nm_trilha_tri }}
                                    </p>
                                    @if($trilhaVinculada->nivel)
                                        <div>
                                            <span class="badge"
                                                  style="background:{{ $trilhaVinculada->nivel->dc_color_nivel_niv }}; color:#fff; font-size:0.7rem; padding:3px 8px; border-radius:20px;">
                                                {{ $trilhaVinculada->nivel->dc_nivel_niv }}{{ $trilhaVinculada->complemento ? ' - '.$trilhaVinculada->complemento->nm_complemento_nivel_con : '' }}
                                            </span>
                                        </div>
                                    @endif
                                </div>
                                <div class="d-flex align-items-center pr-3 text-muted">
                                    <i class="fa fa-chevron-right" style="font-size:0.8rem; margin-right:5px;"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endif

                @if($evento->trilheiros && $evento->trilheiros->count() && Auth::check() && trim(Auth::user()->id_role) == 'GUIA' && $evento->guia->id_user == Auth::user()->id)
                    <div class="col-lg-12 col-md-12 mt-3">
                        <h5 class="text-left mb-3">Participantes ({{ $evento->trilheiros->count() }}/{{ $evento->total_participantes_eve }})</h5>
                        <div class="d-flex flex-wrap justify-content-start align-items-start">
                            @foreach($evento->trilheiros as $participante)
                                @php
                                    $fotoPerfil = $participante->nm_path_foto_tri ?: optional($participante->user)->dc_foto_perfil;
                                    $caminhoFotoPerfil = $fotoPerfil ? public_path('img/trilheiros/'.$fotoPerfil) : null;
                                    $fotoPerfilUrl = ($caminhoFotoPerfil && file_exists($caminhoFotoPerfil))
                                        ? asset('img/trilheiros/'.$fotoPerfil)
                                        : asset('img/usuarios/perfil.png');
                                    $primeiroNome = explode(' ', trim($participante->nm_trilheiro_tri))[0];
                                @endphp

                                <div class="text-center mr-3 mb-3" style="margin-right: 10px;">
                                    <img
                                        class="avatar avatar-lg shadow rounded-circle"
                                        src="{{ $fotoPerfilUrl }}"
                                        alt="Foto de perfil {{ $primeiroNome }}"
                                    >
                                    <div class="mt-1">{{ $primeiroNome }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="col-lg-12 col-md-12">
                    <h2 class="h5 text-left mb-3">Descrição da Aventura</h2>
                    {!! nl2br($evento->descricao) !!}
                </div>
                <div class="col-lg-12 col-md-12">
                    @if($evento->ds_imagem_horizontal_eve)
                        <img src="{{ asset('img/eventos/'.$evento->ds_imagem_horizontal_eve) }}" alt="{{ $evento->nm_evento_eve }}" class="img-fluid shadow border-radius-lg" loading="lazy" decoding="async">
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 mt-4 text-center">
            @if(Auth::user())
                @if(trim(Auth::user()->id_role) == 'GUIA')
                    <a href="{{ url('guia-e-condutores/privado/eventos') }}" type="button" class="btn btn-outline-danger btn-sm">Meus Eventos</a>
                @endif
            @endif
            @if(Auth::user() and $trilheiro)
                @if($trilheiro->evento->contains($evento->id_evento_eve))
                    <button type="button" class="btn btn-outline-success btn-sm"><i class="fa fa-check"></i> Presença Confirmada</button>
                    <button type="button" class="btn btn-outline-danger btn-sm" id="btn-cancelar-participacao" data-url="{{ url('trilheiro/privado/eventos/cancelar/'.$evento->id_evento_eve) }}"><i class="fa fa-times"></i> Cancelar Participação</button>
                @else
                    <a href="{{ url('trilheiro/privado/eventos/participar/'.$evento->id_evento_eve) }}" type="button" class="btn btn-outline-primary btn-sm"><i class="fa fa-check"></i> Participar do Evento</a>
                @endif
            @else
                <a href="{{ url('trilheiro/privado/eventos/participar/'.$evento->id_evento_eve) }}" type="button" class="btn btn-outline-primary btn-sm"><i class="fa fa-check"></i> Participar do Evento</a>
            @endif
            <a href="{{ url('eventos') }}" type="button" class="btn btn-outline-info btn-sm">Todos os Eventos</a>
            <a href="{{ url('/') }}" type="button" class="btn btn-outline-warning btn-sm">Início</a>
        </div>
    </div>
 </section>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('#btn-cancelar-participacao').on('click', function() {
            const url = $(this).data('url');
            
            Swal.fire({
                title: 'Cancelar Participação?',
                text: "Tem certeza que deseja cancelar sua participação neste evento?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Sim, cancelar',
                cancelButtonText: 'Não, manter',
                reverseButtons: true,
                customClass: {
                    confirmButton: 'btn btn-success mx-1',
                    cancelButton: 'btn btn-secondary mx-1'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        });
    });
</script>
@endsection
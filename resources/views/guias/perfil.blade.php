@extends('layouts.site')
@php
    $cidadeOrigem = optional($guia->origem)->nm_cidade_cde;
    $cidadesAtuacao = $guia->cidadesAtuacao->pluck('nm_cidade_cde')->filter()->values();
    $atuacaoTexto = $cidadesAtuacao->count()
        ? $cidadesAtuacao->implode(', ')
        : ($guia->ds_atuacao_gui ?: $cidadeOrigem);
    $descricaoBase = trim(preg_replace('/\s+/', ' ', strip_tags(html_entity_decode($guia->dc_biografia_gui ?? ''))));
    $descricaoSeo = $descricaoBase
        ? \Illuminate\Support\Str::limit($descricaoBase, 160, '...')
        : ('Perfil de ' . $guia->nm_guia_gui . ', guia e condutor' . ($atuacaoTexto ? ' com atuação em ' . $atuacaoTexto : '') . ' | Trilhas em Santa Catarina');
    $pageTitleSeo = $guia->nm_guia_gui . ' - Guia e Condutor | Trilhas em Santa Catarina';
    $canonicalUrl = $guia->nm_instagram_gui
        ? url('guia/perfil/' . $guia->nm_instagram_gui)
        : url('guia/perfil/' . $guia->id_guia_gui);
    $metaImageUrl = $guia->nm_path_logo_gui
        ? asset('img/guias/'.$guia->nm_path_logo_gui)
        : asset('img/guias/default.png');
    $homeUrl = url('/');
    $guiasUrl = url('guias-e-condutores');
    $eventosUrl = url('eventos');
@endphp
@section('pageTitle', $pageTitleSeo)
@section('description', $descricaoSeo)
@section('canonical', $canonicalUrl)
@section('metaImage', $metaImageUrl)
@section('ogType', 'profile')
@section('keywords', 'guia de trilha, condutor, ' . strtolower($guia->nm_guia_gui) . ', ' . ($cidadeOrigem ? strtolower($cidadeOrigem) . ', ' : '') . 'santa catarina, trilhas em sc')
@section('headExtra')
<link rel="preload" as="image" href="{{ $metaImageUrl }}" fetchpriority="high">
@endsection
@section('structuredData')
<script type="application/ld+json">
{!! json_encode(array_filter([
    '@context' => 'https://schema.org',
    '@type' => 'Person',
    'name' => $guia->nm_guia_gui,
    'description' => $descricaoSeo,
    'url' => $canonicalUrl,
    'image' => $metaImageUrl,
    'jobTitle' => 'Guia e Condutor de Trilhas',
    'worksFor' => [
        '@type' => 'Organization',
        'name' => 'Trilhas em Santa Catarina',
        'url' => $homeUrl,
    ],
    'address' => $cidadeOrigem ? [
        '@type' => 'PostalAddress',
        'addressLocality' => $cidadeOrigem,
        'addressRegion' => 'SC',
        'addressCountry' => 'BR',
    ] : null,
    'sameAs' => $guia->nm_instagram_gui
        ? ['https://www.instagram.com/' . ltrim($guia->nm_instagram_gui, '@')]
        : null,
], function ($value) {
    return !is_null($value);
}), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
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
            'name' => 'Guias e Condutores',
            'item' => $guiasUrl,
        ],
        [
            '@type' => 'ListItem',
            'position' => 3,
            'name' => $guia->nm_guia_gui,
            'item' => $canonicalUrl,
        ],
    ],
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
</script>
@endsection
@section('content')
@include('layouts/partes/header-condutores-perfil')
<section class="pt-1 pb-0 mt-3 mb-5">
    <div class="container">
       <div class="row mb-2">
          <div class="col-md-7">
             <h2 class="text-info h3">Mais Informações</h2>
          </div>
       </div>
       <div class="row">
         <div class="col-md-12">
            <h2 class="h4">{{ $guia->nm_guia_gui }}</h2>
            <p><i class="fa fa-instagram"></i> <a href="{{ url("guia/perfil/estatistica/instagram", $guia->nm_instagram_gui) }}">{{ $guia->nm_instagram_gui }}</a></p>
            @if($guia->nu_cadastur_gui)
               <p><strong>Cadastur</strong>: {{ $guia->nu_cadastur_gui }} </p>
            @endif
            @if(count($guia->unidadesConservacao) > 0)
               <p><strong>Unidades de Conservação</strong>: {{ count($guia->unidadesConservacao) > 0 ? implode(', ',$guia->unidadesConservacao->pluck('nome_unc')->toArray()) : ''}}</p>
            @endif
            <p><strong>Cidades de Atuação</strong>: {{ $atuacaoTexto }}</p>
            <p>
                {{ $guia->dc_biografia_gui }}
            </p>
            <p class="small mb-0">
                Explore também:
                <a href="{{ $guiasUrl }}" class="text-decoration-underline">outros guias e condutores</a>
                e a agenda de
                <a href="{{ $eventosUrl }}" class="text-decoration-underline">eventos de trilha</a>.
            </p>
         </div>

         @if(isset($eventos_futuros) && $eventos_futuros->count() > 0)
         <div class="col-md-12 mt-2 mb-2">
            <h2 class="text-info mb-0 h4"><i class="fa fa-calendar" aria-hidden="true"></i> Agenda</h2>
            <div style="height:3px;background:linear-gradient(90deg,#17a2b8 0%,transparent 100%);border-radius:2px;" class="mt-1 mb-4"></div>

            @foreach($eventos_futuros as $evento)
            @php $data = \Carbon\Carbon::parse($evento->dt_realizacao_eve); @endphp
            <div class="d-flex mb-4" style="gap:0;">

               {{-- Bloco da data --}}
               <div class="d-flex flex-column align-items-center justify-content-start mr-3" style="min-width:62px;">
                  <div class="rounded text-white text-center" style="background:#17a2b8;width:62px;">
                     <div class="py-1" style="font-size:0.65rem;letter-spacing:1px;text-transform:uppercase;background:rgba(0,0,0,.15);border-radius:4px 4px 0 0;">
                        {{ $data->translatedFormat('M') }}
                     </div>
                     <div style="font-size:1.8rem;font-weight:700;line-height:1.1;">{{ $data->format('d') }}</div>
                     <div class="pb-1" style="font-size:0.7rem;opacity:.85;">{{ $data->translatedFormat('D') }}</div>
                  </div>
                  {{-- linha vertical conectando eventos --}}
                  @if(!$loop->last)
                  <div style="flex:1;width:2px;background:#dee2e6;min-height:20px;margin-top:4px;"></div>
                  @endif
               </div>

               {{-- Card do evento --}}
               <div class="card flex-fill shadow-sm" style="border-left:4px solid #17a2b8;border-top:none;border-right:none;border-bottom:none;border-radius:6px; margin-left: 10px;">
                  @if($evento->ds_imagem_horizontal_eve)
                  <img src="{{ asset('img/eventos/'.$evento->ds_imagem_horizontal_eve) }}"
                       alt="{{ $evento->nm_evento_eve }}"
                       class="card-img-top"
                       style="max-height:140px;object-fit:cover;border-radius:0 6px 0 0;"
                       loading="lazy"
                       decoding="async">
                  @endif
                  <div class="card-body py-2 px-3">
                     <div class="d-flex align-items-start justify-content-between flex-wrap">
                        <h3 class="card-title mb-1 h6" style="font-size:1rem;">{{ $evento->nm_evento_eve }}</h3>
                        @if(isset($evento->valor_eve))
                           @if($evento->valor_eve > 0)
                           <span class="badge badge-info ml-2" style="white-space:nowrap;">R$ {{ number_format($evento->valor_eve, 2, ',', '.') }}</span>
                           @else
                           <span class="badge badge-success ml-2">Gratuito</span>
                           @endif
                        @endif
                     </div>
                     <div class="text-muted" style="font-size:.85rem;">
                        @if($evento->hora_inicio_eve)
                        <span class="mr-3"><i class="fa fa-clock-o" aria-hidden="true"></i>
                           {{ substr($evento->hora_inicio_eve, 0, 5) }}
                           @if($evento->hora_fim_eve)&nbsp;às {{ substr($evento->hora_fim_eve, 0, 5) }}@endif
                        </span>
                        @endif
                        @if($evento->dt_termino_eve && $evento->dt_termino_eve != $evento->dt_realizacao_eve)
                        <span><i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                           até {{ \Carbon\Carbon::parse($evento->dt_termino_eve)->format('d/m/Y') }}
                        </span>
                        @endif
                     </div>
                  </div>
                  <div class="card-footer bg-transparent border-0 pt-0 pb-2 px-3">
                     <a href="{{ route('evento.detalhes', $evento->slug_eve) }}"
                        class="btn btn-outline-info btn-sm">
                        <i class="fa fa-arrow-right" aria-hidden="true"></i> Ver evento
                     </a>
                  </div>
               </div>

            </div>
            @endforeach
         </div>
         @endif

         <div class="col-md-12 mb-3 mt-3">
            <div class="row">
               @forelse ($guia->unidadesConservacao as $key => $uc)
                  <div class="col col-xl-2 col-md-2 mb-3 mt-3 center">
                     <p class="center"><strong>{{ Str::upper($uc->sigla_unc) }}</strong></p>
                     <img class="img-fluid w-75" src=" {{ asset('img/logos-uc/'.$uc->logo_unc) }}" alt="Logo {{ $uc->nome_uc }}" loading="lazy" decoding="async">
                  </div>
               @empty
               
               @endforelse
            </div>
         </div>
         <div class="col-md-12 mt-2 center">
            <a class="btn btn-success" href="{{ url("guia/perfil/estatistica/telefone", $guia->nm_instagram_gui) }}"><i class="fa fa-whatsapp" aria-hidden="true"></i> Enviar Mensagem</a>
            <a class="btn btn-primary mr-2 ml-3" href="{{ url("guias-e-condutores") }}"><i class="fa fa-users" aria-hidden="true"></i> Todos os Guias</a>
         </div> 
         @include('layouts/partes/publicidade-google')

         
         
       </div>
    </div>
 </section>
@endsection

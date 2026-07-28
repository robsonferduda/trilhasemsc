@extends('layouts.site')

@section('pageTitle', 'Mapa de Trilhas em Santa Catarina')
@section('description', 'Veja no mapa as trilhas de Santa Catarina com pins coloridos por nível de dificuldade.')

@section('content')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
      integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="">

<style>
    #mapa-trilhas {
        height: 70vh;
        min-height: 420px;
        width: 100%;
        border-radius: 0.75rem;
        z-index: 1;
    }
    .mapa-legenda {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem 1.25rem;
        align-items: center;
    }
    .mapa-legenda-item {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        font-size: 0.875rem;
        color: #344767;
    }
    .mapa-legenda-cor {
        width: 14px;
        height: 14px;
        border-radius: 50%;
        border: 2px solid #fff;
        box-shadow: 0 0 0 1px rgba(0,0,0,.25);
        flex-shrink: 0;
    }
    .mapa-popup-title {
        font-weight: 700;
        margin: 0 0 0.35rem;
        font-size: 0.95rem;
    }
    .mapa-popup-meta {
        margin: 0 0 0.5rem;
        font-size: 0.8rem;
        color: #67748e;
    }
    .mapa-popup-badge {
        display: inline-block;
        color: #fff;
        font-size: 0.7rem;
        padding: 2px 8px;
        border-radius: 20px;
        margin-bottom: 0.5rem;
    }
    .leaflet-popup-content-wrapper {
        border-radius: 10px;
    }
</style>

@include('layouts/partes/header')

<section class="pt-1 pb-5 mt-2">
    <div class="container mt-n6 position-relative">
        <div class="row mt-sm-0 mt-5">
            <div class="col-12">
                <div class="card card-body blur shadow-blur mx-3 mx-md-4 mt-n6 mb-4">
                    <div class="row align-items-center">
                        <div class="col-lg-7">
                            <h3 class="mb-1">Mapa de Trilhas</h3>
                            <p class="mb-0 text-sm text-secondary">
                                Pins coloridos por nível de dificuldade.
                                @if($marcadores->count() === 1)
                                    {{ $marcadores->count() }} trilha no mapa.
                                @else
                                    {{ $marcadores->count() }} trilhas no mapa.
                                @endif
                            </p>
                        </div>
                        <div class="col-lg-5 text-lg-end mt-3 mt-lg-0">
                            <a href="{{ url('trilhas') }}" class="btn btn-sm bg-gradient-primary mb-0">Ver listagem</a>
                        </div>
                    </div>

                    <div class="mapa-legenda mt-3 pt-3 border-top">
                        @foreach($niveis as $nivel)
                            <span class="mapa-legenda-item">
                                <span class="mapa-legenda-cor" style="background: {{ $nivel->dc_color_nivel_niv ?: '#989898' }};"></span>
                                {{ $nivel->dc_nivel_niv }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div id="mapa-trilhas" class="shadow-sm"></div>
                @if($marcadores->isEmpty())
                    <p class="text-center text-secondary mt-4 mb-0">
                        Nenhuma trilha com coordenadas cadastradas ainda.
                    </p>
                @endif
            </div>
        </div>
    </div>
</section>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>
(function () {
    var marcadores = @json($marcadores);
    var centroPadrao = [-27.5954, -48.5480];
    var mapa = L.map('mapa-trilhas').setView(centroPadrao, 10);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(mapa);

    if (!marcadores.length) {
        return;
    }

    var grupo = L.featureGroup();

    marcadores.forEach(function (item) {
        var cor = item.cor || '#989898';
        var marker = L.circleMarker([item.lat, item.lng], {
            radius: 9,
            color: '#ffffff',
            weight: 2,
            fillColor: cor,
            fillOpacity: 0.95
        });

        var badgeTextColor = cor.toLowerCase() === '#f9a825' || cor.toLowerCase() === '#ffe000' || cor.toLowerCase() === '#b9bb15'
            ? '#1a1a1a'
            : '#ffffff';

        var html = ''
            + '<p class="mapa-popup-title">' + item.nome + '</p>'
            + (item.cidade ? '<p class="mapa-popup-meta">' + item.cidade + '</p>' : '')
            + (item.nivel
                ? '<span class="mapa-popup-badge" style="background:' + cor + ';color:' + badgeTextColor + ';">' + item.nivel + '</span><br>'
                : '')
            + '<a href="' + item.url + '" class="btn btn-sm bg-gradient-primary mb-0 mt-1">Ver trilha</a>';

        marker.bindPopup(html);
        grupo.addLayer(marker);
    });

    grupo.addTo(mapa);
    mapa.fitBounds(grupo.getBounds().pad(0.2));
})();
</script>
@endsection

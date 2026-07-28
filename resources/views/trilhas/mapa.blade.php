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
    .mapa-pin {
        background: transparent;
        border: none;
    }
    .mapa-pin-inner {
        width: 30px;
        height: 42px;
        position: relative;
        filter: drop-shadow(0 3px 4px rgba(0,0,0,.35));
        transition: transform .15s ease;
    }
    .mapa-pin-inner:hover,
    .mapa-pin-inner.is-active {
        transform: scale(1.12);
    }
    .mapa-pin-inner svg {
        display: block;
        width: 30px;
        height: 42px;
    }
    .leaflet-popup-content-wrapper {
        border-radius: 12px;
        padding: 0;
        overflow: hidden;
        box-shadow: 0 8px 24px rgba(0,0,0,.18);
    }
    .leaflet-popup-content {
        margin: 0;
        min-width: 240px;
        max-width: 280px;
    }
    .leaflet-popup-tip {
        box-shadow: none;
    }
    .mapa-popup {
        font-family: inherit;
    }
    .mapa-popup-img {
        display: block;
        width: 100%;
        height: 140px;
        object-fit: cover;
        background: #e9ecef;
    }
    .mapa-popup-body {
        padding: 0.85rem 1rem 1rem;
    }
    .mapa-popup-title {
        font-weight: 700;
        margin: 0 0 0.25rem;
        font-size: 0.95rem;
        line-height: 1.3;
        color: #344767;
    }
    .mapa-popup-meta {
        margin: 0 0 0.55rem;
        font-size: 0.8rem;
        color: #67748e;
    }
    .mapa-popup-badge {
        display: inline-block;
        font-size: 0.7rem;
        font-weight: 600;
        padding: 3px 9px;
        border-radius: 20px;
        margin-bottom: 0.65rem;
    }
    .mapa-popup-btn {
        display: inline-block;
        font-size: 0.75rem;
        font-weight: 600;
        padding: 0.4rem 0.85rem;
        border-radius: 0.5rem;
        color: #fff !important;
        background: #e91e63;
        text-decoration: none !important;
    }
    .mapa-popup-btn:hover {
        opacity: .9;
        color: #fff !important;
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

    function escapeHtml(text) {
        if (!text) return '';
        return String(text)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    function isLightColor(hex) {
        var c = (hex || '').replace('#', '').toLowerCase();
        if (c.length !== 6) return false;
        var r = parseInt(c.substr(0, 2), 16);
        var g = parseInt(c.substr(2, 2), 16);
        var b = parseInt(c.substr(4, 2), 16);
        return ((r * 299) + (g * 587) + (b * 114)) / 1000 > 160;
    }

    function criarIcone(cor) {
        var svg = ''
            + '<svg viewBox="0 0 30 42" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">'
            + '<path d="M15 0C6.7 0 0 6.7 0 15c0 11.2 15 27 15 27s15-15.8 15-27C30 6.7 23.3 0 15 0z" fill="' + cor + '" stroke="#ffffff" stroke-width="2"/>'
            + '<circle cx="15" cy="15" r="5.5" fill="#ffffff"/>'
            + '</svg>';

        return L.divIcon({
            className: 'mapa-pin',
            html: '<div class="mapa-pin-inner">' + svg + '</div>',
            iconSize: [30, 42],
            iconAnchor: [15, 42],
            popupAnchor: [0, -38]
        });
    }

    var grupo = L.featureGroup();

    marcadores.forEach(function (item) {
        var cor = item.cor || '#989898';
        var marker = L.marker([item.lat, item.lng], {
            icon: criarIcone(cor),
            title: item.nome || ''
        });

        var badgeTextColor = isLightColor(cor) ? '#1a1a1a' : '#ffffff';

        var html = '<div class="mapa-popup">'
            + '<a href="' + escapeHtml(item.url) + '">'
            + '<img class="mapa-popup-img" src="' + escapeHtml(item.imagem) + '" alt="' + escapeHtml(item.imagemAlt || item.nome) + '" loading="lazy">'
            + '</a>'
            + '<div class="mapa-popup-body">'
            + '<p class="mapa-popup-title">' + escapeHtml(item.nome) + '</p>'
            + (item.cidade ? '<p class="mapa-popup-meta">' + escapeHtml(item.cidade) + '</p>' : '')
            + (item.nivel
                ? '<span class="mapa-popup-badge" style="background:' + escapeHtml(cor) + ';color:' + badgeTextColor + ';">' + escapeHtml(item.nivel) + '</span><br>'
                : '')
            + '<a href="' + escapeHtml(item.url) + '" class="mapa-popup-btn">Ver trilha</a>'
            + '</div></div>';

        marker.bindPopup(html, {
            maxWidth: 280,
            minWidth: 240,
            className: 'mapa-popup-leaflet'
        });

        marker.on('popupopen', function () {
            var el = marker.getElement();
            if (el) {
                var inner = el.querySelector('.mapa-pin-inner');
                if (inner) inner.classList.add('is-active');
            }
        });
        marker.on('popupclose', function () {
            var el = marker.getElement();
            if (el) {
                var inner = el.querySelector('.mapa-pin-inner');
                if (inner) inner.classList.remove('is-active');
            }
        });

        grupo.addLayer(marker);
    });

    grupo.addTo(mapa);
    mapa.fitBounds(grupo.getBounds().pad(0.25));
})();
</script>
@endsection

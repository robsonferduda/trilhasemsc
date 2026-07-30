<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Aventura Peru 2026 — Salkantay, Machu Picchu e Circuito Huayhuash">
    <title>Peru 2026</title>
    <link rel="icon" type="image/png" sizes="32x32" href="https://trilhasemsc.com.br/public/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="https://trilhasemsc.com.br/public/img/favicon/favicon-16x16.png">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700;800;900&display=swap" rel="stylesheet">
    <link href="{{ asset('css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/nucleo-svg.css') }}" rel="stylesheet" />
    <link id="pagestyle" href="{{ asset('css/template.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
</head>
<body style="font-family: 'Montserrat', sans-serif; background: #12253b; color: #fff; margin: 0;">

{{-- Imagem de fundo fixada em toda a página --}}
<div style="position: fixed; inset: 0; z-index: 0;
    background: url('{{ asset('img/peru/huayhuash.jpg') }}') center/cover no-repeat;
    opacity: .34;">
</div>
{{-- Overlay escuro sobre a imagem --}}
<div style="position: fixed; inset: 0; z-index: 0; background: linear-gradient(160deg, rgba(16,38,62,.68) 0%, rgba(23,52,84,.62) 50%, rgba(56,72,91,.56) 100%);"></div>

{{-- Véu claro para deixar o tom geral mais leve --}}
<div style="position: fixed; inset: 0; z-index: 0; background: radial-gradient(circle at 22% 15%, rgba(255,246,220,.18), transparent 42%), radial-gradient(circle at 84% 88%, rgba(184,232,255,.16), transparent 45%);"></div>

<div style="position: relative; z-index: 1;">


{{-- Hero: Coming Soon + Countdown --}}
<section class="py-0">
    <div class="container-fluid px-0">
        <div class="peru-hero d-flex align-items-center justify-content-center flex-column text-center text-white position-relative" style="min-height: 100vh;">
            <div class="position-relative z-index-1 px-3">
                <p class="text-warning text-uppercase fw-bold letter-spacing-2 mb-2" style="letter-spacing: 4px; font-size: .85rem;">Trilhas em SC Apresenta</p>
                <h1 class="display-3 fw-bolder mb-0" style="text-shadow: 0 4px 24px rgba(0,0,0,.6);">
                    <span class="text-warning">Peru</span> 2026
                </h1>
                <p class="lead mt-3 mb-4 opacity-8" style="font-size: 1.25rem; max-width: 600px; margin: auto;">
                    Salkantay · Machu Picchu · Montanhas Coloridas · Circuito Huayhuash
                </p>

                {{-- Countdown --}}
                <div class="d-flex justify-content-center mt-4 mb-2" id="countdown-wrap" style="gap: clamp(6px, 2vw, 16px); flex-wrap: nowrap;">
                    <div class="countdown-box">
                        <span class="countdown-num" id="cnt-days">--</span>
                        <span class="countdown-lbl">dias</span>
                    </div>
                    <div class="countdown-box">
                        <span class="countdown-num" id="cnt-hours">--</span>
                        <span class="countdown-lbl">horas</span>
                    </div>
                    <div class="countdown-box">
                        <span class="countdown-num" id="cnt-mins">--</span>
                        <span class="countdown-lbl">minutos</span>
                    </div>
                    <div class="countdown-box">
                        <span class="countdown-num" id="cnt-secs">--</span>
                        <span class="countdown-lbl">segundos</span>
                    </div>
                </div>
                <p class="text-white-50 mt-3" style="font-size: .9rem;">para iniciar a aventura - <strong class="text-white">14 de agosto de 2026</strong></p>

                <a href="#cronograma" class="btn btn-outline-warning btn-lg mt-4 px-5 rounded-pill me-2">Ver o itinerário</a>
                <a href="{{ url('aventuras/peru-2026/hospedagem') }}" class="btn btn-warning btn-lg mt-4 px-5 rounded-pill">Hospedagem</a>
            </div>
        </div>
    </div>
</section>

{{-- Galeria da expedição --}}
<section class="py-5">
    <div class="container">
        <div class="text-center mb-4">
            <p class="text-warning text-uppercase fw-bold mb-2" style="letter-spacing: 3px; font-size: .78rem;">Cenários da Jornada</p>
            <h3 class="text-white fw-bold mb-0">Um pouco do que vem pela frente</h3>
        </div>

        <div class="row g-3 expedition-gallery">
            <div class="col-12 col-lg-7">
                <figure class="gallery-card h-100 mb-0">
                    <img src="{{ asset('img/peru/machu-picchu.jpg') }}" alt="Machu Picchu" class="w-100 h-100">
                    <figcaption>Machu Picchu</figcaption>
                </figure>
            </div>
            <div class="col-12 col-lg-5">
                <div class="row g-3 h-100">
                    <div class="col-12">
                        <figure class="gallery-card mb-0">
                            <img src="{{ asset('img/peru/salkantay.jpg') }}" alt="Trilha Salkantay" class="w-100">
                            <figcaption>Trilha Salkantay</figcaption>
                        </figure>
                    </div>
                    <div class="col-6">
                        <figure class="gallery-card mb-0">
                            <img src="{{ asset('img/peru/montanha-vinicunca.jpg') }}" alt="Montanha Vinicunca" class="w-100">
                            <figcaption>Vinicunca</figcaption>
                        </figure>
                    </div>
                    <div class="col-6">
                        <figure class="gallery-card mb-0">
                            <img src="{{ asset('img/peru/huayhuash.jpg') }}" alt="Cordilheira Huayhuash" class="w-100">
                            <figcaption>Huayhuash</figcaption>
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Infos de altitude --}}
<section class="py-5 text-white">
    <div class="container">
        <div class="row text-center g-4">
            <div class="col-md-4">
                <div class="altitude-card py-4 px-3 rounded-3" style="background: rgba(255,255,255,.06); border: 1px solid rgba(255,255,255,.1);">
                    <div class="fs-1 mb-2">🏙️</div>
                    <h5 class="text-warning mb-1">Lima</h5>
                    <p class="fs-2 fw-bold mb-0">154 m</p>
                    <small class="text-white-50">altitude</small>
                </div>
            </div>
            <div class="col-md-4">
                <div class="altitude-card py-4 px-3 rounded-3" style="background: rgba(255,255,255,.06); border: 1px solid rgba(255,255,255,.1);">
                    <div class="fs-1 mb-2">⛰️</div>
                    <h5 class="text-warning mb-1">Huaráz</h5>
                    <p class="fs-2 fw-bold mb-0">3.052 m</p>
                    <small class="text-white-50">altitude</small>
                </div>
            </div>
            <div class="col-md-4">
                <div class="altitude-card py-4 px-3 rounded-3" style="background: rgba(255,255,255,.06); border: 1px solid rgba(255,255,255,.1);">
                    <div class="fs-1 mb-2">🏔️</div>
                    <h5 class="text-warning mb-1">Cusco</h5>
                    <p class="fs-2 fw-bold mb-0">3.399 m</p>
                    <small class="text-white-50">altitude</small>
                </div>
            </div>
        </div>

        <div class="row g-4 mt-2">
            <div class="col-md-6">
                <div class="altitude-focus-card altitude-focus-salkantay p-4 rounded-3 h-100">
                    <p class="mb-2 text-uppercase fw-bold small" style="letter-spacing: 1.4px;">Destaque de altitude</p>
                    <h5 class="mb-2" style="color: #f5a623;">Salkantay</h5>
                    <p class="altitude-focus-number mb-1">4.650 m</p>
                    <small class="text-white-75">Passo mais alto da trilha</small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="altitude-focus-card altitude-focus-huayhuash p-4 rounded-3 h-100">
                    <p class="mb-2 text-uppercase fw-bold small" style="letter-spacing: 1.4px;">Destaque de altitude</p>
                    <h5 class="mb-2" style="color: #f5a623;">Huayhuash</h5>
                    <p class="altitude-focus-number mb-1">5.200 m</p>
                    <small class="text-white-75">Altitudes máximas de trilha no circuito</small>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Info trilhas --}}
<section class="py-5" style="color: #ccc;">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="p-4 rounded-3 h-100" style="background: rgba(255,255,255,.04); border-left: 4px solid #f5a623;">
                    <h5 class="text-warning mb-3">Trilha Salkantay</h5>
                    <div class="distance-highlight distance-salkantay mb-3">
                        <small class="d-block text-uppercase fw-bold">Distância em destaque</small>
                        <span>67 km</span>
                        <small class="d-block text-white-75">trek principal (dias 1 a 4)</small>
                    </div>
                    <p class="mb-1">Ponto mais alto: <strong class="text-white">Passo Salkantay - 4.650 m</strong></p>
                    <p class="mb-1">Laguna Humantay: <strong class="text-white">~4.200 m</strong></p>
                    <p class="mb-0">Collpapampa (descida para floresta): <strong class="text-white">~3.850 m</strong></p>
                    <p class="mt-3 text-white-50 small">A trilha passa por mudanças significativas de altitude, com clima progressivamente mais quente na descida para a floresta nublada.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-4 rounded-3 h-100" style="background: rgba(255,255,255,.04); border-left: 4px solid #e64980;">
                    <h5 class="text-danger mb-3">Circuito Huayhuash</h5>
                    <div class="distance-highlight distance-huayhuash mb-3">
                        <small class="d-block text-uppercase fw-bold">Distância em destaque</small>
                        <span>116 km</span>
                        <small class="d-block text-white-75">circuito completo (8 dias)</small>
                    </div>
                    <p class="mb-1">Altitude máxima nas trilhas: <strong class="text-white">~5.000 m</strong></p>
                    <p class="mb-1">Pico mais alto: <strong class="text-white">Yerupajá - 6.635 m</strong></p>
                    <p class="mb-0">Trekking de 8 dias pelo circuito completo</p>
                    <p class="mt-3 text-white-50 small">A Cordilheira Huayhuash possui altitudes que ultrapassam os 6.000 metros. Exige aclimatação prévia em Huaráz.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Cronograma --}}
<section id="cronograma" class="py-6">
    <div class="container">
        <div class="text-center mb-5">
            <p class="text-warning text-uppercase fw-bold" style="letter-spacing: 3px; font-size: .8rem;">Itinerário completo</p>
            <h2 class="text-white fw-bold display-6">Cronograma da Expedição</h2>
        </div>

        {{-- Bloco Cusco --}}
        <div class="mb-5">
            <h4 class="text-warning border-bottom border-warning pb-2 mb-3" style="font-size: 1.1rem; letter-spacing: 1px; text-transform: uppercase;">🏙️ Cusco</h4>
            <div class="timeline">
                @php
                $cusco = [
                    ['14/08', 'SEX', 'Saída de Florianópolis', '23:15 - Partida de Florianópolis para Cusco'],
                    ['15/08', 'SÁB', 'Chegada a Cusco', '12:05 - Chegada a Cusco. Check-in no hotel.'],
                    ['16/08', 'DOM', 'Cusco - City Tour', 'Caminhada em Cusco para aclimatação leve. Visitar principais pontos turísticos.'],
                    ['17/08', 'SEG', 'Cusco - Montanha Colorida', 'Passeio para a Montanha Colorida (Vinicunca). Trajeto de aprox. 3h de carro até o local da trilha, sendo cerca de 3 km de subida (6 km ida e volta). O trajeto leva de 1h30 a 2 horas e parte de uma elevação de 4.600 metros até chegar ao topo a 5.200 metros.'],
                ];
                @endphp
                @foreach($cusco as $dia)
                    <div class="timeline-item d-flex align-items-start gap-3 mb-3">
                        <div class="timeline-date text-center flex-shrink-0">
                            <span class="fw-bold text-warning d-block" style="font-size: 1.1rem; min-width: 60px;">{{ $dia[0] }}</span>
                            <span class="text-white-50 small">{{ $dia[1] }}</span>
                        </div>
                        <div class="timeline-dot" data-color="#f5a623"></div>
                        <div class="timeline-body text-white">
                            <strong>{{ $dia[2] }}</strong>
                            @if($dia[3])
                                <p class="text-white-50 small mb-0 mt-1">{{ $dia[3] }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Bloco Salkantay --}}
        <div class="mb-5">
            <h4 class="text-info border-bottom border-info pb-2 mb-3" style="font-size: 1.1rem; letter-spacing: 1px; text-transform: uppercase;">🥾 Salkantay + Machu Picchu</h4>
            <div class="timeline">
                @php
                $salkantay = [
                    ['18/08', 'TER', 'Salkantay - Dia 1 - Soraypampa à Laguna Humantay', '4km, sendo que fazemos ida e volta pelo mesmo trajeto. Partimos de 3800 e chegamos aos 4200 metros de altitude. Hospedagem em Soraypampa Hostel.', 'Tracklog do trajeto', 'https://loc.wiki/t/182583542?wa=sc'],
                    ['19/08', 'QUA', 'Salkantay - Dia 2 - De Soraypampa até Chaullay (Colcapampa)', '20km, sendo o dia mais difícil, onde chegamos aos 4.600 metros de altitude. São 6km de subida e 14km de descida, rumo a Chaullay. Hospedagem em Hostel Samana Wasi Chaullay.', 'Tracklog do trajeto', 'https://loc.wiki/t/182699595?wa=sc'],
                    ['20/08', 'QUI', 'Salkantay - Dia 3 - De Chaullay (Colcapampa) à Lucmabamba', '20km, sendo praticamente descidas, com perda de 800 metros de altitude. Hospedagem em Lucmabamba Lodge.', 'Tracklog do trajeto', 'https://loc.wiki/t/182813083?wa=sc'],
                    ['21/08', 'SEX', 'Salkantay - Dia 4 - De Lucmabamba à Macchu Picchu Pueblo (Aguas Calientes)', '23km, sendo 6km de subida e 17km de descida, pasando por pontos como a Hidroelétrica e chegando em Aguas Calientes. Hospedagem em Samananchis Machupicchu.', 'Tracklog do trajeto', 'https://loc.wiki/t/182950022?wa=sc'],
                    ['22/08', 'SÁB', 'Salkantay - Dia 5 - Machu Picchu', 'Visita ao Machu Picchu logo pela manhã. Depois retornamos para Cusco.', '', ''],
                    ['23/08', 'DOM', 'Cusco', '', '', ''],
                ];
                @endphp
                @foreach($salkantay as $dia)
                    <div class="timeline-item d-flex align-items-start gap-3 mb-3">
                        <div class="timeline-date text-center flex-shrink-0">
                            <span class="fw-bold text-info d-block" style="font-size: 1.1rem; min-width: 60px;">{{ $dia[0] }}</span>
                            <span class="text-white-50 small">{{ $dia[1] }}</span>
                        </div>
                        <div class="timeline-dot" data-color="#0dcaf0"></div>
                        <div class="timeline-body text-white">
                            <strong>{{ $dia[2] }}</strong>
                            @if(!empty($dia[3]))
                                <p class="text-white-50 small mb-0 mt-1">
                                    {{ $dia[3] }}
                                </p>
                            @endif
                            @if(!empty($dia[4]) && !empty($dia[5]))
                                <p class="small mb-0 mt-1">
                                    <a href="{{ $dia[5] }}" target="_blank" rel="noopener noreferrer" class="btn btn-outline-info btn-sm rounded-pill px-3 py-1 trail-link-btn">{{ $dia[4] }}</a>
                                </p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Bloco Huaráz --}}
        <div class="mb-5">
            <h4 class="text-success border-bottom border-success pb-2 mb-3" style="font-size: 1.1rem; letter-spacing: 1px; text-transform: uppercase;">🚌 Translado a Huaráz</h4>
            <div class="timeline">
                @php
                $huaraz = [
                    ['24/08', 'SEG', 'Voo Cusco - Huaráz (1 parada em Lima)', '<div class="flight-description"><div class="flight-summary">Duração total: <strong>3h15</strong></div><div class="flight-leg"><span class="flight-leg-label">Trecho 1</span><br><strong>05:00</strong> CUZ · A. Velasco Astete<br><strong>LA2167</strong> · Airbus A320 · Latam Peru<br><strong>06:30</strong> LIM · J. Chavez Intl.</div><div class="flight-leg"><span class="flight-leg-label">Conexão</span><br><strong>45 min</strong> em Lima para troca de aeronave</div><div class="flight-leg"><span class="flight-leg-label">Trecho 2</span><br><strong>07:15</strong> LIM · J. Chavez Intl.<br><strong>LA2059</strong> · Airbus A319 · Latam Peru<br><strong>08:15</strong> ATA · Comandante FAP Germán Arias Graziani</div><div class="flight-note">Considerar traslado aeroporto-hospedagem.</div></div>'],
                    ['25/08', 'TER', 'Laguna Wilcacocha', ' Aclimatação clássica com vistas da Cordilheira Branca e organização final para o circuito'],
                ];
                @endphp
                @foreach($huaraz as $dia)
                    @php
                        $isFlight = strpos($dia[2], 'Voo') !== false;
                    @endphp
                    <div class="timeline-item d-flex align-items-start gap-3 mb-3">
                        <div class="timeline-date text-center flex-shrink-0">
                            <span class="fw-bold text-success d-block" style="font-size: 1.1rem; min-width: 60px;">{{ $dia[0] }}</span>
                            <span class="text-white-50 small">{{ $dia[1] }}</span>
                        </div>
                        <div class="timeline-dot" data-color="#198754"></div>
                        <div class="timeline-body text-white {{ $isFlight ? 'flight-card' : '' }}">
                            <strong>{{ $dia[2] }}</strong>
                            @if($dia[3])
                                @if($isFlight)
                                    {!! $dia[3] !!}
                                @else
                                    <p class="text-white-50 small mb-0 mt-1">{{ $dia[3] }}</p>
                                @endif
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Bloco Huayhuash --}}
        <div class="mb-5">
            <h4 class="text-danger border-bottom border-danger pb-2 mb-3" style="font-size: 1.1rem; letter-spacing: 1px; text-transform: uppercase;">⛰️ Circuito Huayhuash (8 dias)</h4>
            <p class="text-white-50 small mb-3">Baseado no itinerário da agência Caleb Expeditions:
                <a href="https://calebexpeditions.com/huayhuash-trek-8-days-2nd-option/" target="_blank" rel="noopener noreferrer" class="text-danger text-decoration-underline">ver roteiro original</a>
            </p>
            <a href="https://calebexpeditions.com/huayhuash-trek-8-days-2nd-option/" target="_blank" rel="noopener noreferrer" class="btn btn-outline-danger btn-sm rounded-pill px-3 mb-3 trail-link-btn">Link da trilha</a>
            <div class="row g-3">
                @php
                $huayhuash = [
                    ['26/08', 'QUA', 'Huayhuash - Dia 1', 'Matacancha (4.200 m) até Mitucocha. 11 km, ~5h. Ponto alto: Cacananpunta (4.680 m).'],
                    ['27/08', 'QUI', 'Huayhuash - Dia 2', 'Rota alpina alternativa, fósseis marinhos e mirante das Três Lagunas. Chegada em Carhuacocha (4.100 m). 13 km, ~7h.'],
                    ['28/08', 'SEX', 'Huayhuash - Dia 3', 'Trecho até o acampamento Huayhuash (4.350 m), com passagem por lagoa e mirante de geleira. ~8h de caminhada.'],
                    ['29/08', 'SÁB', 'Huayhuash - Dia 4', 'Subida ao Paso Trapecio (5.041 m). Opcional até geleira (40 min) e/ou Paso San Antonio (5.100 m). Descida para Cuyoc (4.400 m).'],
                    ['30/08', 'DOM', 'Huayhuash - Dia 5', 'Paso Santa Rosa com vista do Siula Grande. 19 km, ~9h. Acampamento em Huayllapa (3.487 m).'],
                    ['31/08', 'SEG', 'Huayhuash - Dia 6', 'Subida ao Paso Tapush (4.800 m) e descida ao acampamento (4.400 m). 13 km, ~7h.'],
                    ['01/09', 'TER', 'Huayhuash - Dia 7', 'Rumo ao Paso Yaucha (4.800 m). Opcional: mirador com duas lagunas. Acampamento em ~4.000 m.'],
                    ['02/09', 'QUA', 'Huayhuash - Dia 8 · Fim da caminhada', '16 km (~5h) até Llamac, em trecho plano/descida. Retorno de veículo para Huaráz (~4h).'],
                ];
                @endphp
                @foreach($huayhuash as $dia)
                    <div class="col-md-6 col-lg-3">
                        <div class="p-3 rounded-3 text-center h-100" style="background: rgba(220,53,69,.12); border: 1px solid rgba(220,53,69,.35);">
                            <span class="fw-bold text-danger d-block fs-5">{{ $dia[0] }}</span>
                            <span class="text-white-50 small d-block mb-2">{{ $dia[1] }}</span>
                            <p class="text-white mb-1 small fw-bold">{{ $dia[2] }}</p>
                            <p class="text-white-50 mb-0 small">{{ $dia[3] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <p class="text-white-50 small mt-3 ps-1">* Referência do roteiro: Huayhuash Trek 8 Days (2nd Option), com pequenas adaptações de texto para PT-BR.</p>
        </div>

        {{-- Bloco Final --}}
        <div class="mb-5">
            <h4 class="text-warning border-bottom border-warning pb-2 mb-3" style="font-size: 1.1rem; letter-spacing: 1px; text-transform: uppercase;">🏁 Retorno</h4>
            <div class="timeline">
                @php
                $retorno = [
                    ['03/09', 'QUI', 'Voo Huaráz - Lima', '<div class="flight-description"><div class="flight-summary">Duração aproximada: <strong>1h</strong></div><div class="flight-leg"><span class="flight-leg-label">Trecho 1</span><br><strong>08:55</strong> ATA · Aeroporto Comandante FAP Germán Arias Graziani<br><strong>LA2060</strong> · Airbus A319 · Latam Peru<br><strong>09:55</strong> LIM · J. Chavez Intl.</div><div class="flight-note">Chegada em Lima e City Tour.</div></div>'],
                    ['04/09', 'SEX', 'Explorar Lima', 'Conhecer os principais pontos turísticos e culinária local'],
                    ['05/09', 'SÁB', 'Retorno ao Brasil', 'Voo partindo 00:05 Lima - Fim de viagem 😢'],
                ];
                @endphp
                @foreach($retorno as $dia)
                    @php
                        $isFlight = strpos($dia[2], 'Voo') !== false;
                    @endphp
                    <div class="timeline-item d-flex align-items-start gap-3 mb-3">
                        <div class="timeline-date text-center flex-shrink-0">
                            <span class="fw-bold text-warning d-block" style="font-size: 1.1rem; min-width: 60px;">{{ $dia[0] }}</span>
                            <span class="text-white-50 small">{{ $dia[1] }}</span>
                        </div>
                        <div class="timeline-dot" data-color="#f5a623"></div>
                        <div class="timeline-body text-white {{ $isFlight ? 'flight-card' : '' }}">
                            <strong>{{ $dia[2] }}</strong>
                            @if($dia[3])
                                @if($isFlight)
                                    {!! $dia[3] !!}
                                @else
                                    <p class="text-white-50 small mb-0 mt-1">{{ $dia[3] }}</p>
                                @endif
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
</section>

</div>{{-- /z-index wrapper --}}

<script src="{{ asset('js/core/bootstrap.min.js') }}" type="text/javascript"></script>
<script>
    (function () {
        var target = new Date('2026-08-14T23:15:00');

        function update() {
            var now = new Date();
            var diff = target - now;
            if (diff <= 0) {
                document.getElementById('countdown-wrap').innerHTML = '<p class="fs-3 fw-bold text-warning">A aventura começou! 🎉</p>';
                return;
            }
            var d = Math.floor(diff / 86400000);
            var h = Math.floor((diff % 86400000) / 3600000);
            var m = Math.floor((diff % 3600000) / 60000);
            var s = Math.floor((diff % 60000) / 1000);

            document.getElementById('cnt-days').textContent  = d < 100 ? String(d).padStart(2, '0') : String(d).padStart(3, '0');
            document.getElementById('cnt-hours').textContent = String(h).padStart(2, '0');
            document.getElementById('cnt-mins').textContent  = String(m).padStart(2, '0');
            document.getElementById('cnt-secs').textContent  = String(s).padStart(2, '0');
        }

        update();
        setInterval(update, 1000);
    })();
</script>

<style>
    .peru-hero {
        position: relative;
    }
    .peru-hero::after {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(to bottom, rgba(12,29,47,.16), rgba(12,29,47,.42));
        z-index: 0;
    }
    .peru-hero .z-index-1 {
        position: relative;
        z-index: 1;
    }

    .expedition-gallery .gallery-card {
        position: relative;
        overflow: hidden;
        border-radius: 16px;
        border: 1px solid rgba(255,255,255,.34);
        background: rgba(255,255,255,.08);
        box-shadow: 0 18px 34px rgba(5,16,29,.24);
    }
    .expedition-gallery .gallery-card img {
        display: block;
        object-fit: cover;
        min-height: 210px;
        max-height: 380px;
        transition: transform .45s ease;
    }
    .expedition-gallery .gallery-card:hover img {
        transform: scale(1.04);
    }
    .expedition-gallery figcaption {
        position: absolute;
        left: 10px;
        bottom: 10px;
        margin: 0;
        padding: 6px 10px;
        border-radius: 999px;
        background: rgba(9,22,37,.58);
        border: 1px solid rgba(255,255,255,.28);
        color: #fff;
        font-size: .74rem;
        letter-spacing: .6px;
        text-transform: uppercase;
        font-weight: 700;
    }

    .countdown-box {
        background: rgba(255,255,255,.14);
        border: 1px solid rgba(255,255,255,.34);
        border-radius: 12px;
        padding: clamp(10px, 2.5vw, 18px) clamp(10px, 3vw, 24px);
        min-width: 0;
        flex: 1 1 0;
        max-width: 110px;
        backdrop-filter: blur(6px);
        text-align: center;
    }
    .countdown-num {
        display: block;
        font-size: clamp(1.6rem, 7vw, 2.8rem);
        font-weight: 800;
        color: #f5a623;
        line-height: 1;
    }
    .countdown-lbl {
        display: block;
        font-size: clamp(.55rem, 2vw, .75rem);
        text-transform: uppercase;
        letter-spacing: 1px;
        color: rgba(255,255,255,.75);
        margin-top: 4px;
    }
    .altitude-card {
        background: rgba(255,255,255,.13) !important;
        border: 1px solid rgba(255,255,255,.26) !important;
        backdrop-filter: blur(4px);
    }
    .altitude-focus-card {
        border: 1px solid rgba(255,255,255,.36);
        box-shadow: 0 16px 30px rgba(7,20,36,.22);
        color: #fff;
        backdrop-filter: blur(5px);
    }
    .altitude-focus-card h5 {
        font-size: 1.2rem;
        font-weight: 700;
    }
    .altitude-focus-number {
        font-size: clamp(2rem, 5vw, 2.8rem);
        line-height: 1;
        font-weight: 800;
    }
    .altitude-focus-salkantay {
        background: linear-gradient(135deg, rgba(245,166,35,.30), rgba(245,166,35,.18));
    }
    .altitude-focus-huayhuash {
        background: linear-gradient(135deg, rgba(220,53,69,.30), rgba(220,53,69,.16));
    }
    .distance-highlight {
        border-radius: 12px;
        border: 1px solid rgba(255,255,255,.3);
        padding: 10px 12px;
        backdrop-filter: blur(4px);
        box-shadow: 0 10px 20px rgba(7,20,36,.18);
    }
    .distance-highlight span {
        display: block;
        font-size: clamp(1.7rem, 4vw, 2.4rem);
        font-weight: 800;
        line-height: 1.1;
        letter-spacing: .4px;
        color: #fff;
        margin: 2px 0;
    }
    .distance-salkantay {
        background: linear-gradient(135deg, rgba(245,166,35,.30), rgba(245,166,35,.16));
    }
    .distance-huayhuash {
        background: linear-gradient(135deg, rgba(230,73,128,.30), rgba(220,53,69,.16));
    }
    .timeline-item .timeline-body {
        background: rgba(255,255,255,.07);
        border: 1px solid rgba(255,255,255,.12);
        border-radius: 12px;
        padding: 12px 14px;
        width: 100%;
    }
    .flight-card {
        background: linear-gradient(135deg, rgba(245,166,35,.42), rgba(255,255,255,.12));
        border: 2px solid rgba(255,196,84,.85);
        box-shadow: 0 16px 30px rgba(7,20,36,.32);
        position: relative;
        overflow: hidden;
    }
    .flight-card::before {
        content: '✈';
        position: absolute;
        right: 10px;
        top: 8px;
        font-size: 1.1rem;
        color: rgba(255,255,255,.85);
        opacity: .9;
    }
    .flight-card strong {
        display: block;
        color: #fff7d6;
        font-size: 1.02rem;
        margin-bottom: 6px;
    }
    .flight-description {
        margin-top: 8px;
        display: grid;
        gap: 8px;
    }
    .flight-summary {
        font-size: .82rem;
        letter-spacing: .04em;
        text-transform: uppercase;
        color: #ffe7a3;
        font-weight: 700;
    }
    .flight-leg {
        padding: 8px 10px;
        border-radius: 10px;
        background: rgba(255,255,255,.08);
        border: 1px solid rgba(255,255,255,.16);
        font-size: .9rem;
        line-height: 1.45;
    }
    .flight-leg-label {
        display: inline-block;
        margin-bottom: 4px;
        padding: 2px 8px;
        border-radius: 999px;
        background: rgba(255,196,84,.24);
        color: #fff7d6;
        font-size: .72rem;
        font-weight: 700;
        letter-spacing: .08em;
        text-transform: uppercase;
    }
    .flight-note {
        font-size: .8rem;
        color: rgba(255,255,255,.78);
        margin-top: 2px;
    }
    .trail-link-btn {
        border-width: 1.5px;
        font-weight: 700;
        letter-spacing: .02em;
    }
    .timeline {
        border-left: none !important;
        padding-left: 0;
        margin-left: 0;
    }
    .timeline::before { display: none !important; }
    .timeline-item { position: relative; }
    .timeline-dot { display: none !important; }
    @media (min-width: 576px) {
        .timeline {
            border-left: 2px solid rgba(255,255,255,.12) !important;
            padding-left: 24px;
            margin-left: 74px;
        }
        .timeline-dot {
            display: block !important;
            position: absolute;
            left: -30px;
            top: 6px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #f5a623; /* fallback */
        }
        .timeline-dot[data-color="#0dcaf0"] { background: #0dcaf0; }
        .timeline-dot[data-color="#198754"] { background: #198754; }
    }
    .gap-3 { gap: 1rem !important; }
    .py-6 { padding-top: 5rem !important; padding-bottom: 5rem !important; }
    /* Remove seções com fundo sólido escuro para deixar o bg global aparecer */
    section { background: transparent !important; }
    @media (max-width: 991px) {
        .expedition-gallery .gallery-card img {
            max-height: 300px;
        }
    }
    @media (max-width: 575px) {
        .timeline::before { display: none !important; }
        .expedition-gallery .gallery-card img {
            min-height: 170px;
            max-height: 260px;
        }
    }
</style>

</body>
</html>

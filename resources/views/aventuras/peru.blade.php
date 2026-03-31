<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Aventura Peru 2026 — Salkantay, Machu Picchu e Circuito Huayhuash">
    <title>Peru 2026 — Nossa Aventura</title>
    <link rel="icon" type="image/png" sizes="32x32" href="https://trilhasemsc.com.br/public/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="https://trilhasemsc.com.br/public/img/favicon/favicon-16x16.png">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700;800;900&display=swap" rel="stylesheet">
    <link href="{{ asset('css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/nucleo-svg.css') }}" rel="stylesheet" />
    <link id="pagestyle" href="{{ asset('css/template.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
</head>
<body style="font-family: 'Montserrat', sans-serif; background: #080e18; color: #fff; margin: 0;">

{{-- Imagem de fundo fixada em toda a página --}}
<div style="position: fixed; inset: 0; z-index: 0;
    background: url('{{ asset('img/aventuras/cordillera-huayhuash.jpg') }}') center/cover no-repeat;
    opacity: .22;">
</div>
{{-- Overlay escuro sobre a imagem --}}
<div style="position: fixed; inset: 0; z-index: 0; background: linear-gradient(160deg, rgba(8,14,24,.82) 0%, rgba(12,22,45,.78) 50%, rgba(20,8,30,.80) 100%);"></div>

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
                <p class="text-white-50 mt-3" style="font-size: .9rem;">para iniciar a aventura - <strong class="text-white">15 de agosto de 2026</strong></p>

                <a href="#cronograma" class="btn btn-outline-warning btn-lg mt-4 px-5 rounded-pill">Ver o itinerário</a>
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
    </div>
</section>

{{-- Info trilhas --}}
<section class="py-5" style="color: #ccc;">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="p-4 rounded-3 h-100" style="background: rgba(255,255,255,.04); border-left: 4px solid #f5a623;">
                    <h5 class="text-warning mb-3">Trilha Salkantay</h5>
                    <p class="mb-1">Ponto mais alto: <strong class="text-white">Passo Salkantay — 4.650 m</strong></p>
                    <p class="mb-1">Laguna Humantay: <strong class="text-white">~4.200 m</strong></p>
                    <p class="mb-0">Collpapampa (descida para floresta): <strong class="text-white">~3.850 m</strong></p>
                    <p class="mt-3 text-white-50 small">A trilha passa por mudanças significativas de altitude, com clima progressivamente mais quente na descida para a floresta nublada.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-4 rounded-3 h-100" style="background: rgba(255,255,255,.04); border-left: 4px solid #e64980;">
                    <h5 class="text-danger mb-3">Circuito Huayhuash</h5>
                    <p class="mb-1">Altitude máxima nas trilhas: <strong class="text-white">~5.000 m</strong></p>
                    <p class="mb-1">Pico mais alto: <strong class="text-white">Yerupajá — 6.635 m</strong></p>
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
                    ['15/08', 'SÁB', 'Chegada a Cusco', ''],
                    ['16/08', 'DOM', 'Cusco - City Tour', 'Caminhada em Cusco para aclimatação leve. Visitar principais pontos turísticos.'],
                    ['17/08', 'SEG', 'Cusco - Aclimatação', ''],
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
                    ['18/08', 'TER', 'Salkantay - Dia 1', ''],
                    ['19/08', 'QUA', 'Salkantay - Dia 2', ''],
                    ['20/08', 'QUI', 'Salkantay - Dia 3', ''],
                    ['21/08', 'SEX', 'Salkantay - Dia 4', ''],
                    ['22/08', 'SÁB', 'Salkantay - Dia 5 · Machu Picchu · Águas Calientes', 'Retorno para Cusco. Comprar ingressos Machu Picchu antecipado.'],
                    ['23/08', 'DOM', 'Cusco - Montanhas Coloridas', ''],
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
                            @if($dia[3])
                                <p class="text-white-50 small mb-0 mt-1">{{ $dia[3] }}</p>
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
                    ['24/08', 'SEG', 'Translado Cusco - Huaráz', 'Aclimatação'],
                    ['25/08', 'TER', 'Huaráz - Aclimatação', 'Aclimatação e organização final para o circuito'],
                ];
                @endphp
                @foreach($huaraz as $dia)
                    <div class="timeline-item d-flex align-items-start gap-3 mb-3">
                        <div class="timeline-date text-center flex-shrink-0">
                            <span class="fw-bold text-success d-block" style="font-size: 1.1rem; min-width: 60px;">{{ $dia[0] }}</span>
                            <span class="text-white-50 small">{{ $dia[1] }}</span>
                        </div>
                        <div class="timeline-dot" data-color="#198754"></div>
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

        {{-- Bloco Huayhuash --}}
        <div class="mb-5">
            <h4 class="text-danger border-bottom border-danger pb-2 mb-3" style="font-size: 1.1rem; letter-spacing: 1px; text-transform: uppercase;">⛰️ Circuito Huayhuash (8 dias)</h4>
            <div class="row g-3">
                @php
                $huayhuash = [
                    ['26/08', 'QUA', 'Huayhuash - Dia 1'],
                    ['27/08', 'QUI', 'Huayhuash - Dia 2'],
                    ['28/08', 'SEX', 'Huayhuash - Dia 3'],
                    ['29/08', 'SÁB', 'Huayhuash - Dia 4'],
                    ['30/08', 'DOM', 'Huayhuash - Dia 5'],
                    ['31/08', 'SEG', 'Huayhuash - Dia 6'],
                    ['01/09', 'TER', 'Huayhuash - Dia 7'],
                    ['02/09', 'QUA', 'Huayhuash - Dia 8 · Fim da caminhada'],
                ];
                @endphp
                @foreach($huayhuash as $dia)
                    <div class="col-md-6 col-lg-3">
                        <div class="p-3 rounded-3 text-center h-100" style="background: rgba(220,53,69,.12); border: 1px solid rgba(220,53,69,.35);">
                            <span class="fw-bold text-danger d-block fs-5">{{ $dia[0] }}</span>
                            <span class="text-white-50 small d-block mb-2">{{ $dia[1] }}</span>
                            <p class="text-white mb-0 small">{{ $dia[2] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <p class="text-white-50 small mt-3 ps-1">* Dia 8: retorno para Huaráz após o fim da caminhada.</p>
        </div>

        {{-- Bloco Final --}}
        <div class="mb-5">
            <h4 class="text-warning border-bottom border-warning pb-2 mb-3" style="font-size: 1.1rem; letter-spacing: 1px; text-transform: uppercase;">🏁 Retorno</h4>
            <div class="timeline">
                @php
                $retorno = [
                    ['03/09', 'QUI', 'Huaráz - Translado Lima', 'Chegada em Lima e City Tour'],
                    ['04/09', 'SEX', 'Explorar Lima', 'Conhecer os principais pontos turísticos e culinária local'],
                    ['05/09', 'SÁB', 'Retorno ao Brasil', 'Fim de viagem 😢'],
                ];
                @endphp
                @foreach($retorno as $dia)
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

    </div>
</section>

</div>{{-- /z-index wrapper --}}

<script src="{{ asset('js/core/bootstrap.min.js') }}" type="text/javascript"></script>
<script>
    (function () {
        var target = new Date('2026-08-15T00:00:00');

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

            document.getElementById('cnt-days').textContent  = String(d).padStart(3, '0');
            document.getElementById('cnt-hours').textContent = String(h).padStart(2, '0');
            document.getElementById('cnt-mins').textContent  = String(m).padStart(2, '0');
            document.getElementById('cnt-secs').textContent  = String(s).padStart(2, '0');
        }

        update();
        setInterval(update, 1000);
    })();
</script>

<style>
    .countdown-box {
        background: rgba(255,255,255,.08);
        border: 1px solid rgba(255,255,255,.18);
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
        color: rgba(255,255,255,.55);
        margin-top: 4px;
    }
    .timeline {
        border-left: none !important;
        padding-left: 0;
        margin-left: 0;
    }
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
            left: -29px;
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
    @media (max-width: 575px) {
        .timeline::before { display: none !important; }
    }
</style>

</body>
</html>

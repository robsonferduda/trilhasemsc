<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Hospedagem — Aventura Peru 2026">
    <title>Hospedagem · Peru 2026</title>
    <link rel="icon" type="image/png" sizes="32x32" href="https://trilhasemsc.com.br/public/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="https://trilhasemsc.com.br/public/img/favicon/favicon-16x16.png">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700;800;900&display=swap" rel="stylesheet">
    <link href="{{ asset('css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/nucleo-svg.css') }}" rel="stylesheet" />
    <link id="pagestyle" href="{{ asset('css/template.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
</head>
<body style="font-family: 'Montserrat', sans-serif; background: #080e18; color: #fff; margin: 0;">

<div style="position: fixed; inset: 0; z-index: 0;
    background: url('{{ asset('img/aventuras/cordillera-huayhuash.jpg') }}') center/cover no-repeat;
    opacity: .22;">
</div>
<div style="position: fixed; inset: 0; z-index: 0; background: linear-gradient(160deg, rgba(8,14,24,.82) 0%, rgba(12,22,45,.78) 50%, rgba(20,8,30,.80) 100%);"></div>

<div style="position: relative; z-index: 1;">

<section class="py-5">
    <div class="container py-4">
        <div class="text-center mb-5">
            <a href="{{ url('aventuras/peru-2026') }}" class="text-white-50 text-decoration-none small d-inline-block mb-3">
                <i class="fa fa-arrow-left me-1"></i> Voltar para Peru 2026
            </a>
            <p class="text-warning text-uppercase fw-bold mb-2" style="letter-spacing: 4px; font-size: .85rem;">Aventura Peru 2026</p>
            <h1 class="display-5 fw-bolder text-white mb-2">
                <span class="text-warning">Hospedagem</span>
            </h1>
            <p class="text-white-50 lead mb-0" style="max-width: 560px; margin: auto;">
                Reservas e valores da expedição, organizados por data de chegada.
            </p>
            <p class="text-white-50 small mt-2 mb-0">
                Câmbio de referência: <strong class="text-white">1 sol = R$ {{ number_format($cambioSoles, 2, ',', '.') }}</strong>
            </p>
        </div>

        @if($hospedagens->isEmpty())
            <div class="text-center py-5">
                <p class="text-white-50 fs-5 mb-0">Nenhuma hospedagem cadastrada no momento.</p>
            </div>
        @else
            <div class="d-none d-xl-block">
                <div class="table-responsive rounded-3 overflow-hidden" style="background: rgba(255,255,255,.05); border: 1px solid rgba(255,255,255,.1);">
                    <table class="table table-dark table-hover table-sm mb-0 hospedagem-table">
                        <thead>
                            <tr>
                                <th>Cidade</th>
                                <th>Hospedagem</th>
                                <th class="text-center">Dias</th>
                                <th>Chegada</th>
                                <th>Saída</th>
                                <th class="text-center">Hóspedes</th>
                                <th class="text-end">Valor total</th>
                                <th class="text-end">Por pessoa</th>
                                <th class="text-end">Por pessoa (S/)</th>
                                <th class="text-center">Quartos</th>
                                <th class="text-center">Link</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($hospedagens as $hospedagem)
                                <tr>
                                    <td>{{ $hospedagem->ds_cidade_hos ?? '—' }}</td>
                                    <td class="fw-semibold">{{ $hospedagem->nm_hospedagem_hos }}</td>
                                    <td class="text-center">{{ $hospedagem->nu_dias_hos ?? '—' }}</td>
                                    <td>{{ $hospedagem->dt_chegada_hos ? $hospedagem->dt_chegada_hos->format('d/m/Y') : '—' }}</td>
                                    <td>{{ $hospedagem->dt_saida_hos ? $hospedagem->dt_saida_hos->format('d/m/Y') : '—' }}</td>
                                    <td class="text-center">{{ $hospedagem->total_hospedes_hos ?? '—' }}</td>
                                    <td class="text-end text-warning">
                                        @if(!is_null($hospedagem->valor_total_hos))
                                            R$ {{ number_format($hospedagem->valor_total_hos, 2, ',', '.') }}
                                        @else
                                            —
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        @if(!is_null($hospedagem->valor_calculado_por_pessoa_hos))
                                            R$ {{ number_format($hospedagem->valor_calculado_por_pessoa_hos, 2, ',', '.') }}
                                        @else
                                            —
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        @if(!is_null($hospedagem->valor_calculado_por_pessoa_soles_hos))
                                            S/ {{ number_format($hospedagem->valor_calculado_por_pessoa_soles_hos, 2, ',', '.') }}
                                        @else
                                            —
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($hospedagem->quartos->isNotEmpty())
                                            <button
                                                class="btn btn-sm btn-outline-light rounded-pill px-3"
                                                type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#quartos-{{ $hospedagem->cd_hospedagem_hos }}"
                                                aria-expanded="false"
                                                aria-controls="quartos-{{ $hospedagem->cd_hospedagem_hos }}"
                                            >
                                                {{ $hospedagem->quartos->count() }}
                                            </button>
                                        @else
                                            —
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($hospedagem->ds_url_hos)
                                            <a href="{{ $hospedagem->ds_url_hos }}" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-outline-warning rounded-pill px-3">
                                                Ver
                                            </a>
                                        @else
                                            —
                                        @endif
                                    </td>
                                </tr>
                                @if($hospedagem->quartos->isNotEmpty())
                                    <tr class="quartos-detail-row">
                                        <td colspan="11" class="p-0 border-0">
                                            <div class="collapse" id="quartos-{{ $hospedagem->cd_hospedagem_hos }}">
                                                <div class="quartos-box px-3 py-2">
                                                    <div class="small text-white-50 text-uppercase fw-bold mb-2" style="letter-spacing: 1px;">Detalhamento de quartos</div>
                                                    @foreach($hospedagem->quartos as $quarto)
                                                        <div class="quarto-item mb-2">
                                                            <div class="d-flex flex-wrap gap-2 align-items-center">
                                                                <span class="badge rounded-pill bg-warning text-dark">{{ $quarto->ds_quarto_hoq ?: 'Quarto sem descrição' }}</span>
                                                                <span class="badge rounded-pill bg-secondary">{{ $quarto->nu_pessoas_hoq ?? 0 }} pessoa(s)</span>
                                                                <span class="badge rounded-pill {{ $quarto->fl_banheiro_hoq ? 'bg-success' : 'bg-dark border border-light' }}">Banheiro: {{ $quarto->fl_banheiro_hoq ? 'Sim' : 'Não' }}</span>
                                                                <span class="badge rounded-pill {{ $quarto->fl_cafe_hoq ? 'bg-success' : 'bg-dark border border-light' }}">Café: {{ $quarto->fl_cafe_hoq ? 'Sim' : 'Não' }}</span>
                                                            </div>
                                                            @if($quarto->obs_hoq)
                                                                <div class="small text-white-50 mt-1">Obs: {{ $quarto->obs_hoq }}</div>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="totais-row">
                                <td class="fw-bold text-warning">Totais</td>
                                <td></td>
                                <td class="text-center fw-bold">{{ $totais['dias'] }}</td>
                                <td colspan="2"></td>
                                <td></td>
                                <td class="text-end fw-bold text-warning">
                                    R$ {{ number_format($totais['valor_total'], 2, ',', '.') }}
                                </td>
                                <td class="text-end fw-bold">
                                    R$ {{ number_format($totais['valor_individual'], 2, ',', '.') }}
                                </td>
                                <td class="text-end fw-bold">
                                    S/ {{ number_format($totais['valor_individual_soles'], 2, ',', '.') }}
                                </td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <div class="d-xl-none">
                @foreach($hospedagens as $hospedagem)
                    <div class="hospedagem-card p-4 rounded-3 mb-3">
                        <h5 class="text-warning fw-bold mb-3">{{ $hospedagem->ds_cidade_hos ?? '—' }}</h5>
                        <div class="row g-2 small">
                            <div class="col-12">
                                <span class="text-white-50 d-block">Hospedagem</span>
                                <strong>{{ $hospedagem->nm_hospedagem_hos }}</strong>
                            </div>
                            <div class="col-6">
                                <span class="text-white-50 d-block">Dias</span>
                                <strong>{{ $hospedagem->nu_dias_hos ?? '—' }}</strong>
                            </div>
                            <div class="col-6">
                                <span class="text-white-50 d-block">Hóspedes</span>
                                <strong>{{ $hospedagem->total_hospedes_hos ?? '—' }}</strong>
                            </div>
                            <div class="col-6">
                                <span class="text-white-50 d-block">Chegada</span>
                                <strong>{{ $hospedagem->dt_chegada_hos ? $hospedagem->dt_chegada_hos->format('d/m/Y') : '—' }}</strong>
                            </div>
                            <div class="col-6">
                                <span class="text-white-50 d-block">Saída</span>
                                <strong>{{ $hospedagem->dt_saida_hos ? $hospedagem->dt_saida_hos->format('d/m/Y') : '—' }}</strong>
                            </div>
                            <div class="col-6">
                                <span class="text-white-50 d-block">Valor total</span>
                                <strong class="text-warning">
                                    @if(!is_null($hospedagem->valor_total_hos))
                                        R$ {{ number_format($hospedagem->valor_total_hos, 2, ',', '.') }}
                                    @else
                                        —
                                    @endif
                                </strong>
                            </div>
                            <div class="col-6">
                                <span class="text-white-50 d-block">Valor / pessoa</span>
                                <strong>
                                    @if(!is_null($hospedagem->valor_calculado_por_pessoa_hos))
                                        R$ {{ number_format($hospedagem->valor_calculado_por_pessoa_hos, 2, ',', '.') }}
                                    @else
                                        —
                                    @endif
                                </strong>
                            </div>
                            <div class="col-6">
                                <span class="text-white-50 d-block">Valor / pessoa (S/)</span>
                                <strong>
                                    @if(!is_null($hospedagem->valor_calculado_por_pessoa_soles_hos))
                                        S/ {{ number_format($hospedagem->valor_calculado_por_pessoa_soles_hos, 2, ',', '.') }}
                                    @else
                                        —
                                    @endif
                                </strong>
                            </div>
                        </div>

                        @if($hospedagem->quartos->isNotEmpty())
                            <button
                                class="btn btn-outline-light btn-sm rounded-pill mt-3"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#quartos-mobile-{{ $hospedagem->cd_hospedagem_hos }}"
                                aria-expanded="false"
                                aria-controls="quartos-mobile-{{ $hospedagem->cd_hospedagem_hos }}"
                            >
                                Ver quartos ({{ $hospedagem->quartos->count() }})
                            </button>

                            <div class="collapse mt-3" id="quartos-mobile-{{ $hospedagem->cd_hospedagem_hos }}">
                                <div class="quartos-box p-3 rounded-3">
                                    @foreach($hospedagem->quartos as $quarto)
                                        <div class="quarto-item mb-2">
                                            <div class="fw-semibold">{{ $quarto->ds_quarto_hoq ?: 'Quarto sem descrição' }}</div>
                                            <div class="small text-white-50">{{ $quarto->nu_pessoas_hoq ?? 0 }} pessoa(s)</div>
                                            <div class="small text-white-50">Banheiro: {{ $quarto->fl_banheiro_hoq ? 'Sim' : 'Não' }} · Café: {{ $quarto->fl_cafe_hoq ? 'Sim' : 'Não' }}</div>
                                            @if($quarto->obs_hoq)
                                                <div class="small text-white-50 mt-1">Obs: {{ $quarto->obs_hoq }}</div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @if($hospedagem->ds_url_hos)
                            <a href="{{ $hospedagem->ds_url_hos }}" target="_blank" rel="noopener noreferrer" class="btn btn-outline-warning btn-sm rounded-pill mt-3">
                                Ver hospedagem
                            </a>
                        @endif
                    </div>
                @endforeach

                <div class="hospedagem-card p-4 rounded-3 border border-warning">
                    <div class="row g-2">
                        <div class="col-6">
                            <span class="text-white-50 d-block small">Total de dias</span>
                            <strong class="text-warning fs-5">{{ $totais['dias'] }}</strong>
                        </div>
                        <div class="col-6">
                            <span class="text-white-50 d-block small">Valor total</span>
                            <strong class="text-warning fs-5">R$ {{ number_format($totais['valor_total'], 2, ',', '.') }}</strong>
                        </div>
                        <div class="col-12 mt-2">
                            <span class="text-white-50 d-block small">Soma valor individual (R$)</span>
                            <strong class="fs-5">R$ {{ number_format($totais['valor_individual'], 2, ',', '.') }}</strong>
                        </div>
                        <div class="col-12 mt-2">
                            <span class="text-white-50 d-block small">Soma valor individual (S/)</span>
                            <strong class="fs-5">S/ {{ number_format($totais['valor_individual_soles'], 2, ',', '.') }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>

</div>

<script src="{{ asset('js/core/bootstrap.min.js') }}" type="text/javascript"></script>

<style>
    section { background: transparent !important; }
    .hospedagem-table thead th {
        background: rgba(245, 166, 35, .15);
        color: #f5a623;
        font-size: .72rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        border-bottom: 1px solid rgba(255,255,255,.12);
        white-space: nowrap;
        padding: .75rem .5rem;
    }
    .hospedagem-table td {
        vertical-align: middle;
        border-color: rgba(255,255,255,.08);
        font-size: .82rem;
        padding: .7rem .5rem;
    }
    .hospedagem-table tbody tr:hover {
        background: rgba(255,255,255,.04);
    }
    .hospedagem-table .totais-row td {
        background: rgba(245, 166, 35, .08);
        border-top: 2px solid rgba(245, 166, 35, .35);
    }
    .hospedagem-card {
        background: rgba(255,255,255,.05);
        border: 1px solid rgba(255,255,255,.1);
    }
    .quartos-box {
        background: rgba(255,255,255,.03);
        border-top: 1px dashed rgba(255,255,255,.14);
    }
    .quarto-item:last-child {
        margin-bottom: 0 !important;
    }
    .quartos-detail-row td {
        background: transparent;
    }
    .hospedagem-table td:nth-child(1) {
        min-width: 110px;
    }
    .hospedagem-table td:nth-child(2) {
        min-width: 180px;
        white-space: normal;
    }
</style>

</body>
</html>

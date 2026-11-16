@if(!empty($clima) && (!empty($clima['tem_previsao']) || !empty($clima['tem_historico']) || !empty($clima['tem_sazonalidade'])))
@php
    $atual = $clima['atual'] ?? null;
    $condicaoAtual = $atual ? $atual->condicao : ['label' => '—', 'icon' => 'fa-cloud'];
    $classLabels = [
        'excelente' => 'Excelente',
        'boa' => 'Boa',
        'moderada' => 'Moderada',
        'desfavoravel' => 'Desfavorável',
    ];
@endphp
<div class="col-md-12 mt-4 mb-3 inteligencia-climatica" id="inteligencia-climatica">
    <div class="d-flex align-items-baseline justify-content-between flex-wrap mb-2" style="gap:8px;">
        <h2 class="h6 mb-0"><i class="fa fa-cloud text-info mr-1" aria-hidden="true"></i> Inteligência Climática e Ambiental</h2>
        <span class="small text-secondary">
            Dados:
            <a href="{{ $clima['fonte_url'] }}" target="_blank" rel="noopener noreferrer">{{ $clima['fonte_nome'] }}</a>
            @if(!empty($clima['atualizado_em']))
                · Atualizado em {{ \Carbon\Carbon::parse($clima['atualizado_em'])->format('d/m/Y H:i') }}
            @endif
        </span>
    </div>

    @if(!empty($clima['tem_previsao']))
        <div class="border rounded shadow-sm p-3 bg-white mb-3">
            <h3 class="h6 text-success mb-2">Condições meteorológicas</h3>
            <p class="small text-secondary mb-3">
                Previsão meteorológica sujeita a alterações. Use como apoio ao planejamento, não como garantia de condições no dia da visita.
            </p>

            @if($atual)
                <div class="row align-items-center mb-3">
                    <div class="col-sm-4 text-center mb-2 mb-sm-0">
                        <i class="fa {{ $condicaoAtual['icon'] }} text-warning" style="font-size:2.4rem;" aria-hidden="true"></i>
                        <div class="font-weight-bold mt-1">{{ $condicaoAtual['label'] }}</div>
                        @if($atual->nu_temp_atual_clp !== null)
                            <div style="font-size:1.8rem;line-height:1.1;">{{ number_format((float)$atual->nu_temp_atual_clp, 0) }}°C</div>
                        @endif
                        <div class="small text-secondary">
                            @if($atual->nu_temp_min_clp !== null || $atual->nu_temp_max_clp !== null)
                                {{ $atual->nu_temp_min_clp !== null ? number_format((float)$atual->nu_temp_min_clp, 0).'°' : '—' }}
                                /
                                {{ $atual->nu_temp_max_clp !== null ? number_format((float)$atual->nu_temp_max_clp, 0).'°' : '—' }}
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="row small">
                            <div class="col-6 mb-2"><i class="fa fa-umbrella text-info" aria-hidden="true"></i> Chuva:
                                {{ $atual->nu_precip_prob_clp !== null ? number_format((float)$atual->nu_precip_prob_clp, 0).'%' : '—' }}
                                @if($atual->nu_precip_mm_clp !== null)
                                    ({{ number_format((float)$atual->nu_precip_mm_clp, 1) }} mm)
                                @endif
                            </div>
                            <div class="col-6 mb-2"><i class="fa fa-flag text-secondary" aria-hidden="true"></i> Vento:
                                {{ $atual->nu_vento_kmh_clp !== null ? number_format((float)$atual->nu_vento_kmh_clp, 0).' km/h' : '—' }}
                            </div>
                            <div class="col-6 mb-2"><i class="fa fa-tachometer text-secondary" aria-hidden="true"></i> Rajadas:
                                {{ $atual->nu_rajada_kmh_clp !== null ? number_format((float)$atual->nu_rajada_kmh_clp, 0).' km/h' : '—' }}
                            </div>
                            <div class="col-6 mb-2"><i class="fa fa-tint text-primary" aria-hidden="true"></i> Umidade:
                                {{ $atual->nu_umidade_clp !== null ? number_format((float)$atual->nu_umidade_clp, 0).'%' : '—' }}
                            </div>
                            <div class="col-6 mb-2"><i class="fa fa-cloud text-secondary" aria-hidden="true"></i> Nebulosidade:
                                {{ $atual->nu_nebulosidade_clp !== null ? number_format((float)$atual->nu_nebulosidade_clp, 0).'%' : '—' }}
                            </div>
                            <div class="col-6 mb-2"><i class="fa fa-sun-o text-warning" aria-hidden="true"></i> UV:
                                {{ $atual->nu_indice_uv_clp !== null ? number_format((float)$atual->nu_indice_uv_clp, 1) : '—' }}
                            </div>
                            <div class="col-6 mb-0"><i class="fa fa-sun-o text-warning" aria-hidden="true"></i> Nascer:
                                {{ $atual->hr_nascer_sol_clp ?: '—' }}
                            </div>
                            <div class="col-6 mb-0"><i class="fa fa-moon-o text-secondary" aria-hidden="true"></i> Pôr:
                                {{ $atual->hr_por_sol_clp ?: '—' }}
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <h4 class="h6 mb-2">Previsão para os próximos 7 dias</h4>
            <div class="d-flex flex-wrap" style="gap:10px;">
                @foreach($clima['previsoes'] as $dia)
                    @php
                        $cond = $dia->condicao;
                        $dataDia = \Carbon\Carbon::parse($dia->dt_previsao_clp);
                    @endphp
                    <div class="text-center rounded border p-2 bg-light" style="min-width:92px;flex:1 1 92px;">
                        <div class="small font-weight-bold text-uppercase">{{ $dataDia->locale('pt_BR')->isoFormat('ddd') }}</div>
                        <div class="small text-secondary">{{ $dataDia->format('d/m') }}</div>
                        <i class="fa {{ $cond['icon'] }} text-info my-1" aria-hidden="true"></i>
                        <div class="small" style="line-height:1.2;">{{ $cond['label'] }}</div>
                        <div class="font-weight-bold mt-1" style="font-size:.95rem;">
                            {{ $dia->nu_temp_min_clp !== null ? number_format((float)$dia->nu_temp_min_clp, 0) : '—' }}°
                            /
                            {{ $dia->nu_temp_max_clp !== null ? number_format((float)$dia->nu_temp_max_clp, 0) : '—' }}°
                        </div>
                        <div class="small text-info mt-1">
                            <i class="fa fa-umbrella" aria-hidden="true"></i>
                            {{ $dia->nu_precip_prob_clp !== null ? number_format((float)$dia->nu_precip_prob_clp, 0).'%' : '—' }}
                        </div>
                        <div class="small text-secondary">
                            {{ $dia->nu_vento_kmh_clp !== null ? number_format((float)$dia->nu_vento_kmh_clp, 0).' km/h' : '' }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    @if(!empty($clima['recomendacoes']))
        <div class="border rounded shadow-sm p-3 bg-white mb-3">
            <h3 class="h6 text-success mb-2">Recomendações para o visitante</h3>
            <ul class="mb-0 pl-3 small">
                @foreach($clima['recomendacoes'] as $rec)
                    <li class="mb-1">{{ $rec }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(!empty($clima['tem_historico']))
        <div class="border rounded shadow-sm p-3 bg-white mb-3">
            <h3 class="h6 text-success mb-2">Histórico climático da região</h3>
            <p class="small text-secondary mb-2">
                Médias mensais
                @if(!empty($clima['ano_inicio']) && !empty($clima['ano_fim']))
                    ({{ $clima['ano_inicio'] }}–{{ $clima['ano_fim'] }})
                @endif
                com base em dados históricos. Não representa a previsão do mês atual.
                @if(!empty($clima['historico_atualizado_em']))
                    Atualizado em {{ \Carbon\Carbon::parse($clima['historico_atualizado_em'])->format('d/m/Y') }}.
                @endif
            </p>
            <div style="position:relative;height:260px;">
                <canvas id="climaHistoricoChart" aria-label="Gráfico de histórico climático" role="img"></canvas>
            </div>
        </div>
    @endif

    @if(!empty($clima['tem_sazonalidade']))
        <div class="border rounded shadow-sm p-3 bg-white mb-1">
            <h3 class="h6 text-success mb-2">Melhor época para visitar</h3>
            <p class="small text-secondary mb-3">
                Classificação baseada em critérios climáticos históricos configuráveis (precipitação, dias com chuva, temperatura e vento).
                Não é garantia de segurança nem de condições adequadas no dia da visita.
            </p>
            <div class="row">
                @foreach($clima['calendario'] as $item)
                    @php
                        $cls = $item['classificacao'];
                        $bg = [
                            'excelente' => '#d4edda',
                            'boa' => '#e2f0d9',
                            'moderada' => '#fff3cd',
                            'desfavoravel' => '#f8d7da',
                        ];
                        $fg = [
                            'excelente' => '#155724',
                            'boa' => '#2d572c',
                            'moderada' => '#856404',
                            'desfavoravel' => '#721c24',
                        ];
                    @endphp
                    <div class="col-4 col-sm-3 col-md-2 mb-2">
                        <div class="rounded text-center p-2 h-100" style="background:{{ $bg[$cls] ?? '#f1f1f1' }};color:{{ $fg[$cls] ?? '#333' }};" title="{{ $item['justificativa'] }}">
                            <div class="font-weight-bold">{{ $item['label'] }}</div>
                            <div class="small">{{ $classLabels[$cls] ?? ucfirst($cls) }}</div>
                            <div class="small">{{ number_format($item['indice'], 0) }}/100</div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="small text-secondary mt-2">
                Passe o cursor (ou toque prolongado) sobre o mês para ver a justificativa. Metodologia {{ config('clima.metodologia_sazonalidade', 'v1') }}.
            </div>
        </div>
    @endif
</div>

@if(!empty($clima['tem_historico']))
<script type="application/json" id="climaHistoricoChartData">@json($clima['chart'])</script>
@endif
@endif

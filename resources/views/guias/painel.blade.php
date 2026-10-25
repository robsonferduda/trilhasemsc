@extends('layouts.admin')
@section('pageTitle', 'Painel | Trilhas em SC')

@section('content')
<style>
    .gd-topo {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        gap: 16px;
        margin-bottom: 18px;
    }
    .gd-topo h2 {
        margin: 0 0 4px;
        font-weight: 800;
        letter-spacing: -0.03em;
    }
    .gd-topo p {
        margin: 0;
        color: #718096;
    }
    .gd-numeros {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 12px;
        margin-bottom: 14px;
    }
    .gd-numero {
        padding: 16px;
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
    }
    .gd-numero span {
        display: block;
        color: #718096;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.04em;
        text-transform: uppercase;
    }
    .gd-numero strong {
        display: block;
        margin-top: 6px;
        font-size: 1.6rem;
        line-height: 1.1;
        color: #1a202c;
    }
    .gd-numero small {
        color: #718096;
    }
    .gd-numero.is-eventos { background: #f0fdf4; border-color: #bbf7d0; }
    .gd-numero.is-vistas { background: #f5f3ff; border-color: #ddd6fe; }
    .gd-numero.is-contatos { background: #fffbeb; border-color: #fde68a; }
    .gd-numero.is-vagas { background: #fff1f2; border-color: #fecdd3; }
    a.gd-numero { color: inherit; text-decoration: none; }
    .gd-numero { position: relative; }
    .gd-numero i {
        position: absolute;
        top: 14px;
        right: 14px;
        font-size: 1.6rem;
        opacity: .85;
    }
    .gd-numero.is-eventos i { color: #16a34a; }
    .gd-numero.is-vistas i { color: #7c3aed; }
    .gd-numero.is-contatos i { color: #d97706; }
    .gd-numero.is-vagas i { color: #e11d48; }
    .gd-colunas {
        display: grid;
        grid-template-columns: 1.15fr 0.85fr;
        gap: 12px;
    }
    .gd-dias {
        display: flex;
        align-items: flex-end;
        gap: 10px;
        height: 150px;
    }
    .gd-dia { flex: 1; display: flex; flex-direction: column; justify-content: flex-end; align-items: center; height: 100%; min-width: 0; }
    .gd-par { display: flex; align-items: flex-end; gap: 3px; width: 100%; height: 120px; }
    .gd-barra { display: block; flex: 1; border-radius: 4px 4px 0 0; min-height: 3px; }
    .gd-barra.is-perfil { background: #7c3aed; }
    .gd-barra.is-eventos { background: #16a34a; }
    .gd-barra.is-zero { background: #edf2f7; }
    .gd-dia small { margin-top: 6px; color: #718096; font-size: 0.72rem; }
    .gd-legenda { display: flex; gap: 14px; margin-top: 12px; color: #718096; font-size: 0.82rem; }
    .gd-legenda i { display: inline-block; width: 10px; height: 10px; border-radius: 2px; margin-right: 4px; }
    .gd-legenda .is-perfil { background: #7c3aed; }
    .gd-legenda .is-eventos { background: #16a34a; }
    .gd-card {
        margin-bottom: 14px;
        padding: 20px;
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 18px;
    }
    .gd-card h3 {
        margin: 0 0 14px;
        font-size: 1.1rem;
        font-weight: 800;
    }
    .gd-fila {
        display: flex;
        justify-content: space-between;
        gap: 12px;
        align-items: center;
        padding: 12px 0;
        border-top: 1px solid #edf2f7;
        text-decoration: none;
        color: inherit;
    }
    .gd-fila:first-of-type { border-top: 0; padding-top: 0; }
    .gd-fila strong { display: block; }
    .gd-fila span, .gd-evento span { color: #718096; font-size: 0.88rem; }
    .gd-acao {
        flex: 0 0 auto;
        font-size: 0.82rem;
        font-weight: 700;
        color: #c2410c;
    }
    .gd-evento {
        display: flex;
        justify-content: space-between;
        gap: 12px;
        align-items: center;
        padding: 14px 0;
        border-top: 1px solid #edf2f7;
    }
    .gd-evento:first-of-type { border-top: 0; padding-top: 0; }
    .gd-evento h4 { margin: 0 0 2px; font-size: 1rem; font-weight: 800; }
    .gd-links { display: flex; flex-wrap: wrap; gap: 8px; }
    @media (max-width: 991.98px) {
        .gd-numeros, .gd-colunas { grid-template-columns: 1fr; }
        .gd-topo, .gd-evento, .gd-fila { align-items: flex-start; flex-direction: column; }
    }
</style>

@php
    $primeiro = explode(' ', trim(Auth::user()->name))[0];
    $proximosVisiveis = $proximos->take(6);
@endphp

<div class="gd-topo">
    <div>
        <h2>Olá, {{ $primeiro }}</h2>
        <p>O que está no ar e quem procurou você nesta semana.</p>
    </div>
    <a href="{{ url('guia-e-condutores/privado/evento/novo') }}" class="btn btn-primary">Novo evento</a>
</div>

@if(!$guia->fl_perfil_completo_gui)
    <div class="alert alert-warning">
        Seu perfil público ainda não está no ar.
        <a href="{{ url('guia-e-condutores/privado/atualizar-cadastro') }}">Conclua seus dados</a>
        para aparecer na busca de guias.
    </div>
@endif

<div class="gd-numeros">
    <a class="gd-numero is-eventos" href="{{ url('guia-e-condutores/privado/eventos') }}">
        <i class="bi bi-signpost-2"></i>
        <span>Eventos à frente</span>
        <strong>{{ $eventosAtivos }}</strong>
        <small>{{ $proximos->count() }} na agenda</small>
    </a>
    <a class="gd-numero is-vistas" href="{{ url('guia-e-condutores/privado/acessos') }}">
        <i class="bi bi-bar-chart"></i>
        <span>Visualizações</span>
        <strong>{{ $visitas7 }}</strong>
        <small>perfil e eventos, 7 dias</small>
    </a>
    <a class="gd-numero is-contatos" href="{{ url('guia/perfil/'.($guia->nm_instagram_gui ?: $guia->id_guia_gui)) }}#avaliacoes">
        <i class="bi bi-chat-dots"></i>
        <span>Avaliações</span>
        <strong>{{ $mediaAvaliacao === null ? '–' : number_format((float) $mediaAvaliacao, 1, ',', '') }}</strong>
        <small>{{ $totalAvaliacoes }} {{ $totalAvaliacoes === 1 ? 'avaliação' : 'avaliações' }}</small>
    </a>
    <a class="gd-numero is-vagas" href="{{ url('guia/perfil/'.($guia->nm_instagram_gui ?: $guia->id_guia_gui)) }}">
        <i class="bi bi-heart"></i>
        <span>Favoritos</span>
        <strong>{{ $totalFavoritos }}</strong>
        <small>avisados quando você lançar um passeio</small>
    </a>
</div>

<div class="gd-colunas">
<div class="gd-card">
    <h3>Atividades recentes</h3>
    @forelse(array_slice($fila, 0, 8) as $item)
        <a class="gd-fila" href="{{ $item['url'] }}">
            <div>
                <strong>{{ $item['nome'] }}</strong>
                <span>
                    {{ $item['evento'] }} · {{ \Carbon\Carbon::parse($item['quando'])->format('d/m') }}
                    @if($item['faltas'])
                        · falta {{ implode(', ', $item['faltas']) }}
                    @endif
                </span>
            </div>
            <span class="gd-acao">{{ $item['acao'] }}</span>
        </a>
    @empty
        <p class="mb-0 text-muted">Nenhuma pessoa esperando resposta nos próximos eventos.</p>
    @endforelse
    @if(count($fila) > 8)
        <p class="mb-0 mt-3 text-muted">E mais {{ count($fila) - 8 }} {{ count($fila) - 8 === 1 ? 'pendência' : 'pendências' }} nos eventos abaixo.</p>
    @endif
</div>

<div class="gd-card">
    <h3>Visualizações</h3>
    <p class="text-muted mb-3">{{ $periodo }}</p>
    <div class="gd-dias">
        @foreach($dias as $dia)
            <div class="gd-dia" title="{{ $dia['rotulo'] }}: {{ $dia['perfil'] }} no perfil, {{ $dia['eventos'] }} em eventos">
                <div class="gd-par">
                    <span class="gd-barra is-perfil {{ $dia['perfil'] === 0 ? 'is-zero' : '' }}" style="height: {{ max(3, (int) round(($dia['perfil'] / $maior) * 100)) }}%"></span>
                    <span class="gd-barra is-eventos {{ $dia['eventos'] === 0 ? 'is-zero' : '' }}" style="height: {{ max(3, (int) round(($dia['eventos'] / $maior) * 100)) }}%"></span>
                </div>
                <small>{{ $dia['rotulo'] }}</small>
            </div>
        @endforeach
    </div>
    <div class="gd-legenda">
        <span><i class="is-perfil"></i>Perfil</span>
        <span><i class="is-eventos"></i>Eventos</span>
    </div>
</div>
</div>

<div class="gd-card">
    <h3>Próximos eventos</h3>
    @forelse($proximosVisiveis as $evento)
        @php $resumo = $evento->resumoFinanceiro(); @endphp
        <div class="gd-evento">
            <div>
                <h4>
                    {{ $evento->nm_evento_eve }}
                    @if(!$evento->fl_ativo_eve)
                        <span class="badge bg-secondary">Não publicado</span>
                    @endif
                </h4>
                <span>
                    {{ \Carbon\Carbon::parse($evento->dt_realizacao_eve)->format('d/m/Y') }}
                    @if(optional($evento->local)->nm_cidade_cde)
                        · {{ $evento->local->nm_cidade_cde }}
                    @endif
                    · {{ $resumo['pagos'] }} {{ $resumo['pagos'] === 1 ? 'vaga paga' : 'vagas pagas' }}
                    @if($evento->limiteVagas())
                        de {{ $evento->limiteVagas() }}
                    @endif
                    · sobra {{ \App\EventoGasto::reais($resumo['sobra']) }}
                </span>
            </div>
            <div class="gd-links">
                <a class="btn btn-outline-danger btn-sm" href="{{ url('guia-e-condutores/privado/eventos/participantes', $evento->id_evento_eve) }}">Participantes</a>
                <a class="btn btn-outline-success btn-sm" href="{{ url('guia-e-condutores/privado/eventos/gastos', $evento->id_evento_eve) }}">Gastos</a>
            </div>
        </div>
    @empty
        <p class="mb-3">Nenhum passeio à frente. O próximo evento é o que coloca você na busca de quem quer trilhar.</p>
        <a href="{{ url('guia-e-condutores/privado/evento/novo') }}" class="btn btn-primary">Cadastrar evento</a>
    @endforelse
    @if($proximos->count() > 6)
        <p class="mb-0 mt-3"><a href="{{ url('guia-e-condutores/privado/eventos') }}">Ver todos os eventos</a></p>
    @endif
</div>
@endsection

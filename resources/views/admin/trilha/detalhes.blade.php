@extends('layouts.template')

@section('content')
<div class="block-header">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-12">
            <h2>
                <a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>
                Trilhas
            </h2>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-leaf"></i> Trilhas</li>
                <li class="breadcrumb-item"><a href="{{ url('admin/listar-trilhas') }}">Listar</a></li>
                <li class="breadcrumb-item">Detalhes</li>
                <li class="breadcrumb-item"><strong>{{ $trilha->nm_trilha_tri }}</strong></li>
            </ul>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 text-right">
            <a href="{{ url('admin/editar-trilha/'.$trilha->id_trilha_tri) }}" class="btn btn-primary"><i class="fa fa-edit"></i> Editar trilha</a>
        </div>
    </div>
</div>

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12">
        @include('layouts.mensagens')
    </div>

    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card">
            <div class="body">
                <h6 class="text-muted mb-1">Acessos totais</h6>
                <h3 class="mb-0">{{ number_format($totalAcessos, 0, ',', '.') }}</h3>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card">
            <div class="body">
                <h6 class="text-muted mb-1">Acessos no período</h6>
                <h3 class="mb-0">{{ number_format($totalPeriodo, 0, ',', '.') }}</h3>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card">
            <div class="body">
                <h6 class="text-muted mb-1">Status</h6>
                @if($trilha->fl_publicacao_tri == 'S')
                    <span class="badge badge-success">Publicado</span>
                @else
                    <span class="badge badge-danger">Não publicado</span>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card">
            <div class="body">
                <h6 class="text-muted mb-1">Nível</h6>
                <h5 class="mb-0">{{ optional($trilha->nivel)->dc_nivel_niv ?? '-' }}</h5>
            </div>
        </div>
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="header">
                <h2><i class="fa fa-line-chart"></i> Acessos por período</h2>
            </div>
            <div class="body">
                <form method="GET" action="{{ route('admin.trilha.detalhes', $trilha->id_trilha_tri) }}" class="mb-4">
                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-sm-12">
                            <label for="periodo">Período</label>
                            <select name="periodo" id="periodo" class="form-control" onchange="this.form.submit()">
                                @foreach($periodosValidos as $item)
                                    <option value="{{ $item }}" {{ $periodo == $item ? 'selected' : '' }}>Últimos {{ $item }} dias</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-9 col-md-8 col-sm-12 d-flex align-items-end">
                            <p class="text-muted mb-0">URL: <strong>{{ $trilha->ds_url_tri }}</strong></p>
                        </div>
                    </div>
                </form>

                <div class="trilha-chart-wrapper">
                    <div class="trilha-chart-scroll">
                        <canvas id="acessosChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card" style="border: 1px solid #e9ecef; box-shadow: none;">
            <div class="header">
                <h2><i class="fa fa-envelope"></i> Convites por email</h2>
                <small class="text-muted">Envie um teste para o admin antes do disparo em massa.</small>
            </div>
            <div class="body">
                <div class="row">
                    <div class="col-md-6" style="margin-bottom: 20px;">
                        <h5 class="text-success">Trilheiros</h5>
                        <p class="mb-2">Convida a conhecer a aventura com detalhes da trilha.</p>
                        <p class="text-muted mb-3">
                            Destinatários: <strong>{{ $totalTrilheirosNewsletter ?? 0 }}</strong> trilheiro(s) com newsletter ativa.
                        </p>
                        <form action="{{ route('admin.trilha.email-teste-convite', $trilha->id_trilha_tri) }}" method="post" style="display:inline-block; margin-right: 6px;">
                            @csrf
                            <input type="hidden" name="tipo" value="trilheiro">
                            <button type="submit" class="btn btn-outline-warning btn-sm">
                                <i class="fa fa-flask"></i> Enviar teste
                            </button>
                        </form>
                        <form action="{{ route('admin.trilha.email-convite-trilheiros', $trilha->id_trilha_tri) }}" method="post" style="display:inline-block;" onsubmit="return confirm('Enviar convite desta trilha para {{ $totalTrilheirosNewsletter ?? 0 }} trilheiro(s)?');">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm" {{ empty($totalTrilheirosNewsletter) ? 'disabled' : '' }}>
                                <i class="fa fa-paper-plane"></i> Enviar para trilheiros
                            </button>
                        </form>
                    </div>
                    <div class="col-md-6" style="margin-bottom: 20px;">
                        <h5 class="text-info">Guias e Condutores</h5>
                        <p class="mb-2">Convida a se cadastrar como executor desta trilha.</p>
                        <p class="text-muted mb-3">
                            Destinatários: <strong>{{ $totalGuiasAtivos ?? 0 }}</strong> guia(s) ativo(s).
                        </p>
                        <form action="{{ route('admin.trilha.email-teste-convite', $trilha->id_trilha_tri) }}" method="post" style="display:inline-block; margin-right: 6px;">
                            @csrf
                            <input type="hidden" name="tipo" value="guia">
                            <button type="submit" class="btn btn-outline-warning btn-sm">
                                <i class="fa fa-flask"></i> Enviar teste
                            </button>
                        </form>
                        <form action="{{ route('admin.trilha.email-convite-guias', $trilha->id_trilha_tri) }}" method="post" style="display:inline-block;" onsubmit="return confirm('Enviar convite desta trilha para {{ $totalGuiasAtivos ?? 0 }} guia(s)?');">
                            @csrf
                            <button type="submit" class="btn btn-info btn-sm" {{ empty($totalGuiasAtivos) ? 'disabled' : '' }}>
                                <i class="fa fa-paper-plane"></i> Enviar para guias
                            </button>
                        </form>
                    </div>
                </div>
                <p class="small text-muted mb-0">
                    O email de teste é enviado para <strong>{{ Auth::user()->email }}</strong>.
                </p>
            </div>
        </div>
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="header">
                <h2><i class="fa fa-history"></i> Histórico de envios</h2>
                <small class="text-muted">Registros de disparos de convite por email para esta trilha.</small>
            </div>
            <div class="body">
                @if(($historicoEnvios ?? collect())->count())
                    <div class="table-responsive">
                        <table class="table table-hover table-custom mb-0">
                            <thead>
                                <tr>
                                    <th>Tipo de envio</th>
                                    <th>Total enviado</th>
                                    <th>Data do envio</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($historicoEnvios as $envio)
                                    <tr>
                                        <td>
                                            @if((int) $envio->cd_tipo_envio_tie === 1)
                                                <span class="badge badge-success">Trilheiros</span>
                                            @elseif((int) $envio->cd_tipo_envio_tie === 2)
                                                <span class="badge badge-info">Guias</span>
                                            @else
                                                <span class="badge badge-secondary">Tipo {{ $envio->cd_tipo_envio_tie }}</span>
                                            @endif
                                        </td>
                                        <td>{{ number_format((int) $envio->nu_total_envios_loe, 0, ',', '.') }}</td>
                                        <td>
                                            @if($envio->dt_envio_loe)
                                                {{ \Carbon\Carbon::parse($envio->dt_envio_loe)->format('d/m/Y H:i') }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-info mb-0">Nenhum envio registrado para esta trilha.</div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<style>
    .trilha-chart-wrapper {
        position: relative;
        width: 100%;
        height: 320px;
    }

    .trilha-chart-scroll {
        position: relative;
        width: 100%;
        height: 100%;
        overflow-x: auto;
        overflow-y: hidden;
    }

    @media (max-width: 767.98px) {
        .trilha-chart-wrapper {
            height: 220px;
        }
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript">
    $(function () {
        const labels = @json($labelsAcessos);
        const values = @json($valoresAcessos);

        const canvas = document.getElementById('acessosChart');
        if (!canvas) {
            return;
        }

        const ctx = canvas.getContext('2d');

        if (window.adminTrilhaAcessosChart) {
            window.adminTrilhaAcessosChart.destroy();
        }

        window.adminTrilhaAcessosChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Acessos por dia',
                    data: values,
                    borderColor: '#17a2b8',
                    backgroundColor: 'rgba(23, 162, 184, 0.15)',
                    borderWidth: 2,
                    pointRadius: 2,
                    pointHoverRadius: 4,
                    fill: true,
                    tension: 0.25
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                animation: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true
                    }
                }
            }
        });
    });
</script>
@endsection

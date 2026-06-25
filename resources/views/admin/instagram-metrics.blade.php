@extends('layouts.template')

@section('content')
<div class="block-header">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-12">
            <h2 class="mb-2"><i class="fa fa-instagram"></i> Instagram - Métricas</h2>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item">Instagram</li>
                <li class="breadcrumb-item active">Métricas</li>
            </ul>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 text-right">
            <form method="GET" action="{{ route('admin.instagram.metricas') }}" class="form-inline justify-content-end">
                <label class="mr-2">Período:</label>
                <select name="days" class="form-control" onchange="this.form.submit()">
                    <option value="7" {{ $days === 7 ? 'selected' : '' }}>7 dias</option>
                    <option value="30" {{ $days === 30 ? 'selected' : '' }}>30 dias</option>
                    <option value="60" {{ $days === 60 ? 'selected' : '' }}>60 dias</option>
                    <option value="90" {{ $days === 90 ? 'selected' : '' }}>90 dias</option>
                </select>
            </form>
        </div>
    </div>
</div>

<div class="row clearfix">
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card top_counter">
            <div class="body">
                <div class="icon"><i class="fa fa-users" style="color: #1e88e5;"></i></div>
                <div class="content">
                    <div class="text">Seguidores</div>
                    <h5 class="number">{{ optional($latest)->followers_count ?: '-' }}</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card top_counter">
            <div class="body">
                <div class="icon"><i class="fa fa-bullseye" style="color: #43a047;"></i></div>
                <div class="content">
                    <div class="text">Alcance ({{ $days }}d)</div>
                    <h5 class="number">{{ number_format($totalReach, 0, ',', '.') }}</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card top_counter">
            <div class="body">
                <div class="icon"><i class="fa fa-eye" style="color: #fb8c00;"></i></div>
                <div class="content">
                    <div class="text">Visualizações ({{ $days }}d)</div>
                    <h5 class="number">{{ $totalViews !== null ? number_format($totalViews, 0, ',', '.') : '-' }}</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card top_counter">
            <div class="body">
                <div class="icon"><i class="fa fa-link" style="color: #8e24aa;"></i></div>
                <div class="content">
                    <div class="text">Cliques médios no site</div>
                    <h5 class="number">{{ $avgWebsiteClicks !== null ? number_format($avgWebsiteClicks, 0, ',', '.') : '-' }}</h5>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row clearfix">
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card top_counter">
            <div class="body">
                <div class="icon"><i class="fa fa-line-chart" style="color: #1565c0;"></i></div>
                <div class="content">
                    <div class="text">Score médio</div>
                    <h5 class="number">{{ number_format($scoreAverage, 0, ',', '.') }}</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card top_counter">
            <div class="body">
                <div class="icon"><i class="fa fa-arrow-up" style="color: #2e7d32;"></i></div>
                <div class="content">
                    <div class="text">Dias acima do esperado</div>
                    <h5 class="number">{{ $statusSummary['above'] }}</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card top_counter">
            <div class="body">
                <div class="icon"><i class="fa fa-minus" style="color: #616161;"></i></div>
                <div class="content">
                    <div class="text">Dias normais</div>
                    <h5 class="number">{{ $statusSummary['normal'] }}</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card top_counter">
            <div class="body">
                <div class="icon"><i class="fa fa-arrow-down" style="color: #c62828;"></i></div>
                <div class="content">
                    <div class="text">Dias abaixo do esperado</div>
                    <h5 class="number">{{ $statusSummary['below'] }}</h5>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>Leitura inteligente do período</h2>
                @if($latestScore)
                    <small>
                        Último dia: {{ $latestScore['date']->format('d/m/Y') }}
                        | Score: {{ number_format($latestScore['score'], 0, ',', '.') }}
                        | Status: {{ $latestScore['status'] === 'above' ? 'acima do esperado' : ($latestScore['status'] === 'below' ? 'abaixo do esperado' : 'normal') }}
                    </small>
                @endif
            </div>
            <div class="body table-responsive">
                @if($scoreRows->isEmpty())
                    <div class="alert alert-warning mb-0">Sem dados suficientes para analise de score.</div>
                @else
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Score</th>
                                <th>Status</th>
                                <th>Recomendação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($scoreRows as $row)
                                <tr>
                                    <td>{{ $row['date']->format('d/m/Y') }}</td>
                                    <td>{{ number_format($row['score'], 0, ',', '.') }}</td>
                                    <td>
                                        @if($row['status'] === 'above')
                                            <span class="badge badge-success">Acima</span>
                                        @elseif($row['status'] === 'below')
                                            <span class="badge badge-danger">Abaixo</span>
                                        @else
                                            <span class="badge badge-secondary">Normal</span>
                                        @endif
                                    </td>
                                    <td>{{ $row['recommendation'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>Melhores horários por alcance</h2>
                @if($bestHour)
                    <small>
                        Melhor faixa atual: {{ $bestHour['range_label'] }}
                        | Média de alcance: {{ number_format($bestHour['avg_reach'], 0, ',', '.') }}
                        | Publicações analisadas: {{ $bestHour['posts_count'] }}
                    </small>
                @endif
            </div>
            <div class="body table-responsive">
                @if($topHours->isEmpty())
                    <div class="alert alert-warning mb-0">
                        Ainda não há dados suficientes por publicação para sugerir horários.
                        Execute <strong>php artisan instagram:sync-media-metrics --days=60 --limit=100</strong>.
                    </div>
                @else
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Posição</th>
                                <th>Faixa de horário</th>
                                <th>Publicações</th>
                                <th>Alcance total</th>
                                <th>Alcance médio</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($topHours as $index => $hour)
                                <tr>
                                    <td>#{{ $index + 1 }}</td>
                                    <td>{{ $hour['range_label'] }}</td>
                                    <td>{{ $hour['posts_count'] }}</td>
                                    <td>{{ number_format($hour['total_reach'], 0, ',', '.') }}</td>
                                    <td>{{ number_format($hour['avg_reach'], 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>Comparativo com o período anterior</h2>
                <small>Baseado nos mesmos dias anteriores aos selecionados no filtro.</small>
            </div>
            <div class="body">
                <div class="row clearfix">
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="card">
                            <div class="body">
                                <div class="text-muted">Seguidores</div>
                                <h4 class="mb-0">{{ number_format($comparison['followers_count']['current'], 0, ',', '.') }}</h4>
                                <small>
                                    @if($comparison['followers_count']['percent'] !== null)
                                        {{ $comparison['followers_count']['delta'] >= 0 ? '+' : '' }}{{ number_format($comparison['followers_count']['delta'], 0, ',', '.') }}
                                        ({{ $comparison['followers_count']['percent'] >= 0 ? '+' : '' }}{{ number_format($comparison['followers_count']['percent'], 1, ',', '.') }}%)
                                    @else
                                        sem base anterior suficiente
                                    @endif
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="card">
                            <div class="body">
                                <div class="text-muted">Alcance</div>
                                <h4 class="mb-0">{{ number_format($comparison['reach']['current'], 0, ',', '.') }}</h4>
                                <small>
                                    @if($comparison['reach']['percent'] !== null)
                                        {{ $comparison['reach']['delta'] >= 0 ? '+' : '' }}{{ number_format($comparison['reach']['delta'], 0, ',', '.') }}
                                        ({{ $comparison['reach']['percent'] >= 0 ? '+' : '' }}{{ number_format($comparison['reach']['percent'], 1, ',', '.') }}%)
                                    @else
                                        sem base anterior suficiente
                                    @endif
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="card">
                            <div class="body">
                                <div class="text-muted">Visualizações</div>
                                <h4 class="mb-0">{{ number_format($comparison['views']['current'], 0, ',', '.') }}</h4>
                                <small>
                                    @if($comparison['views']['percent'] !== null)
                                        {{ $comparison['views']['delta'] >= 0 ? '+' : '' }}{{ number_format($comparison['views']['delta'], 0, ',', '.') }}
                                        ({{ $comparison['views']['percent'] >= 0 ? '+' : '' }}{{ number_format($comparison['views']['percent'], 1, ',', '.') }}%)
                                    @else
                                        sem base anterior suficiente
                                    @endif
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="card">
                            <div class="body">
                                <div class="text-muted">Visitas no perfil</div>
                                <h4 class="mb-0">{{ number_format($comparison['profile_views']['current'], 0, ',', '.') }}</h4>
                                <small>
                                    @if($comparison['profile_views']['percent'] !== null)
                                        {{ $comparison['profile_views']['delta'] >= 0 ? '+' : '' }}{{ number_format($comparison['profile_views']['delta'], 0, ',', '.') }}
                                        ({{ $comparison['profile_views']['percent'] >= 0 ? '+' : '' }}{{ number_format($comparison['profile_views']['percent'], 1, ',', '.') }}%)
                                    @else
                                        sem base anterior suficiente
                                    @endif
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="card">
                            <div class="body">
                                <div class="text-muted">Cliques no site</div>
                                <h4 class="mb-0">{{ number_format($comparison['website_clicks']['current'], 0, ',', '.') }}</h4>
                                <small>
                                    @if($comparison['website_clicks']['percent'] !== null)
                                        {{ $comparison['website_clicks']['delta'] >= 0 ? '+' : '' }}{{ number_format($comparison['website_clicks']['delta'], 0, ',', '.') }}
                                        ({{ $comparison['website_clicks']['percent'] >= 0 ? '+' : '' }}{{ number_format($comparison['website_clicks']['percent'], 1, ',', '.') }}%)
                                    @else
                                        sem base anterior suficiente
                                    @endif
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>Últimos snapshots coletados</h2>
                <small>
                    Conta: {{ $accountId ?: 'não configurada' }}
                    @if($latest)
                        | Última atualização: {{ $latest->metric_date->format('d/m/Y') }}
                    @endif
                </small>
            </div>
            <div class="body table-responsive">
                @if($snapshots->isEmpty())
                    <div class="alert alert-warning mb-0">
                        Nenhum dado coletado ainda. Execute o comando <strong>php artisan instagram:sync-metrics</strong> após configurar as variáveis de ambiente.
                    </div>
                @else
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Seguidores</th>
                                <th>Alcance</th>
                                <th>Visualizações</th>
                                <th>Visitas no Perfil</th>
                                <th>Cliques no Site</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($snapshots as $snapshot)
                                <tr>
                                    <td>{{ $snapshot->metric_date->format('d/m/Y') }}</td>
                                    <td>{{ $snapshot->followers_count !== null ? number_format((int) $snapshot->followers_count, 0, ',', '.') : '-' }}</td>
                                    <td>{{ $snapshot->reach !== null ? number_format((int) $snapshot->reach, 0, ',', '.') : '-' }}</td>
                                    <td>{{ $snapshot->views !== null ? number_format((int) $snapshot->views, 0, ',', '.') : '-' }}</td>
                                    <td>{{ $snapshot->profile_views !== null ? number_format((int) $snapshot->profile_views, 0, ',', '.') : '-' }}</td>
                                    <td>{{ $snapshot->website_clicks !== null ? number_format((int) $snapshot->website_clicks, 0, ',', '.') : '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

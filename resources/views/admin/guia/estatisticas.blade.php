@extends('layouts.admin')

@section('pageTitle', 'Estatísticas dos guias | Trilhas em SC')

@section('content')
@php
    $tom = [
        'aviso' => 'background:#fff4d6;color:#7a5b00;',
        'info' => 'background:#e7f1ff;color:#1d4f91;',
        'alerta' => 'background:#fde8e8;color:#8d2a2a;',
        'neutro' => 'background:#eef1f4;color:#3d4a57;',
        'ok' => 'background:#e5f6ea;color:#1e7a3a;',
    ];
@endphp
<div class="block-header">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-12">
            <h2 class="mb-2"><i class="fa fa-bar-chart"></i> Estatísticas dos guias</h2>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item"><a href="{{ url('admin/guias/listar') }}">Guias</a></li>
                <li class="breadcrumb-item active">Estatísticas</li>
            </ul>
            <p class="text-muted mb-0">Período {{ $periodo }}. O perfil conta visitas de outras pessoas. O acesso ao sistema é o último login registrado no painel.</p>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 text-md-end">
            <a href="{{ url('admin/guias/listar') }}" class="btn btn-outline-secondary mt-2">Lista de guias</a>
        </div>
    </div>
</div>

<div class="row clearfix">
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card top_counter">
            <div class="body">
                <div class="icon"><i class="fa fa-eye" style="color:#1e88e5;"></i></div>
                <div class="content">
                    <div class="text">Visitas ao perfil</div>
                    <h5 class="number">{{ number_format($visitasPeriodo, 0, ',', '.') }}</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card top_counter">
            <div class="body">
                <div class="icon"><i class="fa fa-calendar" style="color:#43a047;"></i></div>
                <div class="content">
                    <div class="text">Guias com evento</div>
                    <h5 class="number">{{ $comEvento }}</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card top_counter">
            <div class="body">
                <div class="icon"><i class="fa fa-sign-in" style="color:#8e24aa;"></i></div>
                <div class="content">
                    <div class="text">Entraram no painel</div>
                    <h5 class="number">{{ $acessosPeriodo }}</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card top_counter">
            <div class="body">
                <div class="icon"><i class="fa fa-user-times" style="color:#ef6c00;"></i></div>
                <div class="content">
                    <div class="text">Sem acesso registrado</div>
                    <h5 class="number">{{ $semAcesso }}</h5>
                </div>
            </div>
        </div>
    </div>
</div>

@if($convidar->count() || $primeiroEvento->count() || $chamar->count() || $painel->count())
<div class="row clearfix">
    <div class="col-lg-12">
        <h3 class="h5 mb-3">Para agir agora</h3>
    </div>
    @if($convidar->count())
        <div class="col-lg-6 col-md-12 mb-3">
            <div class="card">
                <div class="body">
                    <h4 class="h6">Perfil visto, sem evento</h4>
                    <p class="text-muted">Gente procurando o guia. Vale convidar a publicar um passeio.</p>
                    @include('admin.guia.partes.acao', ['linhas' => $convidar, 'detalhe' => 'visitas'])
                </div>
            </div>
        </div>
    @endif
    @if($primeiroEvento->count())
        <div class="col-lg-6 col-md-12 mb-3">
            <div class="card">
                <div class="body">
                    <h4 class="h6">Entrou e ainda não publicou</h4>
                    <p class="text-muted">Já acessou o painel neste período. Ajuda no primeiro evento.</p>
                    @include('admin.guia.partes.acao', ['linhas' => $primeiroEvento, 'detalhe' => 'login'])
                </div>
            </div>
        </div>
    @endif
    @if($chamar->count())
        <div class="col-lg-6 col-md-12 mb-3">
            <div class="card">
                <div class="body">
                    <h4 class="h6">Publicou e não volta há 60 dias</h4>
                    <p class="text-muted">Tem evento, mas o último acesso ao painel ficou para trás.</p>
                    @include('admin.guia.partes.acao', ['linhas' => $chamar, 'detalhe' => 'login'])
                </div>
            </div>
        </div>
    @endif
    @if($painel->count())
        <div class="col-lg-6 col-md-12 mb-3">
            <div class="card">
                <div class="body">
                    <h4 class="h6">Tem evento e nunca entrou no painel</h4>
                    <p class="text-muted">O login ainda não foi registrado. Vale mostrar a área do guia.</p>
                    @include('admin.guia.partes.acao', ['linhas' => $painel, 'detalhe' => 'eventos'])
                </div>
            </div>
        </div>
    @endif
</div>
@endif

<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="body">
                <h3 class="h5">Perfis mais acessados</h3>
                <p class="text-muted">Ordenado pelas visitas dos últimos 30 dias. Contatos são cliques em WhatsApp e Instagram no mesmo período.</p>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Guia</th>
                                <th>30 dias</th>
                                <th>Total</th>
                                <th>Contatos</th>
                                <th>Eventos</th>
                                <th>Último acesso</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($porAcesso as $linha)
                                @include('admin.guia.partes.linha-acesso', ['linha' => $linha, 'tom' => $tom])
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@if($porEvento->count())
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="body">
                <h3 class="h5">Quem cadastrou evento</h3>
                <p class="text-muted">Do cadastro mais recente para o mais antigo. À frente são passeios de hoje em diante que não estão cancelados.</p>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Guia</th>
                                <th>Eventos</th>
                                <th>À frente</th>
                                <th>Último cadastro</th>
                                <th>Visitas em 30 dias</th>
                                <th>Último acesso</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($porEvento as $linha)
                                <tr>
                                    <td>@include('admin.guia.partes.nome', ['guia' => $linha->guia])</td>
                                    <td>{{ $linha->eventos }}</td>
                                    <td>{{ $linha->futuros }}</td>
                                    <td>{{ $linha->ultimoEvento ? $linha->ultimoEvento->format('d/m/Y') : '—' }}</td>
                                    <td>{{ $linha->visitas30 }}</td>
                                    <td>@include('admin.guia.partes.quando', ['data' => $linha->login])</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="body">
                <h3 class="h5">Quem acessou o sistema</h3>
                <p class="text-muted">Quem entrou por último aparece primeiro. Sem data, o painel ainda não registrou um login.</p>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Guia</th>
                                <th>Último acesso</th>
                                <th>Eventos</th>
                                <th>Visitas em 30 dias</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($porLogin as $linha)
                                <tr>
                                    <td>@include('admin.guia.partes.nome', ['guia' => $linha->guia])</td>
                                    <td>@include('admin.guia.partes.quando', ['data' => $linha->login])</td>
                                    <td>{{ $linha->eventos }}</td>
                                    <td>{{ $linha->visitas30 }}</td>
                                    <td>@include('admin.guia.partes.selo', ['linha' => $linha, 'tom' => $tom])</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

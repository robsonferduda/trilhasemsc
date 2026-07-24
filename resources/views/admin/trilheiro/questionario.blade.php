@extends('layouts.template')

@section('content')
<div class="block-header">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-12">
            <h2><i class="fa fa-clipboard-list"></i> Questionário IET</h2>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.trilheiros.listar') }}">Trilheiros</a></li>
                <li class="breadcrumb-item">Questionário</li>
            </ul>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 text-right">
            <a href="{{ route('admin.trilheiros.listar') }}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Voltar à listagem</a>
        </div>
    </div>
</div>

@php
    $simNao = function ($valor) {
        return $valor ? 'Sim' : 'Não';
    };
    $costaoLabel = [
        0 => 'Nenhuma experiência',
        30 => 'Já caminhou com cautela, trechos curtos',
        60 => 'Costões longos, molhados ou expostos',
    ];
@endphp

<div class="row clearfix">
    <div class="col-lg-4 col-md-12">
        <div class="card">
            <div class="body text-center">
                <img
                    src="{{ $trilheiro->nm_path_foto_tri ? asset('img/trilheiros/'.$trilheiro->nm_path_foto_tri) : asset('images/user.png') }}"
                    class="rounded-circle mb-3"
                    style="width:120px;height:120px;object-fit:cover;"
                    alt="Foto"
                >
                <h4 class="mb-1">{{ $trilheiro->nm_trilheiro_tri }}</h4>
                <p class="text-muted mb-2">
                    {{ $trilheiro->user ? $trilheiro->user->email : 'E-mail não informado' }}
                </p>
                <p class="mb-2">
                    {{ $trilheiro->origem ? $trilheiro->origem->nm_cidade_cde : 'Cidade não informada' }}
                </p>
                <h2 class="mb-0">{{ $trilheiro->nr_score_tri ?? 0 }}</h2>
                <p class="mb-1">{{ $trilheiro->indice ? $trilheiro->indice->ds_indice_ind : 'Não Definido' }}</p>
                @if($trilheiro->indice && $trilheiro->indice->ds_sigla_ind)
                    <span class="badge badge-info">{{ $trilheiro->indice->ds_sigla_ind }}</span>
                @endif
                @if($trilheiro->indice && $trilheiro->indice->img_indice_ind)
                    <div class="mt-3">
                        <img src="{{ asset('img/nivel/'.$trilheiro->indice->img_indice_ind) }}" alt="Nível" style="max-width:100px;">
                    </div>
                @endif
                <div class="mt-3">
                    <a href="{{ url('admin/trilheiro/perfil/'.$trilheiro->id_trilheiro_tri) }}" class="btn btn-sm btn-outline-primary">
                        Ver perfil
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-8 col-md-12">
        <div class="card">
            <div class="header">
                <h2>Respostas do questionário</h2>
            </div>
            <div class="body">
                @if(!$questionario)
                    <div class="alert alert-warning mb-0">
                        <i class="fa fa-exclamation-triangle"></i>
                        Este trilheiro ainda não respondeu o questionário.
                    </div>
                @else
                    <p class="text-muted mb-3">
                        Respondido em
                        {{ $questionario->updated_at ? \Carbon\Carbon::parse($questionario->updated_at)->format('d/m/Y H:i') : '—' }}
                    </p>

                    <h6 class="text-primary"><i class="fa fa-user-circle-o"></i> Dados básicos</h6>
                    <table class="table table-bordered table-sm">
                        <tr>
                            <th style="width:55%;">Altura</th>
                            <td>{{ $questionario->nu_altura_que ? number_format((float) $questionario->nu_altura_que, 2, ',', '.') . ' m' : '—' }}</td>
                        </tr>
                        <tr>
                            <th>Peso</th>
                            <td>{{ $questionario->nu_peso_que ? number_format((float) $questionario->nu_peso_que, 1, ',', '.') . ' kg' : '—' }}</td>
                        </tr>
                    </table>

                    <h6 class="text-danger mt-4"><i class="fa fa-heartbeat"></i> Condicionamento físico</h6>
                    <table class="table table-bordered table-sm">
                        <tr>
                            <th style="width:55%;">Pratica corrida ou caminhada?</th>
                            <td>{{ $questionario->corrida ? $questionario->corrida->ds_corrida_cor : '—' }}</td>
                        </tr>
                        <tr>
                            <th>Distância média por semana (km)</th>
                            <td>{{ $questionario->nu_distancia_que !== null ? $questionario->nu_distancia_que : '—' }}</td>
                        </tr>
                        <tr>
                            <th>Faz musculação?</th>
                            <td>{{ $simNao($questionario->fl_musculacao_que) }}</td>
                        </tr>
                    </table>

                    <h6 class="text-success mt-4"><i class="fa fa-tachometer"></i> Experiência em trilhas</h6>
                    <table class="table table-bordered table-sm mb-0">
                        <tr>
                            <th style="width:55%;">Já fez trilhas anteriormente?</th>
                            <td>{{ $simNao($questionario->fl_trilhas_que) }} <small class="text-muted">(não pontua)</small></td>
                        </tr>
                        <tr>
                            <th>Já fez trilhas na areia?</th>
                            <td>{{ $simNao($questionario->fl_areia_que) }}</td>
                        </tr>
                        <tr>
                            <th>Já fez trilhas com travessias de rio?</th>
                            <td>{{ $simNao($questionario->fl_travessia_que) }}</td>
                        </tr>
                        <tr>
                            <th>Tem medo/fobia de altura?</th>
                            <td>{{ $simNao($questionario->fl_altura_que) }}</td>
                        </tr>
                        <tr>
                            <th>Experiência em trekking?</th>
                            <td>{{ $simNao($questionario->fl_trekking_que) }}</td>
                        </tr>
                        <tr>
                            <th>Experiência em hiking?</th>
                            <td>{{ $simNao($questionario->fl_hiking_que) }}</td>
                        </tr>
                        <tr>
                            <th>Costões rochosos</th>
                            <td>{{ $costaoLabel[(int) $questionario->nu_costao_que] ?? ($questionario->nu_costao_que ?? '—') }}</td>
                        </tr>
                        <tr>
                            <th>Via ferrata / escalaminhada?</th>
                            <td>{{ $simNao($questionario->fl_ferrata_que) }}</td>
                        </tr>
                        <tr>
                            <th>Acampamento ou bivaque?</th>
                            <td>{{ $simNao($questionario->fl_acampamento_que) }}</td>
                        </tr>
                        <tr>
                            <th>Distância das trilhas</th>
                            <td>{{ $questionario->distancia ? $questionario->distancia->ds_distancia_dis : '—' }}</td>
                        </tr>
                        <tr>
                            <th>Elevação das trilhas</th>
                            <td>{{ $questionario->elevacao ? $questionario->elevacao->ds_elevacao_ele : '—' }}</td>
                        </tr>
                    </table>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

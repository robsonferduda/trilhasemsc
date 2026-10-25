@extends('layouts.template')

@section('content')
    <div class="block-header">
        <div class="row">
            <div class="col-lg-5 col-md-8 col-sm-12">
                <h2>Guias e Condutores</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><i class="fa fa-id-card"></i> Guias e Condutores</li>
                    <li class="breadcrumb-item">Eventos</li>
                    <li class="breadcrumb-item">Participantes</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12">
            <div class="card planned_task">
                <div class="header no-padding-bottom">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <h2><i class="fa fa-tags"></i> Meus Eventos / {{ $evento->nm_evento_eve }}</h2>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <a href="{{ url('guia-e-condutores/privado/eventos') }}" class="btn btn-primary pull-right"><i class="fa fa-list"></i> Meus Eventos</a>
                        </div>
                    </div>
                </div>

                <div class="body mt-0 pt-0">
                    @include('layouts.mensagens')

                    @php
                        $limiteVagas = $evento->limiteVagas();
                        $vagasOcupadas = $inscricoes->where('st_inscricao_evt', \App\EventoTrilheiro::PAGO)->count();
                        $interessados = $inscricoes->where('st_inscricao_evt', \App\EventoTrilheiro::INTERESSADO)->count();
                        $aguardando = $inscricoes->where('st_inscricao_evt', \App\EventoTrilheiro::ACEITO)->count();
                        $eventoPago = $evento->valor_eve > 0;
                    @endphp

                    <div class="row mb-3">
                        <div class="col-md-4 mb-2">
                            <div class="alert alert-success mb-0">
                                <strong>Vagas confirmadas</strong><br>
                                {{ $vagasOcupadas }}
                                @if($limiteVagas)
                                    de {{ $limiteVagas }}
                                @else
                                    (sem limite)
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <div class="alert alert-warning mb-0">
                                <strong>Interessados</strong><br>
                                {{ $interessados }}
                            </div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <div class="alert alert-info mb-0">
                                <strong>Aguardando pagamento</strong><br>
                                {{ $aguardando }}
                            </div>
                        </div>
                    </div>
                    <p class="text-muted">O interesse e o aceite não ocupam vaga. A vaga fecha somente quando o pagamento é confirmado.</p>

                    @forelse($inscricoes as $inscricao)
                        @php $trilheiro = $inscricao->trilheiro; @endphp
                        @if(!$trilheiro)
                            @continue
                        @endif
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="card">
                                <div class="row p-3">
                                    <div class="col-lg-1 col-md-2 col-sm-12">
                                        <img src="{{ $trilheiro->nm_path_foto_tri ? asset('img/trilheiros/'.$trilheiro->nm_path_foto_tri) : asset('images/user.png') }}" class="rounded-circle user-photo w-100" alt="Foto de Perfil">
                                    </div>
                                    <div class="col-lg-8 col-md-7 col-sm-12">
                                        <div class="text" style="font-size: 16px;">{{ $trilheiro->nm_trilheiro_tri }}</div>
                                        <p class="mt-2 mb-2">
                                            <span class="badge {{ $inscricao->classeStatus() }}">{{ $inscricao->rotuloStatus() }}</span>
                                        </p>
                                        <p class="mb-2"><strong>Cidade de origem</strong>: {!! ($trilheiro->origem) ? $trilheiro->origem->nm_cidade_cde : '<span class="text-danger">Não informada</span>' !!}</p>
                                        <p class="mb-2"><strong>E-mail</strong>: {{ optional($trilheiro->user)->email ?: 'Não informado' }}</p>
                                        <p class="mb-2"><strong>Nascimento</strong>: {{ $trilheiro->dt_nascimento ? \Carbon\Carbon::parse($trilheiro->dt_nascimento)->format('d/m/Y') : 'Não informado' }}</p>
                                        <p class="mb-2"><strong>CPF</strong>: {{ $inscricao->nr_documento_evt ? \App\EventoTrilheiro::formatarCpf($inscricao->nr_documento_evt) : 'Não informado' }}</p>
                                        @php $faltas = $inscricao->faltasParaConfirmar(); @endphp
                                        @if(count($faltas))
                                            <p class="mb-2 text-danger"><strong>Para confirmar a vaga, falta:</strong> {{ implode(', ', $faltas) }}</p>
                                        @endif
                                        <p class="mb-2"><strong>Interesse em</strong>: {{ \Carbon\Carbon::parse($inscricao->created_at)->format('d/m/Y H:i') }}</p>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12">
                                        @if($inscricao->st_inscricao_evt === \App\EventoTrilheiro::INTERESSADO)
                                            <form action="{{ route('evento.inscricao.aceitar', [$evento->id_evento_eve, $inscricao->cd_evento_trilheiro_evt]) }}" method="post" class="mb-2">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm btn-block">Aceitar</button>
                                            </form>
                                        @endif
                                        @if($inscricao->st_inscricao_evt === \App\EventoTrilheiro::ACEITO)
                                            @if(count($faltas))
                                                <button type="button" class="btn btn-primary btn-sm btn-block mb-2" disabled>{{ $eventoPago ? 'Confirmar pagamento' : 'Confirmar vaga' }}</button>
                                            @else
                                            <form action="{{ route('evento.inscricao.pagamento', [$evento->id_evento_eve, $inscricao->cd_evento_trilheiro_evt]) }}" method="post" class="mb-2" onsubmit="return confirm('{{ $eventoPago ? 'Confirmar o pagamento e fechar a vaga?' : 'Confirmar a vaga? Em evento gratuito, esta confirmação ocupa a vaga.' }}');">
                                                @csrf
                                                <button type="submit" class="btn btn-primary btn-sm btn-block">{{ $eventoPago ? 'Confirmar pagamento' : 'Confirmar vaga' }}</button>
                                            </form>
                                            @endif
                                        @endif
                                        @if(in_array($inscricao->st_inscricao_evt, [\App\EventoTrilheiro::INTERESSADO, \App\EventoTrilheiro::ACEITO], true))
                                            <form action="{{ route('evento.inscricao.recusar', [$evento->id_evento_eve, $inscricao->cd_evento_trilheiro_evt]) }}" method="post" onsubmit="return confirm('Recusar este interesse?');">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger btn-sm btn-block">Recusar</button>
                                            </form>
                                        @endif
                                        @if($inscricao->st_inscricao_evt === \App\EventoTrilheiro::PAGO)
                                            <form action="{{ route('evento.inscricao.desfazer-pagamento', [$evento->id_evento_eve, $inscricao->cd_evento_trilheiro_evt]) }}" method="post" onsubmit="return confirm('Desfazer o pagamento e liberar a vaga?');">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-warning btn-sm btn-block">Desfazer pagamento</button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="card rounded shadow">
                            <div class="body">
                                <h6>Nenhum interessado neste evento</h6>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection

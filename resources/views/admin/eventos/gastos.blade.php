@extends('layouts.template')

@section('content')
    <div class="block-header">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12">
                <h2>Gastos do evento</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><i class="fa fa-id-card"></i> Guias e Condutores</li>
                    <li class="breadcrumb-item">Eventos</li>
                    <li class="breadcrumb-item">{{ $evento->nm_evento_eve }}</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <div class="row">
                        <div class="col-md-8">
                            <h2>{{ $evento->nm_evento_eve }}</h2>
                        </div>
                        <div class="col-md-4 text-right">
                            <a href="{{ url('guia-e-condutores/privado/eventos/participantes', $evento->id_evento_eve) }}" class="btn btn-outline-danger btn-sm">Participantes</a>
                            <a href="{{ url('guia-e-condutores/privado/eventos') }}" class="btn btn-primary btn-sm">Meus eventos</a>
                        </div>
                    </div>
                </div>
                <div class="body">
                    @include('layouts.mensagens')

                    <div class="row mb-3">
                        <div class="col-md-3 mb-2">
                            <div class="alert alert-success mb-0">
                                <strong>Receita</strong><br>
                                {{ \App\EventoGasto::reais($resumo['receita']) }}
                                <small class="d-block">{{ $resumo['pagos'] }} {{ $resumo['pagos'] === 1 ? 'vaga paga' : 'vagas pagas' }} × {{ \App\EventoGasto::reais($evento->valorEmReais()) }}</small>
                            </div>
                        </div>
                        <div class="col-md-3 mb-2">
                            <div class="alert alert-secondary mb-0">
                                <strong>Gastos fechados</strong><br>
                                {{ \App\EventoGasto::reais($resumo['confirmados']) }}
                            </div>
                        </div>
                        <div class="col-md-3 mb-2">
                            <div class="alert alert-warning mb-0">
                                <strong>Estimados</strong><br>
                                {{ \App\EventoGasto::reais($resumo['estimados']) }}
                                <small class="d-block">Seguro da Rocca até a fatura do mês</small>
                            </div>
                        </div>
                        <div class="col-md-3 mb-2">
                            <div class="alert {{ $resumo['sobra'] < 0 ? 'alert-danger' : 'alert-info' }} mb-0">
                                <strong>Sobra</strong><br>
                                {{ \App\EventoGasto::reais($resumo['sobra']) }}
                            </div>
                        </div>
                    </div>
                    <p class="text-muted">
                        A receita usa somente as vagas com pagamento confirmado.
                        @if($resumo['rateio'] > 0 && $resumo['rateio_pessoa'] !== null)
                            Os gastos marcados para divisão somam {{ \App\EventoGasto::reais($resumo['rateio']) }}, cerca de {{ \App\EventoGasto::reais($resumo['rateio_pessoa']) }} por vaga paga.
                        @elseif($resumo['rateio'] > 0)
                            Os gastos marcados para divisão somam {{ \App\EventoGasto::reais($resumo['rateio']) }}. A parte por pessoa aparece quando houver vaga paga.
                        @endif
                    </p>

                    <h5>{{ $gasto ? 'Editar gasto' : 'Novo gasto' }}</h5>
                    <form method="post" action="{{ url('guia-e-condutores/privado/eventos/gastos/'.$evento->id_evento_eve) }}" enctype="multipart/form-data" class="mb-4">
                        @csrf
                        @if($gasto)
                            <input type="hidden" name="cd_evento_gasto_evg" value="{{ $gasto->cd_evento_gasto_evg }}">
                        @endif
                        <div class="row">
                            <div class="col-md-3 mb-2">
                                <label for="ds_categoria_evg">Categoria</label>
                                <select name="ds_categoria_evg" id="ds_categoria_evg" class="form-control" required>
                                    @foreach(\App\EventoGasto::CATEGORIAS as $codigo => $rotulo)
                                        <option value="{{ $codigo }}" {{ old('ds_categoria_evg', $gasto->ds_categoria_evg ?? '') === $codigo ? 'selected' : '' }}>{{ $rotulo }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 mb-2">
                                <label for="vl_gasto_evg">Valor</label>
                                <input type="text" name="vl_gasto_evg" id="vl_gasto_evg" class="form-control" required placeholder="0,00" value="{{ old('vl_gasto_evg', $gasto ? number_format($gasto->vl_gasto_evg, 2, ',', '.') : '') }}">
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="nm_pagador_evg">Quem pagou</label>
                                <input type="text" name="nm_pagador_evg" id="nm_pagador_evg" class="form-control" required maxlength="120" value="{{ old('nm_pagador_evg', $gasto->nm_pagador_evg ?? optional($evento->guia)->nm_guia_gui) }}">
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="ds_descricao_evg">Descrição</label>
                                <input type="text" name="ds_descricao_evg" id="ds_descricao_evg" class="form-control" maxlength="200" value="{{ old('ds_descricao_evg', $gasto->ds_descricao_evg ?? '') }}">
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="comprovante">Comprovante</label>
                                <input type="file" name="comprovante" id="comprovante" class="form-control" accept=".jpg,.jpeg,.png,.webp,.pdf">
                                @if($gasto && $gasto->ds_comprovante_evg)
                                    <small><a href="{{ asset('img/eventos/'.$gasto->ds_comprovante_evg) }}" target="_blank" rel="noopener">Ver comprovante atual</a></small>
                                @endif
                            </div>
                            <div class="col-md-4 mb-2 pt-4">
                                <label class="d-block">
                                    <input type="checkbox" name="fl_rateio_evg" value="1" {{ old('fl_rateio_evg', $gasto->fl_rateio_evg ?? false) ? 'checked' : '' }}>
                                    Dividir entre as vagas pagas
                                </label>
                                <label class="d-block">
                                    <input type="checkbox" name="fl_estimado_evg" value="1" {{ old('fl_estimado_evg', $gasto->fl_estimado_evg ?? false) ? 'checked' : '' }}>
                                    Estimativa, ainda sem fatura
                                </label>
                            </div>
                            <div class="col-md-4 mb-2 pt-4">
                                <button type="submit" class="btn btn-success">{{ $gasto ? 'Salvar gasto' : 'Lançar gasto' }}</button>
                                @if($gasto)
                                    <a href="{{ url('guia-e-condutores/privado/eventos/gastos', $evento->id_evento_eve) }}" class="btn btn-outline-secondary">Cancelar</a>
                                @endif
                            </div>
                        </div>
                        <small class="text-muted">No seguro da Rocca, deixe marcado como estimativa até a fatura do mês fechar. Depois edite o valor e desmarque.</small>
                    </form>

                    <h5>Lançamentos</h5>
                    @forelse($evento->gastos->sortByDesc('created_at') as $item)
                        <div class="border rounded p-3 mb-2">
                            <div class="row">
                                <div class="col-md-8">
                                    <strong>{{ $item->categoria() }}</strong>
                                    — {{ \App\EventoGasto::reais($item->vl_gasto_evg) }}
                                    @if($item->fl_estimado_evg)
                                        <span class="badge badge-warning">Estimado</span>
                                    @endif
                                    @if($item->fl_rateio_evg)
                                        <span class="badge badge-info">Entra na divisão</span>
                                    @endif
                                    <div class="text-muted">Pago por {{ $item->nm_pagador_evg }} @if($item->ds_descricao_evg) · {{ $item->ds_descricao_evg }} @endif</div>
                                    @if($item->ds_comprovante_evg)
                                        <a href="{{ asset('img/eventos/'.$item->ds_comprovante_evg) }}" target="_blank" rel="noopener">Comprovante</a>
                                    @endif
                                </div>
                                <div class="col-md-4 text-right">
                                    <a href="{{ url('guia-e-condutores/privado/eventos/gastos/'.$evento->id_evento_eve.'?editar='.$item->cd_evento_gasto_evg) }}" class="btn btn-outline-primary btn-sm">Editar</a>
                                    <form action="{{ route('evento.gastos.excluir', [$evento->id_evento_eve, $item->cd_evento_gasto_evg]) }}" method="post" class="d-inline" onsubmit="return confirm('Excluir este gasto?');">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger btn-sm">Excluir</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p>Nenhum gasto lançado neste evento.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection

@php
    $inscricaoAtiva = $inscricao && $inscricao->ativa();
    $faltamDados = $inscricaoAtiva && count($inscricao->faltasParaConfirmar()) > 0;
@endphp
@if(Auth::user() and $trilheiro)
    @if($faltamDados)
        <a href="{{ url('trilheiro/privado/eventos/participar/'.$evento->id_evento_eve) }}" class="btn btn-outline-warning btn-sm">Informar dados do seguro</a>
    @elseif($inscricaoAtiva)
        <button type="button" class="btn btn-outline-success btn-sm">
            <i class="fa fa-check"></i> {{ $inscricao->rotuloStatus() }}
        </button>
        <button type="button" class="btn btn-outline-danger btn-sm btn-cancelar-participacao" data-url="{{ url('trilheiro/privado/eventos/cancelar/'.$evento->id_evento_eve) }}">
            <i class="fa fa-times"></i> Cancelar participação
        </button>
    @else
        <a href="{{ $urlPresenca }}" type="button" class="btn btn-outline-primary btn-sm"><i class="fa fa-check"></i> {{ $textoPresenca }}</a>
    @endif
@else
    <a href="{{ $urlPresenca }}" type="button" class="btn btn-outline-primary btn-sm"><i class="fa fa-check"></i> {{ $textoPresenca }}</a>
@endif

@php
    $inscricaoAtiva = $inscricao && $inscricao->ativa();
@endphp
@if(Auth::user() and $trilheiro)
    @if($inscricaoAtiva)
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

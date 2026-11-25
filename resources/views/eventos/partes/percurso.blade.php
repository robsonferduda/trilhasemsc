@php
    $acum = isset($percursosAcumulados) ? ($percursosAcumulados[$evento->id_evento_eve] ?? null) : null;
    $percurso = $acum ?: $evento->percursoAssociado();
@endphp
@if($percurso)
    <div class="{{ $classe ?? '' }}" style="font-size:.85rem;">
        @if(!empty($percurso['distancia']))
            <span>
                <i class="fa fa-road" aria-hidden="true"></i>
                {{ $percurso['distancia'] }} km{{ !empty($percurso['distanciaAcum']) ? '/'.$percurso['distanciaAcum'].' km' : '' }}
            </span>
        @endif
        @if(!empty($percurso['distancia']) && !empty($percurso['subida']))
            <span aria-hidden="true"> · </span>
        @endif
        @if(!empty($percurso['subida']))
            <span>
                <i class="fa fa-arrow-up" aria-hidden="true"></i>
                {{ $percurso['subida'] }} m{{ !empty($percurso['subidaAcum']) ? '/'.$percurso['subidaAcum'].' m' : '' }} de subida
            </span>
        @endif
    </div>
@endif

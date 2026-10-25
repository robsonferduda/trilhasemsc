@php
    $percurso = $evento->percursoAssociado();
@endphp
@if($percurso)
    <div class="{{ $classe ?? '' }}" style="font-size:.85rem;">
        @if($percurso['distancia'] !== null)
            <span><i class="fa fa-road" aria-hidden="true"></i> {{ $percurso['distancia'] }} km</span>
        @endif
        @if($percurso['distancia'] !== null && $percurso['subida'] !== null)
            <span aria-hidden="true"> · </span>
        @endif
        @if($percurso['subida'] !== null)
            <span><i class="fa fa-arrow-up" aria-hidden="true"></i> {{ $percurso['subida'] }} m de subida</span>
        @endif
    </div>
@endif

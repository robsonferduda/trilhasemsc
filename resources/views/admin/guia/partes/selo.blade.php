@if($linha->acao !== '')
    <span style="display:inline-block;border-radius:999px;padding:2px 8px;font-size:12px;{{ $tom[$linha->acaoTom] ?? '' }}">{{ $linha->acao }}</span>
@endif

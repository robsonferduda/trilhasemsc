@if($data)
    {{ $data->format('d/m/Y H:i') }}
    <div class="text-muted" style="font-size:12px;">{{ $data->diffForHumans() }}</div>
@else
    <span class="text-muted">Nenhum login registrado</span>
@endif

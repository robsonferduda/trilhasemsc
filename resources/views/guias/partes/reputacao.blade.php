<div class="d-flex flex-wrap align-items-center mb-3" style="gap: 10px;">
    @if(isset($mediaAvaliacao) && $mediaAvaliacao !== null)
        <span title="{{ $avaliacoes->count() }} avaliações">{{ \App\GuiaAvaliacao::estrelas(round($mediaAvaliacao)) }} {{ number_format($mediaAvaliacao, 1, ',', '') }} · {{ $avaliacoes->count() }} {{ $avaliacoes->count() === 1 ? 'avaliação' : 'avaliações' }}</span>
    @endif
    <span class="text-muted">{{ $totalFavoritos }} {{ $totalFavoritos === 1 ? 'favorito' : 'favoritos' }}</span>
    @if(empty($ehOProprioGuia))
        @if(Auth::check() && trim(Auth::user()->id_role) === 'TRILHEIRO')
            <form method="post" action="{{ url('trilheiro/privado/favoritar/'.$guia->id_guia_gui) }}" class="mb-0">
                @csrf
                <button type="submit" class="btn btn-sm {{ $favoritou ? 'btn-danger' : 'btn-outline-danger' }}">
                    {{ $favoritou ? 'Favorito' : 'Favoritar' }}
                </button>
            </form>
        @else
            <a class="btn btn-sm btn-outline-danger" href="{{ url('trilheiro/privado/favoritar/'.$guia->id_guia_gui) }}">Favoritar</a>
        @endif
    @endif
</div>
@if(Auth::check() && trim(Auth::user()->id_role) === 'TRILHEIRO' && empty($ehOProprioGuia) && empty($favoritou))
    <p class="small text-muted">Quem favorita recebe um aviso quando {{ $guia->nm_guia_gui }} lançar um passeio.</p>
@endif

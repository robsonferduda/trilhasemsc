<div class="d-flex flex-wrap align-items-center mb-3" style="gap: 10px;">
    @if(isset($mediaAvaliacao) && $mediaAvaliacao !== null)
        <span title="{{ $avaliacoes->count() }} avaliações">{{ \App\GuiaAvaliacao::estrelas(round($mediaAvaliacao)) }} {{ number_format($mediaAvaliacao, 1, ',', '') }} · {{ $avaliacoes->count() }} {{ $avaliacoes->count() === 1 ? 'avaliação' : 'avaliações' }}</span>
    @else
        <span class="text-muted">Ainda sem avaliação</span>
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

<div id="avaliacoes" class="mt-4">
    <h2 class="text-info h3">Avaliações</h2>
    @if(!empty($podeAvaliar))
        <form method="post" action="{{ url('trilheiro/privado/avaliar/'.$guia->id_guia_gui) }}" class="mb-4">
            @csrf
            <div class="form-group">
                <label for="nota">Sua nota</label>
                <select name="nota" id="nota" class="form-control" style="max-width: 220px;" required>
                    @for($nota = 5; $nota >= 1; $nota--)
                        <option value="{{ $nota }}" {{ (int) old('nota', optional($minhaAvaliacao)->nr_nota_gav) === $nota ? 'selected' : '' }}>
                            {{ \App\GuiaAvaliacao::estrelas($nota) }}
                        </option>
                    @endfor
                </select>
            </div>
            <div class="form-group">
                <label for="comentario">Comentário</label>
                <textarea name="comentario" id="comentario" class="form-control" rows="3" maxlength="400">{{ old('comentario', optional($minhaAvaliacao)->ds_comentario_gav) }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">{{ $minhaAvaliacao ? 'Atualizar avaliação' : 'Publicar avaliação' }}</button>
        </form>
    @elseif(Auth::check() && trim(Auth::user()->id_role) === 'TRILHEIRO' && empty($ehOProprioGuia))
        <p class="text-muted">A avaliação abre depois de uma vaga confirmada com este guia.</p>
    @endif

    @forelse($avaliacoes as $avaliacao)
        <div class="mb-3">
            <strong>{{ explode(' ', trim(optional($avaliacao->trilheiro)->nm_trilheiro_tri ?: 'Trilheiro'))[0] }}</strong>
            <span>{{ \App\GuiaAvaliacao::estrelas($avaliacao->nr_nota_gav) }}</span>
            @if($avaliacao->ds_comentario_gav)
                <p class="mb-0">{{ $avaliacao->ds_comentario_gav }}</p>
            @endif
        </div>
    @empty
        <p class="text-muted">Nenhuma avaliação publicada.</p>
    @endforelse
</div>

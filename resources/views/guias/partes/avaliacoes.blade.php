@if($avaliacoes->count() || !empty($podeAvaliar))
<div id="avaliacoes" class="col-md-12 mt-4">
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
    @endif

    @foreach($avaliacoes as $avaliacao)
        <div class="mb-3">
            <strong>{{ explode(' ', trim(optional($avaliacao->trilheiro)->nm_trilheiro_tri ?: 'Trilheiro'))[0] }}</strong>
            <span>{{ \App\GuiaAvaliacao::estrelas($avaliacao->nr_nota_gav) }}</span>
            @if($avaliacao->ds_comentario_gav)
                <p class="mb-0">{{ $avaliacao->ds_comentario_gav }}</p>
            @endif
        </div>
    @endforeach
</div>
@endif

<div class="border rounded p-2 mt-2 mb-2">
    <p class="mb-1">
        <strong>Cadastur</strong>: {{ $guia->nu_cadastur_gui ?: 'não informado' }}
        @if($guia->ds_cadastur_situacao_oficial_gui)
            <span class="text-muted">· {{ $guia->ds_cadastur_situacao_oficial_gui }}</span>
        @endif
    </p>
    @include('guias.partes.situacao-cadastur', ['guia' => $guia])
    @if($guia->nm_cadastur_titular_gui)
        <p class="mb-1 {{ $guia->sg_cadastur_situacao_gui === 'divergente' ? 'text-danger' : '' }}">
            <strong class="text-dark">Titular no certificado</strong>: {{ $guia->nm_cadastur_titular_gui }}
            @if($guia->nm_cadastur_categoria_gui)
                <span class="text-muted">· {{ $guia->nm_cadastur_categoria_gui }}</span>
            @endif
        </p>
    @endif
    @if(trim((string) $guia->nu_cadastur_gui) !== '')
        <form method="post" action="{{ route('admin.guia.cadastur', $guia->id_guia_gui) }}" class="form-inline mt-1">
            @csrf
            <select name="situacao" class="form-control form-control-sm mr-1 mb-1" aria-label="Situação no Cadastur">
                <option value="" {{ $guia->sg_cadastur_situacao_gui === 'nao_encontrado' ? 'selected' : '' }}>Não encontrado</option>
                @foreach(\App\Services\CadasturService::SITUACOES_OFICIAIS as $situacaoOficial)
                    <option value="{{ $situacaoOficial }}" {{ ($guia->ds_cadastur_situacao_oficial_gui ?: 'Regular') === $situacaoOficial && $guia->sg_cadastur_situacao_gui !== 'nao_encontrado' ? 'selected' : '' }}>{{ $situacaoOficial }}</option>
                @endforeach
            </select>
            <input type="date" name="validade" value="{{ $guia->dt_cadastur_validade_gui ? $guia->dt_cadastur_validade_gui->format('Y-m-d') : '' }}" class="form-control form-control-sm mr-1 mb-1" aria-label="Validade do certificado">
            <label class="mr-2 mb-1"><input type="checkbox" name="titular_confere" value="1" class="mr-1" {{ $guia->fl_cadastur_nome_confere_gui === false ? '' : 'checked' }}> Titular confere</label>
            <button type="submit" name="acao" value="manual" class="btn btn-sm btn-outline-primary mr-1 mb-1"><i class="fa fa-save"></i> Salvar conferência</button>
            @if(!empty($cadasturApi))
                <button type="submit" name="acao" value="reconsultar" class="btn btn-sm btn-outline-secondary mb-1" formnovalidate><i class="fa fa-refresh"></i> Consultar API</button>
            @endif
        </form>
    @endif
</div>

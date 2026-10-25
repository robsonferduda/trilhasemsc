<a href="{{ $guia->urlPublica() }}" target="_blank" rel="noopener">{{ $guia->nm_guia_gui }}</a>
@if($guia->origem)
    <div class="text-muted" style="font-size:12px;">{{ $guia->origem->nm_cidade_cde }}</div>
@endif
@if(!$guia->fl_ativo_gui)
    <div class="text-muted" style="font-size:12px;">Inativo</div>
@endif

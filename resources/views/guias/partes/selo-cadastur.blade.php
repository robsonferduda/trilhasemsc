@php $selo = $guia->selo_cadastur; @endphp
@if(!empty($compacto))
    @if($selo === 'valido')
        <span class="badge badge-success mt-1" title="Cadastur conferido na base do Ministério do Turismo, válido até {{ $guia->dt_cadastur_validade_gui->format('d/m/Y') }}"><i class="fa fa-check-circle" aria-hidden="true"></i> Cadastur</span>
    @endif
@elseif($selo === 'valido')
    <p class="mb-0">
        <span class="badge badge-success" style="font-size: .85rem;"><i class="fa fa-check-circle" aria-hidden="true"></i> Cadastur · válido até {{ $guia->dt_cadastur_validade_gui->format('d/m/Y') }}</span>
    </p>
    <p class="small text-secondary">
        Certificado nº {{ $guia->nu_cadastur_gui }} conferido em {{ $guia->dt_cadastur_consulta_gui->format('d/m/Y') }} na base oficial do Ministério do Turismo.
    </p>
@elseif($selo === 'vencido')
    <p>
        <span class="badge badge-warning" style="font-size: .85rem;"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Cadastur vencido em {{ $guia->dt_cadastur_validade_gui->format('d/m/Y') }}</span>
    </p>
@elseif($selo === 'informado')
    <p class="mb-0">
        <span class="badge badge-secondary" style="font-size: .85rem;"><i class="fa fa-id-card" aria-hidden="true"></i> Cadastur {{ $guia->nu_cadastur_gui }}</span>
    </p>
@endif

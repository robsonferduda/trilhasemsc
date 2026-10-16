@php
    $situacaoCadastur = $guia->sg_cadastur_situacao_gui;
    $validadeCadastur = $guia->dt_cadastur_validade_gui ? $guia->dt_cadastur_validade_gui->format('d/m/Y') : null;
    $consultaCadastur = $guia->dt_cadastur_consulta_gui ? $guia->dt_cadastur_consulta_gui->format('d/m/Y') : null;
@endphp
@if($guia->selo_cadastur === 'valido')
    <p class="small text-success mb-1"><i class="fa fa-check-circle"></i> Conferido em {{ $consultaCadastur }} na base do Ministério do Turismo. Válido até {{ $validadeCadastur }}.</p>
@elseif($guia->selo_cadastur === 'vencido')
    <p class="small text-warning mb-1"><i class="fa fa-exclamation-circle"></i> Vencido em {{ $validadeCadastur }}. Renove no Cadastur para o selo voltar ao perfil.</p>
@elseif($situacaoCadastur === 'irregular')
    <p class="small text-danger mb-1"><i class="fa fa-ban"></i> Situação no Cadastur: {{ $guia->ds_cadastur_situacao_oficial_gui }}. O selo não aparece no perfil.</p>
@elseif($situacaoCadastur === 'nao_encontrado')
    <p class="small text-danger mb-1"><i class="fa fa-ban"></i> Número não encontrado na base do Cadastur em {{ $consultaCadastur }}. Confira o número do certificado.</p>
@elseif($situacaoCadastur === 'divergente')
    <p class="small text-danger mb-1"><i class="fa fa-ban"></i> O titular do certificado não confere com o nome do perfil. A equipe vai revisar.</p>
@elseif(trim((string) $guia->nu_cadastur_gui) !== '')
    <p class="small text-secondary mb-1"><i class="fa fa-clock-o"></i> Aguardando conferência. Até lá, o número aparece no perfil como informado pelo guia.</p>
@endif

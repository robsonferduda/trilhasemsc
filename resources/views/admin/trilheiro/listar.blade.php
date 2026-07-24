@extends('layouts.template')

@section('content')
<div class="block-header">
    <div class="row">
        <div class="col-lg-5 col-md-8 col-sm-12">                        
            <h2 class="mb-2"><i class="fa fa-dashboard"></i> Dashboard</h2>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item">Dashboard</li>
                <li class="breadcrumb-item">Trilheiros</li>
            </ul>
        </div>           
    </div>
</div>

@if(session('flash_message'))
<div class="row">
    <div class="col-12">
        <div class="alert alert-{{ session('flash_level', 'info') }} alert-dismissible fade show" role="alert">
            <strong>{{ session('flash_message') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
</div>
@endif

<!-- Resumo fixo de conclusão de cadastro -->
@if(isset($resumo))
<div class="row clearfix mb-3">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                <h6 class="card-title mb-0"><i class="fa fa-bar-chart"></i> Resumo de cadastros</h6>
                <small class="text-muted">Atualizado ao abrir a página · funil de onboarding do trilheiro</small>
            </div>
            <div class="card-body">
                <div class="alert alert-warning mb-3 py-2">
                    <i class="fa fa-exclamation-triangle"></i>
                    Cerca de <strong>{{ $resumo['sem_score_pct'] }}%</strong> dos trilheiros estão sem score/questionário.
                    O registro por e-mail cria a conta e leva à home pública, sem obrigar perfil ou IET.
                </div>

                <div class="row clearfix">
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card top_counter mb-3">
                            <div class="body">
                                <div class="icon"><i class="fa fa-users" style="color:#607d8b;"></i></div>
                                <div class="content">
                                    <div class="text">Total</div>
                                    <h5 class="number">{{ $resumo['total'] }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card top_counter mb-3">
                            <div class="body">
                                <div class="icon"><i class="fa fa-warning" style="color:#f0ad4e;"></i></div>
                                <div class="content">
                                    <div class="text">Sem score / questionário</div>
                                    <h5 class="number">{{ $resumo['sem_score'] }} <small class="text-muted">({{ $resumo['sem_score_pct'] }}%)</small></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card top_counter mb-3">
                            <div class="body">
                                <div class="icon"><i class="fa fa-check" style="color:#5cb85c;"></i></div>
                                <div class="content">
                                    <div class="text">Completos*</div>
                                    <h5 class="number">{{ $resumo['completo'] }} <small class="text-muted">({{ $resumo['completo_pct'] }}%)</small></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card top_counter mb-3">
                            <div class="body">
                                <div class="icon"><i class="fa fa-calendar" style="color:#d9534f;"></i></div>
                                <div class="content">
                                    <div class="text">Incompletos (90 dias)</div>
                                    <h5 class="number">{{ $resumo['incompletos_90'] }}/{{ $resumo['novos_90'] }} <small class="text-muted">({{ $resumo['incompletos_90_pct'] }}%)</small></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-1">
                    <div class="col-lg-6 col-md-12 mb-3 mb-lg-0">
                        <h6 class="text-muted mb-2">Funil</h6>
                        <table class="table table-sm table-bordered mb-0">
                            <tbody>
                                <tr>
                                    <td>Conta criada (trilheiro)</td>
                                    <td class="text-right"><strong>{{ $resumo['total'] }}</strong></td>
                                </tr>
                                <tr>
                                    <td>Com cidade</td>
                                    <td class="text-right"><strong>{{ $resumo['com_cidade'] }}</strong> <span class="text-muted">({{ $resumo['com_cidade_pct'] }}%)</span></td>
                                </tr>
                                <tr>
                                    <td>Cadastro básico (cidade + nascimento)</td>
                                    <td class="text-right"><strong>{{ $resumo['basico_ok'] }}</strong> <span class="text-muted">({{ $resumo['basico_ok_pct'] }}%)</span></td>
                                </tr>
                                <tr>
                                    <td>Com questionário</td>
                                    <td class="text-right"><strong>{{ $resumo['com_questionario'] }}</strong> <span class="text-muted">({{ $resumo['com_questionario_pct'] }}%)</span></td>
                                </tr>
                                <tr class="table-success">
                                    <td>Completo*</td>
                                    <td class="text-right"><strong>{{ $resumo['completo'] }}</strong> <span class="text-muted">({{ $resumo['completo_pct'] }}%)</span></td>
                                </tr>
                            </tbody>
                        </table>
                        <small class="text-muted">*Completo = cidade + nascimento + questionário com score &gt; 0</small>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <h6 class="text-muted mb-2">Lacunas</h6>
                        <table class="table table-sm table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th>Critério</th>
                                    <th class="text-right">Qtd</th>
                                    <th class="text-right">%</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Sem cidade</td>
                                    <td class="text-right">{{ $resumo['sem_cidade'] }}</td>
                                    <td class="text-right">{{ $resumo['sem_cidade_pct'] }}%</td>
                                </tr>
                                <tr>
                                    <td>Sem score / score 0</td>
                                    <td class="text-right">{{ $resumo['sem_score'] }}</td>
                                    <td class="text-right">{{ $resumo['sem_score_pct'] }}%</td>
                                </tr>
                                <tr>
                                    <td>Sem questionário</td>
                                    <td class="text-right">{{ $resumo['sem_questionario'] }}</td>
                                    <td class="text-right">{{ $resumo['sem_questionario_pct'] }}%</td>
                                </tr>
                                <tr>
                                    <td>Índice Não Definido</td>
                                    <td class="text-right">{{ $resumo['nao_definido'] }}</td>
                                    <td class="text-right">{{ $resumo['nao_definido_pct'] }}%</td>
                                </tr>
                                <tr>
                                    <td>Sem foto</td>
                                    <td class="text-right">{{ $resumo['sem_foto'] }}</td>
                                    <td class="text-right">{{ $resumo['sem_foto_pct'] }}%</td>
                                </tr>
                                <tr>
                                    <td>Sem data de nascimento</td>
                                    <td class="text-right">{{ $resumo['sem_nascimento'] }}</td>
                                    <td class="text-right">{{ $resumo['sem_nascimento_pct'] }}%</td>
                                </tr>
                                <tr>
                                    <td>Sem cidade <em>e</em> sem score</td>
                                    <td class="text-right">{{ $resumo['sem_cidade_e_score'] }}</td>
                                    <td class="text-right">{{ $resumo['sem_cidade_e_score_pct'] }}%</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Filtros de Busca -->
<div class="row clearfix mb-3">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title"><i class="fa fa-filter"></i> Filtros de Busca</h6>
            </div>
            <div class="card-body">
                <form id="form-filtros">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Nome</label>
                                <input type="text" class="form-control" name="nome" id="filtro-nome" placeholder="Nome do trilheiro">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>E-mail</label>
                                <input type="text" class="form-control" name="email" id="filtro-email" placeholder="E-mail">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Cidade</label>
                                <input type="text" class="form-control" name="cidade" id="filtro-cidade" placeholder="Cidade">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Índice (IET)</label>
                                <select class="form-control" name="indice" id="filtro-indice">
                                    <option value="">Todos</option>
                                    @foreach($indices as $indice)
                                        <option value="{{ $indice->id_indice_ind }}">
                                            @if($indice->ds_sigla_ind){{ $indice->ds_sigla_ind }} — @endif{{ $indice->ds_indice_ind }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Newsletter</label>
                                <select class="form-control" name="newsletter" id="filtro-newsletter">
                                    <option value="">Todas</option>
                                    <option value="1">Ativas</option>
                                    <option value="0">Inativas</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                            <button type="button" class="btn btn-warning" id="btn-limpar"><i class="fa fa-refresh"></i> Limpar</button>
                            <form action="{{ route('admin.trilheiros.recalcular-score') }}" method="POST" class="d-inline" onsubmit="return confirm('Recalcular o score de todos os trilheiros com questionário respondido?')">
                                @csrf
                                <button type="submit" class="btn btn-info"><i class="fa fa-calculator"></i> Recalcular Score de Todos</button>
                            </form>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Botão de Envio em Massa -->
<div class="row clearfix mb-3">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.trilheiros.enviar-email-questionario-massa') }}" method="POST" onsubmit="return confirm('Tem certeza que deseja enviar emails para todos os trilheiros sem score? Esta ação não pode ser desfeita.');">
                    @csrf
                    <button type="submit" class="btn btn-warning">
                        <i class="fa fa-paper-plane"></i> Enviar Convite de Questionário para Todos sem Score
                    </button>
                    <small class="text-muted ml-2">Será enviado um email para todos os trilheiros que ainda não possuem score.</small>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Lista de Trilheiros -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12">
        <div id="loading" class="text-center" style="display: none;">
            <i class="fa fa-spinner fa-spin fa-3x"></i>
            <p>Carregando...</p>
        </div>
        <div id="lista-trilheiros">
            <!-- Conteúdo carregado via AJAX -->
        </div>
    </div>       
</div>
@endsection

@section('script')
<script>
$(document).ready(function() {
    // Limpa formulário ao carregar a página
    $('#form-filtros')[0].reset();
    
    // Carrega dados iniciais
    carregarTrilheiros();
    
    // Buscar ao submeter formulário
    $('#form-filtros').on('submit', function(e) {
        e.preventDefault();
        carregarTrilheiros();
    });
    
    // Limpar filtros
    $('#btn-limpar').on('click', function() {
        $('#form-filtros')[0].reset();
        carregarTrilheiros();
    });
    
    // Paginação
    $(document).on('click', '#lista-trilheiros .pagination a', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        carregarTrilheiros(url);
    });
    
    function carregarTrilheiros(url) {
        url = url || '{{ route("admin.trilheiros.ajax") }}';
        
        $('#loading').show();
        $('#lista-trilheiros').html('');
        
        // Serializa os dados do formulário
        var dados = $('#form-filtros').serialize();
        
        console.log('URL:', url);
        console.log('Dados:', dados);
        
        $.ajax({
            url: url,
            type: 'GET',
            data: dados,
            dataType: 'json',
            success: function(response) {
                console.log('Sucesso!', response);
                $('#loading').hide();
                
                if(response.success) {
                    $('#lista-trilheiros').html(response.html);
                } else {
                    alert('Erro: ' + (response.message || 'Resposta inválida'));
                }
            },
            error: function(xhr) {
                $('#loading').hide();
                console.error('Erro completo:', xhr);
                console.error('Status:', xhr.status);
                console.error('Response:', xhr.responseText);
                
                // Tenta mostrar a mensagem de erro real
                try {
                    if(xhr.responseJSON) {
                        alert('Erro: ' + xhr.responseJSON.message);
                    } else {
                        alert('Erro ao carregar trilheiros. Status: ' + xhr.status);
                    }
                } catch(e) {
                    alert('Erro ao carregar trilheiros. Verifique o console.');
                }
            }
        });
    }
});
</script>
@endsection
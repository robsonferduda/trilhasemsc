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
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Cidade</label>
                                <input type="text" class="form-control" name="cidade" id="filtro-cidade" placeholder="Cidade">
                            </div>
                        </div>
                        <div class="col-md-3">
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
                        </div>
                    </div>
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
        <div id="paginacao" class="text-center mt-3">
            <!-- Paginação carregada via AJAX -->
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
    $(document).on('click', '#paginacao .pagination a', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        carregarTrilheiros(url);
    });
    
    function carregarTrilheiros(url) {
        url = url || '{{ route("admin.trilheiros.listar") }}';
        
        $('#loading').show();
        $('#lista-trilheiros').html('');
        
        // Adiciona parâmetro ajax=1 para identificar requisição AJAX
        var dados = $('#form-filtros').serialize();
        dados += dados ? '&ajax=1' : 'ajax=1';
        
        console.log('URL:', url);
        console.log('Dados:', dados);
        
        $.ajax({
            url: url,
            type: 'GET',
            data: dados,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            },
            dataType: 'json',
            success: function(response) {
                console.log('Sucesso!', response);
                $('#loading').hide();
                $('#lista-trilheiros').html(response.html);
                $('#paginacao').html(response.pagination);
            },
            error: function(xhr) {
                $('#loading').hide();
                console.error('Erro completo:', xhr);
                console.error('Status:', xhr.status);
                console.error('Response:', xhr.responseText);
                console.error('Response JSON:', xhr.responseJSON);
                
                // Tenta mostrar a mensagem de erro real
                try {
                    var errorMsg = xhr.responseJSON ? xhr.responseJSON.message : xhr.responseText;
                    alert('Erro: ' + errorMsg);
                } catch(e) {
                    if (xhr.status === 500) {
                        alert('Erro no servidor. Verifique os logs do Laravel.');
                    } else {
                        alert('Erro ao carregar trilheiros. Status: ' + xhr.status);
                    }
                }
            }
        });
    }
});
</script>
@endsection
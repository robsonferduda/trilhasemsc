@extends('layouts.site')
@section('content')
<header class="position-relative">
    <div class="container">
       <div class="row bg-white px-2 py-4 mt-n7 position-relative shadow border-radius-lg mb-2">
          <div class="col-lg-2 col-md-5 position-relative my-auto justify-content-center text-center">
               <div class="icon icon-shape icon-xxl bg-gradient-danger shadow mx-auto border-radius-xl">
                   <i class="fa fa-exclamation-circle text-white text-4xl opacity-10" aria-hidden="true"></i>
               </div>
          </div>
          <div class="col-md-10 z-index-2 position-relative px-md-2 px-sm-5 mt-sm-0 mt-4">
             <h4 class="mb-1">Ops! Algo deu errado</h4>
             <p class="text-sm mb-0">Estamos trabalhando para resolver o problema...</p>
          </div>
       </div>
    </div>
</header>

<section class="pt-3 pb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-lg">
                    <div class="card-body p-5 text-center">
                        <div class="mb-4">
                            <h1 class="display-1 text-gradient text-danger mb-0">500</h1>
                            <h3 class="text-gradient text-dark mb-3">Erro Interno do Servidor</h3>
                        </div>
                        
                        <p class="lead mb-4">
                            Desculpe, estamos enfrentando um problema técnico temporário. 
                            Nossa equipe já foi notificada e está trabalhando para resolver isso o mais rápido possível.
                        </p>

                        <div class="alert alert-info mx-auto" style="max-width: 600px;" role="alert">
                            <i class="fa fa-info-circle me-2"></i>
                            <strong>O que fazer agora?</strong>
                            <ul class="text-start mt-3 mb-0">
                                <li>Tente atualizar a página em alguns minutos</li>
                                <li>Volte para a página inicial</li>
                                <li>Se o problema persistir, entre em contato conosco</li>
                            </ul>
                        </div>

                        <div class="row mt-5 mb-4">
                            <div class="col-md-4 mb-3">
                                <div class="card h-100 shadow-sm hover-shadow">
                                    <div class="card-body text-center">
                                        <div class="icon icon-shape bg-gradient-success shadow mx-auto mb-3">
                                            <i class="fa fa-map-marker text-lg opacity-10"></i>
                                        </div>
                                        <h5 class="mb-2">Buscar Trilhas</h5>
                                        <p class="text-sm text-muted mb-3">Encontre trilhas em Santa Catarina</p>
                                        <a href="{{ url('trilhas') }}" class="btn btn-sm btn-success">
                                            Explorar Trilhas
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="card h-100 shadow-sm hover-shadow">
                                    <div class="card-body text-center">
                                        <div class="icon icon-shape bg-gradient-info shadow mx-auto mb-3">
                                            <i class="fa fa-home text-lg opacity-10"></i>
                                        </div>
                                        <h5 class="mb-2">Página Inicial</h5>
                                        <p class="text-sm text-muted mb-3">Voltar para o início</p>
                                        <a href="{{ url('/') }}" class="btn btn-sm btn-info">
                                            Ir para Home
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="card h-100 shadow-sm hover-shadow">
                                    <div class="card-body text-center">
                                        <div class="icon icon-shape bg-gradient-warning shadow mx-auto mb-3">
                                            <i class="fa fa-refresh text-lg opacity-10"></i>
                                        </div>
                                        <h5 class="mb-2">Tentar Novamente</h5>
                                        <p class="text-sm text-muted mb-3">Recarregar esta página</p>
                                        <a href="javascript:location.reload()" class="btn btn-sm btn-warning">
                                            Atualizar Página
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Links Rápidos -->
                        <div class="card bg-gradient-light mt-4">
                            <div class="card-body p-4">
                                <h5 class="mb-3">Acesso Rápido:</h5>
                                <div class="row g-2">
                                    <div class="col-md-3 col-6">
                                        <a href="{{ url('trilhas') }}" class="btn btn-outline-primary w-100 btn-sm">
                                            <i class="fa fa-list me-1"></i> Todas as Trilhas
                                        </a>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <a href="{{ url('trilhas/regioes') }}" class="btn btn-outline-info w-100 btn-sm">
                                            <i class="fa fa-map me-1"></i> Por Região
                                        </a>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <a href="{{ url('trilhas/brasil') }}" class="btn btn-outline-success w-100 btn-sm">
                                            <i class="fa fa-flag me-1"></i> Brasil
                                        </a>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <a href="{{ url('/') }}" class="btn btn-outline-warning w-100 btn-sm">
                                            <i class="fa fa-home me-1"></i> Home
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Status e Contato -->
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="alert alert-light border" role="alert">
                                    <i class="fa fa-clock-o me-2"></i>
                                    <strong>Detectamos o problema:</strong> {{ date('d/m/Y H:i:s') }}
                                    <br>
                                    <small class="text-muted">Nossa equipe técnica já foi notificada automaticamente.</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .hover-shadow {
        transition: all 0.3s ease;
    }
    .hover-shadow:hover {
        transform: translateY(-5px);
        box-shadow: 0 1rem 3rem rgba(0,0,0,.175) !important;
    }
    .display-1 {
        font-size: 8rem;
        font-weight: 700;
        line-height: 1;
    }
    @media (max-width: 768px) {
        .display-1 {
            font-size: 5rem;
        }
    }
</style>

@endsection

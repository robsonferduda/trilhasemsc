@extends('layouts.site')
@section('content')
<header class="position-relative">
    <div class="container">
       <div class="row bg-white px-2 py-4 mt-n7 position-relative shadow border-radius-lg mb-2">
          <div class="col-lg-2 col-md-5 position-relative my-auto justify-content-center text-center">
               <div class="icon icon-shape icon-xxl bg-gradient-danger shadow mx-auto border-radius-xl">
                   <i class="fa fa-ban text-white text-4xl opacity-10" aria-hidden="true"></i>
               </div>
          </div>
          <div class="col-md-10 z-index-2 position-relative px-md-2 px-sm-5 mt-sm-0 mt-4">
             <h4 class="mb-1">Acesso Negado</h4>
             <p class="text-sm mb-0">Você não tem permissão para acessar este recurso</p>
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
                            <h1 class="display-1 text-gradient text-danger mb-0">403</h1>
                            <h3 class="text-gradient text-dark mb-3">Acesso Negado</h3>
                        </div>
                        
                        <p class="lead mb-4">
                            Desculpe, você não tem permissão para acessar esta página ou recurso.
                        </p>

                        <div class="alert alert-danger mx-auto" style="max-width: 600px;" role="alert">
                            <i class="fa fa-lock me-2"></i>
                            <strong>Permissão Necessária</strong>
                            <ul class="text-start mt-3 mb-0">
                                <li>Esta área é restrita</li>
                                <li>Você pode precisar fazer login</li>
                                <li>Seu usuário pode não ter as permissões necessárias</li>
                            </ul>
                        </div>

                        <div class="row mt-5 mb-4">
                            <div class="col-md-4 mb-3">
                                <div class="card h-100 shadow-sm hover-shadow">
                                    <div class="card-body text-center">
                                        <div class="icon icon-shape bg-gradient-success shadow mx-auto mb-3">
                                            <i class="fa fa-sign-in text-lg opacity-10"></i>
                                        </div>
                                        <h5 class="mb-2">Fazer Login</h5>
                                        <p class="text-sm text-muted mb-3">Entre com sua conta</p>
                                        <a href="{{ url('login') }}" class="btn btn-sm btn-success">
                                            Login
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
                                        <div class="icon icon-shape bg-gradient-primary shadow mx-auto mb-3">
                                            <i class="fa fa-map-marker text-lg opacity-10"></i>
                                        </div>
                                        <h5 class="mb-2">Explorar Trilhas</h5>
                                        <p class="text-sm text-muted mb-3">Conteúdo público</p>
                                        <a href="{{ url('trilhas') }}" class="btn btn-sm btn-primary">
                                            Ver Trilhas
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card bg-gradient-light mt-4">
                            <div class="card-body p-4">
                                <h5 class="mb-3">Precisa de Ajuda?</h5>
                                <p class="text-muted mb-3">
                                    Se você acredita que deveria ter acesso a esta área, 
                                    entre em contato com o administrador do sistema.
                                </p>
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

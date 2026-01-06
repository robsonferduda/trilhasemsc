@extends('layouts.site')
@section('content')
<header class="position-relative">
    <div class="container">
       <div class="row bg-white px-2 py-4 mt-n7 position-relative shadow border-radius-lg mb-2">
          <div class="col-lg-2 col-md-5 position-relative my-auto justify-content-center text-center">
               <div class="icon icon-shape icon-xxl bg-gradient-warning shadow mx-auto border-radius-xl">
                   <i class="fa fa-exclamation-triangle text-white text-4xl opacity-10" aria-hidden="true"></i>
               </div>
          </div>
          <div class="col-md-10 z-index-2 position-relative px-md-2 px-sm-5 mt-sm-0 mt-4">
             <h4 class="mb-1">Ops! Página não encontrada</h4>
             <p class="text-sm mb-0">Parece que você se perdeu na trilha...</p>
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
                            <h1 class="display-1 text-gradient text-warning mb-0">404</h1>
                            <h3 class="text-gradient text-dark mb-3">Página Não Encontrada</h3>
                        </div>
                        
                        <p class="lead mb-4">
                            A página que você está procurando não existe ou foi movida. 
                            Mas não se preocupe, podemos ajudá-lo a encontrar o caminho certo!
                        </p>

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
                                            <i class="fa fa-search text-lg opacity-10"></i>
                                        </div>
                                        <h5 class="mb-2">Pesquisar</h5>
                                        <p class="text-sm text-muted mb-3">Busque o que precisa</p>
                                        <button onclick="document.getElementById('search-form').scrollIntoView({behavior: 'smooth'})" class="btn btn-sm btn-warning">
                                            Fazer Busca
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Formulário de Busca -->
                        <div class="card bg-gradient-light mt-4" id="search-form">
                            <div class="card-body p-4">
                                <h5 class="mb-3">Ou use a busca rápida:</h5>
                                <form action="{{ url('pesquisar-trilhas') }}" method="POST" class="row g-3">
                                    @csrf
                                    <div class="col-md-4">
                                        <select name="cidade" class="form-control">
                                            <option value="">Selecione uma cidade</option>
                                            <!-- Adicione suas cidades aqui -->
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="termo" class="form-control" placeholder="Nome da trilha...">
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary w-100">
                                            <i class="fa fa-search me-2"></i>Buscar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Dica Útil -->
                        <div class="alert alert-info mt-4" role="alert">
                            <i class="fa fa-info-circle me-2"></i>
                            <strong>Dica:</strong> Verifique se o endereço foi digitado corretamente ou utilize o menu de navegação acima.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Trilhas em Destaque (opcional) -->
        <div class="row mt-5">
            <div class="col-md-12">
                <h4 class="text-gradient text-dark mb-3">
                    <i class="fa fa-star text-warning"></i> Trilhas em Destaque
                </h4>
                <p class="text-muted mb-4">Enquanto isso, que tal conhecer essas trilhas populares?</p>
                
                <!-- Aqui você pode adicionar um componente de trilhas em destaque -->
                <div class="text-center">
                    <a href="{{ url('trilhas') }}" class="btn btn-outline-primary btn-lg">
                        Ver Todas as Trilhas
                    </a>
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

@extends('layouts.site')
@section('content')
<header class="position-relative">
    <div class="container">
       <div class="row bg-white px-2 py-4 mt-n7 position-relative shadow border-radius-lg mb-2">
          <div class="col-lg-2 col-md-5 position-relative my-auto justify-content-center text-center">
               <div class="icon icon-shape icon-xxl bg-gradient-warning shadow mx-auto border-radius-xl">
                   <i class="fa fa-wrench text-white text-4xl opacity-10" aria-hidden="true"></i>
               </div>
          </div>
          <div class="col-md-10 z-index-2 position-relative px-md-2 px-sm-5 mt-sm-0 mt-4">
             <h4 class="mb-1">Sistema em Manutenção</h4>
             <p class="text-sm mb-0">Voltaremos em breve com melhorias...</p>
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
                            <h1 class="display-1 text-gradient text-warning mb-0">503</h1>
                            <h3 class="text-gradient text-dark mb-3">Serviço Temporariamente Indisponível</h3>
                        </div>
                        
                        <p class="lead mb-4">
                            Estamos realizando uma manutenção programada para melhorar sua experiência. 
                            Por favor, volte em alguns instantes.
                        </p>

                        <div class="alert alert-warning mx-auto" style="max-width: 600px;" role="alert">
                            <i class="fa fa-wrench me-2"></i>
                            <strong>Manutenção em Andamento</strong>
                            <p class="mt-3 mb-0">
                                Estamos trabalhando para tornar o sistema ainda melhor para você. 
                                Agradecemos sua compreensão e paciência.
                            </p>
                        </div>

                        <div class="card bg-gradient-light mt-4">
                            <div class="card-body p-4">
                                <h5 class="mb-3"><i class="fa fa-clock-o me-2"></i>Enquanto isso...</h5>
                                <p class="text-muted mb-3">Aproveite para conhecer mais sobre as trilhas de Santa Catarina:</p>
                                <ul class="text-start mx-auto" style="max-width: 500px;">
                                    <li>Mais de 200 trilhas catalogadas</li>
                                    <li>Informações detalhadas sobre cada trilha</li>
                                    <li>Fotos e avaliações da comunidade</li>
                                    <li>Mapas e coordenadas GPS</li>
                                </ul>
                            </div>
                        </div>

                        <div class="mt-5">
                            <a href="javascript:location.reload()" class="btn btn-warning btn-lg">
                                <i class="fa fa-refresh me-2"></i> Tentar Novamente
                            </a>
                        </div>

                        <div class="alert alert-light border mt-4" role="alert">
                            <i class="fa fa-info-circle me-2"></i>
                            <small>
                                Se o problema persistir, você pode nos contatar através das redes sociais.
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
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

<!DOCTYPE html>
<html lang="pt-br">
   <head>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel="apple-touch-icon" sizes="76x76" href="img/apple-icon.png">
      <link rel="icon" type="image/png" href="img/favicon.png">
      <title>
        Trilhas em Santa Catarina
      </title>
      <link rel="canonical" href="https://www.creative-tim.com/product/now-ui-design-system-pro" />
      <meta name="keywords" content="bootstrap, bootstrap 5, bootstrap5, ui kit, design system, responsive design, web design ui, ui design system, now ui kit, now ui design system">
      <meta name="description" content="Guia de trilhas e camping em Santa Catarina, trazendo informações de localização, trajetos e grau de dificuldade para quem quer conhecer e desfrutar das praias, serras e montanhas desse belo estado do Sul do Brasil">
      <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700,200|Open+Sans+Condensed:700" rel="stylesheet">
      <link href="{{ asset('css/nucleo-icons.css') }}" rel="stylesheet" />
      <link href="{{ asset('css/nucleo-svg.css') }}" rel="stylesheet" />
      <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
      <link id="pagestyle" href="{{ asset('css/template.css') }}" rel="stylesheet" />
      <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
      <style>
         .async-hide {
         opacity: 0 !important
         }
      </style>
   </head>
   <body class="help-center">
      <nav class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3  navbar-transparent ">
         <div class="container">           
            <div class="collapse navbar-collapse w-100 pt-3 pb-2 py-lg-0" id="navigation">
               <ul class="navbar-nav navbar-nav-hover mx-auto">
                <li class="nav-item dropdown dropdown-hover mx-2">
                    <a class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center" role="button" id="dropdownMenuDocs" data-bs-toggle="dropdown" aria-expanded="false">
                    Início
                    </a>
                </li>            
                  <li class="nav-item dropdown dropdown-hover mx-2">
                     <a class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center" role="button" id="dropdownMenuDocs" data-bs-toggle="dropdown" aria-expanded="false">
                     Trilhas
                     <img src="{{ asset('img/down-arrow-white.svg') }}" alt="down-arrow" class="arrow ms-1 d-lg-block d-none">
                     <img src="{{ asset('img/down-arrow-dark.svg') }}" alt="down-arrow" class="arrow ms-1 d-lg-none d-block">
                     </a>
                     <div class="dropdown-menu dropdown-menu-animation dropdown-lg mt-0 mt-lg-3 p-3 border-radius-lg" aria-labelledby="dropdownMenuDocs">
                        <div class="d-none d-lg-block">
                           <ul class="list-group">
                              <li class="nav-item list-group-item border-0 p-0">
                                 <a class="dropdown-item py-2 ps-3 border-radius-md" href="{{ url('trilhas#lista') }}">
                                    <div class="d-flex">
                                       <div class="icon h-10 me-3 d-flex mt-1">
                                          <i class="ni ni-planet text-secondary"></i>
                                       </div>
                                       <div>
                                          <h6 class="dropdown-header text-dark font-weight-bold d-flex justify-content-cente align-items-center p-0">Trilhas em SC</h6>
                                          <span class="text-sm">Trilhas em Santa Catarina</span>
                                       </div>
                                    </div>
                                 </a>
                              </li>                                                  
                              <li class="nav-item list-group-item border-0 p-0">
                                 <a class="dropdown-item py-2 ps-3 border-radius-md" href="{{ url('trilhas/brasil') }}">
                                    <div class="d-flex">
                                       <div class="icon h-10 me-3 d-flex mt-1">
                                          <i class="ni ni-spaceship text-secondary"></i>
                                       </div>
                                       <div>
                                          <h6 class="dropdown-header text-dark font-weight-bold d-flex justify-content-cente align-items-center p-0">Trilhas no Brasil</h6>
                                          <span class="text-sm">Trilhas no Brasil</span>
                                       </div>
                                    </div>
                                 </a>
                              </li>
                             
                           </ul>
                        </div>
                      
                     </div>
                  </li>
                  <li class="nav-item dropdown dropdown-hover mx-2">
                    <a href="{{ url('campings') }}" class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center">
                    Camping
                    </a>
                </li>
                <li class="nav-item dropdown dropdown-hover mx-2">
                    <a href="{{ url('grupos') }}" class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center">
                    Grupos
                    </a>
                </li>
                <li class="nav-item dropdown dropdown-hover mx-2">
                    <a href="{{ url('eventos') }}" class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center">
                    Eventos
                    </a>
                </li>
                <li class="nav-item dropdown dropdown-hover mx-2">
                    <a href="{{ url('guias-e-condutores') }}" class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center">
                    Guias e Condutores
                    </a>
                </li>
               </ul>
               <ul class="navbar-nav d-lg-block d-none">
                  <li class="nav-item">
                     <a href="{{ url('guias-e-condutores') }}" class="btn btn-sm  bg-gradient-primary  btn-round mb-0 me-1">TRILHEIROS</a>
                     <a href="{{ url('guias-e-condutores/cadastro') }}" class="btn btn-sm  bg-gradient-warning  btn-round mb-0 me-1">CONDUTORES</a>
                  </li>
               </ul>
            </div>
         </div>
      </nav>
      <div class="page-header min-vh-50" style="background-image: url('{{ asset('img/bg/lagoinha-do-leste.jpg') }}');">
         <span class="mask bg-gradient-dark opacity-6"></span>
         <div class="container">
            <div class="row justify-content-center">
               <div class="col-lg-6 col-sm-9 text-center mx-auto">
                  <h2 class="text-white mb-4">Quer planejar sua próxima aventura?</h2>
                  <p class="lead text-white">Procure por trilhas e guias no estado de Santa Catarina</p>
               </div>
            </div>
         </div>
      </div>
      @yield('content')    
      <div class="pt-5 mb-5 mt-3">
         <div class="container">
            <div class="row">
               <div class="col-lg-5 ms-auto">
                  <h4 class="mb-1">Gostou do nosso conteúdo?</h4>
                  <p class="lead mb-0">Compartilhe em suas redes sociais</p>
               </div>
               <div class="col-lg-5 me-lg-auto my-lg-auto text-lg-end mt-5">
                  <a href="https://twitter.com/intent/tweet?text=Quer conhecer as melhores trilhas de Santa Catarina? Acesse http://trilhasemsc.com.br @trilhasemsc" class="btn btn-twitter mb-0 me-2" target="_blank">
                  <i class="fab fa-twitter me-1" aria-hidden="true"></i> Twitter
                  </a>
                  <a href="https://www.facebook.com/sharer/sharer.php?u=http://trilhasemsc.com.br" class="btn btn-facebook mb-0 me-2" target="_blank">
                  <i class="fab fa-facebook-square me-1" aria-hidden="true"></i> Facebook
                  </a>
               </div>
            </div>
         </div>
      </div>       
      <footer class="footer py-5 bg-dark position-relative overflow-hidden">
         <div class="container position-relative z-index-1">
            <div class="row">
               <div class="col-lg-6 me-auto mb-lg-0 mb-4 text-lg-start text-start">
                  <h6 class="text-white font-weight-bolder text-uppercase mb-lg-4 mb-3">Trilhas em SC</h6>
                  <ul class="nav flex-row ms-n3 justify-content-lg-start justify-content-center mb-4 mt-sm-0">
                     <li class="nav-item"><a class="nav-link text-white opacity-8" href="{{ url('sobre-nos') }}">Sobre nós</a></li>
                     <li class="nav-item"><a class="nav-link text-white opacity-8" href="{{ url('guia-de-dificuldade-em-trilhas') }}">Guia de Dificuldade</a></li>
                     <li class="nav-item"><a class="nav-link text-white opacity-8" href="{{ url('termos-de-uso') }}">Termos de Uso</a></li>
                     <li class="nav-item"><a class="nav-link text-white opacity-8" href="{{ url('politica-de-privacidade') }}">Política de Privacidade</a></li>
                  </ul>                  
               </div>
               <div class="col-lg-6 ms-auto text-lg-end text-center">
                  <p class="mb-5 text-lg text-white font-weight-bold">
                    Desde 2020, o site. Trilhas fazemos desde sempre!
                  </p>
                  <a href="javascript:;" target="_blank" class="text-white me-xl-4 me-4 opacity-5">
                    <span class="fab fa-instagram"></span>
                  </a>
                  <a href="javascript:;" target="_blank" class="text-white me-xl-4 me-4 opacity-5">
                  <span class="fa fa-envelope"></span>
                  </a>                  
               </div>
            </div>
         </div>
      </footer>
      <script src="{{ asset('js/core/bootstrap.min.js') }}" type="text/javascript"></script>
      <script src="{{ asset('js/plugins/choices.min.js') }}"></script>
      <script>
         if (document.getElementById('list-cidade')) {
           var element = document.getElementById('list-cidade');
           const example = new Choices(element, {
             searchEnabled: false
           });
         }

         if (document.getElementById('list-niveis')) {
           var element = document.getElementById('list-niveis');
           const example = new Choices(element, {
             searchEnabled: false
           });
         }
      </script>
      <script>
         if (document.getElementsByClassName('page-header')) {
           window.addEventListener('scroll', function() {
             var scrollPosition = window.pageYOffset;
             var bgParallax = document.querySelector('.page-header');
             var limit = bgParallax.offsetTop + bgParallax.offsetHeight;
             if (scrollPosition > bgParallax.offsetTop && scrollPosition <= limit) {
               bgParallax.style.backgroundPositionY = (50 - 10 * scrollPosition / limit * 3) + '%';
             } else {
               bgParallax.style.backgroundPositionY = '50%';
             }
           });
         }
      </script>
      @env('production')
      <script async src="https://www.googletagmanager.com/gtag/js?id=UA-175572747-1"></script>
      <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-175572747-1');
      </script>
      @endenv
      <script data-ad-client="ca-pub-1229685353625953" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
   </body>
</html>
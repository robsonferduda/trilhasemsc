<!DOCTYPE html>
<html lang="pt-br">
   <head>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="Guia de trilhas e camping em Santa Catarina, trazendo informações de localização, trajetos e grau de dificuldade para quem quer conhecer e desfrutar das praias, serras e montanhas desse belo estado do Sul do Brasil">
      <meta name="keywords" content="trilhas em sc, camping em sc, trilhas em santa catarina"> 
      <title>
         {{ (isset($page_name)) ? $page_name : 'Trilhas em Santa Catarina' }}
      </title>
      <link rel="apple-touch-icon" sizes="76x76" href="img/apple-icon.png">
      <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon/favicon-32x32.png') }}">
      <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon/favicon-16x16.png') }}">      
      <link href="{{ asset('css/nucleo-icons.css') }}" rel="stylesheet" />
      <link href="{{ asset('css/nucleo-svg.css') }}" rel="stylesheet" />
      <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700,200|Open+Sans+Condensed:700" rel="stylesheet">
      <link id="pagestyle" href="{{ asset('css/template.css') }}" rel="stylesheet" />
      <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
      <link rel="stylesheet" href="{{ asset('css/custom.css') }}?v=<?php echo date("Ymdhis") ?>">
      <style>
         .async-hide {
            opacity: 0 !important
         }
      </style>
      {!! htmlScriptTagJsApi() !!}
      <!-- Google Tag Manager -->
      <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
      new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
      j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
      'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
      })(window,document,'script','dataLayer','GTM-5H3D7W9');</script>
      <!-- End Google Tag Manager -->


   <!-- InMobi Choice. Consent Manager Tag v3.0 (for TCF 2.2) -->
   <script type="text/javascript" async=true>
   (function() {
     var host = "www.themoneytizer.com";
     var element = document.createElement('script');
     var firstScript = document.getElementsByTagName('script')[0];
     var url = 'https://cmp.inmobi.com'
       .concat('/choice/', '6Fv0cGNfc_bw8', '/', host, '/choice.js?tag_version=V3');
     var uspTries = 0;
     var uspTriesLimit = 3;
     element.async = true;
     element.type = 'text/javascript';
     element.src = url;
   
     firstScript.parentNode.insertBefore(element, firstScript);
   
     function makeStub() {
       var TCF_LOCATOR_NAME = '__tcfapiLocator';
       var queue = [];
       var win = window;
       var cmpFrame;
   
       function addFrame() {
         var doc = win.document;
         var otherCMP = !!(win.frames[TCF_LOCATOR_NAME]);
   
         if (!otherCMP) {
           if (doc.body) {
             var iframe = doc.createElement('iframe');
   
             iframe.style.cssText = 'display:none';
             iframe.name = TCF_LOCATOR_NAME;
             doc.body.appendChild(iframe);
           } else {
             setTimeout(addFrame, 3);
           }
         }
         return !otherCMP;
       }
   
       function tcfAPIHandler() {
         var gdprApplies;
         var args = arguments;
   
         if (!args.length) {
           return queue;
         } else if (args[0] === 'setGdprApplies') {
           if (
             args.length > 3 &&
             args[2] === 2 &&
             typeof args[3] === 'boolean'
           ) {
             gdprApplies = args[3];
             if (typeof args[2] === 'function') {
               args[2]('set', true);
             }
           }
         } else if (args[0] === 'ping') {
           var retr = {
             gdprApplies: gdprApplies,
             cmpLoaded: false,
             cmpStatus: 'stub'
           };
   
           if (typeof args[2] === 'function') {
             args[2](retr);
           }
         } else {
           if(args[0] === 'init' && typeof args[3] === 'object') {
             args[3] = Object.assign(args[3], { tag_version: 'V3' });
           }
           queue.push(args);
         }
       }
   
       function postMessageEventHandler(event) {
         var msgIsString = typeof event.data === 'string';
         var json = {};
   
         try {
           if (msgIsString) {
             json = JSON.parse(event.data);
           } else {
             json = event.data;
           }
         } catch (ignore) {}
   
         var payload = json.__tcfapiCall;
   
         if (payload) {
           window.__tcfapi(
             payload.command,
             payload.version,
             function(retValue, success) {
               var returnMsg = {
                 __tcfapiReturn: {
                   returnValue: retValue,
                   success: success,
                   callId: payload.callId
                 }
               };
               if (msgIsString) {
                 returnMsg = JSON.stringify(returnMsg);
               }
               if (event && event.source && event.source.postMessage) {
                 event.source.postMessage(returnMsg, '*');
               }
             },
             payload.parameter
           );
         }
       }
   
       while (win) {
         try {
           if (win.frames[TCF_LOCATOR_NAME]) {
             cmpFrame = win;
             break;
           }
         } catch (ignore) {}
   
         if (win === window.top) {
           break;
         }
         win = win.parent;
       }
       if (!cmpFrame) {
         addFrame();
         win.__tcfapi = tcfAPIHandler;
         win.addEventListener('message', postMessageEventHandler, false);
       }
     };
   
     makeStub();
   
     var uspStubFunction = function() {
       var arg = arguments;
       if (typeof window.__uspapi !== uspStubFunction) {
         setTimeout(function() {
           if (typeof window.__uspapi !== 'undefined') {
             window.__uspapi.apply(window.__uspapi, arg);
           }
         }, 500);
       }
     };
   
     var checkIfUspIsReady = function() {
       uspTries++;
       if (window.__uspapi === uspStubFunction && uspTries < uspTriesLimit) {
         console.warn('USP is not accessible');
       } else {
         clearInterval(uspInterval);
       }
     };
   
     if (typeof window.__uspapi === 'undefined') {
       window.__uspapi = uspStubFunction;
       var uspInterval = setInterval(checkIfUspIsReady, 6000);
     }
   })();
   </script>
 
   <!-- End InMobi Choice. Consent Manager Tag v3.0 (for TCF 2.2) -->
   </head>
   <body class="help-center">    
      {{-- <div id="125834-47"><script src="//ads.themoneytizer.com/s/gen.js?type=47"></script><script src="//ads.themoneytizer.com/s/requestform.js?siteId=125834&formatId=47"></script></div>--}}
      <!-- Google Tag Manager (noscript) -->
         <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5H3D7W9" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
      <!-- End Google Tag Manager (noscript) -->
      <nav class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3  navbar-transparent ">
         <div class="container">           
            <button class="navbar-toggler shadow-none ms-md-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon mt-2">
               <span class="navbar-toggler-bar bar1"></span>
               <span class="navbar-toggler-bar bar2"></span>
               <span class="navbar-toggler-bar bar3"></span>
               </span>
            </button>
            <div class="collapse navbar-collapse w-100 pt-3 pb-2 py-lg-0" id="navigation">
               <ul class="navbar-nav navbar-nav-hover mx-auto">
                <li class="nav-item dropdown dropdown-hover mx-2">
                     <a href="{{ url('/') }}" class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center">
                     Início
                     </a>
                </li>            
                  <li class="nav-item dropdown dropdown-hover mx-2">
                     <a href="{{ url('trilhas') }}" class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center">
                        Trilhas
                     </a>
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
                     @if(Auth::user())
                        @if(trim(Auth::user()->id_role) == 'ADMIN')
                           <a href="{{ url('admin/dashboard') }}" class="btn btn-sm  bg-gradient-warning  btn-round mb-0 me-1">MEU PERFIL</a>
                        @endif
                        @if(trim(Auth::user()->id_role) == 'GUIA')
                           <a href="{{ url('guia-e-condutores/privado/atualizar-cadastro') }}" class="btn btn-sm  bg-gradient-warning  btn-round mb-0 me-1">MEU PERFIL</a>
                        @endif
                        @if(trim(Auth::user()->id_role) == 'TRILHEIRO')
                           <a href="{{ url('trilheiro/privado/perfil') }}" class="btn btn-sm  bg-gradient-warning  btn-round mb-0 me-1">MEU PERFIL</a>
                        @endif
                        <a href="{{ url('logout') }}" class="btn btn-sm  bg-gradient-danger  btn-round mb-0 me-1" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">SAIR</a>
                     @else
                        <a href="{{ url('guias-e-condutores/cadastro') }}" class="btn btn-sm  bg-gradient-warning  btn-round mb-0 me-1">CADASTRE-SE</a>
                        <a href="{{ url('login') }}" class="btn btn-sm  bg-gradient-info  btn-round mb-0 me-1">LOGIN</a>
                     @endif
                     <!--
                        <a href="{{ url('guias-e-condutores') }}" class="btn btn-sm  bg-gradient-primary  btn-round mb-0 me-1">TRILHEIROS</a>
                        <a href="{{ url('guias-e-condutores/cadastro') }}" class="btn btn-sm  bg-gradient-warning  btn-round mb-0 me-1">CONDUTORES</a>
                     -->
                  </li>
               </ul>
               <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
               </form>
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
      @if(!@empty($eventoBanner))   
          <!-- Banner para mobile -->
        <div class="mobile-banner shadow mb-5 border-radius-lg">
          <div class="banner-content">
            <h2>Eventos e Trilhas em Santa Catarina</h2>   
            <h3 class="text-danger" >{{ $eventoBanner->nm_evento_eve }}</h3> 
            <div style="text-align: left;">      
              <p><strong>Responsável:</strong> {{ $eventoBanner->guia->nm_guia_gui }}</p>
              <p><strong>Cidade:</strong> {{ $eventoBanner->local->nm_cidade_cde }}</p>
              <p><strong>Início:</strong> {{ \Carbon\Carbon::parse($eventoBanner->dt_realizacao_eve)->format('d/m/Y')}} - {{ \Carbon\Carbon::parse($eventoBanner->hora_inicio_eve)->format('H:i') }}</p>
              <p><strong>Término:</strong> {{ \Carbon\Carbon::parse($eventoBanner->dt_termino_eve)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($eventoBanner->hora_fim_eve)->format('H:i') }}</p>
              <p class="mb-1"><strong>Valor</strong>: {!! ($eventoBanner->valor_eve) ? " R$ ".$eventoBanner->valor_eve : '<strong class="text-success">Gratuita</strong>' !!}</p>
              <p><strong>Contato:</strong> {{ $eventoBanner->ds_fone_contato_eve }}</p>
            </div>
            <a href="{{ url('eventos/detalhes', $eventoBanner->id_evento_eve) }}" type="button" class="btn btn-outline-info btn-sm-block">Ver Detalhes</a><br>
            <a href="{{ url('eventos') }}" class="btn bg-gradient-primary w-45 mb-0">TODOS EVENTOS</a>
          </div>
        </div>
      @endif
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
                  <a href="https://www.instagram.com/trilhasemsc" target="_blank" class="text-white me-xl-4 me-4 opacity-5">
                    <span class="fab fa-instagram"></span>
                  </a>
                  <a href="mailto:trilhasemsc@gmail.com?subject=Contato Site" target="_blank" class="text-white me-xl-4 me-4 opacity-5">
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
         <script data-ad-client="ca-pub-1229685353625953" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
      @endenv
      <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
      <script src="{{ asset('js/vendor/jquery-1.12.3.min.js') }}"></script>
      <script src="{{ asset('js/custom.js') }}?v=<?php echo date("Ymdhis") ?>"></script>
      
      @yield('script')

      @if(!@empty($eventoBanner))                
        <!-- Banner flutuante -->
        <div class="floating-banner">
          <div class="banner-content">
            <h2>Eventos e Trilhas em Santa Catarina</h2>   
            <h3 class="text-danger" >{{ $eventoBanner->nm_evento_eve }}</h3>       
            <div style="text-align: left;">
              <p><strong>Responsável:</strong> {{ $eventoBanner->guia->nm_guia_gui }}</p>
              <p><strong>Cidade:</strong> {{ $eventoBanner->local->nm_cidade_cde }}</p>
              <p><strong>Início:</strong> {{ \Carbon\Carbon::parse($eventoBanner->dt_realizacao_eve)->format('d/m/Y')}} - {{ \Carbon\Carbon::parse($eventoBanner->hora_inicio_eve)->format('H:i') }}</p>
              <p><strong>Término:</strong> {{ \Carbon\Carbon::parse($eventoBanner->dt_termino_eve)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($eventoBanner->hora_fim_eve)->format('H:i') }}</p>
              <p class="mb-1"><strong>Valor</strong>: {!! ($eventoBanner->valor_eve) ? " R$ ".$eventoBanner->valor_eve : '<strong class="text-success">Gratuita</strong>' !!}</p>
              <p><strong>Contato:</strong> {{ $eventoBanner->ds_fone_contato_eve }}</p>
            </div>
            <a href="{{ url('eventos/detalhes', $eventoBanner->id_evento_eve) }}" type="button" class="btn btn-outline-info btn-sm">Ver Detalhes</a>
            <a href="{{ url('eventos') }}" class="btn bg-gradient-primary w-100 mb-0">TODOS EVENTOS</a>
          </div>
        </div>       
      @endif
   </body>
</html>
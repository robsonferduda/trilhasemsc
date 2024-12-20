<!doctype html>
<html class="no-js" lang="pt-br">
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Global site tag (gtag.js) - Google Analytics -->
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

        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/favicon/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon/favicon-16x16.png') }}">
        <link rel="manifest" href="{{ asset('img/favicon/site.webmanifest') }} ">
        <link rel="mask-icon" href="{{ asset('img/favicon/safari-pinned-tab.svg') }}" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">

        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>@yield('pageTitle')</title>
        <meta name="description" content="Guia de trilhas e camping em Santa Catarina, trazendo informações de localização, trajetos e grau de dificuldade para quem quer conhecer e desfrutar das praias, serras e montanhas desse belo estado do Sul do Brasil">
        <meta name="viewport" content="width=device-width, initial-scale=1">        
        <!-- favicon
        ============================================ -->        
        
        <!-- Google Fonts
        ============================================ -->        
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Raleway:400,300,500,600,700,800' rel='stylesheet' type='text/css'>
       
        <!-- Bootstrap CSS
        ============================================ -->        
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        
        <!-- Fontawsome CSS
        ============================================ -->
        <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
        
        <!-- owl.carousel CSS
        ============================================ -->
        {!! Minify::stylesheet('/css/owl.carousel.css')->withFullUrl() !!}
        
        <!-- jquery-ui CSS
        ============================================ -->
        <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">
        
        <!-- meanmenu CSS
        ============================================ -->
        <link rel="stylesheet" href="{{ asset('css/meanmenu.min.css') }}">
        
        <!-- animate CSS
        ============================================ -->
        {!! Minify::stylesheet('/css/animate.css')->withFullUrl() !!}
        
        <!-- nivo slider CSS
        ============================================ -->
        {!! Minify::stylesheet('/js/lib/nivo-slider/css/nivo-slider.css')->withFullUrl() !!}
        {!! Minify::stylesheet('/js/lib/nivo-slider/css/preview.css', array('media' => 'screen'))->withFullUrl() !!}
        
        <!-- style CSS
        ============================================ -->
        {!! Minify::stylesheet('/css/style.css')->withFullUrl() !!}
        
        <!-- responsive CSS
        ============================================ -->
        {!! Minify::stylesheet('/css/responsive.css')->withFullUrl() !!}

        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
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
                  setTimeout(addFrame, 5);
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
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        
        <!--Header Area Start-->
        <header>
            {{--
            @include('trilhas.componentes.header_login')
            --}}
            <!--Logo Mainmenu Start-->
            <div class="header-logo-menu">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="logo-menu-bg">
                                <div class="row">
                                    <div class="col-md-3 col-sm-12">
                                        <div class="logo">
                                            <a href=""><img src="{{ asset('img/logo/logo_trilhas.png') }}" alt="Trilhas em SC"></a>
                                        </div>
                                    </div>
                                    <div class="col-md-9 hidden-sm hidden-xs">
                                        <div class="mainmenu">
                                            @include('trilhas.componentes.menu')
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
            <!--End of Logo Mainmenu-->
            <!-- Mobile Menu Area start -->
            <div class="mobile-menu-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="mobile-menu">
                                @include('trilhas.componentes.menu_mobile')
                            </div>                  
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mobile Menu Area end -->
        </header>
        <!--End of Header Area-->
        <!--Slider Area Start-->
        <div class="slider-area">
            <div class="preview-2">
                <div id="nivoslider" class="slides">    
                    <a href="#"><img src="{{ asset('img/slider/lagoinha-do-leste.jpg') }}" alt="Foto panorâmina da trilha da lagoinha do leste em Florianópolis" title="#slider-1-caption1"/></a>
                </div> 
                <div id="slider-1-caption1" class="nivo-html-caption nivo-caption">
                    <div class="banner-content slider-1">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="text-content">
                                        <h1 class="title1">GUIA DE TRILHAS DE SANTA CATARINA</h1>
                                        <h2 class="sub-title">AS MELHORES TRILHAS VOCÊ ENCONTRA <span>AQUI</span></h2>                                  
                                        <form action="{{url('trilhas/#lista')}}" method="GET" id="banner-searchbox" class="hidden-xs form-search-trilha">
                                            <div class="adventure-cat">
                                                <select name="cidade" class="search-adventure">
                                                    <option selected value="">Selecione a Cidade</option>
                                                    @if(isset($cidades))
                                                        @forelse($cidades as $cidade)
                                                            <option {{ old('cidade') == stringToStringSeo($cidade->nm_cidade_cde) ? 'selected': ''}} value="{{stringToStringSeo($cidade->nm_cidade_cde)}}">{{$cidade->nm_cidade_cde}}</option>
                                                        @empty
                                                            <option selected value="">Nenhuma cidade disponível</option>
                                                        @endforelse
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="adventure-cat destination">
                                                <select name="nivel" class="search-adventure">
                                                    <option selected value="">Selecione o Nível</option>
                                                    @if(isset($cidades))
                                                        @foreach($niveis as $nivel)
                                                            <option {{ old('nivel') == stringToStringSeo($nivel->dc_nivel_niv) ? 'selected': ''}} value="{{stringToStringSeo($nivel->dc_nivel_niv)}}">{{$nivel->dc_nivel_niv}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="clearfix"></div>
                                            <button type="button" id="btn-search-trilha" class="btn-search-trilha">Buscar Aventura</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
        </div>
        <!--End of Slider Area-->
       
        @yield('content')

        <!--Footer Widget Area Start-->

        @include('trilhas.componentes.footer')

        <!--End of Footer Area-->     

        <!-- modernizr JS
        ============================================ -->       
        <script src="{{ asset('js/vendor/modernizr-2.8.3.min.js') }}"></script>
        <script src="{{ asset('js/vendor/jquery-1.12.3.min.js') }}"></script>     
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/lib/nivo-slider/js/jquery.nivo.slider.js') }}"></script>
        <script src="{{ asset('js/lib/nivo-slider/home.js') }}"></script>
        <script src="{{ asset('js/wow.min.js') }}"></script>
        <script src="{{ asset('js/jquery.meanmenu.js') }}"></script>
        <script src="{{ asset('js/owl.carousel.min.js') }}"></script>       
        <script src="{{ asset('js/jquery-price-slider.js') }}"></script>      
        <script src="{{ asset('js/jquery.scrollUp.min.js') }}"></script>        
        <script src="{{ asset('js/waypoints.min.js') }}"></script>        
        <script src="{{ asset('js/jquery.counterup.min.js') }}"></script>       
        <script src="{{ asset('js/plugins.js') }}"></script>
        <script src="{{ asset('js/main.js') }}"></script>
         <!-- Custom
        ============================================ -->        
        <script src="{{ asset('js/custom.js') }}"></script>
    </body>
</html>
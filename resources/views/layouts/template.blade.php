<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
<meta charset="utf-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="base-url" content="{{ env('APP_URL') }}">
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="description" content="Guia de trilhas e camping em Santa Catarina, trazendo informações de localização, trajetos e grau de dificuldade para quem quer conhecer e desfrutar das praias, serras e montanhas desse belo estado do Sul do Brasil"><meta name="author" content="">
<title>Sistema de Gerenciamento de Trilhas e Roteiros</title>

<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/favicon/apple-touch-icon.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon/favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon/favicon-16x16.png') }}">
<link rel="manifest" href="{{ asset('img/favicon/site.webmanifest') }} ">
<link rel="mask-icon" href="{{ asset('img/favicon/safari-pinned-tab.svg') }}" color="#5bbad5">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">

<!-- VENDOR CSS -->
<link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/bootstrap-multiselect/bootstrap-multiselect.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/parsleyjs/css/parsley.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/summernote/dist/summernote.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/dropify/css/dropify.css') }}">

<!-- MAIN CSS -->
<link rel="stylesheet" href="{{ asset('css/custom.css') }}?v={{ date("YmdHis") }}">
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
<link rel="stylesheet" href="{{ asset('css/color_skins.css') }}">

<link rel="stylesheet" href="{{ asset('vendor/jquery-datatable/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" integrity="sha512-kq3FES+RuuGoBW3a9R2ELYKRywUEQv0wvPTItv3DSGqjpbNtGWVdvT8qwdKkqvPzT93jp8tSF4+oN4IeTEIlQA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="{{ asset('vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('vendor/sweetalert/sweetalert.css') }}"/>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
<body class="theme-cyan">

<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="m-t-30"><img src="{{ asset('img/logo/logo_trilhas.png') }}" alt="Trilhas em SC"></div>
        <p>Carregando...</p>        
    </div>
</div>
<!-- Overlay For Sidebars -->
<div id="wrapper">

    <nav class="navbar navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-btn">
                <button type="button" class="btn-toggle-offcanvas"><i class="lnr lnr-menu fa fa-bars"></i></button>
            </div>

            <div class="navbar-brand">
                <a href="{{ url('/') }}" class="hidden-sm hidden-xs" style="color: black;"><img src="{{ asset('img/logo/logo_admin.jpg') }}" alt="Logo" class="img-responsive logo" style="width: 30px !important;"> Trilhas em SC</a>           
            </div>
            
            <div class="navbar-right">
            
                <div id="navbar-menu">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="icon-menu"><i class="icon-logout"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div id="left-sidebar" class="sidebar">
        <div class="sidebar-scroll">
            <div class="user-account">
               
                @switch(trim(Auth::user()->id_role))
                    @case('GUIA')
                        <img src="{{ Auth::user()->dc_foto_perfil ? asset('img/guias/'.Auth::user()->dc_foto_perfil) : asset('images/user.png') }}" class="rounded-circle user-photo" alt="Foto de Perfil">
                        @break
                    @case('TRILHEIRO')
                        <img src="{{ Auth::user()->dc_foto_perfil ? asset('img/trilheiros/'.Auth::user()->dc_foto_perfil) : asset('images/user.png') }}" class="rounded-circle user-photo" alt="Foto de Perfil">
                        @break
                    @default
                        <img src="{{ asset('images/user.png') }}" class="rounded-circle user-photo" alt="Foto de Perfil">
                @endswitch
                
                <div class="dropdown">
                    <span>Bem-vindo,</span>
                    <a href="javascript:void(0);" class="user-name" data-toggle="dropdown"><strong>{{ (Auth::user()) ? explode(' ', Auth::user()->name)[0] : "Não Logado" }}</strong></a>
                </div>
                <hr>
                @if(trim(Auth::user()->id_role) == 'ADMIN')
                    <ul class="row list-unstyled">
                        <li class="col-4">
                            <small>Trilhas</small>
                            <h6>{{ App\Trilha::all()->count() }}</h6>
                        </li>
                    </ul>
                @endif
            </div>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#menu">Menu</a></li>
            </ul>
                
            <!-- Tab panes -->
            <div class="tab-content p-l-0 p-r-0">
                <div class="tab-pane active" id="menu">
                    <nav id="left-sidebar-nav" class="sidebar-nav">
                        <ul id="main-menu" class="metismenu">
                            <li>
                                <a href="{{ url('/') }}"><i class="fa fa-globe"></i> <span>Site</span></a>
                            </li>
                            @if(trim(Auth::user()->id_role) == 'ADMIN')
                                <li>
                                    <a href="{{ url('/') }}"><i class="icon-home"></i> <span>Início</span></a>
                                </li>
                                <li>
                                    <a href="#" class="has-arrow"><i class="fa fa-ticket"></i> <span>Eventos</span></a>
                                    <ul>
                                        <li><a href="{{ url('admin/eventos/listar') }}">Listar</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#" class="has-arrow"><i class="fa fa-id-card"></i> <span>Guias</span></a>
                                    <ul>
                                        <li><a href="{{ url('admin/guias/listar') }}">Listar</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#" class="has-arrow"><i class="fa fa-users"></i> <span>Trilheiros</span></a>
                                    <ul>
                                        <li><a href="{{ url('admin/trilheiros/listar') }}">Listar</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#" class="has-arrow"><i class="fa fa-leaf"></i> <span>Trilhas</span></a>
                                    <ul>
                                        <li><a href="{{ url('admin/listar-trilhas') }}">Listar</a></li>
                                    </ul>
                                </li>
                                
                            @endif
                            @if(trim(Auth::user()->id_role) == 'GUIA')
                                <li>
                                    <a href="{{ url('guia-e-condutores/privado/perfil') }}" target="_blank"><i class="icon-user"></i> <span>Perfil</span></a>
                                </li>
                                <li>
                                    <a href="{{ url('guia-e-condutores/privado/atualizar-cadastro') }}"><i class="fa fa-edit"></i> <span>Editar Dados</span></a>
                                </li>
                                <li>
                                  <a href="{{ url('guia-e-condutores/privado/eventos') }}"><i class="fa fa-tags"></i> <span>Eventos</span></a>
                                </li>
                                <li>
                                  <a href="{{ url('guia-e-condutores/privado/trilhas') }}"><i class="fa fa-thumb-tack"></i> <span>Trilhas</span></a>
                                </li>
                            @endif
                            @if(trim(Auth::user()->id_role) == 'TRILHEIRO')
                                <li>
                                    <a href="{{ url('trilheiro/privado/perfil') }}"><i class="icon-user"></i> <span>Perfil</span></a>
                                </li>
                                <li>
                                    <a href="{{ url('trilheiro/privado/atualizar-cadastro') }}"><i class="fa fa-edit"></i> <span>Editar Dados</span></a>
                                </li>
                                <li>
                                    <a href="{{ url('trilheiro/privado/meu-nivel') }}"><i class="icon-speedometer"></i> <span>Meu Nível</span></a>
                                </li>
                                <li>
                                    <a href="{{ url('trilheiro/privado/trilhas') }}"><i class="fa fa-thumb-tack"></i> <span>Minhas Trilhas</span></a>
                                </li>
                                <li>
                                  <a href="{{ url('trilheiro/privado/eventos') }}"><i class="fa fa-tags"></i> <span>Meus Eventos</span></a>
                                </li>
                            @endif
                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="icon-logout"></i> <span>Sair</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>

                <div class="tab-pane p-l-15 p-r-15" id="Chat">
                    
                </div>

                <div class="tab-pane p-l-15 p-r-15" id="setting">
                    <h6>Plano de Fundo</h6>
                    <ul class="choose-skin list-unstyled">
                        <li data-theme="purple">
                            <div class="purple"></div>
                            <span>Purple</span>
                        </li>                   
                        <li data-theme="blue">
                            <div class="blue"></div>
                            <span>Blue</span>
                        </li>
                        <li data-theme="cyan" class="active">
                            <div class="cyan"></div>
                            <span>Cyan</span>
                        </li>
                        <li data-theme="green">
                            <div class="green"></div>
                            <span>Green</span>
                        </li>
                        <li data-theme="orange">
                            <div class="orange"></div>
                            <span>Orange</span>
                        </li>
                        <li data-theme="blush">
                            <div class="blush"></div>
                            <span>Blush</span>
                        </li>
                    </ul>
                </div>

                <div class="tab-pane p-l-15 p-r-15" id="question">
                    <form>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="icon-magnifier"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Buscar">
                        </div>
                    </form>
                </div>                
            </div>          
        </div>
    </div>

    <div id="main-content">
        <div class="container-fluid">
            @yield('content')
        </div>
    </div>
    
</div>
    <script src="{{ asset('vendor/jquery/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('bundles/libscripts.bundle.js') }}"></script>    
    <script src="{{ asset('bundles/vendorscripts.bundle.js') }}"></script>
        
    <script src="{{ asset('bundles/datatablescripts.bundle.js') }}"></script>
    <script src="{{ asset('vendor/jquery-datatable/buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-datatable/buttons/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-datatable/buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-datatable/buttons/buttons.print.min.js') }}"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.13.4/jquery.mask.min.js"></script>

    <script src="{{ asset('vendor/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
    <script src="{{ asset('vendor/parsleyjs/js/parsley.min.js') }}"></script>
    <script src="{{ asset('vendor/parsleyjs/js/il8n/pt-br.js') }}"></script>

    <script src="{{ asset('vendor/sweetalert/sweetalert.min.js') }}"></script> <!-- SweetAlert Plugin Js --> 

    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>

    <script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('vendor/dropify/js/dropify.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>

    <script src="{{ asset('bundles/mainscripts.bundle.js') }}"></script>
    <script src="{{ asset('js/pages/tables/jquery-datatable.js') }}"></script>
    <script src="{{ asset('js/pages/forms/dropify.js') }}"></script>
    
    <script>
        // Carrega CKEditor apenas se houver textarea com classe 'ckeditor'
        $(document).ready(function() {
            if ($('textarea.ckeditor').length > 0) {
                $.getScript("{{ asset('js/pages/forms/editors.js') }}");
            }
        });
    </script>
    
    <script src="{{ asset('js/jquery.maskMoney.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>

    <script>
        $(function() {
            // validation needs name of the element
            $('#food').multiselect();

            $('.select2').select2({  theme: "bootstrap" });

            $('.btn-filter').on('click', function () {
                var $target = $(this).data('target');
                if ($target != 'all') {
                    $('.table tr').css('display', 'none');
                    $('.table tr[data-status="none"]').fadeIn('slow');
                    $('.table tr[data-status="' + $target + '"]').fadeIn('slow');
                } else {
                    $('.table tr').css('display', 'none').fadeIn('slow');
                }
            });

            $(".btn-view-img").click(function(){
                img = $(this).data("url");
                $(".modal-body img").attr('src', img);
                $("#modal-img").modal('show');                
            });

        });
    </script>

    @yield('script')

</body>
</html>

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Trilhas em SC</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
 <meta name="description" content="Guia de trilhas e camping em Santa Catarina, trazendo informações de localização, trajetos e grau de dificuldade para quem quer conhecer e desfrutar das praias, serras e montanhas desse belo estado do Sul do Brasil"><meta name="author" content="">

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
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
<link rel="stylesheet" href="{{ asset('css/color_skins.css') }}">

<link rel="stylesheet" href="{{ asset('vendor/jquery-datatable/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" integrity="sha512-kq3FES+RuuGoBW3a9R2ELYKRywUEQv0wvPTItv3DSGqjpbNtGWVdvT8qwdKkqvPzT93jp8tSF4+oN4IeTEIlQA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="{{ asset('vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/sweetalert/sweetalert.css') }}"/>

</head>
<body class="theme-cyan">

    <!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="m-t-30"><img src="{{ asset('images/logo-icon.svg') }}" width="48" height="48" alt="Lucid"></div>
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
{{--                <a href="{{ url('/') }}"><img src="{{ asset('img/logo/logo_trilhas.png') }}" alt="Logo" class="img-responsive logo"></a>--}}
            </div>
            
            <div class="navbar-right">
{{--                <form id="navbar-search" class="navbar-form search-form">--}}
{{--                    <input value="" class="form-control" placeholder="Busca rápida" type="text">--}}
{{--                    <button type="button" class="btn btn-default"><i class="icon-magnifier"></i></button>--}}
{{--                </form>--}}

                <div id="navbar-menu">
                    <ul class="nav navbar-nav">
{{--                        <li>--}}
{{--                            <a href="{{ url('arquivos') }}" class="icon-menu d-none d-sm-block d-md-none d-lg-block"><i class="fa fa-folder-open-o"></i></a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="{{ url('agenda') }}" class="icon-menu d-none d-sm-block d-md-none d-lg-block"><i class="icon-calendar"></i></a>--}}
{{--                        </li>                     --}}
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="icon-menu"><i class="icon-logout"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div id="left-sidebar" class="sidebar">
        <div class="sidebar-scroll">
            <div class="user-account">
                <img src="{{ Auth::user()->dc_foto_perfil ? asset('img/guias/'.Auth::user()->dc_foto_perfil) : asset('images/user.png') }}" class="rounded-circle user-photo" alt="Foto de Perfil">
                <div class="dropdown">
                    <a href="javascript:void(0);" class="user-name" data-toggle="dropdown"><strong>{{ (Auth::user()) ? explode(' ', Auth::user()->name)[0] : "Não Logado" }}</strong></a>
{{--                    <a href="javascript:void(0);" class="dropdown-toggle user-name" data-toggle="dropdown"><strong>{{ (Auth::user()) ? explode(' ', Auth::user()->name)[0] : "Não Logado" }}</strong></a>--}}
{{--                    <ul class="dropdown-menu dropdown-menu-right account">--}}
{{--                        <li><a href="{{ url('usuario/perfil') }}"><i class="icon-user"></i>Meu Perfil</a></li>--}}
{{--                        <li class="divider"></li>--}}
{{--                        <li><a href="{{ route('logout') }}" onclick="event.preventDefault();--}}
{{--                          document.getElementById('logout-form').submit();"><i class="icon-power"></i>Sair</a></li>--}}
{{--                    </ul>--}}
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
                            @if(trim(Auth::user()->id_role) == 'ADMIN')
                                <li>
                                    <a href="{{ url('/') }}"><i class="icon-home"></i> <span>Início</span></a>
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
    <script src="{{ asset('vendor/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>

    <script src="{{ asset('vendor/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
    <script src="{{ asset('vendor/parsleyjs/js/parsley.min.js') }}"></script>
    <script src="{{ asset('vendor/parsleyjs/js/il8n/pt-br.js') }}"></script>

    <script src="{{ asset('vendor/sweetalert/sweetalert.min.js') }}"></script> <!-- SweetAlert Plugin Js --> 

    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>

    <script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('vendor/dropify/js/dropify.min.js') }}"></script>

    <script src="{{ asset('bundles/mainscripts.bundle.js') }}"></script>
    <script src="{{ asset('js/pages/tables/jquery-datatable.js') }}"></script>
    <script src="{{ asset('js/pages/forms/dropify.js') }}"></script>
    <script src="{{ asset('js/pages/forms/editors.js') }}"></script>
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

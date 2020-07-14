<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Trilhas em SC</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- favicon
        ============================================ -->        
        <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
        
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
        <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}">
        
        <!-- jquery-ui CSS
        ============================================ -->
        <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">
        
        <!-- meanmenu CSS
        ============================================ -->
        <link rel="stylesheet" href="{{ asset('css/meanmenu.min.css') }}">
        
        <!-- animate CSS
        ============================================ -->
        <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
        
        <!-- nivo slider CSS
        ============================================ -->
        <link rel="stylesheet" href="{{ asset('js/lib/nivo-slider/css/nivo-slider.css') }}" type="text/css" />
        <link rel="stylesheet" href="{{ asset('js/lib/nivo-slider/css/preview.css') }}" type="text/css" media="screen" />
        
        <!-- style CSS
        ============================================ -->
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        
        <!-- responsive CSS
        ============================================ -->
        <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
        
        <!-- modernizr JS
        ============================================ -->        
        <script src="{{ asset('js/vendor/modernizr-2.8.3.min.js') }}"></script>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        
        <!--Header Area Start-->
        <header>

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
                                            <nav>
                                                <ul id="nav">
                                                    <li class="drop-down"><a href="{{ url('/') }}">HOME</a></li>
                                                    <li><a href="{{ url('trilhas#lista') }}">TRILHAS</a></li>
                                                    <li><a href="{{ url('camping/buscar') }}">CAMPING</a></li>
                                                    <li><a href="{{ url('camping/buscar') }}">GUIA DE DIFICULDADE</a></li>
                                                    <li><a href="{{ url('trilhas/fauna-e-flora') }}">FAUNA E FLORA</a>
                                                    </li><li><a href="{{ url('contato') }}">CONTATO</a></li>
                                                </ul>
                                            </nav>
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
                                <nav id="dropdown">
                                    <ul>
                                        <li class="drop-down"><a href="{{ url('/') }}">HOME</a></li>
                                        <li><a href="{{ url('trilhas#lista') }}">TRILHAS</a></li>
                                        <li><a href="{{ url('camping/buscar') }}">CAMPING</a></li>
                                        <li><a href="{{ url('camping/buscar') }}">GUIA DE DIFICULDADE</a></li>
                                        <li><a href="{{ url('trilhas/fauna-e-flora') }}">FAUNA E FLORA</a>
                                        </li><li><a href="{{ url('contato') }}">CONTATO</a></li>
                                    </ul>
                                </nav>
                            </div>                  
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mobile Menu Area end -->
        </header>
        <!--End of Header Area-->
        <!--Slider Area Start-->
        <div class="banner-area blog-one">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title text-center">
                            <div class="title-border">
                                <h1>{{ !empty($titulo) ? $titulo : 'Trilhas' }}</h1>
                            </div>    
                            <p class="text-white">{{ !empty($subtitulo) ? $subtitulo : 'Em Santa Catarina' }}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <ul class="breadcrumb">
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li>TRILHAS</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!--End of Slider Area-->
       
        @yield('content')

        <!--Footer Widget Area Start-->
        @include('trilhas.componentes.footer')
        <!--End of Footer Area-->
        
        
        <!-- jquery
        ============================================ -->        
        <script src="{{ asset('js/vendor/jquery-1.12.3.min.js') }}"></script>
        
        <!-- bootstrap JS
        ============================================ -->        
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        
        <!-- nivo slider js
        ============================================ -->       
        <script src="{{ asset('js/lib/nivo-slider/js/jquery.nivo.slider.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/lib/nivo-slider/home.js') }}" type="text/javascript"></script>
        
        <!-- wow JS
        ============================================ -->        
        <script src="{{ asset('js/wow.min.js') }}"></script>
        
        <!-- meanmenu JS
        ============================================ -->        
        <script src="{{ asset('js/jquery.meanmenu.js') }}"></script>
        
        <!-- owl.carousel JS
        ============================================ -->        
        <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
        
        <!-- price-slider JS
        ============================================ -->        
        <script src="{{ asset('js/jquery-price-slider.js') }}"></script>
        
        <!-- scrollUp JS
        ============================================ -->        
        <script src="{{ asset('js/jquery.scrollUp.min.js') }}"></script>
        
        <!-- Waypoints JS
        ============================================ -->        
        <script src="{{ asset('js/waypoints.min.js') }}"></script>
        
        <!-- Counter Up JS
        ============================================ -->        
        <script src="{{ asset('js/jquery.counterup.min.js') }}"></script>
        
        <!-- plugins JS
        ============================================ -->        
        <script src="{{ asset('js/plugins.js') }}"></script>
        
        <!-- main JS
        ============================================ -->        
        <script src="{{ asset('js/main.js') }}"></script>
    </body>
</html>
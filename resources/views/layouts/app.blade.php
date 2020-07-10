<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Trilhas em SC</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
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
              <div class="header-top">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 hidden-xs">
                            
                        </div>
                        <div class="col-md-8 col-sm-6 col-xs-12">
                            <div class="header-top-right">
                                @guest
                                    <div class="login">
                                        <a href="{{ route('register') }}"><i class="fa fa-pencil-square-o"></i>Cadastre-se</a>
                                    </div>
                                    <div class="account">
                                        <a href="{{ route('login') }}"><i class="fa fa-lock"></i>Acesse</a>
                                    </div>
                                    <ul class="header-r-cart">
                                        <li><a href="#" class="cart"><span>Olá Visitante!</span></a>
                                            
                                        </li>
                                    </ul>
                                @else
                                    <div class="login">
                                        <a href="{{ route('logout') }}" 
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="fa fa-pencil-square-o"></i>Sair
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                    <ul class="header-r-cart">
                                        <li><a href="#" class="cart"><span>{{ Auth::user()->name }}</span></a>
                                            
                                        </li>
                                    </ul>
                                @endguest
                            </div>    
                        </div>
                    </div>
                </div>
            </div> 
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
                                                    <li><a href="{{ url('trilhas/#lista') }}">TRILHAS</a></li>
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
        <div class="slider-area">
            <div class="preview-2">
                <div id="nivoslider" class="slides">    
                    <a href="#"><img src="{{ asset('img/slider/slider-1.jpg') }}" alt="" title="#slider-1-caption1"/></a>
                    <a href="#"><img src="{{ asset('img/slider/slider-2.jpg') }}" alt="" title="#slider-1-caption1"/></a>
                </div> 
                <div id="slider-1-caption1" class="nivo-html-caption nivo-caption">
                    <div class="banner-content slider-1">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="text-content">
                                        <h1 class="title1">GUIA DE TRILHAS</h1>
                                        <h2 class="sub-title">AS MELHORES TRILHAS DE SANTA CATARINA</h2>
                                        <h2 class="sub-title">VOCÊ ENCONTRA <span>AQUI</span></h2>
                                        <form action="{{url('trilhas/#lista')}}" method="GET" id="banner-searchbox" class="hidden-xs">
                                            <div class="adventure-cat">
                                                <select name="cidade" class="search-adventure">
                                                    <option selected value="">Selecione a Cidade</option>
                                                    @foreach($cidades as $cidade)
                                                    <option {{ old('cidade') == $cidade->cd_cidade_cde ? 'selected': ''}} value="{{$cidade->cd_cidade_cde}}">{{$cidade->nm_cidade_cde}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="adventure-cat destination">
                                                <select name="nivel" class="search-adventure">
                                                    <option selected value="">Selecione o Nível</option>
                                                    @foreach($niveis as $nivel)
                                                    <option {{ old('nivel') == $nivel->id_nivel_niv ? 'selected': ''}} value="{{$nivel->id_nivel_niv}}">{{$nivel->dc_nivel_niv}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="clearfix"></div>
                                            <button type="submit" id="btn-search-category">Buscar Aventura</button>
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
        <div class="footer-widget-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-4">
                        <div class="single-footer-widget contact-text-info">
                            <h4>Contact Us</h4>
                            <div class="footer-widget-list">
                                <ul>
                                    <li class="icon send">19 Charlotte Street, Toronto Ontario, M5V 2H5</li>
                                    <li class="icon envelope">admin@power-boosts.com</li>
                                    <li class="icon phone">+ 001 666 8989 55</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 hidden-sm">
                        <div class="single-footer-widget">
                            <h4>About Us</h4>
                            <div class="footer-widget-list">
                                <ul class="widget-lists">
                                    <li><a href="#">Why Us</a></li>
                                    <li><a href="#">Our trips</a></li>
                                    <li><a href="#">Responsible Business</a></li>
                                    <li><a href="#">Our History</a></li>
                                    <li><a href="#">Our Core Values</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 hidden-md hidden-sm">
                        <div class="single-footer-widget">
                            <h4>Design Themes</h4>
                            <div class="footer-widget-list">
                                <ul class="widget-lists">
                                    <li><a href="#">Africa</a></li>
                                    <li><a href="#">Asia</a></li>
                                    <li><a href="#">Central America</a></li>
                                    <li><a href="#">Europe</a></li>
                                    <li><a href="#">Middle East</a></li>
                                    <li><a href="#">North America</a></li>
                                    <li><a href="#">Oceania</a></li>
                                    <li><a href="#">South America</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-3">
                        <div class="single-footer-widget">
                            <h4>Destinations</h4>
                            <div class="footer-widget-list">
                                <ul class="widget-lists">
                                    <li><a href="#">Adventure</a></li>
                                    <li><a href="#">Hiking and Camping</a></li>
                                    <li><a href="#">Walking and Trekking</a></li>
                                    <li><a href="#">Safari Trip</a></li>
                                    <li><a href="#">Polar</a></li>
                                    <li><a href="#">Sailing</a></li>
                                    <li><a href="#">Climbing</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-5">
                        <div class="single-footer-widget">
                            <h4>Latest Tweets</h4>
                            <div class="footer-widget-list twitter-news">
                                <ul>
                                    <li><a href="#">@Power-Boosts</a> Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremq-ue laudantium. <a href="#">Power-Boosts.com/building-a-website</a></li>
                                    <li><a href="#">@Power-Boosts</a> Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremq-ue laudantium. <a href="#">Power-Boosts.com/building-a-website</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="footer-link">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-google-plus"></i></a>
                            <a href="#"><i class="fa fa-linkedin"></i></a>
                            <a href="#"><i class="fa fa-rss"></i></a>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="payment-image">
                            <img src="img/payment.png" alt="">
                        </div>    
                    </div>
                </div>
            </div>
        </div>
        <!--End of Footer Widget Area-->
        <!--Footer Area Start-->
        <div class="footer-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-5 col-sm-12">
                        <span>Copyright © 2016 <a href="#">Power-Boosts</a>. All rights reserved.</span>
                    </div>
                    <div class="col-lg-8 col-md-7 col-sm-12">
                        <nav>
                            <ul id="footer-menu">
                                <li><a href="index.html">Home</a></li>
                                <li><a href="shop-grid-no-sidebar.html">Destinations</a></li>
                                <li><a href="shop-grid-no-sidebar.html">Travel Styles</a></li>
                                <li><a href="shop-grid-no-sidebar.html">Specials</a></li>
                                <li><a href="blog-1.html">Blog</a></li>
                                <li><a href="contact.html">Contact Us</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
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
</html>v
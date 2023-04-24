<!doctype html>
<html class="no-js" lang="pt-br">
    <head>
        @env('production')
        <!-- Global site tag (gtag.js) - Google Analytics -->
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
        <meta name="description" content="@yield('description')">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
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

        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
        
        <!-- responsive CSS
        ============================================ -->
        {!! Minify::stylesheet('/css/responsive.css')->withFullUrl() !!}
        {!! htmlScriptTagJsApi() !!}
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
                            <li>{{ (isset($page_name)) ? $page_name : "Trilhas" }}</li>
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
         <!-- modernizr JS
        ============================================ -->        
        <script src="{{ asset('js/vendor/modernizr-2.8.3.min.js') }}"></script>
        
        <!-- jquery
        ============================================ -->        
        <script src="{{ asset('js/vendor/jquery-1.12.3.min.js') }}"></script>
        
        <!-- bootstrap JS
        ============================================ -->        
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        
        <!-- nivo slider js
        ============================================ -->
        <script src="{{ asset('js/lib/nivo-slider/js/jquery.nivo.slider.js') }}"></script>
        <script src="{{ asset('js/lib/nivo-slider/home.js') }}"></script>
        
        <!-- wow JS
        ============================================ -->        
        <script src="{{ asset('js/wow.min.js') }}"></script>
        
        <!-- meanmenu JS
        ============================================ -->        
        {!! Minify::javascript('/js/jquery.meanmenu.js')->withFullUrl() !!} 
        
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

        <!-- Custom
        ============================================ -->        
        <script src="{{ asset('js/custom.js') }}"></script>

        @yield('script')

        <div id="fb-root"></div>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v8.0&appId=324298075280409&autoLogAppEvents=1" nonce="AkrnpMg1"></script>
    </body>
</html>
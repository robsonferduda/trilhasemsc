<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex,nofollow">
    <title>@yield('pageTitle', 'Área administrativa | Trilhas em SC')</title>
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/apple-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon/favicon-16x16.png') }}">
    <link href="{{ asset('css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/nucleo-svg.css') }}" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700,200|Open+Sans+Condensed:700" rel="stylesheet">
    <link id="pagestyle" href="{{ asset('css/template.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}?v={{ date('YmdHis') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin-compat.css') }}?v={{ date('YmdHis') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="help-center admin-area">
    @php
        $primeiroNome = Auth::user() ? explode(' ', Auth::user()->name)[0] : '';
    @endphp
    <nav class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3 navbar-transparent">
        <div class="container">
            <button class="navbar-toggler shadow-none ms-md-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Abrir menu">
                <span class="navbar-toggler-icon mt-2">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                </span>
            </button>
            <div class="collapse navbar-collapse w-100 pt-3 pb-2 py-lg-0" id="navigation">
                <ul class="navbar-nav navbar-nav-hover mx-auto">
                    <li class="nav-item mx-2">
                        <a href="{{ url('admin/dashboard') }}" class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center {{ request()->is('admin/dashboard') ? 'is-active' : '' }}">Início</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a href="{{ url('admin/listar-trilhas') }}" class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center {{ request()->is('admin/listar-trilhas', 'admin/nova-trilha', 'admin/editar-trilha/*', 'admin/detalhes-trilha/*') ? 'is-active' : '' }}">Trilhas</a>
                    </li>
                    <li class="nav-item dropdown dropdown-hover mx-2">
                        <a href="#" class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center {{ request()->is('admin/guias*') ? 'is-active' : '' }}" data-bs-toggle="dropdown" aria-expanded="false">
                            Guias
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item {{ request()->is('admin/guias', 'admin/guias/listar') ? 'is-active' : '' }}" href="{{ url('admin/guias/listar') }}">Listar</a></li>
                            <li><a class="dropdown-item {{ request()->is('admin/guias/aprovar') ? 'is-active' : '' }}" href="{{ url('admin/guias/aprovar') }}">Pendentes</a></li>
                        </ul>
                    </li>
                    <li class="nav-item mx-2">
                        <a href="{{ url('admin/trilheiros/listar') }}" class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center {{ request()->is('admin/trilheiros*', 'admin/trilheiro/*') ? 'is-active' : '' }}">Trilheiros</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a href="{{ url('admin/eventos/listar') }}" class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center {{ request()->is('admin/eventos*') ? 'is-active' : '' }}">Eventos</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a href="{{ route('admin.instagram.metricas') }}" class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center {{ request()->is('admin/instagram*') ? 'is-active' : '' }}">Instagram</a>
                    </li>
                </ul>
                <ul class="navbar-nav d-lg-block">
                    <li class="nav-item">
                        <a href="{{ url('/') }}" class="btn btn-sm bg-gradient-warning btn-round mb-0 me-1">VER O SITE</a>
                        <a href="{{ url('logout') }}" class="btn btn-sm bg-gradient-danger btn-round mb-0 me-1" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">SAIR</a>
                    </li>
                </ul>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </nav>

    <div class="page-header min-vh-35" style="background-image: url('{{ asset('img/bg/lagoinha-do-leste.jpg') }}');">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-sm-10 text-center mx-auto">
                    <h2 class="text-white mb-2">@yield('adminTitle', 'Área administrativa')</h2>
                    <p class="lead text-white mb-0">@yield('adminLead', $primeiroNome ? 'Olá, '.$primeiroNome : 'Trilhas em Santa Catarina')</p>
                </div>
            </div>
        </div>
    </div>

    <section class="admin-content pt-5 pb-5">
        <div class="container-fluid px-lg-5">
            @yield('content')
        </div>
    </section>

    <footer class="footer py-5 bg-dark position-relative overflow-hidden">
        <div class="container position-relative z-index-1">
            <div class="row">
                <div class="col-lg-6 me-auto mb-lg-0 mb-4 text-lg-start text-start">
                    <h6 class="text-white font-weight-bolder text-uppercase mb-lg-4 mb-3">Trilhas em SC</h6>
                    <ul class="nav flex-row ms-n3 justify-content-lg-start justify-content-start mb-4 mt-sm-0">
                        <li class="nav-item"><a class="nav-link text-white opacity-8" href="{{ url('/') }}">Site</a></li>
                        <li class="nav-item"><a class="nav-link text-white opacity-8" href="{{ url('admin/dashboard') }}">Administração</a></li>
                    </ul>
                </div>
                <div class="col-lg-6 ms-auto text-lg-end text-start">
                    <p class="mb-0 text-lg text-white font-weight-bold">Área administrativa</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('vendor/jquery/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('vendor/parsleyjs/js/parsley.min.js') }}"></script>
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <script>
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });

        if (window.jQuery && window.bootstrap && !$.fn.modal) {
            $.fn.modal = function (action) {
                return this.each(function () {
                    var instance = bootstrap.Modal.getOrCreateInstance(this);
                    if (action === 'show') instance.show();
                    else if (action === 'hide') instance.hide();
                    else if (action === 'toggle') instance.toggle();
                });
            };
        }

        $(function () {
            $(document).on('click', '[data-dismiss="modal"]', function () {
                var modal = this.closest('.modal');
                if (modal && window.bootstrap) {
                    bootstrap.Modal.getOrCreateInstance(modal).hide();
                }
            });

            $(document).on('click', '[data-dismiss="alert"]', function () {
                $(this).closest('.alert').remove();
            });

            if ($.fn.select2) {
                $('.select2').select2({ width: '100%' });
            }

            $('.btn-view-img').on('click', function () {
                var img = $(this).data('url');
                $('#modal-img .modal-body img').attr('src', img);
                $('#modal-img').modal('show');
            });

            if ($('textarea.ckeditor').length) {
                $.getScript("{{ asset('vendor/ckeditor/ckeditor.js') }}", function () {
                    $.getScript("{{ asset('js/pages/forms/editors.js') }}");
                });
            }
        });
    </script>
    @yield('script')
</body>
</html>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex,nofollow">
    <title>@yield('pageTitle', 'Área administrativa | Trilhas em SC')</title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon/favicon-32x32.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin-power.css') }}?v={{ date('YmdHis') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="pa-admin">
@php
    $primeiroNome = Auth::user() ? explode(' ', trim(Auth::user()->name))[0] : 'Admin';
    $inicial = mb_strtoupper(mb_substr($primeiroNome, 0, 1));
    $secao = 'painel';
    if (request()->is('admin/listar-trilhas', 'admin/nova-trilha', 'admin/editar-trilha/*', 'admin/detalhes-trilha/*')) {
        $secao = 'trilhas';
    } elseif (request()->is('admin/guias*', 'admin/trilheiros*', 'admin/trilheiro/*')) {
        $secao = 'pessoas';
    } elseif (request()->is('admin/eventos*')) {
        $secao = 'eventos';
    } elseif (request()->is('admin/instagram*')) {
        $secao = 'instagram';
    }
@endphp

    <aside class="pa-sidebar" id="pa-sidebar">
        <div class="pa-strip">
            <a href="{{ url('admin/dashboard') }}" class="pa-logo" title="Trilhas em SC">
                <i class="bi bi-lightning-charge-fill"></i>
            </a>
            <nav class="pa-strip-nav">
                <button type="button" class="pa-strip-item {{ $secao === 'painel' ? 'is-active' : '' }}" data-panel="painel" title="Painel"><i class="bi bi-grid"></i></button>
                <button type="button" class="pa-strip-item {{ $secao === 'trilhas' ? 'is-active' : '' }}" data-panel="trilhas" title="Trilhas"><i class="bi bi-signpost-2"></i></button>
                <button type="button" class="pa-strip-item {{ $secao === 'pessoas' ? 'is-active' : '' }}" data-panel="pessoas" title="Pessoas"><i class="bi bi-people"></i></button>
                <button type="button" class="pa-strip-item {{ $secao === 'eventos' ? 'is-active' : '' }}" data-panel="eventos" title="Eventos"><i class="bi bi-calendar-event"></i></button>
                <button type="button" class="pa-strip-item {{ $secao === 'instagram' ? 'is-active' : '' }}" data-panel="instagram" title="Instagram"><i class="bi bi-instagram"></i></button>
            </nav>
            <div class="pa-strip-bottom">
                <a href="{{ url('/') }}" class="pa-strip-item" title="Ver o site"><i class="bi bi-globe"></i></a>
                <a href="{{ url('logout') }}" class="pa-strip-item" title="Sair" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="bi bi-box-arrow-right"></i></a>
            </div>
        </div>

        <div class="pa-panel">
            <div class="pa-panel-section {{ $secao === 'painel' ? 'is-active' : '' }}" data-section="painel">
                <div class="pa-panel-header">
                    <h6>Painel</h6>
                    <button type="button" class="pa-panel-close" title="Recolher"><i class="bi bi-x-lg"></i></button>
                </div>
                <ul class="pa-panel-nav">
                    <li><a class="pa-panel-link {{ request()->is('admin/dashboard') ? 'is-active' : '' }}" href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                </ul>
            </div>
            <div class="pa-panel-section {{ $secao === 'trilhas' ? 'is-active' : '' }}" data-section="trilhas">
                <div class="pa-panel-header">
                    <h6>Trilhas</h6>
                    <button type="button" class="pa-panel-close" title="Recolher"><i class="bi bi-x-lg"></i></button>
                </div>
                <ul class="pa-panel-nav">
                    <li><a class="pa-panel-link {{ request()->is('admin/listar-trilhas', 'admin/detalhes-trilha/*') ? 'is-active' : '' }}" href="{{ url('admin/listar-trilhas') }}">Listar</a></li>
                    <li><a class="pa-panel-link {{ request()->is('admin/nova-trilha') ? 'is-active' : '' }}" href="{{ url('admin/nova-trilha') }}">Nova trilha</a></li>
                </ul>
            </div>
            <div class="pa-panel-section {{ $secao === 'pessoas' ? 'is-active' : '' }}" data-section="pessoas">
                <div class="pa-panel-header">
                    <h6>Pessoas</h6>
                    <button type="button" class="pa-panel-close" title="Recolher"><i class="bi bi-x-lg"></i></button>
                </div>
                <ul class="pa-panel-nav">
                    <li><a class="pa-panel-link {{ request()->is('admin/guias', 'admin/guias/listar') ? 'is-active' : '' }}" href="{{ url('admin/guias/listar') }}">Guias</a></li>
                    <li><a class="pa-panel-link {{ request()->is('admin/guias/aprovar') ? 'is-active' : '' }}" href="{{ url('admin/guias/aprovar') }}">Guias pendentes</a></li>
                    <li><a class="pa-panel-link {{ request()->is('admin/trilheiros*', 'admin/trilheiro/*') ? 'is-active' : '' }}" href="{{ url('admin/trilheiros/listar') }}">Trilheiros</a></li>
                </ul>
            </div>
            <div class="pa-panel-section {{ $secao === 'eventos' ? 'is-active' : '' }}" data-section="eventos">
                <div class="pa-panel-header">
                    <h6>Eventos</h6>
                    <button type="button" class="pa-panel-close" title="Recolher"><i class="bi bi-x-lg"></i></button>
                </div>
                <ul class="pa-panel-nav">
                    <li><a class="pa-panel-link {{ request()->is('admin/eventos*') ? 'is-active' : '' }}" href="{{ url('admin/eventos/listar') }}">Listar</a></li>
                </ul>
            </div>
            <div class="pa-panel-section {{ $secao === 'instagram' ? 'is-active' : '' }}" data-section="instagram">
                <div class="pa-panel-header">
                    <h6>Instagram</h6>
                    <button type="button" class="pa-panel-close" title="Recolher"><i class="bi bi-x-lg"></i></button>
                </div>
                <ul class="pa-panel-nav">
                    <li><a class="pa-panel-link {{ request()->is('admin/instagram*') ? 'is-active' : '' }}" href="{{ route('admin.instagram.metricas') }}">Métricas</a></li>
                </ul>
            </div>
        </div>
    </aside>
    <div class="pa-overlay" id="pa-overlay"></div>

    <header class="pa-header">
        <button type="button" class="pa-icon-btn" id="pa-toggle" title="Menu">
            <i class="bi bi-list"></i>
        </button>
        <div class="dropdown">
            <button class="pa-icon-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false" title="Atalhos">
                <i class="bi bi-grid-3x3-gap"></i>
            </button>
            <div class="dropdown-menu pa-menu">
                <div class="pa-apps">
                    <a class="pa-app" href="{{ url('admin/dashboard') }}"><i class="bi bi-grid"></i>Painel</a>
                    <a class="pa-app" href="{{ url('admin/listar-trilhas') }}"><i class="bi bi-signpost-2"></i>Trilhas</a>
                    <a class="pa-app" href="{{ url('admin/guias/listar') }}"><i class="bi bi-person-badge"></i>Guias</a>
                    <a class="pa-app" href="{{ url('admin/trilheiros/listar') }}"><i class="bi bi-people"></i>Trilheiros</a>
                    <a class="pa-app" href="{{ url('admin/eventos/listar') }}"><i class="bi bi-calendar-event"></i>Eventos</a>
                    <a class="pa-app" href="{{ route('admin.instagram.metricas') }}"><i class="bi bi-instagram"></i>Instagram</a>
                </div>
            </div>
        </div>

        <form class="pa-search" method="GET" action="{{ url('admin/listar-trilhas') }}">
            <i class="bi bi-search"></i>
            <input type="search" name="nome" placeholder="Buscar trilha..." value="{{ request()->is('admin/listar-trilhas') ? request('nome') : '' }}" autocomplete="off">
            <kbd>/</kbd>
        </form>

        <div class="pa-header-right">
            <a href="{{ url('/') }}" class="pa-icon-btn d-none d-md-inline-flex" title="Ver o site"><i class="bi bi-box-arrow-up-right"></i></a>
            <div class="dropdown">
                <button class="pa-user-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="pa-avatar">{{ $inicial }}</span>
                    <span class="pa-user-meta">
                        <span class="pa-user-name">{{ $primeiroNome }}</span>
                        <span class="pa-user-role">Administrador</span>
                    </span>
                    <i class="bi bi-chevron-down pa-user-meta"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end pa-menu">
                    <li><a class="dropdown-item" href="{{ url('/') }}"><i class="bi bi-globe me-2"></i>Ver o site</a></li>
                    <li><a class="dropdown-item" href="{{ url('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="bi bi-box-arrow-right me-2"></i>Sair</a></li>
                </ul>
            </div>
        </div>
    </header>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <main class="pa-main">
        @yield('content')
    </main>

    <script src="{{ asset('vendor/jquery/jquery-3.3.1.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('vendor/parsleyjs/js/parsley.min.js') }}"></script>
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

        (function () {
            var body = document.body;
            var desktop = function () { return window.innerWidth >= 992; };

            if (desktop() && localStorage.getItem('pa-sidebar') === 'collapsed') {
                body.classList.add('pa-collapsed');
            }

            function showPanel(name) {
                document.querySelectorAll('.pa-strip-item[data-panel]').forEach(function (item) {
                    item.classList.toggle('is-active', item.getAttribute('data-panel') === name);
                });
                document.querySelectorAll('.pa-panel-section').forEach(function (section) {
                    section.classList.toggle('is-active', section.getAttribute('data-section') === name);
                });
            }

            document.getElementById('pa-toggle').addEventListener('click', function () {
                if (desktop()) {
                    body.classList.toggle('pa-collapsed');
                    localStorage.setItem('pa-sidebar', body.classList.contains('pa-collapsed') ? 'collapsed' : 'open');
                } else {
                    body.classList.toggle('pa-sidebar-open');
                }
            });

            document.getElementById('pa-overlay').addEventListener('click', function () {
                body.classList.remove('pa-sidebar-open');
            });

            document.querySelectorAll('.pa-strip-item[data-panel]').forEach(function (item) {
                item.addEventListener('click', function () {
                    showPanel(item.getAttribute('data-panel'));
                    if (desktop() && body.classList.contains('pa-collapsed')) {
                        body.classList.remove('pa-collapsed');
                        localStorage.setItem('pa-sidebar', 'open');
                    }
                });
            });

            document.querySelectorAll('.pa-panel-close').forEach(function (button) {
                button.addEventListener('click', function () {
                    if (desktop()) {
                        body.classList.add('pa-collapsed');
                        localStorage.setItem('pa-sidebar', 'collapsed');
                    } else {
                        body.classList.remove('pa-sidebar-open');
                    }
                });
            });

            document.addEventListener('keydown', function (event) {
                if (event.key === '/' && document.activeElement && !/input|textarea|select/i.test(document.activeElement.tagName)) {
                    var field = document.querySelector('.pa-search input');
                    if (field) {
                        event.preventDefault();
                        field.focus();
                    }
                }
            });
        })();

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

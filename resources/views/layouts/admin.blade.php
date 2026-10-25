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
    <link rel="stylesheet" href="{{ asset('vendor/dropify/css/dropify.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin-power.css') }}?v={{ date('YmdHis') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="pa-admin">
@php
    $primeiroNome = Auth::user() ? explode(' ', trim(Auth::user()->name))[0] : 'Admin';
    $inicial = mb_strtoupper(mb_substr($primeiroNome, 0, 1));
    $papel = Auth::user() ? trim(Auth::user()->id_role) : '';
    $papelLabel = $papel === 'TRILHEIRO' ? 'Trilheiro' : ($papel === 'GUIA' ? 'Guia' : 'Administrador');
@endphp

    <aside class="pa-sidebar" id="pa-sidebar">
        <a href="{{ $papel === 'TRILHEIRO' ? url('trilheiro/privado/perfil') : ($papel === 'GUIA' ? url('guia-e-condutores/privado/painel') : url('admin/dashboard')) }}" class="pa-brand">
            <span class="pa-logo"><i class="bi bi-lightning-charge-fill"></i></span>
            <span class="pa-brand-text">Trilhas em SC</span>
        </a>
        <nav class="pa-nav">
            @if($papel === 'TRILHEIRO')
                <p class="pa-nav-label">Minha conta</p>
                <a class="pa-nav-link {{ request()->is('trilheiro/privado/perfil') ? 'is-active' : '' }}" href="{{ url('trilheiro/privado/perfil') }}">
                    <i class="bi bi-person"></i><span>Meu perfil</span>
                </a>
                <a class="pa-nav-link {{ request()->is('trilheiro/privado/atualizar-cadastro') ? 'is-active' : '' }}" href="{{ url('trilheiro/privado/atualizar-cadastro') }}">
                    <i class="bi bi-pencil"></i><span>Editar dados</span>
                </a>
                <a class="pa-nav-link {{ request()->is('trilheiro/privado/meu-nivel') ? 'is-active' : '' }}" href="{{ url('trilheiro/privado/meu-nivel') }}">
                    <i class="bi bi-speedometer2"></i><span>Meu nível</span>
                </a>
                <a class="pa-nav-link {{ request()->is('trilheiro/privado/trilhas') ? 'is-active' : '' }}" href="{{ url('trilheiro/privado/trilhas') }}">
                    <i class="bi bi-map"></i><span>Minhas trilhas</span>
                </a>
                <a class="pa-nav-link {{ request()->is('trilheiro/privado/eventos*') ? 'is-active' : '' }}" href="{{ url('trilheiro/privado/eventos') }}">
                    <i class="bi bi-calendar-event"></i><span>Meus eventos</span>
                </a>
            @elseif($papel === 'GUIA')
                <p class="pa-nav-label">Painel</p>
                <a class="pa-nav-link {{ request()->is('guia-e-condutores/privado/painel') ? 'is-active' : '' }}" href="{{ url('guia-e-condutores/privado/painel') }}">
                    <i class="bi bi-speedometer2"></i><span>Início</span>
                </a>
                <p class="pa-nav-label">Eventos</p>
                <a class="pa-nav-link {{ request()->is('guia-e-condutores/privado/evento*') ? 'is-active' : '' }}" href="{{ url('guia-e-condutores/privado/eventos') }}">
                    <i class="bi bi-calendar-event"></i><span>Meus eventos</span>
                </a>
                <p class="pa-nav-label">Presença</p>
                <a class="pa-nav-link {{ request()->is('guia-e-condutores/privado/perfil') ? 'is-active' : '' }}" href="{{ url('guia-e-condutores/privado/perfil') }}">
                    <i class="bi bi-person"></i><span>Perfil público</span>
                </a>
                <a class="pa-nav-link {{ request()->is('guia-e-condutores/privado/trilhas') ? 'is-active' : '' }}" href="{{ url('guia-e-condutores/privado/trilhas') }}">
                    <i class="bi bi-map"></i><span>Trilhas</span>
                </a>
                <a class="pa-nav-link {{ request()->is('guia-e-condutores/privado/estatisticas') ? 'is-active' : '' }}" href="{{ url('guia-e-condutores/privado/estatisticas') }}">
                    <i class="bi bi-bar-chart"></i><span>Estatísticas</span>
                </a>
                <p class="pa-nav-label">Conta</p>
                <a class="pa-nav-link {{ request()->is('guia-e-condutores/privado/atualizar-cadastro') ? 'is-active' : '' }}" href="{{ url('guia-e-condutores/privado/atualizar-cadastro') }}">
                    <i class="bi bi-pencil"></i><span>Meus dados</span>
                </a>
            @else
                <p class="pa-nav-label">Painel</p>
                <a class="pa-nav-link {{ request()->is('admin/dashboard') ? 'is-active' : '' }}" href="{{ url('admin/dashboard') }}">
                    <i class="bi bi-speedometer2"></i><span>Dashboard</span>
                </a>

                <p class="pa-nav-label">Conteúdo</p>
                <a class="pa-nav-link {{ request()->is('admin/listar-trilhas', 'admin/editar-trilha/*', 'admin/detalhes-trilha/*') ? 'is-active' : '' }}" href="{{ url('admin/listar-trilhas') }}">
                    <i class="bi bi-map"></i><span>Trilhas</span>
                </a>
                <a class="pa-nav-link {{ request()->is('admin/nova-trilha') ? 'is-active' : '' }}" href="{{ url('admin/nova-trilha') }}">
                    <i class="bi bi-plus-circle"></i><span>Nova trilha</span>
                </a>
                <a class="pa-nav-link {{ request()->is('admin/eventos*') ? 'is-active' : '' }}" href="{{ url('admin/eventos/listar') }}">
                    <i class="bi bi-calendar-event"></i><span>Eventos</span>
                </a>
                <a class="pa-nav-link {{ request()->is('admin/instagram*') ? 'is-active' : '' }}" href="{{ route('admin.instagram.metricas') }}">
                    <i class="bi bi-instagram"></i><span>Instagram</span>
                </a>

                <p class="pa-nav-label">Pessoas</p>
                <a class="pa-nav-link {{ request()->is('admin/guias', 'admin/guias/listar') ? 'is-active' : '' }}" href="{{ url('admin/guias/listar') }}">
                    <i class="bi bi-person-badge"></i><span>Guias</span>
                </a>
                <a class="pa-nav-link {{ request()->is('admin/guias/aprovar') ? 'is-active' : '' }}" href="{{ url('admin/guias/aprovar') }}">
                    <i class="bi bi-hourglass-split"></i><span>Guias pendentes</span>
                </a>
                <a class="pa-nav-link {{ request()->is('admin/trilheiros*', 'admin/trilheiro/*') ? 'is-active' : '' }}" href="{{ url('admin/trilheiros/listar') }}">
                    <i class="bi bi-people"></i><span>Trilheiros</span>
                </a>
            @endif
        </nav>
        <div class="pa-nav-bottom">
            <a class="pa-nav-link" href="{{ url('/') }}">
                <i class="bi bi-globe"></i><span>Ver o site</span>
            </a>
            <a class="pa-nav-link" href="{{ url('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right"></i><span>Sair</span>
            </a>
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
                    @if($papel === 'TRILHEIRO')
                        <a class="pa-app" href="{{ url('trilheiro/privado/perfil') }}"><i class="bi bi-person"></i>Perfil</a>
                        <a class="pa-app" href="{{ url('trilheiro/privado/atualizar-cadastro') }}"><i class="bi bi-pencil"></i>Dados</a>
                        <a class="pa-app" href="{{ url('trilheiro/privado/meu-nivel') }}"><i class="bi bi-speedometer2"></i>Nível</a>
                        <a class="pa-app" href="{{ url('trilheiro/privado/trilhas') }}"><i class="bi bi-map"></i>Trilhas</a>
                        <a class="pa-app" href="{{ url('trilheiro/privado/eventos') }}"><i class="bi bi-calendar-event"></i>Eventos</a>
                        <a class="pa-app" href="{{ url('/') }}"><i class="bi bi-globe"></i>Site</a>
                    @elseif($papel === 'GUIA')
                        <a class="pa-app" href="{{ url('guia-e-condutores/privado/painel') }}"><i class="bi bi-speedometer2"></i>Início</a>
                        <a class="pa-app" href="{{ url('guia-e-condutores/privado/eventos') }}"><i class="bi bi-calendar-event"></i>Eventos</a>
                        <a class="pa-app" href="{{ url('guia-e-condutores/privado/perfil') }}"><i class="bi bi-person"></i>Perfil</a>
                        <a class="pa-app" href="{{ url('guia-e-condutores/privado/trilhas') }}"><i class="bi bi-map"></i>Trilhas</a>
                        <a class="pa-app" href="{{ url('guia-e-condutores/privado/estatisticas') }}"><i class="bi bi-bar-chart"></i>Estatísticas</a>
                        <a class="pa-app" href="{{ url('guia-e-condutores/privado/atualizar-cadastro') }}"><i class="bi bi-pencil"></i>Dados</a>
                        <a class="pa-app" href="{{ url('/') }}"><i class="bi bi-globe"></i>Site</a>
                    @else
                        <a class="pa-app" href="{{ url('admin/dashboard') }}"><i class="bi bi-grid"></i>Painel</a>
                        <a class="pa-app" href="{{ url('admin/listar-trilhas') }}"><i class="bi bi-signpost-2"></i>Trilhas</a>
                        <a class="pa-app" href="{{ url('admin/guias/listar') }}"><i class="bi bi-person-badge"></i>Guias</a>
                        <a class="pa-app" href="{{ url('admin/trilheiros/listar') }}"><i class="bi bi-people"></i>Trilheiros</a>
                        <a class="pa-app" href="{{ url('admin/eventos/listar') }}"><i class="bi bi-calendar-event"></i>Eventos</a>
                        <a class="pa-app" href="{{ route('admin.instagram.metricas') }}"><i class="bi bi-instagram"></i>Instagram</a>
                    @endif
                </div>
            </div>
        </div>

        @if(!in_array($papel, ['TRILHEIRO', 'GUIA'], true))
        <form class="pa-search" method="GET" action="{{ url('admin/listar-trilhas') }}">
            <i class="bi bi-search"></i>
            <input type="search" name="nome" placeholder="Buscar trilha..." value="{{ request()->is('admin/listar-trilhas') ? request('nome') : '' }}" autocomplete="off">
            <kbd>/</kbd>
        </form>
        @endif

        <div class="pa-header-right">
            <a href="{{ url('/') }}" class="pa-icon-btn d-none d-md-inline-flex" title="Ver o site"><i class="bi bi-box-arrow-up-right"></i></a>
            <div class="dropdown">
                <button class="pa-user-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="pa-avatar">{{ $inicial }}</span>
                    <span class="pa-user-meta">
                        <span class="pa-user-name">{{ $primeiroNome }}</span>
                        <span class="pa-user-role">{{ $papelLabel }}</span>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="{{ asset('vendor/dropify/js/dropify.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
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

            document.querySelectorAll('.pa-nav-link').forEach(function (link) {
                link.addEventListener('click', function () {
                    if (!desktop()) {
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

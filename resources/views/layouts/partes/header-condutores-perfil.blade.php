@php
    $cidadesAtuacao = $guia->cidadesAtuacao->pluck('nm_cidade_cde')->filter()->values();
    $atuacaoCabecalho = $cidadesAtuacao->count()
        ? $cidadesAtuacao->implode(', ')
        : optional($guia->origem)->nm_cidade_cde;
    $instagram = $guia->urlInstagram();
    $whatsapp = $guia->urlWhatsapp();
    $telefone = $guia->telefoneInternacional();
    $identificador = $guia->nm_instagram_gui ?: $guia->id_guia_gui;
@endphp
<header class="position-relative">
    <div class="container">
       <div class="row bg-white px-2 py-4 mt-n7 position-relative shadow border-radius-lg mb-2">
          <div class="col-lg-2 col-md-5 position-relative my-auto justify-content-center text-center">
             @if($guia->nm_path_logo_gui)
               <img class="avatar avatar-xxl shadow-lg rounded-circle mx-auto" src="{{ asset('img/guias/'.$guia->nm_path_logo_gui) }}" alt="Foto de {{ $guia->nm_guia_gui }}" loading="eager" fetchpriority="high">
             @else
               <img class="avatar avatar-xxl shadow-lg rounded-circle mx-auto" src="{{ asset('img/guias/default.png') }}" alt="Foto de {{ $guia->nm_guia_gui }}" loading="eager" fetchpriority="high">
             @endif
          </div>
          <div class="col-md-10 z-index-2 position-relative px-md-2 px-sm-5 mt-sm-0 mt-4">
             <h1 class="mb-1 h4">{{ $guia->nm_guia_gui }}</h1>
             @if($instagram)
             <p class="mb-1"><i class="fa fa-instagram" aria-hidden="true"></i> <a href="{{ $instagram }}" target="_blank" rel="noopener" data-interacao="{{ url('guia/perfil/interacao/instagram', $identificador) }}">{{ $guia->nm_instagram_gui }}</a></p>
             @endif
             @if($atuacaoCabecalho)
             <p class="mb-1"><strong>Atua em</strong>: {{ $atuacaoCabecalho }}</p>
             @endif
             @if($guia->telefoneNumero())
             <p class="mb-2"><strong>Contato</strong>:
                @if($telefone)
                <a href="tel:+{{ $telefone }}">{{ $guia->telefoneNumero() }}</a>
                @else
                {{ $guia->telefoneNumero() }}
                @endif
             </p>
             @endif
             @if($whatsapp)
             <a class="btn btn-success" href="{{ $whatsapp }}" target="_blank" rel="noopener" data-interacao="{{ url('guia/perfil/interacao/telefone', $identificador) }}"><i class="fa fa-whatsapp" aria-hidden="true"></i> Chamar no WhatsApp</a>
             @endif
          </div>
       </div>
    </div>
 </header>

<header class="position-relative">
    <div class="container">
       <div class="row bg-white px-2 py-4 mt-n7 position-relative shadow border-radius-lg mb-2">
          <div class="col-lg-2 col-md-5 position-relative my-auto justify-content-center text-center">
             @if($guia->nm_path_logo_gui)
               <img class="avatar avatar-xxl shadow-lg rounded-circle mx-auto" src="{{ asset('img/guias/'.$guia->nm_path_logo_gui) }}" alt="Logo Guia {{ $guia->nm_guia_gui }}">
             @else
               <img class="avatar avatar-xxl shadow-lg rounded-circle mx-auto" src="{{ asset('img/guias/default.png') }}" alt="Logo Guia {{ $guia->nm_guia_gui }}">
             @endif
          </div>
          <div class="col-md-10 z-index-2 position-relative px-md-2 px-sm-5 mt-sm-0 mt-4">
             <h4 class="mb-1">{{ $guia->nm_guia_gui }}</h4>
             <p class="mb-1"><i class="fa fa-instagram"></i> <a href="{{ url("guia/perfil/estatistica/instagram", $guia->nm_instagram_gui) }}">{{ $guia->nm_instagram_gui }}</a></p>
             <p class="mb-1"><strong>Cidade</strong>: {{ $guia->origem->nm_cidade_cde }}</p>
             <p class="mb-1"><strong>Contato</strong>: {{ ($guia->fone) ? $guia->fone->nu_fone_fon : '' }}</p>
          </div>
       </div>
    </div>
 </header>
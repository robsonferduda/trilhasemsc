<header class="position-relative">
    <div class="container">
       <div class="row bg-white px-4 py-5 mt-n7 position-relative shadow border-radius-lg mb-2">
          <div class="col-lg-3 col-md-5 position-relative my-auto">
             @if($guia->nm_path_logo_gui)
             <img class="img rounded-circle max-width-200 w-100 position-relative z-index-2" src="{{ asset('img/guias/'.$guia->nm_path_logo_gui) }}" alt="Logo Guia {{ $guia->nm_guia_gui }}">
             @else
             <img class="img rounded-circle max-width-200 w-100 position-relative z-index-2" src="{{ asset('img/guias/default.png') }}" alt="Logo Guia {{ $guia->nm_guia_gui }}">
             @endif
          </div>
          <div class="col-md-9 z-index-2 position-relative px-md-2 px-sm-5 mt-sm-0 mt-4">
             <div class="d-flex justify-content-between align-items-center mb-2">
                <h4 class="mb-0">{{ $guia->nm_guia_gui }}</h4>
                
             </div>
             <p><i class="fa fa-instagram"></i> <a href="{{ url("guia/perfil/estatistica/instagram", $guia->id_guia_gui) }}">{{ $guia->nm_instagram_gui }}</a></p>
             <p><strong>Cidade</strong>: {{ $guia->origem->nm_cidade_cde }}</p>
             <p><strong>Contato</strong>: {{ ($guia->fone) ? $guia->fone->nu_fone_fon : '' }}</p>
          </div>
       </div>
    </div>
 </header>
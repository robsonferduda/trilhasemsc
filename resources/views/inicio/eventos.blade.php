<section class="pt-1 pb-0 mt-2">
    <div class="container">
       <div class="row mb-2">
          <div class="col-md-7">
             <h3 class="text-success">Eventos</h3>
          </div>
       </div>
         <div class="row">
            <div class="col-lg-3 col-md-12 mb-5">
               <div class="card mb-3">
                  <div class="card-body border-radius-lg position-relative overflow-hidden pb-4 px-sm-5 " style="min-height: 365px;">
                     <i class="fa fa-calendar fa-3x text-success"></i>
                     <h5 class="mt-2">Agenda</h5>
                     <p class="mb-3">
                        A agenda de eventos depende da oferta feita pelos guias e condutores. 
                        Mantenha-se atualizados sobre todos os eventos em nossa página de eventos.
                     </p>
                     <a href="{{ url('eventos') }}" class="font-weight-bold text-xs text-success text-uppercase font-weight-bolder text-decoration-underline-hover">
                        Ver todos
                     </a>
                  </div>
               </div>
            </div>
            <div class="col-lg-3 col-md-12 mb-5">
               <div class="card mb-3">
                  <div class="card-body border-radius-lg position-relative overflow-hidden pb-4 px-sm-5 " style="min-height: 365px;">
                     <i class="fa fa-map-marker fa-3x text-danger"></i>
                     <h5 class="mt-2">Localização</h5>
                     <p class="mb-3">
                        Nossos guias são de diferentes cidades de Santa Catarina, oferecendo 
                        opções de aventuras por todas as regiões do estado.
                     </p>
                     <a href="{{ url('guias-e-condutores') }}" class="font-weight-bold text-xs text-danger text-uppercase font-weight-bolder text-decoration-underline-hover">
                        Buscar guias
                     </a>
                  </div>
               </div>
            </div>
            <div class="col-lg-3 col-md-12 mb-5">
               <div class="card mb-3">
                  <div class="card-body border-radius-lg position-relative overflow-hidden pb-4 px-sm-5 " style="min-height: 365px;">
                     <i class="fa fa-shield fa-3x text-warning"></i>
                     <h5 class="mt-2">Segurança</h5>
                     <p class="mb-3">
                        Siga corretamente as dicas e orientações dos guias.
                        Cada região tem suas características, por isso, fique atento ao procedimentos 
                        de segurança. 
                     </p>
                     <a href="{{ url('dicas-de-seguranca') }}" class="font-weight-bold text-xs text-warning text-uppercase font-weight-bolder text-decoration-underline-hover">
                        dicas de segurança
                     </a>
                  </div>
               </div>
            </div>
            <div class="col-lg-3 col-md-12 mb-5">
               <div class="card mb-3">
                  <div class="card-body border-radius-lg position-relative overflow-hidden pb-4 px-sm-5 " style="min-height: 365px;">
                     <i class="fa fa-ticket fa-3x text-info"></i>
                     <h5 class="mt-2">Eventos</h5>
                     <p class="mb-3">
                        Nã encontrou um evento? Busque pelas trilhas e fale com um guia disponível 
                        para sua aventura. Cada trilha possui uma lista de guias habilitados.
                     </p>
                     <a href="{{ url('trilhas#lista') }}" class="font-weight-bold text-xs text-info text-uppercase font-weight-bolder text-decoration-underline-hover">
                        pesquisar trilhas
                     </a>
                  </div>
               </div>
            </div>
            @for($i = 0; $i < 0; $i++)
               <div class="col-lg-3">
                  <a href="javascript:;">
                  <div class="card card-background mb-4">
                     <div class="full-background" style="background-image: url('{{ asset('img/trilhas/destaque-pequena/'.$preferidas[$i]->foto->where('id_tipo_foto_tfo',1)->first()->nm_path_fot) }}')"></div>
                     <div class="card-body pt-12">
                     <h4 class="text-white text-decoration-underline-hover">{{ $preferidas[$i]->nm_trilha_tri }}</h4>
                     <p>{{ $preferidas[$i]->cidade->nm_cidade_cde }}</p>
                     </div>
                  </div>
                  </a>
               </div>
            @endfor
       </div>
    </div>
 </section>
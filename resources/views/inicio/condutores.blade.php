<section class="pt-1 pb-0 mt-3 mb-5">
    <div class="container">
       <div class="row mb-2">
          <div class="col-md-7">
             <h3 class="text-info">Condutores de Aventura</h3>
          </div>
       </div>
       <div class="row">
           @foreach($guias as $guia)
           <div class="col-lg-3 col-md-3  mb-3">
               <div class="card card-profile" style="min-height: 320px;">
                 
                 <div class="card-body justify-content-center text-center">
                   <a href="javascript:;">
                       <img class="avatar avatar-xxl shadow-lg rounded-circle mx-auto" src="{{ asset('img/guias/'.$guia->nm_path_logo_gui) }}">
                     </a>
                   <h6 class="mb-0 mt-2">{{ $guia->nm_guia_gui }}</h6>
                   <p>{{ ($guia->origem) ? $guia->origem->nm_cidade_cde : 'Santa Catarina' }}</p>

                   <div class="justify-content-center mt-3" style="position: absolute; bottom: 1px; font-size: 30px;">
                    <a href="{{ url("guia/perfil/estatistica/perfil", $guia->id_guia_gui) }}" class="btn-icon-only btn-simple btn btn-lg btn-linkedin mx-auto" data-toggle="tooltip" data-placement="bottom" title="Follow me!">
                      <span class="btn-inner--icon"><i class="fa fa-user" style="font-size: 30px;"></i></span>
                    </a>
                    <a href="{{ url("https://www.instagram.com/".$guia->nm_instagram_gui) }}" class="btn-icon-only btn-simple btn btn-lg btn-dribbble mx-auto" data-toggle="tooltip" data-placement="bottom" title="Follow me!">
                      <span class="btn-inner--icon"><i class="fab fa-instagram" style="font-size: 30px;"></i></span>
                    </a>
                    <a href="{{ url("guia/perfil/estatistica/telefone", $guia->id_guia_gui) }}" class="btn-icon-only btn-simple btn btn-lg text-success mx-auto" data-toggle="tooltip" data-placement="bottom" title="Follow me!">
                      <span class="btn-inner--icon"><i class="fab fa-whatsapp" style="font-size: 30px;"></i></span>
                    </a>
                  </div>
                  <!--
                   <div class="row justify-content-center text-center" style="position: absolute; bottom: 1px;">
                     <div class="col-lg-4 col-md-4 col-sm-4 text-center">
                       <a href="{{ url("guia/perfil/estatistica/perfil", $guia->id_guia_gui) }}" type="button" class="btn-icon-only btn-simple btn btn-lg btn-facebook" data-toggle="tooltip" data-placement="bottom" title="Conhecer Perfil">
                           <span class="btn-inner--icon"><i class="fa fa-user" style="font-size: 30px;"></i></span>
                       </a>
                     </div>
                     <div class="col-lg-4 col-4">
                       <a href="{{ url("https://www.instagram.com/".$guia->nm_instagram_gui) }}" target="BLANK" type="button" class="btn-icon-only btn-simple btn btn-lg btn-dribbble" data-toggle="tooltip" data-placement="bottom" title="Follow me!">
                           <span class="btn-inner--icon"><i class="fab fa-instagram" style="font-size: 30px;"></i></span>
                       </a>
                     </div>
                     <div class="col-lg-4 col-4">
                       <a href="{{ url("guia/perfil/estatistica/telefone", $guia->id_guia_gui) }}" target="BLANK" type="button" class="btn-icon-only btn-simple btn btn-lg btn-slack" data-toggle="tooltip" data-placement="bottom" title="Enviar Mensagem">
                           <span class="btn-inner--icon"><i class="fab fa-whatsapp" style="font-size: 30px;"></i></span>
                       </a>
                     </div>
                   </div>
                  -->
                 </div>
               </div>
             </div> 
          
          @endforeach
          <div class="col-lg-2 col-md-3 mt-4">
            <a href="{{ url('guias-e-condutores') }}" type="button" class="btn btn-outline-primary btn-sm">Ver Todos</a>
          </div>
       </div>
    </div>
 </section>
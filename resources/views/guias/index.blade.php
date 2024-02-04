@extends('layouts.site')
@section('content')
@include('layouts/partes/header-condutores')
<section class="pt-1 pb-0 mt-3 mb-5">
    <div class="container">
       <div class="row mb-2">
          <div class="col-md-7">
             <h3 class="text-info">Condutores de Aventura</h3>
          </div>
       </div>
       <div class="row">
           @foreach($guias as $guia)
           <div class="col-lg-3 col-md-3  mb-5">
               <div class="card card-profile" style="min-height: 335px;">
                 
                 <div class="card-body justify-content-center text-center">
                   <a href="{{ url("guia/perfil/estatistica/perfil", $guia->id_guia_gui) }}">
                       <img class="avatar avatar-xxl shadow-lg rounded-circle mx-auto" src="{{ asset('img/guias/'.$guia->nm_path_logo_gui) }}">
                     </a>
                   <h6 class="mb-0 mt-2">{{ $guia->nm_guia_gui }}</h6>
                   <p>{{ ($guia->origem) ? $guia->origem->nm_cidade_cde : 'Santa Catarina' }}</p>
                   <div class="row justify-content-center text-center" style="position: absolute; bottom: 1px;">
                     <div class="col-lg-4 col-4">
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
                 </div>
               </div>
             </div>           
          @endforeach
          @env('production')
                            <ins class="adsbygoogle"
                                style="display:block"
                                data-ad-client="ca-pub-1229685353625953"
                                data-ad-slot="7739149091"
                                data-ad-format="auto"
                                data-full-width-responsive="true"></ins>
                            <script>
                                (adsbygoogle = window.adsbygoogle || []).push({});
                            </script>
                        @endenv
          <div class="col-lg-12 col-md-12 mt-4 text-center">
            <a href="{{ url('/') }}" type="button" class="btn btn-outline-warning btn-sm">Voltar ao Início</a>
          </div>
       </div>
    </div>
 </section>
@endsection
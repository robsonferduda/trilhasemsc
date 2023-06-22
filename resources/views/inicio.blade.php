@extends('layouts.site')
@section('content')
    @include('layouts/partes/header')
    @include('layouts/partes/acesso_guias')
    @include('inicio/destaques')
    <section class="pt-1 pb-0 mt-0 mb-5">
        <div class="container">
           <div class="row mb-2">
              <div class="col-md-7">
                 <h3 class="text-default">Publicidade</h3>
              </div>
           </div>
           <div class="row">
                <ins class="adsbygoogle"
                    style="display:block"
                    data-ad-client="ca-pub-1229685353625953"
                    data-ad-slot="7739149091"
                    data-ad-format="auto"
                    data-full-width-responsive="true">
                </ins>
                <script> (adsbygoogle = window.adsbygoogle || []).push({});  </script>  
            </div>
        </div>
    </section>
    @include('inicio/eventos')
    @include('inicio/condutores')
    <section class="pt-1 pb-0 mt-0 mb-5">
        <div class="container">
           <div class="row mb-2">
              <div class="col-md-7">
                 <h3 class="text-default">Publicidade</h3>
              </div>
           </div>
           <div class="row">
                <ins class="adsbygoogle"
                    style="display:block"
                    data-ad-client="ca-pub-1229685353625953"
                    data-ad-slot="7739149091"
                    data-ad-format="auto"
                    data-full-width-responsive="true">
                </ins>
                <script> (adsbygoogle = window.adsbygoogle || []).push({});  </script>  
            </div>
        </div>
    </section>
    @include('inicio/favoritos')
@endsection
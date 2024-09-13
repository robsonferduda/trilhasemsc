@extends('layouts.site')
@section('content')
@include('layouts/partes/header-nof-found')
<section class="pt-1 pb-0 mt-3 mb-5">
    <div class="container">
       <div class="row mb-2">
          <div class="col-md-7">
             <h3 class="text-danger">Perfil Não Encontrado</h3>
          </div>
       </div>
       <div class="row">
         <div class="col-md-12">
            <h6>Não conseguimos encontrar o perfil que procurava, mas temos muitos outros a sua disposição! Boa aventura!<h6>
         </div>
         <div class="col-md-12 mt-2">
            <a class="btn btn-primary mr-2 ml-3" href="{{ url("guias-e-condutores") }}"><i class="fa fa-users" aria-hidden="true"></i> Todos os Guias</a>
         </div>          
       </div>
    </div>
 </section>
@endsection
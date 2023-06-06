@extends('layouts.site')
@section('content')
    @include('layouts/partes/header')
    <section class="pt-1 pb-0 mt-3 mb-5">
        <div class="container">
           <div class="row mb-2">
              <div class="col-md-7">
                 <h3 class="text-warning"><i class="fa fa-shield" aria-hidden="true"></i> Dicas de Segurança</h3>
              </div>
           </div>
           <div class="row">
               
              <div class="col-lg-12 col-md-12 mt-4">
                <a href="{{ url('/') }}" type="button" class="btn btn-outline-warning btn-sm">Voltar ao Início</a>
              </div>
           </div>
        </div>
     </section>    
@endsection
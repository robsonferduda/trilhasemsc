@extends('layouts.site')
@section('content')
    @include('layouts/partes/header')
    <div class="container">
        <div class="row mb-2 mt-3">
            <div class="col-md-7">
               <h3 class="text-primary">Grupos de Whatsapp</h3>
               <p>Os grupos, mensagens e conteúdos são de responsabilidade de seus idealizadores.</p>
            </div>
         </div>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
               <div class="card card-profile" style="min-height: 320px;">
                 
                 <div class="card-body justify-content-center text-center">
                   <a href="javascript:;">
                       <img class="avatar avatar-xxl shadow-lg rounded-circle mx-auto" src="{{ asset('img/grupos/familia_na_trilha.png') }}">
                     </a>
                   <h6 class="mb-0 mt-2">Família na Trilha</h6>
                   <p>Operadora de turismo de aventura</p>
                   <p><strong>Cidade</strong>: Florianópolis</p>
                   <p><strong>Responsável</strong>: Claudia Tiscoski</p>
                   <p><strong>Contato</strong>: (48) 4141-0450</p>
                   <a class="btn btn-success" href="https://chat.whatsapp.com/GvvzWUySo9f00HGikK11kP"><i class="fa fa-whatsapp" aria-hidden="true"></i> Entrar no Grupo</a>
                 </div>
               </div>
            </div>   
            
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-profile" style="min-height: 320px;">
                  
                  <div class="card-body justify-content-center text-center">
                    <a href="javascript:;">
                        <img class="avatar avatar-xxl shadow-lg rounded-circle mx-auto" src="{{ asset('img/grupos/litoral_trilhas.jpg') }}">
                      </a>
                    <h6 class="mb-0 mt-2">Litoral Trilhas</h6>
                    <p>Trilhas, Praias e Acampamentos</p>
                    <p><strong>Cidade</strong>: Brusque</p>
                    <p><strong>Responsável</strong>: Rachel e Vilson </p>
                    <p><strong>Contato</strong>: (47) 98870-6304</p>
                    <a class="btn btn-success" href="https://chat.whatsapp.com/CFb4KMQ864NGhPZc0WmeKV"><i class="fa fa-whatsapp" aria-hidden="true"></i> Entrar no Grupo</a>
                  </div>
                </div>
             </div> 
             <div class="col-lg-12 col-md-12 mt-4 text-center">
                <a href="{{ url('/') }}" type="button" class="btn btn-outline-warning btn-sm">Voltar ao Início</a>
              </div>
        </div>
     </div>
@endsection
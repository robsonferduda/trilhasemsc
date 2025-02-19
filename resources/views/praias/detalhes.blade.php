@extends('layouts.site')
@section('pageTitle', '')
@section('description', '')
@section('content')
<header class="position-relative">
    <div class="container">
        <div class="row bg-white shadow mt-n5 border-radius-lg pb-3 p-3 mx-sm-0 mx-1 position-relative">
            <div class="col-md-12 z-index-2 position-relative px-md-2 px-sm-5 mt-sm-0 mt-4 text-center">
                <h2 class="mt-2">Nome Praia</h2>
                <h5><i class="ni ni-pin-3 text-danger mb-1"></i>Florianópolis</h5>
            </div>
       </div>
    </div>
 </header>
<section class="pt-1 pb-0 mt-3 mb-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-2">
                <div class="col-md-12">
                    <a href="#"><img class="border-radius-xl shadow w-100" src="{{ asset('img/trilhas/detalhes-principal/padrao.jpg') }}" alt=""></a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-9 mt-2">
                <div class="col-md-12 mt-3">
                    <h4 class="mt-2">Nome da Praia</h4>
                    <h6>
                        <i class="ni ni-pin-3 text-danger"></i> Florianópolis 
                        <span class=""><a href="https://www.instagram.com/trilhasemsc/?hl=pt-br" target="_BLANK" style="color: #e73177;"><i class="fa fa-instagram" aria-hidden="true"></i> @trilhasemsc</a></span>
                    </h6>               
                </div> 
                <div class="col-md-12 mt-3">
                    <div class="mt-0 conteudo">
                        
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12" style="text-align: center">
                            <h5 class="mb-2 mt-2">Gostou do conteúdo?</h5>                          
                            <p class="mb-2">Que tal nos pagar um café?</p>
                            <a href="https://pag.ae/7-dSqqaS8" class="btn btn-sm bg-gradient-info btn-round mb-0 me-1"><i class="fa fa-coffee" style="font-size: 12px;" aria-hidden="true"></i> Pagar um café!</a>                            
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12" style="text-align: center">
                            <h5 class="mb-2 mt-2">Também pode ser um PIX</h5>   
                            <p class="mb-2">Chave: trilhasemsc@gmail.com</p>     
                            <img class="mx-auto" src="{{ asset('img/qrcode.png') }}" style="width: 80%;" alt="PIX TrilhasemSC">                                              
                        </div>
                    </div>
                </div>
                @include('layouts/partes/publicidade-google')
            </div>
            <div class="col-md-3">            
                <!-- Coluna esquerda -->
            </div>         
       </div>
    </div>
 </section>
@endsection
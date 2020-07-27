@extends('layouts.blog')

@section('content')
        <div class="blog-post-area section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title text-center">
                            <div class="title-border">
                                <br/><br/><h1>Guia de Dificuldade<span> em Trilhas</span></h1>
                            </div>    
                        </div>
                    </div>  
                    <div class="col-md-12">
                        <img src="{{ asset('img/trilhas/dificuldade/abnt/severidade-do-meio.png') }}">
                        <img src="{{ asset('img/trilhas/dificuldade/abnt/orientacao-do-percurso.png') }}">
                        <img src="{{ asset('img/trilhas/dificuldade/abnt/condicoes-do-terreno.png') }}">
                        <img src="{{ asset('img/trilhas/dificuldade/abnt/intensidade-de-esforco-fisico.png') }}">
                        <h4 class="center" style="margin-top: 50px;"><a class="link" href="{{ url('guia-de-dificuldade-em-trilhas') }}">Voltar para o Guia de Dificuldade</a>
                        </h4>                    
                    </div>                        
                </div>
            </div>
        </div>
@endsection
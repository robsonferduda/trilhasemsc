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
                        <a href="{{ url('guia-de-dificuldade-em-trilhas/abnt') }}">ABNT</a>
                        <a href="{{ url('guia-de-dificuldade-em-trilhas/femerj') }}">FEMERJ</a>
                    </div>      
                    <div class="col-md-12 center">
                        <img style="height: 35%" src="{{ asset('img/trilhas/dificuldade/infografico-niveis-de-dificuldade-em-trilhas-vamos-trilhar.png') }}">
                    </div>                  
                </div>
            </div>
        </div>
@endsection
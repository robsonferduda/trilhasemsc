@extends('layouts.blog')
@section('content')
        <div class="blog-post-area section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title text-center">
                            <div class="title-border">
                                <br/><br/><h1>{{ $evento->nm_evento_eve  }}</h1>
                            </div>    
                        </div>
                    </div>                          
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <img class="circle-image mb-3 mb-md-0" src="{{ asset('img/eventos/'.$evento->id_evento_eve) }}" alt="Logo Evento {{ $evento->nm_evento_eve }}">
                    </div>
                    <div class="col-md-9">
                        <h4>{{ $evento->nm_evento_eve }}</h4>
                        <p><strong>Cidade</strong>: {{ $evento->local->nm_cidade_cde }}</p>
                        <p>
                            {{ $evento->descricao }}
                        </p>
                    </div>
                </div>                
            </div>
        </div>
@endsection 
@extends('layouts.blog')

@section('pageTitle', 'Trilhas por Região' )

@section('description', 'Lista de trilhas por região')

@section('content')
<div id="lista" class="adventures-grid section-padding list">
    <div class="container">
        <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12">
                        <div class="single-list-item">
                            <div class="row">
                                <div class="col-md-4 col-sm-5">
                                    <div class="adventure-img">
                                        <a href="{{ url('trilhas/brasil/regioes/nordeste/chapada') }}"><img src="{{ asset('img/trilhas/brasil/nordeste/chapada/vale_do_pati.jpg') }}" alt="Foto da Trilha da Chapada Diamentina"></a>
                                        
                                    </div>
                                </div>
                                <div class="col-md-8 col-sm-7 margin-left-list">
                                    <div class="adventure-list-container">
                                        <div class="adventure-list-text">
                                            <h1><a href="{{ url('trilhas/brasil/regioes/nordeste/chapada') }}">Chapada Diamantina</a></h1>
                                            <h2 class="cidade-list"><a>Guiné/Andaraí</a></h2>
                                            <p></p>
                                            <p>
                                                Para os aventureiros de plantão, esse é um lugar que não pode ficar de fora da lista de aventuras. 
                                                Considerado um dos trekkings mais bonitos do Brasil, ele proporciona uma experiência que vai além da caminhada.
                                                Entre as diferentes possibilidades de trajeto, fizemos o de 5 dias e foi uma experiência fantástica. 
                                                Quer saber mais? Clica abaixo e confira os detalhes da nossa aventura.
                                            </p>                                                
                                            <p></p>
                                            <div class="list-buttons">
                                                <a href="{{ url('trilhas/brasil/regioes/nordeste/chapada') }}" class="button-one button-blue">LER MAIS</a>                                        
                                            </div>
                                        </div>
                                        <div class="adventure-list-image">
                                            <div class="image-top">
                                                <img class="icone-nivel" src="{{ url('public/img/icon/selvagem.png') }}" alt="Ícone indicador de trilha com nível Passeio">
                                            </div>
                                            <h2></h2>
                                            <div style="height: 150px; display: inline-block;">
                                                
                                            </div>                                      
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>        
            </div>
        </div>
    </div>
</div>
@endsection
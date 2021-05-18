@extends('layouts.blog')

@section('pageTitle', 'Camping em Santa Catarina' )

@section('description', 'Camping localizado em Garuva')

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
                                        <a href="https://trilhasemsc.com.br/camping"><img src="https://trilhasemsc.com.br/public/img/trilhas/busca/trilha-da-guarda-do-embau-vale-da-utopia.jpg" alt="Vale da Utopia"></a>
                                        
                                    </div>
                                </div>
                                <div class="col-md-8 col-sm-7 margin-left-list">
                                    <div class="adventure-list-container">
                                        <div class="adventure-list-text">
                                            <h1><a href="https://trilhasemsc.com.br/camping">Camping Vale da Utopia</a></h1>
                                            <h2 class="cidade-list"><a href="https://trilhasemsc.com.br/palhoca/trilhas/#lista">Palhoça</a></h2>
                                            <p></p>
                                            <p>
                                                Sabe aqueles lugares que parecem saídos de filmes, que te levam a uma viagem no tempo? Esse é o caso do Vale da Utopia, pequeno vale localizado na cidade de Palhoça. O vale fica localizado entre a Praia da Pinheira e a Praia da Guarda do Embaú e faz parte do Parque Estadual da Serra do Tabuleiro. O vale é coberto por uma grama verdinha e abriga a pequena Praia do Maço, que permite além do camping, também um gostoso banho de mar.
                                            </p>                                                
                                            <p></p>
                                            <div class="list-buttons">
                                                <a href="https://trilhasemsc.com.br/camping" class="button-one button-blue">LER MAIS</a>                                        
                                            </div>
                                        </div>
                                        <div class="adventure-list-image">
                                            <div class="image-top">
                                                <img class="icone-nivel" src="{{ url('public/img/icon/estrutura.png') }}" alt="Ícone indicador de trilha com nível Passeio">
                                            </div>
                                            <h2>ESTRUTURADO</h2>
                                            <div style="height: 150px; display: inline-block;">
                                                
                                            </div>                                      
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>   
                    <div class="col-md-12">
                        <div class="single-list-item">
                            <div class="row">
                                <div class="col-md-4 col-sm-5">
                                    <div class="adventure-img">
                                        <a href="{{ ('garuva/campings/selvagem/camping-monte-crista') }}"><img src="https://trilhasemsc.com.br/public/img/trilhas/busca/trilha-do-monte-crista.jpg" alt="Monte Crista"></a>
                                        
                                    </div>
                                </div>
                                <div class="col-md-8 col-sm-7 margin-left-list">
                                    <div class="adventure-list-container">
                                        <div class="adventure-list-text">
                                            <h1><a href="{{ ('garuva/campings/selvagem/camping-monte-crista') }}">Camping Monte Crista</a></h1>
                                            <h2 class="cidade-list"><a href="https://trilhasemsc.com.br/garuva/trilhas/#lista">Garuva</a></h2>
                                            <p></p>
                                            <p>Entre as muitas opções de locais para acampar em Santa Catarina, temos aquelas mais fáceis, sem trilhas ou mesmo com trilhas curtas e aquelas que exigem um esforço bem maior. Esse é o caso do camping do Monte Crista.
                                                Como o nome já diz, o local do camping é um monte e a trilha por si só já é um grande desafio. Subir com todo o equipamento de camping é ainda mais difícil, mas para quem resolve encarar essa aventura, a recompensa é garantida. 
                                            </p>
                                            <p></p>
                                            <div class="list-buttons">
                                                <a href="{{ ('garuva/campings/selvagem/camping-monte-crista') }}" class="button-one button-blue">LER MAIS</a>                                        
                                            </div>
                                        </div>
                                        <div class="adventure-list-image">
                                            <div class="image-top">
                                                <img class="icone-nivel" src="{{ url('public/img/icon/selvagem.png') }}" alt="Ícone indicador de trilha com nível Passeio">
                                            </div>
                                            <h2>SELVAGEM</h2>
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
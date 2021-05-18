@extends('layouts.blog')

@section('pageTitle', 'Camping Vale da Utopia' )

@section('description', 'Sabe aqueles lugares que parecem saídos de filmes, que te levam a uma viagem no tempo? Esse é o caso do Vale da Utopia, pequeno vale localizado na cidade de Palhoça. O vale fica localizado entre a Praia da Pinheira e a Praia da Guarda do Embaú e faz parte do Parque Estadual da Serra do Tabuleiro. O vale é coberto por uma grama verdinha e abriga a pequena Praia do Maço, que permite além do camping, também um gostoso banho de mar.' )

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
                                        <a href="https://trilhasemsc.com.br/camping"><img src="http://localhost/trilhasemsc/public/img/camping/vale-da-utopia/capa.jpg" alt="Vale da Utopia"></a>
                                        
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
                                                <img class="icone-nivel" src="https://trilhasemsc.com.br/public/img/icon/14.png" alt="Ícone indicador de trilha com nível Passeio">
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
                                        <a href="{{ ('joinville/campings/selvagem/camping-monte-crista') }}"><img src="https://trilhasemsc.com.br/public/img/trilhas/busca/trilha-do-salto-do-rio-pelotas.jpg " alt="Foto da Trilha do Salto do Rio Pelotas"></a>
                                        
                                    </div>
                                </div>
                                <div class="col-md-8 col-sm-7 margin-left-list">
                                    <div class="adventure-list-container">
                                        <div class="adventure-list-text">
                                            <h1><a href="{{ ('joinville/campings/selvagem/camping-monte-crista') }}">Camping Monte Crista</a></h1>
                                            <h2 class="cidade-list"><a href="https://trilhasemsc.com.br/joinville/trilhas/#lista">Joinville</a></h2>
                                            <p>
                                                </p><p>Essa é mais uma da série “trilhas curtas” e que tem um visual fantástico ao final do percurso. Em uma caminhada leve de aproximadamente 20 minutos é possível apreciar uma paisagem que mais parece uma pintura, formada pela composição da cascata, dos morros e das belas araucárias. Localizada em Bom Jardim da Serra, ela fica às margens da rodovia SC-438, a aproximadamente 8km da cidade, sentido Urubici.</p>
                                            <p></p>
                                            <div class="list-buttons">
                                                <a href="{{ ('joinville/campings/selvagem/camping-monte-crista') }}" class="button-one button-blue">LER MAIS</a>                                        
                                            </div>
                                        </div>
                                        <div class="adventure-list-image">
                                            <div class="image-top">
                                                <img class="icone-nivel" src="https://trilhasemsc.com.br/public/img/icon/9-hover.png" alt="Ícone indicador de trilha com nível Passeio">
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
@extends('layouts.blog')

@section('pageTitle', 'Santa Catarina - Trilhas por Regiões ' )

@section('description', 'Lista de trilhas da região serrana de Santa Catarina')

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
                                        <a href="{{ url('trilhas/santa-catarina/regioes/serra-catarinense') }}"><img src="https://trilhasemsc.com.br/public/img/trilhas/busca/trilha-do-canion-da-ronda-e-parque-eolico.jpg" alt="Cânion da Ronda - Bom Jardim da Serra"></a>                                        
                                    </div>
                                </div>
                                <div class="col-md-8 col-sm-7 margin-left-list">
                                    <div class="adventure-list-container">
                                        <div class="adventure-list-text">
                                            <h1><a href="{{ url('trilhas/santa-catarina/regioes/serra-catarinense') }}">Trilhas na Serra Catarinense</a></h1>
                                            <h2 class="cidade-list"><a>Região Serrana</a></h2>
                                            <p></p>
                                            <p>
                                                A Serra Catarinense é sinônimo de beleza e aventuras. Muito procurada pelos turistas que buscam o frio, também é destino certo dos trilheiros de plantão, que buscam os cânions, 
                                                planaltos e cachoeiras para fazer suas trilhas e explorar a região. Reunimos todas as trilhas feitas por nós na região para trazer para vocẽs um gostinho do que ela reserva para os aventureiros.  
                                            </p>                                                
                                            <p></p>
                                            <div class="list-buttons">
                                                <a href="{{ url('trilhas/santa-catarina/regioes/serra-catarinense') }}" class="button-one button-blue">LER MAIS</a>                                        
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
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
                                        <a href="{{ url('trilhas/florianopolis/regioes/leste') }}"><img src="http://trilhasemsc.com.br/public/img/trilhas/busca/trilha-do-gravata.jpg " alt="Foto da Trilha do Gravatá"></a>
                                        
                                    </div>
                                </div>
                                <div class="col-md-8 col-sm-7 margin-left-list">
                                    <div class="adventure-list-container">
                                        <div class="adventure-list-text">
                                            <h1><a href="{{ url('trilhas/florianopolis/regioes/leste') }}">Trilhas no Leste de Florianópolis</a></h1>
                                            <h2 class="cidade-list"><a>Florianópolis</a></h2>
                                            <p></p>
                                            <p>
                                                As trilhas feitas nessa região tem uma característica muito interessante e convidativa, todas iniciam, finalizam e passam por alguma praia. E falando nelas, as praias, primeiro vamos listar quais fazem parte da região leste da ilha. São elas: Praia da Joaquina, Praia do Gravatá, Praia Mole, Praia da Galheta, Barra da Lagoa, Prainha da Barra da Lagoa e Praia do Moçambique. E claro, não poderia faltar, a nossa querida Lagoa da Conceição, que possui uma conexão com o mar pelo canal da Barra da Lagoa.
                                            </p>                                                
                                            <p></p>
                                            <div class="list-buttons">
                                                <a href="{{ url('trilhas/florianopolis/regioes/leste') }}" class="button-one button-blue">LER MAIS</a>                                        
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
                    <div class="col-md-12">
                        <div class="single-list-item">
                            <div class="row">
                                <div class="col-md-4 col-sm-5">
                                    <div class="adventure-img">
                                        <a href="{{ url('trilhas/florianopolis/regioes/norte') }}"><img src="http://trilhasemsc.com.br/public/img/trilhas/busca/trilha-do-morro-das-aranhas.jpg " alt="Foto da Trilha do Morro das Aranhas"></a>
                                        
                                    </div>
                                </div>
                                <div class="col-md-8 col-sm-7 margin-left-list">
                                    <div class="adventure-list-container">
                                        <div class="adventure-list-text">
                                            <h1><a href="{{ url('trilhas/florianopolis/regioes/norte') }}">Trilhas no Norte de Florianópolis</a></h1>
                                            <h2 class="cidade-list"><a>Florianópolis</a></h2>
                                            <p></p>
                                            <p>
                                                Essa região é conhecida pelas praias de mar calmo e água um pouco mais quente. Abriga praias famosas como Daniela e Jurerê Internacional, além dos balneários que já formam cidades isoladas dentro da ilha, como Ingleses e Canasvieiras.
                                            </p>                                                
                                            <p></p>
                                            <div class="list-buttons">
                                                <a href="{{ url('trilhas/florianopolis/regioes/norte') }}" class="button-one button-blue">LER MAIS</a>                                        
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
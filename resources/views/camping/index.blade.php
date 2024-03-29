@extends('layouts.blog')

@section('pageTitle', 'Camping em Santa Catarina' )

@section('description', 'Lista de Camping de Santa Catarina')

@section('content')
<div id="lista" class="adventures-grid section-padding list">
    <div class="container">       
        <div class="clearfix"></div>
            <div style='margin-bottom: 50px;'>
                <!-- Horizontal Tela Detalhes Trilha -->
                <ins class="adsbygoogle"
                    style="display:block"
                    data-ad-client="ca-pub-1229685353625953"
                    data-ad-slot="7739149091"
                    data-ad-format="auto"
                    data-full-width-responsive="true"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            </div>
            <div class="clearfix"></div>
                <div class="row">    
                    <div class="col-md-12">
                        <div class="single-list-item">
                            <div class="row">
                                <div class="col-md-4 col-sm-5">
                                    <div class="adventure-img">
                                        <a href="{{ ('laguna/campings/selvagem/camping-mirante-anita-garibaldi') }}"><img src="https://trilhasemsc.com.br/public/img/trilhas/busca/trilha-do-bananal.jpg" alt="Camping Mirante Ponte Anita Garibaldi"></a>                                        
                                    </div>
                                </div>
                                <div class="col-md-8 col-sm-7 margin-left-list">
                                    <div class="adventure-list-container">
                                        <div class="adventure-list-text">
                                            <h1><a href="{{ ('laguna/campings/selvagem/camping-mirante-anita-garibaldi') }}">Camping Mirante Ponte Anita Garibaldi</a></h1>
                                            <h2 class="cidade-list"><a>Laguna</a></h2>
                                            <p></p>
                                            <p>
                                                Parte dos elementos que esperamos quando planejamos um camping é a aquela paisagem de tirar o fôlego. Montanhas, praias, lagos, sempre nos despertam a expectativa em relação a uma 
                                                vista privilegiada do nascer ou pôr do sol. Mas quando essa vista é um dos cartões postais do estado e, apesar de não ser natural, forma uma bela vista para um acampamento?
                                                Esse é o caso do camping no mirante que dá visão para a Ponte Anita Garibaldi, na cidade de Laguna. Para chegar ao ponto de acampamento, devemos seguir a Trilha no Bananal e ao final dela 
                                                escolher o melhor lugar para curtir tudo que essa aventura tem a oferecer.
                                            </p>
                                            <p></p>
                                            <div class="list-buttons">
                                                <a href="{{ ('laguna/campings/selvagem/camping-mirante-anita-garibaldi') }}" class="button-one button-blue">LER MAIS</a>                                        
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
                    <div class="col-md-12">                     
                        <div class="single-list-item">
                            <div class="row">
                                <div class="col-md-4 col-sm-5">
                                    <div class="adventure-img">
                                        <a href="https://trilhasemsc.com.br/camping"><img src="{{ url('/public/img/camping/camping-mirante/busca.jpg') }}" alt="Camping Mirante"></a>
                                        
                                    </div>
                                </div>
                                <div class="col-md-8 col-sm-7 margin-left-list">
                                    <div class="adventure-list-container">
                                        <div class="adventure-list-text">
                                            <h1><a href="{{ url('grao-para/campings/estruturado/camping-mirante') }}">Camping Mirante</a></h1>
                                            <h2 class="cidade-list"><a>Grão-Pará</a></h2>
                                            <p></p>
                                            <p>
                                                Quem já ouviu falar do Parque Estadual da Serra Furada, certamente já ouviu falar do Vale das Pirâmides e das belíssimas formações rochosas chamadas de Pirâmides Sagradas. 
                                                Sobre o parque, ele fica situado no território dos municípios de Grão-Pará e Orleans. Foi no interior do município de Grão-Pará que conhecemos a região das Pirâmides, 
                                                rodeada de cachoeiras e belas montanhas em formato de pirâmide, que dão ao nome do lugar. É lá que fica situado o Camping Mirante, 
                                                uma fazenda que recebe os campistas e aventureiros que procuram pela bela região.
                                            </p>                                                
                                            <p></p>
                                            <div class="list-buttons">
                                                <a href="{{ url('grao-para/campings/estruturado/camping-mirante') }}" class="button-one button-blue">LER MAIS</a>                                        
                                            </div>
                                        </div>
                                        <div class="adventure-list-image">
                                            <div class="image-top">
                                                <img class="icone-nivel" src="{{ url('public/img/icon/estruturado.png') }}" alt="Ícone indicador de camping estruturado em Santa Catarina">
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
                                        <a href="https://trilhasemsc.com.br/camping"><img src="https://trilhasemsc.com.br/public/img/trilhas/busca/trilha-da-guarda-do-embau-vale-da-utopia.jpg" alt="Vale da Utopia"></a>
                                        
                                    </div>
                                </div>
                                <div class="col-md-8 col-sm-7 margin-left-list">
                                    <div class="adventure-list-container">
                                        <div class="adventure-list-text">
                                            <h1><a href="https://trilhasemsc.com.br/camping">Camping Vale da Utopia</a></h1>
                                            <h2 class="cidade-list"><a>Palhoça</a></h2>
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
                                            <h2>SEMI-ESTRUTURADO</h2>
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
                                        <a href="{{ ('rancho-queimado/campings/estruturado/camping-mirante-do-alto-da-boa-vista') }}"><img src="{{ asset('img/camping/alto-da-boa-vista/busca.jpg') }}" alt="Camping Mirante do Alto da Boa Vista, Rancho Queimado, Santa Catarina"></a>
                                        
                                    </div>
                                </div>
                                <div class="col-md-8 col-sm-7 margin-left-list">
                                    <div class="adventure-list-container">
                                        <div class="adventure-list-text">
                                            <h1><a href="{{ ('rancho-queimado/campings/estruturado/camping-mirante-do-alto-da-boa-vista') }}">Camping Mirante do Alto da Boa Vista</a></h1>
                                            <h2 class="cidade-list"><a>Rancho Queimado</a></h2>
                                            <p></p>
                                            <p>
                                                Que tal acampar em meio a lindos campos de altitude, com uma vista panorâmica e com um belo pôr e nascer do sol? E mais, isso tudo sem ter que fazer muito esforço físico. Nesse caso, quase nada.
                                                Esse é o cenário de quem procura o camping no Mirante do Alto da Boa Vista. Com acesso fácil e possível de ser feito com o carro, o local é um convite para quem busca uma primeira experiência 
                                                em um camping, mas ainda não tem muito preparo para uma trilha mais longa.
                                            </p>                                                
                                            <p></p>
                                            <div class="list-buttons">
                                                <a href="{{ ('rancho-queimado/campings/estruturado/camping-mirante-do-alto-da-boa-vista') }}" class="button-one button-blue">LER MAIS</a>                                        
                                            </div>
                                        </div>
                                        <div class="adventure-list-image">
                                            <div class="image-top">
                                                <img class="icone-nivel" src="{{ url('public/img/icon/estrutura.png') }}" alt="Camping Estruturado em Santa catarina">
                                            </div>
                                            <h2>SEMI-ESTRUTURADO</h2>
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
                                        <a href="{{ ('bom-jardim-da-serra/campings/selvagem/camping-pico-do-rinoceronte') }}"><img src="https://trilhasemsc.com.br/public/img/trilhas/busca/trilha-do-pico-do-rinoceronte.jpg" alt="Camping Pico do Rinoceronte, Bom Jardim da Serra"></a>
                                        
                                    </div>
                                </div>
                                <div class="col-md-8 col-sm-7 margin-left-list">
                                    <div class="adventure-list-container">
                                        <div class="adventure-list-text">
                                            <h1><a href="{{ ('bom-jardim-da-serra/campings/selvagem/camping-pico-do-rinoceronte') }}">Camping Pico do Rinoceronte</a></h1>
                                            <h2 class="cidade-list"><a>Bom Jardim da Serra</a></h2>
                                            <p></p>
                                            <p>
                                                Se você procura um lugar único para acampar, está no lugar certo, pois o Pico do Rinoceronte tem atrativos que o colocam entre os lugares mais incríveis que já acampamos. 
                                                A vista panorâmica da serra, a formação rochosa que lembra o animal que dá nome ao local e as belíssamas paisagens compostas por rios e campos pelo caminho formam um cenário quase de filme, 
                                                sendo um ótimo lugar para trilhas e acampamentos.
                                            </p>
                                            <p></p>
                                            <div class="list-buttons">
                                                <a href="{{ ('bom-jardim-da-serra/campings/selvagem/camping-pico-do-rinoceronte') }}" class="button-one button-blue">LER MAIS</a>                                        
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
                                            <h2 class="cidade-list"><a>Garuva</a></h2>
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
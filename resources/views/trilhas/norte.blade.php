@extends('layouts.blog')

@section('pageTitle', "TRILHAS EM FLORIANÓPOLIS" )
@section('description', 'Essa região é conhecida pelas praias de mar calmo e água um pouco mais quente. Abriga praias famosas como Daniela e Jurerê Internacional, além dos balneários que já formam cidades isoladas dentro da ilha, como Ingleses e Canasvieiras.' )

@section('content')
  <!--Blog Post Area Start-->
        <div class="blog-post-area section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                        <div class="single-blog-post blog-post-details">
                            <div class="single-blog-post-img">
                                <a href="#"><img src="http://trilhasemsc.com.br/public/img/trilhas/detalhes-principal/trilha-do-morro-das-aranhas.jpg" alt=""></a>
                                <div class="date-time">
                                    <span class="date">15</span>
                                    <span class="month">JUN</span>
                                </div>
                            </div>
                            <div class="single-blog-post-text">
                                <h4>
                                    Trilhas no Norte de Florianópolis
                                </h4>
                                <div class="author-comments">
                                    <span style="color: white; background: orange" class="badge badge-secondary">Edição Especial</span>
                                    <span><i class="fa fa-user"></i>Robson Fernando Duda</span>
                                    <span><i class="fa fa-comment"></i>0</span>
                                </div>

                                <div id="descricao">

                                    <p>
                                        Quem procura trilhas pela cidade de Florianópolis certamente acaba sendo atraído para a região sul da Ilha. Isso é natural, pois além da região possuir uma natureza muito rica e exuberante, também abriga uma das principais trilhas da cidade: a Trilha da Lagoinha do Leste. 
                                    </p>
                                    <p>
                                        Mas engana-se quem acha que as trilhas da cidade limitam-se apenas a essa região. Pelo contrário, elas estão espalhadas pela ilha toda.
                                    </p>
                                    <p>
                                        Já fizemos nosso guia da região <strong><a href="{{ url('trilhas/florianopolis/regioes/leste') }}" >leste</a></strong> e agora vamos falar um pouco das trilhas da região norte. 
                                    </p>
                                    <p>
                                        Essa região é conhecida pelas praias de mar calmo e água um pouco mais quente. Abriga praias famosas como Daniela e Jurerê Internacional, além dos balneários que já formam cidades isoladas dentro da ilha, como Ingleses e Canasvieiras.
                                    </p>
                                    <p>
                                        E claro, onde tem praia, tem trilha. Além do mais, a região também possui muitos morros e costões rochosos, que garantem boas caminhadas e roteiros.
                                    </p>
                                    <br/>
                                    <div>
                                        <h4>Trilha do Morro das Aranhas</h4>
                                        <p>
                                          Dessa vez, seguiremos até a Praia do Santinho, bem próximo ao resort do Costão do Santinho, de onde parte a nossa aventura. Nosso objetivo é subir o Morro das Aranhas e contemplar as belezas das praias da região, do alto nos mirantes naturais localizados na trilha. 
                                        </p>
                                        <a href="http://trilhasemsc.com.br/florianopolis/trilhas/leve/trilha-do-morro-das-aranhas"><img src="http://trilhasemsc.com.br/public/img/trilhas/detalhes-principal/trilha-do-morro-das-aranhas.jpg" alt=""></a>
                                       
                                        <a href="http://trilhasemsc.com.br/florianopolis/trilhas/leve/trilha-do-morro-das-aranhas">Leia Mais</a>
                                    </div>
                                    <br/>    
                                    <div>
                                        <h4>Caminho da Costa da Lagoa à Ratones</h4>
                                        <p>
                                            Essa é uma boa opção para quem está no norte da ilha, visto que a outra e mais famosa opção parte da Lagoa da Conceição. O que podemos dizer sobre a trilha que sai da Lagoa é que ela é mais longa, porém muito bonita.
                                        </p>
                                        <a href="http://trilhasemsc.com.br/florianopolis/trilhas/leve/caminho-da-costa-da-lagoa-a-ratones"><img src="http://trilhasemsc.com.br/public/img/trilhas/detalhes-principal/caminho-da-costa-da-lagoa-a-ratones.jpg" alt=""></a>
                                       
                                        <a href="http://trilhasemsc.com.br/florianopolis/trilhas/leve/caminho-da-costa-da-lagoa-a-ratones">Leia Mais</a>
                                    </div>
                                    <br/> 
                                    <div>
                                        <h4>Trilha do Santinho para o Moçambique</h4>
                                        <p>
                                            Achamos pertinente iniciar por ela, já que faz a ligação entre a região norte e a leste da ilha. Essa trilha pode ser feita em dois sentidos, iniciando pela Praia do Santinho, nesse caso a trilha se inicia no mesmo ponto onde começa a da Trilha do Morro das Aranhas. A outra opção é iniciar pela Praia do Moçambique, onde a trilha inicia no lado esquerdo e sobe margeando o costão.
                                        </p>
                                        <a href="https://trilhasemsc.com.br/florianopolis/trilhas/leve/trilha-do-santinho-para-mocambique"><img src="https://trilhasemsc.com.br/public/img/trilhas/detalhes-principal/trilha-do-santinho-para-o-mocambique.jpg" alt=""></a>
                                       
                                        <a href="https://trilhasemsc.com.br/florianopolis/trilhas/leve/trilha-do-santinho-para-mocambique">Leia Mais</a>
                                    </div>
                                    <br/>     
                                    <div>
                                        <h4>Trilha da Praia do Forte para Daniela (Vista de Jurerê)</h4>
                                        <p>
                                            Muitas pessoas conhecem a pequena trilha que liga a Praia do Forte à Praia da Daniela. Uma pequena trilha que segue mais próxima da areia e facilita a vida de quem quer visitar as duas praias a pé. Mas essa trilha é diferente! Ela faz a ligação pela parte superior e possui uma bela vista da Praia de Jurerê Internacional, Jurerê e Daniela.
                                        </p>
                                        <a href="http://trilhasemsc.com.br/florianopolis/trilhas/leve/trilha-da-praia-do-forte-para-daniela-vista-jurere"><img src="http://trilhasemsc.com.br/public/img/trilhas/detalhes-principal/trilha-da -praia-do-forte-para-daniela.jpg" alt=""></a>
                                       
                                        <a href="http://trilhasemsc.com.br/florianopolis/trilhas/leve/trilha-da-praia-do-forte-para-daniela-vista-jurere">Leia Mais</a>
                                    </div>
                                    <br/>    
                                    <div>
                                        <h4>Caminho do Morro das Feiticeiras (Caminho de Santiago de Compostela em Florianópolis)</h4>
                                        <p>
                                            Que tal fazer parte do Caminho de Santiago de Compostela, sem precisar sair do Brasil? E o melhor, ainda poder tomar um banho de mar depois de terminar o percurso! Essa é a proposta dessa trilha, que fica localizada no norte da ilha de Florianópolis e faz a ligação entre a Praia Brava e a Praia dos Ingleses.
                                        </p>
                                        <a href="http://trilhasemsc.com.br/florianopolis/trilhas/leve/caminho-do-morro-das-feiticeiras"><img src="http://trilhasemsc.com.br/public/img/trilhas/detalhes-principal/caminho-do-morro-das-feiticeiras.jpg" alt=""></a>
                                       
                                        <a href="http://trilhasemsc.com.br/florianopolis/trilhas/leve/caminho-do-morro-das-feiticeiras">Leia Mais</a>
                                    </div>
                                    <br/>  
                                    <div>
                                        <h4>Trilha dos Ingleses para Praia Brava</h4>
                                        <p>
                                            O norte da ilha de Florianópolis também conta com trilhas de belas paisagens. Essa, que liga a Praia dos Inlgeses a Praia Brava é um convite para quem quer apreciar o belo mar azul e as formações rochosas no meio do caminho. 
                                        </p>
                                        <a href="http://trilhasemsc.com.br/florianopolis/trilhas/moderada/trilha-ingleses-praia-brava"><img src="http://trilhasemsc.com.br/public/img/trilhas/detalhes-principal/trilha-ingleses-praia-brava.jpeg" alt=""></a>                                       
                                        <a href="http://trilhasemsc.com.br/florianopolis/trilhas/moderada/trilha-ingleses-praia-brava">Leia Mais</a>
                                    </div>
                                    <br/>        
                                    <div>
                                        <h4>Trilha do Morro do Rapa</h4>
                                        <p>
                                            Hoje vamos falar um pouco sobre as trilhas do norte da Ilha de Florianópolis, especificamente sobre a Trilha do Morro do Rapa, que liga a Praia Brava à Praia da Lagoinha do Norte. O principal atrativo dessa trilha é o belíssimo mirante com vista panorâmica da Praia Brava, por onde iniciamos a aventura!
                                        </p>
                                        <a href="http://trilhasemsc.com.br/florianopolis/trilhas/leve/trilha-do-morro-do-rapa"><img src="http://trilhasemsc.com.br/public/img/trilhas/detalhes-principal/trilha-do-morro-do-rapa.jpg" alt=""></a>                                       
                                        <a href="http://trilhasemsc.com.br/florianopolis/trilhas/leve/trilha-do-morro-do-rapa">Leia Mais</a>
                                    </div>
                                    <br/>    
                                    <div>
                                        <h4>Trilha da Barra do Sambaqui</h4>
                                        <p>
                                            Com certeza um dos belos espetáculos naturais de Florianópolis é o pôr-do-sol e nós sempre buscamos ter a melhor vista e o melhor ângulo para apreciá-lo. O mais perfeito é quando conseguimos unir um local ideal para ver esse espetáculo no fim do dia, com uma trilha. Se também gosta disso, leia nossa dica sobre a Trilha da Barra do Sambaqui. 
                                        </p>
                                        <a href="https://trilhasemsc.com.br/florianopolis/trilhas/passeio/trilha-da-barra-do-sambaqui"><img src="https://trilhasemsc.com.br/public/img/trilhas/detalhes-principal/trilha-da-barra-do-sambaqui.jpg" alt=""></a>                                       
                                        <a href="https://trilhasemsc.com.br/florianopolis/trilhas/passeio/trilha-da-barra-do-sambaqui">Leia Mais</a>
                                    </div>
                                    <br/>                                                                      
                                </div>
                            </div>
                            <div class="blog-button-links">
                                <div class="blog-links">
                                <div class="fb-share-button" data-href="{{ Request::fullUrl() }}" data-layout="button" data-size="large"><a target="_blank" class="fb-xfbml-parse-ignore">Compartilhar</a></div>
                                </div>
                            </div>
                        </div>
                       
                    </div>  
                    <div class="col-md-3">
                        <div class="sidebar-widget">
                            <div class="single-sidebar-widget">
                                <h4>PESQUISAR <span>Trilha</span></h4>
                                <form id="text-search" action="{{url('trilhas/#lista')}}" >
                                    <input type="text" name="termo" placeholder="Digite aqui">
                                    <button class="submit"><i class="fa fa-search"></i></button>
                                </form>
                            </div>
                            <div class="clearfix"></div>
                            <div class="single-sidebar-widget country-select">
                                <h4>BUSCA POR <span>Cidade</span></h4>
                                <ul class="widget-categories">
                                    @foreach($busca_cidade as $busca)
                                        <li><a href="{{url(stringToStringSeo($busca->cidade->nm_cidade_cde).'/trilhas/#lista')}}">{{ $busca->cidade->nm_cidade_cde }}<span>({{ $busca->total }})</span></a></li>
                                    @endforeach
                                </ul>
                            </div>
    
                            <div style="display: none" class="col-lg-12 col-md-12 col-sm-12" style="min-height: 570px; background: #f1f1f1;">
                                <div class="box-publicidade-detalhes">
                                    <span>PUBLICIDADE</span>
                                </div>
                            </div>                                
                        </div>
                    </div>     
                </div>
            </div>
        </div>
        <!--End of Blog Post Area -->
@endsection
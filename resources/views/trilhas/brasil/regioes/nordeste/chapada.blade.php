@extends('layouts.blog')

@section('pageTitle', "TRILHAS EM FLORIANÓPOLIS" )
@section('description', 'A cidade de Florianópolis, como todos sabem, é a capital do estado de Santa Catarina. Uma cidade ainda com ares de cidade pequena, onde com 20 minutos de carro, saímos do centro da cidade e chegamos até o bucólico Sertão do Ribeirão, por exemplo. ' )

@section('content')
  <!--Blog Post Area Start-->
        <div class="blog-post-area section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                        <div class="single-blog-post blog-post-details">
                            <div class="single-blog-post-img">
                                <a href="#"><img src="{{ asset('img/trilhas/brasil/nordeste/chapada/chapada.jpg') }}" alt=""></a>
                                <div class="date-time">
                                    <span class="date">29</span>
                                    <span class="month">JUN</span>
                                </div>
                            </div>
                            <div class="single-blog-post-text">
                                <h4>
                                    Chapada Diamantina
                                </h4>
                                <div class="author-comments">
                                    <span style="color: white; background: orange" class="badge badge-secondary">Trilhas do Brasil</span>
                                    <span><i class="fa fa-user"></i>Robson Fernando Duda</span>
                                    <span><i class="fa fa-comment"></i>0</span>
                                </div>

                                <div id="descricao">
                                    <h4>Mirante do Pati e Igrejinha</h4>
                                    <p>
                                        Travessia do Vale do Pati (1/5) <br/>
                                        Distância do dia: 9,5 km<br/>
                                        Distância acumulada: 9,5 km
                                    </p>
                                    <p>
                                        Foram dias de ansiedade até a chegada da travessia e seu início guardava uma grande expectativa, afinal, seriam 5 dias trilhando, sem contato com o mundo externo e somente com o objetivo de finalizar os aproximadamente 55 quilômetros dessa jornada. Nesse momento fomos apresentados ao nosso guia Carlito e seguimos para enfrentar a subida do paredão e ter acesso aos campos do Gerais do Rio Preto e conhecer o belíssimo Mirante do Pati, local onde fomos apresentados ao vale que nos abrigaria em todos esses dias de caminhada. Na chegada ao mirante, fomos alertados sobre a presença de duas cobras no local: uma cascavel e uma coral. Sinal de má sorte? Pelo contrário, foi apenas um sinal da abundante vida animal que se estende por todo o vale.
                                    </p>
                                    <p>
                                        Ao final desse dia, descansamos na Igrejinha, recepcionados pelo Sr. João. Chegamos juntos com parte das mercadorias que abastecem o vale e são transportadas em lombos de mulas. Sim, mulas. O acesso a essa região é muito difícil e o abastecimento é feito dessa maneira. Foi uma recepção amiga e carinhosa.
                                    </p>
                                    <img src="{{ asset('img/trilhas/brasil/nordeste/chapada/mirante_do_pati.jpg') }}" alt="">
                                    <br/><br/>
                                    <h4>O Cachoeirão</h4>
                                    <p>
                                        Travessia do Vale do Pati (2/5) <br/>
                                        Distância do dia: 15,7 km<br/>
                                        Distância acumulada: 25,2 km
                                    </p>
                                    <p>
                                        O objetivo desse dia era caminhar pelas Gerais do Rio Preto e conhecer o imponente Cachoeirão. Com aproximadamente 280 metros de altura, ele é um dos atrativos existentes nesse grande abismo, que também possui vários mirantes e uma vista muito bonita do vale. 
                                    </p>
                                    <p>
                                        Alguns mirantes são mais desafiadores que os outros, mas são um convite para fazer belos registros e contemplar as belezas presentes ali. Um pouco acima do local da queda da água, tem um ponto onde é possível tomar um banho de rio e fazer um lanche com calma. E mesmo ali, entre vários quilômetros de caminhada, éramos mais uma vez surpreendidos pelos lanches montados pelo Carlito. O capricho e a variedade eram certos nesses momentos de reposição de energia.
                                    </p>
                                    <img src="{{ asset('img/trilhas/brasil/nordeste/chapada/cachoeirao_por_cima.jpg') }}" alt="">
                                    <br/><br/>
                                    <h4>Morro do Castelo</h4>
                                    <p>
                                        Travessia do Vale do Pati (3/5)<br/>
                                        Distância do dia: 7,8 km<br/>
                                        Distância acumulada: 33 km
                                    </p>                                    
                                    <p>
                                        Com certeza a parte mais difícil desse dia foi despedir-se da Igrejinha e das pessoas maravilhosas que conhecemos ali. João, nosso anfitrião, foi excepcional. O carinho e as refeições que recebemos ali foram um capítulo à parte nessa jornada que foi o Vale do Pati. 
                                    </p>
                                    <p>
                                        Dali, seguimos para a casa de Agnaldo, que seria nossa próxima parada para pernoite. A chegada foi rápida, pois tínhamos um grande desafio neste dia: subir o Morro do Castelo. Essa seria a trilha mais íngreme e também a mais difícil, não só pela inclinação, mas pela lama acumulada no caminho, que deixa o trajeto mais difícil. Mas a subida e a dificuldade compensam. Somos recepcionados por uma grande caverna que dá acesso aos dois mirantes que visitamos nesse dia. Apesar do dia um pouco nublado, a vista foi muito bonita.
                                    </p>
                                    <img src="{{ asset('img/trilhas/brasil/nordeste/chapada/morro_do_castelo.jpg') }}" alt="">
                                    <br/><br/>
                                    <h4>Poção da Árvore e Encontro das Águas</h4>
                                    <p>
                                        Travessia do Vale do Pati (4/5)<br/>
                                        Distância do dia: 11,9 km<br/>
                                        Distância acumulada: 44,9 km
                                    </p>
                                    <p>
                                        Esse foi o dia de caminhada e banhos de cachoeiras. Tivemos o privilégio de trilhar acompanhando o curso do rio e conhecer dois pontos de encontro entre os rios da região. Nos banhamos no Poção da Árvore e conhecemos o encontro dos rios Pati e Calixto. Descendo no sentido da nossa próxima parada de pernoite, conhecemos também o encontro dos rios Calixto e Cachoeirão.   
                                    </p>
                                    <p>
                                        No fim do dia, o maior presente: a luz da tarde na Ladeira do Império. Pudemos ver o paredão gigante pintado de laranja com a luz do sol, formando uma bela pintura. Além desse presente, também conhecemos o Seu Jóia, mais um dos incríveis personagens desta aventura. Junto com Dona Leu e sua família, recebem ali os aventureiros abrindo não só a sua casa, mas também seu baú de histórias e sua infinita simpatia, nos fazendo sentir-se em casa. Essa energia foi fundamental para enfrentar a longa subida e a distância do último dia de trilha.
                                    </p>
                                    <img src="{{ asset('img/trilhas/brasil/nordeste/chapada/cachoeira.jpg') }}" alt="">
                                    <br/><br/>
                                    <h4>Ladeira do Império e Serra do Ramalho</h4>
                                    <p>
                                        Travessia do Vale do Pati (5/5) <br/>
                                        Distância do dia: 11,5 km <br/>
                                        Distância acumulada: 56,4 km
                                    </p>
                                    <p>
                                        Como parte da jornada também é o fim (eu sei, é clichê), chegamos ao nosso último dia de caminhada. Esse é um dia mais tenso, com cara de jornada final. Isso tudo pela expectativa da subida da Ladeira do Império e da descida da Serra do Ramalho. Agora o belo paredão que nos recepcionou no fim do quarto dia, nos desafiou a vencer seus mais de 400 metros de desnível. Foram numerosas as histórias contadas a nós, sobre as dificuldades, choros e lutas de quem tentou encarar esse desafio sem o devido preparo. Mas para nós, o maior desafio do dia era deixar o Vale para trás. 
                                    </p>
                                    <p>
                                        Nesses dias por lá, pudemos conhecer paisagens únicas, plantas exóticas e ser surpreendidos por diferentes cantos e cores das aves. Aliás, os pássaros são um capítulo que merece destaque. A região é muito rica em beija-flores, sendo que foram catalogadas ali mais de 23 espécies. Além, claro, do exclusivo beija-flor de gravata vermelha, espécie encontrada somente no Pati. Pudemos ver vários, mas esse não tivemos o privilégio. 
                                    </p>
                                    <p>
                                        Foram 5 dias não só de caminhada, mas de experiência de vida. Conhecemos belas paisagens naturais, mas o mais importante foram as pessoas que encontramos ali. Cada morador que nos recebeu e acolheu com sua simplicidade e carinho serão lembrados de forma muito especial. 
                                    </p>
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
@extends('layouts.blog')

@section('pageTitle', 'Camping Vale da Utopia' )

@section('description', 'Sabe aqueles lugares que parecem saídos de filmes, que te levam a uma viagem no tempo? Esse é o caso do Vale da Utopia, pequeno vale localizado na cidade de Palhoça. O vale fica localizado entre a Praia da Pinheira e a Praia da Guarda do Embaú e faz parte do Parque Estadual da Serra do Tabuleiro. O vale é coberto por uma grama verdinha e abriga a pequena Praia do Maço, que permite além do camping, também um gostoso banho de mar.' )

@section('content')
        <div class="blog-post-area section-padding">
            <div class="container">                
                <div class="row">
                    <div class="col-md-9">
                        <div class="single-blog-post blog-post-details">
                            <div class="single-blog-post-img">
                                <a href="#"><img src="{{ asset('img/camping/vale-da-utopia/capa.jpg') }}" alt="Vista panorâmica Vale da Utopia"></a>
                            </div>
                            <div class="single-blog-post-text">
                                <h4>Camping Vale da Utopia</h4>
                                <div class="author-comments">
                                    <span><i class="fa fa-user"></i>Robson Fernando Duda</span>
                                </div>
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
                                <br />
                                <p>
                                    Sabe aqueles lugares que parecem saídos de filmes, que te levam a uma viagem no tempo? Esse é o caso do Vale da Utopia, pequeno vale localizado na cidade de <a class="link" href="{{ url('palhoca/trilhas#lista') }}">Palhoça</a>. O vale fica localizado entre a Praia da Pinheira e a Praia da Guarda do Embaú e faz parte do Parque Estadual da Serra do Tabuleiro. O vale é coberto por uma grama verdinha e abriga a pequena Praia do Maço, que permite além do camping, também um gostoso banho de mar. 
                                </p>
                                <p>
                                    O local do camping é uma propriedade privada, sob os cuidados do Sr. Mema que é o proprietário do local. Ele não mora ali, mas diarimante faz uma "ronda" pelo vale conversando com os campistas e verificando quem vai acampar, pois para o camping é cobrada uma taxa de R$ 25,00 por pessoa (atualizado em janeiro de 2020). Você não pecisa fazer reserva para acampar lá, pois é nessa verificação do proprietário que ele faz a cobrança. A taxa da direito ao acesso ao espaço e utilização da infraestrutura do local. Mas não espere muito, o camping é rústico! Ele possui dois chuveiros com água doce para banho, mas a água é fria. Também tem apenas um banheiro para uso coletivo. Mas isso não é problema, afinal o foco do camping é o local, que é fantástico.
                                </p>
                                <p>
                                    Para chegar ao vale tem duas opções, ambas via trilha. A primeira é pela Praia da Pinheira. Essa é um trilha leve, onde a maior dificuldade é subir um pequeno morro, mas como a distância é pequena, vale a pena para quem está com muito equipamento. Com mais ou menos 1,5km de extensão é possível chegar ao vale em aproximadamente 30 minutos. Na rua que da acesso a trilha existe um estacionamento que além das diárias, também aceita pernoite. Ideal para quem vai de carro e não quer se preocupar. Logo depois de vencer o morro o trilheiro irá se deparar com um pequeno portão e uma placa indicando sobre o valor do camping e contato com o responsável, como dito acima.
                                </p>
                                <p>
                                    A outra forma de acesso é pela praia da Guarda do Embaú. Nesse caso, a trilha se inicia na praia, no caminho que segue margeando o morro à esquerda. Essa é uma trilha mais longa, mas com paisagens fantásticas. Quem procura uma boa trilha antes do camping, essa é a melhor opção. Pela Guarda o percurso tem em torno de 5km e leva em torno de 1:45 para ser concluída. Nesse caso, para quem está de carro, a opção é utilizar algum dos estacionamentos localizados na praia.
                                </p>
                                <p>
                                    Agora que explicamos como chegar, vamos aos detalhes do camping. Existem muitas opções de onde ficar, pois o vale é grande. Recomendamos ficar nos espaços atrás das cercas, pois no pasto existem algumas vacas curiosas que podem vir até a barraca. Falando nelas, tenha muito cuidado com seu lixo, principalmente sacolas, pois os animais podem ingerir. 
                                </p>
                                <div class="box_img">
                                    <h5>Animais do Vale da Utopia</h5>
                                    <img src="{{ asset('img/camping/vale-da-utopia/animais.jpg') }}" alt="Animais no Vale da Utopia">
                                    <legend class="border-none"><strong>Foto</strong>: Robson Fernando Duda</legend>
                                </div>
                                <p>
                                    Como mencionado, o camping possui possibilidade de banhos frios em chuveiros de água doce. Essa água vem das nascentes existentes no local e também pode ser usada para a limpeza de utensílios de camping, mas não possui tratamento para ser consumida, então leve água potável, por segurança. Sempre que for se bahnar ou lavar sua louça, evite o uso de sabão e detergente, preserve a natureza!
                                </p>
                                <div class="box_img">
                                    <h5>Banheiros para banho</h5>
                                    <img src="{{ asset('img/camping/vale-da-utopia/banheiros.jpg') }}" alt="Banheiros no Vale da Utopia">  
                                    <legend class="border-none"><strong>Foto</strong>: Robson Fernando Duda</legend>                                
                                </div>
                                <p>
                                    Acredito que com essas dicas é possível você organizar o camping de maneira adequada e se preocupar apenas em aproveitar! O lugar é lindo e tem uma energia muito boa. Claro que a principal dica é acordar cedinho e curtir o nascer do sol! 
                                </p>
                                <div class="box_img">
                                    <h5>Nascer do Sol no Vale da Utopia</h5>
                                    <img src="{{ asset('img/camping/vale-da-utopia/sunrise.jpg') }}" alt="Nascer do Sol Vale da Utopia">
                                    <legend class="border-none"><strong>Foto</strong>: Viviane dos Santos</legend>
                                </div>
                                <h5><strong>Texto</strong>: Robson Fernando Duda</h5>
                            </div>
                            <h4 class="center"><a class="link" href="{{ url('/') }}">Voltar para o início</a></h4>
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
    
                            <div class="col-lg-12 col-md-12 col-sm-12" style="min-height: 570px; background: #f1f1f1;display: none">
                                <div class="box-publicidade-detalhes">
                                    <span>PUBLICIDADE</span>
                                </div>
                            </div>                                
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
@extends('layouts.blog')

@section('pageTitle', 'Camping Mirante' )

@section('description', 'Camping Mirante é uma fazenda, propriedade particular, que abre suas porteiras para receber visitantes em seu camping. Possui estrutura com chuveiros, banheiros e uma coxinha coletiva.' )

@section('content')
        <div class="blog-post-area section-padding">
            <div class="container">                
                <div class="row">
                    <div class="col-md-9">
                        <div class="single-blog-post blog-post-details">
                            <div class="single-blog-post-img">
                                <a href="#"><img src="https://trilhasemsc.com.br/public/img/trilhas/detalhes-principal/trilha-do-bananal.jpg" alt="Vista panorâmica Mirante da Ponte Anita Garibaldi"></a>
                            </div>
                            <div class="single-blog-post-text">
                                <h4>Camping Mirante da Ponte Anita Garibaldi</h4>
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
                                    <p class="text-danger"><i class="fa fa-trash" aria-hidden="true"></i> Não jogue lixo</p>
                                    <p class="text-success"><i class="fa fa-leaf" aria-hidden="true"></i> Proteja a natureza e os animais selvagens</p>
                                </p>
                                
                                <p><strong>Como Chegar</strong></p>
                                <p>
                                    O local da trilha é a cidade de Laguna. Logo, é necessário seguir até lá e dirigir-se até a propriedade privada onde fica o camping. 
                                    Você pode buscar pela Trilha do Bananal para se orientar em relação a isso.  
                                </p>
                                <p>
                                    Basicamente é necessário seguir via BR-101 e entrar no acesso do bairro Bananal. Segue por uma estrada marginal até entrar em uma estrada de chão.
                                </p>
                                <p>
                                    Caso deseje conhecer o caminho da entrada da propriedade até o camping, pode utilizar o relato que fizemos sobre a trilha, que está disponivel <a href="https://trilhasemsc.com.br/laguna/trilhas/leve/trilha-do-bananal">aqui</a>.
                                </p>
                                <p><strong>Estrutura</strong></p>
                                <p>
                                    
                                </p>
                                <div class="box_img">
                                    <h5>Barraca e rede com vista para a Ponte Anita Garibaldi</h5>
                                    <img src="{{ url('public/img/camping/camping-mirante-anita-garibaldi/barraca_rede_camping.jpg') }}" alt="Barraca e rede com vista para a Ponte Anita Garibaldi">
                                    <legend class="border-none"><strong>Foto</strong>: Robson Fernando Duda</legend>
                                </div>
                                <p><strong>Valores</strong></p>
                                <p>
                                    Existem diferentes valores para ter acesso à propriedade e eles dependem do tipo de transporte utilizado. Logo na entrada da propriedade existe uma placa indicando esses valores.
                                </p> 
                                <div class="box_img">
                                    <h5>Placa de valores para o Mirante da Ponte Anita Garibaldi</h5>
                                    <img src="{{ url('public/img/camping/camping-mirante-anita-garibaldi/valores.jpeg') }}" alt="Valores para o Mirante da Ponte Anita Garibaldi">
                                    <legend class="border-none"><strong>Foto</strong>: Robson Fernando Duda</legend>
                                </div>
                                <p>
                                    Com toda certeza ao chegar no local do camping, a primeira coisa que pensamos é em como será o narcer e o pôr do sol.
                                    No dia que fomos, o céu estava aberto e esses dois eventos tiveram boa visibilidade. O legal é que o sol nasce logo atrás da ponte, garantindo uma vista linda.
                                </p>
                                <div class="box_img">
                                    <h5>Nascer do sol na Ponte Anita Garibaldi</h5>
                                    <img src="{{ url('public/img/camping/camping-mirante-anita-garibaldi/nascer_do_sol.jpg') }}" alt="Nascer do sol na Ponte Anita Garibaldi">
                                    <legend class="border-none"><strong>Foto</strong>: Robson Fernando Duda</legend>
                                </div>
                                <p><strong>Considerações Finais</strong></p>
                                <p>
                                    Para facilitar a sua ida, trouxemos também um pequeno resumo, que pode te ajudar bastante em relação ao que esperar do camping.
                                </p>                
                                <section>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <caption>Quadro Resumido - Detalhes do Camping</caption>
                                            <thead>
                                                <tr>
                                                    <th scope="col"></th>
                                                    <th>Item</th>
                                                    <th scope="col">Resposta</th>
                                                    <th scope="col">Descrição</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><i class="fa fa-car" aria-hidden="true"></i></td>
                                                    <td>Estacionamento</td>
                                                    <td>Sim</td>
                                                    <td>
                                                        Existem duas opções possíveis em relação ao estacionamento. Você pode subir com o carro até o local do camping ou deixar o carro no início da propriedade e subir os pouco mais de 1500 metros à pé.
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><i class="fa fa-tint" aria-hidden="true"></i></td>
                                                    <td>Hidratação</td>
                                                    <td>Sim</td>
                                                    <td>Apesar de existir um pequeno riacho no caminho, a água não é própria para consumo. Também não existem torneiras no local.</td>
                                                </tr>
                                                <tr>
                                                    <td><i class="fa fa-bath" aria-hidden="true"></i></td>
                                                    <td>Banho</td>
                                                    <td>Não</td>
                                                    <td>
                                                        Não existe estrutura de banheiros para banho 
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><i class="fa fa-cutlery" aria-hidden="true"></i></td>
                                                    <td>Restaurante</td>
                                                    <td>Não</td>
                                                    <td>Melhor levar toda comida e bebeida necessária, pois o local não conta com nenhuma estrutura nesse sentido</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </section>                               
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
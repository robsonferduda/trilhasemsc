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
                                                        O camping possui estacionamento próprio que já está incluso na taxa de camping e também pode ser usado pelos visitantes que procuram o local apenas para conhecer. 
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><i class="fa fa-tint" aria-hidden="true"></i></td>
                                                    <td>Hidratação</td>
                                                    <td>Sim</td>
                                                    <td>Não é necessário levar água, pois o camping possui água nos espaços comuns utilizados pelos campistas.</td>
                                                </tr>
                                                <tr>
                                                    <td><i class="fa fa-bath" aria-hidden="true"></i></td>
                                                    <td>Banho</td>
                                                    <td>Sim</td>
                                                    <td>
                                                        Até a escrita deste relato, existem dois banheiros no camping. Eles são equipados com chuveiros com água aqueida e sanitários.
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><i class="fa fa-fire" aria-hidden="true"></i></td>
                                                    <td>Fogueiras</td>
                                                    <td>Sim</td>
                                                    <td>
                                                        As fogueiras são permitidas, mas claro, tomando todo o cuidado e utilizando os espaços já definidos para esse fim. 
                                                        No local é possível comprar lenha. 
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><i class="fa fa-cutlery" aria-hidden="true"></i></td>
                                                    <td>Restaurante</td>
                                                    <td>Sim</td>
                                                    <td>Os proprietários da fazenda utilizam a sua casa como espaço para vender algumas bebidas e saborosos pastéis, que são fritos na hora.</td>
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
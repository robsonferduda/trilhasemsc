@extends('layouts.blog')

@section('pageTitle', 'Camping Mirante do Alto da Boa Vista' )

@section('description', 'Localizado no munícipio catarinense de Rancho Queimado, o Mirante Alto da Boa Vista é uma ótima opção de camping' )

@section('content')
        <div class="blog-post-area section-padding">
            <div class="container">                
                <div class="row">
                    <div class="col-md-9">
                        <div class="single-blog-post blog-post-details">
                            <div class="single-blog-post-img">
                                <a href="#"><img src="{{ asset('img/camping/alto-da-boa-vista/capa.jpg') }}" alt="Vista panorâmica do Mirante da Boa Vista"></a>
                            </div>
                            <div class="single-blog-post-text">
                                <h4>Camping Mirante do Alto da Boa Vista</h4>
                                <div class="author-comments">
                                    <span><i class="fa fa-user"></i>Robson Fernando Duda</span>
                                </div>
                                <p>
                                    <p class="text-danger"><i class="fa fa-ban" aria-hidden="true"></i> Não jogue lixo na natureza</p>
                                </p>
                                <p>
                                    Se você está na região da Grande Florianópolis e procura um lugar bonito para acampar, mas que não exija muito esforço físico, encontrou uma ótima opção. O Mirante do Alto da Boa Vista fica localizado no município de Rancho Queimado, conhecido como a Capital Catarinense do Morango.
                                    Distante 60km de Florianópolis, a pequena cidade de colonização alemã é muito procurada pelas suas fazendas e pousadas. 
                                </p>
                                <p>
                                    Mas o mirante não está localizado próximo ao centro da cidade, na verdade ele está a mais ou menos 27km da regiçao central, às margens da SC-282. Conhecida na região, a estrada é sinuosa e possui pista simples, então cuidado. Mas o asfalto garante um trajeto 
                                    tranquilo até o local. Apenas a subida até o alto do planalto é um pouco ruim, pois é uma estrada de chão com boa inclinação. Com a estrada seca foi bem tranquilo, mesmo com carro baixo. Talvez com chuva a subida se torne mais difícil. 
                                </p>
                                <p>
                                    Chegando na propriedade existe uma bilheteria onde é cobrada a taxa de R$ 10,00 por pessoa para camping. O local não possui uma estrutura muito elaborada para o camping, mas conta com alguns banheiros químicos espalhados pelas enorme área de camping.
                                </p>
                                <p>
                                    Como dito, esse camping não exige esforço físico, pois pode-se chegar de carro até um dos vários locais de camping. Lógico, isso não impede de fazer uma caminhada pelo local, que é muito bonito. 
                                    Mas em resumo é isso, um belo local para uma primeira experiência de camping. Abaixo trazemos um pequeno resumo do que seria relevante ao planejar sua aventura.
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
                                                    <td><i class="fa fa-dollar" aria-hidden="true"></i></td>
                                                    <td>Possui Tarifa</td>
                                                    <td>Sim</td>
                                                    <td>O valor cobrado é de R$ 10,00 por pessoa</td>
                                                </tr>
                                                <tr>
                                                    <td><i class="fa fa-car" aria-hidden="true"></i></td>
                                                    <td>Estacionamento</td>
                                                    <td>Sim</td>
                                                    <td>Na verdade praticamente todos os locais de camping pode-se chegar de carro e deixar ele estacionado ali, sendo permitido transitar e estacionar próximo ao local do camping</td>
                                                </tr>
                                                <tr>
                                                    <td><i class="fa fa-tint" aria-hidden="true"></i></td>
                                                    <td>Hidratação</td>
                                                    <td>Não</td>
                                                    <td>Não encontramos pontos naturais ou artificiais de hidratação, mas como não existe necessidade de trilha, é possível levar água suficiente no carro</td>
                                                </tr>
                                                <tr>
                                                    <td><i class="fa fa-bath" aria-hidden="true"></i></td>
                                                    <td>Banho</td>
                                                    <td>Não</td>
                                                    <td>Não possui chuveiros para banho</td>
                                                </tr>
                                                <tr>
                                                    <td><i class="fa fa-fire" aria-hidden="true"></i></td>
                                                    <td>Fogueiras</td>
                                                    <td>Sim</td>
                                                    <td>Nos pontos de camping, existem muitos locais onde é possível fazer fogo. inclusive existe a possibilidade de comprar lenha na entrada do camping. Mas isso não impede que você leve sua lenha consigo</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </section>

                                <p>
                                    Estar no Alto da Boa Vista é como caminhar por um cartão-postal. No inverno a grama parcialmente queimada pelo frio forma campos dourados que ficam muito bonitos e iluminados com o sol do fim de tarde. 
                                </p>
                               
                                <div class="box_img">
                                    <h5>Campos no planalto do mirante</h5>
                                    <img src="{{ asset('img/camping/alto-da-boa-vista/campos.jpg') }}" alt="Campos do Mirante Alto da Boa Vista">
                                    <legend class="border-none"><strong>Foto</strong>: Robson Fernando Duda</legend>
                                </div>

                                <p>
                                    Quando fomos até o camping, o tempo estava muito bom. Tínhamos expectativa de um belo fim de tarde e também nascer do sol. A região é alta e com amplos campos, isso geralmente proporciona belos registros. O nascer do sol não foi como esperado, 
                                    mas o final de tarde foi sensacional. Esse foi um dos registros feitos por nós.
                                </p>

                                <div class="box_img">
                                    <h5>Pôr do Sol</h5>
                                    <img src="{{ asset('img/camping/alto-da-boa-vista/fim_de_tarde.jpg') }}" alt="Pôr do Sol no Mirante Alto da Boa Vista">
                                    <legend class="border-none"><strong>Foto</strong>: Robson Fernando Duda</legend>
                                </div>
                               
                                <h5><strong>Texto</strong>: Robson Fernando Duda</h5>
                            </div>
                            <h4 class="center"><a class="link" href="{{ url('/') }}">Voltar para o início</a></h4>
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
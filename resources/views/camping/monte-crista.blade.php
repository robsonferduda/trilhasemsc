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
                                <a href="#"><img src="{{ asset('img/camping/vale-da-utopia/capa.jpg') }}" alt="Vista panorâmica Monte Crista"></a>
                            </div>
                            <div class="single-blog-post-text">
                                <h4>Camping Monte Crista</h4>
                                <div class="author-comments">
                                    <span><i class="fa fa-user"></i>Robson Fernando Duda</span>
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
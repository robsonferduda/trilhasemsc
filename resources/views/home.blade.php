@extends('layouts.app')

@section('content')
 <!--Service Area Start-->
        <div class="skills-area section-bottom-padding">
            <div class="container"> 
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title text-center">
                            <div class="title-border">
                                <h1>NOSSAS <span>AVENTURAS</span></h1>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row hidden-md hidden-lg">
                    <h2>Acompanhe nossas aventuras pelas trilhas, campings e praias por todo estado de Santa Catarina</h2>
                </div>

                <div class="row hidden-xs hidden-sm">
                    <div class="col-md-4 col-sm-6">
                        <div class="single-skill-item">
                            <div class="single-skill-icon">
                                <div class="skill-bg"></div>
                                <div class="skill-border-left"></div>
                                <img alt="" src="{{ asset('img/icon/skill-1.png') }}" class="primary-img">
                                <img alt="" src="{{ asset('img/icon/skill-1-hover.png') }}" class="secondary-img">
                                <div class="skill-border-right"></div>
                            </div>
                            <div class="single-skill-text">
                                <h4>TRILHAS</h4>
                                <h3><span class="counter">7</span></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="single-skill-item low">
                            <div class="single-skill-icon">
                                <div class="skill-bg"></div>
                                <div class="skill-border-left"></div>
                                <img alt="" src="{{ asset('img/icon/skill-2.png') }}" class="primary-img">
                                <img alt="" src="{{ asset('img/icon/skill-2-hover.png') }}" class="secondary-img">
                                <div class="skill-border-right"></div>
                            </div>
                            <div class="single-skill-text">
                                <h4>GALERIAS</h4>
                                <h3><span class="counter">8</span></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 hidden-sm">
                        <div class="single-skill-item medium">
                            <div class="single-skill-icon">
                                <div class="skill-bg"></div>
                                <div class="skill-border-left"></div>
                                <img alt="" src="{{ asset('img/icon/skill-3.png') }}" class="primary-img">
                                <img alt="" src="{{ asset('img/icon/skill-3-hover.png') }}" class="secondary-img">
                                <div class="skill-border-right"></div>
                            </div>
                            <div class="single-skill-text">
                                <h4>CAMPING</h4>
                                <h3><span class="counter">3</span></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End of Service Area-->

        <!--Blog Area Start-->
        <div class="blog-area section-padding">
            <div class="container">              
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title text-center">
                            <div class="title-border">
                                <h1>Últimas <span>TRILHAS</span></h1>
                            </div>
                            <p>Acompanha nossas últimas trilhas por Santa Catarina</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="blog-carousel">
                        <div class="col-md-6">
                            <div class="single-blog hover-effect">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <div class="blog-image box-hover">
                                            <a href="blog-details.html"><img src="{{ asset('img/blog/trilha_do_gravata_florianopolis.jpeg') }} " alt=""></a>
                                            <div class="date-time">
                                                <span class="date">20</span>
                                                <span class="month">JUN</span>
                                            </div>
                                        </div>
                                        <div class="blog-link">
                                            <a href="#"><i class="fa fa-facebook"></i></a>
                                            <a href="#"><i class="fa fa-twitter"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 margin-left">
                                        <div class="blog-text">
                                            <h4><a href="{{ url('florianopolis/trilhas/trilha-do-gravata') }}">Trilha do Gravatá </a></h4>
                                            <p>Essa trilha encontra-se em Florianópolis no morro que separa a Lagoa da Conceição da Praia Mole, ela dá acesso a pequena praia do Gravatá. A trilha é uma das queridinhas dos iniciantes, pois tem um nível de dificuldade leve.</p>
                                            <a href="{{ url('florianopolis/trilhas/trilha-do-gravata') }}" class="button-one">Leia Mais</a>
                                        </div>
                                    </div>
                                </div>
                            </div>    
                        </div>
                        <div class="col-md-6">
                            <div class="single-blog hover-effect no-margin">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <div class="blog-image box-hover">
                                            <a href="blog-details.html"><img src="{{ asset('img/blog/trilha_do_funil_bom_jardim_da_serra.jpeg') }}" alt=""></a>
                                            <div class="date-time">
                                                <span class="date">20</span>
                                                <span class="month">JUN</span>
                                            </div>
                                        </div>
                                        <div class="blog-link">
                                            <a href="#"><i class="fa fa-facebook"></i></a>
                                            <a href="#"><i class="fa fa-twitter"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 margin-left">
                                        <div class="blog-text">
                                            <h4><a href="blog-details.html">Trilha do Cânion do Funil</a></h4>
                                            <p>Sabe aquelas paisagens de tirar o fôlego? Esse é o caso do Cânion do Funil. E não estou falando pela distância da trilha, são quase 15 km de ida e volta, mas sim pelo visual que parece de cinema!</p>
                                            <a href="blog-details.html" class="button-one">Leia Mais</a>
                                        </div>
                                    </div>
                                </div>
                            </div>    
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End of Blog Area-->
       
        <!--Newsletter Area Start-->
        <div class="newsletter-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-4 col-sm-12">
                        <div class="section-title text-center">
                            <div class="title-border">
                                <h1 class="text-white">INSCREVA-SE PARA <span>NOVIDADES</span></h1>
                            </div>    
                            <p class="text-white">Buscamos sempre as melhores trilhas e dicas para você,<br> acompanhe nossas aventuras</p>
                        </div>
                        <form action="#" method="post" id="newsletter">
                            <div class="newsletter-content">
                                <div class="row">
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                        <input type="text" name="email" placeholder="Informe seu email">
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <button type="submit" class="button"><span>VAMOS NESSA</span></button>
                                    </div>
                                </div>  
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--End of Newsletter Area-->

         <!--Best Sell Area Start-->
        <div class="best-sell-area section-padding" style="background: #edecec;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title text-center">
                            <div class="title-border">
                                <h1>PRINCIPAIS <span>AVENTURAS</span></h1>
                            </div>    
                            <p>As melhores trilhas na opinião dos nossos aventureiros. <br/> Escolha a sua preferida você também!</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="sell-text-container">
                            <div class="title-container">
                                <h3>PATROCINADO</h3>
                                <div style="min-height: 130px;">
                                    <h1>ANUNCIE AQUI!</h1>
                                </div>
                            </div>                            
                        </div>
                        <div class="row">
                            <div class="best-sell-slider carousel-style-one">
                                <div class="col-md-3">
                                    <div class="hover-effect">
                                        <div class="box-hover">
                                            <a href="#">
                                                <img src="{{ asset('img/sell/trilha_galheta.jpg') }}" alt="">
                                                <span>Galheta</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="hover-effect">
                                        <div class="box-hover">
                                            <a href="#" class="no-margin">
                                                <img src="{{ asset('img/sell/trilha_tatu.jpg') }}" alt="">
                                                <span>Cambirela</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="hover-effect">
                                        <div class="box-hover">
                                            <a href="#">
                                                <img src="{{ asset('img/sell/trilha_pedra_branca.jpg') }}" alt="">
                                                <span>Palhoça</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="hover-effect">
                                        <div class="box-hover">
                                            <a href="#" class="no-margin">
                                                <img src="{{ asset('img/sell/trilha_cafe.jpg') }}" alt="">
                                                <span>Lagoinha</span>
                                            </a>
                                        </div>
                                    </div>        
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 hidden-sm">
                        <img src="{{ asset('img/sell/trilha_dolmen_da_oracao_destaque.jpeg') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
        <!--End of Best Sell Area-->
        
        
        <!--Partner Area Start-->
        <div class="partner-area section-bottom-padding">
            <div class="container">          
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title text-center">
                            <div class="title-border">
                                <br/><br/><h1>NOSSOS <span>Parceiros</span></h1>
                            </div>    
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="partner-carousel carousel-style-two">
                        <div class="col-md-3">
                            <a href="#"><img src="img/brand/1.jpg" alt=""></a>
                        </div>
                        <div class="col-md-3">
                            <a href="#"><img src="img/brand/2.jpg" alt=""></a>
                        </div>
                        <div class="col-md-3">
                            <a href="#"><img src="img/brand/3.jpg" alt=""></a>
                        </div>
                        <div class="col-md-3">
                            <a href="#"><img src="img/brand/4.jpg" alt=""></a>
                        </div>
                        <div class="col-md-3">
                            <a href="#"><img src="img/brand/1.jpg" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End of Partner Area-->
@endsection

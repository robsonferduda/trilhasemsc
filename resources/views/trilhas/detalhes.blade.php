@extends('layouts.blog')

@section('content')
  <!--Blog Post Area Start-->
        <div class="blog-post-area section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="sidebar-widget">
                            <div class="single-sidebar-widget">
                                <h4>PESQUISAR <span>Trilha</span></h4>
                                <form id="text-search" action="#">
                                    <input type="text" placeholder="Digite aqui">
                                    <button class="submit"><i class="fa fa-search"></i></button>
                                </form>
                            </div>
                            <div class="clearfix"></div>
                            <div class="single-sidebar-widget country-select">
                                <h4>Selecione a <span>Cidade</span></h4>
                                <ul class="widget-categories">
                                    <li><a href="#">Florianópolis <span>(10)</span></a></li>
                                </ul>
                            </div>
                            <div class="single-sidebar-widget">
                                <h4>Últimas <span>AVENTURAS</span></h4>
                                <div class="single-widget-posts">
                                    <div class="post-img">
                                        <a href="#"><img src="{{ asset('img/blog/trilha_cafe.jpg') }}" alt=""></a>
                                    </div>
                                    <div class="posts-text">
                                        <h4><a href="#">Trilha da Lagoinha do Leste | Florianópolis</a></h4>
                                        <p><i class="fa fa-clock-o"></i> May 27, 2015</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="single-blog-post blog-post-details">
                            <div class="single-blog-post-img">
                                <a href="#"><img src="{{ asset('img/blog/trilha_do_gravata_blog.jpeg') }}" alt=""></a>
                                <div class="date-time">
                                    <span class="date">20</span>
                                    <span class="month">JUN</span>
                                </div>
                            </div>
                            <div class="single-blog-post-text">
                                <h4>Trilha do Gravatá </h4>
                                <div class="author-comments">
                                    <span><i class="fa fa-user"></i>Rafael de Moraes Costa</span>
                                    <span><i class="fa fa-comment"></i>0 Comentŕaios</span>
                                </div>
                                <p>
                                    Essa trilha encontra-se em Florianópolis no morro que separa a Lagoa da Conceição da Praia Mole, ela dá acesso a pequena praia do Gravatá. 
                                </p>
                                <p>
                                    A trilha é uma das queridinhas dos iniciantes, pois tem um nível de dificuldade leve, maior parte do caminho é de trânsito fácil e tem uma duração de aproximadamente 30 minutos e percurso de 1.4 km. 
                                    Para os amantes de fotografia, durante a trilha é possível encontrar algumas paradas que proporcionam fotos incríveis. 
                                </p>
                                <h5><strong>Percurso:</strong> 1.4 km</h5>
                                <h5><strong>Tempo do percurso:</strong> 1.4 km</h5>
                                <h5><strong>Cidade:</strong> Florianópolis</h5>

                            </div>
                            <div class="blog-button-links">
                                <span class="blog-tags">Tags: <a href="#">Florianópolis,</a> <a href="#">Gravatá,</a> <a href="#">Trilha Curta,</a> <a href="#">Trilha Fácil</a></span>
                                <div class="blog-links">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="blog-comments">
                           <h4 class="blog-title">COMENTÁRIOS DOS <span>TRILHEIROS</span></h4>
                           <h6>Nenhum comentário disponível</h6>
                        </div>
                        <div class="leave-comment">
                            <h4 class="blog-title">FAZER UM <span>COMENTÁRIO</span></h4>
                            <form action="#" method="post" id="comment">
                                <div class="comment-form">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <label class="required">Nome</label>
                                            <input type="text" name="name" value="">
                                            <label class="required">Email</label>
                                            <input type="email" name="email" value="">
                                            <label>Assunto</label>
                                            <input type="text" name="subject" value="">
                                        </div>
                                        <div class="col-md-7">
                                            <label>Comentário</label>
                                            <textarea rows="12" name="enquiry"></textarea>
                                        </div>
                                    </div>
                                    <input type="submit" class="comment-btn" value="Enviar Comentário">
                                </div>
                            </form>
                        </div>
                    </div>       
                </div>
            </div>
        </div>
        <!--End of Blog Post Area -->
@endsection
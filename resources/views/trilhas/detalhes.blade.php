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
                                        <li><a href="{{url('trilhas/?cidade='.$busca->cidade->cd_cidade_cde.'#lista')}}">{{ $busca->cidade->nm_cidade_cde }}<span>({{ $busca->total }})</span></a></li>
                                    @endforeach
                                </ul>
                            </div>
    
                            <div class="col-lg-12 col-md-12 col-sm-12" style="min-height: 570px; background: #f1f1f1;">
                                <div class="box-publicidade-detalhes">
                                    <span>PUBLICIDADE</span>
                                </div>
                            </div>                                
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="single-blog-post blog-post-details">
                            <div class="single-blog-post-img">
                                @php 
                                    $img = ($trilha->foto->where('id_tipo_foto_tfo',5)->first()) ? $trilha->foto->where('id_tipo_foto_tfo',5)->first()->nm_path_fot : 'padrao.jpg';
                                    $alt = ($trilha->foto->where('id_tipo_foto_tfo',5)->first()) ? $trilha->foto->where('id_tipo_foto_tfo',5)->first()->dc_alt_fot : 'Foto Principal da Trilha';
                                @endphp
                                <a href="#"><img src="{{ asset('img/trilhas/detalhes-principal/'.$img) }}" alt="{{ $alt }}"></a>
                                <div class="date-time">
                                    <span class="date">{{ \Carbon\Carbon::parse($trilha->created_at)->format('d') }}</span>
                                    <span class="month">{{ strtoupper(\Carbon\Carbon::parse($trilha->created_at)->format('M')) }}</span>
                                </div>
                            </div>
                            <div class="single-blog-post-text">
                                <h4>{{ $trilha->nm_trilha_tri }}</h4>
                                <div class="author-comments">
                                    <span><i class="fa fa-user"></i>{{ $trilha->user->name }}</span>
                                    <span><i class="fa fa-comment"></i>0 Comentŕaios</span>
                                </div>
                                {!! $trilha->ds_trilha_tri !!}
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
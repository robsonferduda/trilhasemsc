@extends('layouts.blog')

@section('pageTitle', $trilha->nm_trilha_tri )
@section('description', strip_tags(html_entity_decode(substr($trilha->ds_trilha_tri, 0, strpos($trilha->ds_trilha_tri, chr(10) ) - 1))) )

@section('content')
  <!--Blog Post Area Start-->
        @php 
            $img = ($trilha->foto->where('id_tipo_foto_tfo',5)->first()) ? $trilha->foto->where('id_tipo_foto_tfo',5)->first()->nm_path_fot : 'padrao.jpg';
            $alt = ($trilha->foto->where('id_tipo_foto_tfo',5)->first()) ? $trilha->foto->where('id_tipo_foto_tfo',5)->first()->dc_alt_fot : 'Foto Principal da Trilha';
        @endphp

        <div class="blog-post-area section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                        <div class="single-blog-post blog-post-details">
                            <div class="single-blog-post-img">
                                <a href="#"><img src="{{ asset('img/trilhas/detalhes-principal/'.$img) }}" alt="{{ $alt }}"></a>
                                <div class="date-time">
                                    <span class="date">{{ \Carbon\Carbon::parse($trilha->created_at)->format('d') }}</span>
                                    <span class="month">{{ strtoupper(\Carbon\Carbon::parse($trilha->created_at)->format('M')) }}</span>
                                </div>
                            </div>
                            <div class="single-blog-post-text">
                                <h4>
                                    {{ $trilha->nm_trilha_tri }}
                                </h4>
                                <div class="author-comments">
                                    <span style="color: white; background: {{ ($trilha->nivel) ? $trilha->nivel->dc_color_nivel_niv : '#989898' }};" class="badge badge-secondary">{{ $trilha->nivel->dc_nivel_niv }} {{ ($trilha->complemento) ? " - ".$trilha->complemento->nm_complemento_nivel_con : '' }}</span>
                                    <span><i class="fa fa-user"></i>{{ $trilha->user->name }}</span>
                                    <span><a href="https://www.instagram.com/trilhasemsc/?hl=pt-br" target="_BLANK" style="color: #696969;"><i class="fa fa-instagram" aria-hidden="true"></i>@trilhasemsc</a></span>
                                    <span class="text-info">Última atualização em {{ \Carbon\Carbon::parse($trilha->created_at)->format('d/m/Y') }}</span>
                                    {{--<span><i class="fa fa-comment"></i>{{ $trilha->comentarios->count() }} {{ ($trilha->comentarios->count() == 1) ? 'comentário' : 'comentários' }}</span>--}}
                                    
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
                                <div id="descricao">
                                    {!! $trilha->ds_trilha_tri !!}
                                </div>

                                <div style="text-align: center;">
                                    <p>Grau de dificuldade</p>
                                    <img src="{{ asset('img/trilhas/nivel/'.$trilha->nivel->dc_icone_niv) }}" alt="Grau de dificuldade da trilha {{ $trilha->nivel->dc_nivel_niv }}">
                                    <p><strong>{{ $trilha->nivel->dc_nivel_niv }} {{ ($trilha->complemento) ? " - ".$trilha->complemento->nm_complemento_nivel_con : '' }}</strong></p>
                                    <p><a class="link" href="{{ url('guia-de-dificuldade-em-trilhas') }}">Saiba mais sobre o grau de dificuldade</a></p>
                                </div>

                                {!! $trilha->url_geolocalizacao_tri !!}
                            </div>
                            <div class="blog-button-links">
                                <span class="blog-tags">Tags: 
                                    @forelse($trilha->tags as $tag)
                                        <a href="{{url('trilhas/tag/'.stringToStringSeo($tag->ds_tag_tag).'#lista')}}">{{ $tag->ds_tag_tag }}</a>
                                    @empty
                                        <a href="#">Nenhuma</a>
                                    @endforelse
                                </span>
                                <div class="blog-links">
                                <div class="fb-share-button" data-href="{{ Request::fullUrl() }}" data-layout="button" data-size="large"><a target="_blank" class="fb-xfbml-parse-ignore">Compartilhar</a></div>
                                </div>
                            </div>
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
                        {{--
                        <div class="blog-comments" id="comentarios">
                           <h4 class="blog-title">COMENTÁRIOS DOS <span>TRILHEIROS</span></h4>

                           @guest

                                <h4>Você deve estar logado para fazer comentários. <a href="{{ route('login') }}">Clique aqui</a> e acesse sua conta!</h4><br/>

                           @else
                                
                                <div class="leave-comment" style="margin-top: -20px; margin-bottom: 15px;">
                                    {!! Form::open(['id' => 'frm_comentario', 'url' => ['comentario/novo'], 'method' => 'POST']) !!}
                                        <input type="hidden" name="id_trilha_tri" value="{{ $trilha->id_trilha_tri }}">
                                        <div class="comment-form">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label style="text-transform: uppercase;">Fazer comentário como <strong>{{ Auth::user()->name }}</strong></label>
                                                    <textarea rows="12" name="comentario_com" id="comentario_com"></textarea>
                                                </div>
                                            </div>
                                            <input type="submit" class="comment-btn" value="Enviar Comentário">
                                        </div>
                                    {!! Form::close() !!}
                                </div>
                                @include('layouts.mensagens')

                           @endguest

                           <hr/>
                           @forelse($trilha->comentarios as $comentario)
                                <div class="single-comment">
                                    <div class="author-image">
                                        <img style="max-width: 80%;" src="{{ asset('img/usuarios/perfil.png') }}" alt="">
                                    </div>
                                    <div class="comment-text">
                                        <div class="author-info">
                                            <h4><a href="#"><strong>{{ $comentario->usuario->name }}</strong></a></h4>
                                            <!-- <span class="reply"><a href="#"><i class="fa fa-thumbs-up"></i>Curtir</a></span> -->
                                            <span class="comment-time">{{ \Carbon\Carbon::parse($comentario->created_at)->diffForHumans(\Carbon\Carbon::now()) }}</span>
                                        </div>
                                        <p>{!! $comentario->comentario_com !!}</p>
                                    </div>
                                </div>
                           @empty
                                <h6>Nenhum comentário disponível</h6>
                           @endforelse
                        </div>--}}
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
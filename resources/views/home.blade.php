@extends('layouts.app')

@section('pageTitle','Trilhas em Santa Catarina')
@section('content')

        <div class="blog-two-area section-padding">
            <div class="container">              
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title text-center">
                            <div class="title-border">
                                <br/><br/><h2 class="h2-section">CADASTRO DE <span class="h2-section-span">CONDUTORES</span></h2>
                            </div>    
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 justificado">
                        <p>
                            O Trilhasemsc surgiu com o objetivo de compartilhar conteúdo sobre trilhas para trilheiros. Em nosso site, todos os relatos são de trilhas que conhecemos e fizemos. 
                        </p>
                        <p>
                            Com o crescimento do site e principalmente do perfil no Instagram, as interações e mensagens aumentaram e um tema sempre é constante: trilhas guiadas.
                        </p>
                        <p>
                            Como não somos habilitados para a tarefa de condução em trilhas e queremos levar a melhor experiências para nossos seguidores, convidamos vocês Condutores de Trilhas e Caminhadas e Condutores Ambientais a fazerem o cadastro em nossa página e serem encontrados por todas essas pessoas que buscam profissionais qualificados para iniciar suas aventuras no mundo das trilhas ou mesmo os trilheiros mais experientes, que buscam orientação em trilhas difíceis e desconhecidas.
                        </p>
                        <div class="center">
                            <a href="https://forms.gle/S21P1v4imm3rX7KG7" class="button-one button-yellow">Cadastre-se Aqui</a>
                        </div>
                        <!--
                        <p>
                            Olá trilheiros (as), como vão, tudo bem? É um prazer tê-los por aqui acompanhando nossa missão, que não é uma das mais fáceis, mas faremos o melhor! Para que tenhamos êxito, cabe a vocês a leitura, a crítica e também as sugestões, pois estamos abertos a elas. Mas qual é essa missão? Queremos apresentar Santa Catarina por meio de suas trilhas! Tá, nem é tão difícil assim, pois imaginem só percorrer as trilhas desse belo estado e poder compartilhar tudo com vocês. A dificuldade está em transmitir todas as sensações, visões e sentimentos que essas aventuras proporcionam, mas vamos tentar.
                        </p>
                        <p>
                            Santa Catarina é um estado diverso. De norte a sul e de leste a oeste podemos ter desde verões de 40 ºC em nossas belas praias até invernos de temperaturas negativas, inclusive com neve, em nossos planaltos e serras! Partindo de Florianópolis, vamos tentar mostrar para vocês um pouco das belezas no nosso estado e também guiá-los caso queiram seguir nossos passos. O objetivo é descrever as trilhas, os caminhos e os acessos para que seja possível para cada um de vocês planejar e conhecer as mesmas trilhas que nós. E sempre que fizerem isso, compartilhem conosco! Vamos criar uma grande comunidade de trilheiros, catarinenses ou não, mas todos com o mesmo objetivo: desbravar as belezas da nossa SC.

                        </p>
                        <p>
                            Sabe aquela vontade e ao mesmo tempo medo de fazer a primeira trilha? Ou aquela dúvida se ela é segura? Vamos te ajudar nisso! Todas as trilhas que traremos aqui são trilhas que fizemos e vivemos todas as experiências para poder compartilhar da forma mais precisa possível. Será que eu aguento? Como chegar até o início da trilha? Onde deixar o carro? Traremos um guia de dificuldade para poder ajudá-los e vamos contar  passo a passo como fizemos tudo. A ideia é que a única preocupação que vocês devem ter é não ter preocupação alguma, afinal trilha é para relaxar, para curtir a natureza e ter boas histórias para contar! 
                        </p>
                        <p>
                            Agradecemos se leu até aqui! As próximas leituras serão mais empolgantes, pois trarão nelas os detalhes e imagens de Santa Catarina em trilhas!
                        </p>
                        --!>
                        <br />
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
            </div>
        </div>

        @include('trilhas.componentes.ultima_trilha')
        
         <!--Best Sell Area Start-->
        <div class="best-sell-area section-padding" style="background: #ffffff;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title text-center">
                            <div class="title-border">
                                <h2 class="h2-section">AVENTURAS <span class="h2-section-span">FAVORITAS</span></h2>
                            </div>    
                            <p>As trilhas favoritas na opinião dos nossos aventureiros. <br/> Escolha sua preferida você também!</p>
                        </div>
                    </div>                    
                </div>
                <div class="row">
                    <div class="col-md-6">

                        <div class="row">
                            <div class="best-sell-slider carousel-style-one">

                                @foreach($preferidas->slice(1) as $key => $trilha)

                                    @php 
                                        $img = ($trilha->foto->where('id_tipo_foto_tfo',1)->first()) ? $trilha->foto->where('id_tipo_foto_tfo',1)->first()->nm_path_fot : 'padrao.jpg';
                                        $alt = ($trilha->foto->where('id_tipo_foto_tfo',1)->first()) ? $trilha->foto->where('id_tipo_foto_tfo',1)->first()->dc_alt_fot : 'Miniatura da Trilha';
                                    @endphp

                                    @if($key%2 == 1)
                                        <div class="col-md-3">
                                    @endif

                                        <div class="hover-effect">
                                            <p class="titulo_trilha_destaque">{{ $trilha->nm_trilha_tri }}</p>
                                            <div class="box-hover">
                                                <a href="{{ url($trilha->ds_url_tri) }}">
                                                    <img src="{{ asset('img/trilhas/destaque-pequena/'.$img) }}" alt="{{ $alt }}">
                                                    <span>{{ $trilha->cidade->nm_cidade_cde }}</span>
                                                </a>
                                            </div>
                                        </div>

                                    @if($key%2 == 0)
                                        </div>
                                    @endif

                                @endforeach
                                
                            </div>
                        </div>
                        <!-- Horizontal Tela Detalhes Trilha -->
                        <ins class="adsbygoogle"
                            style="display:block"
                            data-ad-client="ca-pub-1229685353625953"
                            data-ad-slot="7739149091"
                            data-ad-format="auto"
                            data-full-width-responsive="true">
                        </ins>
                        <script>
                                (adsbygoogle = window.adsbygoogle || []).push({});
                        </script>
                        <div style="display: none" class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="box-publicidade-destaque">
                                    <span>PUBLICIDADE</span>
                                </div>
                            </div> 
                        </div>
                    </div>

                    @php
                        $trilha_destaque = $preferidas->shift();
                        $img_destaque = ($trilha_destaque->foto->where('id_tipo_foto_tfo',2)->first()) ? $trilha_destaque->foto->where('id_tipo_foto_tfo',2)->first()->nm_path_fot : 'padrao.jpg';
                        $alt_destaque = ($trilha_destaque->foto->where('id_tipo_foto_tfo',2)->first()) ? $trilha_destaque->foto->where('id_tipo_foto_tfo',2)->first()->dc_alt_fot : 'Miniatura da Trilha';
                    @endphp

                    <div class="col-md-6 hidden-sm">
                        <p class="titulo_trilha_destaque">{{ $trilha_destaque->nm_trilha_tri }}</p>
                        <a href="{{ url($trilha_destaque->ds_url_tri) }}"><img src="{{ asset('img/trilhas/destaque-principal/'.$img_destaque) }}" alt="{{ $alt_destaque }}"></a>
                    </div>
                    
                </div>
            </div>
        </div>

        @include('trilhas.componentes.contador')
    
        <div style="display: none;" class="partner-area section-bottom-padding">
            <div class="container">          
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title text-center">
                            <div class="title-border">
                                <br/><br/><h2 class="h2-section">INFORMES <span class="h2-section-span">PUBLICITÁRIOS</span></h2>
                            </div>    
                        </div>
                    </div>
                </div>
                <div class="row publicidade">
                    
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="box-publicidade">
                            <span>PUBLICIDADE</span>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="box-publicidade">
                            <span>PUBLICIDADE</span>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="box-publicidade">
                            <span>PUBLICIDADE</span>
                        </div>
                    </div>             

                </div>
            </div>
        </div>
@endsection
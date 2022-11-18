@extends('layouts.blog')
@section('content')
        <div class="blog-post-area section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title text-center">
                            <div class="title-border">
                                <br/><br/><h1>Grupos</h1>
                            </div>    
                        </div>
                    </div>                          
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <img class="img-fluid rounded mb-3 mb-md-0" src="{{ asset('img/grupos/familia_na_trilha.png') }}" alt="Logo Família na Trilha">
                    </div>
                    <div class="col-md-9">
                        <h3>Família na Trilha</h3>
                        <h4>Operadora de turismo de aventura</h4>
                        <p><strong>Cidade</strong>: Florianópolis</p>
                        <p><strong>Responsável</strong>: Claudia Tiscoski</p>
                        <p><strong>Contato</strong>: (48) 4141-0450</p>
                        <a class="btn btn-success" href="https://chat.whatsapp.com/GvvzWUySo9f00HGikK11kP"><i class="fa fa-whatsapp" aria-hidden="true"></i> Entrar no Grupo</a>
                    </div>
                </div>
                <hr/>
                <div class="row">
                    <div class="col-md-3">
                        <img class="img-fluid rounded mb-3 mb-md-0" src="{{ asset('img/grupos/litoral_trilhas.jpg') }}" alt="Logo Família na Trilha">
                    </div>
                    <div class="col-md-9">
                        <h3>Litoral Trilhas</h3>
                        <h4>Trilhas, Praias e Acampamentos</h4>
                        <p><strong>Cidade</strong>: Brusque</p>
                        <p><strong>Responsável</strong>: Rachel e Vilson </p>
                        <p><strong>Contato</strong>: (47) 98870-6304</p>
                        <a class="btn btn-success" href="https://chat.whatsapp.com/CFb4KMQ864NGhPZc0WmeKV"><i class="fa fa-whatsapp" aria-hidden="true"></i> Entrar no Grupo</a>
                    </div>
                </div>
                <hr/>
                <!--
                <div class="row">
                    <div class="col-md-3">
                        <img class="img-fluid rounded mb-3 mb-md-0" src="{{ asset('img/grupos/vibe_de_aventura.jpg') }}" alt="Logo Família na Trilha">
                    </div>
                    <div class="col-md-9">
                        <h3>Vibe de Aventura</h3>
                        <h4>A vida é uma estrada, aproveite o caminho!</h4>
                        <p><strong>Cidade</strong>: Palhoça</p>
                        <p><strong>Responsável</strong>: Leonardo</p>
                        <p><strong>Contato</strong>: (48) 98433-0946 </p>
                    </div>
                </div>
            -->
            </div>
        </div>
@endsection
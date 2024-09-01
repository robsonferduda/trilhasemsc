@extends('layouts.blog')

@section('pageTitle','Cadastro de Guias e Condutores')
@section('description', 'Guia de trilhas e camping em Santa Catarina, trazendo informações de localização, trajetos e grau de dificuldade para quem quer conhecer e desfrutar das praias, serras e montanhas desse belo estado do Sul do Brasil' )

@section('content')
    <div class="container">
        <div class="row justify-content-center" style="margin-top: 30px;">
            <div class="col-md-12">
                <div class="section-title text-center title-left">
                    <div class="title-border">
                        <h1>CADASTRO DE <span>GUIAS E CONDUTORES</span></h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="sign-in-container">
                    <h3>Preencha o cadastro</h3>
                    @include('layouts/mensagens')
                    <form action="{{ url('guias-e-condutores/cadastro') }}" method="post" >
                        @csrf
                        <div class="sign-in-form">


                            <label class="custom-radio-button__container">
                                <input type="radio" name="radio" checked="">
                                <span class="custom-radio-button designer">
                                  <svg class="svg-designer" xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 60 60">
                                    <g fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                                      <path stroke-width="2" d="M31.398606,25.2671756 C34.2197146,25.2671756 36.5429804,27.4244939 36.5429804,30.0796548 C36.708928,32.9007634 34.053767,35.2240292 31.0667109,35.2240292 L31.0667109,35.2240292 L23.2671756,35.2240292 L23.4631052,35.1603266 C25.0047129,34.6191835 25.9223365,33.3255891 25.9223365,31.5731829 L25.9223365,31.5731829 L25.9223365,30.41155 C25.9223365,27.5904414 28.41155,25.2671756 31.398606,25.2671756 Z M50.6299696,10.3875938 L50.7520743,10.4978427 C51.4158646,11.1616329 51.4158646,12.1573183 50.7520743,12.8211085 L36.3146366,28.2542317 L36.0744268,28.0778339 C35.3844837,26.6780138 33.996137,25.6380417 32.3389279,25.3484095 L32,25.101228 L48.2628609,10.4978427 C48.8876047,9.87309892 49.953344,9.83634929 50.6299696,10.3875938 Z"></path>
                                      <path stroke-width="2" d="M29.5731829,19.9568536 C17.6249585,19.9568536 8,26.5947561 8,34.8921341 C8,36.5516097 8.33189512,38.2110853 9.16163292,39.7046133 C10.8211085,43.0235646 15.1357451,44.0192499 18.1228012,41.8619316 C22.1055426,39.0408231 27.7477597,41.8619316 27.7477597,46.8403584 L27.7477597,49.8274145 C28.41155,49.8274145 28.9093926,49.8274145 29.5731829,49.8274145 C41.5214072,49.8274145 51.1463657,43.1895121 51.1463657,34.8921341 C51.1463657,31.2412878 49.3209426,27.9223365 46.3338865,25.4331231"></path>
                                    </g>
                                  </svg>
                                  Designer
                                </span>
                              </label>


                            <label>Nome</label>
                            <input id="name" type="text" class="form-box margin-form required @error('name') is-invalid @enderror" name="name" placeholder="Nome" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            <label>Email</label>
                            <input id="email" type="email" class="form-box  margin-form @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email">

                            <label>Senha</label>
                            <input id="password" type="password" class="form-box  margin-form @error('password') is-invalid @enderror" name="password"  placeholder="Senha" required autocomplete="new-password">

                            <label>Confirme a senha</label>
                            <input id="password-confirm" type="password" class="form-box margin-form " name="password_confirmation" placeholder="Confirmar Senha" required autocomplete="new-password">
                            {!! htmlFormSnippet() !!}
                            <input type="submit" class="submit-button btn-form" value="CADASTRAR">
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 center" style="margin-top: 50px;">
                <h3>Cadastre-se usando suas redes sociais</h3>
                <div class="sign-in-buttons">
                    <a href="{{ url('login/facebook') }}" class="facebook btn-facebook"><i class="fa fa-facebook"></i> Facebook</a>
                    <a href="{{ url('login/google') }}" class="google btn-google"><i class="fa fa-google"></i> Google</a>
                </div>
            </div>
        </div>
    </div>
@endsection
@extends('layouts.blog')

@section('pageTitle','Acesso')
@section('description', 'Guia de trilhas e camping em Santa Catarina, trazendo informações de localização, trajetos e grau de dificuldade para quem quer conhecer e desfrutar das praias, serras e montanhas desse belo estado do Sul do Brasil' )

@section('content')
<div class="container">
    <div class="row justify-content-center" style="margin-top: 30px;">
        <div class="col-md-12">
            <div class="section-title text-center title-left">
                <div class="title-border">
                    <h1>ACESSO <span>RESTRITO</span></h1>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6">
            <div class="sign-in-container">
                <h3>Já possui uma conta? Acesse aqui</h3>
                @include('layouts/mensagens')
                <form action="{{ route('login') }}" method="post" id="signin">
                    @csrf
                    <div class="sign-in-form">

                        <label>Email</label>
                        <input name="email" id="email" type="email" class="form-box margin-form required @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Email" required autocomplete="email" autofocus>

                        <label>Senha</label>
                        <input name="password" id="password" type="password" class="form-box margin-form required @error('password') is-invalid @enderror" placeholder="Senha" required autocomplete="current-password">

                        <div class="sign-in-settings">
{{--                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>--}}
{{--                            <span>Lembrar-me</span>--}}
                            <a href="{{ route('password.request') }}">Esqueceu sua senha?</a>
                        </div>
                        <input type="submit" class="submit-button btn-form" value="LOGIN">
                    </div>
                </form>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 center" style="margin-top: 50px;">
            <h3>Utilize suas redes sociais</h3>
            <div class="sign-in-buttons">
                <a href="{{ url('login/facebook') }}" class="facebook btn-facebook"><i class="fa fa-facebook"></i> Facebook</a>
                 <a href="{{ url('login/google') }}" class="google btn-google"><i class="fa fa-google"></i> Google</a>
            </div>
        </div>
    </div>
</div>
@endsection
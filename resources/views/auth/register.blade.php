@extends('layouts.blog')

@section('content')
<div class="container">
    <div class="row justify-content-center" style="margin-top: 30px;">
        <div class="col-md-12">
            <div class="section-title text-center title-left">
                <div class="title-border">
                    <h1>CADASTRO DE <span>TRILHEIRO</span></h1>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6">
            <div class="sign-in-container">
                <h3>Preencha o cadastro</h3>
                @include('layouts/mensagens')
                <form action="{{ route('register') }}" method="post" >
                    @csrf
                    <div class="sign-in-form">
                        <label>Nome</label>
                        <input id="name" type="text" class="form-box margin-form required @error('name') is-invalid @enderror" name="name" placeholder="Nome" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        
                        <label>Email</label>
                        <input id="email" type="email" class="form-box  margin-form @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email">

                        <label>Senha</label>
                        <input id="password" type="password" class="form-box  margin-form @error('password') is-invalid @enderror" name="password"  placeholder="Senha" required autocomplete="new-password">

                        <label>Confirme a senha</label>
                        <input id="password-confirm" type="password" class="form-box margin-form " name="password_confirmation" placeholder="Confirmar Senha" required autocomplete="new-password">
                        
                        <input type="submit" class="submit-button btn-form" value="CADASTRAR">
                    </div>
                </form>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 center" style="margin-top: 50px;">
            <h3>Cadastre-se usando suas redes sociais</h3>
            <div class="sign-in-buttons">
                <a href="{{ url('login/facebook') }}" class="facebook btn-facebook"><i class="fa fa-facebook"></i> Facebook</a>
            </div>
        </div>
    </div>
</div>
@endsection
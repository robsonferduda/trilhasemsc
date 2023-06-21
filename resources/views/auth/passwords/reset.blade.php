@extends('layouts.blog')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.site')
@section('pageTitle','Cadastro de Guias e Condutores')
@section('description', 'Guia de trilhas e camping em Santa Catarina, trazendo informações de localização, trajetos e grau de dificuldade para quem quer conhecer e desfrutar das praias, serras e montanhas desse belo estado do Sul do Brasil' )

@section('content')
<div class="row mt-n8 mb-5">
    <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
        <div class="card z-index-0">
           <div class="card-header text-center pt-4 mt-4">
              <h5>Recuperar Senha</h5>
           </div>
           <div class="card-body">
               @include('layouts/mensagens-novo')
                <form action="{{ route('login') }}" method="post" >
                    @csrf
                    <div class="mb-3">                    
                        <input name="email" id="email" type="email" class="form-control @error('name') is-invalid @enderror" value="{{ old('email') }}" placeholder="Email" required autocomplete="email" autofocus>
                    </div>
                    <div class="mb-3">    
                        <input name="password" id="password" type="password" class="form-control required @error('password') is-invalid @enderror" placeholder="Senha" required autocomplete="current-password">                
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn bg-gradient-dark w-40 my-4 mb-2">Login</button>
                    </div>
                 <p class="text-sm mt-3 mb-0 text-center">Esqueceu sua senha? <br/><a href="{{ route('password.request') }}" class="text-dark font-weight-bold text-decoration-underline-hover">Clique aqui</a></p>
                </form>
           </div>
        </div>
     </div>
</div>
@endsection
@extends('layouts.site')
@section('pageTitle','Cadastro de Guias e Condutores')
@section('description', 'Guia de trilhas e camping em Santa Catarina, trazendo informações de localização, trajetos e grau de dificuldade para quem quer conhecer e desfrutar das praias, serras e montanhas desse belo estado do Sul do Brasil' )

@section('content')
<div class="row mt-n8 mb-5">
    <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
        <div class="card z-index-0">
           <div class="card-header text-center pt-4 mt-4">
              <h5>Redefinir Senha</h5>
           </div>
           <div class="card-body">
               @include('layouts/mensagens-novo')
                <form action="{{ route('password.update') }}" method="post" >
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="mb-3">                    
                        <input name="email" id="email" type="email" class="form-control @error('name') is-invalid @enderror" value="{{ $email ?? old('email') }}" placeholder="Email" required autocomplete="email" autofocus>
                    </div>
                    <div class="mb-3">    
                        <input name="password" id="password" type="password" class="form-control required @error('password') is-invalid @enderror" placeholder="Senha" required autocomplete="current-password">                
                    </div>
                    <div class="mb-3">    
                        <input name="password_confirmation" id="password-confirm" type="password" class="form-control required @error('password-confirm') is-invalid @enderror" placeholder="Senha" required autocomplete="current-password">                
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn bg-gradient-dark w-40 my-4 mb-2">Redefinir Senha</button>
                    </div>
                </form>
           </div>
        </div>
     </div>
</div>
@endsection
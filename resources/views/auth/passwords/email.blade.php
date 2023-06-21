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
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <form action="{{ route('password.email') }}" method="post" >
                    @csrf
                    <div class="mb-3">                    
                        <input name="email" id="email" type="email" class="form-control @error('name') is-invalid @enderror" value="{{ old('email') }}" placeholder="Email" required autocomplete="email" autofocus>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn bg-gradient-dark w-40 my-4 mb-2">Recuperar Senha</button>
                    </div>
                </form>
           </div>
        </div>
     </div>
</div>
@endsection
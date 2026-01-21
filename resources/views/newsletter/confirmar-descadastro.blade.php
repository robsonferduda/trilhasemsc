@extends('layouts.site')

@section('content')
<div class="page-header section-height-50" style="background-image: url('{{ asset('img/bg-newsletter.jpg') }}')">
    <span class="mask bg-gradient-dark"></span>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-white text-center">
                <h2 class="text-white">Cancelar assinatura da Newsletter</h2>
                <p class="lead">Sentiremos sua falta! 😢</p>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow-lg">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <i class="fa fa-envelope-o fa-4x text-warning mb-3"></i>
                        <h4>Você tem certeza?</h4>
                    </div>
                    
                    <p class="text-center mb-4">
                        Olá, <strong>{{ $trilheiro->nm_trilheiro_tri }}</strong>!
                    </p>
                    
                    <p class="text-muted text-center mb-4">
                        Ao confirmar, você não receberá mais nossos emails com:
                    </p>
                    
                    <ul class="text-muted mb-4">
                        <li>Novas trilhas e campings em Santa Catarina</li>
                        <li>Dicas e novidades sobre trilhas</li>
                        <li>Eventos e encontros de trilheiros</li>
                        <li>Conteúdos exclusivos e promoções</li>
                    </ul>
                    
                    <div class="alert alert-info text-center">
                        <small><i class="fa fa-info-circle"></i> Você pode se reinscrever a qualquer momento acessando seu perfil.</small>
                    </div>
                    
                    <form action="{{ route('newsletter.unsubscribe', ['trilheiro' => $trilheiro->id_trilheiro_tri, 'token' => $token]) }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="motivo" class="form-label text-muted">
                                <small>Quer nos dizer o motivo? (opcional)</small>
                            </label>
                            <textarea class="form-control" id="motivo" name="motivo" rows="3" 
                                      placeholder="Ex: Recebo muitos emails, não tenho mais interesse, etc."></textarea>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-danger btn-lg mb-2">
                                <i class="fa fa-times"></i> Sim, cancelar minha assinatura
                            </button>
                            <a href="{{ url('/') }}" class="btn btn-outline-secondary btn-lg">
                                <i class="fa fa-arrow-left"></i> Não, voltar ao site
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

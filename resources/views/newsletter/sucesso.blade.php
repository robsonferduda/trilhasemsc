@extends('layouts.site')

@section('content')
<div class="page-header section-height-50" style="background-image: url('{{ asset('img/bg-newsletter.jpg') }}')">
    <span class="mask bg-gradient-success"></span>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-white text-center">
                <h2 class="text-white">Confirmação</h2>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow-lg">
                <div class="card-body p-4 text-center">
                    <i class="fa fa-check-circle fa-4x text-success mb-3"></i>
                    <h4 class="mb-4">{{ $mensagem }}</h4>
                    
                    @if(isset($trilheiro) && !$trilheiro->fl_newsletter_tri)
                        <p class="text-muted mb-4">
                            Você não receberá mais nossos emails. Se mudar de ideia, você pode se reinscrever.
                        </p>
                        
                        <div class="d-grid gap-2">
                            <a href="{{ route('newsletter.resubscribe', ['trilheiro' => $trilheiro->id_trilheiro_tri, 'token' => $trilheiro->getUnsubscribeToken()]) }}" class="btn btn-success btn-lg mb-2">
                                <i class="fa fa-envelope"></i> Reinscrever-me na newsletter
                            </a>
                            <a href="{{ url('/') }}" class="btn btn-outline-secondary btn-lg">
                                <i class="fa fa-home"></i> Voltar ao site
                            </a>
                        </div>
                    @else
                        <div class="d-grid gap-2">
                            <a href="{{ url('/') }}" class="btn btn-primary btn-lg">
                                <i class="fa fa-home"></i> Voltar ao site
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

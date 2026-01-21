@extends('layouts.site')

@section('content')
<div class="page-header section-height-50" style="background-image: url('{{ asset('img/bg-newsletter.jpg') }}')">
    <span class="mask bg-gradient-danger"></span>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-white text-center">
                <h2 class="text-white">Erro</h2>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow-lg">
                <div class="card-body p-4 text-center">
                    <i class="fa fa-exclamation-triangle fa-4x text-danger mb-3"></i>
                    <h4 class="mb-4">Ops! Algo deu errado</h4>
                    
                    <p class="text-muted mb-4">
                        {{ $mensagem ?? session('mensagem') ?? 'Ocorreu um erro ao processar sua solicitação.' }}
                    </p>
                    
                    <p class="text-muted mb-4">
                        Se você está tentando cancelar sua assinatura e continua tendo problemas, 
                        por favor entre em contato conosco.
                    </p>
                    
                    <div class="d-grid gap-2">
                        <a href="{{ url('/') }}" class="btn btn-primary btn-lg">
                            <i class="fa fa-home"></i> Voltar ao site
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

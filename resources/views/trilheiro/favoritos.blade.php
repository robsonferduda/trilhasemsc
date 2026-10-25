@extends('layouts.admin')
@section('pageTitle', 'Guias favoritos | Trilhas em SC')

@section('content')
    <div class="block-header">
        <div class="row">
            <div class="col-lg-8">
                <h2>Guias favoritos</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">Trilheiro</li>
                    <li class="breadcrumb-item">Favoritos</li>
                </ul>
            </div>
        </div>
    </div>
    @include('layouts.mensagens')
    <p class="text-muted">Quando um destes guias lançar um passeio, você recebe um aviso por e-mail.</p>
    <div class="card">
        <div class="body">
            @forelse($favoritos as $favorito)
                @php $guia = $favorito->guia; @endphp
                @if($guia)
                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                        <a href="{{ $guia->urlPublica() }}">{{ $guia->nm_guia_gui }}</a>
                        <form method="post" action="{{ url('trilheiro/privado/favoritar/'.$guia->id_guia_gui) }}">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-sm">Remover</button>
                        </form>
                    </div>
                @endif
            @empty
                <p class="mb-0">Você ainda não favoritou um guia. Abra um perfil e marque Favoritar.</p>
            @endforelse
        </div>
    </div>
@endsection

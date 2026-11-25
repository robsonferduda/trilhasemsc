@extends('layouts.admin')
@section('pageTitle', 'Galeria da retrospectiva | Trilhas em SC')

@section('content')
    <div class="block-header">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h2>Imagens da retrospectiva {{ $historia['ano'] }}</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">Trilheiro</li>
                    <li class="breadcrumb-item"><a href="{{ route('trilheiro.retrospectiva') }}">Retrospectiva</a></li>
                    <li class="breadcrumb-item">Galeria</li>
                </ul>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a class="btn btn-default" href="{{ route('trilheiro.retrospectiva') }}">Voltar aos slides</a>
            </div>
        </div>
    </div>

    <p class="text-muted">Cada imagem está no formato vertical de story. Baixe a que quiser publicar.</p>

    <div class="retro-grade">
        @foreach($historia['slides'] as $slide)
            <figure>
                <img src="{{ route('trilheiro.retrospectiva.imagem', $slide['id']) }}" alt="{{ $slide['rotulo'] }}" loading="lazy">
                <figcaption>
                    <strong>{{ $slide['rotulo'] }}</strong>
                    <a href="{{ route('trilheiro.retrospectiva.imagem', ['slide' => $slide['id'], 'download' => 1]) }}">Baixar</a>
                </figcaption>
            </figure>
        @endforeach
    </div>
@endsection

@section('script')
<style>
    .retro-grade {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        gap: 16px;
    }
    .retro-grade figure { margin: 0; }
    .retro-grade img {
        width: 100%;
        aspect-ratio: 9 / 16;
        object-fit: cover;
        border-radius: 16px;
        background: #14261e;
    }
    .retro-grade figcaption {
        display: flex;
        justify-content: space-between;
        gap: 8px;
        margin-top: 8px;
        font-size: 0.9rem;
    }
</style>
@endsection

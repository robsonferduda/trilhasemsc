@extends('layouts.admin')
@section('pageTitle', 'Retrospectiva | Trilhas em SC')

@section('content')
    <div class="block-header">
        <div class="row">
            <div class="col-lg-8">
                <h2>Retrospectiva {{ $historia['ano'] }}</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">Trilheiro</li>
                    <li class="breadcrumb-item">Retrospectiva</li>
                </ul>
            </div>
        </div>
    </div>

    <p class="text-muted">Passe os slides. As imagens da galeria saem no formato de story, para guardar ou publicar.</p>

    <div class="retro-palco">
        <div class="retro-story" id="retro-story">
            <div class="retro-progresso" id="retro-progresso">
                @foreach($historia['slides'] as $slide)
                    <span></span>
                @endforeach
            </div>
            @foreach($historia['slides'] as $indice => $slide)
                <article class="retro-slide {{ $indice === 0 ? 'is-active' : '' }}">
                    <p class="retro-kicker">{{ $slide['kicker'] }}</p>
                    <h3>{{ $slide['titulo'] }}</h3>
                    @foreach($slide['linhas'] as $linha)
                        <p>{{ $linha }}</p>
                    @endforeach
                    @if($slide['destaques'])
                        <div class="retro-destaques">
                            @foreach($slide['destaques'] as $item)
                                <div>
                                    <strong>{{ $item['valor'] }}</strong>
                                    <span>{{ $item['rotulo'] }}</span>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </article>
            @endforeach
            <button type="button" class="retro-zona retro-anterior" id="retro-anterior" aria-label="Slide anterior"></button>
            <button type="button" class="retro-zona retro-proximo" id="retro-proximo" aria-label="Próximo slide"></button>
        </div>
    </div>

    <p class="retro-ajuda">
        <a class="btn btn-primary" href="{{ route('trilheiro.retrospectiva.galeria') }}">Abrir a galeria de imagens</a>
    </p>
@endsection

@section('script')
<style>
    .retro-palco { display: flex; justify-content: center; margin: 8px 0 20px; }
    .retro-story {
        position: relative;
        width: min(380px, 100%);
        aspect-ratio: 9 / 16;
        border-radius: 28px;
        overflow: hidden;
        background: #14261e;
        color: #fff;
        box-shadow: 0 18px 40px rgb(20 38 30 / 0.18);
    }
    .retro-progresso { position: absolute; top: 14px; left: 14px; right: 14px; display: flex; gap: 4px; z-index: 2; }
    .retro-progresso span { flex: 1; height: 3px; border-radius: 99px; background: rgb(255 255 255 / 0.28); }
    .retro-progresso span.is-feita { background: #e07826; }
    .retro-slide {
        display: none;
        position: absolute;
        inset: 0;
        flex-direction: column;
        justify-content: flex-end;
        padding: 28px 24px 36px;
        background: linear-gradient(180deg, rgb(20 38 30 / 0.2) 0%, #14261e 72%);
    }
    .retro-slide.is-active { display: flex; }
    .retro-kicker { margin: 0 0 8px; color: #f0b27a; font-size: 0.78rem; letter-spacing: 0.04em; text-transform: uppercase; }
    .retro-slide h3 { margin: 0 0 10px; font-size: 1.7rem; line-height: 1.15; font-weight: 800; }
    .retro-slide p { margin: 0 0 8px; color: #e7f0ea; }
    .retro-destaques { display: grid; grid-template-columns: 1fr 1fr; gap: 12px 16px; margin-top: 12px; }
    .retro-destaques strong { display: block; font-size: 1.35rem; }
    .retro-destaques span { color: #f0b27a; font-size: 0.82rem; }
    .retro-zona { position: absolute; top: 0; bottom: 0; width: 50%; border: 0; background: transparent; z-index: 3; }
    .retro-anterior { left: 0; }
    .retro-proximo { right: 0; }
    .retro-ajuda { text-align: center; }
</style>
<script>
    (function () {
        var slides = Array.prototype.slice.call(document.querySelectorAll('#retro-story .retro-slide'));
        var marcas = Array.prototype.slice.call(document.querySelectorAll('#retro-progresso span'));
        var atual = 0;

        function mostrar(indice) {
            if (!slides.length) return;
            atual = (indice + slides.length) % slides.length;
            slides.forEach(function (slide, i) {
                slide.classList.toggle('is-active', i === atual);
            });
            marcas.forEach(function (marca, i) {
                marca.classList.toggle('is-feita', i <= atual);
            });
        }

        document.getElementById('retro-anterior').addEventListener('click', function () { mostrar(atual - 1); });
        document.getElementById('retro-proximo').addEventListener('click', function () { mostrar(atual + 1); });
        document.addEventListener('keydown', function (evento) {
            if (evento.key === 'ArrowRight') mostrar(atual + 1);
            if (evento.key === 'ArrowLeft') mostrar(atual - 1);
        });
        mostrar(0);
    })();
</script>
@endsection

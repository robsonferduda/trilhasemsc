<style>
    .grupo-miniatura {
        float: right;
        width: 72px;
        height: 72px;
        margin: 0 0 8px 12px;
        padding: 0;
        border: 0;
        border-radius: 8px;
        overflow: hidden;
        background: #e9ecef;
        box-shadow: 0 1px 4px rgba(0,0,0,.18);
        cursor: zoom-in;
    }
    .grupo-miniatura img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }
    .grupo-lightbox {
        position: fixed;
        inset: 0;
        z-index: 2000;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 24px;
        background: rgba(0,0,0,.82);
    }
    .grupo-lightbox[hidden] {
        display: none;
    }
    .grupo-lightbox img {
        max-width: min(960px, 100%);
        max-height: 86vh;
        border-radius: 8px;
        box-shadow: 0 8px 30px rgba(0,0,0,.4);
    }
    .grupo-lightbox-fechar {
        position: absolute;
        top: 16px;
        right: 16px;
        width: 40px;
        height: 40px;
        border: 0;
        border-radius: 50%;
        background: #fff;
        color: #212529;
        font-size: 1.5rem;
        line-height: 1;
        cursor: pointer;
    }
</style>

@forelse($eventos_realizados as $evento)
    @php
        $data = \Carbon\Carbon::parse($evento->dt_realizacao_eve);
        $papelVisitante = Auth::check() ? trim(Auth::user()->id_role) : '';
        $jaFoi = isset($presencas) && $presencas->contains($evento->id_evento_eve);
    @endphp
    <div class="d-flex mb-4">
        <div class="d-flex flex-column align-items-center justify-content-start mr-3" style="min-width:62px;">
            <div class="rounded text-white text-center" style="background:#28a745;width:62px;">
                <div class="py-1" style="font-size:0.65rem;letter-spacing:1px;text-transform:uppercase;background:rgba(0,0,0,.15);border-radius:4px 4px 0 0;">
                    {{ $data->translatedFormat('M') }}
                </div>
                <div style="font-size:1.8rem;font-weight:700;line-height:1.1;">{{ $data->format('d') }}</div>
                <div class="pb-1" style="font-size:0.7rem;opacity:.85;">{{ $data->format('Y') }}</div>
            </div>
            @if(!$loop->last)
                <div style="flex:1;width:2px;background:#dee2e6;min-height:20px;margin-top:4px;"></div>
            @endif
        </div>

        <div class="card flex-fill shadow-sm" style="border-left:4px solid #28a745;border-top:none;border-right:none;border-bottom:none;border-radius:6px;margin-left:10px;">
            <div class="card-body py-2 px-3 clearfix">
                @if($evento->ds_imagem_grupo_eve)
                    <button type="button"
                            class="grupo-miniatura"
                            data-src="{{ asset('img/eventos/'.$evento->ds_imagem_grupo_eve) }}"
                            data-alt="Grupo da trilha {{ $evento->nm_evento_eve }}"
                            aria-label="Ampliar foto do grupo da trilha {{ $evento->nm_evento_eve }}">
                        <img src="{{ asset('img/eventos/'.$evento->ds_imagem_grupo_eve) }}"
                             alt=""
                             loading="lazy"
                             decoding="async">
                    </button>
                @endif
                <h2 class="card-title mb-1 h6" style="font-size:1rem;">
                    @if($evento->urlTrilhaVinculada())
                        <a href="{{ $evento->urlTrilhaVinculada() }}" class="text-dark" style="text-decoration:underline;">{{ $evento->nm_evento_eve }}</a>
                    @else
                        {{ $evento->nm_evento_eve }}
                    @endif
                </h2>
                <div class="text-muted" style="font-size:.85rem;">
                    @if(optional($evento->local)->nm_cidade_cde)
                        <span><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $evento->local->nm_cidade_cde }}</span>
                    @endif
                    @include('eventos.partes.percurso', ['evento' => $evento, 'classe' => 'mt-1'])
                </div>
            </div>
            @if($papelVisitante !== 'GUIA')
            <div class="card-footer bg-transparent border-0 pt-0 pb-2 px-3">
                @if($papelVisitante === 'TRILHEIRO' && $jaFoi)
                    <span class="btn btn-success btn-sm disabled"><i class="fa fa-check" aria-hidden="true"></i> Você foi</span>
                @elseif($papelVisitante !== 'GUIA')
                    <a href="{{ url('trilheiro/privado/eventos/eu-fui/'.$evento->id_evento_eve) }}" class="btn btn-outline-success btn-sm">
                        <i class="fa fa-check" aria-hidden="true"></i> Eu fui
                    </a>
                @endif
            </div>
            @endif
        </div>
    </div>
@empty
    <p class="text-muted">Nenhuma trilha realizada por enquanto.</p>
@endforelse

<div class="grupo-lightbox" id="grupo-lightbox" hidden>
    <button type="button" class="grupo-lightbox-fechar" id="grupo-lightbox-fechar" aria-label="Fechar foto">&times;</button>
    <img id="grupo-lightbox-img" alt="">
</div>
<script>
    (function () {
        var lightbox = document.getElementById('grupo-lightbox');
        var imagem = document.getElementById('grupo-lightbox-img');
        var fechar = document.getElementById('grupo-lightbox-fechar');
        if (!lightbox || !imagem || lightbox.dataset.pronto) {
            return;
        }
        lightbox.dataset.pronto = '1';

        function abrir(src, alt) {
            imagem.src = src;
            imagem.alt = alt || 'Foto do grupo';
            lightbox.hidden = false;
            fechar.focus();
        }

        function encerrar() {
            lightbox.hidden = true;
            imagem.removeAttribute('src');
            imagem.alt = '';
        }

        document.querySelectorAll('.grupo-miniatura').forEach(function (botao) {
            botao.addEventListener('click', function () {
                abrir(botao.getAttribute('data-src'), botao.getAttribute('data-alt'));
            });
        });

        fechar.addEventListener('click', encerrar);
        lightbox.addEventListener('click', function (evento) {
            if (evento.target === lightbox) {
                encerrar();
            }
        });
        document.addEventListener('keydown', function (evento) {
            if (evento.key === 'Escape' && !lightbox.hidden) {
                encerrar();
            }
        });
    })();
</script>

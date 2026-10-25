<ul class="list-unstyled mb-0">
    @foreach($linhas as $linha)
        @php
            $zap = $linha->guia->telefoneInternacional();
        @endphp
        <li class="mb-3">
            <a href="{{ $linha->guia->urlPublica() }}" target="_blank" rel="noopener">{{ $linha->guia->nm_guia_gui }}</a>
            @if($linha->guia->origem)
                <span class="text-muted">· {{ $linha->guia->origem->nm_cidade_cde }}</span>
            @endif
            <div class="text-muted" style="font-size:13px;">
                @if($detalhe === 'visitas')
                    {{ $linha->visitas30 }} {{ $linha->visitas30 === 1 ? 'visita' : 'visitas' }} em 30 dias
                @elseif($detalhe === 'login')
                    último acesso {{ $linha->login->diffForHumans() }}
                @else
                    {{ $linha->eventos }} {{ $linha->eventos === 1 ? 'evento' : 'eventos' }}
                    @if($linha->visitas30 > 0)
                        · {{ $linha->visitas30 }} {{ $linha->visitas30 === 1 ? 'visita' : 'visitas' }} em 30 dias
                    @endif
                @endif
            </div>
            @if($linha->guia->urlInstagram() || $zap)
                <div style="font-size:13px;">
                    @if($linha->guia->urlInstagram())
                        <a href="{{ $linha->guia->urlInstagram() }}" target="_blank" rel="noopener">Instagram</a>
                    @endif
                    @if($zap)
                        <a href="https://wa.me/{{ $zap }}" target="_blank" rel="noopener">WhatsApp</a>
                    @endif
                </div>
            @endif
        </li>
    @endforeach
</ul>

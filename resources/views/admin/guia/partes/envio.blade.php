<p class="text-muted mb-2" style="font-size:13px;">Assunto: {{ \App\Services\AvisoAcaoGuia::assunto($codigo) }}</p>
@if($total > $mostrados)
    <p class="text-muted mb-2" style="font-size:13px;">A lista mostra {{ $mostrados }} de {{ $total }}. O envio alcança todos que ainda não receberam.</p>
@endif
@if($pendentes > 0)
    <form method="post" action="{{ route('admin.guias.acao-email') }}" onsubmit="return confirm('Enviar este e-mail para {{ $pendentes }} {{ $pendentes === 1 ? 'guia' : 'guias' }}?');">
        @csrf
        <input type="hidden" name="acao" value="{{ $codigo }}">
        <button type="submit" class="btn btn-sm btn-primary">
            Enviar para {{ $pendentes }} {{ $pendentes === 1 ? 'guia' : 'guias' }}
        </button>
    </form>
    <p class="text-muted mt-2 mb-0" style="font-size:12px;">O mesmo aviso não se repete por 30 dias. Guia inativo fica de fora.</p>
@else
    <p class="text-muted mb-0" style="font-size:13px;">Ninguém novo para avisar. Quem se encaixa já recebeu este e-mail nos últimos 30 dias, está inativo ou não tem e-mail.</p>
@endif

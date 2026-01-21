<!-- 
    Template de rodapé para incluir nos emails enviados aos trilheiros
    Exemplo de uso em um Mailable:
    
    @component('mail::message')
    # Olá {{ $trilheiro->nm_trilheiro_tri }}!
    
    Conteúdo do seu email aqui...
    
    @include('emails.partials.footer-newsletter', ['trilheiro' => $trilheiro])
    @endcomponent
-->

<div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #e0e0e0; font-size: 12px; color: #666; text-align: center;">
    <p style="margin-bottom: 10px;">
        Você está recebendo este email porque está inscrito em nossa newsletter.
    </p>
    <p style="margin-bottom: 10px;">
        Se você não deseja mais receber nossos emails, 
        <a href="{{ $trilheiro->getUnsubscribeUrl() }}" style="color: #0066cc; text-decoration: underline;">
            clique aqui para descadastrar
        </a>.
    </p>
    <p style="margin: 0; color: #999;">
        Trilhas em Santa Catarina © {{ date('Y') }} - Todos os direitos reservados
    </p>
</div>

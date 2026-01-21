@component('mail::message')
# Olá {{ $trilheiro->nm_trilheiro_tri }}!

Este é um exemplo de email de newsletter. Você pode personalizar este template conforme necessário.

## Novidades desta semana

Aqui você pode incluir as últimas novidades sobre trilhas, campings e eventos.

@component('mail::button', ['url' => url('/')])
Acessar o Site
@endcomponent

### Dicas de Trilhas

Conteúdo sobre dicas de trilhas...

---

@include('emails.partials.footer-newsletter', ['trilheiro' => $trilheiro])

@endcomponent

@component('mail::message')
# 🌿 Bem-vindo(a) ao Trilhas em SC!

Olá, **{{ $trilheiro->nm_trilheiro_tri }}**! 👋

Seja muito bem-vindo(a) ao **Trilhas em SC**, o ponto de encontro de quem ama explorar a natureza, se aventurar e descobrir novos caminhos em Santa Catarina.

A partir de agora, você faz parte da nossa comunidade de trilheiros, montanhistas e amantes do ecoturismo.

## Aqui, você poderá:

🥾 Explorar trilhas em todas as regiões de Santa Catarina  
📍 Acompanhar relatos e dicas exclusivas de quem vive a aventura  
🧭 Descobrir guias e condutores locais para trilhas seguras e personalizadas  
🏕️ Participar de eventos e expedições organizados pela comunidade

---

## 🌟 Que tal começar explorando nosso site?

### 🗓️ Eventos - Participe das próximas aventuras
@component('mail::button', ['url' => 'https://trilhasemsc.com.br/eventos'])
Ver Eventos
@endcomponent

### 🥾 Trilhas - Descubra novos caminhos em SC
@component('mail::button', ['url' => 'https://trilhasemsc.com.br/trilhas'])
Explorar Trilhas
@endcomponent

### 🧭 Guias e Condutores - Encontre condutores locais
@component('mail::button', ['url' => 'https://trilhasemsc.com.br/guias-e-condutores'])
Conhecer Guias
@endcomponent

---

### 👤 Mantenha seu perfil atualizado

Para aproveitar ao máximo, acesse seu perfil e mantenha suas informações atualizadas:

@component('mail::button', ['url' => 'https://trilhasemsc.com.br/login', 'color' => 'success'])
Acessar Meu Perfil
@endcomponent

---

Em breve, você receberá novidades sobre trilhas, eventos e oportunidades de aventura no estado.

**Nos vemos nas trilhas!** 🌄

Equipe Trilhas em SC  
[trilhasemsc.com.br](https://trilhasemsc.com.br)

@include('emails.partials.footer-newsletter', ['trilheiro' => $trilheiro])

@endcomponent

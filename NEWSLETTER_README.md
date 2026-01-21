# Sistema de Newsletter - Documentação

## Visão Geral

Sistema de descadastro seguro de newsletter para trilheiros, utilizando tokens únicos e seguros baseados em HMAC-SHA256.

**Recursos:**
- ✅ Descadastro seguro com token único
- ✅ Página de confirmação amigável
- ✅ Opção de reinscrição
- ✅ Notificação automática para administradores
- ✅ Campo opcional para motivo do descadastro

## Características de Segurança

- **Token único por trilheiro**: Gerado usando `hash_hmac()` com SHA256
- **Baseado em dados imutáveis**: ID do trilheiro + email + APP_KEY
- **Validação segura**: Usa `hash_equals()` para evitar timing attacks
- **Sem expiração**: Token permanece válido enquanto os dados não mudarem
- **Difícil de falsificar**: Requer conhecimento da APP_KEY (secret)

## Como Usar

### 1. Gerar URL de Descadastro

Em qualquer lugar do código onde você tenha acesso ao modelo `$trilheiro`:

```php
$unsubscribeUrl = $trilheiro->getUnsubscribeUrl();
```

### 2. Incluir no Rodapé dos Emails

Use a partial fornecida em seus templates de email:

```blade
@include('emails.partials.footer-newsletter', ['trilheiro' => $trilheiro])
```

Ou manualmente:

```blade
<a href="{{ $trilheiro->getUnsubscribeUrl() }}">Descadastrar</a>
```

### 3. Enviar Emails Apenas para Inscritos

Ao buscar trilheiros para envio de newsletter, filtre pelo campo:

```php
$trilheiros = Trilheiro::where('fl_newsletter_tri', true)->get();

foreach ($trilheiros as $trilheiro) {
    // Enviar email
    Mail::to($trilheiro->user->email)->send(new NewsletterMail($trilheiro));
}
```

## Exemplo de Mailable

Crie um Mailable para seus emails de newsletter:

```php
php artisan make:mail NewsletterMail
```

```php
<?php

namespace App\Mail;

use App\Trilheiro;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewsletterMail extends Mailable
{
    use Queueable, SerializesModels;

    public $trilheiro;

    public function __construct(Trilheiro $trilheiro)
    {
        $this->trilheiro = $trilheiro;
    }

    public function build()
    {
        return $this->subject('Newsletter - Trilhas em SC')
                    ->view('emails.newsletter-exemplo');
    }
}
```

## Rotas Disponíveis

### Visualizar Confirmação de Descadastro
```
GET /newsletter/descadastrar/{trilheiro_id}/{token}
```

### Confirmar Descadastro
```
POST /newsletter/descadastrar/{trilheiro_id}/{token}
```

### Reinscrever na Newsletter
```
GET /newsletter/reinscrever/{trilheiro_id}/{token}
```

## Métodos do Modelo Trilheiro

### `getUnsubscribeToken()`
Gera um token único e seguro para o trilheiro.

```php
$token = $trilheiro->getUnsubscribeToken();
```

### `validateUnsubscribeToken($trilheiroId, $token)`
Valida se um token é válido para um determinado trilheiro (método estático).

```php
$isValid = Trilheiro::validateUnsubscribeToken($trilheiroId, $token);
```

### `getUnsubscribeUrl()`
Retorna a URL completa de descadastro.

```php
$url = $trilheiro->getUnsubscribeUrl();
// Resultado: https://seusite.com/newsletter/descadastrar/123/abc123def456...
```

## Fluxo de Descadastro

1. Trilheiro recebe email com link de descadastro no rodapé
2. Clica no link e é direcionado para página de confirmação
3. (Opcional) Informa o motivo do descadastro
4. Confirma o descadastro
5. Campo `fl_newsletter_tri` é atualizado para `false`
6. **Email de notificação é enviado para os administradores**
7. Página de sucesso é exibida com opção de reinscrição

## Notificações para Administradores

### Configuração

Adicione no arquivo `.env`:

```env
MAIL_ADMIN_NOTIFICATION=admin@trilhasemsc.com.br
```

Ou para múltiplos destinatários:

```env
MAIL_ADMIN_NOTIFICATION=admin@trilhasemsc.com.br,marketing@trilhasemsc.com.br
```

### Conteúdo do Email

Cada descadastro gera um email com:
- Nome e email do trilheiro
- Data de cadastro e descadastro
- Último login (se houver)
- Cidade de origem
- Motivo do descadastro (se informado)
- Link direto para o perfil no admin

📖 **Documentação completa:** Veja [NEWSLETTER_NOTIFICATIONS.md](NEWSLETTER_NOTIFICATIONS.md)

## Fluxo de Reinscrição

1. Na página de sucesso após descadastro, há botão de reinscrição
2. Clica no botão
3. Campo `fl_newsletter_tri` é atualizado para `true`
4. Confirmação de reinscrição é exibida

## Considerações Importantes

- ⚠️ O token é baseado no ID e email do trilheiro. Se o email mudar, o token antigo se torna inválido.
- ⚠️ Sempre use `fl_newsletter_tri = true` ao filtrar trilheiros para envio de emails.
- ⚠️ Não exponha a estrutura do token ou a APP_KEY publicamente.
- ✅ O token não expira, simplificando o gerenciamento.
- ✅ URLs antigas continuam funcionando (desde que dados não mudem).

## Teste Manual

Para testar o sistema:

1. Acesse o perfil de um trilheiro e obtenha o token:
```php
$trilheiro = Trilheiro::find(1);
echo $trilheiro->getUnsubscribeUrl();
```

2. Cole a URL no navegador e siga o fluxo de descadastro

3. Verifique no banco de dados se `fl_newsletter_tri` foi atualizado

## Exemplo de Query para Envio em Massa

```php
use App\Trilheiro;
use App\Mail\NewsletterMail;
use Illuminate\Support\Facades\Mail;

// Buscar apenas trilheiros inscritos
$trilheiros = Trilheiro::where('fl_newsletter_tri', true)
    ->whereHas('user')
    ->with('user')
    ->get();

foreach ($trilheiros as $trilheiro) {
    try {
        Mail::to($trilheiro->user->email)->send(new NewsletterMail($trilheiro));
    } catch (\Exception $e) {
        \Log::error('Erro ao enviar newsletter para ' . $trilheiro->id_trilheiro_tri . ': ' . $e->getMessage());
    }
}
```

## Atualização do Campo no Cadastro

Lembre-se de adicionar um checkbox no formulário de cadastro/edição do trilheiro:

```blade
<div class="form-check">
    <input class="form-check-input" type="checkbox" name="fl_newsletter_tri" 
           id="fl_newsletter_tri" value="1" 
           {{ old('fl_newsletter_tri', $trilheiro->fl_newsletter_tri ?? true) ? 'checked' : '' }}>
    <label class="form-check-label" for="fl_newsletter_tri">
        Desejo receber emails com novidades, dicas e promoções
    </label>
</div>
```

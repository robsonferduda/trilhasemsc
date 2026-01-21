# Configuração de Notificações de Descadastro

## Variável de Ambiente Necessária

Adicione esta linha no seu arquivo `.env`:

```env
# Email(s) para receber notificações de descadastro da newsletter
# Pode ser um único email ou múltiplos separados por vírgula
MAIL_ADMIN_NOTIFICATION=admin@trilhasemsc.com.br

# Ou múltiplos emails:
# MAIL_ADMIN_NOTIFICATION=admin@trilhasemsc.com.br,marketing@trilhasemsc.com.br,suporte@trilhasemsc.com.br
```

## Como Funciona

Sempre que um trilheiro se descadastrar da newsletter:

1. O campo `fl_newsletter_tri` é atualizado para `false`
2. Um email é enviado automaticamente para o(s) email(s) configurado(s)
3. O email contém:
   - Nome e email do trilheiro
   - Data de cadastro
   - Data do último login
   - Cidade de origem
   - Motivo do descadastro (se informado)
   - Link direto para o perfil do trilheiro no admin

## Formato do Email de Notificação

```
🔔 Notificação de Descadastro

Um trilheiro se descadastrou da newsletter.

Dados do Trilheiro
------------------
Nome: João Silva
Email: joao@example.com
ID: 123
Cadastrado em: 15/01/2025 14:30
Descadastrado em: 21/01/2026 10:45
Último login: 20/01/2026 16:20 (há 18 horas)
Cidade de Origem: Florianópolis

Motivo informado (se fornecido)
-------------------------------
Recebo muitos emails
```

## Configuração de Múltiplos Destinatários

### Opção 1: No arquivo .env (Recomendado)
```env
MAIL_ADMIN_NOTIFICATION=admin@site.com,marketing@site.com,suporte@site.com
```

### Opção 2: No arquivo config/mail.php
```php
'admin_notification_emails' => [
    'admin@trilhasemsc.com.br',
    'marketing@trilhasemsc.com.br',
    'suporte@trilhasemsc.com.br',
],
```

## Tratamento de Erros

- Se o envio do email falhar, o erro é registrado no log do Laravel
- O descadastro do usuário **não é afetado** por falhas no envio do email
- Isso garante que o trilheiro sempre conseguirá se descadastrar

## Testando as Notificações

### 1. Configure o email no .env
```env
MAIL_ADMIN_NOTIFICATION=seuemail@gmail.com
```

### 2. Obtenha a URL de descadastro de um trilheiro
No Tinker do Laravel:
```bash
php artisan tinker
```

```php
$trilheiro = App\Trilheiro::first();
echo $trilheiro->getUnsubscribeUrl();
```

### 3. Acesse a URL e complete o descadastro

### 4. Verifique se recebeu o email de notificação

## Logs

Em caso de problemas, verifique os logs em:
```
storage/logs/laravel.log
```

Procure por mensagens como:
```
Erro ao enviar notificação de descadastro: [detalhes do erro]
```

## Estatísticas de Descadastros

Para obter estatísticas de descadastros:

```php
// Total de descadastrados
$descadastrados = Trilheiro::where('fl_newsletter_tri', false)->count();

// Descadastros nos últimos 7 dias
$descadastrosRecentes = Trilheiro::where('fl_newsletter_tri', false)
    ->where('updated_at', '>=', now()->subDays(7))
    ->count();

// Lista de descadastrados recentes
$lista = Trilheiro::where('fl_newsletter_tri', false)
    ->where('updated_at', '>=', now()->subDays(30))
    ->with('user', 'origem')
    ->orderBy('updated_at', 'desc')
    ->get();
```

## Importante

⚠️ **Não se esqueça de configurar o SMTP** no seu arquivo `.env` para que os emails sejam enviados corretamente:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=seu-email@gmail.com
MAIL_PASSWORD=sua-senha-de-app
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@trilhasemsc.com.br
MAIL_FROM_NAME="Trilhas em SC"
```

# Email de Boas-Vindas - Trilheiros

## Descrição

Email automático enviado para novos trilheiros ao se cadastrarem no site Trilhas em SC.

## Quando é Enviado

O email é enviado automaticamente em dois momentos:

1. **Cadastro via RegisterController** - Quando o usuário se registra pela primeira vez no site
2. **Primeiro acesso ao perfil** - Quando um usuário social (Google/Facebook) completa seu cadastro pela primeira vez

## Conteúdo do Email

### Assunto
🌿 Bem-vindo(a) ao Trilhas em SC!

### Corpo
- Mensagem de boas-vindas personalizada com o nome do trilheiro
- Apresentação da plataforma e comunidade
- Lista de benefícios e recursos disponíveis
- Links para seções principais:
  - 🗓️ Eventos
  - 🥾 Trilhas
  - 🧭 Guias e Condutores
  - 👤 Perfil do usuário
- Rodapé com link de descadastro da newsletter

## Estrutura Técnica

### Mailable
**Arquivo:** `app/Mail/BoasVindasTrilheiro.php`

```php
Mail::to($user->email)->send(new BoasVindasTrilheiro($trilheiro));
```

### Template
**Arquivo:** `resources/views/emails/boas-vindas-trilheiro.blade.php`

Utiliza o componente Markdown do Laravel para formatação consistente.

### Controllers que Enviam o Email

1. **RegisterController** (`app/Http/Controllers/Auth/RegisterController.php`)
   - Linha ~80: Após criação do trilheiro no registro

2. **TrilheiroController** (`app/Http/Controllers/TrilheiroController.php`)
   - Linha ~202: Ao completar cadastro pela primeira vez (usuários sociais)

## Logs

### Sucesso
```
Email de boas-vindas enviado com sucesso
- trilheiro_id: 123
- user_email: usuario@example.com
- timestamp: 2026-01-21 15:30:00
```

### Erro
```
Erro ao enviar email de boas-vindas
- error: [mensagem do erro]
- trilheiro_id: 123
- user_email: usuario@example.com
```

## Tratamento de Erros

- Erros no envio são registrados em `storage/logs/laravel.log`
- Falhas no envio **NÃO interrompem** o processo de cadastro
- O usuário consegue se cadastrar mesmo se o email falhar

## Testes

### 1. Teste via Tinker

```bash
php artisan tinker
```

```php
$trilheiro = App\Trilheiro::first();
Mail::to('seu-email@example.com')->send(new App\Mail\BoasVindasTrilheiro($trilheiro));
```

### 2. Teste via Cadastro Real

1. Acesse a página de registro
2. Complete o cadastro com um email válido
3. Verifique se recebeu o email de boas-vindas

### 3. Teste em Ambiente de Desenvolvimento

Configure no `.env`:

```env
MAIL_MAILER=log
```

Isso salvará os emails em `storage/logs/laravel.log` ao invés de enviá-los.

## Personalização

### Alterar Conteúdo
Edite o arquivo: `resources/views/emails/boas-vindas-trilheiro.blade.php`

### Alterar Assunto
Edite o método `build()` em: `app/Mail/BoasVindasTrilheiro.php`

### Adicionar Anexos
No método `build()`:

```php
return $this->subject('🌿 Bem-vindo(a) ao Trilhas em SC!')
            ->view('emails.boas-vindas-trilheiro')
            ->attach('/path/to/file.pdf');
```

### Alterar Remetente
Configure no `.env`:

```env
MAIL_FROM_ADDRESS=contato@trilhasemsc.com.br
MAIL_FROM_NAME="Trilhas em SC"
```

## Links no Email

Todos os links apontam para:
- **Base:** https://trilhasemsc.com.br
- **Eventos:** /eventos
- **Trilhas:** /trilhas
- **Guias:** /guias-e-condutores
- **Login/Perfil:** /login

## Newsletter

O email inclui o rodapé padrão com link de descadastro:

```blade
@include('emails.partials.footer-newsletter', ['trilheiro' => $trilheiro])
```

## Estatísticas

### Verificar Emails Enviados

```php
// Total de trilheiros cadastrados hoje
$novosHoje = Trilheiro::whereDate('created_at', today())->count();

// Buscar logs de envio
$logs = File::get(storage_path('logs/laravel.log'));
preg_match_all('/Email de boas-vindas enviado com sucesso/', $logs, $matches);
$totalEnviados = count($matches[0]);
```

## Problemas Comuns

### Email não está sendo enviado

1. Verifique a configuração SMTP no `.env`
2. Confirme que o email está na fila (se estiver usando queue)
3. Verifique os logs em `storage/logs/laravel.log`

### Email indo para SPAM

1. Configure SPF, DKIM e DMARC no DNS
2. Use um serviço de email confiável (SendGrid, Mailgun, etc.)
3. Evite palavras que ativam filtros de spam

### Links quebrados no email

1. Verifique se `APP_URL` está correto no `.env`
2. Use URLs absolutas com `https://`

## Boas Práticas

✅ **Faça:**
- Teste em diferentes clientes de email (Gmail, Outlook, etc.)
- Mantenha o conteúdo objetivo e direto
- Use CTAs (Call to Action) claros
- Inclua sempre o link de descadastro

❌ **Evite:**
- Emails muito longos
- Muitas imagens pesadas
- Links encurtados
- Excesso de formatação

## Compliance

- ✅ Inclui link de descadastro (LGPD/CAN-SPAM)
- ✅ Email transacional (confirmação de cadastro)
- ✅ Conteúdo relevante ao cadastro
- ✅ Opt-in implícito no cadastro

# Sistema de Notificação de Erros - Trilhas em SC

## 📧 Configuração de Notificações por Email

O sistema agora possui notificações automáticas por email quando erros 500 ocorrem.

### Configuração do Email

Adicione as seguintes variáveis no arquivo `.env`:

```env
# Configurações de Email (exemplo com Gmail)
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=seu-email@gmail.com
MAIL_PASSWORD=sua-senha-de-aplicativo
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=seu-email@gmail.com
MAIL_FROM_NAME="${APP_NAME}"

# Email(s) para receber notificações de erro (pode usar múltiplos separados por vírgula)
ERROR_NOTIFICATION_EMAIL=admin@trilhasemsc.com.br,dev@trilhasemsc.com.br
```

### Opções de Configuração de Email

#### 1. Gmail
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=seu-email@gmail.com
MAIL_PASSWORD=sua-senha-de-aplicativo  # Use senha de aplicativo, não a senha normal
MAIL_ENCRYPTION=tls
```

**Importante para Gmail:** Você precisa gerar uma senha de aplicativo em https://myaccount.google.com/apppasswords

#### 2. Outlook/Hotmail
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.office365.com
MAIL_PORT=587
MAIL_USERNAME=seu-email@outlook.com
MAIL_PASSWORD=sua-senha
MAIL_ENCRYPTION=tls
```

#### 3. SendGrid
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.sendgrid.net
MAIL_PORT=587
MAIL_USERNAME=apikey
MAIL_PASSWORD=sua-api-key-do-sendgrid
MAIL_ENCRYPTION=tls
```

#### 4. Mailtrap (para testes)
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=seu-username-mailtrap
MAIL_PASSWORD=sua-senha-mailtrap
MAIL_ENCRYPTION=null
```

### 📩 Email de Notificação

Quando um erro 500 ocorre, um email será enviado automaticamente contendo:

- **Tipo do erro**: Classe da exceção
- **Mensagem de erro**: Descrição do que aconteceu
- **Arquivo e linha**: Onde o erro ocorreu no código
- **URL da requisição**: Página onde o erro aconteceu
- **Método HTTP**: GET, POST, etc.
- **IP do usuário**: Endereço IP de quem encontrou o erro
- **User Agent**: Navegador e sistema operacional
- **Data e hora**: Quando o erro ocorreu

### 🎯 Tipos de Erros Notificados

O sistema **ENVIA** notificação para:
- ✅ Erros 500 (Internal Server Error)
- ✅ Erros de código (Exception, Error)
- ✅ Erros de banco de dados
- ✅ Erros de sintaxe

O sistema **NÃO ENVIA** notificação para:
- ❌ Erro 404 (Página não encontrada)
- ❌ Erro 401 (Não autenticado)
- ❌ Erro 403 (Acesso negado)
- ❌ Erros de validação de formulário

### 🔧 Customização

#### Alterar destinatários de email

Edite a variável no `.env`:
```env
ERROR_NOTIFICATION_EMAIL=email1@exemplo.com,email2@exemplo.com,email3@exemplo.com
```

#### Ativar apenas em produção

No arquivo `/app/Exceptions/Handler.php`, na função `shouldReportError()`, descomente a linha:
```php
return app()->environment('production');
```

#### Desativar notificações

No arquivo `/app/Exceptions/Handler.php`, comente o bloco de envio de email na função `report()`:
```php
// if ($this->shouldReportError($exception)) {
//     $this->sendErrorNotification($exception);
// }
```

### 📄 Páginas de Erro Personalizadas

O sistema possui páginas de erro personalizadas:

- **404.blade.php**: Página não encontrada
- **500.blade.php**: Erro interno do servidor (nova!)

Ambas estão localizadas em: `/resources/views/errors/`

### 🧪 Testar o Sistema

Para testar se as notificações estão funcionando:

1. Configure o email no `.env`
2. Crie uma rota de teste que gera um erro:

```php
// routes/web.php
Route::get('/test-error', function() {
    throw new \Exception('Teste de notificação de erro');
});
```

3. Acesse: `http://seu-dominio/test-error`
4. Verifique se recebeu o email

**IMPORTANTE:** Remova a rota de teste após verificar!

### 📊 Logs

Além do email, os erros também são registrados nos logs do Laravel em:
```
/storage/logs/laravel.log
```

### ⚙️ Ambiente de Desenvolvimento

Se quiser receber notificações também em desenvolvimento, certifique-se que a linha está comentada em `/app/Exceptions/Handler.php`:
```php
// return app()->environment('production');
return true;
```

---

## 🚀 Status

✅ Página de erro 500 personalizada criada  
✅ Sistema de notificação por email implementado  
✅ Filtros para evitar spam de notificações  
✅ Suporte a múltiplos destinatários  
✅ Logs automáticos mantidos  

## 📞 Suporte

Para dúvidas ou problemas, entre em contato com a equipe de desenvolvimento.

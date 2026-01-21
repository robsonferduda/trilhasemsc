# 🧪 Guia Rápido - Testar Email de Boas-Vindas

## Método 1: Via Tinker (Mais Rápido)

```bash
php artisan tinker
```

```php
// Pegar um trilheiro existente
$trilheiro = App\Trilheiro::first();

// Enviar email para seu email
Mail::to('seuemail@gmail.com')->send(new App\Mail\BoasVindasTrilheiro($trilheiro));

// Verificar se foi enviado
echo "Email enviado com sucesso!";
```

**Pressione Ctrl+C para sair do Tinker**

---

## Método 2: Criar Trilheiro de Teste

```bash
php artisan tinker
```

```php
// Criar usuário de teste
$user = App\User::create([
    'name' => 'João Teste',
    'email' => 'seuemail@gmail.com',
    'password' => bcrypt('senha123'),
]);

// Criar trilheiro associado
$trilheiro = App\Trilheiro::create([
    'id_user' => $user->id,
    'nm_trilheiro_tri' => 'João Teste',
]);

// Enviar email
Mail::to($user->email)->send(new App\Mail\BoasVindasTrilheiro($trilheiro));

echo "Email de boas-vindas enviado para: " . $user->email;
```

---

## Método 3: Cadastro Real no Site

1. Abra o site em modo anônimo/privado
2. Acesse a página de cadastro
3. Preencha com seu email real
4. Complete o cadastro
5. Verifique sua caixa de entrada

---

## Método 4: Salvar em Arquivo (Desenvolvimento)

### 1. Configure o .env:
```env
MAIL_MAILER=log
```

### 2. Envie o email normalmente (via tinker ou cadastro)

### 3. Abra o log:
```bash
tail -f storage/logs/laravel.log
```

O email aparecerá no log!

---

## Método 5: MailHog (Ambiente Docker)

Se você usa Docker, configure:

```env
MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
```

Acesse: http://localhost:8025

---

## Verificar se o Email Foi Enviado

### Checar logs:
```bash
tail -n 100 storage/logs/laravel.log | grep "Email de boas-vindas"
```

### Buscar erros:
```bash
tail -n 100 storage/logs/laravel.log | grep "Erro ao enviar email"
```

---

## Troubleshooting

### "Class BoasVindasTrilheiro not found"
```bash
composer dump-autoload
```

### "Connection could not be established with host"
Verifique suas credenciais SMTP no `.env`

### Email não chega
1. Verifique spam/lixo eletrônico
2. Confirme configuração SMTP
3. Teste com outro email

---

## Comando Completo para Teste Rápido

Cole tudo de uma vez no tinker:

```php
php artisan tinker

$trilheiro = App\Trilheiro::first();
Mail::to('seuemail@gmail.com')->send(new App\Mail\BoasVindasTrilheiro($trilheiro));
echo "✅ Email enviado! Verifique: seuemail@gmail.com";
```

---

## Resetar Teste (Deletar Usuário de Teste)

```php
php artisan tinker

// Deletar por email
$user = App\User::where('email', 'seuemail@gmail.com')->first();
if($user) {
    $trilheiro = App\Trilheiro::where('id_user', $user->id)->first();
    if($trilheiro) $trilheiro->delete();
    $user->delete();
    echo "✅ Usuário de teste deletado!";
}
```

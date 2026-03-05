<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinição de Senha — Trilhas em SC</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 3px solid #28a745;
            margin-bottom: 30px;
        }
        .header img {
            max-width: 160px;
            margin-bottom: 10px;
        }
        h1 {
            color: #28a745;
            font-size: 22px;
            margin: 0;
        }
        .content {
            font-size: 15px;
            margin-bottom: 25px;
        }
        .btn-wrapper {
            text-align: center;
            margin: 30px 0;
        }
        .button {
            display: inline-block;
            padding: 14px 36px;
            background-color: #28a745;
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: bold;
        }
        .expiry {
            background-color: #fff8e1;
            border-left: 4px solid #ffc107;
            padding: 12px 16px;
            border-radius: 4px;
            font-size: 14px;
            margin: 20px 0;
            color: #555;
        }
        .fallback {
            font-size: 13px;
            color: #777;
            word-break: break-all;
            margin-top: 20px;
        }
        .fallback a {
            color: #28a745;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            font-size: 12px;
            color: #999;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🔥 Trilhas em SC</h1>
        </div>

        <div class="content">
            <p>Olá, <strong>{{ $user->name ?? 'Trilheiro(a)' }}</strong>!</p>
            <p>Recebemos uma solicitação de <strong>redefinição de senha</strong> para a sua conta no Trilhas em SC.</p>
            <p>Clique no botão abaixo para criar uma nova senha:</p>
        </div>

        <div class="btn-wrapper">
            <a href="{{ $url }}" class="button">Redefinir minha senha</a>
        </div>

        <div class="expiry">
            ⏳ Este link é válido por <strong>60 minutos</strong>. Após esse prazo, será necessário solicitar um novo link.
        </div>

        <div class="content">
            <p>Se você <strong>não solicitou</strong> a redefinição de senha, ignore este e-mail. Sua senha permanece a mesma e nenhuma alteração será feita.</p>
        </div>

        <div class="fallback">
            <p>Se o botão acima não funcionar, copie e cole o endereço abaixo no seu navegador:</p>
            <a href="{{ $url }}">{{ $url }}</a>
        </div>

        <div class="footer">
            <p>Atenciosamente,<br><strong>Equipe Trilhas em SC</strong></p>
            <p><a href="https://trilhasemsc.com.br" style="color: #28a745;">trilhasemsc.com.br</a></p>
        </div>
    </div>
</body>
</html>

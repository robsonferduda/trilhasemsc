<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem-vindo ao Trilhas em SC</title>
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
        h1 {
            color: #28a745;
            font-size: 24px;
            margin: 0 0 10px 0;
        }
        .welcome-text {
            font-size: 16px;
            margin-bottom: 20px;
        }
        .benefits {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 6px;
            margin: 20px 0;
        }
        .benefits ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .benefits li {
            padding: 8px 0;
            font-size: 15px;
        }
        .button {
            display: inline-block;
            padding: 12px 30px;
            background-color: #28a745;
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px 0;
            font-weight: bold;
        }
        .button-secondary {
            background-color: #007bff;
        }
        .section {
            margin: 25px 0;
            padding: 20px 0;
            border-bottom: 1px solid #e9ecef;
        }
        .section:last-child {
            border-bottom: none;
        }
        .section-title {
            font-size: 18px;
            color: #28a745;
            margin-bottom: 15px;
            font-weight: bold;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e9ecef;
            font-size: 14px;
            color: #666;
        }
        .footer a {
            color: #007bff;
            text-decoration: none;
        }
        .unsubscribe {
            margin-top: 20px;
            font-size: 12px;
            color: #999;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🌿 Bem-vindo(a) ao Trilhas em SC!</h1>
        </div>

        <div class="welcome-text">
            <p><strong>Olá, {{ $trilheiro->nm_trilheiro_tri }}!</strong> 👋</p>
            <p>Seja muito bem-vindo(a) ao <strong>Trilhas em SC</strong>, o ponto de encontro de quem ama explorar a natureza, se aventurar e descobrir novos caminhos em Santa Catarina.</p>
            <p>A partir de agora, você faz parte da nossa comunidade de trilheiros, montanhistas e amantes do ecoturismo.</p>
        </div>

        <div class="benefits">
            <strong>Aqui, você poderá:</strong>
            <ul>
                <li>🥾 Explorar trilhas em todas as regiões de Santa Catarina</li>
                <li>📍 Acompanhar relatos e dicas exclusivas de quem vive a aventura</li>
                <li>🧭 Descobrir guias e condutores locais para trilhas seguras e personalizadas</li>
                <li>🏕️ Participar de eventos e expedições organizados pela comunidade</li>
            </ul>
        </div>

        <div class="section">
            <div class="section-title">🌟 Que tal começar explorando nosso site?</div>
            
            <p><strong>🗓️ Eventos - Participe das próximas aventuras</strong></p>
            <a href="https://trilhasemsc.com.br/eventos" class="button">Ver Eventos</a>

            <p style="margin-top: 20px;"><strong>🥾 Trilhas - Descubra novos caminhos em SC</strong></p>
            <a href="https://trilhasemsc.com.br/trilhas" class="button">Explorar Trilhas</a>

            <p style="margin-top: 20px;"><strong>🧭 Guias e Condutores - Encontre condutores locais</strong></p>
            <a href="https://trilhasemsc.com.br/guias-e-condutores" class="button">Conhecer Guias</a>
        </div>

        <div class="section">
            <div class="section-title">👤 Mantenha seu perfil atualizado</div>
            <p>Para aproveitar ao máximo, acesse seu perfil e mantenha suas informações atualizadas:</p>
            <a href="https://trilhasemsc.com.br/login" class="button button-secondary">Acessar Meu Perfil</a>
        </div>

        <p style="margin-top: 30px;">Em breve, você receberá novidades sobre trilhas, eventos e oportunidades de aventura no estado.</p>
        
        <p><strong>Nos vemos nas trilhas!</strong> 🌄</p>
        
        <div class="footer">
            <p><strong>Equipe Trilhas em SC</strong></p>
            <p><a href="https://trilhasemsc.com.br">trilhasemsc.com.br</a></p>
        </div>

        <div class="unsubscribe">
            <p>Você está recebendo este email porque se cadastrou em nossa plataforma.</p>
            <p>Se você não deseja mais receber nossos emails, <a href="{{ $trilheiro->getUnsubscribeUrl() }}">clique aqui para descadastrar</a>.</p>
            <p style="color: #999; margin-top: 10px;">Trilhas em Santa Catarina © {{ date('Y') }} - Todos os direitos reservados</p>
        </div>
    </div>
</body>
</html>

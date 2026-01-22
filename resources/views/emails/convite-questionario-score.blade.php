<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Descubra seu Score de Trilheiro</title>
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
        .highlight-box {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 25px;
            border-radius: 10px;
            text-align: center;
            margin: 25px 0;
        }
        .highlight-box h2 {
            font-size: 28px;
            margin: 0 0 10px 0;
        }
        .highlight-box p {
            font-size: 16px;
            margin: 0;
            opacity: 0.95;
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
            padding: 10px 0;
            font-size: 15px;
            border-bottom: 1px solid #e9ecef;
        }
        .benefits li:last-child {
            border-bottom: none;
        }
        .button {
            display: inline-block;
            padding: 15px 40px;
            background-color: #28a745;
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
            font-weight: bold;
            font-size: 16px;
            text-align: center;
        }
        .button:hover {
            background-color: #218838;
        }
        .cta-section {
            text-align: center;
            margin: 30px 0;
            padding: 20px;
            background-color: #fff9e6;
            border-radius: 8px;
            border: 2px dashed #ffc107;
        }
        .section {
            margin: 25px 0;
            padding: 20px 0;
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
        .emoji-large {
            font-size: 48px;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎯 Descubra Seu Nível de Trilheiro!</h1>
        </div>

        <p><strong>Olá, {{ $trilheiro->nm_trilheiro_tri }}!</strong> 👋</p>

        <p>Notamos que você ainda não respondeu ao nosso <strong>questionário de perfil de trilheiro</strong>. 🗻</p>

        <div class="highlight-box">
            <div class="emoji-large">🏆</div>
            <h2>Qual é o seu Score?</h2>
            <p>Responda e descubra seu nível de experiência nas trilhas!</p>
        </div>

        <div class="section">
            <p>O questionário é <strong>rápido e personalizado</strong> para você. Com base nas suas respostas, vamos calcular seu <strong>Score de Trilheiro</strong> e você descobrirá:</p>
        </div>

        <div class="benefits">
            <ul>
                <li>📊 <strong>Seu nível atual</strong> - Iniciante, Intermediário ou Avançado</li>
                <li>🎖️ <strong>Seu índice de experiência</strong> - Classificação baseada nas suas aventuras</li>
                <li>🏅 <strong>Badges e conquistas</strong> - Desbloqueie medalhas conforme evolui</li>
                <li>🌟 <strong>Pontos de experiência (XP)</strong> - Acompanhe sua evolução ao longo do tempo</li>
                <li>🎯 <strong>Trilhas recomendadas</strong> - Sugestões personalizadas para o seu perfil</li>
                <li>👥 <strong>Compare com a comunidade</strong> - Veja onde você está no ranking</li>
            </ul>
        </div>

        <div class="cta-section">
            <p style="font-size: 18px; margin-bottom: 15px;"><strong>⏱️ Leva apenas 3 minutos!</strong></p>
            <p>Responda agora e descubra seu score:</p>
            <a href="https://trilhasemsc.com.br/trilheiro/privado/meu-nivel" class="button">📝 Responder Questionário</a>
        </div>

        <div class="section">
            <div class="section-title">💡 Por que responder?</div>
            <p>Com seu score definido, nossa plataforma poderá:</p>
            <ul style="padding-left: 20px;">
                <li>Sugerir trilhas adequadas ao seu nível</li>
                <li>Conectar você com trilheiros similares</li>
                <li>Recomendar eventos e expedições compatíveis</li>
                <li>Acompanhar sua evolução como trilheiro</li>
            </ul>
        </div>

        <div style="background-color: #e7f3ff; padding: 20px; border-radius: 8px; border-left: 4px solid #007bff; margin: 25px 0;">
            <p style="margin: 0;"><strong>💬 Dica:</strong> Seja sincero nas respostas! Não existe resposta certa ou errada. O objetivo é conhecer melhor seu perfil para oferecer a melhor experiência possível.</p>
        </div>

        <p style="margin-top: 30px;">Estamos ansiosos para conhecer mais sobre sua jornada nas trilhas! 🥾</p>
        
        <p><strong>Nos vemos nas montanhas!</strong> 🏔️</p>
        
        <div class="footer">
            <p><strong>Equipe Trilhas em SC</strong></p>
            <p><a href="https://trilhasemsc.com.br">trilhasemsc.com.br</a></p>
            <p style="margin-top: 15px; color: #999;">Dúvidas? Entre em contato conosco!</p>
        </div>
    </div>
</body>
</html>

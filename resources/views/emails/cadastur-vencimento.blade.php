<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vencimento do Cadastur - Trilhas em SC</title>
</head>
<body style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px; background-color: #f4f4f4;">
    <div style="background-color: #ffffff; border-radius: 8px; padding: 30px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <div style="text-align: center; padding-bottom: 20px; border-bottom: 3px solid #17a2b8; margin-bottom: 24px;">
            <h1 style="color: #17a2b8; font-size: 22px; margin: 0;">Seu Cadastur vence em {{ $validade }}</h1>
            <p style="margin: 8px 0 0; color: #666;">Trilhas em Santa Catarina</p>
        </div>

        <p>Olá, <strong>{{ $guia->nm_guia_gui }}</strong>!</p>
        <p>O certificado Cadastur nº <strong>{{ $guia->nu_cadastur_gui }}</strong> aparece no seu perfil com o selo de conferido, válido até <strong>{{ $validade }}</strong>.</p>
        <p>No dia seguinte ao vencimento, o selo sai do seu perfil e das trilhas que você conduz. O perfil continua publicado.</p>

        <div style="background: #f0f9fb; border-radius: 8px; padding: 16px; margin: 18px 0;">
            <p style="margin: 0 0 8px;"><strong>Para manter o selo:</strong></p>
            <ol style="margin: 0; padding-left: 18px; color: #444;">
                <li>Entre no Cadastur com sua conta gov.br e solicite a renovação da atividade</li>
                <li>Aguarde a análise do órgão estadual de turismo</li>
                <li>Se o número do certificado mudar, atualize no seu cadastro aqui</li>
            </ol>
        </div>

        <div style="text-align: center; margin: 28px 0;">
            <a href="{{ $urlCadastur }}" style="display: inline-block; padding: 12px 24px; background-color: #17a2b8; color: #ffffff !important; text-decoration: none; border-radius: 5px; font-weight: bold; margin: 4px;">
                Renovar no Cadastur
            </a>
            <a href="{{ $urlCadastroGuia }}" style="display: inline-block; padding: 12px 24px; background-color: #6c757d; color: #ffffff !important; text-decoration: none; border-radius: 5px; font-weight: bold; margin: 4px;">
                Meu cadastro
            </a>
        </div>

        <p style="font-size: 13px; color: #999; margin-top: 24px; border-top: 1px solid #eee; padding-top: 16px;">
            Equipe Trilhas em SC<br>
            <a href="{{ url('/') }}" style="color: #17a2b8;">trilhasemsc.com.br</a>
        </p>
    </div>
</body>
</html>

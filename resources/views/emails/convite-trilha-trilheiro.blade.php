<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova aventura no Trilhas em SC</title>
</head>
<body style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px; background-color: #f4f4f4;">
    <div style="background-color: #ffffff; border-radius: 8px; padding: 30px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <div style="text-align: center; padding-bottom: 20px; border-bottom: 3px solid #28a745; margin-bottom: 24px;">
            <h1 style="color: #28a745; font-size: 22px; margin: 0;">Nova aventura para você</h1>
            <p style="margin: 8px 0 0; color: #666;">Trilhas em Santa Catarina</p>
        </div>

        @if($isTest)
            <div style="background: #fff3cd; border: 1px solid #ffc107; color: #856404; padding: 10px 14px; border-radius: 6px; margin-bottom: 18px; font-size: 14px;">
                <strong>Email de teste:</strong> esta é a prévia enviada ao administrador.
            </div>
        @endif

        <p>Olá, <strong>{{ $destinatarioNome }}</strong>!</p>
        <p>Temos uma aventura que pode te interessar no Trilhas em SC:</p>

        <div style="border: 1px solid #e9ecef; border-radius: 10px; overflow: hidden; margin: 20px 0;">
            <img src="{{ $imagemUrl }}" alt="{{ $trilha->nm_trilha_tri }}" style="width: 100%; max-height: 220px; object-fit: cover; display: block;">
            <div style="padding: 18px;">
                <h2 style="margin: 0 0 8px; font-size: 20px; color: #212529;">{{ $trilha->nm_trilha_tri }}</h2>
                @if(optional($trilha->cidade)->nm_cidade_cde)
                    <p style="margin: 0 0 10px; color: #666; font-size: 14px;">{{ $trilha->cidade->nm_cidade_cde }}@if(optional($trilha->nivel)->dc_nivel_niv) · {{ $trilha->nivel->dc_nivel_niv }}@endif</p>
                @endif
                @if($resumo)
                    <p style="margin: 0; color: #444; font-size: 15px;">{{ $resumo }}</p>
                @endif
            </div>
        </div>

        <div style="text-align: center; margin: 28px 0;">
            <a href="{{ $urlTrilha }}" style="display: inline-block; padding: 14px 32px; background-color: #28a745; color: #ffffff !important; text-decoration: none; border-radius: 5px; font-weight: bold;">
                Conhecer a aventura
            </a>
        </div>

        <p style="font-size: 14px; color: #666;">Boas trilhas e até a próxima aventura!</p>
        <p style="font-size: 13px; color: #999; margin-top: 24px; border-top: 1px solid #eee; padding-top: 16px;">
            Equipe Trilhas em SC<br>
            <a href="{{ url('/') }}" style="color: #28a745;">trilhasemsc.com.br</a>
        </p>
    </div>
</body>
</html>

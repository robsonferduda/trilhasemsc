<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificação de Cancelamento de Notificações</title>
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
            background-color: #dc3545;
            color: white;
            padding: 20px;
            border-radius: 8px 8px 0 0;
            margin: -30px -30px 20px -30px;
        }
        h1 {
            margin: 0;
            font-size: 24px;
        }
        .info-block {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 6px;
            margin: 15px 0;
        }
        .info-row {
            padding: 8px 0;
            border-bottom: 1px solid #e9ecef;
        }
        .info-row:last-child {
            border-bottom: none;
        }
        .info-label {
            font-weight: bold;
            color: #666;
            display: inline-block;
            min-width: 150px;
        }
        .button {
            display: inline-block;
            padding: 12px 30px;
            background-color: #007bff;
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
            font-weight: bold;
            text-align: center;
        }
        .alert-info {
            background-color: #d1ecf1;
            border-left: 4px solid #0c5460;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e9ecef;
            font-size: 12px;
            color: #999;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🔔 Notificação de Cancelamento de Notificações</h1>
        </div>

        <p style="font-size: 16px; margin-bottom: 20px;">Um trilheiro cancelou as notificações.</p>

        <h2 style="color: #333; font-size: 18px; margin-top: 25px;">Dados do Trilheiro</h2>
        
        <div class="info-block">
            <div class="info-row">
                <span class="info-label">Nome:</span>
                <strong>{{ $trilheiro->nm_trilheiro_tri }}</strong>
            </div>
            <div class="info-row">
                <span class="info-label">Email:</span>
                <a href="mailto:{{ $trilheiro->user->email }}">{{ $trilheiro->user->email }}</a>
            </div>
            <div class="info-row">
                <span class="info-label">ID:</span>
                {{ $trilheiro->id_trilheiro_tri }}
            </div>
            <div class="info-row">
                <span class="info-label">Cadastrado em:</span>
                {{ \Carbon\Carbon::parse($trilheiro->created_at)->format('d/m/Y H:i') }}
            </div>
            <div class="info-row">
                <span class="info-label">Cancelado em:</span>
                {{ now()->format('d/m/Y H:i') }}
            </div>
            @if($trilheiro->user->dt_last_login)
            <div class="info-row">
                <span class="info-label">Último login:</span>
                {{ \Carbon\Carbon::parse($trilheiro->user->dt_last_login)->format('d/m/Y H:i') }}
                ({{ \Carbon\Carbon::parse($trilheiro->user->dt_last_login)->diffForHumans() }})
            </div>
            @else
            <div class="info-row">
                <span class="info-label">Último login:</span>
                <span style="color: #dc3545;">Nunca fez login</span>
            </div>
            @endif
            @if($trilheiro->origem)
            <div class="info-row">
                <span class="info-label">Cidade de Origem:</span>
                {{ $trilheiro->origem->nm_cidade_cde }}
            </div>
            @endif
        </div>

        @if($motivoDescadastro)
        <h2 style="color: #333; font-size: 18px; margin-top: 25px;">Motivo informado</h2>
        <div class="alert-info">
            {{ $motivoDescadastro }}
        </div>
        @endif

        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ url('admin/trilheiro/perfil/' . $trilheiro->id_trilheiro_tri) }}" class="button">
                Ver Perfil do Trilheiro
            </a>
        </div>

        <div class="footer">
            <p>Esta é uma notificação automática do sistema.</p>
        </div>
    </div>
</body>
</html>

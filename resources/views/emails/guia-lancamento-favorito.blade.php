<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>{{ $guia->nm_guia_gui }} lançou um passeio</title>
</head>
<body style="font-family: sans-serif; color: #333; line-height: 1.5;">
    <p>Olá, {{ explode(' ', trim($trilheiro->nm_trilheiro_tri))[0] }}.</p>
    <p><strong>{{ $guia->nm_guia_gui }}</strong>, guia que você marcou como favorito, lançou um passeio:</p>
    <p>
        <strong>{{ $evento->nm_evento_eve }}</strong><br>
        {{ \Carbon\Carbon::parse($evento->dt_realizacao_eve)->format('d/m/Y') }}
        @if($evento->local)
            · {{ $evento->local->nm_cidade_cde }}
        @endif
    </p>
    <p><a href="{{ $evento->url }}">Ver o passeio</a></p>
    <p style="color: #718096; font-size: 13px;">Você recebe este aviso porque favoritou este guia no Trilhas em SC. Para parar, abra o perfil dele e desmarque o favorito.</p>
</body>
</html>

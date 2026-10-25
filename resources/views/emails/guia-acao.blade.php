<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>{{ $conteudo['assunto'] }}</title>
</head>
<body style="font-family: sans-serif; color: #333; line-height: 1.5;">
    @foreach($conteudo['paragrafos'] as $paragrafo)
        <p>{{ $paragrafo }}</p>
    @endforeach
    <p><a href="{{ $conteudo['url'] }}">{{ $conteudo['botao'] }}</a></p>
    <p style="color: #718096; font-size: 13px;">Equipe Trilhas em SC. Este aviso segue a situação atual do seu perfil.</p>
</body>
</html>

<h1>Trilhas em SC</h1>

<p>Perfil {{ env('APP_URL').'/guia/perfil/'.$guia->id_guia_gui }}</p>
<p><a href="{{ url("guia/{$guia->id_guia_gui}/ativar") }}">Ativar</a></p>

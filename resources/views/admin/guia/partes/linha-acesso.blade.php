<tr>
    <td>@include('admin.guia.partes.nome', ['guia' => $linha->guia])</td>
    <td>{{ $linha->visitas30 }}</td>
    <td>{{ $linha->visitas }}</td>
    <td>{{ $linha->contatos30 }}</td>
    <td>{{ $linha->eventos }}</td>
    <td>@include('admin.guia.partes.quando', ['data' => $linha->login])</td>
    <td>@include('admin.guia.partes.selo', ['linha' => $linha, 'tom' => $tom])</td>
</tr>

@extends('layouts.blog')

@section('content')
<div class="container">
    <div class="row justify-content-center" style="margin-top: 30px;">
        <div class="col-md-12">
            <div class="section-title text-center title-left">
                <div class="title-border">
                    <h1>LISTAR <span>TRILHAS</span></h1>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-12">
            <table id="tablePreview" class="table">
              <tr>
                <th>ID</th>
                <th>Trilha</th> 
                <th>Editar</th>
              </tr>
              @foreach($trilhas as $trilha)
                <tr>
                    <td>{{ $trilha->id_trilha_tri }}</td>
                    <td>{{ $trilha->nm_trilha_tri }}</td>
                    <td><a href="{{ url('admin/editar-trilha/'.$trilha->id_trilha_tri) }}">Editar</a></td>
                </tr>
              @endforeach
            </table>
        </div>
    </div>
</div>
@endsection
@extends('layouts.blog')

@section('content')
<div class="container">
    <div class="row justify-content-center" style="margin-top: 30px;">
        <div class="col-md-12">
            <div class="section-title text-center title-left">
                <div class="title-border">
                    <h1>EDITAR <span>TRILHAS</span></h1>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-12">
           <div class="sign-in-container">
                <h3>{{ $trilha->nm_trilha_tri }}</h3>
                @include('layouts/mensagens')
                <form action="{{ url('admin/update-trilha') }}" method="post">
                    @csrf
                    <div class="sign-in-form">
                        <input type="hidden" name="id_trilha_tri" value="{{ $trilha->id_trilha_tri }}">
                        <textarea name="ds_trilha_tri" rows="15" style="width: 100%;">
                            {{ $trilha->ds_trilha_tri }}
                        </textarea>                        
                        <input type="submit" class="submit-button" value="ATUALIZAR">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
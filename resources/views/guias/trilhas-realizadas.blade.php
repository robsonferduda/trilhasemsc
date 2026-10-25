@extends('layouts.site')
@section('pageTitle', 'Trilhas realizadas | ' . $guia->nm_guia_gui)
@section('robots', 'noindex,nofollow')
@section('description', 'Lista para o trilheiro marcar presença nas trilhas já realizadas com ' . $guia->nm_guia_gui . '.')

@section('content')
<section class="pt-1 pb-0 mt-3 mb-5">
    <div class="container">
        <div class="row mb-2">
            <div class="col-md-12">
                <h1 class="text-success h3 mb-1"><i class="fa fa-check" aria-hidden="true"></i> Trilhas realizadas</h1>
                <p class="mb-1">{{ $guia->nm_guia_gui }}</p>
                <p class="text-muted" style="font-size:.95rem;">Da mais recente para a mais antiga. Se você participou, marque <strong>Eu fui</strong>. Isso atualiza as estatísticas do guia.</p>
            </div>
        </div>

        @include('guias.partes.trilhas-realizadas-lista')
    </div>
</section>
@endsection

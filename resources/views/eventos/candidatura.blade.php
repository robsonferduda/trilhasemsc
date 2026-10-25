@extends('layouts.site')
@section('content')
@include('layouts/partes/header-eventos')
<section class="pt-1 pb-0 mt-3 mb-5">
    <div class="container">
        <div class="row mb-3">
            <div class="col-md-8 offset-md-2">
                <h3 class="text-success">Candidatar-se à trilha</h3>
                <p class="mb-1"><strong>{{ $evento->nm_evento_eve }}</strong></p>
                <p class="text-muted">{{ \Carbon\Carbon::parse($evento->dt_realizacao_eve)->format('d/m/Y') }}</p>
                @include('layouts.mensagens')
                <div class="alert alert-warning">
                    O CPF é pedido só nesta candidatura, para o registro da inscrição e para o seguro da atividade. Ele não entra no seu cadastro de trilheiro.
                </div>
                <form method="post" action="{{ url('trilheiro/privado/eventos/participar/'.$evento->id_evento_eve) }}">
                    @csrf
                    @if($pedeNome)
                        <div class="form-group mb-3">
                            <label for="nm_trilheiro_tri">Nome completo</label>
                            <input type="text" name="nm_trilheiro_tri" id="nm_trilheiro_tri" class="form-control" value="{{ old('nm_trilheiro_tri', $trilheiro->nm_trilheiro_tri) }}" required>
                        </div>
                    @endif
                    @if($pedeNascimento)
                        <div class="form-group mb-3">
                            <label for="dt_nascimento">Data de nascimento</label>
                            <input type="text" name="dt_nascimento" id="dt_nascimento" class="form-control" value="{{ old('dt_nascimento') }}" placeholder="dd/mm/aaaa" required>
                        </div>
                    @endif
                    <div class="form-group mb-3">
                        <label for="nr_documento">CPF</label>
                        <input type="text" name="nr_documento" id="nr_documento" class="form-control" value="{{ $documento ? \App\EventoTrilheiro::formatarCpf($documento) : '' }}" placeholder="000.000.000-00" inputmode="numeric" autocomplete="off" required>
                    </div>
                    <button type="submit" class="btn btn-success">Registrar interesse</button>
                    <a href="{{ $evento->url }}" class="btn btn-outline-secondary">Voltar</a>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

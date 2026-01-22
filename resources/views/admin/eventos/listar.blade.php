@extends('layouts.template')

@section('content')
    <div class="block-header">
        <div class="row">
            <div class="col-lg-5 col-md-8 col-sm-12">
                <h2>Guias e Condutores</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><i class="fa fa-id-card"></i> Guias e Condutores</li>
                    <li class="breadcrumb-item">Eventos</li>
                    <li class="breadcrumb-item">Meus Eventos</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12">
            <div class="card planned_task">
                <div class="header no-padding-bottom">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <h2><i class="fa fa-tags"></i> Meus Eventos</h2>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <a href="{{ url('guia-e-condutores/privado/evento/novo') }}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Novo Evento</a>
                        </div> 
                    </div>
                </div>
                
                <div class="body mt-0 pt-0">
                    @include('layouts.mensagens')

                    @forelse($eventos as $key => $evento)
                        <div class="card rounded shadow">
                            <div class="body">
                                <div class="row">
                                    <div class="col-12">
                                        <h6 class="title">{{ $evento->nm_evento_eve }} <small class="float-right text-muted">{{ \Carbon\Carbon::parse($evento->hora_inicio_eve)->format('H:i') }} - {{ \Carbon\Carbon::parse($evento->hora_fim_eve )->format('H:i') }} </small></h6>
                                    </div>
                                    <div class="col-12">
                                        <p class="mb-1"><strong>Local</strong>: {{ $evento->local->nm_cidade_cde }}</p>
                                        <p class="mb-1"><strong>Data</strong>: {{ \Carbon\Carbon::parse($evento->dt_realizacao_eve)->format('d/m/Y') }}</p>
                                        <p class="mb-1"><strong>Valor</strong>: {{ ($evento->valor_eve) ? "R$ ".$evento->valor_eve : 'Gratuita' }}</p>
                                        <p class="mb-1">
                                            <strong>Participantes</strong>: 
                                            <span class="badge badge-info">{{ $evento->participantes_count }}</span>
                                            &nbsp;|&nbsp;
                                            <strong>Vezes oferecido</strong>: 
                                            <span class="badge badge-success">{{ $evento->vezes_oferecido }}x</span>
                                        </p>
                                        <div style="position: absolute; bottom: 1px; right: 10px;">
                                            <a href="{{ url('guia-e-condutores/privado/eventos/participantes', $evento->id_evento_eve) }}" class="btn btn-outline-danger btn-sm"><i class="fa fa-users"></i> Participantes</a>
                                            <a href="{{ url('eventos/' . ($evento->slug_eve ?: $evento->id_evento_eve)) }}" class="btn btn-outline-info btn-sm"><i class="fa fa-eye"></i> Ver</a>
                                            <a href="{{ url('guia-e-condutores/privado/evento/editar', $evento->id_evento_eve) }}" class="btn btn-outline-primary btn-sm"><i class="fa fa-edit"></i> Editar</a>
                                            <form id="form-clonar-{{ $evento->id_evento_eve }}" action="{{ route('evento.clonar', $evento->id_evento_eve) }}" method="POST" style="display: inline;">
                                                @csrf
                                                <button type="button" class="btn btn-outline-success btn-sm btn-clonar" data-evento-id="{{ $evento->id_evento_eve }}" data-evento-nome="{{ $evento->nm_evento_eve }}" title="Clonar este evento">
                                                    <i class="fa fa-copy"></i> Clonar
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="card rounded shadow">
                            <div class="body">
                                <div class="row">
                                    <div class="col-6">
                                        <h6>Nenhum evento cadastrado</h6>
                                        <p class="mb-1">Cadastre novos eventos na opção <a href="{{ url('guia-e-condutores/privado/evento/novo') }}"><strong>Novo Evento</strong></a> e torne-se visível para quem procura aventura</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforelse 
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(function() {
            
        });
        
        // SweetAlert para clonar eventos
        $('.btn-clonar').on('click', function(e) {
            e.preventDefault();
            const eventoId = $(this).data('evento-id');
            const eventoNome = $(this).data('evento-nome');
            
            Swal.fire({
                title: 'Clonar Evento',
                html: `Deseja realmente clonar o evento:<br><strong>"${eventoNome}"</strong>?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="fa fa-copy"></i> Sim, clonar!',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#form-clonar-' + eventoId).submit();
                }
            });
        });
    </script>
@endsection
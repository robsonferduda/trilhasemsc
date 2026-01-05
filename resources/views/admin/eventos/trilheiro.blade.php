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
                                        <p class="mb-1"><strong>Local</strong>: {{ $evento->local->nm_cidade_cde }}</p>
                                        <p class="mb-1"><strong>Data</strong>: {{ \Carbon\Carbon::parse($evento->dt_realizacao_eve)->format('d/m/Y') }}</p>
                                        <p class="mb-1"><strong>Início/Término</strong>: {{ \Carbon\Carbon::parse($evento->hora_inicio_eve)->format('H:i') }} - {{ \Carbon\Carbon::parse($evento->hora_fim_eve )->format('H:i') }}</p>
                                        <p class="mb-1"><strong>Valor</strong>: {{ ($evento->valor_eve) ? "R$ ".$evento->valor_eve : 'Gratuita' }}</p>
                                        
                                        <div>
                                            <a href="{{ url('eventos/detalhes', $evento->id_evento_eve) }}" class="btn btn-outline-info btn-sm" target="BLANK"><i class="fa fa-eye"></i> Detalhes do Evento</a>
                                            <button type="button" class="btn btn-outline-danger btn-sm btn-cancelar-participacao" data-url="{{ url('trilheiro/privado/eventos/cancelar/'.$evento->id_evento_eve) }}">
                                                <i class="fa fa-times"></i> Cancelar Participação
                                            </button>

                                        <p class="mb-1" style="float: right">
                                                @if(is_null($evento->pivot->fl_aceito_guia_evt))
                                                    <span class="badge badge-warning">Pedido pendente</span>
                                                @elseif($evento->pivot->fl_aceito_guia_evt)
                                                    <span class="badge badge-success">Pedido Aceito</span>
                                                @else
                                                    <span class="badge badge-danger">Pedido recusado</span>
                                                @endif
                                            </p>
                                            <p class="mb-1"  style="float: right">
                                                @if(is_null($evento->pivot->fl_pago_evt))
                                                    <span class="badge badge-warning">Pagamento Pendente</span>
                                                @elseif($evento->pivot->fl_pago_evt)
                                                    <span class="badge badge-success">Pago</span>
                                                @else
                                                    <span class="badge badge-danger">Não Pago</span>
                                                @endif
                                        </p>
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
                                        <h6>Você não está cadastrado em nenhum evento</h6>
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
            $('.btn-cancelar-participacao').on('click', function() {
                const url = $(this).data('url');
                
                Swal.fire({
                    title: 'Cancelar Participação?',
                    text: "Tem certeza que deseja cancelar sua participação neste evento?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Sim, cancelar',
                    cancelButtonText: 'Não, manter',
                    reverseButtons: true,
                    customClass: {
                        confirmButton: 'btn btn-success mx-1',
                        cancelButton: 'btn btn-secondary mx-1'
                    },
                    buttonsStyling: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = url;
                    }
                });
            });
        });
    </script>
@endsection
<div class="row clearfix">
    @forelse($trilheiros as $trilheiro)
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="row p-3">
                    <div class="col-lg-2 col-md-3 col-sm-12">
                        <a href="{{ url('admin/trilheiro/perfil/'.$trilheiro->id_trilheiro_tri) }}"><img src="{{ $trilheiro->nm_path_foto_tri ? asset('img/trilheiros/'.$trilheiro->nm_path_foto_tri) : asset('images/user.png') }}" class="rounded-circle user-photo w-100" alt="Foto de Perfil"></a>
                        <p class="mb-2 text-center mt-2 mb-0"><i class="fa fa-star text-warning" aria-hidden="true"></i> <strong>{{ $trilheiro->nu_pontos_experiencia_tri }}</strong> XP</p>
                        <p class="text-center mb-0">
                            @if($trilheiro->fl_newsletter_tri)
                                <i class="fa fa-bell text-success" aria-hidden="true" title="Newsletter ativa"> Ativadas</i>
                            @else
                                <i class="fa fa-bell-slash text-muted" aria-hidden="true" title="Newsletter inativa"> Desativadas</i>
                            @endif
                        </p>
                    </div>
                    <div class="col-lg-8 col-md-9 col-sm-12">
                        <div class="row">
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <div class="text" style="font-size: 16px;">{{ $trilheiro->nm_trilheiro_tri }}</div>
                                <p class="mt-2 mb-2"><strong>E-mail:</strong> <a href="mailto:{{ $trilheiro->user->email }}">{{ $trilheiro->user->email }}</a></p>
                                <p class="mb-2"><strong>Cidade de Origem</strong>: {!! ($trilheiro->origem) ? $trilheiro->origem->nm_cidade_cde : '<span class="text-danger">Não Informada</span>' !!}</p>
                                <p class="mb-2"><strong>Data de Nascimento</strong>: {{ ($trilheiro->dt_nascimento) ? \Carbon\Carbon::parse($trilheiro->dt_nascimento)->format('d/m/Y').' - '.\Carbon\Carbon::parse($trilheiro->dt_nascimento)->age.' Anos' : 'Não Informada' }}</p>
                                <p class="mb-2">Cadastro realizado em {{ \Carbon\Carbon::parse($trilheiro->created_at)->format('d/m/Y H:i:s') }}</p>
                                <p class="mb-2">
                                    <strong>Último Login:</strong> 
                                    @if($trilheiro->user->dt_last_login)
                                        {{ \Carbon\Carbon::parse($trilheiro->user->dt_last_login)->format('d/m/Y H:i:s') }} 
                                        <span class="text-muted">({{ \Carbon\Carbon::parse($trilheiro->user->dt_last_login)->diffForHumans() }})</span>
                                    @else
                                        <span class="text-warning">Nenhum login registrado</span>
                                    @endif
                                </p>
                                <div class="mt-3">
                                    <form action="{{ route('admin.trilheiro.enviar-email', $trilheiro->id_trilheiro_tri) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-info" title="Enviar email de boas-vindas para teste">
                                            <i class="fa fa-envelope"></i> Enviar Email de Teste
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-12 center">
                        <h2 class="mb-0 mt-5">{{ $trilheiro->nr_score_tri }}</h2>
                        <span>{{ $trilheiro->indice->ds_indice_ind }}</span>
                        <img src="{{ asset('img/nivel/'.$trilheiro->indice->img_indice_ind) }}" class="w-100" alt="Foto de Perfil">
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-warning text-center">
                <i class="fa fa-exclamation-triangle"></i> Nenhum trilheiro encontrado com os filtros aplicados.
            </div>
        </div>
    @endforelse
</div>

@extends('layouts.admin')
@section('pageTitle', 'Estatísticas | Trilhas em SC')

@section('content')
<style>
    .pa-ano-numeros.is-linha {
        grid-template-columns: repeat(5, minmax(0, 1fr));
    }
    .pa-numero {
        position: relative;
        overflow: hidden;
        min-width: 0;
    }
    .pa-numero > i {
        position: absolute;
        right: 6px;
        bottom: 2px;
        font-size: 2.8rem;
        line-height: 1;
        opacity: .2;
        pointer-events: none;
    }
    .pa-numero strong,
    .pa-numero span {
        position: relative;
    }
    .pa-ano-numeros article.pa-numero-pessoas { background: #eff6ff; border-color: #dbeafe; }
    .pa-numero-pessoas > i { color: #2563eb; }
    .pa-ano-numeros article.pa-numero-trilhas { background: #f0fdf4; border-color: #bbf7d0; }
    .pa-numero-trilhas > i { color: #16a34a; }
    .pa-ano-numeros article.pa-numero-km { background: #f0fdfa; border-color: #99f6e4; }
    .pa-numero-km > i { color: #0f766e; }
    .pa-ano-numeros article.pa-numero-subida { background: #fffbeb; border-color: #fde68a; }
    .pa-numero-subida > i { color: #d97706; }
    .pa-ano-numeros article.pa-numero-cidades { background: #f5f3ff; border-color: #ddd6fe; }
    .pa-numero-cidades > i { color: #7c3aed; }
    @media (max-width: 991.98px) {
        .pa-ano-numeros.is-linha {
            grid-template-columns: repeat(5, minmax(0, 1fr));
        }
        .pa-ano-numeros.is-linha strong {
            font-size: 1.35rem;
        }
        .pa-ano-numeros.is-linha article {
            padding: 14px 10px;
        }
        .pa-ano-numeros.is-linha span {
            letter-spacing: 0;
            font-size: 0.68rem;
        }
        .pa-numero > i {
            font-size: 2.4rem;
        }
    }
    @media (max-width: 575.98px) {
        .pa-ano-numeros.is-linha strong {
            font-size: 1.05rem;
        }
        .pa-ano-numeros.is-linha article {
            padding: 12px 6px;
        }
        .pa-numero > i {
            display: none;
        }
    }
</style>

    <div class="block-header">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12">
                <h2>Estatísticas</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">Guias e Condutores</li>
                    <li class="breadcrumb-item">Suas trilhas</li>
                </ul>
            </div>
        </div>
    </div>

    @php $urlPresencas = url('guia/trilhas-realizadas/'.($guia->nm_instagram_gui ?: $guia->id_guia_gui)); @endphp
    <p class="text-muted mb-3">Para atualizar os totais, envie este endereço aos trilheiros. Nele eles marcam <strong>Eu fui</strong> nos eventos que já passaram: <a href="{{ $urlPresencas }}">{{ $urlPresencas }}</a></p>

    @if($resumoAno['trilhas'] > 0)
        <div class="pa-ano">
            <section class="pa-ano-numeros {{ $eventos_realizados->isNotEmpty() ? 'is-linha' : 'is-dois' }}">
                <article class="pa-numero pa-numero-pessoas">
                    <i class="bi bi-people" aria-hidden="true"></i>
                    <strong>{{ $resumoAno['pessoas'] }}</strong>
                    <span>{{ $resumoAno['pessoas'] === 1 ? 'pessoa' : 'pessoas' }}</span>
                </article>
                <article class="pa-numero pa-numero-trilhas">
                    <i class="bi bi-signpost-2" aria-hidden="true"></i>
                    <strong>{{ $resumoAno['trilhas'] }}</strong>
                    <span>{{ $resumoAno['trilhas'] === 1 ? 'trilha' : 'trilhas' }}</span>
                </article>
                @if($eventos_realizados->isNotEmpty())
                    <article class="pa-numero pa-numero-km">
                        <i class="bi bi-signpost-split" aria-hidden="true"></i>
                        <strong>{{ $totais['km'] }}</strong>
                        <span>km</span>
                    </article>
                    <article class="pa-numero pa-numero-subida">
                        <i class="bi bi-arrow-up" aria-hidden="true"></i>
                        <strong>{{ $totais['subida'] }}</strong>
                        <span>m de subida</span>
                    </article>
                    <article class="pa-numero pa-numero-cidades">
                        <i class="bi bi-geo-alt" aria-hidden="true"></i>
                        <strong>{{ $totais['cidades'] }}</strong>
                        <span>{{ $totais['cidades'] === 1 ? 'cidade' : 'cidades' }}</span>
                    </article>
                @endif
            </section>
            @if($eventos_realizados->isNotEmpty() && $totais['parcial'])
                <p class="text-muted mb-3">Quilômetros e metros de subida somam as trilhas que têm esses dados. Cidades contam os locais diferentes dos eventos já realizados.</p>
            @endif
            @if($resumoAno['destaque'])
                <section class="pa-ano-card pa-ano-destaque">
                    <p>Quem mais caminhou</p>
                    <div>
                        <img src="{{ $resumoAno['destaque']['foto'] }}" alt="">
                        <div>
                            <h3>{{ $resumoAno['destaque']['nome'] }}</h3>
                            <span>{{ $resumoAno['destaque']['trilhas'] }} {{ $resumoAno['destaque']['trilhas'] === 1 ? 'trilha' : 'trilhas' }}</span>
                        </div>
                    </div>
                    @if($resumoAno['demais']->count())
                        <p>Demais participantes</p>
                        <div>
                            @foreach($resumoAno['demais'] as $pessoa)
                                <span>{{ $pessoa['nome'] }} · {{ $pessoa['trilhas'] }}</span>
                            @endforeach
                        </div>
                    @endif
                </section>
            @else
                <section class="pa-ano-card">
                    <h3>Nenhum participante ainda</h3>
                    <div class="text-muted">As trilhas desta lista ainda não têm trilheiros inscritos.</div>
                </section>
            @endif

            @if($eventos_realizados->isNotEmpty())
                <h3 class="h5 mt-4 mb-3">Trilhas realizadas</h3>
                @include('guias.partes.trilhas-realizadas-lista')
            @endif
        </div>
    @else
        <section class="pa-ano-card">
            <h3>Nenhuma trilha cadastrada</h3>
            <div class="text-muted">Quando houver eventos em Meus eventos, as pessoas inscritas aparecem aqui. O destaque fica com quem participar de mais trilhas.</div>
        </section>
    @endif
@endsection

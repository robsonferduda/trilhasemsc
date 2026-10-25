@extends('layouts.admin')
@section('pageTitle', 'Acessos ao perfil | Trilhas em SC')

@section('content')
<style>
    .gd-topo { margin-bottom: 18px; }
    .gd-topo h2 { margin: 0 0 4px; font-weight: 800; letter-spacing: -0.03em; }
    .gd-topo p { margin: 0; color: #718096; }
    .gd-numeros {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 12px;
        margin-bottom: 14px;
    }
    .gd-numero {
        padding: 16px;
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
    }
    .gd-numero span {
        display: block;
        color: #718096;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.04em;
        text-transform: uppercase;
    }
    .gd-numero strong {
        display: block;
        margin-top: 6px;
        font-size: 1.8rem;
        line-height: 1;
        color: #1a202c;
    }
    .gd-numero small { color: #718096; }
    .gd-card {
        margin-bottom: 14px;
        padding: 20px;
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 18px;
    }
    .gd-card h3 { margin: 0 0 14px; font-size: 1.1rem; font-weight: 800; }
    .gd-dias {
        display: flex;
        align-items: flex-end;
        gap: 4px;
        height: 140px;
    }
    .gd-dia {
        flex: 1 1 0;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        height: 100%;
        min-width: 0;
    }
    .gd-barra {
        display: block;
        width: 100%;
        background: #e07826;
        border-radius: 4px 4px 0 0;
        min-height: 3px;
    }
    .gd-barra.is-zero { background: #edf2f7; }
    .gd-eixo {
        display: flex;
        justify-content: space-between;
        margin-top: 8px;
        color: #718096;
        font-size: 0.75rem;
    }
    @media (max-width: 767.98px) {
        .gd-numeros { grid-template-columns: 1fr; }
    }
</style>

@php
    $perfilPublico = url('guia/perfil/'.($guia->nm_instagram_gui ?: $guia->id_guia_gui));
@endphp

<div class="gd-topo">
    <h2>Acessos ao perfil</h2>
    <p>Quem abriu seu perfil e quem chamou no WhatsApp ou no Instagram. A visita que você faz ao próprio perfil não entra.</p>
</div>

<div class="gd-numeros">
    <article class="gd-numero">
        <span>Visitas</span>
        <strong>{{ $visitas30 }}</strong>
        <small>{{ $visitas }} no total</small>
    </article>
    <article class="gd-numero">
        <span>WhatsApp</span>
        <strong>{{ $whatsapp30 }}</strong>
        <small>{{ $whatsapp }} no total</small>
    </article>
    <article class="gd-numero">
        <span>Instagram</span>
        <strong>{{ $instagram30 }}</strong>
        <small>{{ $instagram }} no total</small>
    </article>
</div>

<div class="gd-card">
    <h3>Visitas nos últimos 30 dias</h3>
    <div class="gd-dias">
        @foreach($dias as $dia)
            <div class="gd-dia" title="{{ $dia['rotulo'] }}: {{ $dia['total'] }}">
                <span class="gd-barra {{ $dia['total'] === 0 ? 'is-zero' : '' }}" style="height: {{ max(3, (int) round(($dia['total'] / $maior) * 100)) }}%"></span>
            </div>
        @endforeach
    </div>
    <div class="gd-eixo">
        <span>{{ $dias[0]['rotulo'] }}</span>
        <span>{{ $dias[14]['rotulo'] }}</span>
        <span>{{ $dias[29]['rotulo'] }}</span>
    </div>
</div>

<p class="text-muted mb-0">O endereço público é <a href="{{ $perfilPublico }}">{{ $perfilPublico }}</a>.</p>
@endsection

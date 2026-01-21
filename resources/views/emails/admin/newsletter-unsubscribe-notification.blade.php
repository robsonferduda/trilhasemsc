@component('mail::message')
# 🔔 Notificação de Descadastro

Um trilheiro se descadastrou da newsletter.

## Dados do Trilheiro

**Nome:** {{ $trilheiro->nm_trilheiro_tri }}  
**Email:** {{ $trilheiro->user->email }}  
**ID:** {{ $trilheiro->id_trilheiro_tri }}  
**Cadastrado em:** {{ \Carbon\Carbon::parse($trilheiro->created_at)->format('d/m/Y H:i') }}  
**Descadastrado em:** {{ now()->format('d/m/Y H:i') }}

@if($trilheiro->user->dt_last_login)
**Último login:** {{ \Carbon\Carbon::parse($trilheiro->user->dt_last_login)->format('d/m/Y H:i') }} ({{ \Carbon\Carbon::parse($trilheiro->user->dt_last_login)->diffForHumans() }})
@else
**Último login:** Nunca fez login
@endif

@if($trilheiro->origem)
**Cidade de Origem:** {{ $trilheiro->origem->nm_cidade_cde }}
@endif

@if($motivoDescadastro)
## Motivo informado

{{ $motivoDescadastro }}
@endif

---

@component('mail::button', ['url' => url('admin/trilheiro/perfil/' . $trilheiro->id_trilheiro_tri)])
Ver Perfil do Trilheiro
@endcomponent

<small style="color: #999;">Esta é uma notificação automática do sistema.</small>

@endcomponent

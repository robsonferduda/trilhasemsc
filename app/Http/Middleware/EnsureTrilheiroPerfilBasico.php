<?php

namespace App\Http\Middleware;

use App\Trilheiro;
use Auth;
use Closure;
use Laracasts\Flash\Flash;

class EnsureTrilheiroPerfilBasico
{
    /**
     * Exige cadastro básico (cidade, estado, sexo, nascimento) na área privada do trilheiro.
     * A rota atualizar-cadastro fica liberada para o usuário poder completar o perfil.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::check() || trim((string) Auth::user()->id_role) !== 'TRILHEIRO') {
            return $next($request);
        }

        if ($request->is('trilheiro/privado/atualizar-cadastro')) {
            return $next($request);
        }

        $trilheiro = Trilheiro::where('id_user', Auth::id())->first();

        if (!$trilheiro || !$trilheiro->perfilBasicoCompleto()) {
            Flash::warning('Complete seu cadastro (cidade, estado, sexo e data de nascimento) para continuar.');
            return redirect('trilheiro/privado/atualizar-cadastro');
        }

        return $next($request);
    }
}

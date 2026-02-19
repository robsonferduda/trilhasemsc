<?php

namespace App\Http\Middleware;

use App\Trilheiro;
use Auth;
use Closure;

class EnsureTrilheiroForRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $role = trim((string) $user->id_role);

            if (in_array($role, ['SOCIAL', 'TRILHEIRO'], true)) {
                $trilheiro = Trilheiro::withTrashed()->where('id_user', $user->id)->first();

                if (!$trilheiro) {
                    Trilheiro::create([
                        'id_user' => $user->id,
                        'nm_trilheiro_tri' => $user->name,
                    ]);
                } elseif ($trilheiro->trashed()) {
                    $trilheiro->restore();
                }
            }
        }

        return $next($request);
    }
}

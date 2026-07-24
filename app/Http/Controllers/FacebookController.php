<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Trilheiro;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class FacebookController extends Controller
{
    public function redirectToProvider($tipo = null)
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleProviderCallback(Request $request)
    {
        try {
            $userFacebook = Socialite::driver('facebook')->stateless()->user();
            $email = $userFacebook->getEmail();

            if (empty($email)) {
                return redirect('login')->withErrors([
                    'email' => 'Não recebemos seu email do Facebook. Verifique as permissões do perfil.',
                ]);
            }

            $user = User::where('email', $email)->first();

            if (!$user) {
                $user = User::create([
                    'name' => $userFacebook->getName(),
                    'email' => $email,
                    'fl_facebook' => 'S',
                    'id_role' => 'SOCIAL',
                    'password' => \Hash::make(rand(1, 10000)),
                ]);
            } else {
                $user->update([
                    'fl_facebook' => 'S',
                ]);
            }

            Auth::login($user);

            return Trilheiro::redirectAutenticado($user);
        } catch (\Exception $e) {
            \Log::error('Erro no login Facebook', ['error' => $e->getMessage()]);

            return redirect('login')->withErrors([
                'social' => 'Falha ao autenticar com Facebook. Tente novamente.',
            ]);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Trilheiro;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback(Request $request)
    {
        try {
            $userGoogle = Socialite::driver('google')->stateless()->user();
            $email = $userGoogle->getEmail();

            if (empty($email)) {
                return redirect('login')->withErrors([
                    'email' => 'Não recebemos seu email do Google. Verifique as permissões do perfil.',
                ]);
            }

            $user = User::where('email', $email)->first();

            if (!$user) {
                // SOCIAL: passa por escolher-perfil (trilheiro ou guia), igual ao Facebook
                $user = User::create([
                    'name' => $userGoogle->getName(),
                    'email' => $email,
                    'fl_google' => 'S',
                    'fl_social_usu' => true,
                    'id_role' => 'SOCIAL',
                    'password' => \Hash::make(rand(1, 10000)),
                ]);
            } else {
                $user->update([
                    'fl_google' => 'S',
                    'fl_social_usu' => true,
                ]);
            }

            Auth::login($user);

            return Trilheiro::redirectAutenticado($user);
        } catch (\Exception $e) {
            \Log::error('Erro no login Google', ['error' => $e->getMessage()]);

            return redirect('login')->withErrors([
                'social' => 'Falha ao autenticar com Google. Tente novamente.',
            ]);
        }
    }
}

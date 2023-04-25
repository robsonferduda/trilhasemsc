<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback(Request $request)
    {
        $request->tipo = 'guia';

        try {
            $userGoogle = Socialite::driver('google')->stateless()->user();
            $email = $userGoogle->getEmail();

            $user = User::where('email', $email)->first();

            if (!$user) {
                $dados = array('name' =>  $userGoogle->getName(),
                               'email' => $userGoogle->getEmail(),
                               'fl_google' => 'S',
                               'id_role' => $request->tipo == 'guia' ? 'guia' : null, //Para evitar que alterem a URL e acessem outros níveis de privilégios.
                               'password' => \Hash::make(rand(1, 10000)));
                
                $user = User::create($dados);
            }

            Auth::login($user);

            if($request->tipo == 'guia') {
                return redirect('guia-e-condutores/privado/atualizar-cadastro');
            }

            return redirect('login');
        } catch (Exception $e) {
            var_dump($e->getMessage());
        }
    }
}

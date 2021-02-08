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

    public function handleProviderCallback()
    {
        try {
            $userGoogle = Socialite::driver('google')->stateless()->user();
            $email = $userGoogle->getEmail();

            $user = User::where('email', $email)->first();

            if (!$user) {
                $dados = array('name' =>  $userGoogle->getName(),
                               'email' => $userGoogle->getEmail(),
                               'fl_google' => 'S',
                               'password' => \Hash::make(rand(1, 10000)));
                
                $user = User::create($dados);
            }

            Auth::login($user);

            return redirect('login');
        } catch (Exception $e) {
            var_dump($e->getMessage());
        }
    }
}

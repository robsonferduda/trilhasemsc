<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class FacebookController extends Controller
{

    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleProviderCallback()
    {
        try{
            
            $user_facebook = Socialite::driver('facebook')->stateless()->user();
            $email = $user_facebook->getEmail();

            $user = User::where('email',$email)->first();

            if(!$user){

                $dados = array('name' =>  $user_facebook->getName(), 
                               'email' => $user_facebook->getEmail(),
                               'password' => \Hash::make(rand(1,10000)));
                
                $user = User::create($dados);

            }

            Auth::login($user);

            return redirect('home');

        } catch (Exception $e) {
            var_dump($e->getMessage());
        }
    }
}

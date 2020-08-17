<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        //
    }

    public function index()
    {
        foreach (User::all() as $user) {
            echo "<pre>";
            echo $user;
            echo "</pre>";
        }
    }

    public function store()
    {
        /*
        $dados = array('name' => 'Robson Fernando Duda',
                       'email' => 'robsonferduda@gmail.com',
                       'password' => \Hash::make(@trilhas));
        User::create($dados);
        */
    }

    public function update()
    {
        /*
        $user = User::find(1);
        $user->password = \Hash::make('@trilhas');
        $user->save();
        */
    }
}

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
      dd(User::all());
    }

    public function store()
    {
        /*
        $dados = array('name' => 'Robson Fernando Duda', 
                       'email' => 'robsonferduda@gmail.com',
                       'password' => '@trilhas');
        User::create($dados);
        */
    }

   
}
<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    
    public function __construct()
    {
        //
    }

    public function index()
    {
        foreach (Tag::all() as $tag) {
            echo "<pre>";
            echo $tag;
            echo "</pre>";
        }
    }

    public function store()
    {
        /*
        $dados = array('ds_tag_tag' => 'Sul da Ilha');
        Tag::create($dados);
        */
    }

   
}
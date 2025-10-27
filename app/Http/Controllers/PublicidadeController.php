<?php

namespace App\Http\Controllers;

use App\Publicidade;
use App\PublicidadeEstatistica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PublicidadeController extends Controller
{
    public function rastreio($codigo)
    {
    	$ip = '';
    	
        $publicidade = Publicidade::where('ds_codigo_pub',$codigo)->first();
        $publicidade->nu_acessos_pub = $publicidade->nu_acessos_pub + 1;
        
        if($publicidade->save()){

        	PublicidadeEstatistica::create([
                'id_publicidade_pub' => $publicidade->id_publicidade_pub,
                'nu_ip_pue' => $ip
            ]);
        }

        return redirect($publicidade->ds_link_pub); 
    }
}
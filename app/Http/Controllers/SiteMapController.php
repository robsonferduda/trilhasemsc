<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trilha;

class SiteMapController extends Controller
{
    public function __construct()
    {
        //
    }

    private function make()
    {
        $sitemap = \App::make("sitemap");

        // add items to the sitemap (url, date, priority, freq)
        $sitemap->add(\URL::to('/'), now(), '1.0', 'daily');
        
        $sitemap->add(\URL::to('camping'), now(), '0.9', 'weekly');
        $sitemap->add(\URL::to('guia-de-dificuldade-em-trilhas'), now(), '0.9', 'monthly');
        $sitemap->add(\URL::to('guia-de-dificuldade-em-trilhas/abnt'), now(), '0.9', 'monthly');
        $sitemap->add(\URL::to('guia-de-dificuldade-em-trilhas/femerj'), now(), '0.9', 'monthly');

        $trilhas = Trilha::get();

        foreach ($trilhas as $trilha) {
            // get all images for the current post
            $images = array();
            foreach ($trilha->foto as $foto) {
                $images[] = array(
                    'url' => \URL::to('public/img/trilhas/'.$foto->tipo->dc_path_tfp.'/'.$foto->nm_path_fot),
                    'title' => $foto->dc_alt_fot,
                    'caption' => $foto->dc_alt_fot
                );
            }

            $sitemap->add(\URL::to($trilha->ds_url_tri), $trilha->updated_at, '0.9', 'weekly', $images);
        }

        return $sitemap;
    }

    public function gerar()
    {
        $sitemap = $this->make();
        
        // generate your sitemap (format, filename)
        return $sitemap->store('xml', 'sitemap');
    }

    public function visualizar($tipo)
    {
        $sitemap = $this->make();
        
        // generate your sitemap (format, filename)
        return $sitemap->render($tipo);
    }
}

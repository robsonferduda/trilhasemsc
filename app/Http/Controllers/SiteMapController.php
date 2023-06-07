<?php

namespace App\Http\Controllers;

use App\Cidade;
use Illuminate\Http\Request;
use App\Trilha;
use App\Galeria;

class SiteMapController extends Controller
{
    public function __construct()
    {
        //
    }

    private function make()
    {
        $sitemap = \App::make('sitemap');

        // add items to the sitemap (url, date, priority, freq)
        $sitemap->add(\URL::to('/'), now(), '1.0', 'daily');
        
        $images = array(
            ['url' => \URL::to('public/img/camping/vale-da-utopia/capa.jpg'),
             'title' =>  'Vista panorâmica Vale da Utopia',
             'caption' => 'Vista panorâmica Vale da Utopia'
            ],
            ['url' => \URL::to('public/img/camping/vale-da-utopia/animais.jpg'),
             'title' =>  'Animais no Vale da Utopia',
             'caption' => 'Animais no Vale da Utopia'
            ],
            ['url' => \URL::to('public/img/camping/vale-da-utopia/banheiros.jpg'),
             'title' =>  'Banheiros no Vale da Utopia',
             'caption' => 'Banheiros no Vale da Utopia'
            ],
            ['url' => \URL::to('public/img/camping/vale-da-utopia/sunrise.jpg'),
             'title' =>  'Nascer do Sol Vale da Utopia',
             'caption' => 'Nascer do Sol Vale da Utopia'
            ]
        );

        $sitemap->add(\URL::to('camping'), now(), '0.9', 'weekly', $images);

        $sitemap->add(\URL::to('campings'), now(), '0.9', 'weekly');
        $sitemap->add(\URL::to('garuva/campings/selvagem/camping-monte-crista'), now(), '0.9', 'weekly');
        $sitemap->add(\URL::to('bom-jardim-da-serra/campings/selvagem/camping-pico-rinoceronte'), now(), '0.9', 'weekly');
        $sitemap->add(\URL::to('rancho-queimado/campings/estruturado/camping-mirante-do-alto-da-boa-vista'), now(), '0.9', 'weekly');
        $sitemap->add(\URL::to('grao-para/campings/estruturado/camping-mirante'), now(), '0.9', 'weekly');
        $sitemap->add(\URL::to('laguna/campings/selvagem/camping-mirante-anita-garibaldi'), now(), '0.9', 'weekly');
        
        $sitemap->add(\URL::to('guia-de-dificuldade-em-trilhas'), now(), '0.9', 'monthly');
        $sitemap->add(\URL::to('guia-de-dificuldade-em-trilhas/abnt'), now(), '0.9', 'monthly');
        $sitemap->add(\URL::to('guia-de-dificuldade-em-trilhas/femerj'), now(), '0.9', 'monthly');

        $sitemap->add(\URL::to('trilhas/florianopolis/regioes/leste'), now(), '0.9', 'monthly');
        $sitemap->add(\URL::to('trilhas/florianopolis/regioes/norte'), now(), '0.9', 'monthly');
        $sitemap->add(\URL::to('trilhas/florianopolis/regioes/sul'), now(), '0.9', 'monthly');
        $sitemap->add(\URL::to('trilhas/brasil/regioes/nordeste/chapada'), now(), '0.9', 'monthly');

        $sitemap->add(\URL::to('https://trilhasemsc.com.br/trilhas/santa-catarina/regioes'), now(), '0.9', 'monthly');
        $sitemap->add(\URL::to('https://trilhasemsc.com.br/trilhas/santa-catarina/regioes/serra-catarinense'), now(), '0.9', 'monthly');

        $trilhas = Trilha::where('fl_publicacao_tri', 'S')->get();

        $cidades = $trilhas->unique('cd_cidade_cde')->pluck('cd_cidade_cde')->toArray();

        $cidades = Cidade::whereIn('cd_cidade_cde', $cidades)->selectRaw("unaccent(replace(lower(nm_cidade_cde),' ','-'))")->get();

        foreach ($trilhas as $trilha) {
            // get all images for the current Trilha
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

        foreach ($cidades as $cidade) {
            $sitemap->add(\URL::to('trilhas-em-'.$cidade->nm_cidade_cde), now(), '0.9', 'monthly');
        }

        return $sitemap;
    }

    public function gerar()
    {
        $sitemap = $this->make();

        if (strpos(\URL::to('/'), 'http') !== false && strpos(\URL::to('/'), 'www') === false) {
            $sitemapName = 'sitemap-http';
        }
        
        if (strpos(\URL::to('/'), 'http') !== false && strpos(\URL::to('/'), 'www') !== false) {
            $sitemapName = 'sitemap-http-www';
        }

        if (strpos(\URL::to('/'), 'https') !== false && strpos(\URL::to('/'), 'www') === false) {
            $sitemapName = 'sitemap-https';
        }

        if (strpos(\URL::to('/'), 'https') !== false && strpos(\URL::to('/'), 'www') !== false) {
            $sitemapName = 'sitemap-https-www';
        }

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

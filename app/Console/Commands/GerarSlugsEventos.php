<?php

namespace App\Console\Commands;

use App\Evento;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class GerarSlugsEventos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'eventos:gerar-slugs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gera slugs para eventos que ainda não possuem';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Iniciando geração de slugs para eventos...');
        
        // Busca todos os eventos sem slug
        $eventos = Evento::with('guia')->whereNull('slug_eve')->orWhere('slug_eve', '')->get();
        
        if ($eventos->isEmpty()) {
            $this->info('Nenhum evento sem slug encontrado.');
            return;
        }
        
        $this->info("Encontrados {$eventos->count()} eventos sem slug.");
        $bar = $this->output->createProgressBar($eventos->count());
        $bar->start();
        
        $contador = 0;
        
        foreach ($eventos as $evento) {
            $slug = Str::slug($evento->nm_evento_eve);
            
            // Adiciona nome do guia ao slug para torná-lo único e descritivo
            if ($evento->id_guia_gui && $evento->guia && $evento->guia->nm_guia_gui) {
                $guiaSlug = Str::slug($evento->guia->nm_guia_gui);
                // Limita o nome do guia para não deixar o slug muito longo
                $guiaSlugParts = explode('-', $guiaSlug);
                $guiaSlugShort = implode('-', array_slice($guiaSlugParts, 0, 3));
                $slug = $slug . '-' . $guiaSlugShort;
            }
            
            // Adiciona a data ao slug para garantir unicidade
            if ($evento->dt_realizacao_eve) {
                $data = date('d-M', strtotime($evento->dt_realizacao_eve));
                $slug = $slug . '-' . strtolower($data);
            }
            
            $originalSlug = $slug;
            $counter = 1;

            // Verifica se o slug já existe e adiciona um número se necessário
            while (Evento::where('slug_eve', $slug)
                        ->where('id_evento_eve', '!=', $evento->id_evento_eve)
                        ->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }

            $evento->slug_eve = $slug;
            $evento->save();
            
            $contador++;
            $bar->advance();
        }
        
        $bar->finish();
        $this->line('');
        $this->line('');
        $this->info("✓ Slugs gerados com sucesso para {$contador} eventos!");
        
        // Mostra alguns exemplos
        $this->line('');
        $this->info('Exemplos de URLs geradas:');
        $exemplos = Evento::with('guia')->whereNotNull('slug_eve')->limit(5)->get();
        
        foreach ($exemplos as $exemplo) {
            $this->line("  • {$exemplo->nm_evento_eve}");
            if ($exemplo->guia) {
                $this->line("    Guia: {$exemplo->guia->nm_guia_gui}");
            }
            if ($exemplo->dt_realizacao_eve) {
                $this->line("    Data: " . date('d/m/Y', strtotime($exemplo->dt_realizacao_eve)));
            }
            $this->line("    Antiga: " . url('eventos/detalhes/' . $exemplo->id_evento_eve));
            $this->line("    Nova:   " . url('eventos/' . $exemplo->slug_eve));
            $this->line('');
        }
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class EnsureColorOnNivelNiv extends Migration
{
    /**
     * Cores por nível (progressão de dificuldade: verde → amarelo → laranja → vermelho).
     */
    private $cores = [
        1 => '#479049', // Passeio
        2 => '#8BC34A', // Leve
        3 => '#B9BB15', // Moderada
        4 => '#F9A825', // Semi-Pesada
        5 => '#DC8E00', // Pesada
        6 => '#B72F2F', // Expedição
    ];

    public function up()
    {
        if (!Schema::hasColumn('nivel_niv', 'dc_color_nivel_niv')) {
            Schema::table('nivel_niv', function (Blueprint $table) {
                $table->string('dc_color_nivel_niv', 20)->nullable()->after('dc_icone_niv');
            });
        }

        foreach ($this->cores as $id => $cor) {
            DB::table('nivel_niv')
                ->where('id_nivel_niv', $id)
                ->update(['dc_color_nivel_niv' => $cor]);
        }
    }

    public function down()
    {
        // Mantém a coluna; apenas não reverte as cores.
    }
}

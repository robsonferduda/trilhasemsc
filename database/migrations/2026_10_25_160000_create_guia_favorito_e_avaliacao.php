<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuiaFavoritoEAvaliacao extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('guia_favorito_gfv')) {
            Schema::create('guia_favorito_gfv', function (Blueprint $table) {
                $table->increments('cd_guia_favorito_gfv');
                $table->unsignedInteger('id_guia_gui');
                $table->unsignedInteger('id_trilheiro_tri');
                $table->timestamps();
                $table->unique(['id_guia_gui', 'id_trilheiro_tri'], 'gfv_guia_trilheiro_unq');
                $table->index('id_trilheiro_tri', 'gfv_trilheiro_idx');
            });
        }

        if (!Schema::hasTable('guia_avaliacao_gav')) {
            Schema::create('guia_avaliacao_gav', function (Blueprint $table) {
                $table->increments('cd_guia_avaliacao_gav');
                $table->unsignedInteger('id_guia_gui');
                $table->unsignedInteger('id_trilheiro_tri');
                $table->unsignedTinyInteger('nr_nota_gav');
                $table->string('ds_comentario_gav', 400)->nullable();
                $table->timestamps();
                $table->unique(['id_guia_gui', 'id_trilheiro_tri'], 'gav_guia_trilheiro_unq');
            });
        }

        if (Schema::hasTable('evento_eve') && !Schema::hasColumn('evento_eve', 'dt_aviso_favoritos_eve')) {
            Schema::table('evento_eve', function (Blueprint $table) {
                $table->timestamp('dt_aviso_favoritos_eve')->nullable();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('guia_avaliacao_gav');
        Schema::dropIfExists('guia_favorito_gfv');
        if (Schema::hasColumn('evento_eve', 'dt_aviso_favoritos_eve')) {
            Schema::table('evento_eve', function (Blueprint $table) {
                $table->dropColumn('dt_aviso_favoritos_eve');
            });
        }
    }
}

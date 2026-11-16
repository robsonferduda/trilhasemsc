<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocalizacaoClimaLocTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('localizacao_clima_loc')) {
            return;
        }

        Schema::create('localizacao_clima_loc', function (Blueprint $table) {
            $table->bigIncrements('id_localizacao_clima_loc');
            $table->decimal('nu_latitude_loc', 10, 7);
            $table->decimal('nu_longitude_loc', 10, 7);
            $table->decimal('nu_latitude_origem_loc', 10, 7);
            $table->decimal('nu_longitude_origem_loc', 10, 7);
            $table->decimal('nu_altitude_api_loc', 8, 2)->nullable();
            $table->timestamp('dt_previsao_atualizada_loc')->nullable();
            $table->timestamp('dt_historico_atualizado_loc')->nullable();
            $table->timestamps();

            $table->unique(['nu_latitude_loc', 'nu_longitude_loc'], 'localizacao_clima_grid_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('localizacao_clima_loc');
    }
}

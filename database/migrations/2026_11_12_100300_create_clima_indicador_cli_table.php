<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClimaIndicadorCliTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('clima_indicador_cli')) {
            return;
        }

        Schema::create('clima_indicador_cli', function (Blueprint $table) {
            $table->bigIncrements('id_clima_indicador_cli');
            $table->unsignedBigInteger('id_localizacao_clima_loc');
            $table->unsignedTinyInteger('nu_mes_cli');
            $table->decimal('nu_indice_cli', 5, 2);
            $table->string('ds_classificacao_cli', 20);
            $table->string('ds_justificativa_cli', 500)->nullable();
            $table->string('ds_metodologia_cli', 20)->default('v1');
            $table->timestamp('dt_atualizado_cli')->nullable();
            $table->timestamps();

            $table->unique(
                ['id_localizacao_clima_loc', 'nu_mes_cli', 'ds_metodologia_cli'],
                'clima_indicador_loc_mes_met_unique'
            );

            $table->foreign('id_localizacao_clima_loc', 'clima_indicador_loc_fk')
                ->references('id_localizacao_clima_loc')
                ->on('localizacao_clima_loc')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clima_indicador_cli');
    }
}

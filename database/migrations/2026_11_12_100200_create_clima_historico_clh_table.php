<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClimaHistoricoClhTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('clima_historico_clh')) {
            return;
        }

        Schema::create('clima_historico_clh', function (Blueprint $table) {
            $table->bigIncrements('id_clima_historico_clh');
            $table->unsignedBigInteger('id_localizacao_clima_loc');
            $table->unsignedTinyInteger('nu_mes_clh');
            $table->unsignedSmallInteger('nu_ano_inicio_clh');
            $table->unsignedSmallInteger('nu_ano_fim_clh');
            $table->decimal('nu_temp_media_clh', 5, 2)->nullable();
            $table->decimal('nu_temp_min_media_clh', 5, 2)->nullable();
            $table->decimal('nu_temp_max_media_clh', 5, 2)->nullable();
            $table->decimal('nu_precip_media_clh', 7, 2)->nullable();
            $table->decimal('nu_dias_chuva_clh', 5, 2)->nullable();
            $table->decimal('nu_umidade_media_clh', 5, 2)->nullable();
            $table->decimal('nu_vento_medio_clh', 6, 2)->nullable();
            $table->string('ds_fonte_clh', 40)->default('open-meteo');
            $table->timestamp('dt_atualizado_clh')->nullable();
            $table->timestamps();

            $table->unique(
                ['id_localizacao_clima_loc', 'nu_mes_clh', 'nu_ano_inicio_clh', 'nu_ano_fim_clh'],
                'clima_historico_loc_mes_anos_unique'
            );

            $table->foreign('id_localizacao_clima_loc', 'clima_historico_loc_fk')
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
        Schema::dropIfExists('clima_historico_clh');
    }
}

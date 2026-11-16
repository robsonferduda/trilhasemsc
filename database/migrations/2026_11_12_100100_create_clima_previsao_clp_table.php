<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClimaPrevisaoClpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('clima_previsao_clp')) {
            return;
        }

        Schema::create('clima_previsao_clp', function (Blueprint $table) {
            $table->bigIncrements('id_clima_previsao_clp');
            $table->unsignedBigInteger('id_localizacao_clima_loc');
            $table->date('dt_previsao_clp');
            $table->decimal('nu_temp_min_clp', 5, 2)->nullable();
            $table->decimal('nu_temp_max_clp', 5, 2)->nullable();
            $table->decimal('nu_temp_atual_clp', 5, 2)->nullable();
            $table->decimal('nu_precip_prob_clp', 5, 2)->nullable();
            $table->decimal('nu_precip_mm_clp', 6, 2)->nullable();
            $table->decimal('nu_umidade_clp', 5, 2)->nullable();
            $table->decimal('nu_vento_kmh_clp', 6, 2)->nullable();
            $table->decimal('nu_rajada_kmh_clp', 6, 2)->nullable();
            $table->decimal('nu_nebulosidade_clp', 5, 2)->nullable();
            $table->decimal('nu_indice_uv_clp', 5, 2)->nullable();
            $table->string('hr_nascer_sol_clp', 5)->nullable();
            $table->string('hr_por_sol_clp', 5)->nullable();
            $table->unsignedSmallInteger('cd_condicao_clp')->nullable();
            $table->string('ds_fonte_clp', 40)->default('open-meteo');
            $table->timestamp('dt_atualizado_clp')->nullable();
            $table->timestamps();

            $table->unique(
                ['id_localizacao_clima_loc', 'dt_previsao_clp'],
                'clima_previsao_loc_data_unique'
            );
            $table->index('dt_previsao_clp', 'clima_previsao_data_idx');

            $table->foreign('id_localizacao_clima_loc', 'clima_previsao_loc_fk')
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
        Schema::dropIfExists('clima_previsao_clp');
    }
}

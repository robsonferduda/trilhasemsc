<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventoGastoTable extends Migration
{
    public function up()
    {
        if (Schema::hasTable('evento_gasto_evg')) {
            return;
        }

        Schema::create('evento_gasto_evg', function (Blueprint $table) {
            $table->increments('cd_evento_gasto_evg');
            $table->unsignedInteger('id_evento_eve');
            $table->string('ds_categoria_evg', 30);
            $table->decimal('vl_gasto_evg', 10, 2);
            $table->string('nm_pagador_evg', 120);
            $table->string('ds_descricao_evg', 200)->nullable();
            $table->string('ds_comprovante_evg')->nullable();
            $table->boolean('fl_rateio_evg')->default(false);
            $table->boolean('fl_estimado_evg')->default(false);
            $table->timestamps();
            $table->index('id_evento_eve', 'evg_evento_idx');
        });
    }

    public function down()
    {
        Schema::dropIfExists('evento_gasto_evg');
    }
}

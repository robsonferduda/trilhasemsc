<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHospedagemHosTable extends Migration
{
    public function up()
    {
        Schema::create('hospedagem_hos', function (Blueprint $table) {
            $table->bigIncrements('cd_hospedagem_hos');
            $table->bigInteger('cd_expedicao_exp')->nullable();
            $table->string('nm_hospedagem_hos')->nullable();
            $table->integer('nu_dias_hos')->nullable();
            $table->timestamp('dt_chegada_hos')->nullable();
            $table->timestamp('dt_saida_hos')->nullable();
            $table->float('valor_total_hos')->nullable();
            $table->integer('total_hospedes_hos')->nullable();
            $table->float('valor_individual_hos')->nullable();
            $table->string('ds_url_hos')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hospedagem_hos');
    }
}

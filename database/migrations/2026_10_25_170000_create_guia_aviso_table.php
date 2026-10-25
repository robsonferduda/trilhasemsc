<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuiaAvisoTable extends Migration
{
    public function up()
    {
        if (Schema::hasTable('guia_aviso_gva')) {
            return;
        }

        Schema::create('guia_aviso_gva', function (Blueprint $table) {
            $table->increments('cd_guia_aviso_gva');
            $table->unsignedInteger('id_guia_gui');
            $table->string('sg_acao_gva', 20);
            $table->unsignedInteger('id_user')->nullable();
            $table->timestamps();
            $table->index(['id_guia_gui', 'sg_acao_gva'], 'gva_guia_acao_idx');
        });
    }

    public function down()
    {
        Schema::dropIfExists('guia_aviso_gva');
    }
}

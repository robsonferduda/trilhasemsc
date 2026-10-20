<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstagramPublicacaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instagram_publicacao_ipu', function (Blueprint $table) {
            $table->bigIncrements('id_publicacao_ipu');
            $table->unsignedBigInteger('id_trilha_tri');
            $table->string('ds_status_ipu', 20);
            $table->text('ds_legenda_ipu')->nullable();
            $table->string('ds_imagem_ipu', 500)->nullable();
            $table->string('ds_url_trilha_ipu', 500)->nullable();
            $table->string('cd_container_ipu', 100)->nullable();
            $table->string('cd_media_ipu', 100)->nullable();
            $table->string('ds_permalink_ipu', 500)->nullable();
            $table->text('ds_erro_ipu')->nullable();
            $table->timestamp('dt_publicacao_ipu')->nullable();
            $table->timestamps();

            $table->index(['ds_status_ipu', 'dt_publicacao_ipu'], 'ipu_status_data_idx');
            $table->index('id_trilha_tri', 'ipu_trilha_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instagram_publicacao_ipu');
    }
}

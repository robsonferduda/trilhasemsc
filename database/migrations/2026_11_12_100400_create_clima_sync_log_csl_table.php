<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClimaSyncLogCslTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('clima_sync_log_csl')) {
            return;
        }

        Schema::create('clima_sync_log_csl', function (Blueprint $table) {
            $table->bigIncrements('id_clima_sync_log_csl');
            $table->string('ds_tipo_csl', 20);
            $table->string('ds_status_csl', 20);
            $table->text('ds_mensagem_csl')->nullable();
            $table->unsignedInteger('nu_sucesso_csl')->default(0);
            $table->unsignedInteger('nu_erro_csl')->default(0);
            $table->unsignedInteger('nu_total_csl')->default(0);
            $table->timestamp('dt_inicio_csl')->nullable();
            $table->timestamp('dt_fim_csl')->nullable();
            $table->timestamps();

            $table->index(['ds_tipo_csl', 'created_at'], 'clima_sync_log_tipo_created_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clima_sync_log_csl');
    }
}

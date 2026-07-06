<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstagramMediaMetricsTable extends Migration
{
    /**
     * Conexao dedicada para o banco de metricas do Instagram.
     *
     * @var string
     */
    protected $connection = 'instagram_pgsql';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection($this->connection)->create('instagram_media_metrics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('instagram_account_id', 100);
            $table->string('media_id', 100);
            $table->string('media_type', 50)->nullable();
            $table->text('caption')->nullable();
            $table->text('permalink')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->unsignedSmallInteger('published_hour')->nullable();
            $table->unsignedSmallInteger('published_weekday')->nullable();
            $table->unsignedInteger('reach')->nullable();
            $table->unsignedInteger('views')->nullable();
            $table->unsignedInteger('likes')->nullable();
            $table->unsignedInteger('comments')->nullable();
            $table->unsignedInteger('shares')->nullable();
            $table->unsignedInteger('saves')->nullable();
            $table->unsignedInteger('total_interactions')->nullable();
            $table->text('raw_payload')->nullable();
            $table->timestamps();

            $table->unique(['instagram_account_id', 'media_id'], 'instagram_media_unique');
            $table->index('published_at', 'instagram_media_published_at_idx');
            $table->index('published_hour', 'instagram_media_published_hour_idx');
            $table->index('published_weekday', 'instagram_media_weekday_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection($this->connection)->dropIfExists('instagram_media_metrics');
    }
}

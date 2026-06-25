<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstagramMetricSnapshotsTable extends Migration
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
        Schema::connection($this->connection)->create('instagram_metric_snapshots', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('instagram_account_id', 100);
            $table->date('metric_date');
            $table->unsignedInteger('followers_count')->nullable();
            $table->unsignedInteger('reach')->nullable();
            $table->unsignedInteger('impressions')->nullable();
            $table->unsignedInteger('profile_views')->nullable();
            $table->unsignedInteger('website_clicks')->nullable();
            $table->text('raw_payload')->nullable();
            $table->timestamps();

            $table->unique(['instagram_account_id', 'metric_date'], 'instagram_metric_unique');
            $table->index('metric_date', 'instagram_metric_date_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection($this->connection)->dropIfExists('instagram_metric_snapshots');
    }
}

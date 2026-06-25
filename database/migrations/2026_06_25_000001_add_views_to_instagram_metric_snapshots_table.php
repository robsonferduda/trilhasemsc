<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddViewsToInstagramMetricSnapshotsTable extends Migration
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
        Schema::connection($this->connection)->table('instagram_metric_snapshots', function (Blueprint $table) {
            $table->unsignedInteger('views')->nullable()->after('reach');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection($this->connection)->table('instagram_metric_snapshots', function (Blueprint $table) {
            $table->dropColumn('views');
        });
    }
}

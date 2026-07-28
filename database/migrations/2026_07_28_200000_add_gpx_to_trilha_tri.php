<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGpxToTrilhaTri extends Migration
{
    public function up()
    {
        Schema::table('trilha_tri', function (Blueprint $table) {
            if (!Schema::hasColumn('trilha_tri', 'nm_arquivo_gpx_tri')) {
                $table->string('nm_arquivo_gpx_tri', 255)->nullable()->after('nu_longitude_tri');
            }
        });
    }

    public function down()
    {
        Schema::table('trilha_tri', function (Blueprint $table) {
            if (Schema::hasColumn('trilha_tri', 'nm_arquivo_gpx_tri')) {
                $table->dropColumn('nm_arquivo_gpx_tri');
            }
        });
    }
}

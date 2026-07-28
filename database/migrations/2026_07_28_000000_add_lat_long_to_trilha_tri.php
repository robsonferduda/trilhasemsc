<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLatLongToTrilhaTri extends Migration
{
    public function up()
    {
        Schema::table('trilha_tri', function (Blueprint $table) {
            if (!Schema::hasColumn('trilha_tri', 'nu_latitude_tri')) {
                $table->decimal('nu_latitude_tri', 10, 7)->nullable()->after('url_geolocalizacao_tri');
            }
            if (!Schema::hasColumn('trilha_tri', 'nu_longitude_tri')) {
                $table->decimal('nu_longitude_tri', 10, 7)->nullable()->after('nu_latitude_tri');
            }
        });
    }

    public function down()
    {
        Schema::table('trilha_tri', function (Blueprint $table) {
            if (Schema::hasColumn('trilha_tri', 'nu_longitude_tri')) {
                $table->dropColumn('nu_longitude_tri');
            }
            if (Schema::hasColumn('trilha_tri', 'nu_latitude_tri')) {
                $table->dropColumn('nu_latitude_tri');
            }
        });
    }
}

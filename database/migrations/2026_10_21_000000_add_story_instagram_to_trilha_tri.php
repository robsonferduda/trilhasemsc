<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStoryInstagramToTrilhaTri extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trilha_tri', function (Blueprint $table) {
            if (!Schema::hasColumn('trilha_tri', 'ds_path_story_instagram_tri')) {
                $table->string('ds_path_story_instagram_tri', 255)->nullable()->after('nm_arquivo_gpx_tri');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trilha_tri', function (Blueprint $table) {
            if (Schema::hasColumn('trilha_tri', 'ds_path_story_instagram_tri')) {
                $table->dropColumn('ds_path_story_instagram_tri');
            }
        });
    }
}

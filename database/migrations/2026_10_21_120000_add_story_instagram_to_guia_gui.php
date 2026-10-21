<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddStoryInstagramToGuiaGui extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('guia_gui', function (Blueprint $table) {
            if (!Schema::hasColumn('guia_gui', 'ds_path_story_instagram_gui')) {
                $table->string('ds_path_story_instagram_gui', 255)->nullable()->after('nm_path_logo_gui');
            }
        });

        if (Schema::hasColumn('instagram_publicacao_ipu', 'id_trilha_tri')) {
            DB::statement('ALTER TABLE instagram_publicacao_ipu MODIFY id_trilha_tri BIGINT UNSIGNED NULL');
        }

        Schema::table('instagram_publicacao_ipu', function (Blueprint $table) {
            if (!Schema::hasColumn('instagram_publicacao_ipu', 'id_guia_gui')) {
                $table->unsignedBigInteger('id_guia_gui')->nullable()->after('id_trilha_tri');
                $table->index('id_guia_gui', 'ipu_guia_idx');
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
        Schema::table('instagram_publicacao_ipu', function (Blueprint $table) {
            if (Schema::hasColumn('instagram_publicacao_ipu', 'id_guia_gui')) {
                $table->dropIndex('ipu_guia_idx');
                $table->dropColumn('id_guia_gui');
            }
        });

        Schema::table('guia_gui', function (Blueprint $table) {
            if (Schema::hasColumn('guia_gui', 'ds_path_story_instagram_gui')) {
                $table->dropColumn('ds_path_story_instagram_gui');
            }
        });
    }
}

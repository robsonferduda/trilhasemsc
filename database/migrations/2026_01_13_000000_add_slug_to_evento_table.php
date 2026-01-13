<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSlugToEventoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('evento_eve', function (Blueprint $table) {
            $table->string('slug_eve', 255)->nullable()->after('nm_evento_eve');
            $table->index('slug_eve');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('evento_eve', function (Blueprint $table) {
            $table->dropIndex(['slug_eve']);
            $table->dropColumn('slug_eve');
        });
    }
}

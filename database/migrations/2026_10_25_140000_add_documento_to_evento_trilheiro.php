<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDocumentoToEventoTrilheiro extends Migration
{
    public function up()
    {
        Schema::table('evento_trilheiro_evt', function (Blueprint $table) {
            if (!Schema::hasColumn('evento_trilheiro_evt', 'nr_documento_evt')) {
                $table->string('nr_documento_evt', 11)->nullable()->after('st_inscricao_evt');
            }
        });
    }

    public function down()
    {
        Schema::table('evento_trilheiro_evt', function (Blueprint $table) {
            if (Schema::hasColumn('evento_trilheiro_evt', 'nr_documento_evt')) {
                $table->dropColumn('nr_documento_evt');
            }
        });
    }
}

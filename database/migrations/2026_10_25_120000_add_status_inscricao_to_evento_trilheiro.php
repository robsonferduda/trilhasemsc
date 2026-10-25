<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddStatusInscricaoToEventoTrilheiro extends Migration
{
    public function up()
    {
        Schema::table('evento_trilheiro_evt', function (Blueprint $table) {
            if (!Schema::hasColumn('evento_trilheiro_evt', 'st_inscricao_evt')) {
                $table->string('st_inscricao_evt', 20)->default('interessado')->after('fl_pago_evt');
                $table->index(['id_evento_eve', 'st_inscricao_evt'], 'evt_evento_status_idx');
            }
        });

        DB::table('evento_trilheiro_evt')
            ->where('st_inscricao_evt', 'interessado')
            ->where(function ($query) {
                $query->where('fl_pago_evt', 1)
                    ->orWhereNotNull('fl_aceito_guia_evt');
            })
            ->update([
                'st_inscricao_evt' => DB::raw("CASE
                    WHEN fl_pago_evt = 1 THEN 'pago'
                    WHEN fl_aceito_guia_evt = 0 THEN 'recusado'
                    WHEN fl_aceito_guia_evt = 1 THEN 'aceito'
                    ELSE 'interessado'
                END"),
            ]);
    }

    public function down()
    {
        Schema::table('evento_trilheiro_evt', function (Blueprint $table) {
            if (Schema::hasColumn('evento_trilheiro_evt', 'st_inscricao_evt')) {
                $table->dropIndex('evt_evento_status_idx');
                $table->dropColumn('st_inscricao_evt');
            }
        });
    }
}

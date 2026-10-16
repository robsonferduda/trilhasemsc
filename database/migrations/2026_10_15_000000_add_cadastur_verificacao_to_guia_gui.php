<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCadasturVerificacaoToGuiaGui extends Migration
{
    private $colunas = [
        'sg_cadastur_situacao_gui',
        'ds_cadastur_situacao_oficial_gui',
        'nm_cadastur_titular_gui',
        'nm_cadastur_categoria_gui',
        'dt_cadastur_emissao_gui',
        'dt_cadastur_validade_gui',
        'dt_cadastur_consulta_gui',
        'fl_cadastur_nome_confere_gui',
        'dt_cadastur_aviso_validade_gui',
    ];

    public function up()
    {
        Schema::table('guia_gui', function (Blueprint $table) {
            if (!Schema::hasColumn('guia_gui', 'sg_cadastur_situacao_gui')) {
                $table->string('sg_cadastur_situacao_gui', 20)->nullable()->after('nu_cadastur_gui');
            }
            if (!Schema::hasColumn('guia_gui', 'ds_cadastur_situacao_oficial_gui')) {
                $table->string('ds_cadastur_situacao_oficial_gui', 40)->nullable()->after('sg_cadastur_situacao_gui');
            }
            if (!Schema::hasColumn('guia_gui', 'nm_cadastur_titular_gui')) {
                $table->string('nm_cadastur_titular_gui', 150)->nullable()->after('ds_cadastur_situacao_oficial_gui');
            }
            if (!Schema::hasColumn('guia_gui', 'nm_cadastur_categoria_gui')) {
                $table->string('nm_cadastur_categoria_gui', 150)->nullable()->after('nm_cadastur_titular_gui');
            }
            if (!Schema::hasColumn('guia_gui', 'dt_cadastur_emissao_gui')) {
                $table->date('dt_cadastur_emissao_gui')->nullable()->after('nm_cadastur_categoria_gui');
            }
            if (!Schema::hasColumn('guia_gui', 'dt_cadastur_validade_gui')) {
                $table->date('dt_cadastur_validade_gui')->nullable()->after('dt_cadastur_emissao_gui');
            }
            if (!Schema::hasColumn('guia_gui', 'dt_cadastur_consulta_gui')) {
                $table->timestamp('dt_cadastur_consulta_gui')->nullable()->after('dt_cadastur_validade_gui');
            }
            if (!Schema::hasColumn('guia_gui', 'fl_cadastur_nome_confere_gui')) {
                $table->boolean('fl_cadastur_nome_confere_gui')->nullable()->after('dt_cadastur_consulta_gui');
            }
            if (!Schema::hasColumn('guia_gui', 'dt_cadastur_aviso_validade_gui')) {
                $table->date('dt_cadastur_aviso_validade_gui')->nullable()->after('fl_cadastur_nome_confere_gui');
            }
        });
    }

    public function down()
    {
        Schema::table('guia_gui', function (Blueprint $table) {
            foreach ($this->colunas as $coluna) {
                if (Schema::hasColumn('guia_gui', $coluna)) {
                    $table->dropColumn($coluna);
                }
            }
        });
    }
}

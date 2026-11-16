<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClimaIndicador extends Model
{
    protected $table = 'clima_indicador_cli';
    protected $primaryKey = 'id_clima_indicador_cli';

    protected $fillable = [
        'id_localizacao_clima_loc',
        'nu_mes_cli',
        'nu_indice_cli',
        'ds_classificacao_cli',
        'ds_justificativa_cli',
        'ds_metodologia_cli',
        'dt_atualizado_cli',
    ];

    protected $dates = [
        'dt_atualizado_cli',
        'created_at',
        'updated_at',
    ];

    public $timestamps = true;

    public function localizacao()
    {
        return $this->belongsTo(LocalizacaoClima::class, 'id_localizacao_clima_loc', 'id_localizacao_clima_loc');
    }
}

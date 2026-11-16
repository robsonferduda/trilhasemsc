<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LocalizacaoClima extends Model
{
    protected $table = 'localizacao_clima_loc';
    protected $primaryKey = 'id_localizacao_clima_loc';

    protected $fillable = [
        'nu_latitude_loc',
        'nu_longitude_loc',
        'nu_latitude_origem_loc',
        'nu_longitude_origem_loc',
        'nu_altitude_api_loc',
        'dt_previsao_atualizada_loc',
        'dt_historico_atualizado_loc',
    ];

    protected $dates = [
        'dt_previsao_atualizada_loc',
        'dt_historico_atualizado_loc',
        'created_at',
        'updated_at',
    ];

    public $timestamps = true;

    public function previsoes()
    {
        return $this->hasMany(ClimaPrevisao::class, 'id_localizacao_clima_loc', 'id_localizacao_clima_loc')
            ->orderBy('dt_previsao_clp');
    }

    public function historicos()
    {
        return $this->hasMany(ClimaHistorico::class, 'id_localizacao_clima_loc', 'id_localizacao_clima_loc')
            ->orderBy('nu_mes_clh');
    }

    public function indicadores()
    {
        return $this->hasMany(ClimaIndicador::class, 'id_localizacao_clima_loc', 'id_localizacao_clima_loc')
            ->orderBy('nu_mes_cli');
    }
}

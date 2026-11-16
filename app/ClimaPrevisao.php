<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClimaPrevisao extends Model
{
    protected $table = 'clima_previsao_clp';
    protected $primaryKey = 'id_clima_previsao_clp';

    protected $fillable = [
        'id_localizacao_clima_loc',
        'dt_previsao_clp',
        'nu_temp_min_clp',
        'nu_temp_max_clp',
        'nu_temp_atual_clp',
        'nu_precip_prob_clp',
        'nu_precip_mm_clp',
        'nu_umidade_clp',
        'nu_vento_kmh_clp',
        'nu_rajada_kmh_clp',
        'nu_nebulosidade_clp',
        'nu_indice_uv_clp',
        'hr_nascer_sol_clp',
        'hr_por_sol_clp',
        'cd_condicao_clp',
        'ds_fonte_clp',
        'dt_atualizado_clp',
    ];

    protected $dates = [
        'dt_previsao_clp',
        'dt_atualizado_clp',
        'created_at',
        'updated_at',
    ];

    public $timestamps = true;

    public function localizacao()
    {
        return $this->belongsTo(LocalizacaoClima::class, 'id_localizacao_clima_loc', 'id_localizacao_clima_loc');
    }

    public function getCondicaoAttribute()
    {
        return \App\Services\Clima\WeatherNormalizer::interpretWeatherCode($this->cd_condicao_clp);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClimaHistorico extends Model
{
    protected $table = 'clima_historico_clh';
    protected $primaryKey = 'id_clima_historico_clh';

    protected $fillable = [
        'id_localizacao_clima_loc',
        'nu_mes_clh',
        'nu_ano_inicio_clh',
        'nu_ano_fim_clh',
        'nu_temp_media_clh',
        'nu_temp_min_media_clh',
        'nu_temp_max_media_clh',
        'nu_precip_media_clh',
        'nu_dias_chuva_clh',
        'nu_umidade_media_clh',
        'nu_vento_medio_clh',
        'ds_fonte_clh',
        'dt_atualizado_clh',
    ];

    protected $dates = [
        'dt_atualizado_clh',
        'created_at',
        'updated_at',
    ];

    public $timestamps = true;

    public function localizacao()
    {
        return $this->belongsTo(LocalizacaoClima::class, 'id_localizacao_clima_loc', 'id_localizacao_clima_loc');
    }
}

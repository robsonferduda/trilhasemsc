<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClimaSyncLog extends Model
{
    protected $table = 'clima_sync_log_csl';
    protected $primaryKey = 'id_clima_sync_log_csl';

    protected $fillable = [
        'ds_tipo_csl',
        'ds_status_csl',
        'ds_mensagem_csl',
        'nu_sucesso_csl',
        'nu_erro_csl',
        'nu_total_csl',
        'dt_inicio_csl',
        'dt_fim_csl',
    ];

    protected $dates = [
        'dt_inicio_csl',
        'dt_fim_csl',
        'created_at',
        'updated_at',
    ];

    public $timestamps = true;
}

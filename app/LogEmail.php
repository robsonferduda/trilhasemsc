<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LogEmail extends Model
{
    use SoftDeletes;

    protected $table = 'log_email_loe';
    protected $primaryKey = 'cd_log_email_loe';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id_trilha_tri',
        'cd_tipo_envio_tie',
        'nu_total_envios_loe',
        'dt_envio_loe',
    ];

    public $timestamps = true;

    public function trilha()
    {
        return $this->belongsTo(Trilha::class, 'id_trilha_tri', 'id_trilha_tri');
    }
}

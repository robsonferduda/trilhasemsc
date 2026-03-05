<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TotalAcessosTrilhas extends Model
{
    use SoftDeletes;

    protected $table = 'total_acessos_trilhas_tat';
    protected $primaryKey = 'cd_total_acessos_trilhas_tat';

    protected $fillable = [
        'id_trilha_tri',
        'nm_trilha_tri',
        'total_acessos_tat',
    ];

    public $timestamps = true;

    public function trilha()
    {
        return $this->belongsTo(Trilha::class, 'id_trilha_tri', 'id_trilha_tri');
    }
}

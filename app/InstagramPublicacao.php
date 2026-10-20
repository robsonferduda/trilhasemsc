<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstagramPublicacao extends Model
{
    protected $table = 'instagram_publicacao_ipu';
    protected $primaryKey = 'id_publicacao_ipu';

    protected $fillable = [
        'id_trilha_tri',
        'ds_status_ipu',
        'ds_legenda_ipu',
        'ds_imagem_ipu',
        'ds_url_trilha_ipu',
        'cd_container_ipu',
        'cd_media_ipu',
        'ds_permalink_ipu',
        'ds_erro_ipu',
        'dt_publicacao_ipu',
    ];

    protected $casts = [
        'dt_publicacao_ipu' => 'datetime',
    ];

    public function trilha()
    {
        return $this->belongsTo('App\Trilha', 'id_trilha_tri', 'id_trilha_tri');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuiaAviso extends Model
{
    protected $table = 'guia_aviso_gva';
    protected $primaryKey = 'cd_guia_aviso_gva';
    protected $fillable = ['id_guia_gui', 'sg_acao_gva', 'id_user'];
    public $timestamps = true;

    public function guia()
    {
        return $this->belongsTo('App\Guia', 'id_guia_gui', 'id_guia_gui');
    }
}

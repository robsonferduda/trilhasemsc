<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuiaFavorito extends Model
{
    protected $table = 'guia_favorito_gfv';
    protected $primaryKey = 'cd_guia_favorito_gfv';
    protected $fillable = ['id_guia_gui', 'id_trilheiro_tri'];
    public $timestamps = true;

    public function guia()
    {
        return $this->belongsTo('App\Guia', 'id_guia_gui', 'id_guia_gui');
    }

    public function trilheiro()
    {
        return $this->belongsTo('App\Trilheiro', 'id_trilheiro_tri', 'id_trilheiro_tri');
    }
}

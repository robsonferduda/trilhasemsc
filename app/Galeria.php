<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Galeria extends Model
{
    use SoftDeletes;
    
    protected $table = 'galeria_gal';
    protected $primaryKey = 'id_galeria_gal';
    protected $dates = ['deleted_at'];
    protected $fillable = [
                            'nm_galeria_gal', 'fl_ativa_gal'
                          ];

    public $timestamps = true;

    public function fotos()
    {
        return $this->hasMany('App\Foto', 'id_galeria_gal', 'id_galeria_gal');
    }

    public function itens()
    {
        return $this->hasMany('App\Foto', 'id_galeria_gal', 'id_galeria_gal')->where('id_tipo_foto_tfo',9);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoFoto extends Model
{
    use SoftDeletes;
    
    protected $table = 'tipo_foto_tfo';
    protected $primaryKey = 'id_tipo_foto_tfo';
    protected $dates = ['deleted_at'];
    protected $fillable = [
                            'nm_tipo_foto_tfo'
                          ];

    public $timestamps = true;
}

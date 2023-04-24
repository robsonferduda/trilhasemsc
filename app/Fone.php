<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fone extends Model
{
    use SoftDeletes;
    
    protected $table = 'fone_fon';
    protected $primaryKey = 'id_fone_fon';
    protected $dates = ['deleted_at'];
    protected $fillable = ['id_guia_gui', 'nu_fone_fon', 'id_tipo_fone_tif'];
    public $timestamps = true;
}

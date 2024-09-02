<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Indice extends Model
{
    use SoftDeletes;
    
    protected $table = 'indice_ind';
    protected $primaryKey = 'id_indice_indi';
    protected $dates = ['deleted_at'];

    public $timestamps = true;
}
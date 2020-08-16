<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Complemento extends Model
{
    use SoftDeletes;
    
    protected $table = 'complemento_nivel_con';
    protected $primaryKey = 'id_complemento_nivel_con';
    protected $dates = ['deleted_at'];
    protected $fillable = [
                            'nm_complemento_nivel_con'
                          ];

    public $timestamps = true;
}

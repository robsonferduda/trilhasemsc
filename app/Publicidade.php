<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Publicidade extends Model
{
    use SoftDeletes;
    
    protected $table = 'publicidade_pub';
    protected $primaryKey = 'id_publicidade_pub';
    protected $dates = ['deleted_at'];
    protected $fillable = ['nu_acessos_pub'];

    public $timestamps = true;

}
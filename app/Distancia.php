<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Distancia extends Model
{
    use SoftDeletes;
    
    protected $table = 'distancia_dis';
    protected $primaryKey = 'cd_distancia_dis';
    protected $dates = ['deleted_at'];
    protected $fillable = [''];
}
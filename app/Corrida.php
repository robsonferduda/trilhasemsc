<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Corrida extends Model
{
    use SoftDeletes;
    
    protected $table = 'corrida_cor';
    protected $primaryKey = 'cd_corrida_cor';
    protected $dates = ['deleted_at'];
    protected $fillable = [''];
}
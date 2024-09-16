<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Elevacao extends Model
{
    use SoftDeletes;
    
    protected $table = 'elevacao_ele';
    protected $primaryKey = 'cd_elevacao_ele';
    protected $dates = ['deleted_at'];
    protected $fillable = [''];
}
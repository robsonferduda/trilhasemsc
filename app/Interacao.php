<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Interacao extends Model
{
    use SoftDeletes;
    
    protected $table = 'guia_interacao_gin';
    protected $primaryKey = 'id_guia_interacao_gin';
    protected $dates = ['deleted_at'];
    protected $fillable = [];
    public $timestamps = true;

}
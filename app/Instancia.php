<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Instancia extends Model
{
    use SoftDeletes;
    
    protected $table = 'unidade_conservacao_instancia_uci';
    protected $primaryKey = 'id_unidade_conservacao_instancia_uci';
    protected $dates = ['deleted_at'];
    public $timestamps = true;
}
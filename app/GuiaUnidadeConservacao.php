<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GuiaUnidadeConservacao extends Model
{
    use SoftDeletes;
    
    protected $table = 'guia_unidade_conservacao_guc';
    protected $primaryKey = 'id_guia_unidade_conservacao_guc';
    protected $dates = ['deleted_at'];
   
    public $timestamps = true;
}
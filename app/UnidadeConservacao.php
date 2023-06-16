<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UnidadeConservacao extends Model
{
    use SoftDeletes;
    
    protected $table = 'unidade_conservacao_unc';
    protected $primaryKey = 'id_unidade_conservacao_unc';
    protected $dates = ['deleted_at'];
   
    public $timestamps = true;

    public function instancia()
    {
        return $this->hasOne('App\Instancia', 'id_unidade_conservacao_instancia_uci', 'id_unidade_conservacao_instancia_uci');
    }

}
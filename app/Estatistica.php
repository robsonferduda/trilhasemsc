<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estatistica extends Model
{
    use SoftDeletes;
    
    protected $table = 'estatistica_acesso_esa';
    protected $primaryKey = 'cd_estatistica_acesso_esa';
    protected $dates = ['deleted_at'];
    protected $fillable = ['cd_usuario_usu',
                            'cd_tipo_monitoramento_tim',
                            'cd_monitoramento_esa'];
                            
    public $timestamps = true;

}
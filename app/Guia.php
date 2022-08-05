<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guia extends Model
{
    use SoftDeletes;
    
    protected $table = 'guia_gui';
    protected $primaryKey = 'id_guia_gui';
    protected $dates = ['deleted_at'];
    protected $fillable = [];
    public $timestamps = true;

    public function origem()
    {
        return $this->hasOne('App\Cidade', 'cd_cidade_cde', 'cd_cidade_origem_gui');
    }

    public function fone()
    {
        return $this->hasOne('App\Fone', 'id_guia_gui', 'id_guia_gui');
    }
}

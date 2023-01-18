<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Evento extends Model
{
    use SoftDeletes;
    
    protected $table = 'evento_eve';
    protected $primaryKey = 'id_evento_eve';
    protected $dates = ['deleted_at'];
    protected $fillable = [];
    public $timestamps = true;

    public function local()
    {
        return $this->hasOne('App\Cidade', 'cd_cidade_cde', 'cd_cidade_cde');
    }

    public function guia()
    {
        return $this->hasOne('App\Guia', 'id_guia_gui', 'id_guia_gui');
    }
}
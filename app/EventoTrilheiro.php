<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventoTrilheiro extends Model
{
    use SoftDeletes;
    
    protected $table = 'evento_trilheiro_evt';
    protected $primaryKey = 'cd_evento_trilheiro_evt';
    protected $dates = ['deleted_at'];
    protected $fillable = ['id_evento_eve','id_trilheiro_tri','fl_aceito_guia_evt','fl_pago_evt'];
                            
    public $timestamps = true;

    public function evento()
    {
        return $this->belongsTo('App\Evento', 'id_evento_eve', 'id_evento_eve');
    }

    public function trilheiro()
    {
        return $this->belongsTo('App\Trilheiro', 'id_trilheiro_tri', 'id_trilheiro_tri');
    }
}
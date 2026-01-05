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
    protected $fillable = ['id_guia_gui',
                            'cd_cidade_cde',
                            'nm_evento_eve',
                            'ds_fone_contato_eve',
                            'dt_realizacao_eve',
                            'dt_termino_eve',
                            'valor_eve',
                            'total_participantes_eve',
                            'descricao',
                            'ds_imagem_vertical_eve',
                            'ds_imagem_horizontal_eve',
                            'fl_ativo_eve',
                            'hora_inicio_eve',
                            'hora_fim_eve'];
                            
    public $timestamps = true;

    public function local()
    {
        return $this->hasOne('App\Cidade', 'cd_cidade_cde', 'cd_cidade_cde');
    }

    public function guia()
    {
        return $this->hasOne('App\Guia', 'id_guia_gui', 'id_guia_gui');
    }

    public function eventoTrilheiros()
    {
        return $this->hasMany('App\EventoTrilheiro', 'id_evento_eve', 'id_evento_eve');
    }
    
    public function trilheiros()
    {
        return $this->belongsToMany(Trilheiro::class, 'evento_trilheiro_evt', 'id_evento_eve', 'id_trilheiro_tri');
    }
}
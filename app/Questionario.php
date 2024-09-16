<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Questionario extends Model
{
    use SoftDeletes;
    
    protected $table = 'questionario_score_que';
    protected $primaryKey = 'cd_questionario_score_que';
    protected $dates = ['deleted_at'];
    protected $fillable = [
                            'cd_trilheiro_tri',
                            'cd_distancia_dis',
                            'cd_elevacao_ele',
                            'fl_corrida_que',
                            'fl_musculacao_que',
                            'fl_trilhas_que',
                            'fl_travessia_que',
                            'fl_altura_que',
                            'fl_trekking_que',
                            'fl_areia_que',
                            'nu_distancia_que',
                            'nu_altura_que',
                            'nu_peso_que',
                            'cd_corrida_cor'
                          ];

    public $timestamps = true;

    public function distancia()
    {
        return $this->hasOne('App\Distancia', 'cd_distancia_dis', 'cd_distancia_dis');
    }

    public function elevacao()
    {
        return $this->hasOne('App\Elevacao', 'cd_elevacao_ele', 'cd_elevacao_ele');
    }

    public function corrida()
    {
        return $this->hasOne('App\Corrida', 'cd_corrida_cor', 'cd_corrida_cor');
    }
}

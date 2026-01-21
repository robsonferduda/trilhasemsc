<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trilheiro extends Model
{
    use SoftDeletes;
    
    protected $table = 'trilheiro_tri';
    protected $primaryKey = 'id_trilheiro_tri';
    protected $dates = ['deleted_at'];

    protected $fillable = ['id_user',
        'nm_trilheiro_tri',
        'nm_instagram_tri',
        'nm_path_foto_tri',
        'fl_ativo_gui',
        'cd_cidade_tri',
        'cd_estado_est',
        'dt_nascimento',
        'cd_sexo_sex',
        'ds_objetivos_tri',
        'nu_pontos_experiencia_tri',
        'fl_newsletter_tri'
        ];

    public $timestamps = true;

    public function origem()
    {
        return $this->hasOne('App\Cidade', 'cd_cidade_cde', 'cd_cidade_tri');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'id_user');
    }


    public function indice()
    {
        return $this->hasOne('App\Indice', 'id_indice_ind', 'id_indice_ind');
    }

    public function evento()
    {
        return $this->belongsToMany('App\Evento','evento_trilheiro_evt', 'id_trilheiro_tri','id_evento_eve')->withTimestamps();
    }

    public function trilhas()
    {
        return $this->belongsToMany('App\Trilha','trilheiro_trilha_ttr', 'id_trilheiro_tri','id_trilha_tri')->withTimestamps();
    }

    /**
     * Gera um token seguro para descadastro da newsletter
     * 
     * @return string
     */
    public function getUnsubscribeToken()
    {
        return hash_hmac('sha256', $this->id_trilheiro_tri . '|' . $this->user->email, config('app.key'));
    }

    /**
     * Valida um token de descadastro
     * 
     * @param int $trilheiroId
     * @param string $token
     * @return bool
     */
    public static function validateUnsubscribeToken($trilheiroId, $token)
    {
        $trilheiro = self::find($trilheiroId);
        
        if (!$trilheiro) {
            return false;
        }
        
        return hash_equals($trilheiro->getUnsubscribeToken(), $token);
    }

    /**
     * Gera a URL completa de descadastro da newsletter
     * 
     * @return string
     */
    public function getUnsubscribeUrl()
    {
        return url('newsletter/descadastrar/' . $this->id_trilheiro_tri . '/' . $this->getUnsubscribeToken());
    }
}
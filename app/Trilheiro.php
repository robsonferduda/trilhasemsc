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
        'fl_newsletter_tri',
        'nr_score_tri',
        'id_indice_ind'
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

    public function questionario()
    {
        return $this->hasOne('App\Questionario', 'cd_trilheiro_tri', 'id_trilheiro_tri');
    }

    /**
     * Cadastro básico mínimo para usar a área privada (cidade, estado, sexo, nascimento).
     * Foto e questionário IET ficam fora deste gate.
     */
    public function perfilBasicoCompleto()
    {
        return !empty($this->cd_cidade_tri)
            && !empty($this->cd_estado_est)
            && !empty($this->cd_sexo_sex)
            && !empty($this->dt_nascimento);
    }

    public function possuiScore()
    {
        return !empty($this->nr_score_tri) && (float) $this->nr_score_tri > 0;
    }

    /**
     * Destino pós-autenticação / onboarding para o trilheiro autenticado.
     */
    public function destinoOnboarding()
    {
        if (!$this->perfilBasicoCompleto()) {
            return 'trilheiro/privado/atualizar-cadastro';
        }

        return 'trilheiro/privado/perfil';
    }

    /**
     * Redireciona o usuário autenticado conforme o papel e o estado do cadastro.
     */
    public static function redirectAutenticado($user)
    {
        $role = trim((string) $user->id_role);

        switch ($role) {
            case 'ADMIN':
                return redirect('admin/dashboard');
            case 'GUIA':
                return redirect('guia-e-condutores/privado/atualizar-cadastro');
            case 'SOCIAL':
                return redirect('cadastro/privado/escolher-perfil');
            case 'TRILHEIRO':
                $trilheiro = self::where('id_user', $user->id)->first();
                if (!$trilheiro) {
                    return redirect('trilheiro/privado/atualizar-cadastro');
                }
                return redirect($trilheiro->destinoOnboarding());
            default:
                return redirect('/');
        }
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
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
    protected $fillable = ['id_user',
        'cd_cidade_origem_gui',
        'nm_guia_gui',
        'nm_instagram_gui',
        'nm_site_gui',
        'nm_path_logo_gui',
        'dc_biografia_gui',
        'fl_perfil_completo_gui',
        'fl_ativo_gui',
        'nu_cadastur_gui'
        ];
    public $timestamps = true;

    public function origem()
    {
        return $this->hasOne('App\Cidade', 'cd_cidade_cde', 'cd_cidade_origem_gui');
    }

    public function fone()
    {
        return $this->hasOne('App\Fone', 'id_guia_gui', 'id_guia_gui')->where('id_tipo_fone_tif', 1);
    }

    public function whatsap()
    {
        return $this->hasOne('App\Fone', 'id_guia_gui', 'id_guia_gui')->where('id_tipo_fone_tif', 2);
    }

    public function cidadesAtuacao()
    {
        return $this->belongsToMany(Cidade::class, 'guia_cidade_atuacao_gca', 'id_guia_gui', 'cd_cidade_cde');
    }

    public function unidadesConservacao()
    {
        return $this->belongsToMany(UnidadeConservacao::class, 'guia_unidade_conservacao_guc', 'id_guia_gui', 'id_unidade_conservacao_unc');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'id_user');
    }
}

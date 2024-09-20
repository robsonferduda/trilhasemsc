<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trilha extends Model
{
    use SoftDeletes;
    
    protected $table = 'trilha_tri';
    protected $primaryKey = 'id_trilha_tri';
    protected $dates = ['deleted_at'];
    protected $fillable = [
                            'nm_trilha_tri',
                            'ds_trilha_tri',
                            'ds_url_tri',
                            'id_nivel_niv',
                            'cd_cidade_cde',
                            'id_categoria_cat',
                            'id_complemento_nivel_con',
                            'id_user_usu',
                            'url_geolocalizacao_tri',
                            'fl_publicacao_tri'
                          ];

    public $timestamps = true;

    public function getCreatedAtAttribute($data)
    {
        return date($data);
    }

    public function detalhes()
    {
        return $this->hasOne('App\Detalhe', 'id_trilha_tri', 'id_trilha_tri');
    }

    public function foto()
    {
        return $this->hasMany('App\Foto', 'id_trilha_tri', 'id_trilha_tri');
    }

    public function nivel()
    {
        return $this->hasOne('App\Nivel', 'id_nivel_niv', 'id_nivel_niv');
    }

    public function complemento()
    {
        return $this->hasOne('App\Complemento', 'id_complemento_nivel_con', 'id_complemento_nivel_con');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'id_user_usu');
    }

    public function categoria()
    {
        return $this->hasOne('App\Categoria', 'id_categoria_cat', 'id_categoria_cat');
    }

    public function cidade()
    {
        return $this->hasOne('App\Cidade', 'cd_cidade_cde', 'cd_cidade_cde');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'trilha_tag_trt', 'id_trilha_tri', 'cd_tag_tag')->withTimestamps();
    }

    public function comentarios()
    {
        return $this->hasMany('App\Comentario', 'id_trilha_tri', 'id_trilha_tri')->orderBy('created_at', 'DESC');
    }

    public function guias()
    {
        return $this->belongsToMany('App\Guia', 'guia_trilha_gut' , 'id_trilha_tri', 'id_guia_gui')->orderBy('created_at', 'DESC');
    }
}

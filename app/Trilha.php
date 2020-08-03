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
                            'cd_cidade_cde'
    					  ];

    public $timestamps = true;

    public function getCreatedAtAttribute($data)
    {
        return date($data);
    }

    public function foto()
    {
        return $this->hasMany('App\Foto','id_trilha_tri','id_trilha_tri');
    }

    public function nivel(){
        return $this->hasOne('App\Nivel','id_nivel_niv','id_nivel_niv');
    }

    public function user(){
        return $this->hasOne('App\User','id','id_user_usu');
    }

    public function cidade(){
        return $this->hasOne('App\Cidade','cd_cidade_cde','cd_cidade_cde');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag','trilha_tag_trt','id_trilha_tri','cd_tag_tag')->withTimestamps();
    }

    public function comentarios()
    {
        return $this->hasMany('App\Comentario','id_trilha_tri','id_trilha_tri')->orderBy('created_at','DESC');
    }

}
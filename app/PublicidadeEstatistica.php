<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PublicidadeEstatistica extends Model
{
    use SoftDeletes;
    
    protected $table = 'publicidade_estatistica_pue';
    protected $primaryKey = 'id_publicidade_estatistica_pue';
    protected $dates = ['deleted_at'];
    protected $fillable = ['id_publicidade_pub','nu_ip_pue','ds_cidade_pue','ds_uf_pue'];

    public $timestamps = true;

}
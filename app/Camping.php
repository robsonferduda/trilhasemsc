<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Camping extends Model
{
    use SoftDeletes;
    
    protected $table = 'camping_cam';
    protected $primaryKey = 'cd_camping_cam';
    protected $dates = ['deleted_at'];
    protected $fillable = [
                            'ds_nome_cam',
                            'total_visitas_cam'
                          ];

    public $timestamps = true;

    public function cidade()
    {
        return $this->hasOne('App\Cidade', 'cd_cidade_cde', 'cd_cidade_cde');
    }

    public function tipo()
    {
        return $this->hasOne('App\TipoCamping', 'cd_tipo_camping_tic', 'cd_tipo_camping_tic');
    }
}
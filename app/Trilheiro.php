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
        'cd_cidade_tri'
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
}

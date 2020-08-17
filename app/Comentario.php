<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comentario extends Model
{
    use SoftDeletes;
    
    protected $table = 'comentario_com';
    protected $primaryKey = 'cd_comentario_com';
    protected $dates = ['deleted_at'];
    protected $fillable = [
                            'id_trilha_tri',
                            'id_user_usu',
                            'comentario_com',
                            'total_likes_com'
                          ];

    public $timestamps = true;

    public function trilha()
    {
        return $this->belongsTo('App\Comentario', 'id_trilha_tri');
    }

    public function usuario()
    {
        return $this->belongsTo('App\User', 'id_user_usu');
    }
}

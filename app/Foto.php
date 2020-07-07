<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Foto extends Model
{
	use SoftDeletes;
	
    protected $table = 'foto_fot';
    protected $primaryKey = 'id_foto_fot';
    protected $dates = ['deleted_at'];
    protected $fillable = [
    						'nm_foto_fot',
                            'nm_path_fot'
    					  ];

    public $timestamps = true;

    public function trilha()
    {
        return $this->belongsTo('App\Trilha','id_trilha_tri','id_trilha_tri');
    }


}

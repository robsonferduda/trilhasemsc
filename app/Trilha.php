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
                            'ds_url_tri'
    					  ];

    public $timestamps = true;

    public function foto()
    {
        return $this->hasMany('App\Foto','id_trilha_tri','id_trilha_tri');
    }

    public function getCreatedAtAttribute($data)
    {
        return date($data);
    }
}
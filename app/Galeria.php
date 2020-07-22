<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Galeria extends Model
{
    use SoftDeletes;
    
    protected $table = 'galeria_gal';
    protected $primaryKey = 'id_galeria_gal';
    protected $dates = ['deleted_at'];
    protected $fillable = [
    						'nm_galeria_gal', 'fl_ativa_gal'                        
    					  ];

    public $timestamps = true;

    public function fotos()
    {
        return $this->belongsToMany('App\Foto','galeria_fotos_gaf','id_galeria_gal','if_foto_fot')->withTimestamps();
    }

}
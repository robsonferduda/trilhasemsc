<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
    use SoftDeletes;
    
    protected $table = 'categoria_cat';
    protected $primaryKey = 'id_categoria_cat';
    protected $dates = ['deleted_at'];
    protected $fillable = [
    						'nm_categoria_cat'                        
    					  ];

    public $timestamps = true;


}

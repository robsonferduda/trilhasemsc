<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nivel extends Model
{
    use SoftDeletes;
    
    protected $table = 'nivel_niv';
    protected $primaryKey = 'id_nivel_niv';
    protected $dates = ['deleted_at'];
    protected $fillable = [
                            'dc_nivel_niv',
                            'dc_icone_niv',
                            'dc_color_nivel_niv',
                            'ordem_niv',
                          ];

    public $timestamps = true;
}

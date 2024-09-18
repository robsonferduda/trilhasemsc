<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cidade extends Model
{
    use SoftDeletes;
    
    protected $table = 'cidade_cde';
    protected $primaryKey = 'cd_cidade_cde';
    protected $dates = ['deleted_at'];
    protected $fillable = [
                            'nm_cidade_cde'
                          ];

    public $timestamps = true;

    public function trilhas()
    {
        return $this->hasMany('App\Trilha', 'cd_cidade_cde', 'cd_cidade_cde');
    }
}

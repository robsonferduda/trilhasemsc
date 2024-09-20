<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Detalhe extends Model
{
    use SoftDeletes;
    
    protected $table = 'trilha_detalhes_trd';
    protected $primaryKey = 'cd_trilha_detalhes_trd';
    protected $dates = ['deleted_at'];
    protected $fillable = [''];

    public $timestamps = true;

}
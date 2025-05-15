<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoCamping extends Model
{
    use SoftDeletes;
    
    protected $table = 'tipo_camping_tic';
    protected $primaryKey = 'cd_tipo_camping_tic';
    protected $dates = ['deleted_at'];
    protected $fillable = [
                            'ds_tipo_tic'
                          ];

    public $timestamps = true;
}
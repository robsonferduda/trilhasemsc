<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Indice extends Model
{
    use SoftDeletes;

    protected $table = 'indice_ind';
    protected $primaryKey = 'id_indice_ind';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'ds_indice_ind',
        'img_indice_ind',
        'descricao_ind',
        'ds_sigla_ind',
    ];

    public $timestamps = true;
}

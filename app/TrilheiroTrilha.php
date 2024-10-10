<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrilheiroTrilha extends Model
{
    protected $table = 'trilheiro_trilha_ttr';
    protected $primaryKey = 'id_trilheiro_trilha_ttr';
    protected $fillable = ['id_trilha_tri', 'id_trilheiro_tri'];
    public $timestamps = false;
}

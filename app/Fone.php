<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fone extends Model
{
    use SoftDeletes;
    
    protected $table = 'fone_fon';
    protected $primaryKey = 'id_fone_fon';
    protected $dates = ['deleted_at'];
    protected $fillable = [];
    public $timestamps = true;
}

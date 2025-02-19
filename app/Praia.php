<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Praia extends Model
{
    use SoftDeletes;
    
    protected $table = 'praia_pra';
    protected $primaryKey = 'cd_praia_pra';
    protected $dates = ['deleted_at'];
    protected $fillable = [];

    public $timestamps = true;

    public function getCreatedAtAttribute($data)
    {
        return date($data);
    }
}
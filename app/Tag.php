<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use SoftDeletes;
    
    protected $table = 'tag_tag';
    protected $primaryKey = 'cd_tag_tag';
    protected $dates = ['deleted_at'];
    protected $fillable = [
                            'ds_tag_tag'
                          ];

    public $timestamps = true;

    public function trilhas()
    {
        return $this->belongsToMany('App\Trilha', 'trilha_tag_trt', 'cd_tag_tag', 'id_trilha_tri')->withTimestamps();
    }
}

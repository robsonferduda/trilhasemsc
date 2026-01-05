<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserLog extends Model
{
    use SoftDeletes;
    
    protected $table = 'users_log';
    protected $primaryKey = 'id_users_log';
    protected $dates = ['deleted_at'];
    protected $fillable = [
                            'id_user_usu',
                            'ds_cidade_log',
                            'ds_uf_log',
                            'nu_ip_log'
                          ];

    public $timestamps = true;
}
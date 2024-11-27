<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QRCode extends Model
{
    use SoftDeletes;
    
    protected $table = 'qrcode_qrc';
    protected $primaryKey = 'cd_qrcode_qrc';
    protected $dates = ['deleted_at'];
}
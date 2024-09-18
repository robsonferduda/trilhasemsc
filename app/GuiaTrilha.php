<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GuiaTrilha extends Model
{
    protected $table = 'guia_trilha_gut';
    protected $primaryKey = 'id_guia_trilha_gut';
    protected $fillable = ['id_guia_gui', 'id_trilha_tri'];
    public $timestamps = false;
}

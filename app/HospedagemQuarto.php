<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HospedagemQuarto extends Model
{
    use SoftDeletes;

    protected $table = 'hospedagem_quarto_hoq';
    protected $primaryKey = 'cd_hospedagem_quarto_hoq';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'cd_hospedagem_hos',
        'ds_quarto_hoq',
        'nu_pessoas_hoq',
        'fl_banheiro_hoq',
        'fl_cafe_hoq',
        'obs_hoq',
    ];
    protected $casts = [
        'fl_banheiro_hoq' => 'boolean',
        'fl_cafe_hoq' => 'boolean',
    ];

    public $timestamps = true;

    public function hospedagem()
    {
        return $this->belongsTo(Hospedagem::class, 'cd_hospedagem_hos', 'cd_hospedagem_hos');
    }
}

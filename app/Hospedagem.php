<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hospedagem extends Model
{
    use SoftDeletes;

    protected $table = 'hospedagem_hos';
    protected $primaryKey = 'cd_hospedagem_hos';
    protected $dates = ['deleted_at', 'dt_chegada_hos', 'dt_saida_hos'];
    protected $fillable = [
        'cd_expedicao_exp',
        'nm_hospedagem_hos',
        'ds_cidade_hos',
        'nu_dias_hos',
        'dt_chegada_hos',
        'dt_saida_hos',
        'valor_total_hos',
        'total_hospedes_hos',
        'valor_individual_hos',
        'ds_url_hos',
    ];

    public $timestamps = true;

    public function scopeDaExpedicao($query, $expedicaoId)
    {
        if ($expedicaoId) {
            return $query->where('cd_expedicao_exp', $expedicaoId);
        }

        return $query;
    }

    public function scopeOrdenadasPorChegada($query)
    {
        return $query->orderBy('dt_chegada_hos');
    }

    public function quartos()
    {
        return $this->hasMany(HospedagemQuarto::class, 'cd_hospedagem_hos', 'cd_hospedagem_hos')
            ->orderBy('cd_hospedagem_quarto_hoq');
    }
}

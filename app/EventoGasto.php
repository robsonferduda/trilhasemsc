<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventoGasto extends Model
{
    const CATEGORIAS = [
        'transporte' => 'Transporte',
        'alimentacao' => 'Alimentação',
        'taxa_uc' => 'Taxa de UC',
        'guia' => 'Guia',
        'seguro' => 'Seguro',
        'outros' => 'Outros',
    ];

    protected $table = 'evento_gasto_evg';
    protected $primaryKey = 'cd_evento_gasto_evg';
    protected $fillable = [
        'id_evento_eve',
        'ds_categoria_evg',
        'vl_gasto_evg',
        'nm_pagador_evg',
        'ds_descricao_evg',
        'ds_comprovante_evg',
        'fl_rateio_evg',
        'fl_estimado_evg',
    ];
    protected $casts = [
        'vl_gasto_evg' => 'float',
        'fl_rateio_evg' => 'boolean',
        'fl_estimado_evg' => 'boolean',
    ];

    public $timestamps = true;

    public function evento()
    {
        return $this->belongsTo('App\Evento', 'id_evento_eve', 'id_evento_eve');
    }

    public function categoria()
    {
        return isset(self::CATEGORIAS[$this->ds_categoria_evg])
            ? self::CATEGORIAS[$this->ds_categoria_evg]
            : $this->ds_categoria_evg;
    }

    public static function reais($valor)
    {
        return 'R$ '.number_format((float) $valor, 2, ',', '.');
    }

    public static function interpretarValor($bruto)
    {
        $valor = trim(str_replace(['R$', ' '], '', (string) $bruto));
        if ($valor === '') {
            return null;
        }
        if (strpos($valor, ',') !== false) {
            $valor = str_replace('.', '', $valor);
            $valor = str_replace(',', '.', $valor);
        }
        if (!is_numeric($valor)) {
            return null;
        }

        return round((float) $valor, 2);
    }
}

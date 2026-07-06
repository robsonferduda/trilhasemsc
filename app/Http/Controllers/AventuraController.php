<?php

namespace App\Http\Controllers;

use App\Hospedagem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AventuraController extends Controller
{
    public function index()
    {
        
    }

    public function peru()
    {
        return view('aventuras.peru');
    }

    public function peruHospedagem()
    {
        $expedicaoId = config('aventuras.peru_2026.expedicao_id');

        $hospedagens = Hospedagem::daExpedicao($expedicaoId)
            ->ordenadasPorChegada()
            ->get();

        $hospedagens = $hospedagens->map(function ($hospedagem) {
            $valorPorPessoa = null;

            if (!is_null($hospedagem->valor_total_hos) && !empty($hospedagem->total_hospedes_hos)) {
                $valorPorPessoa = $hospedagem->valor_total_hos / $hospedagem->total_hospedes_hos;
            }

            $hospedagem->valor_calculado_por_pessoa_hos = $valorPorPessoa;

            return $hospedagem;
        });

        $totais = [
            'dias' => $hospedagens->sum('nu_dias_hos'),
            'valor_total' => $hospedagens->sum('valor_total_hos'),
            'valor_individual' => $hospedagens
                ->whereNotNull('valor_calculado_por_pessoa_hos')
                ->sum('valor_calculado_por_pessoa_hos'),
        ];

        return view('aventuras.peru-hospedagem', compact('hospedagens', 'totais'));
    }
}
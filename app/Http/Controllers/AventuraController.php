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

        $totais = [
            'dias' => $hospedagens->sum('nu_dias_hos'),
            'valor_total' => $hospedagens->sum('valor_total_hos'),
            'valor_individual' => $hospedagens->sum('valor_individual_hos'),
        ];

        return view('aventuras.peru-hospedagem', compact('hospedagens', 'totais'));
    }
}
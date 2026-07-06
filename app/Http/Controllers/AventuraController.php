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
        $cambioSoles = (float) config('aventuras.peru_2026.cambio_soles_brl', 1.52);

        $hospedagens = Hospedagem::daExpedicao($expedicaoId)
            ->ordenadasPorChegada()
            ->get();

        $hospedagens = $hospedagens->map(function ($hospedagem) use ($cambioSoles) {
            $valorPorPessoa = null;
            $valorPorPessoaSoles = null;

            if (!is_null($hospedagem->valor_total_hos) && !empty($hospedagem->total_hospedes_hos)) {
                $valorPorPessoa = $hospedagem->valor_total_hos / $hospedagem->total_hospedes_hos;
                $valorPorPessoaSoles = $cambioSoles > 0 ? $valorPorPessoa / $cambioSoles : null;
            }

            $hospedagem->valor_calculado_por_pessoa_hos = $valorPorPessoa;
            $hospedagem->valor_calculado_por_pessoa_soles_hos = $valorPorPessoaSoles;

            return $hospedagem;
        });

        $totais = [
            'dias' => $hospedagens->sum('nu_dias_hos'),
            'valor_total' => $hospedagens->sum('valor_total_hos'),
            'valor_individual' => $hospedagens
                ->whereNotNull('valor_calculado_por_pessoa_hos')
                ->sum('valor_calculado_por_pessoa_hos'),
            'valor_individual_soles' => $hospedagens
                ->whereNotNull('valor_calculado_por_pessoa_soles_hos')
                ->sum('valor_calculado_por_pessoa_soles_hos'),
        ];

        return view('aventuras.peru-hospedagem', compact('hospedagens', 'totais', 'cambioSoles'));
    }
}
<?php

namespace App\Services;

use App\Evento;
use App\Guia;
use App\GuiaFavorito;
use App\Mail\GuiaLancamentoFavorito;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AvisoFavoritosGuia
{
    public static function aoLancar(Evento $evento)
    {
        if (!self::deveAvisar($evento)) {
            return 0;
        }

        $guia = $evento->relationLoaded('guia') ? $evento->guia : Guia::find($evento->id_guia_gui);
        $favoritos = GuiaFavorito::with('trilheiro.user')
            ->where('id_guia_gui', $evento->id_guia_gui)
            ->get();

        $enviados = 0;
        foreach ($favoritos as $favorito) {
            $trilheiro = $favorito->trilheiro;
            $usuario = $trilheiro ? $trilheiro->user : null;
            $email = $usuario ? trim((string) $usuario->email) : '';
            if ($email === '' || !$guia) {
                continue;
            }
            if ((int) $usuario->id === (int) $guia->id_user) {
                continue;
            }

            try {
                Mail::to($email)->send(new GuiaLancamentoFavorito($evento, $guia, $trilheiro));
                $enviados++;
            } catch (\Throwable $e) {
                Log::warning('Aviso de passeio para favorito falhou: '.$e->getMessage());
            }
        }

        $evento->dt_aviso_favoritos_eve = now();
        $evento->save();

        return $enviados;
    }

    public static function deveAvisar(Evento $evento)
    {
        if ($evento->dt_aviso_favoritos_eve) {
            return false;
        }
        if ($evento->fl_cancelado_eve || $evento->fl_privado_eve) {
            return false;
        }
        if (!$evento->dt_realizacao_eve) {
            return false;
        }
        if (Carbon::parse($evento->dt_realizacao_eve)->lt(today())) {
            return false;
        }
        if (preg_match('/\(Cópia\)\s*$/u', trim((string) $evento->nm_evento_eve))) {
            return false;
        }

        return true;
    }
}

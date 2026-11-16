<?php

namespace App\Services\Clima;

use App\LocalizacaoClima;
use App\Trilha;

class LocalizacaoClimaResolver
{
    /**
     * Resolve ou cria localização climática a partir das coordenadas da trilha.
     *
     * @param Trilha $trilha
     * @return LocalizacaoClima|null
     */
    public function resolveFromTrilha(Trilha $trilha)
    {
        if ($trilha->nu_latitude_tri === null || $trilha->nu_longitude_tri === null) {
            return null;
        }

        return $this->resolve((float) $trilha->nu_latitude_tri, (float) $trilha->nu_longitude_tri);
    }

    /**
     * @param float $latitude
     * @param float $longitude
     * @return LocalizacaoClima
     */
    public function resolve($latitude, $longitude)
    {
        $decimals = (int) config('clima.grid_decimals', 3);
        $gridLat = round((float) $latitude, $decimals);
        $gridLng = round((float) $longitude, $decimals);

        $localizacao = LocalizacaoClima::where('nu_latitude_loc', $gridLat)
            ->where('nu_longitude_loc', $gridLng)
            ->first();

        if ($localizacao) {
            return $localizacao;
        }

        return LocalizacaoClima::create([
            'nu_latitude_loc' => $gridLat,
            'nu_longitude_loc' => $gridLng,
            'nu_latitude_origem_loc' => $latitude,
            'nu_longitude_origem_loc' => $longitude,
        ]);
    }

    /**
     * Coleta localizações distintas a partir de trilhas publicadas com coordenadas.
     * Cria registros de grid quando ainda não existem.
     *
     * @return \Illuminate\Support\Collection|LocalizacaoClima[]
     */
    public function collectFromPublishedTrilhas()
    {
        $trilhas = Trilha::query()
            ->where('fl_publicacao_tri', 'S')
            ->whereNotNull('nu_latitude_tri')
            ->whereNotNull('nu_longitude_tri')
            ->get(['id_trilha_tri', 'nu_latitude_tri', 'nu_longitude_tri']);

        $ids = [];
        foreach ($trilhas as $trilha) {
            $loc = $this->resolveFromTrilha($trilha);
            if ($loc) {
                $ids[$loc->id_localizacao_clima_loc] = true;
            }
        }

        if (empty($ids)) {
            return collect();
        }

        return LocalizacaoClima::whereIn('id_localizacao_clima_loc', array_keys($ids))->get();
    }
}

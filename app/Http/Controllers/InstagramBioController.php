<?php

namespace App\Http\Controllers;

use App\InstagramPublicacao;

class InstagramBioController extends Controller
{
    /**
     * Redireciona o link da bio para a trilha da última publicação.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirect()
    {
        $publicacao = InstagramPublicacao::query()
            ->where('ds_status_ipu', 'publicado')
            ->whereNotNull('ds_url_trilha_ipu')
            ->orderByDesc('dt_publicacao_ipu')
            ->orderByDesc('id_publicacao_ipu')
            ->first();

        if (!$publicacao) {
            return redirect('/');
        }

        return redirect()->away($publicacao->ds_url_trilha_ipu);
    }
}

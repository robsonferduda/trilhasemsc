<?php

namespace App\Mail;

use App\Trilha;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConviteTrilhaGuia extends Mailable
{
    use Queueable, SerializesModels;

    public $trilha;
    public $destinatarioNome;
    public $urlTrilha;
    public $urlCadastroTrilha;
    public $resumo;
    public $imagemUrl;
    public $isTest;

    public function __construct(Trilha $trilha, $destinatarioNome = null, $isTest = false)
    {
        $this->trilha = $trilha;
        $this->destinatarioNome = $destinatarioNome ?: 'guia';
        $this->isTest = (bool) $isTest;
        $this->urlTrilha = url($trilha->ds_url_tri);
        $this->urlCadastroTrilha = url('guia-e-condutores/privado/trilhas');
        $this->resumo = \Illuminate\Support\Str::limit(
            trim(preg_replace('/\s+/', ' ', strip_tags(html_entity_decode($trilha->ds_trilha_tri ?? '')))),
            220,
            '...'
        );

        $foto = $trilha->foto->where('id_tipo_foto_tfo', 5)->first()
            ?: $trilha->foto->first();
        $this->imagemUrl = $foto
            ? asset('img/trilhas/detalhes-principal/' . $foto->nm_path_fot)
            : asset('img/apple-icon.png');
    }

    public function build()
    {
        $subject = 'Convite: cadastre-se como executor da trilha ' . $this->trilha->nm_trilha_tri;

        if ($this->isTest) {
            $subject = '[TESTE] ' . $subject;
        }

        return $this->subject($subject)
            ->view('emails.convite-trilha-guia');
    }
}

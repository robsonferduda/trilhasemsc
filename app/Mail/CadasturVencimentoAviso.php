<?php

namespace App\Mail;

use App\Guia;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CadasturVencimentoAviso extends Mailable
{
    use Queueable, SerializesModels;

    public $guia;
    public $validade;
    public $urlCadastur;
    public $urlCadastroGuia;

    public function __construct(Guia $guia)
    {
        $this->guia = $guia;
        $this->validade = $guia->dt_cadastur_validade_gui->format('d/m/Y');
        $this->urlCadastur = 'https://cadastur.turismo.gov.br/hotsite/#!/public/capa/entrar';
        $this->urlCadastroGuia = url('guia-e-condutores/privado/atualizar-cadastro');
    }

    public function build()
    {
        return $this->subject('Seu Cadastur vence em ' . $this->validade)
            ->view('emails.cadastur-vencimento');
    }
}

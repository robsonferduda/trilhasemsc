<?php

namespace App\Mail;

use App\Guia;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GuiaConfirmacao extends Mailable
{
    use Queueable, SerializesModels;

    private $guia;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Guia $guia)
    {
        $this->guia = $guia;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject('Perfil Cadastrado.');
        $this->to($this->guia->user->email, $this->guia->nm_guia_gui);
        $this->bcc('rafael01costa@gmail.com', 'Rafael de Moraes Costa');
        $this->bcc('robsonferduda@gmail.com', 'Robson Duda');
        return $this->view('mail.guia-confirmacao', ['guia' => $this->guia]);
    }
}

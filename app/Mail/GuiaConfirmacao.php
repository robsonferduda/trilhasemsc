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
        $this->to('rafael01costa@gmail.com', 'Rafael de Moraes Costa');
        //$this->to('robsonferduda@gmail.com', 'Robson');
        return $this->view('mail.guia-confirmacao', ['guia' => $this->guia]);
    }
}

<?php

namespace App\Mail;

use App\Evento;
use App\Trilheiro;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NovoEventoTrilheiroNotificacao extends Mailable
{
    use Queueable, SerializesModels;

    public $evento;
    public $trilheiro;
    public $usuario;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Evento $evento, Trilheiro $trilheiro, User $usuario)
    {
        $this->evento = $evento;
        $this->trilheiro = $trilheiro;
        $this->usuario = $usuario;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject('Nova Inscrição no Evento - ' . $this->evento->nm_evento_eve);
        $this->to('robsonferduda@gmail.com', 'Administrador');
        return $this->view('mail.novo-evento-trilheiro-notificacao', [
            'evento' => $this->evento,
            'trilheiro' => $this->trilheiro,
            'usuario' => $this->usuario
        ]);
    }
}

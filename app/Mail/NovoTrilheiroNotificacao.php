<?php

namespace App\Mail;

use App\Trilheiro;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NovoTrilheiroNotificacao extends Mailable
{
    use Queueable, SerializesModels;

    public $trilheiro;
    public $usuario;
    public $tipoNotificacao;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $usuario, Trilheiro $trilheiro = null, $tipoNotificacao = null)
    {
        $this->usuario = $usuario;
        $this->trilheiro = $trilheiro;
        $this->tipoNotificacao = $tipoNotificacao;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subjectPrefix = $this->tipoNotificacao;

        $this->subject($subjectPrefix .' - '. $this->usuario->name);
        $this->to('robsonferduda@gmail.com', 'Administrador');
        return $this->view('mail.novo-trilheiro-notificacao', [
            'usuario' => $this->usuario,
            'trilheiro' => $this->trilheiro
        ]);
    }
}

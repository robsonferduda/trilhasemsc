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

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $usuario, Trilheiro $trilheiro = null)
    {
        $this->usuario = $usuario;
        $this->trilheiro = $trilheiro;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject('Novo Trilheiro Cadastrado - ' . $this->usuario->name);
        $this->to('robsonferduda@gmail.com', 'Administrador');
        return $this->view('mail.novo-trilheiro-notificacao', [
            'usuario' => $this->usuario,
            'trilheiro' => $this->trilheiro
        ]);
    }
}

<?php

namespace App\Mail;

use App\Trilheiro;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BoasVindasTrilheiro extends Mailable
{
    use Queueable, SerializesModels;

    public $trilheiro;

    /**
     * Create a new message instance.
     *
     * @param Trilheiro $trilheiro
     * @return void
     */
    public function __construct(Trilheiro $trilheiro)
    {
        $this->trilheiro = $trilheiro;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('🌿 Bem-vindo(a) ao Trilhas em SC!')
                    ->view('emails.boas-vindas-trilheiro');
    }
}

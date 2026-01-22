<?php

namespace App\Mail;

use App\Trilheiro;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConviteQuestionarioScore extends Mailable
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
        return $this->subject('🎯 Descubra seu nível de trilheiro - Responda nosso questionário!')
                    ->view('emails.convite-questionario-score');
    }
}

<?php

namespace App\Mail;

use App\Trilheiro;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewsletterUnsubscribeNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $trilheiro;
    public $motivoDescadastro;

    /**
     * Create a new message instance.
     *
     * @param Trilheiro $trilheiro
     * @param string|null $motivoDescadastro
     * @return void
     */
    public function __construct(Trilheiro $trilheiro, $motivoDescadastro = null)
    {
        $this->trilheiro = $trilheiro;
        $this->motivoDescadastro = $motivoDescadastro;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('🔔 Descadastro de Newsletter - ' . $this->trilheiro->nm_trilheiro_tri)
                    ->view('emails.admin.newsletter-unsubscribe-notification');
    }
}

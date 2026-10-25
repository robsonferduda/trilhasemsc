<?php

namespace App\Mail;

use App\Guia;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GuiaAcao extends Mailable
{
    use Queueable, SerializesModels;

    public $guia;
    public $conteudo;

    public function __construct(Guia $guia, array $conteudo)
    {
        $this->guia = $guia;
        $this->conteudo = $conteudo;
    }

    public function build()
    {
        return $this->subject($this->conteudo['assunto'])
            ->view('emails.guia-acao');
    }
}

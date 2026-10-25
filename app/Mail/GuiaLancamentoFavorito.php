<?php

namespace App\Mail;

use App\Evento;
use App\Guia;
use App\Trilheiro;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GuiaLancamentoFavorito extends Mailable
{
    use Queueable, SerializesModels;

    public $evento;
    public $guia;
    public $trilheiro;

    public function __construct(Evento $evento, Guia $guia, Trilheiro $trilheiro)
    {
        $this->evento = $evento;
        $this->guia = $guia;
        $this->trilheiro = $trilheiro;
    }

    public function build()
    {
        return $this->subject($this->guia->nm_guia_gui.' lançou um passeio')
            ->view('emails.guia-lancamento-favorito');
    }
}

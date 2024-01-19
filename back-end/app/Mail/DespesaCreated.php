<?php

namespace App\Mail;

use App\Models\Usuario;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DespesaCreated extends Mailable
{
    use Queueable, SerializesModels;

    protected Usuario $usuario;

    public function __construct(Usuario $usuario)
    {
        $this->usuario = $usuario;
    }

    public function build()
    {
        return $this->subject('Sua despesa foi cadastrada!')
            ->view('emails.despesa-email')
            ->with([
                'usuario' => $this->usuario,
            ]);
    }
}

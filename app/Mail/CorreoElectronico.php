<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CorreoElectronico extends Mailable
{
    use Queueable, SerializesModels;
    public $nombre_actividad;

    public function __construct($nombre_actividad)
    {
        $this->nombre_actividad = $nombre_actividad;
    }

    public function build()
    {
        return $this->subject('Nueva Actividad')
            ->view('emails.correoElectronico')
            ->with(['nombre_actividad' => $this->nombre_actividad]);
    }
}


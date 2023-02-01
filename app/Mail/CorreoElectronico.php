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
    public $fecha_inicio;
    public $fecha_finalizacion;
    public $descripcion;
    public $costo;


    public function __construct($nombre_actividad, $fecha_inicio, $fecha_finalizacion, $descripcion, $costo)
    {
        $this->nombre_actividad = $nombre_actividad;
        $this->fecha_inicio = $fecha_inicio;
        $this->fecha_finalizacion = $fecha_finalizacion;
        $this->descripcion = $descripcion;
        $this->costo = $costo;
    }
    public function build()
    {
        return $this->subject('Nueva Actividad')
            ->view('emails.correoElectronico')
            ->with([
                'nombre_actividad' => $this->nombre_actividad,
                'fecha_inicio' => $this->fecha_inicio,
                'fecha_finalizacion' => $this->fecha_finalizacion,
                'descripcion' => $this->descripcion,
                'costo' => $this->costo,
            ]);
    }
}


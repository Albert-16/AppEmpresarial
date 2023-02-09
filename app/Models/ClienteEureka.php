<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClienteEureka extends Model
{
    use HasFactory;
    protected $table = 'actividades';
    protected $primaryKey = 'id_actividad';
    protected $fillable = ['nombre','telefono','direccion','email','fecha_nacimiento','referencia','id_estado'];

    //relacion con estados_cliente
    public function estado()
    {
        return $this->belongsTo(EstadoCliente::class, 'id_estado_cliente', 'id_estado_cliente');
    }
}
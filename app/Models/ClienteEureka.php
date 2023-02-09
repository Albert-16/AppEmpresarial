<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClienteEureka extends Model
{
    use HasFactory;
    protected $table = 'clientes_eureka';
    protected $primaryKey = 'identidad';
    protected $fillable = ['nombre','telefono','direccion','email','fecha_nacimiento','referencia','id_estado_cliente'];

    //relacion con estados_cliente
    public function estado()
    {
        return $this->belongsTo(EstadoCliente::class, 'id_estado_cliente', 'id_estado_cliente');
    }
}
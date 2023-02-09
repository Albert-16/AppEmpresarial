<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoCliente extends Model
{
    use HasFactory;
    protected $table = 'estados_cliente';
    protected $primaryKey = 'id_estado';
    public $incrementing = true;
    protected $fillable = [
        'descripcion'
    ];

    public function estadosClientes()
    {
        return $this->hasMany(ClienteEureka::class, 'id_estado_cliente', 'id_estado_cliente');
    }
}

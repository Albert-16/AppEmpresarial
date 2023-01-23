<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    use HasFactory;

    protected $table = 'actividades';
    protected $primaryKey = 'id_actividad';
    public $incrementing = true;
    protected $fillable = [
        'nombre_actividad', 'descripcion', 'fecha_inicio', 'fecha_finalizacion', 'costo', 'id_estado',
    ];

    public function estado()
    {
        return $this->belongsTo(Estado::class,'id_estado','id_estado');
    }
}

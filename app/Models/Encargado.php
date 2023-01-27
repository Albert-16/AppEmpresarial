<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encargado extends Model
{
    use HasFactory;
    protected $table = 'encargados';
    protected $primaryKey = 'id_encargado';
    public $incrementing = true;
    protected $fillable = [
        'nombre_encargado', 'telefono', 'direccion', 'id_estado_encargado'
    ];

    public function actividadesEncargado()
    {
        return $this->belongsToMany(Actividad::class, 'actividades_encargado', 'id_actividad', 'id_encargado');
    }

    public function estadoEncargado()
    {
        return $this->belongsTo(Estado_Encargado::class, 'id_estado_encargado', 'id_estado_encargado');
    }

    
}

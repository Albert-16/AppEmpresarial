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
        'nombre_encargado', 'telefono', 'direccion'
    ];

    public function actividadesEncargado()
    {
        return $this->belongsToMany(Actividad::class, 'actividades_encargado', 'id_actividad', 'id_encargado');
    }
}

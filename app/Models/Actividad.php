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
        return $this->belongsTo(Estado::class, 'id_estado', 'id_estado');
    }

    //funcion para establecer la relacion de actividades y encargados usando la tabla pivote actividades_encargados.
    public function actividadesEncargado()
    {
        return $this->belongsToMany(Actividad::class, 'actividades_encargado', 'id_actividad', 'id_encargado')->withTimestamps();
    }
    //funcion para establecer la relacion de actividades y empresa usando la tabla pivote actividades_empresa.

    public function actividadesEmpresa(){
        return  $this->belongsToMany(Actividad::class,'actividades_empresa','id_actividad','id_empresa');

    }
}

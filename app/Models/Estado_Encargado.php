<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado_Encargado extends Model
{
    use HasFactory;
    protected $table = 'estado_encargados';
    protected $primaryKey = 'id_estado_encargado';
    public $incrementing = true;
    protected $fillable = [
        'descripcion'
    ];

    public function estadosEncargados()
    {
        return $this->hasMany(Encargado::class, 'id_estado_encargado', 'id_estado_encargado ');
    }
}

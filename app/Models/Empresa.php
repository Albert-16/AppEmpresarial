<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;
    protected $table = 'empresas';
    protected $primaryKey = 'id_empresa';
    public $incrementing = true;
    protected $fillable = ['nombre'];

    public function actividadesEmpresa()
    {
        return  $this->belongsToMany(Actividad::class, 'actividades_empresa', 'id_actividad', 'id_empresa');
    }
}

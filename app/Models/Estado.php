<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;
    protected $table = 'estados';
    protected $primaryKey = 'id_estado';
    public $incrementing = true;
    protected $fillable = [
        'descripcion'
    ];

    public function actividades()
    {
        return $this->hasMany(Actividad::class,'id_estado','id_estado');
    }
}

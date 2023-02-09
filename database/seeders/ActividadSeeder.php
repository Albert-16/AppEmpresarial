<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Actividad;
class ActividadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Actividad::create([
            'nombre_actividad' => 'Actividad Origen',
            'descripcion' => 'Actividad para inciar el sistema',
            'fecha_inicio' => '2021-05-01',
            'fecha_finalizacion' => '2021-05-02',
            'costo' => 0,
            'egresos' => 0,
            'total' => 0,
            'id_estado' => 1,
            'id_empresa' => 1,
            'id_encargado' => 1
        ]);
    }
}

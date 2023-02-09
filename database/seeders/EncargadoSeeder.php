<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Encargado;

class EncargadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Encargado::create([
            'nombre_encargado' => 'Juan',
            'telefono' => '12345678',
            'direccion' => 'Col. La concepcion',
            'id_estado_encargado' => 1
        ]);

        Encargado::create([
            'nombre_encargado' => 'Pedro',
            'telefono' => '12345678',
            'direccion' => 'Col. La concepcion',
            'id_estado_encargado' => 2
        ]);
        
        Encargado::create([
            'nombre_encargado' => 'Maria',
            'telefono' => '12345678',
            'direccion' => 'Col. La concepcion',
            'id_estado_encargado' => 1
        ]);

        Encargado::create([
            'nombre_encargado' => 'Jose',
            'telefono' => '12345678',
            'direccion' => 'Col. La concepcion',
            'id_estado_encargado' => 2
        ]);
    }
}

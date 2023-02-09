<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Estado_Encargado;

class EstadoEncargadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Estado_Encargado::create([
            'descripcion' => 'Activo',
        ]);
    
        Estado_Encargado::create([
            'descripcion' => 'Inactivo',
        ]);
    }
    
}

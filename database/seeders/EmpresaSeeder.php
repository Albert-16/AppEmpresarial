<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Empresa;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Empresa::create([
            'nombre' => 'Eureka',
            'id_encargado' => 1,
        ]);

        Empresa::create([
            'nombre' => 'Z Media',
            'id_encargado' => 2,
        ]);

        Empresa::create([
            'nombre' => 'Vaca Morada',
            'id_encargado' => 3,
        ]);

        Empresa::create([
            'nombre' => 'Cea Soluciones',
            'id_encargado' => 4,
        ]);

    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EstadoCliente;
class EstadoClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        EstadoCliente::create([
            'descripcion' => 'Activo',
        ]);

        EstadoCliente::create([
            'descripcion' => 'Inactivo',
        ]);
    }
}

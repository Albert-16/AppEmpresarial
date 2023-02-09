<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ClienteEureka;

class ClienteEurekaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        ClienteEureka::create([
            'identidad'   => '0703200103774',
            'nombre' => 'Juan Perez',
            'telefono' => '12345678',
            'direccion' => 'Calle 1',
            'email' => 'ejemplo@gmail.com',
            'fecha_nacimiento' => '2021-05-01',
            'referencia' => 'Carlos Ardon',
            'numero_talonario' => '00129',
            'id_estado_cliente' =>'1'
        ]);
    }
}

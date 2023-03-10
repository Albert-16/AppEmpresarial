<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(EstadoSeeder::class);
        $this->call(EstadoEncargadoSeeder::class);
        $this->call(EncargadoSeeder::class);
        $this->call(EmpresaSeeder::class);
        $this->call(ActividadSeeder::class);
        $this->call(EstadoClienteSeeder::class);
        $this->call(ClienteEurekaSeeder::class);
    }
}

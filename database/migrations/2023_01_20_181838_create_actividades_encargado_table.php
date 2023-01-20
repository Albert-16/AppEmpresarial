<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividades_encargado', function (Blueprint $table) {
            $table->unsignedBigInteger('id_actividad');
            $table->unsignedBigInteger('id_encargado');
            $table->foreign('id_actividad')->references('id_actividad')->on('actividades');
            $table->foreign('id_encargado')->references('id_encargado')->on('encargados');
            $table->primary(['id_actividad','id_encargado']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actividades_encargado');
    }
};

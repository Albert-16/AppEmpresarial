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
        Schema::create('encargados', function (Blueprint $table) {
            $table->id('id_encargado');
            $table->string('nombre_encargado')->notnull();
            $table->string('telefono')->notnull();
            $table->string('direccion');
            $table->string('email')->notnull();
            $table->unsignedBigInteger('id_estado_encargado');
            $table->foreign('id_estado_encargado')->references('id_estado_encargado')->on('estado_encargados');

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
        Schema::dropIfExists('encargados');
    }
};

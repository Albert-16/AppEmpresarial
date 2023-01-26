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
        Schema::create('actividades', function (Blueprint $table) {
            $table->id('id_actividad');
            $table->string('nombre_actividad')->notnull();
            $table->string('descripcion')->notnull();
            $table->date('fecha_inicio')->notnull();
            $table->date('fecha_finalizacion')->notnull();
            $table->double('costo', 10, 3)->notnull();
            $table->unsignedBigInteger('id_estado');
            $table->unsignedBigInteger('id_empresa');
            $table->unsignedBigInteger('id_encargado');
            $table->foreign('id_estado')->references('id_estado')->on('estados');
            $table->foreign('id_empresa')->references('id_empresa')->on('empresas');
            $table->foreign('id_encargado')->references('id_encargado')->on('encargados');
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
        Schema::dropIfExists('actividades');
    }
};

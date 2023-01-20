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
            $table->id('id_actividad')->primary();
            $table->string('nombre_actividad')->notnull();
            $table->string('descripcion')->notnull();
            $table->date('fecha_inicio')->notnull();
            $table->date('fecha_finalizacion')->notnull();
            $table->double('costo', 10, 3)->notnull();
            $table->unsignedBigInteger('id_estado');
            $table->foreign('id_estado')->references('id_estado')->on('estados');
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

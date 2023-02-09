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
        Schema::create('clientes_eureka', function (Blueprint $table) {
            $table->string('identidad')->primary();
            $table->string('nombre');
            $table->string('telefono');
            $table->string('direccion');
            $table->string('email');
            $table->date('fecha_nacimiento');
            $table->string('referencia');
            $table->string('numero_talonario',7);
            $table->unsignedBigInteger('id_estado_cliente');
            $table->foreign('id_estado_cliente')->references('id_estado_cliente')->on('estados_cliente');
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
        Schema::dropIfExists('clientes_eureka');
    }
};

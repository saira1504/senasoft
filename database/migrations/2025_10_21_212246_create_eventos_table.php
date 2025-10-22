<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->id(); // RF1: código auto incrementable
            $table->string('nombre_evento'); // RF1: nombre del evento
            $table->text('descripcion'); // RF1: descripción del evento
            $table->datetime('fecha_hora_inicio'); // RF1: fecha y hora de inicio
            $table->datetime('fecha_hora_fin'); // RF1: fecha y hora de fin
            $table->string('municipio'); // RF5: para consultas por municipio
            $table->string('departamento'); // RF5: para consultas por departamento
            $table->string('imagen_evento')->nullable(); // Imagen del evento
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
        Schema::dropIfExists('eventos');
    }
}

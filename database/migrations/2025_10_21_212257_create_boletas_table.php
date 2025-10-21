<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoletasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boletas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('evento_id')->constrained('eventos')->onDelete('cascade'); // RF2: evento seleccionado
            $table->foreignId('localidad_id')->constrained('localidades')->onDelete('cascade'); // RF2: localidad
            $table->decimal('valor_boleta', 10, 2); // RF2: valor de la boleta
            $table->integer('cantidad_disponible'); // RF2: cantidad de boletas disponibles
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
        Schema::dropIfExists('boletas');
    }
}

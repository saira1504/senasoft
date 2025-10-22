<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtistasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artistas', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_artista')->unique(); // RF4: código del artista
            $table->string('nombres'); // RF4: nombres del artista
            $table->string('apellidos'); // RF4: apellidos del artista
            $table->string('genero_musical'); // RF4: género de música del artista
            $table->string('ciudad_natal'); // RF4: ciudad natal del artista
            $table->string('imagen_artista')->nullable(); // Imagen del artista
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
        Schema::dropIfExists('artistas');
    }
}

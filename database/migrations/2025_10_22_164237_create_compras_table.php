<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('boleta_id')->constrained()->onDelete('cascade');
            $table->integer('cantidad_comprada');
            $table->decimal('precio_unitario', 10, 2);
            $table->decimal('total_pagado', 10, 2);
            $table->string('estado')->default('confirmada'); // confirmada, cancelada
            $table->string('metodo_pago')->nullable(); // efectivo, tarjeta, transferencia
            $table->text('observaciones')->nullable();
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
        Schema::dropIfExists('compras');
    }
}

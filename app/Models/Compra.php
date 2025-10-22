<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'boleta_id',
        'cantidad_comprada',
        'precio_unitario',
        'total_pagado',
        'estado',
        'metodo_pago',
        'observaciones'
    ];

    protected $casts = [
        'precio_unitario' => 'decimal:2',
        'total_pagado' => 'decimal:2'
    ];

    // Relación con usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con boleta
    public function boleta()
    {
        return $this->belongsTo(Boleta::class);
    }

    // Relación con evento a través de boleta
    public function evento()
    {
        return $this->hasOneThrough(Evento::class, Boleta::class, 'id', 'id', 'boleta_id', 'evento_id');
    }
}
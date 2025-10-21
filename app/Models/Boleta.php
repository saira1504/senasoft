<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boleta extends Model
{
    use HasFactory;

    protected $fillable = [
        'evento_id',
        'localidad_id',
        'valor_boleta',
        'cantidad_disponible'
    ];

    protected $casts = [
        'valor_boleta' => 'decimal:2'
    ];

    // Relación muchos a uno con evento
    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }

    // Relación muchos a uno con localidad
    public function localidad()
    {
        return $this->belongsTo(Localidad::class);
    }
}

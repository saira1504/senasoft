<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artista extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo_artista',
        'nombres',
        'apellidos',
        'genero_musical',
        'ciudad_natal'
    ];

    // Relación muchos a muchos con eventos
    public function eventos()
    {
        return $this->belongsToMany(Evento::class, 'evento_artista');
    }
}

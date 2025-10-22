<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_evento',
        'descripcion',
        'fecha_hora_inicio',
        'fecha_hora_fin',
        'municipio',
        'departamento',
        'imagen_evento',
        'localidad_id'
        
    ];

    protected $casts = [
        'fecha_hora_inicio' => 'datetime',
        'fecha_hora_fin' => 'datetime'
    ];

    // Relación muchos a muchos con artistas
    public function artistas()
    {
        return $this->belongsToMany(Artista::class, 'evento_artista');
    }

    // Relación uno a muchos con boletas
    public function boletas()
    {
        return $this->hasMany(Boleta::class);
    }
      public function localidad()
    {
        return $this->belongsTo(Localidad::class, 'localidad_id');
    }
}

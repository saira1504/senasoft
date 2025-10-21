<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Localidad extends Model
{
    use HasFactory;

    protected $table = 'localidades';

    protected $fillable = [
        'codigo_localidad',
        'nombre_localidad'
    ];

    // Relación uno a muchos con boletas
    public function boletas()
    {
        return $this->hasMany(Boleta::class);
    }
}

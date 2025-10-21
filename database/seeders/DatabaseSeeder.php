<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Crear localidades de ejemplo
        \App\Models\Localidad::create([
            'codigo_localidad' => 'VIP',
            'nombre_localidad' => 'Palco VIP'
        ]);
        
        \App\Models\Localidad::create([
            'codigo_localidad' => 'GEN',
            'nombre_localidad' => 'General'
        ]);
        
        \App\Models\Localidad::create([
            'codigo_localidad' => 'PRE',
            'nombre_localidad' => 'Preferencial'
        ]);

        // Crear artistas de ejemplo
        \App\Models\Artista::create([
            'codigo_artista' => 'ART001',
            'nombres' => 'Carlos',
            'apellidos' => 'Vives',
            'genero_musical' => 'Vallenato',
            'ciudad_natal' => 'Santa Marta'
        ]);
        
        \App\Models\Artista::create([
            'codigo_artista' => 'ART002',
            'nombres' => 'Shakira',
            'apellidos' => 'Mebarak',
            'genero_musical' => 'Pop',
            'ciudad_natal' => 'Barranquilla'
        ]);
        
        \App\Models\Artista::create([
            'codigo_artista' => 'ART003',
            'nombres' => 'Juanes',
            'apellidos' => 'Estrada',
            'genero_musical' => 'Rock',
            'ciudad_natal' => 'Medellín'
        ]);

        // Crear eventos de ejemplo
        $evento1 = \App\Models\Evento::create([
            'nombre_evento' => 'Festival de Música Colombiana',
            'descripcion' => 'Gran festival que celebra la música tradicional colombiana con los mejores exponentes del vallenato, cumbia y música andina.',
            'fecha_hora_inicio' => '2025-12-15 19:00:00',
            'fecha_hora_fin' => '2025-12-15 23:00:00',
            'municipio' => 'Bogotá',
            'departamento' => 'Cundinamarca'
        ]);
        
        $evento2 = \App\Models\Evento::create([
            'nombre_evento' => 'Concierto de Rock Nacional',
            'descripcion' => 'Noche de rock con las mejores bandas nacionales e internacionales en un ambiente único.',
            'fecha_hora_inicio' => '2025-12-20 20:00:00',
            'fecha_hora_fin' => '2025-12-21 02:00:00',
            'municipio' => 'Medellín',
            'departamento' => 'Antioquia'
        ]);

        // Asociar artistas a eventos
        $evento1->artistas()->attach([1, 2]); // Carlos Vives y Shakira
        $evento2->artistas()->attach([3]); // Juanes

        // Crear boletas de ejemplo
        \App\Models\Boleta::create([
            'evento_id' => $evento1->id,
            'localidad_id' => 1, // Palco VIP
            'valor_boleta' => 150000,
            'cantidad_disponible' => 50
        ]);
        
        \App\Models\Boleta::create([
            'evento_id' => $evento1->id,
            'localidad_id' => 2, // General
            'valor_boleta' => 80000,
            'cantidad_disponible' => 200
        ]);
        
        \App\Models\Boleta::create([
            'evento_id' => $evento2->id,
            'localidad_id' => 1, // Palco VIP
            'valor_boleta' => 200000,
            'cantidad_disponible' => 30
        ]);
        
        \App\Models\Boleta::create([
            'evento_id' => $evento2->id,
            'localidad_id' => 3, // Preferencial
            'valor_boleta' => 120000,
            'cantidad_disponible' => 100
        ]);
    }
}

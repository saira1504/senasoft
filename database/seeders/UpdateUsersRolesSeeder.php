<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UpdateUsersRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Actualizar usuarios existentes con sus roles
        $users = User::with('roles')->get();
        
        foreach ($users as $user) {
            // Obtener el primer rol del usuario
            $role = $user->roles->first();
            
            if ($role) {
                $user->rol = $role->name;
                $user->save();
                
                echo "Usuario {$user->name} actualizado con rol: {$role->name}\n";
            } else {
                // Si no tiene rol asignado, asignar rol de comprador por defecto
                $user->rol = 'comprador';
                $user->save();
                
                // Asignar el rol en la tabla de relaciones también
                $compradorRole = Role::where('name', 'comprador')->first();
                if ($compradorRole) {
                    $user->assignRole('comprador');
                }
                
                echo "Usuario {$user->name} asignado rol por defecto: comprador\n";
            }
        }
    }
}

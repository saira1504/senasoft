<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;

class SyncUserRolesOnLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Solo procesar si el usuario está autenticado
        if (Auth::check()) {
            $user = Auth::user();
            
            // Verificar si el campo rol del usuario existe y está sincronizado
            if ($user->rol) {
                // Buscar el rol en la tabla de roles
                $role = Role::where('name', $user->rol)->first();
                
                if ($role) {
                    // Verificar si el usuario ya tiene este rol asignado
                    $hasRole = $user->roles()->where('role_id', $role->id)->exists();
                    
                    if (!$hasRole) {
                        // Si no tiene el rol asignado, asignarlo
                        $user->roles()->sync([$role->id]);
                        
                        // Log para debugging (opcional)
                        \Log::info("Rol sincronizado para usuario {$user->name}: {$user->rol}");
                    }
                }
            }
        }

        return $next($request);
    }
}

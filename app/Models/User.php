<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'tipo_documento',
        'rol',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relación muchos a muchos con roles
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles');
    }

    // Método para verificar si el usuario tiene un rol específico
    public function hasRole($role)
    {
        return $this->roles()->where('name', $role)->exists();
    }

    // Método para verificar si el usuario es administrador
    public function isAdmin()
    {
        return $this->hasRole('admin');
    }

    // Método para verificar si el usuario es comprador
    public function isComprador()
    {
        return $this->hasRole('comprador');
    }

    // Método para asignar un rol al usuario
    public function assignRole($role)
    {
        if (is_string($role)) {
            $role = Role::where('name', $role)->first();
        }
        
        if ($role && !$this->hasRole($role->name)) {
            $this->roles()->attach($role);
            // Sincronizar el campo rol con el rol asignado
            $this->rol = $role->name;
            $this->save();
        }
    }

    // Método para sincronizar el campo rol con los roles de la tabla de relaciones
    public function syncRolField()
    {
        $role = $this->roles->first();
        if ($role) {
            $this->rol = $role->name;
            $this->save();
        }
    }

    // Método para sincronizar roles desde el campo rol hacia la tabla de relaciones
    public function syncRolesFromField()
    {
        if ($this->rol) {
            $role = Role::where('name', $this->rol)->first();
            if ($role) {
                $this->roles()->sync([$role->id]);
                return true;
            }
        }
        return false;
    }

    // Relación con compras
    public function compras()
    {
        return $this->hasMany(Compra::class);
    }
}

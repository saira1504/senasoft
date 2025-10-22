<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;

echo "=== VERIFICACIÓN DE USUARIOS ADMINISTRADORES ===\n\n";

$admins = User::where('rol', 'admin')->get();

echo "Usuarios con rol 'admin':\n";
foreach ($admins as $admin) {
    echo "ID: {$admin->id} | Nombre: {$admin->name} | Email: {$admin->email}\n";
    echo "  - Rol en campo: {$admin->rol}\n";
    echo "  - Roles en tabla: " . $admin->roles->pluck('name')->implode(', ') . "\n";
    echo "  - Método isAdmin(): " . ($admin->isAdmin() ? 'TRUE' : 'FALSE') . "\n";
    echo "  - Método hasRole('admin'): " . ($admin->hasRole('admin') ? 'TRUE' : 'FALSE') . "\n\n";
}

echo "=== INSTRUCCIONES PARA PROBAR ===\n";
echo "1. Inicia sesión con uno de los usuarios administradores\n";
echo "2. Ve a: http://127.0.0.1:8000/eventos/create\n";
echo "3. Ve a: http://127.0.0.1:8000/boletas/create\n";
echo "\nSi sigues teniendo problemas, verifica que estés logueado correctamente.\n";
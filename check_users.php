<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;

echo "=== USUARIOS CON ROLES ===\n";
$users = User::select('id', 'name', 'email', 'rol')->get();

foreach ($users as $user) {
    echo "ID: {$user->id} | Nombre: {$user->name} | Email: {$user->email} | Rol: {$user->rol}\n";
}

echo "\n=== TOTAL USUARIOS: " . $users->count() . " ===\n";
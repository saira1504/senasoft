<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\LocalidadController;
use App\Http\Controllers\ArtistaController;
use App\Http\Controllers\BoletaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\PerfilController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('dashboard');
});

// Rutas de autenticación
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Página de información de acceso
Route::get('/admin-access', function () {
    return view('auth.admin-access');
})->name('admin-access');

// Rutas protegidas por autenticación
Route::middleware('auth')->group(function () {

    // ---- Rutas comunes (accesibles a todo usuario autenticado) ----
    Route::get('/eventos', [EventoController::class, 'index'])->name('eventos.admin.index');
    Route::get('/boletas', [BoletaController::class, 'index'])->name('boletas.index');

    // Perfil del usuario
    Route::get('/perfil', [PerfilController::class, 'show'])->name('perfil.show');
    Route::get('/perfil/edit', [PerfilController::class, 'edit'])->name('perfil.edit');
    Route::put('/perfil', [PerfilController::class, 'update'])->name('perfil.update');

    // ---- Rutas específicas para Compradores ----
    Route::middleware('role:comprador')->group(function () {
        Route::get('/boletas/{boleta}/comprar', [CompraController::class, 'create'])->name('compras.create');
        Route::post('/boletas/{boleta}/comprar', [CompraController::class, 'store'])->name('compras.store');
        Route::get('/compras', [CompraController::class, 'historial'])->name('compras.historial');
        Route::get('/compras/{compra}', [CompraController::class, 'show'])->name('compras.show');
    });

    // ---- Rutas específicas para Administradores (CRUDs) ----
    // IMPORTANTE: Las rutas "create" van ANTES de las rutas con parámetros
    Route::middleware('role:admin')->group(function () {
        // Eventos (RF1, RF5)
        Route::get('/eventos/create', [EventoController::class, 'create'])->name('eventos.admin.create');
        Route::post('/eventos', [EventoController::class, 'store'])->name('eventos.admin.store');
        Route::get('/eventos/{evento}/edit', [EventoController::class, 'edit'])->name('eventos.admin.edit');
        Route::put('/eventos/{evento}', [EventoController::class, 'update'])->name('eventos.admin.update');
        Route::delete('/eventos/{evento}', [EventoController::class, 'destroy'])->name('eventos.admin.destroy');

        // Localidades (RF3)
        Route::resource('localidades', LocalidadController::class);

        // Artistas (RF4)
        Route::resource('artistas', ArtistaController::class);

        // Boletas (RF2)
        Route::get('/boletas/create', [BoletaController::class, 'create'])->name('boletas.create');
        Route::post('/boletas', [BoletaController::class, 'store'])->name('boletas.store');
        Route::get('/boletas/{boleta}/edit', [BoletaController::class, 'edit'])->name('boletas.edit');
        Route::put('/boletas/{boleta}', [BoletaController::class, 'update'])->name('boletas.update');
        Route::delete('/boletas/{boleta}', [BoletaController::class, 'destroy'])->name('boletas.destroy');
    });

    // ---- Rutas con parámetros (van DESPUÉS para evitar conflicto con "create") ----
    Route::get('/eventos/{evento}', [EventoController::class, 'show'])->name('eventos.admin.show');
    Route::get('/boletas/{boleta}', [BoletaController::class, 'show'])->name('boletas.show');
});

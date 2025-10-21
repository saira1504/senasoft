<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\LocalidadController;
use App\Http\Controllers\ArtistaController;
use App\Http\Controllers\BoletaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('eventos.index');
});

// Rutas para Eventos (RF1, RF5)
Route::resource('eventos', EventoController::class);

// Rutas para Localidades (RF3)
Route::resource('localidades', LocalidadController::class);

// Rutas para Artistas (RF4)
Route::resource('artistas', ArtistaController::class);

// Rutas para Boletas (RF2)
Route::resource('boletas', BoletaController::class);

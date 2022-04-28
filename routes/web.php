<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Clientes;
use App\Http\Livewire\Transportistas;
use App\Http\Livewire\Cargas;
use App\Http\Livewire\Vehiculos;
use App\Http\Controllers\MapaController;
use App\Http\Controllers\BuscadorController;
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
    return redirect()->to("/login");
});
Route::get('/buscador', [BuscadorController::class, 'mostrar_buscador'])->name('buscador.mostrar');

Route::get('/welcome', function () {
    return view('welcome');
});

//RUTAS DE MAPA DE TRANSPORTES
Route::get('/mapa', [MapaController::class, 'ubicacion_todos'])->name('mapa_todos');

Route::get('/mapa/transportes/{transportes}', [MapaController::class, 'ubicacion_transportes'])->name('mapa_transportes');

Route::get('/mapa/transportes', [MapaController::class, 'ubicacion_todos_transportes'])->name('mapa_todos_transportes');

Route::post('mapa/vehiculo/', [MapaController::class, 'ubicacion_vehiculo'])->name('mapa_vehiculo');

//RUTAS DE MAPA DE EQUIPOS

Route::get('/mapa/cargas/{equipos}', [MapaController::class, 'ubicacion_equipos'])->name('mapa_equipos');

Route::get('/mapa/cargas', [MapaController::class, 'ubicacion_todos_equipos'])->name('mapa_todos_equipos');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

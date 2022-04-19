<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Clientes;
use App\Http\Livewire\Transportistas;
use App\Http\Livewire\Cargas;
use App\Http\Livewire\Vehiculos;
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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    // Route::get('/clientes', Clientes::class)->name('clientes');
    // Route::get('/transportistas', Transportistas::class)->name('transportistas');
    // Route::get('/cargas', Cargas::class)->name('cargas');
    // Route::get('/vehiculos', Vehiculos::class)->name('vehiculos');
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\ClienteController;

Route::get('', [HomeController::class, 'index'])->name('admin');
Route::get('/buscador', [HomeController::class, 'buscador'])->name('buscador');
Route::get('/clientes', [ClienteController::class, 'clientes'])->name('clientes');

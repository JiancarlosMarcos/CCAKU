<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\cliente\RequerimientoClienteController;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\cliente\PerfilController;
use App\Http\Controllers\cliente\MapaClienteController;

Route::get('/lista_requerimientos/{usuario}', [RequerimientoClienteController::class, 'vista_requerimientos'])->name('lista_requerimientos_cliente');
///MOSTRAR////////////
Route::get('/vista_requerimientos_cliente', [RequerimientoClienteController::class, 'mostrar_requerimientos'])->name('requerimientos.mostrar');
//AGREGAR REQUERIMIENTO 
Route::get('/requerimientos/agregar', [RequerimientoClienteController::class, 'form_agregar_requerimiento'])->middleware('can:cliente')->name('requerimiento_simple');

//MAPA REQUERIMIENTOS PROPIOS DE UN CLIENTE//
Route::get('/mapa/requerimientos_propios', [MapaClienteController::class, 'ubicacion_requerimientos_propios'])->name('mapa_requerimientos_propios');

/////////PERFIL///////////
Route::get('/perfil_usuario', [PerfilController::class, 'perfil_usuario'])->name('perfil_usuario');

//REQUERIMIENTO DE TRANSPORTE ESPECIFICO

//REQUERIMIENTO SIMPLE
Route::post('/requerimientos/agregar', [RequerimientoClienteController::class, 'agregar_requerimiento'])->middleware('can:cliente')->name('agregar_requerimiento_cliente');

Route::get('/consulta_cargas_cliente', [RequerimientoClienteController::class, 'consulta_cargas_nuevo']);

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\user\RequerimientoClienteController;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\user\PerfilController;
use App\Http\Controllers\user\MapaClienteController;
use App\Http\Controllers\user\VehiculosTransportistaController;

Route::get('/lista_requerimientos/{usuario}', [RequerimientoClienteController::class, 'vista_requerimientos'])->name('lista_requerimientos_cliente');
///MOSTRAR////////////
Route::get('/vista_requerimientos_cliente', [RequerimientoClienteController::class, 'mostrar_requerimientos'])->name('requerimientos.mostrar');
//AGREGAR REQUERIMIENTO 
// middelware para 2 roles
Route::get('/requerimientos/agregar', [RequerimientoClienteController::class, 'form_agregar_requerimiento'])->name('requerimiento_simple');



//MAPA REQUERIMIENTOS PROPIOS DE UN CLIENTE//
Route::get('/mapa/requerimientos_propios', [MapaClienteController::class, 'ubicacion_requerimientos_propios'])->name('mapa_requerimientos_propios');

/////////PERFIL///////////
// Route::get('/perfil_usuario/{id}', [PerfilController::class, 'perfil_usuario'])->name('perfil_usuario');
Route::get('/perfil_usuario', [PerfilController::class, 'perfil_usuario'])->name('perfil_usuario');
Route::post('/perfil_usuario/editar/', [PerfilController::class, 'editar_perfil'])->name('actualizar_perfil');


//REQUERIMIENTO DE TRANSPORTE ESPECIFICO


//REQUERIMIENTO SIMPLE
Route::post('/requerimientos/agregar', [RequerimientoClienteController::class, 'agregar_requerimiento'])->middleware('can:cliente')->name('agregar_requerimiento_cliente');
//EDITAR REQUERIMIENTO//

Route::get('/requerimientos/editar/{id}', [RequerimientoClienteController::class, 'form_editar_requerimiento'])->name('editar_requerimiento_cliente');
Route::post('/requerimientos/editar/', [RequerimientoClienteController::class, 'editar_requerimiento'])->name('actualizar_requerimiento_cliente');


Route::get('/consulta_cargas_cliente', [RequerimientoClienteController::class, 'consulta_cargas_nuevo']);


///PROVINCIAS////
Route::get('/provincias', [RequerimientoClienteController::class, 'provincias'])->name('provincias');
///DISTRITOS////
Route::get('/distritos', [RequerimientoClienteController::class, 'distritos'])->name('distritos');


//TRANSPORTISTA
//PERFIL DE USUARIO
Route::get('/perfil_usuario_transportista', [PerfilController::class, 'perfil_usuario_transportista'])->name('perfil_usuario_transportista');
Route::post('/perfil_usuario_transportista/editar/', [PerfilController::class, 'editar_perfil_transportista'])->name('actualizar_perfil_transportista');
//VER TRANSPORTES
Route::get('/lista_transportes/{usuario}', [VehiculosTransportistaController::class, 'vista_vehiculos'])->name('lista_vehiculos_transportista');
Route::get('/vista_transportes', [VehiculosTransportistaController::class, 'mostrar_vehiculos'])->name('vehiculos.mostrar');

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\user\ClienteRequerimientoController;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\user\PerfilController;
use App\Http\Controllers\user\MapaClienteController;
use App\Http\Controllers\user\TransportistaVehiculosController;
use App\Http\Controllers\user\ClienteCargasController;
use App\Http\Controllers\user\ClienteContactoController;
use App\Http\Controllers\user\TransportistaContactoController;
use App\Http\Controllers\user\TransportistaRequerimientoController;
use App\Http\Controllers\user\TransportistaMapaController;

Route::get('/lista_requerimientos/{usuario}', [ClienteRequerimientoController::class, 'vista_requerimientos'])->name('lista_requerimientos_cliente');
///MOSTRAR////////////
Route::get('/vista_requerimientos_cliente', [ClienteRequerimientoController::class, 'mostrar_requerimientos'])->name('requerimientos.mostrar');
//AGREGAR REQUERIMIENTO 
// middelware para 2 roles
Route::get('/requerimientos/agregar', [ClienteRequerimientoController::class, 'form_agregar_requerimiento'])->name('requerimiento_simple');



//MAPA REQUERIMIENTOS PROPIOS DE UN CLIENTE//
Route::get('/mapa/requerimientos_propios', [MapaClienteController::class, 'ubicacion_requerimientos_propios'])->name('mapa_requerimientos_propios');

/////////PERFIL///////////
// Route::get('/perfil_usuario/{id}', [PerfilController::class, 'perfil_usuario'])->name('perfil_usuario');
Route::get('/perfil_usuario', [PerfilController::class, 'perfil_usuario'])->name('perfil_usuario');
Route::post('/perfil_usuario/editar/', [PerfilController::class, 'editar_perfil'])->name('actualizar_perfil');


//REQUERIMIENTO DE TRANSPORTE ESPECIFICO


//REQUERIMIENTO SIMPLE
Route::post('/requerimientos/agregar', [ClienteRequerimientoController::class, 'agregar_requerimiento'])->middleware('can:cliente')->name('agregar_requerimiento_cliente');
//EDITAR REQUERIMIENTO//

Route::get('/requerimientos/editar/{id}', [ClienteRequerimientoController::class, 'form_editar_requerimiento'])->name('editar_requerimiento_cliente');
Route::post('/requerimientos/editar/', [ClienteRequerimientoController::class, 'editar_requerimiento'])->name('actualizar_requerimiento_cliente');
//VER CARGAS
Route::get('/lista_cargas/{usuario}', [ClienteCargasController::class, 'vista_cargas'])->name('lista_cargas_cliente');
Route::get('/vista_cargas', [ClienteCargasController::class, 'mostrar_cargas'])->name('cargas.mostrar');
//EDITAR DATOS DE CLIENTE
//EDITAR CLIENTE
Route::get('/clientes/editar/{id}', [ClienteCargasController::class, 'form_editar_cliente'])->name('cliente.editar_cliente');
Route::post('/clientes/editar/', [ClienteCargasController::class, 'editar_cliente'])->name('cliente.actualizar_cliente');
//ELIMINAR CARGA
Route::get('/cargas/eliminar/{id}', [ClienteCargasController::class, 'eliminar_carga'])->name('cliente.eliminar_carga');
//CONTACTOS CLIENTES
Route::get('/lista_clientes_contactos/{usuario}', [ClienteContactoController::class, 'vista_clientes_contactos'])->name('cliente.lista_clientes_contactos');
//MOSTRAR CONTACTOS//////////
Route::get('/clientes/contactos', [ClienteContactoController::class, 'mostrar_clientes_contactos'])->name('cliente.contactos.mostrar');



Route::get('/consulta_cargas_cliente', [ClienteRequerimientoController::class, 'consulta_cargas_nuevo']);


///PROVINCIAS////
Route::get('/provincias', [ClienteRequerimientoController::class, 'provincias'])->name('provincias');
///DISTRITOS////
Route::get('/distritos', [ClienteRequerimientoController::class, 'distritos'])->name('distritos');


//TRANSPORTISTA
//PERFIL DE USUARIO
Route::get('/perfil_usuario_transportista', [PerfilController::class, 'perfil_usuario_transportista'])->name('perfil_usuario_transportista');
Route::post('/perfil_usuario_transportista/editar/', [PerfilController::class, 'editar_perfil_transportista'])->name('actualizar_perfil_transportista');
//VER TRANSPORTES
Route::get('/lista_transportes/{usuario}', [TransportistaVehiculosController::class, 'vista_vehiculos'])->name('lista_vehiculos_transportista');
Route::get('/vista_transportes', [TransportistaVehiculosController::class, 'mostrar_vehiculos'])->name('transportista.vehiculos');
//EDITAR TRANSPORTISTA
Route::get('/transportistas/editar/{id}', [TransportistaVehiculosController::class, 'form_editar_transportista'])->name('transportista.editar_transportista');
Route::post('/transportistas/editar/', [TransportistaVehiculosController::class, 'editar_transportista'])->name('transportista.actualizar_transportista');
//ELIMINAR VEHICULOS
Route::get('/vehiculos/eliminar/{id}', [TransportistaVehiculosController::class, 'eliminar_vehiculo'])->name('transportista.eliminar_vehiculo');
//CONTACTOS TRANSPORTISTAS
Route::get('/lista_transportistas_contactos/{usuario}', [TransportistaContactoController::class, 'vista_transportistas_contactos'])->name('transportista.lista_transportistas_contactos');
//MOSTRAR CONTACTOS//////////
Route::get('/transportistas/contactos', [TransportistaContactoController::class, 'mostrar_transportistas_contactos'])->name('transportista.contactos.mostrar');

Route::get('/lista_requerimientos', [TransportistaRequerimientoController::class, 'vista_requerimientos'])->name('transportista.lista_requerimientos_cliente');

Route::get('/transportista_requerimientos', [TransportistaRequerimientoController::class, 'mostrar_requerimientos'])->name('transportista.requerimientos.mostrar');
//VISUALIZAR REQUERIMIENTO
Route::get('/requerimientos/visualizar/{id}', [TransportistaRequerimientoController::class, 'visualizar_requerimiento'])->name('transportista.visualizar_requerimiento');

//MAPA REQUERIMIENTOS PROPIOS DE UN CLIENTE//
Route::get('/mapa/requerimientos', [TransportistaMapaController::class, 'ubicacion_requerimientos'])->name('transportista.mapa_requerimientos');

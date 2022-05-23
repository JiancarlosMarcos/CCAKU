<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\user\RequerimientoClienteController;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\user\PerfilController;
use App\Http\Controllers\user\MapaClienteController;
use App\Http\Controllers\user\VehiculosTransportistaController;
use App\Http\Controllers\user\CargasClienteController;
use App\Http\Controllers\user\ClienteContactoController;
use App\Http\Controllers\user\TransportistaContactoController;

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
//VER CARGAS
Route::get('/lista_cargas/{usuario}', [CargasClienteController::class, 'vista_cargas'])->name('lista_cargas_cliente');
Route::get('/vista_cargas', [CargasClienteController::class, 'mostrar_cargas'])->name('cargas.mostrar');
//EDITAR DATOS DE CLIENTE
//EDITAR CLIENTE
Route::get('/clientes/editar/{id}', [CargasClienteController::class, 'form_editar_cliente'])->name('cliente.editar_cliente');
Route::post('/clientes/editar/', [CargasClienteController::class, 'editar_cliente'])->name('cliente.actualizar_cliente');
//ELIMINAR CARGA
Route::get('/cargas/eliminar/{id}', [CargasClienteController::class, 'eliminar_carga'])->name('cliente.eliminar_carga');
//CONTACTOS CLIENTES
Route::get('/lista_clientes_contactos/{usuario}', [ClienteContactoController::class, 'vista_clientes_contactos'])->name('cliente.lista_clientes_contactos');
//MOSTRAR CONTACTOS//////////
Route::get('/clientes/contactos', [ClienteContactoController::class, 'mostrar_clientes_contactos'])->name('cliente.contactos.mostrar');



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
Route::get('/vista_transportes', [VehiculosTransportistaController::class, 'mostrar_vehiculos'])->name('transportista.vehiculos');
//EDITAR TRANSPORTISTA
Route::get('/transportistas/editar/{id}', [VehiculosTransportistaController::class, 'form_editar_transportista'])->name('transportista.editar_transportista');
Route::post('/transportistas/editar/', [VehiculosTransportistaController::class, 'editar_transportista'])->name('transportista.actualizar_transportista');
//ELIMINAR VEHICULOS
Route::get('/vehiculos/eliminar/{id}', [VehiculosTransportistaController::class, 'eliminar_vehiculo'])->name('transportista.eliminar_vehiculo');
//CONTACTOS TRANSPORTISTAS
Route::get('/lista_transportistas_contactos/{usuario}', [TransportistaContactoController::class, 'vista_transportistas_contactos'])->name('transportista.lista_transportistas_contactos');
//MOSTRAR CONTACTOS//////////
Route::get('/transportistas/contactos', [TransportistaContactoController::class, 'mostrar_transportistas_contactos'])->name('transportista.contactos.mostrar');

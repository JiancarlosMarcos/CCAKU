<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\ClienteController;
use App\Http\Controllers\admin\TransportistaController;
use App\Http\Controllers\admin\UsuarioController;
use App\Http\Controllers\admin\ContactoController;
use App\Http\Controllers\admin\CargasController;

Route::get('', [HomeController::class, 'index'])->name('admin');
Route::get('/buscador', [HomeController::class, 'buscador'])->name('buscador');


//MOSTRAR CLIENTES
Route::get('/clientes', [ClienteController::class, 'clientes'])->name('clientes');
Route::get('/lista_clientes', [ClienteController::class, 'vista_clientes'])->name('lista_clientes');
//AGREGAR CLIENTE
Route::get('/clientes/agregar', [ClienteController::class, 'form_agregar_cliente'])->name('clientes.formulario.agregar');
Route::post('/clientes/agregar', [ClienteController::class, 'agregar_cliente'])->name('agregar_cliente');
//EDITAR CLIENTE
Route::get('/clientes/editar/{id}', [ClienteController::class, 'form_editar_cliente'])->name('editar_cliente');
Route::post('/clientes/editar/', [ClienteController::class, 'editar_cliente'])->name('actualizar_cliente');
//ELIMINAR CLIENTE
Route::get('/clientes/eliminar/{id}', [ClienteController::class, 'eliminar_cliente'])->name('eliminar_cliente');

//MOSTRAR TRANSPORTISTAS
Route::get('/transportistas', [TransportistaController::class, 'transportistas'])->name('transportistas');
Route::get('/lista_transportistas', [TransportistaController::class, 'vista_transportistas'])->name('lista_transportistas');
//AGREGAR TRANSPORTISTA
Route::get('/transportistas/agregar', [TransportistaController::class, 'form_agregar_transportista'])->name('transportistas.formulario.agregar');
Route::post('/transportistas/agregar', [TransportistaController::class, 'agregar_transportista'])->name('agregar_transportista');
//EDITAR TRANSPORTISTA
Route::get('/transportistas/editar/{id}', [TransportistaController::class, 'form_editar_transportista'])->name('editar_transportista');
Route::post('/transportistas/editar/', [TransportistaController::class, 'editar_transportista'])->name('actualizar_transportista');
//ELIMINAR TRANSPORTISTA
Route::get('/transportistas/eliminar/{id}', [TransportistaController::class, 'eliminar_transportista'])->name('eliminar_transportista');

//MOSTRAR USUARIOS
Route::get('/usuarios', [UsuarioController::class, 'usuarios'])->name('usuarios');
Route::get('/lista_usuarios', [UsuarioController::class, 'vista_usuarios'])->name('lista_usuarios');
//EDITAR USUARIO
Route::get('/usuarios/editar/{id}', [UsuarioController::class, 'form_editar_usuario'])->name('editar_usuario');
Route::post('/usuarios/editar/', [UsuarioController::class, 'editar_usuario'])->name('actualizar_usuario');
//ELIMINAR USUARIO
Route::get('/usuarios/eliminar/{id}', [UsuarioController::class, 'eliminar_usuario'])->name('eliminar_usuario');

//CONTACTOS CLIENTES
Route::get('/lista_clientes_contactos', [ContactoController::class, 'vista_clientes_contactos'])->name('lista_clientes_contactos');
//MOSTRAR CONTACTOS//////////
Route::get('/clientes/contactos', [ContactoController::class, 'mostrar_clientes_contactos'])->name('clientes.contactos.mostrar');
//AGREGAR CONTACTO NO HAY PORQUE ESO SE AGREGA EN CLIENTES O PROVEEDORES
//EDITAR CONTACTOS
Route::post('/clientes/contactos/actualizar', [ContactoController::class, 'actualizar_contactos_cliente'])->name('actualizar_contacto_cliente');
//ELIMINAR CONTACTOS
Route::get('/clientes/contactos/eliminar/{id}', [ContactoController::class, 'eliminar_contacto_cliente'])->name('eliminar_contacto_cliente');

//CONTACTOS TRANSPORTISTAS
Route::get('/lista_transportistas_contactos', [ContactoController::class, 'vista_transportistas_contactos'])->name('lista_transportistas_contactos');
//MOSTRAR CONTACTOS//////////
Route::get('/transportistas/contactos', [ContactoController::class, 'mostrar_transportistas_contactos'])->name('transportistas.contactos.mostrar');
//AGREGAR CONTACTO NO HAY PORQUE ESO SE AGREGA EN CLIENTES O PROVEEDORES
//EDITAR CONTACTOS
Route::post('/transportistas/contactos/actualizar', [ContactoController::class, 'actualizar_contactos_transportista'])->name('actualizar_contacto_transportista');
//ELIMINAR CONTACTOS
Route::get('/transportistas/contactos/eliminar/{id}', [ContactoController::class, 'eliminar_contacto_transportista'])->name('eliminar_contacto_transportista');


//MOSTRAR CARGAS
Route::get('/cargas', [CargasController::class, 'cargas'])->name('cargas');
Route::get('/lista_cargas', [CargasController::class, 'vista_cargas'])->name('lista_cargas');

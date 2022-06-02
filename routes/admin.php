<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\ClienteController;
use App\Http\Controllers\admin\TransportistaController;
use App\Http\Controllers\admin\UsuarioController;
use App\Http\Controllers\admin\ContactoController;
use App\Http\Controllers\admin\CargasController;
use App\Http\Controllers\admin\VehiculosController;
use App\Http\Controllers\BuscadorController;
use App\Http\Controllers\admin\MapaAdminController;
use App\Http\Controllers\admin\RequerimientoController;
use App\Http\Controllers\admin\CotizacionController;
use App\Http\Controllers\admin\CrearUsuarioController;
use App\Http\Controllers\admin\ConsultasController;
use App\Http\Controllers\admin\DasboardController;
use App\Http\Controllers\admin\VideosController;
use App\Http\Controllers\admin\RegistrosController;

Route::get('', [HomeController::class, 'index'])->name('admin');
//BUSCADOR
Route::get('/buscador', [BuscadorController::class, 'mostrar_buscador_admin'])->name('buscador.mostrar');

//VIDEOS
Route::get('/videos', [VideosController::class, 'mostrar_videos'])->name('videos');

//REGISTROS
Route::get('/registros', [RegistrosController::class, 'mostrar_registros'])->name('registros');

//RUTAS DE MAPA DE TRANSPORTES
Route::get('/mapa', [MapaAdminController::class, 'ubicacion_todos_admin'])->name('mapa_todos_admin');
// Route::get('/transportes/{transportes}', [MapaAdminController::class, 'ubicacion_transportes_admin'])->name('mapa_transportes_admin');
Route::get('/mapa/transportes', [MapaAdminController::class, 'ubicacion_todos_transportes_admin'])->name('mapa_todos_transportes_admin');
Route::get('/mapa/requerimientos', [MapaAdminController::class, 'ubicacion_requerimientos_admin'])->name('mapa_requerimientos_admin');
// Route::post('mapa/vehiculo/', [MapaAdminController::class, 'ubicacion_vehiculo_admin'])->name('mapa_vehiculo_admin');

//RUTAS DE MAPA DE EQUIPOS
// Route::get('/mapa/cargas/{equipos}', [MapaAdminController::class, 'ubicacion_equipos_admin'])->name('mapa_equipos_admin');
// Route::get('/mapa/cargas', [MapaAdminController::class, 'ubicacion_todos_equipos_admin'])->name('mapa_todos_equipos_admin');



//MOSTRAR CLIENTES
Route::get('/clientes', [ClienteController::class, 'clientes'])->middleware('can:administrador')->name('clientes');
Route::get('/lista_clientes', [ClienteController::class, 'vista_clientes'])->middleware('can:administrador')->name('lista_clientes');
//AGREGAR CLIENTE
Route::get('/clientes/agregar', [ClienteController::class, 'form_agregar_cliente'])->middleware('can:administrador')->name('clientes.formulario.agregar');
Route::post('/clientes/agregar', [ClienteController::class, 'agregar_cliente'])->middleware('can:administrador')->name('agregar_cliente');
//EDITAR CLIENTE
Route::get('/clientes/editar/{id}', [ClienteController::class, 'form_editar_cliente'])->middleware('can:administrador')->name('editar_cliente');
Route::post('/clientes/editar/', [ClienteController::class, 'editar_cliente'])->middleware('can:administrador')->name('actualizar_cliente');
//ELIMINAR CLIENTE
Route::get('/clientes/eliminar/{id}', [ClienteController::class, 'eliminar_cliente'])->middleware('can:administrador')->name('eliminar_cliente');

//MOSTRAR TRANSPORTISTAS
Route::get('/transportistas', [TransportistaController::class, 'transportistas'])->name('transportistas');
Route::get('/lista_transportistas', [TransportistaController::class, 'vista_transportistas'])->name('lista_transportistas');
//AGREGAR TRANSPORTISTA
Route::get('/transportistas/agregar', [TransportistaController::class, 'form_agregar_transportista'])->name('transportistas.formulario.agregar');
Route::post('/transportistas/agregar', [TransportistaController::class, 'agregar_transportista'])->name('agregar_transportista');
//EDITAR TRANSPORTISTA
Route::get('/transportistas/editar/{id}', [TransportistaController::class, 'form_editar_transportista'])->name('editar_transportista');
Route::post('/transportistas/actualizar/', [TransportistaController::class, 'editar_transportista'])->name('actualizar_transportista');
//ELIMINAR TRANSPORTISTA
Route::get('/transportistas/eliminar/{id}', [TransportistaController::class, 'eliminar_transportista'])->name('eliminar_transportista');

Route::get('/consulta_transportistas', [TransportistaController::class, 'consulta_transportistas'])->name('consulta_transportistas');
Route::get('/consulta_transporte', [TransportistaController::class, 'consulta_transporte'])->name('consulta_transporte');

Route::get('/consulta_clientes', [ClienteController::class, 'consulta_clientes'])->name('consulta_clientes');


//MOSTRAR USUARIOS
Route::get('/usuarios', [UsuarioController::class, 'usuarios'])->name('usuarios');
Route::get('/lista_usuarios', [UsuarioController::class, 'vista_usuarios'])->name('lista_usuarios');
//AGREGAR USUARIO
Route::get('/usuarios/agregar_transportista', [UsuarioController::class, 'form_agregar_usuario_transportista'])->name('usuarios.formulario.agregar.transportista');
Route::get('/usuarios/agregar_administrador', [UsuarioController::class, 'form_agregar_usuario_administrador'])->name('usuarios.formulario.agregar.administrador');

//CREAR USUARIO
Route::post('/crear_administrador', [CrearUsuarioController::class, 'create_administrador'])->name('crear_administrador');
Route::post('/crear_transportista', [CrearUsuarioController::class, 'create_transportista'])->name('crear_transportista');

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
Route::get('/cargas', [CargasController::class, 'cargas'])->middleware('can:administrador')->name('cargas');
Route::get('/lista_cargas', [CargasController::class, 'vista_cargas'])->middleware('can:administrador')->name('lista_cargas');
//ELIMINAR CARGA
Route::get('/cargas/eliminar/{id}', [CargasController::class, 'eliminar_carga'])->middleware('can:administrador')->name('eliminar_carga');


//MOSTRAR VEHICULOS
Route::get('/vehiculos', [VehiculosController::class, 'vehiculos'])->name('vehiculos');
Route::get('/lista_vehiculos', [VehiculosController::class, 'vista_vehiculos'])->name('lista_vehiculos');
//ELIMINAR VEHICULOS
Route::get('/vehiculos/eliminar/{id}', [VehiculosController::class, 'eliminar_vehiculo'])->middleware('can:administrador')->name('eliminar_vehiculo');

//DESCARGAR IMAGENES DE TRANSPORTE - VEHICULOS
Route::get('/vehiculos/descargar/imagen/{nombre_imagen}', [TransportistaController::class, 'descargar_imagenes'])->middleware('can:administrador')->name('descargar_vehiculo_imagen');

//REQUERIMIENTOS
Route::get('/lista_requerimientos', [RequerimientoController::class, 'vista_requerimientos'])->name('lista_requerimientos');
//MOSTRAR//
Route::get('/requerimientos', [RequerimientoController::class, 'mostrar_requerimientos'])->name('requerimientos.mostrar');
//AGREGAR//
Route::get('/requerimientos/agregar', [RequerimientoController::class, 'form_agregar_requerimiento'])->name('requerimientos.formulario.agregar');
Route::post('/requerimientos/agregar', [RequerimientoController::class, 'agregar_requerimiento'])->name('agregar_requerimiento');
//EDITAR//
Route::get('/requerimientos/editar/{id}', [RequerimientoController::class, 'form_editar_requerimiento'])->name('editar_requerimiento');
Route::post('/requerimientos/editar/', [RequerimientoController::class, 'editar_requerimiento'])->name('actualizar_requerimiento');
//ELIMINAR//
Route::get('/requerimientos/eliminar/{id}', [RequerimientoController::class, 'eliminar_requerimiento'])->name('eliminar_requerimiento');


//COTIZACIONES
Route::get('/lista_cotizaciones', [CotizacionController::class, 'vista_cotizaciones'])->name('lista_cotizaciones');
Route::get('/lista_historial_cotizaciones', [CotizacionController::class, 'vista_historial_cotizaciones'])->name('lista_historial_cotizaciones');

///MOSTRAR////////////
Route::get('/cotizaciones', [CotizacionController::class, 'mostrar_cotizaciones'])->name('cotizaciones.mostrar');
//AGREGAR
Route::get('/cotizaciones/agregar/{id_requerimiento}', [CotizacionController::class, 'form_agregar_cotizacion'])->name('cotizaciones.formulario.agregar');
Route::post('/cotizaciones/agregar', [CotizacionController::class, 'agregar_cotizacion'])->name('agregar_cotizacion');
//EDITAR//
Route::get('/cotizaciones/editar/{id_cotizacion}', [CotizacionController::class, 'form_editar_cotizacion'])->name('editar_cotizacion');
Route::post('/cotizaciones/editar/', [CotizacionController::class, 'editar_cotizacion'])->name('actualizar_cotizacion');
//ELIMINAR//
Route::get('/cotizaciones/eliminar/{id}', [CotizacionController::class, 'eliminar_cotizacion'])->name('eliminar_cotizacion');
//DESCARGA DE COTIZACIONES X ID
Route::get('/cotizaciones/clientes/descargar/{id}/{version}', [CotizacionController::class, 'descarga_cotizacion_cliente_PDF'])->name('cotizacion.cliente.descargar');



//CONSULTA DE CONTACTOS DE CLIENTES
Route::get('/consulta_contactos', [RequerimientoController::class, 'consulta_clientes_contactos_nuevo']);
Route::get('/consulta_contactos_transportistas', [UsuarioController::class, 'consulta_contactos_transportistas']);
Route::get('/consulta_cargas', [RequerimientoController::class, 'consulta_cargas_nuevo']);
Route::get('/consulta_carga', [RequerimientoController::class, 'consulta_carga_existente']);

// Route::get('/mapa', [VehiculosController::class, 'ubicaciones_vehiculos'])->name('ubicaciones_vehiculos');


///PROVINCIAS////
Route::get('/provincias', [RequerimientoController::class, 'provincias'])->name('provincias');
Route::get('/consultar_provincias', [RequerimientoController::class, 'consultar_provincias'])->name('consultar_provincias');
///DISTRITOS////
Route::get('/distritos', [RequerimientoController::class, 'distritos'])->name('distritos');

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClienteController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/usuarios', [UserController::class, 'ObtenerUsuarios']);
Route::get('/clientes', [ClienteController::class, 'Obtenerclientes']);
Route::get('/ubicaciones', [ClienteController::class, 'Obtenerubicaciones']);
Route::get('/transportistas', [ClienteController::class, 'Obtenertransportistas']);

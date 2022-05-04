<?php

namespace App\Http\Controllers\cliente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Carga;
use App\Models\Ubicacion;

class RequerimientoClienteController extends Controller
{
    public function form_agregar_requerimiento()
    {

        $clientes = Cliente::all();
        $cargas = Carga::all();
        $departamentos = Ubicacion::all();

        return view('cliente.form_requerimiento', compact('clientes', 'cargas', 'departamentos'));
    }
}

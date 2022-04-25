<?php

namespace App\Http\Controllers;

use App\Models\Ubicacion;
use App\Models\VistaVehiculo;
use Illuminate\Http\Request;

class BuscadorController extends Controller
{
    public function mostrar_buscador_admin()
    {
        $equipos = VistaVehiculo::all();
        $departamentos = Ubicacion::all();

        return view('admin.buscador', compact('equipos', 'departamentos'));
    }
    public function mostrar_buscador()
    {
        $equipos = VistaVehiculo::all();
        $departamentos = Ubicacion::all();

        return view('buscador', compact('equipos', 'departamentos'));
    }
}

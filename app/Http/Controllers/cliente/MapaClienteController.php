<?php

namespace App\Http\Controllers\cliente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VistaRequerimientoMapa;

class MapaClienteController extends Controller
{
    public function ubicacion_requerimientos_propios(Request $request)
    {
        $requerimientos = VistaRequerimientoMapa::all();
        return view('cliente.mapa_requerimientos', compact('requerimientos'));
    }
}

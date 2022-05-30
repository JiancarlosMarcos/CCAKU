<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RequerimientoCarga;
use App\Models\VistaRequerimientoMapa;

class TransportistaMapaController extends Controller
{
    public function ubicacion_requerimientos(Request $request)
    {

        $requerimiento_cargas = RequerimientoCarga::all();
        $requerimientos = VistaRequerimientoMapa::all();
        return view('transportista.mapa_requerimientos', compact('requerimientos', 'requerimiento_cargas'));
    }
}

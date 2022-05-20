<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VistaRequerimientoMapa;
use App\Models\ContactoCliente;
use App\Models\RequerimientoCarga;

class MapaClienteController extends Controller
{
    public function ubicacion_requerimientos_propios(Request $request)
    {
        $contactos = ContactoCliente::all();
        $requerimiento_cargas = RequerimientoCarga::all();
        $requerimientos = VistaRequerimientoMapa::all();
        return view('cliente.mapa_requerimientos', compact('requerimientos', 'contactos', 'requerimiento_cargas'));
    }
}

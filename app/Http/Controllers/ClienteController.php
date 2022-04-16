<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Ubicacion;
use App\Models\Transportista;
use App\Models\VehiculoTransportista;

class ClienteController extends Controller
{
    public function Obtenerclientes()
    {
        $clientes = Cliente::all();
        return response()->json($clientes, 200);
    }
    public function ObtenerUbicaciones()
    {
        $ubicaciones = Ubicacion::all();
        return response()->json($ubicaciones, 200);
    }
    public function ObtenerTransportistas()
    {
        $transportistas = Transportista::all();
        return response()->json($transportistas, 200);
    }
    public function ObtenerVehiculosTransportista()
    {
        $vehiculosTransportista = VehiculoTransportista::all();
        return response()->json($vehiculosTransportista, 200);
    }
}

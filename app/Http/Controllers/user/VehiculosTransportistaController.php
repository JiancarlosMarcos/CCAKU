<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\ContactoTransportista;
use App\Models\Transportista;
use App\Models\Vehiculo;
use App\Models\VistaVehiculo;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class VehiculosTransportistaController extends Controller
{
    public function mostrar_vehiculos()
    {
        $transportistas = Transportista::all();
        $transportes = Vehiculo::all();

        return view('transportista.vista_transportes', compact('transportistas', 'transportes'));
    }

    public function vista_vehiculos(Request $request)
    {
        $contacto = ContactoTransportista::where('id_users', $request->usuario)->first();
        $transportista = Transportista::where('id', $contacto->id_transportista)->first();
        return DataTables::of(VistaVehiculo::all()->where('id_transportista', $transportista->id))
            // ->editColumn('fecha', function (VistaRequerimiento $prueba) {
            //     return $prueba->fecha->format('d/m/Y');
            // })
            ->addColumn('btn_requerimientos_cliente', 'cliente.btn_requerimientos_cliente')
            ->rawColumns(['btn_requerimientos_cliente'])
            ->toJson();
    }
}

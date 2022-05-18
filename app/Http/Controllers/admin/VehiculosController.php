<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Vehiculo;
use App\Models\VistaVehiculo;
use App\Models\VistaCarga;

class VehiculosController extends Controller
{
    public function vehiculos()
    {

        return view('admin.vehiculos.vehiculos');
    }
    public function ubicaciones_vehiculos()
    {
        $ubicacion = VistaVehiculo::select(
            'empresa',
            'tipo',
            'longitud',
            'latitud',
        )->get();
        $ubicacion_c = VistaCarga::select(
            'empresa',
            'tipo',
            'longitud',
            'latitud',
        )->get();
        return view('admin.mapa', ['ubicacion' => $ubicacion, 'ubicacion_c' => $ubicacion_c]);
    }

    public function vista_vehiculos(Request $request)
    {

        return DataTables::of(
            VistaVehiculo::all()
            // select(
            //     'id',
            //     'id_transportista',
            //     'empresa',
            //     'tipo',
            //     'marca',
            //     'placa',
            //     'volumen',
            //     'largo',
            //     'ancho',
            //     'altura',
            //     'capacidad',
            //     'estado',
            //     'departamento',
            //     'modelo',
            //     'anio',
            //     'responsable_registro',
            //     'guia_remision',
            // )
        )
            // ->editColumn('created_at', function (Cliente $prueba) {
            //     return $prueba->created_at->format('d/m/Y');
            // })
            ->addColumn('btn_transportes', 'admin.botones.btn_transportes')
            ->rawColumns(['btn_transportes'])
            ->toJson();
    }

    public function eliminar_vehiculo($id)
    {
        $vehiculo = Vehiculo::findOrFail($id);
        $tipo_vehiculo = $vehiculo->tipo;
        $vehiculo->delete();
        $mensaje = $tipo_vehiculo . ' eliminado correctamente!';
        $tipo = 'success';

        $notification = array(
            'mensaje' => $mensaje,
            'tipo' => $tipo
        );
        return Redirect()->back()->with($notification);
    }
}

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

        return DataTables::of(VistaVehiculo::select(
            'id',
            'tipo',
            'marca',
            'placa',
            'volumen',
            'largo',
            'ancho',
            'altura',
            'capacidad',
            'estado',
            'empresa',
            'departamento',
            'modelo',
            'anio',
            'cantidad_ejes',
            'guia_remision',
        ))
            // ->editColumn('created_at', function (Cliente $prueba) {
            //     return $prueba->created_at->format('d/m/Y');
            // })
            ->addColumn('btn_transportistas', 'admin.botones.btn_transportistas')
            ->rawColumns(['btn_transportistas'])
            ->toJson();
    }
    public function form_agregar_vehiculo()
    {
        return view('admin.vehiculos.agregar_vehiculo');
    }

    public function agregar_vehiculo(Request $request)
    {
        $request->validate(
            [],
            []
        );
        $dni_ruc = $request->dni_ruc;

        if (strlen($dni_ruc) == '11') {
            $tipo_empresa = '1';
        } else {
            $tipo_empresa = '2';
        }

        $empresa = new Vehiculo;
        $empresa->dni_ruc = $request->dni_ruc;
        $empresa->nombre = $request->razon_social;
        $empresa->direccion = $request->direccion;
        $empresa->pagina_web = $request->pagina_web;
        // $empresa->id_clasificacion = $request->id_clasificacion;
        // $empresa->id_via_ingreso = $request->id_via_ingreso;
        // $empresa->id_indicador = $request->id_indicador;
        // $empresa->responsable_registro = $request->usuario;
        $empresa->tipo_transportista = $tipo_empresa;
        $empresa->save();
        $nombre_empresa = $request->razon_social;

        // $id = $empresa->id;
        // $contador = $request->contador;
        // $usuario = $request->usuario;

        // for ($i = 0; $i < $contador; $i++) {
        //     $contacto = new ContactoTransportista;
        //     $contacto->nombre = $request->nombre_contacto[$i];
        //     $contacto->celular = $request->celular[$i];
        //     $contacto->cargo = $request->cargo[$i];
        //     $contacto->correo = $request->correo[$i];
        //     $contacto->id_transportista = $id;
        //     $contacto->dni = $request->dni[$i];
        //     // $contacto->responsable_registro = $usuario;
        //     $contacto->save();
        // }
        $notification = array(
            'mensaje' => 'Transportista ' . $nombre_empresa . ' registrado correctamente!',
            'tipo' => 'success'
        );
        return Redirect()->back()->with($notification);
    }
}

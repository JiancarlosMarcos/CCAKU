<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\ContactoTransportista;
use App\Models\Transportista;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Vista_Transportistas_Contactos;

class TransportistaContactoController extends Controller
{
    public function mostrar_transportistas_contactos()
    {

        $empresas = Transportista::all();
        $contactos = ContactoTransportista::all();
        return view('transportista.vista_contactos', compact('empresas', 'contactos'));
    }



    public function vista_transportistas_contactos(Request $request)
    {
        $contacto = ContactoTransportista::where('id_users', $request->usuario)->first();
        $transportista = Transportista::where('id', $contacto->id_transportista)->first();
        return DataTables::of(vista_transportistas_contactos::all()->where('id_transportista', $transportista->id))
            // ->editColumn('created_at', function (Vista_Clientes_Contactos $prueba) {
            //     return $prueba->created_at->format('d/m/Y');
            // })
            // ->editColumn('updated_at', function (Vista_Clientes_Contactos $prueba) {
            //     return $prueba->updated_at->format('d/m/Y');
            // })
            ->addColumn('btn_editar_vehiculo', 'transportista.btn_editar_vehiculo')
            ->rawColumns(['btn_editar_vehiculo'])
            ->toJson();
    }
}

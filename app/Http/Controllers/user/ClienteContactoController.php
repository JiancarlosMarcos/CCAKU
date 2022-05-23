<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Cliente;
use App\Models\ContactoCliente;
use App\Models\Vista_Clientes_Contactos;

class ClienteContactoController extends Controller
{

    public function mostrar_clientes_contactos()
    {

        $empresas = Cliente::all();
        $contactos = ContactoCliente::all();
        return view('cliente.vista_contactos', compact('empresas', 'contactos'));
    }



    public function vista_clientes_contactos(Request $request)
    {
        $contacto = ContactoCliente::where('id_users', $request->usuario)->first();
        $cliente = Cliente::where('id', $contacto->id_cliente)->first();
        return DataTables::of(Vista_Clientes_Contactos::all()->where('id_cliente', $cliente->id))
            // ->editColumn('created_at', function (Vista_Clientes_Contactos $prueba) {
            //     return $prueba->created_at->format('d/m/Y');
            // })
            // ->editColumn('updated_at', function (Vista_Clientes_Contactos $prueba) {
            //     return $prueba->updated_at->format('d/m/Y');
            // })
            ->addColumn('btn_editar_carga', 'cliente.btn_editar_carga')
            ->rawColumns(['btn_editar_carga'])
            ->toJson();
    }
}

<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vista_Clientes_Contactos;
use App\Models\Vista_Transportistas_Contactos;
use App\Models\Cliente;
use App\Models\Transportista;
use Yajra\DataTables\DataTables;
use App\Models\ContactoCliente;
use App\Models\ContactoTransportista;
use App\Models\Requerimiento;

class ContactoController extends Controller
{
    public function mostrar_clientes_contactos()
    {
        // $contactos = ContactoCliente::latest()->with('nombre_empresa')->get();
        $empresas = Cliente::latest()->get();
        return view('admin.contactos.contacto_cliente', compact('empresas'));
    }

    public function mostrar_transportistas_contactos()
    {
        //$contactos = Contacto::latest()->with('nombre_empresa')->get();
        $empresas = Transportista::latest()->get();

        return view('admin.contactos.contacto_transportista', compact('empresas'));
    }

    public function vista_clientes_contactos(Request $request)
    {

        return DataTables::of(Vista_Clientes_Contactos::all())
            ->editColumn('created_at', function (Vista_Clientes_Contactos $prueba) {
                return $prueba->created_at->format('d/m/Y');
            })->editColumn('responsable_registro', function (Vista_Clientes_Contactos $prueba) {
                if ($prueba->responsable_registro == null) {
                    return "Registro Propio";
                } else {
                    return $prueba->responsable_registro;
                }
            })
            ->addColumn('btn_clientes_contactos', 'admin.botones.btn_clientes_contactos')
            ->rawColumns(['btn_clientes_contactos'])
            ->toJson();
    }

    public function vista_transportistas_contactos(Request $request)
    {

        return DataTables::of(Vista_Transportistas_Contactos::all())
            ->editColumn('created_at', function (Vista_Transportistas_Contactos $prueba) {
                return $prueba->created_at->format('d/m/Y');
            })
            ->addColumn('btn_transportistas_contactos', 'admin.botones.btn_transportistas_contactos')
            ->rawColumns(['btn_transportistas_contactos'])
            ->toJson();
    }


    public function actualizar_contactos_cliente(Request $request)
    {
        $request->validate(
            [],
            []
        );
        $id_contacto = $request->id_contacto;
        $contacto = ContactoCliente::findOrFail($id_contacto);
        $contacto->dni = $request->dni_contacto_editar;
        $contacto->nombre = $request->nombre_contacto_editar;
        $contacto->cargo = $request->cargo_contacto_editar;
        $contacto->celular = $request->celular_contacto_editar;
        $contacto->correo = $request->correo_contacto_editar;
        $empresa = $request->id_empresa;
        if ($empresa == "") {
        } else {
            $contacto->id_cliente = $request->id_empresa;
        }
        $contacto->save();

        $notification = array(
            'mensaje' => 'Contacto ' . $contacto->nombre . ' actualizado correctamente!',
            'tipo' => 'success'
        );
        return Redirect()->back()->with($notification);
    }


    public function eliminar_contacto_cliente($id)
    {
        $contacto = ContactoCliente::findOrFail($id);
        $contacto->nombre;
        $requerimientos_count = Requerimiento::where('id_contacto', $id)->count();
        if ($requerimientos_count > 0) {
            $mensaje = 'No puede eliminar el contacto ' . $contacto->nombre . ', porque tiene ' . $requerimientos_count . ' requerimientos a su nombre';
            $tipo = 'success';
        } else {
            $contacto = ContactoCliente::findOrFail($id);
            $nombre_contacto = $contacto->nombre;
            $contacto->delete();
            $mensaje = 'Contacto ' . $nombre_contacto . ' eliminado correctamente!';
            $tipo = 'success';
        }

        $notification = array(
            'mensaje' => $mensaje,
            'tipo' => $tipo
        );
        return Redirect()->back()->with($notification);
    }
    public function actualizar_contactos_transportista(Request $request)
    {
        $request->validate(
            [],
            []
        );
        $id_contacto = $request->id_contacto;
        $contacto = ContactoTransportista::findOrFail($id_contacto);
        $contacto->dni = $request->dni_contacto_editar;
        $contacto->nombre = $request->nombre_contacto_editar;
        $contacto->cargo = $request->cargo_contacto_editar;
        $contacto->celular = $request->celular_contacto_editar;
        $contacto->correo = $request->correo_contacto_editar;
        $contacto->responsable_actualizacion = $request->usuario;
        $empresa = $request->id_empresa;
        if ($empresa == "") {
        } else {
            $contacto->id_transportista = $request->id_empresa;
        }
        $contacto->save();

        $notification = array(
            'mensaje' => 'Contacto ' . $contacto->nombre . ' actualizado correctamente!',
            'tipo' => 'success'
        );
        return Redirect()->back()->with($notification);
    }


    public function eliminar_contacto_transportista($id)
    {

        $contacto = ContactoTransportista::findOrFail($id);
        $nombre_contacto = $contacto->nombre;
        $contacto->delete();
        $mensaje = 'Contacto ' . $nombre_contacto . ' eliminado correctamente!';
        $tipo = 'success';


        $notification = array(
            'mensaje' => $mensaje,
            'tipo' => $tipo
        );
        return Redirect()->back()->with($notification);
    }
}

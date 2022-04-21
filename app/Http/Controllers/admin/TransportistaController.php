<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ContactoTransportista;
use Illuminate\Http\Request;
use App\Models\Transportista;

use Yajra\DataTables\DataTables;

class TransportistaController extends Controller
{
    public function transportistas()
    {
        return view('admin.transportistas');
    }


    public function vista_transportistas(Request $request)
    {

        return DataTables::of(Transportista::select(
            'id',
            'nombre',
            'dni_ruc',
            'id_tipo',
            'direccion',
            'pagina_web',
            'created_at',

        ))
            // ->editColumn('created_at', function (Transportista $prueba) {
            //     return $prueba->created_at->format('d/m/Y');
            // })
            ->addColumn('btn_transportistas', 'admin.botones.btn_transportistas')
            ->rawColumns(['btn_transportistas'])
            ->toJson();
    }
    public function form_agregar_transportista()
    {
        return view('admin.agregar_transportista');
    }

    public function agregar_transportista(Request $request)
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

        $empresa = new Transportista;
        $empresa->dni_ruc = $request->dni_ruc;
        $empresa->nombre = $request->razon_social;
        $empresa->direccion = $request->direccion;
        $empresa->pagina_web = $request->pagina_web;
        // $empresa->id_clasificacion = $request->id_clasificacion;
        // $empresa->id_via_ingreso = $request->id_via_ingreso;
        // $empresa->id_indicador = $request->id_indicador;
        // $empresa->responsable_registro = $request->usuario;
        $empresa->id_tipo = $tipo_empresa;
        $empresa->save();
        $nombre_empresa = $request->razon_social;

        $id = $empresa->id;
        $contador = $request->contador;
        // $usuario = $request->usuario;

        for ($i = 0; $i < $contador; $i++) {
            $contacto = new ContactoTransportista;
            $contacto->nombre = $request->nombre_contacto[$i];
            $contacto->celular = $request->celular[$i];
            $contacto->cargo = $request->cargo[$i];
            $contacto->correo = $request->correo[$i];
            $contacto->id_transportista = $id;
            $contacto->dni = $request->dni[$i];
            // $contacto->responsable_registro = $usuario;
            $contacto->save();
        }
        $notification = array(
            'mensaje' => 'Transportista ' . $nombre_empresa . ' registrado correctamente!',
            'tipo' => 'success'
        );
        return Redirect()->back()->with($notification);
    }
    public function form_editar_transportista(Request $request)
    {
        $id = $request->id;
        $empresa = Transportista::findOrFail($id);
        $contactos[] = ContactoTransportista::where('id_transportista', $id)->get();

        return view("admin.editar_transportista", [
            "empresa" => $empresa,
            "contactos" => $contactos[0]
        ]);
    }

    public function editar_transportista(Request $request)
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

        $id = $request->id;
        $empresa = Transportista::findOrFail($id);
        $empresa->dni_ruc = $request->dni_ruc;
        $empresa->nombre = $request->razon_social;
        $empresa->direccion = $request->direccion;
        $empresa->pagina_web = $request->pagina_web;
        // $empresa->id_via_ingreso = $request->id_via_ingreso;
        // $empresa->id_indicador = $request->id_indicador;
        // $empresa->responsable_registro = $request->usuario;
        $empresa->id_tipo = $tipo_empresa;
        $empresa->save();

        $contador = $request->contador;
        // $usuario = $request->usuario;

        //Elimina todos los contactos de determinada empresa
        //Contacto::where('id',$id)->delete();

        //Inserta la nueva lista de contactos actualizada
        $ids_eliminar = $request->ids_eliminar;

        $id_eliminar = explode(",", $ids_eliminar);
        $contador_id = count($id_eliminar);

        for ($z = 0; $z < $contador_id; $z++) {
            $eliminar_registros = ContactoTransportista::where('id', $id_eliminar[$z])->delete();
        }






        for ($i = 0; $i < $contador; $i++) {
            if (isset($request->id_contacto[$i])) {
                $contacto = ContactoTransportista::where('id', $request->id_contacto[$i])->first();
                $contacto->nombre = $request->nombre_contacto[$i];
                $contacto->dni = $request->dni[$i];
                $contacto->celular = $request->celular[$i];
                $contacto->cargo = $request->cargo[$i];
                $contacto->correo = $request->correo[$i];
                $contacto->id_transportista = $id;
                // $contacto->responsable_registro = $usuario;
                $contacto->save();
            } else {
                $contacto_nuevo = new ContactoTransportista;
                $contacto_nuevo->nombre = $request->nombre_contacto[$i];
                $contacto_nuevo->dni = $request->dni[$i];
                $contacto_nuevo->celular = $request->celular[$i];
                $contacto_nuevo->cargo = $request->cargo[$i];
                $contacto_nuevo->correo = $request->correo[$i];
                $contacto_nuevo->id_transportista = $id;
                // $contacto_nuevo->responsable_registro = $usuario;
                $contacto_nuevo->save();
            }
        }
        $notification = array(
            'mensaje' => 'Transportista actualizado correctamente!' . $ids_eliminar,
            'tipo' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function eliminar_transportista($id)
    {

        //Cuenta la cantidad de contactos por cada empresa
        $empresa = Transportista::findOrFail($id);
        $empresa = $empresa->nombre;
        $contactos_count = ContactoTransportista::where('id_transportista', $id)->count();


        //Si hay mas de 0 contactos manda mensaje de error  sino elimina el transportista
        if ($contactos_count > 0) {
            $mensaje = 'No puede eliminar la empresa ' . $empresa . ', porque tiene ' . $contactos_count . ' contactos, elimine primero sus contactos';
            $tipo = 'success';
        } else {
            $empresa = Transportista::findOrFail($id);
            $nombre_empresa = $empresa->nombre;
            $empresa->delete();
            $mensaje = 'Transportista ' . $nombre_empresa . ' eliminado correctamente!';
            $tipo = 'success';
        }

        $notification = array(
            'mensaje' => $mensaje,
            'tipo' => $tipo
        );
        return Redirect()->back()->with($notification);
    }
}

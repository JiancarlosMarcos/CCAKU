<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ContactoTransportista;
use Illuminate\Http\Request;
use App\Models\Transportista;
use App\Models\VistaTransportista;
use App\Models\Vehiculo;
use App\Models\Ubicacion;
use Yajra\DataTables\DataTables;

class TransportistaController extends Controller
{
    public function transportistas()
    {
        return view('admin.transportistas.transportistas');
    }


    public function vista_transportistas(Request $request)
    {
        $transportistas = VistaTransportista::all();
        return DataTables::of($transportistas)
            // ->editColumn('created_at', function (Transportista $prueba) {
            //     return $prueba->created_at->format('d/m/Y');
            // })
            ->addColumn('btn_transportistas', 'admin.botones.btn_transportistas')
            ->rawColumns(['btn_transportistas'])
            ->toJson();
    }
    public function form_agregar_transportista()
    {
        $ubicaciones = Ubicacion::all();
        return view('admin.transportistas.agregar_transportista', compact('ubicaciones'));
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
        $empresa->responsable_registro = $request->usuario;
        $empresa->id_tipo = $tipo_empresa;
        $empresa->save();
        $nombre_empresa = $request->razon_social;


        $id = $empresa->id;
        $contador = $request->contador;
        $contador_t = $request->contador_t;
        $usuario = $request->usuario;

        for ($i = 0; $i < $contador; $i++) {
            $contacto = new ContactoTransportista;
            $contacto->nombre = $request->nombre_contacto[$i];
            $contacto->celular = $request->celular[$i];
            $contacto->cargo = $request->cargo[$i];
            $contacto->correo = $request->correo[$i];
            $contacto->id_transportista = $id;
            $contacto->dni = $request->dni[$i];
            $contacto->responsable_registro = $usuario;
            $contacto->save();
        }

        for ($j = 0; $j < $contador_t; $j++) {
            $equipos = new Vehiculo;
            $equipos->tipo = $request->tipo_t[$j];
            $equipos->marca = $request->marca_t[$j];
            $equipos->placa = $request->placa_t[$j];
            $equipos->capacidad = $request->capacidad_t[$j];
            $equipos->estado = $request->estado_t[$j];
            $equipos->id_transportista = $id;
            $equipos->id_ubicacion = $request->id_ubicacion_t[$j];
            $equipos->modelo = $request->modelo_t[$j];
            $equipos->cantidad_ejes = $request->cantidad_ejes_t[$j];
            $equipos->save();
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
        $transportes[] = Vehiculo::where('id_transportista', $id)->get();
        $ubicaciones = Ubicacion::all();
        return view("admin.transportistas.editar_transportista", [
            "empresa" => $empresa,
            "contactos" => $contactos[0],
            "transportes" => $transportes[0],
            "ubicaciones" => $ubicaciones
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
        $empresa->responsable_registro = $request->usuario;
        $empresa->id_tipo = $tipo_empresa;
        $empresa->save();

        $contador = $request->contador;
        $contador_t = $request->contador_t;
        $usuario = $request->usuario;

        //Elimina todos los contactos de determinada empresa
        //Contacto::where('id',$id)->delete();

        //Inserta la nueva lista de contactos actualizada
        $ids_eliminar = $request->ids_eliminar;

        $id_eliminar = explode(",", $ids_eliminar);
        $contador_id = count($id_eliminar);

        for ($z = 0; $z < $contador_id; $z++) {
            ContactoTransportista::where('id', $id_eliminar[$z])->delete();
        }

        $ids_eliminar_t = $request->ids_eliminar_t;

        $id_eliminar_t = explode(",", $ids_eliminar_t);
        $contador_id_t = count($id_eliminar_t);

        for ($m = 0; $m < $contador_id_t; $m++) {
            Vehiculo::where('id', $id_eliminar_t[$m])->delete();
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
                $contacto->responsable_registro = $usuario;
                $contacto->save();
            } else {
                $contacto_nuevo = new ContactoTransportista;
                $contacto_nuevo->nombre = $request->nombre_contacto[$i];
                $contacto_nuevo->dni = $request->dni[$i];
                $contacto_nuevo->celular = $request->celular[$i];
                $contacto_nuevo->cargo = $request->cargo[$i];
                $contacto_nuevo->correo = $request->correo[$i];
                $contacto_nuevo->id_transportista = $id;
                $contacto_nuevo->responsable_registro = $usuario;
                $contacto_nuevo->save();
            }
        }
        for ($j = 0; $j < $contador_t; $j++) {
            if (isset($request->id_transporte[$j])) {
                $equipos = Vehiculo::where('id', $request->id_transporte[$j])->first();
                $equipos->tipo = $request->tipo_t[$j];
                $equipos->marca = $request->marca_t[$j];
                $equipos->placa = $request->placa_t[$j];
                $equipos->capacidad = $request->capacidad_t[$j];
                $equipos->estado = $request->estado_t[$j];
                $equipos->id_transportista = $id;
                $equipos->id_ubicacion = $request->id_ubicacion_t[$j];
                $equipos->modelo = $request->modelo_t[$j];
                $equipos->cantidad_ejes = $request->ejes_t[$j];
                $equipos->save();
            } else {
                $equipos_nuevo = new Vehiculo;
                $equipos_nuevo->tipo = $request->tipo_t[$j];
                $equipos_nuevo->marca = $request->marca_t[$j];
                $equipos_nuevo->placa = $request->placa_t[$j];
                $equipos_nuevo->capacidad = $request->capacidad_t[$j];
                $equipos_nuevo->estado = $request->estado_t[$j];
                $equipos_nuevo->id_transportista = $id;
                $equipos_nuevo->id_ubicacion = $request->id_ubicacion_t[$j];
                $equipos_nuevo->modelo = $request->modelo_t[$j];
                $equipos_nuevo->cantidad_ejes = $request->ejes_t[$j];
                $equipos_nuevo->save();
            }
        }
        $notification = array(
            'mensaje' => 'Transportista actualizado correctamente!',
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
        $transportes_count = Vehiculo::where('id_transportista', $id)->count();

        //Si hay mas de 0 contactos manda mensaje de error  sino elimina el transportista
        if ($contactos_count > 0) {
            $mensaje = 'No puede eliminar la empresa ' . $empresa . ', porque tiene ' . $contactos_count . ' contactos, elimine primero sus contactos';
            $tipo = 'success';
        } else if ($transportes_count > 0) {
            $mensaje = 'No puede eliminar la empresa ' . $empresa . ', porque tiene ' . $transportes_count . ' transportes, elimine primero sus transportes';
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

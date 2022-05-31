<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\ContactoCliente;
use App\Models\VistaCliente;
use Yajra\DataTables\DataTables;
use App\Models\Carga;
use App\Models\Ubicacion;

class ClienteController extends Controller
{
    public function clientes()
    {
        // $clientes = Cliente::all();
        return view('admin.clientes.clientes');
    }


    public function vista_clientes(Request $request)
    {
        $clientes = VistaCliente::all();
        return DataTables::of($clientes)
            // ->editColumn('created_at', function (Cliente $prueba) {
            //     return $prueba->created_at->format('d/m/Y');
            // })
            ->addColumn('btn_clientes', 'admin.botones.btn_clientes')
            ->rawColumns(['btn_clientes'])
            ->toJson();
    }
    public function form_agregar_cliente()
    {
        $ubicaciones = Ubicacion::all();
        return view('admin.clientes.agregar_cliente', compact('ubicaciones'));
    }

    public function agregar_cliente(Request $request)
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

        $empresa = new Cliente;
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
        $contador_c = $request->contador_c;
        $usuario = $request->usuario;
        if ($contador > 0) {
            for ($i = 0; $i < $contador; $i++) {
                $contacto = new ContactoCliente;
                $contacto->nombre = $request->nombre_contacto[$i];
                $contacto->celular = $request->celular[$i];
                $contacto->cargo = $request->cargo[$i];
                $contacto->correo = $request->correo[$i];
                $contacto->id_cliente = $id ?? NULL;
                $contacto->dni = $request->dni[$i];
                $contacto->responsable_registro = $usuario;
                $contacto->save();
            }
        }
        for ($j = 0; $j < $contador_c; $j++) {
            $equipos = new Carga;
            $equipos->tipo = $request->tipo_c[$j];
            $equipos->volumen = $request->volumen_c[$j];
            $equipos->peso = $request->peso_c[$j];
            $equipos->estado = "OPERATIVO";
            $equipos->unidad_medida_peso = "TN";
            $equipos->id_ubicacion = $request->id_ubicacion_c[$j];
            $equipos->id_cliente = $id;
            $equipos->marca = $request->marca_c[$j];
            $equipos->modelo = $request->modelo_c[$j];
            $equipos->responsable_registro = $usuario;
            $equipos->placa = $request->placa_c[$j];
            $equipos->save();
        }
        $notification = array(
            'mensaje' => 'Cliente ' . $nombre_empresa . ' registrado correctamente!',
            'tipo' => 'success'
        );
        return Redirect()->back()->with($notification);
    }


    public function form_editar_cliente(Request $request)
    {
        $id = $request->id;
        $empresa = Cliente::findOrFail($id);
        $contactos[] = ContactoCliente::where('id_cliente', $id)->get();
        $cargas[] = Carga::where('id_cliente', $id)->get();
        $ubicaciones = Ubicacion::all();

        return view("admin.clientes.editar_cliente", [
            "empresa" => $empresa,
            "contactos" => $contactos[0],
            "cargas" => $cargas[0],
            "ubicaciones" => $ubicaciones
        ]);
    }

    public function editar_cliente(Request $request)
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
        $empresa = Cliente::findOrFail($id);
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
        $contador_c = $request->contador_c;
        $usuario = $request->usuario;

        //Elimina todos los contactos de determinada empresa
        //Contacto::where('id',$id)->delete();

        //Inserta la nueva lista de contactos actualizada
        $ids_eliminar = $request->ids_eliminar;

        $id_eliminar = explode(",", $ids_eliminar);
        $contador_id = count($id_eliminar);

        for ($z = 0; $z < $contador_id; $z++) {
            $eliminar_registros = ContactoCliente::where('id', $id_eliminar[$z])->delete();
        }
        $ids_eliminar_c = $request->ids_eliminar_c;

        $id_eliminar_c = explode(",", $ids_eliminar_c);
        $contador_id_c = count($id_eliminar_c);

        for ($m = 0; $m < $contador_id_c; $m++) {
            Carga::where('id', $id_eliminar_c[$m])->delete();
        }





        for ($i = 0; $i < $contador; $i++) {
            if (isset($request->id_contacto[$i])) {
                $contacto = ContactoCliente::where('id', $request->id_contacto[$i])->first();
                $contacto->nombre = $request->nombre_contacto[$i];
                $contacto->dni = $request->dni[$i];
                $contacto->celular = $request->celular[$i];
                $contacto->cargo = $request->cargo[$i];
                $contacto->correo = $request->correo[$i];
                $contacto->id_cliente = $id;
                // $contacto->responsable_registro = $usuario;
                $contacto->save();
            } else {
                $contacto_nuevo = new ContactoCliente;
                $contacto_nuevo->nombre = $request->nombre_contacto[$i];
                $contacto_nuevo->dni = $request->dni[$i];
                $contacto_nuevo->celular = $request->celular[$i];
                $contacto_nuevo->cargo = $request->cargo[$i];
                $contacto_nuevo->correo = $request->correo[$i];
                $contacto_nuevo->id_cliente = $id;
                // $contacto_nuevo->responsable_registro = $usuario;
                $contacto_nuevo->save();
            }
        }
        for ($j = 0; $j < $contador_c; $j++) {
            if (isset($request->id_carga[$j])) {
                $equipos = Carga::where('id', $request->id_carga[$j])->first();
                $equipos->tipo = $request->tipo_c[$j];
                $equipos->volumen = $request->volumen_c[$j];
                $equipos->peso = $request->peso_c[$j];
                $equipos->unidad_medida_peso = "TN";
                $equipos->estado = $request->estado_c[$j];
                $equipos->observaciones = $request->observaciones_c[$j] ?? NULL;
                $equipos->id_ubicacion = $request->id_ubicacion_c[$j];
                $equipos->id_cliente = $id;
                $equipos->marca = $request->marca_c[$j];
                $equipos->modelo = $request->modelo_c[$j];
                $equipos->placa = $request->placa_c[$j];
                $equipos->save();
            } else {
                $equipos_nuevo = new Carga;
                $equipos_nuevo->tipo = $request->tipo_c[$j];
                $equipos_nuevo->volumen = $request->volumen_c[$j];
                $equipos_nuevo->peso = $request->peso_c[$j];
                $equipos_nuevo->estado = "OPERATIVO";
                $equipos_nuevo->unidad_medida_peso = "TN";
                $equipos_nuevo->id_ubicacion = $request->id_ubicacion_c[$j];
                $equipos_nuevo->id_cliente = $id;
                $equipos_nuevo->marca = $request->marca_c[$j];
                $equipos_nuevo->modelo = $request->modelo_c[$j];
                $equipos_nuevo->placa = $request->placa_c[$j];
                $equipos_nuevo->save();
            }
        }


        $notification = array(
            'mensaje' => 'Cliente actualizado correctamente!' . $ids_eliminar,
            'tipo' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function eliminar_cliente($id)
    {

        //Cuenta la cantidad de contactos por cada empresa
        $empresa = Cliente::findOrFail($id);
        $empresa = $empresa->nombre;
        $contactos_count = ContactoCliente::where('id_cliente', $id)->count();
        $cargas_count = Carga::where('id_cliente', $id)->count();

        //Si hay mas de 0 contactos manda mensaje de error  sino elimina el cliente
        if ($contactos_count > 0) {
            $mensaje = 'No puede eliminar la empresa ' . $empresa . ', porque tiene ' . $contactos_count . ' contactos, elimine primero sus contactos';
            $tipo = 'success';
        } else if ($cargas_count > 0) {
            $mensaje = 'No puede eliminar la empresa ' . $empresa . ', porque tiene ' . $cargas_count . ' cargas, elimine primero sus cargas';
            $tipo = 'success';
        } else {
            $empresa = Cliente::findOrFail($id);
            $nombre_empresa = $empresa->nombre;
            $empresa->delete();
            $mensaje = 'Cliente ' . $nombre_empresa . ' eliminado correctamente!';
            $tipo = 'success';
        }

        $notification = array(
            'mensaje' => $mensaje,
            'tipo' => $tipo
        );
        return Redirect()->back()->with($notification);
    }

    public function consulta_clientes(Request $request)
    {
        if ($request->ajax()) {
            $empresas = Cliente::where('dni_ruc', $request->dni_ruc)->first();
            $nombre_empresa = $empresas->nombre;
            $dni_ruc_empresa = $empresas->dni_ruc;

            return response()->json([
                'nombre_empresa' => $nombre_empresa,
                'dni_ruc_empresa' => $dni_ruc_empresa

            ]);
        }
    }
}

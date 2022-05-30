<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Carga;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\VistaCarga;
use App\Models\ContactoCliente;
use App\Models\RequerimientoCarga;
use App\Models\Ubicacion;


class ClienteCargasController extends Controller
{
    public function mostrar_cargas()
    {
        $clientes = Cliente::all();
        $contactos = ContactoCliente::all();
        return view('cliente.vista_cargas', compact('clientes', 'contactos'));
    }


    public function vista_cargas(Request $request)
    {
        $contacto = ContactoCliente::where('id_users', $request->usuario)->first();
        $cliente = Cliente::where('id', $contacto->id_cliente)->first();
        return DataTables::of(VistaCarga::all()->where('id_cliente', $cliente->id)->where('estado', 'OPERATIVO'))
            // ->editColumn('created_at', function (VistaCarga $prueba) {
            //     return $prueba->created_at->format('d/m/Y');
            // })

            ->toJson();
    }

    public function form_editar_cliente(Request $request)
    {
        $id = $request->id;
        $empresa = Cliente::findOrFail($id);
        $contactos[] = ContactoCliente::where('id_cliente', $id)->get();
        $cargas[] = Carga::where('id_cliente', $id)->where('estado', 'OPERATIVO')->get();
        $ubicaciones = Ubicacion::all();

        return view("cliente.editar_cliente", [
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


        $id = $request->id;
        $empresa = Cliente::findOrFail($id);
        $empresa->direccion = $request->direccion;
        $empresa->pagina_web = $request->pagina_web;
        // $empresa->id_via_ingreso = $request->id_via_ingreso;
        // $empresa->id_indicador = $request->id_indicador;
        $empresa->responsable_registro = $request->usuario;
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
                $equipos->id_ubicacion = $request->id_ubicacion_c[$j] ?? NULL;
                $equipos->id_cliente = $id;
                $equipos->marca = $request->marca_c[$j];
                $equipos->modelo = $request->modelo_c[$j];
                $equipos->placa = $request->placa_c[$j];
                $equipos->estado = $request->estado_c[$j];
                $equipos->observaciones = $request->observaciones_c[$j] ?? NULL;
                $equipos->unidad_medida_peso = "TN";
                $equipos->save();
            } else {
                $equipos_nuevo = new Carga;
                $equipos_nuevo->tipo = $request->tipo_c[$j];
                $equipos_nuevo->volumen = $request->volumen_c[$j];
                $equipos_nuevo->peso = $request->peso_c[$j];
                $equipos_nuevo->id_ubicacion = $request->id_ubicacion_c[$j] ?? NULL;
                $equipos_nuevo->id_cliente = $id;
                $equipos_nuevo->marca = $request->marca_c[$j];
                $equipos_nuevo->modelo = $request->modelo_c[$j];
                $equipos_nuevo->placa = $request->placa_c[$j];
                $equipos_nuevo->estado = "OPERATIVO";
                $equipos_nuevo->unidad_medida_peso = "TN";
                $equipos_nuevo->save();
            }
        }


        $notification = array(
            'mensaje' => 'Datos actualizado correctamente!' . $ids_eliminar,
            'tipo' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function eliminar_carga($id)
    {

        //Cuenta la cantidad de contactos por cada empresa
        $carga = Carga::findOrFail($id);

        $requerimientos_count = RequerimientoCarga::where('id_carga_cliente', $id)->count();

        //Si hay mas de 0 contactos manda mensaje de error  sino elimina el cliente
        if ($requerimientos_count > 0) {
            $mensaje = 'No puede eliminar la carga ' . $carga->tipo . ', porque tiene ' . $requerimientos_count . ' requerimientos, Dele de baja al equipo';
            $tipo = 'success';
        } else {
            $carga = Carga::findOrFail($id);
            $tipo_carga = $carga->tipo;
            $carga->delete();
            $mensaje = $tipo_carga . ' eliminado correctamente!';
            $tipo = 'success';
        }



        $notification = array(
            'mensaje' => $mensaje,
            'tipo' => $tipo
        );
        return Redirect()->back()->with($notification);
    }
}

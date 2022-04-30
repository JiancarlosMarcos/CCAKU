<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Carga;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\ContactoCliente;
use Yajra\DataTables\DataTables;
use App\Models\VistaRequerimiento;
use App\Models\Ubicacion;
use App\Models\User;
use App\Models\Requerimiento;
use App\Models\RequerimientoTransporte;

class RequerimientoController extends Controller
{
    public function mostrar_requerimientos()
    {
        $clientes = Cliente::all();
        $cargas = Carga::all();

        return view('admin.requerimientos.requerimientos', compact('clientes', 'cargas'));
    }

    public function form_agregar_requerimiento()
    {

        $clientes = Cliente::all();
        $cargas = Carga::all();
        $departamentos = Ubicacion::all();

        return view('admin.requerimientos.agregar_requerimiento', compact('clientes', 'cargas', 'departamentos'));
    }



    public function vista_requerimientos(Request $request)
    {
        return DataTables::of(VistaRequerimiento::all())
            // ->editColumn('fecha', function (VistaRequerimiento $prueba) {
            //     if ($prueba->fecha == NULL) {
            //         return "-";
            //     } else {
            //         return $prueba->fecha->format('d/m/Y');
            //     }
            // })
            ->addColumn('btn_requerimientos', 'admin.botones.btn_requerimientos')
            ->rawColumns(['btn_requerimientos'])
            ->toJson();
    }
    public function consulta_clientes_contactos_nuevo(Request $request)
    {
        if ($request->ajax()) {
            $clientes = ContactoCliente::where('id_cliente', $request->id_cliente)->get();
            foreach ($clientes as $cliente) {
                $nombreArray[] = $cliente->nombre;
                $dniArray[] = $cliente->dni;
                $celularArray[] = $cliente->celular;
                $correoArray[] = $cliente->correo;
                $cargoArray[] = $cliente->cargo;
                $idArray[] = $cliente->id;
            }
            return response()->json([
                'nombre' => $nombreArray,
                'dni' => $dniArray,
                'celular' =>  $celularArray,
                'correo' => $correoArray,
                'cargo' =>  $cargoArray,
                'id' =>  $idArray,
            ]);
        }
    }
    public function consulta_cargas_nuevo(Request $request)
    {
        if ($request->ajax()) {
            $cargas = Carga::where('id_cliente', $request->id_cliente)->get();
            foreach ($cargas as $carga) {

                $tipoArray[] = $carga->tipo;
                $marcaArray[] = $carga->marca;
                $modeloArray[] = $carga->modelo;
                $placaArray[] = $carga->placa;
                $pesoArray[] = $carga->peso;
                $idArray[] = $carga->id;
            }
            return response()->json([
                'tipo' => $tipoArray,
                'marca' => $marcaArray,
                'modelo' => $modeloArray,
                'placa' => $placaArray,
                'peso' => $pesoArray,
                'id' => $idArray,
            ]);
        }
    }
    public function agregar_requerimiento(Request $request)
    {

        $requerimientos = new Requerimiento;
        $requerimientos->fecha = $request->fecha_requerimiento;
        $requerimientos->origen = $request->origen;
        $requerimientos->destino = $request->destino;
        $requerimientos->observaciones = $request->observaciones;
        $requerimientos->estado = 'No atendido';

        ///TIPO CLIENTE -> NUEVO O EXISTENTE
        $select_cliente = $request->select_tipo_cliente;
        //NUEVO
        if ($select_cliente == '1') {
            $cliente = new Cliente;
            $dni_ruc = $request->dni_ruc;
            if (strlen($dni_ruc) == '11') {
                $tipo_empresa = '1';
            } else {
                $tipo_empresa = '2';
            }
            $cliente->dni_ruc = $dni_ruc;
            $cliente->nombre = $request->razon_social;
            $cliente->direccion = $request->direccion;
            $cliente->id_tipo = $tipo_empresa;
            $cliente->save();

            $id_cliente = $cliente->id;

            //REGISTRAR CONTACTO NUEVO PARA CLIENTE NUEVO
            $cliente_contacto = new ContactoCliente;
            $cliente_contacto->nombre = $request->nombre_contacto;
            $cliente_contacto->dni = $request->dni;
            $cliente_contacto->celular = $request->celular_contacto;
            $cliente_contacto->correo = $request->correo_contacto;
            $cliente_contacto->cargo = $request->cargo_contacto;
            $cliente_contacto->id_cliente = $id_cliente;
            $cliente_contacto->save();

            //REGISTRAR CARGA NUEVA PARA CLIENTE NUEVO

            $cargas = new Carga;
            $cargas->tipo = $request->tipo_carga;
            $cargas->marca = $request->marca_carga;
            $cargas->modelo = $request->modelo_carga;
            $cargas->placa = $request->placa_carga;
            $cargas->volumen = $request->volumen_carga;
            $cargas->largo = $request->largo_carga;
            $cargas->ancho = $request->ancho_carga;
            $cargas->altura = $request->altura_carga;
            $cargas->peso = $request->peso_carga;
            $cargas->unidad_medida_peso = $request->medida_peso_carga;
            // $ubicacion_carga = Ubicacion::where('departamento', $request->origen)->get();
            // $cargas->id_ubicacion = $ubicacion_carga->id;
            $cargas->id_cliente = $id_cliente;
            $cargas->save();

            //ID Carga Cliente
            $requerimientos->id_cliente = $id_cliente;
            //ID CONTACTO
            $requerimientos->id_contacto = $cliente_contacto->id;
            //ID CARGA
            $requerimientos->id_carga_cliente = $cargas->id;
        }
        //EXISTENTE
        if ($select_cliente == '2') {
            $id_cliente = $request->id_cliente;
            //ID EMPRESA - UNICO CASO

            $id_contacto = $request->id_contacto;
            //CONTACTO NUEVO
            if ($id_contacto == "nuevo_contacto") {
                $cliente_contacto = new ContactoCliente;
                $cliente_contacto->nombre = $request->nombre_contacto_nuevo;
                $cliente_contacto->dni = $request->dni;
                $cliente_contacto->celular = $request->celular_contacto_nuevo;
                $cliente_contacto->correo = $request->correo_contacto_nuevo;
                $cliente_contacto->cargo = $request->cargo_contacto_nuevo;
                $cliente_contacto->id_cliente = $id_cliente;
                // $cliente_contacto->responsable_registro = $request->usuario;
                $cliente_contacto->save();

                //ID CONTACTO - CASO NUEVO CONTACTO
                $requerimientos->id_contacto = $cliente_contacto->id;
                //CONTACTO EXISTENTE
            } else {
                //ID CONTACTO - CASO EXISTENTE
                $requerimientos->id_contacto = $request->id_contacto;
            }
            $requerimientos->id_cliente = $id_cliente;


            ///REGISTRAR CARGA -> NUEVO O EXISTENTE
            $select_carga = $request->id_carga;
            ///NUEVO
            if ($select_carga == "nueva_carga") {
                // $departamento = $request->origen;
                // $nombre_departamento = '';
                // if ($departamento != NULL) {
                //     $nombre_departamento = $departamento;
                // }
                $cargas = new Carga;
                $cargas->tipo = $request->tipo_carga_cliente_existente;
                $cargas->marca = $request->marca_carga_cliente_existente;
                $cargas->modelo = $request->modelo_carga_cliente_existente;
                $cargas->placa = $request->placa_carga_cliente_existente;
                $cargas->volumen = $request->volumen_carga_cliente_existente;
                $cargas->largo = $request->largo_carga_cliente_existente;
                $cargas->ancho = $request->ancho_carga_cliente_existente;
                $cargas->altura = $request->altura_carga_cliente_existente;
                $cargas->peso = $request->peso_carga_cliente_existente;
                $cargas->unidad_medida_peso = $request->medida_carga_cliente_existente;
                // $ubicacion = Ubicacion::where('departamento', $nombre_departamento)->first();
                // $cargas->id_ubicacion = $ubicacion->id;
                $cargas->id_cliente = $requerimientos->id_cliente;

                $cargas->save();
                $requerimientos->id_carga_cliente = $cargas->id;
            } else {
                $requerimientos->id_carga_cliente = $request->id_carga;
            }
            ///EXISTENTE
        }



        $requerimientos->save();

        $id_requerimiento = $requerimientos->id;
        $contador_transportes = count((is_countable($request->tipo_transporte) ? $request->tipo_transporte : []));

        for ($i = 0; $i < $contador_transportes; $i++) {
            $transportes = new RequerimientoTransporte;
            $transportes->tipo = $request->tipo_transporte[$i];
            $transportes->cantidad_ejes = $request->cantidad_ejes[$i];
            $transportes->id_requerimiento = $id_requerimiento;
            $transportes->cantidad = $request->cantidad[$i];
            $transportes->parte_carga = $request->parte_carga[$i];
            $transportes->save();
        }

        // $contacto_correo = $this->contacto_c;
        // $cliente_correo = $this->cliente_c;
        // $celular_correo = $this->celular_c;
        // $proyecto_correo = $this->proyecto_c;
        // $codigo_proyecto_correo = $this->codigo_proyecto_c;
        // $departamento_correo = $this->departamento_c;
        // $provincia_correo = $this->provincia_c;
        // $distrito_correo = $this->distrito_c;
        // $fecha_inicio_correo = $this->fecha_inicio_c;
        // $etapa_correo = $this->etapa_c;
        // $dni_ruc_correo = $this->dni_ruc_c;

        // $details = [
        //     'contacto' => $contacto_correo,
        //     'cliente' => $cliente_correo,
        //     'celular' => $celular_correo,
        //     'proyecto' => $proyecto_correo,
        //     'codigo_proyecto' => $codigo_proyecto_correo,
        //     'departamento' => $departamento_correo,
        //     'provincia' => $provincia_correo,
        //     'distrito' => $distrito_correo,
        //     'equipo_nombre' => $array_transportes_tipo,
        //     'equipo_capacidad' => $array_transportes_ejes,
        //     'equipo_cantidad' => $array_transportes_cantidad,
        //     // 'equipo_tiempo' => $array_equipos_tiempo,
        //     // 'equipo_division' => $array_equipos_division,
        //     'cantidad_equipos' => $contador_transportes,
        //     'servicio' => $request->valor_tipo_coti,
        //     'observaciones' => $request->observaciones,
        //     'fecha_inicio' => $fecha_inicio_correo,
        //     'etapa' => $etapa_correo,
        //     // 'ejecutivo_asignado' => $ejecutivo_asignado,
        //     'dni_ruc' => $dni_ruc_correo

        // ];


        // $subject = "Nuevo Requerimiento de " . $request->valor_tipo_coti;

        /*//sarah
        $for = "planeamiento@mdnperu.com";

        //brando
        $for_1 = "ventas2@mdnperu.com";

        //otros
        $for_2 = "contabilidad@mdnperu.com";
        $for_3 = "comercial@mdnperu.com";
        */

        /*
            Mail::send('email.requerimientos', $details, function($msj) use($subject,$for,$for_1,$for_2,$for_3){
            $msj->from("ventas@mdnperu.com","MDN-SIS");
            $msj->subject($subject);
            $msj->to($for_3)->cc($for)->cc($for_1)->cc($for_2);
            });
        */


        // $for = "sistemas@mdnperu.com";
        // Mail::send('email.requerimientos', $details, function ($msj) use ($subject, $for) {
        //     $msj->from("ventas@mdnperu.com", "MDN-SIS");
        //     $msj->subject($subject);
        //     $msj->to($for);
        // });


        $notification = array(
            'mensaje' => 'Requerimiento registrado correctamente!',
            'tipo' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function editar_requerimiento(Request $request)
    {
        $request->validate(
            [],
            []
        );

        $requerimiento_id = $request->id_registro;

        $requerimientos_e =  Requerimiento::where('id', $requerimiento_id)->first();
        $requerimientos_e->observaciones = $request->observaciones;
        $requerimientos_e->id_cliente = $request->id_empresa;
        $requerimientos_e->id_contacto = $request->id_contacto;
        $requerimientos_e->id_carga = $request->id_proyecto;

        $tipo_servicio = $request->tipo_servicio;

        $requerimientos_e->save();

        $delete_equipos_requerimiento = RequerimientoTransporte::where('id_requerimiento', $requerimiento_id);
        $delete_equipos_requerimiento->delete();

        $contador_equipos = count($request->nombre_equipo);

        for ($i = 0; $i < $contador_equipos; $i++) {
            $requerimiento_equipos = new RequerimientoTransporte;
            $requerimiento_equipos->nombre = $request->nombre_equipo[$i];
            $requerimiento_equipos->capacidad = $request->capacidad_equipo[$i];
            $requerimiento_equipos->cantidad = $request->cantidad_equipo[$i];
            $requerimiento_equipos->tiempo = $request->tiempo_equipo[$i];
            $requerimiento_equipos->servicio = $tipo_servicio;
            $requerimiento_equipos->id_requerimiento = $requerimiento_id;
            $requerimiento_equipos->division = $request->division[$i];
            $requerimiento_equipos->save();
        }

        $notification = array(
            'mensaje' => 'Requerimiento actualizado correctamente!',
            'tipo' => 'success'
        );
        return Redirect()->back()->with($notification);
    }



    public function eliminar_requerimiento($id)
    {

        $eliminar_equipo_requerimiento = RequerimientoTransporte::where('id_requerimiento', $id);
        $eliminar_equipo_requerimiento->delete();

        $eliminar_requerimiento = Requerimiento::where('id', $id);
        $eliminar_requerimiento->delete();


        $mensaje = 'Requerimiento eliminado correctamente!';
        $tipo = 'success';

        $notification = array(
            'mensaje' => $mensaje,
            'tipo' => $tipo
        );
        return Redirect()->back()->with($notification);
    }
}

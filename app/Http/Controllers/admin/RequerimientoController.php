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
        $proyectos = Carga::all();

        return view('admin.requerimientos.requerimientos', compact('clientes', 'proyectos'));
    }

    public function form_agregar_requerimiento()
    {

        $clientes = Cliente::all();
        $proyectos = Carga::all();
        $departamentos = Ubicacion::all();

        return view('admin.requerimientos.agregar_requerimiento', compact('clientes', 'proyectos', 'departamentos'));
    }



    public function vista_requerimientos(Request $request)
    {
        return DataTables::of(VistaRequerimiento::all())
            // ->editColumn('fecha', function (VistaRequerimiento $requerimientos) {
            //     if ($requerimientos->fecha == NULL) {
            //         return "-";
            //     } else {
            //         return $requerimientos->fecha->format('d/m/Y');
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
                $celularArray[] = $cliente->celular;
                $correoArray[] = $cliente->correo;
                $cargoArray[] = $cliente->cargo;
                $idArray[] = $cliente->id;
            }
            return response()->json([
                'nombre' => $nombreArray,
                'celular' =>  $celularArray,
                'correo' => $correoArray,
                'cargo' =>  $cargoArray,
                'id' =>  $idArray,
            ]);
        }
    }

    public function agregar_requerimiento(Request $request)
    {

        $requerimientos = new Requerimiento;
        $requerimientos->fecha = $request->fecha_requerimiento;
        $requerimientos->origen = $request->origen;
        $requerimientos->destino = $request->destino;

        $requerimientos->responsable_registro = $request->responsable_registro;
        $requerimientos->observaciones = $request->observaciones;
        $requerimientos->id_contacto = $request->id_contacto;
        $requerimientos->id_cliente = $request->id_cliente;
        $requerimientos->estado = 'No atendido';
        // $this->informacion_cliente($request, $requerimientos);
        // $this->informacion_proyecto($request, $requerimientos);

        ///TIPO CLIENTE -> NUEVO O EXISTENTE
        $tipo_cliente = $request->select_tipo_cliente;
        //NUEVO
        if ($tipo_cliente == '1') {
            $cliente = new Cliente;
            $cliente->dni_ruc = $request->dni_ruc;
            $cliente->nombre = $request->razon_social;
            $cliente->direccion = $request->direccion;
            $cliente->id_tipo = $request->tipo_cliente;
            // $cliente->responsable_registro = $request->usuario;
            $cliente->save();

            $id_cliente = $cliente->id;

            $cliente_contacto = new ContactoCliente;
            $cliente_contacto->nombre = $request->nombre_contacto;
            $cliente_contacto->dni = $request->dni;
            $cliente_contacto->celular = $request->celular_contacto;
            $cliente_contacto->correo = $request->correo_contacto;
            $cliente_contacto->cargo = $request->cargo_contacto;
            $cliente_contacto->id_cliente = $id_cliente;
            // $cliente_contacto->responsable_registro = $request->usuario;
            $cliente_contacto->save();

            //ID Carga Cliente
            $requerimientos->id_cliente = $cliente->id;
            //ID CONTACTO
            $requerimientos->id_contacto = $cliente_contacto->id;
        }
        //EXISTENTE
        if ($tipo_cliente == '2') {
            $id_cliente = $request->id_cliente;
            //ID EMPRESA - UNICO CASO
            $requerimientos->id_cliente = $id_cliente;
            $id_contacto = $request->id_contacto;
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
            } else {
                //ID CONTACTO - CASO EXISTENTE
                $requerimientos->id_contacto = $id_contacto;
            }
        }

        ///REGISTRAR CARGA -> NUEVO O EXISTENTE
        $tipo_select_carga = $request->valida_select_carga;
        ///NUEVO
        if ($tipo_select_carga == "1") {
            $departamento = $request->origen;
            $nombre_departamento = '';
            if ($departamento != NULL) {
                $nombre_departamento = $departamento;
            }
            $cargas = new Carga;
            $cargas->tipo = $request->tipo;
            $cargas->marca = $request->marca;
            $cargas->modelo = $request->modelo;
            $cargas->placa = $request->placa;
            $cargas->volumen = $request->volumen;
            $cargas->largo = $request->largo;
            $cargas->ancho = $request->ancho;
            $cargas->altura = $request->altura;
            $cargas->peso = $request->peso;
            $cargas->unidad_medida_peso = $request->medida;
            $ubicacion = Ubicacion::where('departamento', $nombre_departamento)->first();
            $cargas->id_ubicacion = $ubicacion->id;
            $cargas->id_cliente = $request->id_cliente;
            $cargas->save();
            $id_carga = $cargas->id;
        }
        ///EXISTENTE
        if ($tipo_select_carga == "2") {
            $id_carga = $request->id_carga_existente;
            $carga_existente = Carga::findOrFail($id_carga);
            $carga_existente->tipo = $request->tipo;
            $carga_existente->marca = $request->marca;
            $carga_existente->modelo = $request->modelo;
            $carga_existente->placa = $request->placa;
            $carga_existente->volumen = $request->volumen;
            $carga_existente->largo = $request->largo;
            $carga_existente->ancho = $request->ancho;
            $carga_existente->altura = $request->altura;
            $carga_existente->peso = $request->peso;
            $carga_existente->unidad_medida_peso = $request->medida;
        }
        $requerimientos->id_carga_cliente = $id_carga;


        $requerimientos->save();

        $id_requerimiento = $requerimientos->id;
        $contador_transportes = $request->contandor_t;

        // $mensaje_transportes = "";
        // $array_transportes_requerimiento = array();
        // $array_transportes_tipo = array();
        // $array_transportes_ejes = array();
        // $array_transportes_cantidad = array();
        // $array_transportes_creado = array();
        // $array_equipos_division = array();
        for ($i = 0; $i < $contador_transportes; $i++) {
            $transportes = new RequerimientoTransporte;
            $transportes->tipo = $request->tipo[$i];
            $transportes->cantidad_ejes = $request->cantidad_ejes[$i];
            // $requerimiento_transportes->nombre = $request->nombre_equipo[$i];
            // $requerimiento_transportes->capacidad = $request->capacidad_equipo[$i];
            $transportes->cantidad = $request->cantidad[$i];
            $transportes->parte_carga = $request->parte_carga[$i];
            // $requerimiento_transportes->tiempo = $request->tiempo_equipo[$i];
            // $requerimiento_transportes->servicio = $request->valor_tipo_coti;
            $transportes->id_requerimiento = $id_requerimiento;
            // $requerimiento_transportes->division = $request->division[$i];
            $transportes->save();

            // array_push($array_transportes_requerimiento, $requerimiento_transportes->id_requerimiento);
            // array_push($array_transportes_ejes, $requerimiento_transportes->cantidad_ejes);
            // array_push($array_transportes_cantidad, $requerimiento_transportes->cantidad);
            // array_push($array_transportes_tipo, $requerimiento_transportes->tipo);
            // array_push($array_transportes_division, $requerimiento_transportes->division);
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

    // public function editar_requerimiento(Request $request){
    //     $request->validate([

    //     ],    
    //     [

    //     ]);

    //     $requerimiento_id = $request->id_registro;

    //     $requerimientos =  Requerimiento::where('id',$requerimiento_id)->first();


    //     $requerimientos->observaciones = $request->observaciones;


    //     $requerimientos->id_empresa = $request->id_empresa;
    //     $requerimientos->id_contacto = $request->id_contacto;
    //     $requerimientos->id_proyecto = $request->id_proyecto;

    //     $tipo_servicio = $request->tipo_servicio;

    //     $requerimientos->save();

    //     $delete_equipos_requerimiento = RequerimientoEquipo::where('id_requerimiento',$requerimiento_id);
    //     $delete_equipos_requerimiento->delete();

    //     $contador_equipos = count($request->nombre_equipo);

    //     for($i=0;$i<$contador_equipos;$i++){
    //         $requerimiento_equipos = new RequerimientoEquipo;
    //         $requerimiento_equipos->nombre = $request->nombre_equipo[$i];
    //         $requerimiento_equipos->capacidad = $request->capacidad_equipo[$i];
    //         $requerimiento_equipos->cantidad = $request->cantidad_equipo[$i];
    //         $requerimiento_equipos->tiempo = $request->tiempo_equipo[$i];
    //         $requerimiento_equipos->servicio = $tipo_servicio;
    //         $requerimiento_equipos->id_requerimiento = $requerimiento_id;
    //         $requerimiento_equipos->division = $request->division[$i];
    //         $requerimiento_equipos->save();

    //     }

    //     $notification = array(
    //         'mensaje' => 'Requerimiento actualizado correctamente!',
    //         'tipo' => 'success'
    //         );
    //        return Redirect()->back()->with($notification);
    // }



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

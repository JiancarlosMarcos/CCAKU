<?php

namespace App\Http\Controllers\cliente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Carga;
use App\Models\ContactoCliente;
use App\Models\Ubicacion;
use App\Models\Vehiculo;
use App\Models\VistaTransportista;
use App\Models\RequerimientoTransporte;
use App\Models\Requerimiento;
use App\Models\VistaCarga;
use App\Models\VistaRequerimiento;
use Yajra\DataTables\DataTables;

class RequerimientoClienteController extends Controller
{

    public function mostrar_requerimientos()
    {
        $clientes = Cliente::all();
        $cargas = Carga::all();

        return view('cliente.vista_requerimientos', compact('clientes', 'cargas'));
    }

    public function vista_requerimientos(Request $request)
    {
        $contacto = ContactoCliente::where('id_users', $request->usuario)->first();
        $cliente = Cliente::where('id', $contacto->id_cliente)->first();
        return DataTables::of(VistaRequerimiento::all()->where('id_cliente', $cliente->id))
            // ->editColumn('fecha', function (VistaRequerimiento $prueba) {
            //     return $prueba->fecha->format('d/m/Y');
            // })
            ->addColumn('btn_requerimientos', 'admin.botones.btn_requerimientos')
            ->rawColumns(['btn_requerimientos'])
            ->toJson();
    }


    public function form_agregar_requerimiento(Request $request)
    {

        $proyectos = VistaCarga::latest()->get();
        // $contacto = ContactoCliente::where('id_users', $request->usuario)->get();
        // $cliente = Cliente::where('id', $contacto->id_cliente)->first();
        // $cargas = Carga::all();
        $departamentos = Ubicacion::all();

        return view('cliente.requerimiento_simple', compact('departamentos', 'proyectos'));
    }

    public function agregar_requerimiento(Request $request)
    {

        $requerimientos = new Requerimiento;
        $requerimientos->fecha = $request->fecha_requerimiento;
        $requerimientos->origen = $request->origen;
        $requerimientos->destino = $request->destino;
        $requerimientos->transporte_requerido = $request->tipo;
        $requerimientos->estado = 'No atendido';
        $requerimientos->responsable_registro = "Cliente";

        $contacto = ContactoCliente::where('id_users', $request->usuario)->first();
        $cliente = Cliente::where('id', $contacto->id_cliente)->first();
        $requerimientos->id_contacto = $contacto->id;
        $requerimientos->id_cliente = $cliente->id;
        $select_carga = $request->id_carga;
        ///NUEVO
        if ($select_carga == null) {
            $cargas = new Carga;
            $cargas->tipo = $request->tipo_carga;
            $cargas->marca = $request->marca_carga;
            $cargas->modelo = $request->modelo_carga;
            // // $cargas->placa = $request->placa_carga_cliente_existente;
            // // $cargas->volumen = $request->volumen_carga_cliente_existente;
            // // $cargas->largo = $request->largo_carga_cliente_existente;
            // // $cargas->ancho = $request->ancho_carga_cliente_existente;
            // // $cargas->altura = $request->altura_carga_cliente_existente;
            // // $cargas->peso = $request->peso_carga_cliente_existente;
            // // $cargas->unidad_medida_peso = $request->medida_carga_cliente_existente;
            $ubicacion = Ubicacion::where('departamento', $request->origen)->first();
            $cargas->id_ubicacion = $ubicacion->id;
            $cargas->id_cliente = $requerimientos->id_cliente;
            $cargas->save();
            $requerimientos->id_carga_cliente = $cargas->id;
        } else {
            $cargas = Carga::where('id', $request->id_carga)->first();
            $ubicacion = Ubicacion::where('departamento', $request->origen)->first();
            $cargas->id_ubicacion = $ubicacion->id;
            $cargas->save();
            $requerimientos->id_carga_cliente = $request->id_carga;
        }







        $requerimientos->save();
        $id_requerimiento = $requerimientos->id;

        $transporte = new RequerimientoTransporte;
        $transporte->tipo = $request->tipo;
        // $transporte->cantidad_ejes = $request->cantidad_ejes;
        $transporte->id_requerimiento = $id_requerimiento;
        $transporte->cantidad = "1";
        // $transporte->parte_carga = $request->parte_carga[$i];
        $transporte->save();


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

    public function consulta_cargas_nuevo(Request $request)
    {
        $contacto = ContactoCliente::where('id_users', $request->id_cliente)->first();
        $cliente = Cliente::where('id', $contacto->id_cliente)->first();
        if ($request->ajax()) {
            $cargas = Carga::where('id_cliente', $cliente->id)->get();
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
}

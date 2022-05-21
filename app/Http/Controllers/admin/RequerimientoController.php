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
use App\Models\RequerimientoCarga;
use App\Models\VistaRequerimientoCarga;
use App\Models\Provincia;
use App\Models\Distrito;

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
            //     return $prueba->fecha->format('d/m/Y');
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

                $tipoArray[] = (isset($carga->tipo)) ? $carga->tipo : '';
                $marcaArray[] = (isset($carga->marca)) ? $carga->marca : '';
                $modeloArray[] = (isset($carga->modelo)) ? $carga->modelo : '';
                $placaArray[] = (isset($carga->placa)) ? $carga->placa : '';
                $pesoArray[] = (isset($carga->peso)) ? $carga->peso : '';
                $volumenArray[] = (isset($carga->volumen)) ? $carga->volumen : '';
                $medidaArray[] = (isset($carga->unidad_medida_peso)) ? $carga->unidad_medida_peso : '';
                $idArray[] = $carga->id;
            }
            return response()->json([
                'tipo' => $tipoArray,
                'marca' => $marcaArray,
                'modelo' => $modeloArray,
                'placa' => $placaArray,
                'peso' => $pesoArray,
                'volumen' => $volumenArray,
                'medida' => $medidaArray,
                'id' => $idArray,
            ]);
        }
    }

    public function consulta_carga_existente(Request $request)
    {
        if ($request->ajax()) {
            $carga = Carga::where('id', $request->id_carga)->first();
            $tipoArray = $carga->tipo;
            $marcaArray = $carga->marca;
            $modeloArray = $carga->modelo;
            $placaArray = $carga->placa;
            $pesoArray = $carga->peso;
            $volumenArray = $carga->volumen;
            $medidaArray = $carga->unidad_medida_peso;
            $idArray = $carga->id;

            return response()->json([
                'tipo' => $tipoArray,
                'marca' => $marcaArray,
                'modelo' => $modeloArray,
                'placa' => $placaArray,
                'peso' => $pesoArray,
                'volumen' => $volumenArray,
                'medida' => $medidaArray,
                'id' => $idArray,
            ]);
        }
    }
    public function agregar_requerimiento(Request $request)
    {

        $requerimientos = new Requerimiento;
        $requerimientos->fecha = $request->fecha_requerimiento;
        $nombre_departamento_origen = Ubicacion::where('id', $request->departamento_origen)->first();
        $requerimientos->departamento_origen = $nombre_departamento_origen->departamento;
        $nombre_departamento_destino = Ubicacion::where('id', $request->departamento_destino)->first();
        $requerimientos->departamento_destino =   $nombre_departamento_destino->departamento;
        $nombre_provincia_origen = Provincia::where('id', $request->provincia_origen)->first();
        $requerimientos->provincia_origen = $nombre_provincia_origen->nombre ?? NULL;
        $nombre_provincia_destino = Provincia::where('id', $request->provincia_destino)->first();
        $requerimientos->provincia_destino = $nombre_provincia_destino->nombre ?? NULL;
        $nombre_distrito_origen = Distrito::where('id', $request->distrito_origen)->first();
        $requerimientos->distrito_origen = $nombre_distrito_origen->nombre ?? NULL;
        $nombre_distrito_destino = Distrito::where('id', $request->distrito_destino)->first();
        $requerimientos->distrito_destino = $nombre_distrito_destino->nombre ?? NULL;
        $requerimientos->direccion_origen = $request->direccion_origen;
        $requerimientos->direccion_destino = $request->direccion_destino;

        $requerimientos->observaciones = $request->observaciones;
        $requerimientos->responsable_registro = $request->usuario;
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



            //REGISTRAR CONTACTO NUEVO PARA CLIENTE NUEVO
            $cliente_contacto = new ContactoCliente;
            $cliente_contacto->nombre = $request->nombre_contacto;
            $cliente_contacto->dni = $request->dni;
            $cliente_contacto->celular = $request->celular_contacto;
            $cliente_contacto->correo = $request->correo_contacto;
            $cliente_contacto->cargo = $request->cargo_contacto;
            $cliente_contacto->id_cliente = $cliente->id;
            $cliente_contacto->save();


            //ID Carga Cliente
            $requerimientos->id_cliente = $cliente->id;
            //ID CONTACTO
            $requerimientos->id_contacto = $cliente_contacto->id;
            $requerimientos->save();
            //REGISTRAR CARGAS NUEVAS PARA CLIENTES NUEVOS
            $contador_cargas = count((is_countable($request->tipo_c_n) ? $request->tipo_c_n : []));
            for ($i = 0; $i < $contador_cargas; $i++) {
                $cargas = new Carga;
                $cargas->tipo = $request->tipo_c_n[$i];
                $cargas->marca = $request->marca_c_n[$i];
                $cargas->modelo = $request->modelo_c_n[$i];
                $cargas->placa = $request->placa_c_n[$i];
                $cargas->volumen = $request->volumen_c_n[$i];
                $cargas->peso = $request->peso_c_n[$i];
                // $ubicacion = Ubicacion::where('departamento', $request->departamento_origen)->first();
                $cargas->id_ubicacion = $request->departamento_origen;
                $cargas->unidad_medida_peso = $request->medida_peso_c_n[$i];
                $cargas->id_cliente = $cliente->id;
                $cargas->save();
                //ID CARGA PARA REGISTRAR EN REQUERIMIENTO_CARGA
                $requerimiento_carga = new RequerimientoCarga;
                $requerimiento_carga->id_carga_cliente = $cargas->id;
                $requerimiento_carga->id_requerimiento = $requerimientos->id;
                $requerimiento_carga->save();
            }
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
                $cliente_contacto->responsable_registro = $request->usuario;
                $cliente_contacto->save();

                //ID CONTACTO - CASO NUEVO CONTACTO
                $requerimientos->id_contacto = $cliente_contacto->id;
                //CONTACTO EXISTENTE
            } else {
                //ID CONTACTO - CASO EXISTENTE
                $requerimientos->id_contacto = $request->id_contacto;
            }
            $requerimientos->id_cliente = $id_cliente;
            $contador_transportes = count((is_countable($request->tipo_transporte) ? $request->tipo_transporte : []));
            $requerimientos->responsable_registro = $request->usuario;
            if ($contador_transportes > 1) {
                $requerimientos->transporte_requerido = "CONVOY";
            } else {
                $requerimientos->transporte_requerido = $request->tipo_transporte[0] ?? NULL;
            }
            $requerimientos->save();
            $contador_cargas = count((is_countable($request->tipo_c_e) ? $request->tipo_c_e : []));
            for ($i = 0; $i < $contador_cargas; $i++) {
                if ($request->id_c_e[$i] == "0") {
                    $cargas = new Carga;
                    $cargas->tipo = $request->tipo_c_e[$i];
                    $cargas->marca = $request->marca_c_e[$i];
                    $cargas->modelo = $request->modelo_c_e[$i];
                    $cargas->placa = $request->placa_c_e[$i];
                    $cargas->volumen = $request->volumen_c_e[$i];
                    $cargas->peso = $request->peso_c_e[$i];
                    // $ubicacion = Ubicacion::where('departamento', $request->departamento_origen)->first();
                    $cargas->id_ubicacion = $request->departamento_origen;
                    $cargas->unidad_medida_peso = $request->medida_peso_c_e[$i];
                    $cargas->id_cliente = $id_cliente;
                    $cargas->save();
                } else {
                    $cargas = Carga::find($request->id_c_e[$i]);
                    // $ubicacion = Ubicacion::where('departamento', $request->departamento_origen)->first();
                    $cargas->id_ubicacion = $request->departamento_origen;
                    $cargas->save();
                }
                //ID CARGA PARA REGISTRAR EN REQUERIMIENTO_CARGA
                $requerimiento_carga = new RequerimientoCarga;
                $requerimiento_carga->id_carga_cliente = $cargas->id;
                $requerimiento_carga->id_requerimiento = $requerimientos->id;
                $requerimiento_carga->save();
            }
        }


        // $requerimientos->save();

        $id_requerimiento = $requerimientos->id;


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

    public function form_editar_requerimiento(Request $request)
    {
        $requerimiento = Requerimiento::find($request->id);
        $clientes = Cliente::all();
        $contacto = ContactoCliente::where('id', $requerimiento->id_contacto)->first();
        $cargas_reqs[] = VistaRequerimientoCarga::where('id_requerimiento', $request->id)->get();
        $cargas = Carga::where('id_cliente', $requerimiento->id_cliente)->get();
        $departamentos = Ubicacion::all();
        $provincias = Provincia::all();
        $distritos = Distrito::all();
        $usuarios = User::all();
        $transportes[] = RequerimientoTransporte::where('id_requerimiento', $request->id)->get();

        return view('admin.requerimientos.editar_requerimiento', [
            'requerimiento' => $requerimiento,
            'clientes' => $clientes,
            'contacto' => $contacto,
            'cargas' => $cargas,
            'cargas_reqs' => $cargas_reqs[0],
            'departamentos' => $departamentos,
            'provincias' => $provincias,
            'distritos' => $distritos,
            'transportes' => $transportes[0],
            'usuarios' => $usuarios
        ]);
    }


    public function editar_requerimiento(Request $request)
    {
        $request->validate(
            [],
            []
        );

        $requerimiento =  Requerimiento::where('id', $request->id_requerimiento)->first();
        $requerimiento->observaciones = $request->observaciones;
        // $requerimientos_e->id_cliente = $request->id_empresa;
        // $requerimientos_e->id_contacto = $request->id_contacto;
        // $requerimiento->id_carga_cliente = $request->id_carga;
        $requerimiento->fecha = $request->fecha_transporte;
        $nombre_departamento_origen = Ubicacion::where('id', $request->departamento_origen)->first();
        $requerimiento->departamento_origen = $nombre_departamento_origen->departamento;
        $nombre_departamento_destino = Ubicacion::where('id', $request->departamento_destino)->first();
        $requerimiento->departamento_destino =   $nombre_departamento_destino->departamento;
        $nombre_provincia_origen = Provincia::where('id', $request->provincia_origen)->first();
        $requerimiento->provincia_origen = $nombre_provincia_origen->nombre ?? NULL;
        $nombre_provincia_destino = Provincia::where('id', $request->provincia_destino)->first();
        $requerimiento->provincia_destino = $nombre_provincia_destino->nombre ?? NULL;
        $nombre_distrito_origen = Distrito::where('id', $request->distrito_origen)->first();
        $requerimiento->distrito_origen = $nombre_distrito_origen->nombre ?? NULL;
        $nombre_distrito_destino = Distrito::where('id', $request->distrito_destino)->first();
        $requerimiento->distrito_destino = $nombre_distrito_destino->nombre ?? NULL;
        $requerimiento->direccion_origen = $request->direccion_origen ?? NULL;
        $requerimiento->direccion_destino = $request->direccion_destino ?? NULL;
        $requerimiento->contacto_destino = $request->contacto_destino ?? NULL;



        $contador_transportes = count((is_countable($request->tipo_transporte) ? $request->tipo_transporte : []));
        // $requerimiento->responsable_registro = $request->usuario;
        if ($contador_transportes > 1) {
            $requerimiento->transporte_requerido = "CONVOY";
        } else {
            $requerimiento->transporte_requerido = $request->tipo_transporte[0] ?? NULL;
        }
        $requerimiento->save();




        $id_requerimiento = $requerimiento->id;

        $delete_cargas_requerimiento = RequerimientoCarga::where('id_requerimiento', $request->id_requerimiento);
        $delete_cargas_requerimiento->delete();

        $contador_cargas = count((is_countable($request->tipo_c) ? $request->tipo_c : []));
        for ($i = 0; $i < $contador_cargas; $i++) {
            if ($request->id_carga[$i] == "0") {
                $cargas = new Carga;
                $cargas->tipo = $request->tipo_c[$i];
                $cargas->marca = $request->marca_c[$i];
                $cargas->modelo = $request->modelo_c[$i];
                $cargas->placa = $request->placa_c[$i];
                $cargas->volumen = $request->volumen_c[$i];
                $cargas->peso = $request->peso_c[$i];
                // $ubicacion = Ubicacion::where('departamento', $request->departamento_origen)->first();
                $cargas->id_ubicacion = $request->departamento_origen;
                $cargas->unidad_medida_peso = $request->medida_peso_c[$i];
                $cargas->id_cliente = $requerimiento->id_cliente;
                $cargas->save();
            } else {
                $cargas = Carga::where('id', $request->id_carga[$i])->first();
                // $ubicacion = Ubicacion::where('departamento', $request->departamento_origen)->first();
                $cargas->id_ubicacion = $request->departamento_origen;
                $cargas->save();
            }
            //ID CARGA PARA REGISTRAR EN REQUERIMIENTO_CARGA
            $requerimiento_carga = new RequerimientoCarga;
            $requerimiento_carga->id_carga_cliente = $cargas->id;
            $requerimiento_carga->id_requerimiento = $id_requerimiento;
            $requerimiento_carga->save();
        }






        $delete_equipos_requerimiento = RequerimientoTransporte::where('id_requerimiento', $request->id_requerimiento);
        $delete_equipos_requerimiento->delete();

        for ($i = 0; $i < $contador_transportes; $i++) {
            $transportes = new RequerimientoTransporte;
            $transportes->tipo = $request->tipo_transporte[$i];
            $transportes->cantidad_ejes = $request->cantidad_ejes[$i];
            $transportes->id_requerimiento = $id_requerimiento;
            $transportes->cantidad = $request->cantidad[$i];
            $transportes->parte_carga = $request->parte_carga[$i];
            $transportes->save();
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

    public function provincias(Request $request)
    {
        if ($request->ajax()) {
            $provincias = Provincia::where('id_departamento', $request->id_departamento)->get();
            foreach ($provincias as $provincia) {
                $provinciaArray[$provincia->id] = $provincia->nombre;
            }
            return response()->json($provinciaArray);
        }
    }
    public function consultar_provincias(Request $request)
    {
        if ($request->ajax()) {
            $provincias = Provincia::where('id_departamento', $request->id_departamento)->get();
            foreach ($provincias as $provincia) {
                $provinciaArray[$provincia->id] = $provincia->nombre;
            }
            return response()->json($provinciaArray);
        }
    }

    public function distritos(Request $request)
    {
        if ($request->ajax()) {
            $distritos = Distrito::where('id_provincia', $request->id_provincia)->get();
            foreach ($distritos as $distrito) {
                $distritoArray[$distrito->id] = $distrito->nombre;
            }
            return response()->json($distritoArray);
        }
    }
}

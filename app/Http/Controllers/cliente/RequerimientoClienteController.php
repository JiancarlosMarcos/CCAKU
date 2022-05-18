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
use App\Models\Provincia;
use App\Models\Distrito;
use App\Models\RequerimientoCarga;
use App\Models\VistaRequerimientoCarga;

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
            ->addColumn('btn_requerimientos_cliente', 'cliente.btn_requerimientos_cliente')
            ->rawColumns(['btn_requerimientos_cliente'])
            ->toJson();
    }


    public function form_agregar_requerimiento(Request $request)
    {

        // $proyectos = VistaCarga::latest()->get();
        // $contacto = ContactoCliente::where('id_users', $request->usuario)->get();
        // $cliente = Cliente::where('id', $contacto->id_cliente)->first();
        // $cargas = Carga::all();
        $cargas = Carga::all();
        $contactos = ContactoCliente::all();
        $departamentos = Ubicacion::all();

        return view('cliente.requerimiento_simple', compact('departamentos', 'cargas', 'contactos'));
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
        $requerimientos->provincia_origen = $nombre_provincia_origen->nombre;
        $nombre_provincia_destino = Provincia::where('id', $request->provincia_destino)->first();
        $requerimientos->provincia_destino = $nombre_provincia_destino->nombre;
        $nombre_distrito_origen = Distrito::where('id', $request->distrito_origen)->first();
        $requerimientos->distrito_origen = $nombre_distrito_origen->nombre;
        $nombre_distrito_destino = Distrito::where('id', $request->distrito_destino)->first();
        $requerimientos->distrito_destino = $nombre_distrito_destino->nombre;
        $requerimientos->direccion_origen = $request->direccion_origen;
        $requerimientos->direccion_destino = $request->direccion_destino;

        $requerimientos->responsable_registro = "Cliente";
        $requerimientos->estado = 'No atendido';


        //EXISTENTE

        $id_cliente = $request->id_cliente;
        $requerimientos->id_contacto = $request->id_contacto;
        $requerimientos->id_cliente = $id_cliente;
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


        $contador_transportes = count((is_countable($request->tipo_transporte) ? $request->tipo_transporte : []));
        $requerimientos->responsable_registro = $request->usuario;
        if ($contador_transportes > 1) {
            $requerimientos->transporte_requerido = "CONVOY";
        } else {
            $requerimientos->transporte_requerido = $request->tipo_transporte[0];
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

        $notification = array(
            'mensaje' => 'Requerimiento registrado correctamente!',
            'tipo' => 'success'
        );
        return Redirect()->back()->with($notification);



        // $requerimientos = new Requerimiento;
        // $requerimientos->fecha = $request->fecha_requerimiento;
        // $requerimientos->origen = $request->origen;
        // $requerimientos->destino = $request->destino;
        // $requerimientos->transporte_requerido = $request->tipo;
        // $requerimientos->estado = 'No atendido';
        // $requerimientos->responsable_registro = "Cliente";

        // $contacto = ContactoCliente::where('id_users', $request->usuario)->first();
        // $cliente = Cliente::where('id', $contacto->id_cliente)->first();
        // $requerimientos->id_contacto = $contacto->id;
        // $requerimientos->id_cliente = $cliente->id;
        // $select_carga = $request->id_carga;
        // ///NUEVO
        // if ($select_carga == null) {
        //     $cargas = new Carga;
        //     $cargas->tipo = $request->tipo_carga;
        //     $cargas->marca = $request->marca_carga;
        //     $cargas->modelo = $request->modelo_carga;

        //     $cargas->peso = $request->peso;
        //     $cargas->unidad_medida_peso = $request->medida;
        //     $ubicacion = Ubicacion::where('departamento', $request->origen)->first();
        //     $cargas->id_ubicacion = $ubicacion->id;
        //     $cargas->id_cliente = $requerimientos->id_cliente;
        //     $cargas->save();
        //     $requerimientos->id_carga_cliente = $cargas->id;
        // } else {
        //     $cargas = Carga::where('id', $request->id_carga)->first();
        //     $ubicacion = Ubicacion::where('departamento', $request->origen)->first();
        //     $cargas->id_ubicacion = $ubicacion->id;
        //     $cargas->save();
        //     $requerimientos->id_carga_cliente = $request->id_carga;
        // }
        // $requerimientos->save();

        // $id_requerimiento = $requerimientos->id;

        // $transporte = new RequerimientoTransporte;
        // $transporte->tipo = $request->tipo;
        // // $transporte->cantidad_ejes = $request->cantidad_ejes;
        // $transporte->id_requerimiento = $id_requerimiento;
        // $transporte->cantidad_ejes = $request->ejes;
        // $transporte->cantidad = "1";
        // // $transporte->parte_carga = $request->parte_carga[$i];
        // $transporte->save();

        // $notification = array(
        //     'mensaje' => 'Requerimiento registrado correctamente!',
        //     'tipo' => 'success'
        // );
        // return Redirect()->back()->with($notification);
    }

    public function consulta_cargas_nuevo(Request $request)
    {
        $contacto = ContactoCliente::where('id_users', $request->id_cliente)->first();
        $cliente = Cliente::where('id', $contacto->id_cliente)->first();
        if ($request->ajax()) {
            $cargas = Carga::where('id_cliente', $cliente->id)->get();
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
        $transportes[] = RequerimientoTransporte::where('id_requerimiento', $request->id)->get();

        return view('cliente.editar_requerimiento', [
            'requerimiento' => $requerimiento,
            'clientes' => $clientes,
            'contacto' => $contacto,
            'cargas' => $cargas,
            'cargas_reqs' => $cargas_reqs[0],
            'departamentos' => $departamentos,
            'provincias' => $provincias,
            'distritos' => $distritos,
            'transportes' => $transportes[0]
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



        $contador_transportes = count((is_countable($request->tipo_transporte) ? $request->tipo_transporte : []));
        // $requerimiento->responsable_registro = $request->usuario;
        if ($contador_transportes > 1) {
            $requerimiento->transporte_requerido = "CONVOY";
        } else {
            $requerimiento->transporte_requerido = $request->tipo_transporte[0];
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

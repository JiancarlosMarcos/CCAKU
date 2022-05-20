<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Carga;
use App\Models\Vista_Cotizaciones;
use App\Models\Cotizacion;
use App\Models\CotizacionTransporte;
use App\Models\Ubicacion;
use App\Models\Provincia;
use App\Models\Distrito;
use App\Models\Requerimiento;
use App\Models\RequerimientoCarga;
use App\Models\RequerimientoTransporte;
use Yajra\DataTables\DataTables;

use \PDF;

class CotizacionController extends Controller
{
    public function mostrar_cotizaciones()
    {
        $clientes = Cliente::all();
        $cargas = Carga::all();

        return view('admin.cotizaciones.cotizaciones', compact('clientes', 'cargas'));
    }

    public function vista_cotizaciones(Request $request)
    {
        return DataTables::of(Vista_Cotizaciones::all())
             ->editColumn('fecha_transporte', function (Vista_Cotizaciones $data) {
                 if($data->fecha_transporte==null){
                     return "-";
                 }else{
                      return $data->fecha_transporte->format('d/m/Y');
                 }
                
             })
            ->addColumn('btn_cotizaciones', 'admin.botones.btn_cotizaciones')
            ->rawColumns(['btn_cotizaciones'])
            ->toJson();
    }

    public function form_agregar_cotizacion(Request $request)
    {
        $id_requerimiento =$request->id_requerimiento;
        $data_requerimiento = Requerimiento::where('id',$id_requerimiento)->first();
        $data_requerimiento_carga = RequerimientoCarga::where('id_requerimiento',$id_requerimiento)->get();
        $data_carga = array();
        foreach($data_requerimiento_carga as $carga){
            array_push($data_carga, $carga->id_carga_cliente);
        }
        $data_transporte = RequerimientoTransporte::where('id_requerimiento',$id_requerimiento)->get();

        $clientes = Cliente::all();
        $cargas = Carga::all();
        $departamentos = Ubicacion::all();
/*
        $id_departamento_origen=$data_requerimiento->id_departamento_origen;
        $id_provincia_origen=$data_requerimiento->id_provincia_origen;
        $id_distrito_origen=$data_requerimiento->id_distrito_origen;

*/
        $id_departamento_origen='1';
        $id_provincia_origen='2';
        $id_distrito_origen='24';


        $id_departamento_destino='2';
        $id_provincia_destino='10';
        $id_distrito_destino='103';

        return view('admin.cotizaciones.agregar.agregar_cotizacion', 
        compact('clientes', 'cargas', 'departamentos','id_requerimiento','data_requerimiento','data_carga','data_transporte',
        'id_departamento_origen','id_provincia_origen','id_distrito_origen',
        'id_departamento_destino','id_provincia_destino','id_distrito_destino'));
    }

    public function form_editar_cotizacion(Request $request)
    {

        $id_cotizacion =$request->id_cotizacion;
        $data_cotizacion = Cotizacion::where('id',$id_cotizacion)->first();
        $id_requerimiento = $data_cotizacion->id_requerimiento;

        $data_requerimiento = Requerimiento::where('id',$id_requerimiento)->first();
        $data_requerimiento_carga = RequerimientoCarga::where('id_requerimiento',$id_requerimiento)->get();
        $data_carga = array();
        foreach($data_requerimiento_carga as $carga){
            array_push($data_carga, $carga->id_carga_cliente);
        }
        $data_transporte = CotizacionTransporte::where('id_cotizacion_cliente',$id_cotizacion)->get();

        $clientes = Cliente::all();
        $cargas = Carga::all();
        $departamentos = Ubicacion::all();

        //$provincias = Provincia::all();
        //$distritos = Distrito::all();
        $id_departamento_origen = $data_cotizacion->id_departamento_origen;
        $id_provincia_origen = $data_cotizacion->id_provincia_origen;
        $id_distrito_origen = $data_cotizacion->id_distrito_origen;


        $id_departamento_destino = $data_cotizacion->id_departamento_destino;
        $id_provincia_destino = $data_cotizacion->id_provincia_destino;
        $id_distrito_destino = $data_cotizacion->id_distrito_destino;

        return view('admin.cotizaciones.editar.editar_cotizacion', 
        compact('clientes', 'cargas', 'departamentos','id_requerimiento','data_requerimiento','data_carga','data_transporte','data_cotizacion',
        'id_departamento_origen','id_provincia_origen','id_distrito_origen',
        'id_departamento_destino','id_provincia_destino','id_distrito_destino'));
    }

    public function agregar_cotizacion(Request $request)
    {
        $id_requerimiento = $request->id_requerimiento;
        $cotizaciones = new Cotizacion;
        $cotizaciones->fecha_transporte = $request->fecha_transporte;
        $cotizaciones->id_requerimiento = $id_requerimiento;

        $cotizaciones->id_departamento_origen = $request->id_departamento_origen;
        $cotizaciones->id_departamento_destino = $request->id_departamento_destino;
        $cotizaciones->id_provincia_origen = $request->id_provincia_origen;
        $cotizaciones->id_provincia_destino = $request->id_provincia_destino;
        $cotizaciones->id_distrito_origen = $request->id_distrito_origen;
        $cotizaciones->id_distrito_destino = $request->id_distrito_destino;

        $cotizaciones->forma_pago = $request->forma_pago;
        if(isset($request->monto_total)){
            $nuevo_monto = str_replace(",","",$request->monto_total);
            $cotizaciones->monto_total = $nuevo_monto;
        }
        
        $cotizaciones->moneda = $request->moneda;
        $cotizaciones->descripcion = $request->descripcion;

        $cotizaciones->estado = 'Atendido';
        $cotizaciones->usuario_responsable = $request->usuario_responsable;

        $cotizaciones->direccion_origen = $request->direccion_origen;
        $cotizaciones->direccion_destino = $request->direccion_destino;
        $cotizaciones->version_cotizacion = '1';
        $cotizaciones->save();

        $id_cotizacion = $cotizaciones->id;

        //TRANSPORTES
        $data_transportes = array();
        $contador_transportes = count($request->tipo_transporte);
        for ($i = 0; $i < $contador_transportes; $i++) {
            $cotizacion_transporte = new CotizacionTransporte;
            $cotizacion_transporte->tipo = $request->tipo_transporte[$i];
            $cotizacion_transporte->cantidad_ejes = $request->cantidad_ejes[$i];
            $cotizacion_transporte->cantidad = $request->cantidad[$i];
            $cotizacion_transporte->parte_carga = $request->parte_carga[$i];
            $cotizacion_transporte->id_cotizacion_cliente = $id_cotizacion;
            $cotizacion_transporte->save();
            array_push($data_transportes,$cotizacion_transporte->cantidad." ".$cotizacion_transporte->tipo);
        }
        
        $this->reporte_pdf($cotizaciones,$data_transportes,$request);

        $notification = array(
            'mensaje' => 'Cotizacion registrada correctamente!',
            'tipo' => 'success',
            'id_cotizacion' =>$cotizaciones->id,
            'version' =>$cotizaciones->version_cotizacion,
        );
        return Redirect()->route("cotizaciones.mostrar")->with($notification);
        
    }


    public function editar_cotizacion(Request $request)
    {
       
        $id_cotizacion = $request->id_cotizacion;
        $cotizaciones = Cotizacion::findOrFail($id_cotizacion);
        $cotizaciones->fecha_transporte = $request->fecha_transporte;

        $cotizaciones->id_departamento_origen = $request->id_departamento_origen;
        $cotizaciones->id_departamento_destino = $request->id_departamento_destino;
        $cotizaciones->id_provincia_origen = $request->id_provincia_origen;
        $cotizaciones->id_provincia_destino = $request->id_provincia_destino;
        $cotizaciones->id_distrito_origen = $request->id_distrito_origen;
        $cotizaciones->id_distrito_destino = $request->id_distrito_destino;

        $cotizaciones->forma_pago = $request->forma_pago;
        if(isset($request->monto_total)){
            $nuevo_monto = str_replace(",","",$request->monto_total);
            $cotizaciones->monto_total = $nuevo_monto;
        }
        
        $cotizaciones->moneda = $request->moneda;
        $cotizaciones->descripcion = $request->descripcion;

        $cotizaciones->estado = 'Atendido';
        $cotizaciones->usuario_responsable = $request->usuario_responsable;

        $cotizaciones->direccion_origen = $request->direccion_origen;
        $cotizaciones->direccion_destino = $request->direccion_destino;
        $cotizaciones->version_cotizacion = ($cotizaciones->version_cotizacion)+1;
        $cotizaciones->save();

        //TRANSPORTES
        $data_transportes = array();
        $delete_transporte = CotizacionTransporte::where('id_cotizacion_cliente',$id_cotizacion);
        $delete_transporte->delete();
        $contador_transportes = count($request->tipo_transporte);
        for ($i = 0; $i < $contador_transportes; $i++) {
            $cotizacion_transporte = new CotizacionTransporte;
            $cotizacion_transporte->tipo = $request->tipo_transporte[$i];
            $cotizacion_transporte->cantidad_ejes = $request->cantidad_ejes[$i];
            $cotizacion_transporte->cantidad = $request->cantidad[$i];
            $cotizacion_transporte->parte_carga = $request->parte_carga[$i];
            $cotizacion_transporte->id_cotizacion_cliente = $id_cotizacion;
            $cotizacion_transporte->save();
            array_push($data_transportes,$cotizacion_transporte->cantidad." ".$cotizacion_transporte->tipo);
        }

        $this->reporte_pdf($cotizaciones,$data_transportes,$request);

        $notification = array(
            'mensaje' => 'Cotizacion actualizada correctamente!',
            'tipo' => 'success',
            'id_cotizacion_editar' =>$cotizaciones->id,
            'version' =>$cotizaciones->version_cotizacion,
        );
        return Redirect()->route("cotizaciones.mostrar")->with($notification);
    }

    public function eliminar_cotizacion($id){


        $cotizacion_transporte = CotizacionTransporte::where('id_cotizacion_cliente',$id);
        $cotizacion_transporte->delete();

        $cotizacion = Cotizacion::where('id',$id);
        $cotizacion->delete();

        $mensaje = 'Cotizacion eliminada correctamente!';
        $tipo = 'success';
   

        $notification = array(
            'mensaje' => $mensaje,
            'tipo' => $tipo
        );
        return Redirect()->back()->with($notification);

    }

 

    public function reporte_pdf($cotizaciones,$data_transportes,$request){
        
        $numero_cotizacion = $cotizaciones->id;
        $version_cotizacion = $cotizaciones->version_cotizacion;
        $fecha_cotizacion = $cotizaciones->updated_at;

        //DATOS DEL CLIENTE
        $cliente_tipo= $cotizaciones->requerimiento->cliente->tipo->descripcion;
        $empresa_nombre = $cotizaciones->requerimiento->cliente->nombre;
        $dni_ruc = $cotizaciones->requerimiento->cliente->dni_ruc;
        $cliente_celular = $cotizaciones->requerimiento->contacto->celular;
        $cliente_correo = $cotizaciones->requerimiento->contacto->correo;
        $cliente_nombre = $cotizaciones->requerimiento->contacto->nombre;
        $fecha_cotizacion = $request->fecha_reporte;

        //DETALLE COTIZACION
        //PROVINCIA ORIGEN
        if(isset($cotizaciones->provincia_origen->nombre)){
            $provincia_origen = "-".$cotizaciones->provincia_origen->nombre;
        }else{
            $provincia_origen = "";
        }
        //DISTRITO ORIGEN
        if(isset($cotizaciones->distrito_origen->nombre)){
            $distrito_origen = "-".$cotizaciones->distrito_origen->nombre;
        }else{
            $distrito_origen = "";
        }
        //DIRECCION DESTINO
        if(isset($cotizaciones->direccion_origen)){
            $direccion_origen= $cotizaciones->direccion_origen." - ";
        }else{
            $direccion_origen = "";
        }
        //UBICACION ORIGEN REPORTE
        $ubicacion_origen = $cotizaciones->departamento_origen->departamento.$provincia_origen.$distrito_origen;
        $informacion_origen = $direccion_origen.$ubicacion_origen;

        //PROVINCIA DESTINO
        if(isset($cotizaciones->provincia_destino->nombre)){
            $provincia_destino = "-".$cotizaciones->provincia_destino->nombre;
        }else{
            $provincia_destino = "";
        }
        //DISTRITO DESTINO
        if(isset($cotizaciones->distrito_destino->nombre)){
            $distrito_destino = "-".$cotizaciones->distrito_destino->nombre;
        }else{
            $distrito_destino = "";
        }
        //DIRECCION DESTINO
        if(isset($cotizaciones->direccion_destino)){
            $direccion_destino= $cotizaciones->direccion_destino." - ";
        }else{
            $direccion_destino = "";
        }
        //UBICACION DESTINO REPORTE
        $ubicacion_destino = $cotizaciones->departamento_destino->departamento.$provincia_destino.$distrito_destino;
        $informacion_destino = $direccion_destino.$ubicacion_destino;

        $forma_pago = $cotizaciones->forma_pago;
        $descripcion = $cotizaciones->descripcion;

        //DETALLE CARGAS
        $busqueda_requerimiento_carga = RequerimientoCarga::where('id_requerimiento',$cotizaciones->id_requerimiento)->get();
        $data_cargas = array();
        foreach($busqueda_requerimiento_carga as $busqueda_carga){
            $id_carga_cliente = $busqueda_carga->id_carga_cliente;
            $carga= Carga::where('id',$id_carga_cliente)->first();
            $equipo = $carga->tipo." ".$carga->marca." ".$carga->modelo;
            array_push($data_cargas,$equipo);
        }
        
        //MONTO TOTAL
        $monto_total=$cotizaciones->monto_total;
        $moneda=$cotizaciones->moneda;
        $nombre_asesor=auth()->user()->name;
        $correo_asesor=auth()->user()->email;
        $cargo_asesor="Asesor Comercial";



        /////////////////////////// REPORTE //////////////////////
        $pdf2= \PDF::loadView('admin/cotizaciones/reporte_pdf/01-reporte_pdf',
        compact(
            //DATOS GENERALES DE LA COTIZACION
            'numero_cotizacion','version_cotizacion','fecha_cotizacion',
            //DATOS DEL CLIENTE
            'cliente_tipo','empresa_nombre','cliente_celular','cliente_correo','cliente_nombre','dni_ruc',
            //DETALLES
            'informacion_origen','informacion_destino','forma_pago','descripcion',
            //CARGAS
            'data_cargas',
            //TRANSPORTES
            'data_transportes',
            //MONTO TOTAL
            'monto_total','moneda',
            //DATOS ASESOR
            'nombre_asesor','correo_asesor','cargo_asesor'
            ))->output();
        Storage::disk('cotizaciones_clientes')->put('Cotizacion'.$cotizaciones->id.'-v'.$cotizaciones->version_cotizacion.'.pdf', $pdf2);

    }


    public function descarga_cotizacion_cliente_PDF(Request $request){
  
        return Storage::disk('cotizaciones_clientes')->download('Cotizacion'.$request->id.'-v'.$request->version.'.pdf');
       }

}

<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Carga;
use App\Models\Cotizacion;
use Yajra\DataTables\DataTables;

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
        return DataTables::of(Cotizacion::all())
            // ->editColumn('fecha', function (VistaRequerimiento $prueba) {
            //     return $prueba->fecha->format('d/m/Y');
            // })
            ->addColumn('btn_requerimientos', 'admin.botones.btn_requerimientos')
            ->rawColumns(['btn_requerimientos'])
            ->toJson();
    }
}

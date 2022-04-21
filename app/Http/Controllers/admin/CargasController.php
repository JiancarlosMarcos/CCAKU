<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vista_Cargas_Clientes;
use Yajra\DataTables\DataTables;

class CargasController extends Controller
{
    public function cargas()
    {
        // $clientes = Cliente::all();
        return view('admin.cargas.cargas');
    }


    public function vista_cargas(Request $request)
    {

        return DataTables::of(Vista_Cargas_Clientes::select(
            'id',
            'empresa',
            'tipo',
            'marca',
            'modelo',
            'placa',
            'volumen',
            'largo',
            'ancho',
            'altura',
            'peso',
            'unidad_medida_peso',
            'ubicacion',

        ))
            // ->editColumn('created_at', function (Cliente $prueba) {
            //     return $prueba->created_at->format('d/m/Y');
            // })
            ->addColumn('btn_clientes', 'admin.botones.btn_clientes')
            ->rawColumns(['btn_clientes'])
            ->toJson();
    }
}

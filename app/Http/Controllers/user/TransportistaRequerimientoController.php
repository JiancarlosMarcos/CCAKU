<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Carga;
use App\Models\ContactoCliente;
use Yajra\DataTables\DataTables;
use App\Models\VistaRequerimiento;
use App\Models\Requerimiento;
use App\Models\VistaRequerimientoCarga;
use App\Models\Ubicacion;
use App\Models\Provincia;
use App\Models\Distrito;
use App\Models\User;
use App\Models\RequerimientoTransporte;

class TransportistaRequerimientoController extends Controller
{
    public function mostrar_requerimientos()
    {
        $clientes = Cliente::all();
        $cargas = Carga::all();
        $contactos = ContactoCliente::all();
        return view('transportista.vista_requerimientos', compact('clientes', 'cargas', 'contactos'));
    }

    public function vista_requerimientos()
    {
        return DataTables::of(VistaRequerimiento::all())
            // ->editColumn('fecha', function (VistaRequerimiento $prueba) {
            //     return $prueba->fecha->format('d/m/Y');
            // })
            ->addColumn('btn_requerimientos', 'transportista.btn_requerimientos')
            ->rawColumns(['btn_requerimientos'])
            ->toJson();
    }
    public function visualizar_requerimiento(Request $request)
    {
        $requerimiento = Requerimiento::find($request->id);
        $clientes = Cliente::all();
        $contacto = ContactoCliente::where('id', $requerimiento->id_contacto)->first();
        $cargas_reqs[] = VistaRequerimientoCarga::where('id_requerimiento', $request->id)->get();
        $cargas = Carga::where('id_cliente', $requerimiento->id_cliente)->where('estado', 'OPERATIVO')->get();
        $departamentos = Ubicacion::all();
        $provincias = Provincia::all();
        $distritos = Distrito::all();
        $usuarios = User::all();
        $transportes[] = RequerimientoTransporte::where('id_requerimiento', $request->id)->get();

        return view('transportista.visualizar_requerimiento', [
            'requerimiento' => $requerimiento,
            'clientes' => $clientes,
            'contacto' => $contacto,
            'cargas' => $cargas,
            'cargas_reqs' => $cargas_reqs[0],
            'departamentos' => $departamentos,
            'provincias' => $provincias,
            'distritos' => $distritos,
            'transportes' => $transportes[0],
            'usuarios' => $usuarios,
        ]);
    }
}

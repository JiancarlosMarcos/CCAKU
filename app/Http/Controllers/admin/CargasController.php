<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Carga;
use App\Models\ContactoCliente;
use Illuminate\Http\Request;
use App\Models\VistaCarga;
use Yajra\DataTables\DataTables;
use App\Models\Cliente;
use App\Models\Ubicacion;

class CargasController extends Controller
{
    public function cargas()
    {
        // $clientes = Cliente::all();
        return view('admin.cargas.cargas');
    }


    public function vista_cargas(Request $request)
    {

        return DataTables::of(VistaCarga::all())
            ->editColumn('created_at', function (VistaCarga $prueba) {
                return $prueba->created_at->format('d/m/Y');
            })
            ->addColumn('btn_cargas', 'admin.botones.btn_cargas')
            ->rawColumns(['btn_cargas'])
            ->toJson();
    }

    public function eliminar_carga($id)
    {
        $carga = Carga::findOrFail($id);
        $tipo_carga = $carga->tipo;
        $carga->delete();
        $mensaje = $tipo_carga . ' eliminado correctamente!';
        $tipo = 'success';

        $notification = array(
            'mensaje' => $mensaje,
            'tipo' => $tipo
        );
        return Redirect()->back()->with($notification);
    }
}

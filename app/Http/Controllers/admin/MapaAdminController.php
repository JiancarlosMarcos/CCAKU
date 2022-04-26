<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VistaVehiculo;
use App\Models\VistaCarga;


class MapaAdminController extends Controller
{
    //OBSERVAR TODAS CARGAS Y TRANSPORTES EN EL MAPA
    public function ubicacion_todos_admin(Request $request)
    {
        $transportes = VistaVehiculo::all();
        $cargas = VistaCarga::all();
        return view('admin.mapa', ['transportes' => $transportes, 'cargas' => $cargas]);
    }
    //OBSERVAR TODOS LOS TRANSPORTES EN EL MAPA
    public function ubicacion_todos_transportes_admin(Request $request)
    {
        $transportes = VistaVehiculo::all();
        $cargas = null;
        return view('admin.mapa', ['transportes' => $transportes, 'cargas' => $cargas]);
    }
    //OBSERVAR SEGUN TIPO DE TRANSPORTE EN EL MAPA
    public function ubicacion_transportes_admin(Request $request)
    {
        $transportes = VistaVehiculo::where('tipo', $request->transportes)->get();
        $cargas = null;
        return view('admin.mapa', ['transportes' => $transportes, 'cargas' => $cargas]);
    }
    //OBSERVAR LA BUSQUEDA PERSONALIZADA EN EL MAPA
    public function ubicacion_vehiculo_admin(Request $request)
    {
        $request->validate(
            [],
            []
        );

        $texto_buscador = $request->texto_buscador;
        $transportes =  VistaVehiculo::where('tipo', 'like', '%' . $texto_buscador . '%')->orWhere('marca', 'like', '%' . $texto_buscador . '%')
            ->orWhere('departamento', 'like', '%' . $texto_buscador . '%')->get();

        $contador_equipos_encontrados =  VistaVehiculo::where('tipo', 'like', '%' . $texto_buscador . '%')->orWhere('marca', 'like', '%' . $texto_buscador . '%')
            ->orWhere('departamento', 'like', '%' . $texto_buscador . '%')->count();
        //Buscador 
        if ($contador_equipos_encontrados == '0') {
            $nuevo_texto = substr($texto_buscador, 0, 5);
            $transportes =  VistaVehiculo::where('tipo', 'like', '%' . $nuevo_texto . '%')->orWhere('marca', 'like', '%' . $nuevo_texto . '%')
                ->orWhere('departamento', 'like', '%' . $nuevo_texto . '%')->get();
        }

        return view('admin.mapa', compact('transportes'), ['cargas' => null]);
    }



    //OBSERVAR SEGUN TIPO DE CARGA EN EL MAPA
    public function ubicacion_equipos_admin(Request $request)
    {
        $cargas = VistaCarga::where('tipo', $request->equipos)->get();
        $transportes = null;
        return view('admin.mapa', ['transportes' => $transportes, 'cargas' => $cargas]);
    }
    //OBSERVAR SEGUN TIPO DE CARGAS EN EL MAPA
    public function ubicacion_todos_equipos_admin(Request $request)
    {
        $cargas = VistaCarga::all();
        $transportes = null;
        return view('admin.mapa', ['transportes' => $transportes, 'cargas' => $cargas]);
    }
}

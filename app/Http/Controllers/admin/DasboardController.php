<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Vehiculo;
use App\Models\VistaCliente;
use App\Models\VistaTransportista;
use App\Models\VistaUser;
use App\Models\VistaVehiculo;
use FontLib\Table\Type\name;
use Illuminate\Http\Request;

class DasboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $clientes = VistaCliente::all();
        $usuarios = VistaUser::all();
        $administradores = VistaUser::all()->toJson();
        // $administradores1 = $administradores->name;

        $vehiculos = VistaVehiculo::all();
        $camabajas = count(VistaVehiculo::where('tipo','Camabaja')->get());
        $camacunas = count(VistaVehiculo::where('tipo','Camacuna')->get());
        $tractos = count(VistaVehiculo::where('tipo','Tracto')->get());
        $cam_plataforma = count(VistaVehiculo::where('tipo','Camion Plataforma')->get());
        $cam_rebatibles = count(VistaVehiculo::where('tipo','Camion Rebatible')->get());
        $cam_normal = count(VistaVehiculo::where('tipo','Camion Normal')->get());
        $cam_modular = count(VistaVehiculo::where('tipo','Modulares')->get());

        $jairo = count(VistaTransportista::where('responsable_registro','Jairo Espinoza Quispe')->get());
        $jose_armacanqui = count(VistaTransportista::where('responsable_registro','Jose Armacanqui')->get());
        $brandon = count(VistaTransportista::where('responsable_registro','Brandon')->get());
        $sarah = count(VistaTransportista::where('responsable_registro','Sarah')->get());
        $chistofer = count(VistaTransportista::where('responsable_registro','Christopher')->get());
        $gean = count(VistaTransportista::where('responsable_registro','Gean Carlos Armacanqui Mitma')->get());

        $jairo_v = count(VistaVehiculo::where('responsable_registro','Jairo Espinoza Quispe')->get());
        $jose_armacanqui_v = count(VistaVehiculo::where('responsable_registro','Jose Armacanqui')->get());
        $brandon_v = count(VistaVehiculo::where('responsable_registro','Brandon')->get());
        $sarah_v = count(VistaVehiculo::where('responsable_registro','Sarah')->get());
        $chistofer_v = count(VistaVehiculo::where('responsable_registro','Christopher')->get());
        $gean_v = count(VistaVehiculo::where('responsable_registro','Gean Carlos Armacanqui Mitma')->get());

        $clientes = VistaUser::all()->map(
            function($client){
                return $client->name;
            });

        $total_clientes = count($clientes);
        $total_transportistas = count(VistaTransportista::all());
        $total_vehiculos= count($vehiculos);

        return view('dashboard', compact(
            'total_clientes',
            'total_transportistas',
            'total_vehiculos',
            'usuarios',
            'clientes',
            'vehiculos',
            'camabajas',
            'camacunas',
            'tractos',
            'cam_plataforma',
            'cam_rebatibles',
            'cam_normal',
            'cam_modular',
            'administradores',
            'jairo',
            'jose_armacanqui',
            'brandon',
            'sarah',
            'chistofer',
            'gean',
            'jairo_v',
            'jose_armacanqui_v',
            'brandon_v',
            'sarah_v',
            'chistofer_v',
            'gean_v'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Provincia;
use App\Models\Distrito;

class ConsultasController extends Controller
{
    public function provincias(Request $request){
        if($request->ajax()){
            $provincias = Provincia::where('id_departamento',$request->id_departamento)->get();
            foreach($provincias as $provincia){
                $provinciaArray[$provincia->id] = $provincia->nombre;
            }
            return response()->json($provinciaArray);
            }
}

    public function distritos(Request $request){
        if($request->ajax()){
            $distritos = Distrito::where('id_provincia',$request->id_provincia)->get();
            foreach($distritos as $distrito){
                $distritoArray[$distrito->id] = $distrito->nombre;
            }
            return response()->json($distritoArray);
            }
}
}
<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vista_Registros;

class RegistrosController extends Controller
{
    function  mostrar_registros()
    {
        $usuarios = User::all();
        $registros = Vista_Registros::all();
        return view('admin.registros', compact('usuarios', 'registros'));
    }
}

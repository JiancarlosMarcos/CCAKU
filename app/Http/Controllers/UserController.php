<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;

class UserController extends Controller
{
    public function ObtenerUsuarios()
    {
        $usuarios = Usuario::all();
        return response()->json($usuarios, 200);
    }
}

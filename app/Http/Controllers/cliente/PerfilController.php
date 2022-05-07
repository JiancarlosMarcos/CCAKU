<?php

namespace App\Http\Controllers\cliente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PerfilController extends Controller
{
    public function perfil_usuario()
    {
        return view('cliente.perfil_usuario');
    }
}

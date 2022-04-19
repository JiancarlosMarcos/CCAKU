<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{
    public function clientes()
    {
        $clientes = Cliente::all();
        return view('admin.clientes', compact('clientes'));
    }
}

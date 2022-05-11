<?php

namespace App\Http\Controllers\cliente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cliente;
use App\Models\ContactoCliente;

class PerfilController extends Controller
{
    public function perfil_usuario()
    {
        $usuarios = User::all();
        $clientes = Cliente::all();
        $contactos = ContactoCliente::all();

        return view('cliente.perfil_usuario', compact('usuarios', 'clientes', 'contactos'));
    }
    public function editar_perfil(Request $request)
    {
        $usuario = User::find($request->id_usuario);
        $usuario->name = $request->nombre;
        $usuario->email = $request->correo;
        $usuario->save();
        $contacto = ContactoCliente::find($request->id_contacto);
        $contacto->nombre = $request->nombre;
        $contacto->correo = $request->correo;
        $contacto->dni = $request->dni;
        $contacto->celular = $request->telefono;
        $contacto->cargo = $request->cargo;
        $contacto->save();
        $notification = array(
            'mensaje' => 'Perfil actualizado correctamente!',
            'tipo' => 'success'
        );
        return Redirect()->back()->with($notification);
    }
}

<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\Jetstream;
use App\Models\UserRole;
use App\Models\ContactoCliente;
use App\Models\ContactoTransportista;
use App\Models\Cliente;
use App\Actions\Fortify\PasswordValidationRules;

class CrearUsuarioController extends Controller
{
    use PasswordValidationRules;
    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create_transportista(Request $request)
    {
        Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            // 'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();
        $usuario = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ])->assignRole($request->role_id);

        if ($request->role_id == 3) {
            $contacto_transportista = ContactoTransportista::where('id', $request->id_contacto)->first();
            $contacto_transportista->correo = $request->email;
            $contacto_transportista->id_users = $usuario->id;
            $contacto_transportista->save();
        }
        return view('admin.usuarios.usuarios');
    }
    public function create_administrador(Request $request)
    {
        Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            // 'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();
        $usuario = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ])->assignRole($request->role_id);

        if ($request->role_id == 3) {
            $contacto_transportista = ContactoTransportista::where('id', $request->id_contacto)->first();
            $contacto_transportista->correo = $request->email;
            $contacto_transportista->id_users = $usuario->id;
            $contacto_transportista->save();
        }
        return view('admin.usuarios.usuarios');
    }
}

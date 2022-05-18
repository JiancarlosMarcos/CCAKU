<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use App\Models\UserRole;
use App\Models\ContactoCliente;
use App\Models\ContactoTransportista;
use App\Models\Cliente;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // 'ruc' => ['required'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();
        $usuario = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ])->assignRole($input['role_id']);

        if ($input['role_id'] == 2) {
            $contacto_cliente = new ContactoCliente;
            $contacto_cliente->nombre = $input['name'];
            $contacto_cliente->correo = $input['email'];
            $contacto_cliente->id_users = $usuario->id;
            $ruc = $input['ruc'];
            $empresa = Cliente::where('dni_ruc', $ruc)->first();
            if (isset($empresa)) {
                $contacto_cliente->id_cliente = $empresa->id;
            } else {
                $cliente = new Cliente;
                $cliente->dni_ruc = $input['ruc'];
                $cliente->nombre = $input['empresa'];
                if (strlen($input['ruc']) > 8) {
                    $cliente->id_tipo = 1;
                } else {
                    $cliente->id_tipo = 2;
                }
                $cliente->save();
                $contacto_cliente->id_cliente = $cliente->id;
            }
            $contacto_cliente->save();
        } else if ($input['role_id'] == 3) {
            $contacto_transportista = ContactoTransportista::where('id', $input['id_contacto'])->first();
            $contacto_transportista->id_users = $usuario->id;
            $contacto_transportista->save();
        }
        return $usuario;
    }
}

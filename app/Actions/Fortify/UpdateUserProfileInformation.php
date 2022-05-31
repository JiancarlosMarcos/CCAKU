<?php

namespace App\Actions\Fortify;

use App\Models\ContactoCliente;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use App\Models\UserRole;


class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'dni' => ['required', 'string', 'max:10'],
            'celular' => ['required', 'string', 'max:9'],
            'cargo' => [''],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        if (
            $input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail
        ) {
          
            $this->updateVerifiedUser($user, $input);
        } else {
            ContactoCliente::where('id_users', $user->id)->update([
                'correo' => $input['email'],
                'nombre' => $input['name'],
                'dni' => $input['dni'],
                'celular' => $input['celular'],
                'cargo' => $input['cargo'],

            ]);
                
            $user->forceFill([
                'name' => $input['name'],
                'email' => $input['email'],
                'dni' => $input['dni'],
                'celular' => $input['celular'],
                'cargo' => $input['cargo'],
            ])->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    protected function updateVerifiedUser($user, array $input)
    {
       // ContactoCliente::where('id_users', '2')->update(['correoo' => 'text'], ['nombre' => 'text']);
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();
        // $rol=UserRole::where('id',$input['role_id'])->first();
        // $contacto = ContactoCliente::where('id_users', $user->id)->first();
        // $contacto->dni = [$input['dni']];
        // $contacto->save();
        $user->sendEmailVerificationNotification();
    }
}

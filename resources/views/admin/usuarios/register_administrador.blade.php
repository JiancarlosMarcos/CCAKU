@extends('adminlte::page')
@section('title', 'Registro de Usuario')

@section('content_header')

@stop

@section('content')


    <x-guest-layout>
        <x-jet-authentication-card>
            <h3 class="title" style="color:#7f7f7f">Registro de Administrador</h3>

            <x-slot name="logo">
                <figure class="avatar" style="padding: 0">
                    <img style="width: 130px; height:124px; background:#7f7f7f39; border-color:#d9d9d9;border-width:3px;border-style:solid"
                        src="{{ url('/image/logo-cuadrado.jpg') }}">
                </figure>
            </x-slot>

            <x-jet-validation-errors class="mb-4" />
            <input type="text" value="" class="alerta_1 oculto" id="errores"
                style="font-size:14px;background:transparent;border:0px solid transparent;width:100%;color:#be1e37"
                disabled>
            <form method="POST" action="{{ route('crear_administrador') }}">
                @csrf
                <input class="form-control" name="usuario" id="usuario" type="hidden" value="{{ auth()->user()->name }}">



                <div>
                    <x-jet-label for=" name" value="{{ __('Nombre') }}" />
                    <x-jet-input id="name" class="block mt-1 w-full" type="text" :value="old('name')" name="name" required />
                </div>

                <div class="mt-4">
                    <x-jet-label for="email" value="{{ __('Correo') }}" />
                    <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                </div>

                <div class="mt-4">
                    <x-jet-input type="hidden" name="role_id" x-model="role_id" value="1" />
                </div>


                <div class="mt-4">
                    <x-jet-label for="password" value="{{ __('Contraseña') }}" />
                    <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="new-password" :value="old('password')" />
                </div>

                <div class="mt-4">
                    <x-jet-label for="password_confirmation" value="{{ __('Confirmar Contraseña') }}" />
                    <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password"
                        name="password_confirmation" required autocomplete="new-password" />
                </div>

                {{-- @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="mt-4">
                        <x-jet-label for="terms">
                            <div class="flex items-center">
                                <x-jet-checkbox name="terms" id="terms" />

                                <div class="ml-2">
                                    {!! __('Estoy deacuerdo con los :terms_of_service y :privacy_policy', [
    'terms_of_service' => '<a target="_blank" href="' . route('terms.show') . '" class="underline text-sm text-gray-600 hover:text-gray-900">' . __('Terms of Service') . '</a>',
    'privacy_policy' => '<a target="_blank" href="' . route('policy.show') . '" class="underline text-sm text-gray-600 hover:text-gray-900">' . __('Privacy Policy') . '</a>',
]) !!}
                                </div>
                            </div>
                        </x-jet-label>
                    </div>
                @endif --}}

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="/admin/usuarios">
                        {{ __('Volver') }}
                    </a>

                    <x-jet-button class="ml-4" onclick="validarboton()">
                        {{ __('Registrar') }}
                    </x-jet-button>
                </div>
            </form>
        </x-jet-authentication-card>
    </x-guest-layout>



@stop

@section('css')
    <style>
        .title {
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
            color: #212529;
        }

        .subtitle {
            text-align: center;
            font-size: 1.2rem;
            font-weight: bold;
            color: #212529;
        }

        .oculto {
            display: none;
        }

        .validacion {
            background-color: #dfdfdf;
            border-radius: 5px;
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            /* padding-top: 0.3rem; */
        }

        .validar_ruc {
            border-radius: 5px;
            display: flex;
            flex-direction: row;

            align-items: center;
        }

        .boton {
            background-color: #ffbf00;
            margin-left: 5px;
            border-radius: 3px;
            text-align: center;
            color: white;
            cursor: pointer;
            border: 1px solid black;
            padding: 0.2rem;
        }

        .alerta_1 {
            text-align: center
        }

    </style>
@stop

@section('js')

@stop

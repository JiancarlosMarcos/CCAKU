@extends('adminlte::page')
@section('title', 'Registro de Usuario')

@section('content_header')
    <br>

    <div class="app-title">
        <div>
            <a href="{{ route('usuarios') }}" class="btn btn-primary"
                style="color:#777;background:#fff;border-color:#777">Usuarios</a>
            <a href="{{ route('usuarios.formulario.agregar.administrador') }}" class="btn btn-primary "
                style="color:#777;background:#fff;border-color:#777">Registrar Administrador</a>
            <a href="{{ route('usuarios.formulario.agregar.transportista') }}" class="btn btn-primary "
                style="background:#777;border-color:#777">Registrar Transportista</a>

            <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a>Registrar Transportista</a></li>
        </ul>
    </div>
@stop

@section('content')

    <h2 style="color:#7f7f7f;font-size:3rem;text-align:center">Registro de Transportistas</h2>
    @include('notificacion')
    <x-guest-layout>
        <x-jet-authentication-card>


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
            <form method="POST" action="{{ route('crear_transportista') }}">
                @csrf
                <input class="form-control" name="usuario" id="usuario" type="hidden"
                    value="{{ auth()->user()->name }}">
                <div>
                    <br>
                    <x-jet-label for="empresa" value="{{ __('Empresa') }}" />
                    <select id="id_transportista" onchange="mostrar_contactos_transportistas()" class="form-control"
                        name="id_transportista">
                        <option value="">Seleccione una empresa Transportista</option>
                        @foreach ($transportistas as $transportista)
                            <option value="{{ $transportista->id }}">{{ $transportista->nombre }}</option>
                        @endforeach
                    </select>
                    <br>
                </div>

                <div>
                    {{-- <label class="control-label" style="font-weight:600;color:#777"><b>Nombre: </b></label> --}}
                    <x-jet-label for=" name" value="{{ __('Nombre') }}" />
                    <select id="contacto" onchange="llenar_datos()" class="form-control" name="contacto">
                        <option value="">Seleccione un contacto</option>
                    </select>
                </div>

                <div>
                    <x-jet-input id="name" class="block mt-1 w-full" type="hidden" name="name" required />
                    <x-jet-input id="id_contacto" class="block mt-1 w-full" type="hidden" name="id_contacto" required />
                </div>

                <div class="mt-4">
                    <x-jet-label for="email" value="{{ __('Correo') }}" />
                    <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                        required />
                </div>

                <div class="mt-4">
                    <x-jet-input type="hidden" name="role_id" x-model="role_id" value="3" />
                </div>


                <div class="mt-4">
                    <x-jet-label for="password" value="{{ __('Contrase??a') }}" />
                    <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="new-password" :value="old('password')" />
                </div>

                <div class="mt-4">
                    <x-jet-label for="password_confirmation" value="{{ __('Confirmar Contrase??a') }}" />
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

    <script>
        function mostrar_contactos_transportistas() {

            var id_transportista = document.getElementById("id_transportista").value;
            if ($.trim(id_transportista) != '') {
                $.get('../consulta_contactos_transportistas', {
                    id_transportista: id_transportista
                }, function(datos) {
                    var nombres = datos["nombre"];
                    var correo = datos["correo"];
                    var id_contacto = datos["id"];
                    console.log(nombres);
                    $('#contacto').empty();
                    $('#contacto').append(
                        "<option value='' selected disabled> ??? Seleccionar un Contacto</option>");
                    var z = 0;
                    $.each(datos["nombre"], function(index, value) {
                        $('#contacto').append('<option value="' + id_contacto[z] + '__' + nombres[z] +
                            '__' + correo[z] + '"> ???? ' +
                            nombres[z] + '</option>');
                        z++;

                    })

                    // $('#buscador_contacto').append(
                    //     "<option value='nuevo_contacto'>++ Agregar Nuevo Contacto </option>");

                }).fail(function() {
                    $('#contacto').empty();
                    $('#contacto').append(
                        "<option value='' selected disabled> ??? El cliente no tiene contactos</option>");
                }).then(function(data) {

                });
            }
        }

        function llenar_datos() {
            var data_buscador = $('#contacto').val();
            console.log(data_buscador);
            const dataArray = data_buscador.split("__");
            $('#id_contacto').val(dataArray[0]);
            $('#name').val(dataArray[1]);
            $('#email').val(dataArray[2]);
        }
    </script>


@stop

@section('css')
    @include('admin.datatable')
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

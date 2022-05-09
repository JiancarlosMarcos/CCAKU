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

</style>
<x-guest-layout>
    <x-jet-authentication-card>
        <h3 class="title" style="color:#7f7f7f">Bienvenido </h3>
        <p class="subtitle" style="color:#7f7f7f"><b>Registrarse al Sistema</b></p>
        <x-slot name="logo">
            <figure class="avatar" style="padding: 0">
                <img style="width: 130px; height:124px; background:#7f7f7f39; border-color:#d9d9d9;border-width:3px;border-style:solid"
                    src="{{ url('/image/logo-cuadrado.jpg') }}">
            </figure>
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-jet-label for="name" value="{{ __('Nombre') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('Nombre')" required
                    autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Correo') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('Correo')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="role" value="{{ __('Tipo de Usuario') }}" />
                <select name="role_id" x-model="role_id"
                    class="block mt-1 w-full border-gray-300 border-radious ocus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    id="role_id" required>
                    <option value="">--Seleccione su tipo de usuario--</option>
                    <option value="2">Cliente</option>
                    {{-- <option value="3">Transportista</option> --}}
                </select>
            </div>

            <div class="mt-4">
                <x-jet-label for="ruc" value="{{ __('RUC/DNI de la empresa') }}" />
                <x-jet-input id="ruc" class="block mt-1 w-full" onkeyup="validar_cliente()" type="number" name="ruc"
                    required />
            </div>

            <div class="mt-4 oculto">
                <x-jet-label for="ruc" value="{{ __('Nombre Empresa/Persona Natural') }}" />
                <x-jet-input id="ruc" class="block mt-1 w-full" type="text" name="empresa" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Contraseña') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirmar Contraseña') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
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
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Ya esta registrado?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Registrarse') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
<script>
    function validar_cliente() {

        var dni_ruc = document.getElementById('ruc').value;

        if ($.trim(dni_ruc) != '') {
            $.get('../consulta_clientes', {
                dni_ruc: dni_ruc
            }, function(empresas) {

                var data_nombre_empresa = empresas["nombre_empresa"];
                var data_dni_ruc_empresa = empresas["dni_ruc_empresa"];


                $.each(empresas, function(index, value) {
                    $('#valida_dni_ruc_1').css("color", "#be1e37");
                    $('#valida_dni_ruc_1').val("Empresa existente");

                })

            }).fail(function() {

                $('#valida_dni_ruc_1').css("color", "#35993A");
                $('#valida_dni_ruc_1').val("Este DNI o RUC no se encuentra registrado");

            }).then(function(data) {
                // console.log(data);
                // console.log("--__"+data[0]);
            });
        }
    }
</script>

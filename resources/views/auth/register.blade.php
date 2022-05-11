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
                <x-jet-input type="hidden" name="role_id" x-model="role_id" value="2" />
            </div>

            <div class="mt-4">
                <x-jet-label for="ruc" value="{{ __('RUC de la empresa') }}" />
                <div class="validar_ruc">
                    <x-jet-input id="ruc" class="block mt-1 w-full" type="number" name="ruc" onkeyup="cambio_dni_ruc()"
                        required />
                    <a class="boton" title="Validar Empresa" onclick="validar_cliente()">✔</a>
                </div>

            </div>

            <div class="mt-4 validacion">

                <input type="text" value="" class="alerta_1 oculto" id="valida_dni_ruc_1"
                    style="font-size:14px;background:transparent;border:0px solid transparent;width:100%;color:#be1e37"
                    disabled>
            </div>

            <div class="mt-4 oculto" id="nombre_empresa">
                <x-jet-label for="ruc" value="{{ __('Nombre de la Empresa') }}" />
                <x-jet-input id="empresa" class="block mt-1 w-full" type="text" name="empresa" required />
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
        $('#valida_dni_ruc_1').removeClass('oculto');
        var dni_ruc = document.getElementById('ruc').value;
        var nombre_empresa = document.getElementById('empresa');
        if ($.trim(dni_ruc) != '') {
            $.get('../consulta_clientes', {
                dni_ruc: dni_ruc
            }, function(empresas) {

                var data_nombre_empresa = empresas["nombre_empresa"];
                var data_dni_ruc_empresa = empresas["dni_ruc_empresa"];


                $.each(empresas, function(index, value) {
                    $('#valida_dni_ruc_1').css("color", "#35993A");
                    $('#valida_dni_ruc_1').val("Empresa existente");
                    $('#nombre_empresa').addClass('oculto');
                    $('#empresa').removeAttr('required');
                })

            }).fail(function() {

                $('#valida_dni_ruc_1').css("color", "#35993A");
                $('#valida_dni_ruc_1').val("Este DNI o RUC no se encuentra registrado");
                $('#nombre_empresa').removeClass('oculto');
                $('#empresa').prop('required', true);

            }).then(function(data) {
                // console.log(data);
                // console.log("--__"+data[0]);
            });
        }
    }

    function cambio_dni_ruc() {
        $('.validacion').addClass('oculto');
        $('#valida_dni_ruc_1').addClass('oculto');
        $('#valida_dni_ruc_1').val("");
        $('#nombre_empresa').addClass('oculto');
        $('#empresa').removeAttr('required');
    }
</script>

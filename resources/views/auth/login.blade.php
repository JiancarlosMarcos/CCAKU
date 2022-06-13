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
        <p class="subtitle" style="color:#7f7f7f"><b>Inicia sesión</b></p>
        <x-slot name="logo">
            <figure class="avatar" style="padding: 0">
                <img style="width: 200px; height:200px;padding:1rem;border-radius:1rem; background-color: rgb(46, 46, 46); border-color:#d9d9d9;border-width:3px;border-style:solid"
                    src="{{ url('/image/logo-apay-copia.png') }}">
            </figure>
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="email" value="{{ __('Correo') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('Correo')" required
                    autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Contraseña') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Recuerdame') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    {{-- <a class="underline text-sm text-gray-600 hover:text-gray-900"
                        href="{{ route('password.request') }}" style="margin-right: 10px">
                        {{ __('Forgot your password?') }}
                    </a> --}}

                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('register') }}">
                        {{ __('Registrarse') }}
                    </a>
                @endif

                <x-jet-button class="ml-4">
                    {{ __('Ingresar') }}
                </x-jet-button>

            </div>

        </form>
    </x-jet-authentication-card>
</x-guest-layout>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('MDN-PT', 'MDN-PT') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="{{ asset('js2/jquery/jquery.min.js') }}"></script>

    <style>
        .fondo {
            background-image: url('/image/fondo.jpg');
            background-size: cover;
            background-position: center;
        }

    </style>
</head>

<body>
    <div class="font-sans text-gray-900 antialiased fondo">
        {{ $slot }}
    </div>

</body>

</html>

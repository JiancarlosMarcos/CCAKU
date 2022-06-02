@extends('adminlte::page')
@section('title', 'Buscador')

@section('content_header')
    <h1>Buscador</h1>
@stop

@section('content')
    <div id="app" class="container">
        <br><br><br><br>






        <center style="margin-top:-17px"> <a href="https://www.mdnperu.com"><img class="logo"
                    style="width:200px;height: 200px;margin-top:-26px" src="{{ url('/image/logo-apay-copia.png') }}"></a>
        </center>


        <br><br>


        <br>
        <center style="padding-left:45px">
            <div>
                <form method="POST" action="{{ route('mapa_vehiculo') }}">
                    @csrf

                    <!--CAJA DE BUSQUEDA-->
                    <div class="row" style="font-weight:600;font-size:13px">
                        <div class="col s12">
                            <div class="row">
                                <div class="input-field col s12" style="margin-top:-2.5%">

                                    <i class="fa fa-search" aria-hidden="true"
                                        style="position:absolute; padding:13px;padding-top:17px"></i>
                                    <input type="text" placeholder="Ejemplo: Autohormigonera Carmix 5.5"
                                        name="texto_buscador" id="autocomplete-input" autocomplete="off"
                                        class="autocomplete form-control-lg"
                                        style="padding-left:35px;border:1px solid #d9d9d9;width:620px; height:45px;border-radius:10px;font-size:13px">

                                    <div>
                                        <!--BUSQUEDA RAPIDA-->
                                        <!--Oculto-->
                                        <input class="form-control-lg seleccion" id="submit" type="submit"
                                            value="Búsqueda Rápida"
                                            style="height:36px;width:165px;border-radius:8px;border:0px solid;margin-top:26px;color:#7f7f7f;font-weight:600;font-size:13px">
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <!--ABRIR MAPA -->
                                        <a href="{{ route('mapa_todos') }}"><input type="button"
                                                class="form-control-lg seleccion" name="btnVerTodo" value="Abrir Mapa"
                                                style="height:36px;width:165px;border-radius:8px;border:0px solid;color:#7f7f7f;font-weight:600;font-size:13px"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            </form>
        </center>

    </div>

    <br>
@stop

@section('css')

    {{-- <link rel="stylesheet" href="css/materialize.min.css"> --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous"></script>
    {{-- <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script> --}}
    <style>
        .form-control-lg {

            outline: none;

        }

        ::-webkit-scrollbar {
            display: none;
        }

        .seleccion {
            transition: background-color .5s;
        }

        .seleccion:hover {
            background-color: #7f7f7f50;
            font-size: 15px;
        }

        #buscador::placeholder {
            color: #7f7f7f90;
            font-weight: 600;
        }

    </style>
    @include('admin.datatable')
@stop

@section('js')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var options = {
                data: {
                    @foreach ($equipos as $equipo)
                        '{{ $equipo->tipo . ' ' . $equipo->marca . ' ' . $equipo->modelo . ' ' . $equipo->departamento }}': null,
                    @endforeach

                    @foreach ($departamentos as $departamento)
                        '{{ $departamento->departamento }}': null,
                    @endforeach


                },
                limit: 4,

                onAutocomplete: function(res) {
                    document.getElementById('submit').click();

                }

            };

            var elems = document.querySelectorAll('.autocomplete');
            var instances = M.Autocomplete.init(elems, options);
        });

        function BuscarRapido() {
            document.getElementById('submit').click();
        }
    </script>
@stop

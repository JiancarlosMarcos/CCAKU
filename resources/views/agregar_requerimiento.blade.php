<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Requerimiento</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    {{-- <link rel="stylesheet" href="{{ url('css/materialize.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/pantalla-carga.css') }}"> --}}

    <style>
        .hidden {
            overflow: hidden;
            visibility: hidden;
            display: none;
        }

    </style>
</head>

<body>

    <div class="centrado" id="onload">
        <div class="lds-ring">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
        Cargando...
    </div>



    <div class="app-title contenido">
        <div>
            <h1> Crear Requerimiento de un Transporte </h1>
        </div>
    </div>

    @include('errores')
    <form method="POST" action="{{ route('agregar_requerimiento') }}" autocomplete="nope" id="add_requerimientos"
        class="contenido " name="add_requerimientos">
        @csrf
        @include('notificacion')



        <input type="text" id="fecha_reporte" name="fecha_reporte" readonly style="font-weight:600;text-align:center">

        <h5> Fecha:<b style="color:#B61A1A;outline:none">(*)</b>:</h5>

        <input type="date" name="fecha_requerimiento" id="fecha_cotizacion" class="form-control" style="width:140px"
            onchange="validar_fecha_cotizacion();">
        <br>
        <h5> Seleccionar Origen y Destino de la Carga:<b style="color:#B61A1A;outline:none">(*)</b>:</h5>
        <div class="row" style="margin-bottom:0px">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label" style="font-weight:600;color:#777"><b>ORIGEN</b><b
                            style="color:#B61A1A">(*)</b>:</label>
                    <select id="departamento" name="departamento"
                        class="form-control buscador_departamento form_nuevo estilo_campo " style="width:100%">
                        <option value="" selected disabled> ✔ Seleccionar</option>
                        @foreach ($departamentos as $departamento)
                            <option value="{{ $departamento->id }}"
                                {{ old('departamento') == "$departamento->id" ? 'selected' : '' }}>
                                {{ $departamento->departamento }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label" style="font-weight:600;color:#777"><b>DESTINO</b><b
                            style="color:#B61A1A">(*)</b>:</label>
                    <select id="departamento" name="departamento"
                        class="form-control buscador_departamento form_nuevo estilo_campo " style="width:100%">
                        <option value="" selected disabled> ✔ Seleccionar</option>
                        @foreach ($departamentos as $departamento)
                            <option value="{{ $departamento->id }}"
                                {{ old('departamento') == "$departamento->id" ? 'selected' : '' }}>
                                {{ $departamento->departamento }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        {{-- @include('07-Requerimientos/agregar_servicio') --}}
        @include('admin/requerimientos/agregar_cliente')
        @include('admin/requerimientos/agregar_proyecto')
        {{-- @include('admin/requerimientos/agregar_transportes') --}}
        <h5>Lista de Transportes Requeridos:<a style="color:#B61A1A;outline:none"><b>(*)</b></a>:</h5>
        <input class="form-control" name="contador_t" id="contador_t" type="hidden" value="0" autocomplete="off" />
        <table class="table table-bordered" id="dynamic_field" style="border: 1px solid #123;background:#fff">

            <thead>
                <tr>
                    <td>Tipo(*)</td>
                    <td>Cantidad(*)</td>
                    <td>Cantidad Ejes</td>
                    <td>Parte de la Carga(*)</td>
                    {{-- <td>Tiempo(*)</td> --}}
                    <td style="text-align:center">Eliminar</td>
                </tr>
            </thead>
        </table>

        <div class="col-md-3">
            <div class="form-group">
                <a class="btn btn-primary" name="add" id="add" style="margin-rigth:auto;width:180px;font-weight:700;
                        font-size:14px;background:#ECDCC2;border-color:#777">
                    ++ Agregar Equipo </a>
            </div>
        </div>

        <div class="row" style="margin-bottom:5px">
            <div class="col-md-5">
                <div class="form-group">
                    <h5>Observaciones:</h5>
                    <textarea rows="10" class="form-control" name="observaciones"></textarea>
                </div>
            </div>
        </div>


        <input class="form-control" name="responsable_registro" id="responsable_registro" type="hidden"
            value="{{ auth()->user()->Nombres }}" autocomplete="off" />

        <button type="submit" class="btn btn-primary btn-sm" style="background:#123;color:#fff;border-color:#777">
            <i class="fa fa-file-text"></i>Crear Requerimiento</button>
    </form>
    <br>

    <script>
        $(document).ready(function() {
            var i = 1;

            $('#add').click(function() {

                $('#dynamic_field').append(

                    '<tr id="row' + i + '" class="equipos">' +

                    '<td>' +
                    '<select class="form-control" style="background:#77777710" name="division[]" required>' +
                    '<option value="" disabled selected>Seleccionar</option>' +
                    '<option value="Camabaja" >Camabaja</option>' +
                    '<option value="Camacuna">Camacuna</option>' +
                    '<option value="Tracto">Tracto</option>' +
                    '<option value="Camion Plataforma">Camion Plataforma</option>' +
                    '</select>' +
                    '</td>' +

                    '<td>' +
                    '<input type="text" name="cantidad[]" ' +
                    'title="nombre_equipo" class="form-control" style="background:#77777710" >' +
                    '</td>' +

                    '<td>' +
                    '<input type="text"  name="cantidad_ejes[]" ' +
                    'class="form-control" style="background:#77777710" autocomplete="off" >' +
                    '</td>' +

                    '<td>' +
                    '<input type="text" name="parte_carga[]" ' +
                    'class="form-control" style="background:#77777710" >' +
                    '</td>' +

                    // '<td>' +
                    // '<input type="text" name="tiempo_equipo[]" ' +
                    // ' class="form-control" style="background:#77777710" >' +
                    // '</td>' +

                    '<td style="text-align:center">' +
                    '<button type="button" id="' + i +
                    '" class="btn btn-danger btn_remove">X</button>' +
                    '</td>' +
                    '</tr>'
                );
                i++;
                document.getElementById("contador_t").value++;
            });

            $(document).on('click', '.btn_remove', function() {
                if (!confirm("¿Estas seguro de eliminar este contacto?")) return;

                var id = $(this).attr('id');
                $('#row' + id).remove();
                document.getElementById("contador_t").value--;

            });

        })
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("table").keypress(function(e) {
                if (e.which == 13) {
                    return false;
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('input[type=text]').forEach(node => node.addEventListener('keypress', e => {
                if (e.keyCode == 13) {
                    e.preventDefault();
                }
            }))
        });
    </script>

    <script>
        function enviar_form() {

            //var nueva= "add_requerimientos";

            //document.forms[nueva].submit();
            $('#onload').fadeIn();
            $('.contenido').addClass('hidden');
        }
    </script>



    <script>
        function funciones_inicio() {
            $('#onload').fadeOut();
            $('.contenido').removeClass('hidden');
            fecha();

            @error('dni_ruc')
                validacion_dni_ruc();
                activar_servicio();
                activar_proyecto();
            @enderror

            @error('razon_social')
                validacion_razon_social();
            
                activar_servicio();
                activar_proyecto();
            @enderror

        }
    </script>

    <script>
        function fecha() {

            var fechaa = new Date();
            var hoy = fechaa.getDate();
            var mesActual = fechaa.getMonth() + 1;
            var anio = fechaa.getFullYear();
            var numero_dia = fechaa.getDay();
            var dia_reporte;
            var mes_reporte;

            let nombres_dia;
            nombres_dia = ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'];
            let nombres_mes;
            nombres_mes = ['', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre',
                'Octubre', 'Noviembre', 'Diciembre'
            ];

            dia_reporte = nombres_dia[numero_dia];
            mes_reporte = nombres_mes[mesActual];

            fecha_reporte = dia_reporte + ", " + hoy + " de " + mes_reporte + " del " + anio;

            document.getElementById("fecha_reporte").value = fecha_reporte;


            var nuevohoy;
            if (hoy < 10) {
                hoy = '0' + hoy;
            }
            if (mesActual < 10) {
                mesActual = '0' + mesActual;
            }
            fecha_cotizacion = anio + "-" + mesActual + "-" + hoy;
            document.getElementById("fecha_cotizacion").value = fecha_cotizacion;

        }
    </script>
    <script>
        window.onload = funciones_inicio();
    </script>
    <script>
        function validar_fecha_cotizacion() {
            var fecha_cotizacion = $('#fecha_cotizacion').val();
            let arr = fecha_cotizacion.split('-');
            var fechaa = new Date(arr[0], arr[1] - 1, arr[2]);
            var hoy = fechaa.getDate();
            var mesActual = fechaa.getMonth() + 1;
            var anio = fechaa.getFullYear();
            var numero_dia = fechaa.getDay();
            var dia_reporte;
            var mes_reporte;
            var fecha_cotizacion = $('#fecha_cotizacion').val();


            let nombres_dia;
            nombres_dia = ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'];
            let nombres_mes;
            nombres_mes = ['', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre',
                'Octubre', 'Noviembre', 'Diciembre'
            ];

            dia_reporte = nombres_dia[numero_dia];
            mes_reporte = nombres_mes[mesActual];

            fecha_reporte = dia_reporte + ", " + hoy + " de " + mes_reporte + " del " + anio;

            document.getElementById("fecha_reporte").value = fecha_reporte;


            var nuevohoy;
            if (hoy < 10) {
                hoy = '0' + hoy;
            }
            if (mesActual < 10) {
                mesActual = '0' + mesActual;
            }
            fecha_cotizacion = anio + "-" + mesActual + "-" + hoy;
            //document.getElementById("fecha_cotizacion").value=fecha_cotizacion;

        }
    </script>
    <script>
        $('#add_requerimientos').on('submit', function(evt) {

            // var servicio_select = document.getElementById("valor_tipo_coti").value;
            var cliente_select = document.getElementById("select_tipo_cliente").value;
            var proyecto_select = document.getElementById("valida_select_proyecto").value;
            var count_equipos = $('.equipos').length;


            // if (servicio_select == 0) {
            //     alert('No has seleccionado ningun tipo de servicio');
            //     evt.preventDefault();
            //     return;
            // }

            if (cliente_select == 0) {
                alert('No has seleccionado ningun tipo de cliente');
                evt.preventDefault();
                return;
            }

            // if (proyecto_select == 0) {
            //     alert('No has seleccionado ningun proyecto');
            //     evt.preventDefault();
            //     return;
            // }

            if (count_equipos == 0) {
                alert('No has agregado ningun transporte');
                evt.preventDefault();
                return;
            }

            $('#onload').fadeIn();
            $('.contenido').addClass('hidden');

        });
    </script>

    <script>
        /////CLIENTE NUEVO
        function select_cliente_nuevo() {
            $(".required_contacto_nuevo").prop("required", false);
            document.getElementById("select_tipo_cliente").value = "1";
            quitar_select_existente();
            $('.vista_clientes_existentes').addClass('hidden');
            $('.vista_clientes_nuevos').removeClass('hidden');
            $('.required_cliente_nuevo').prop('required', true);
            $('.required_cliente_existente').prop('required', false);
            var cliente = document.getElementById("cliente_nuevo");
            cliente.style.background = "#FFB21B";
            cliente.style.color = "#000";
            cliente.style.border = "1px solid #777";

        }

        /////CLIENTE EXISTENTE
        function select_cliente_existente() {

            document.getElementById("select_tipo_cliente").value = "2";
            quitar_select_nuevo();
            $('.vista_clientes_nuevos').addClass('hidden');
            $('.vista_clientes_existentes').removeClass('hidden');
            $('.required_cliente_existente').prop('required', true);
            $('.required_cliente_nuevo').prop('required', false);
            var cliente = document.getElementById("cliente_existente");
            cliente.style.background = "#FFB21B";
            cliente.style.color = "#000";
            cliente.style.border = "1px solid #777";
        }


        function quitar_select_nuevo() {
            var cliente = document.getElementById("cliente_nuevo");
            cliente.style.background = "#fff";
            cliente.style.color = "#000";
            cliente.style.border = " ";
        }

        function quitar_select_existente() {
            var cliente = document.getElementById("cliente_existente");
            cliente.style.background = "#fff";
            cliente.style.color = "#000";
            cliente.style.border = " ";
        }
    </script>

    <script>
        $(document).ready(function() {
            $('.buscador_clientes').select2();
            $('.buscador_contactos').select2();
        });
    </script>
    <script>
        function mostrar_contactos_clientes() {
            $('#buscador_contacto').empty();
            $('#buscador_contacto').append("<option value='' selected disabled> ⌛ Cargando Lista...</option>");
            var id_cliente = document.getElementById("buscador_cliente").value;

            //console.log(fecha_hoy);

            if ($.trim(id_cliente) != '') {
                $.get('../consulta_contactos', {
                    id_cliente: id_cliente
                }, function(datos) {
                    var nombres = datos["nombre"];
                    var celular = datos["celular"];
                    var cargo = datos["cargo"];
                    var correo = datos["correo"];
                    var id_contacto = datos["id"];

                    $('#buscador_contacto').empty();
                    $('#buscador_contacto').append(
                        "<option value='' selected disabled> ✔ Seleccionar un Contacto</option>");
                    var z = 0;
                    $.each(datos["nombre"], function(index, value) {
                        $('#buscador_contacto').append("<option value=" + id_contacto[z] + "> 📌 " +
                            nombres[z] + " || 📱 " + celular[z] + " || &#x2709; " + correo[z] +
                            " || 💼 " + cargo[z] + " " + "</option>");
                        z++;

                    })

                    $('#buscador_contacto').append(
                        "<option value='nuevo_contacto'>++ Agregar Nuevo Contacto </option>");

                }).fail(function() {


                }).then(function(data) {

                });
            }
        }
    </script>
    <script>
        function valida_nuevo_contacto() {
            var data_buscador_contacto = document.getElementById("buscador_contacto").value;

            if (data_buscador_contacto == "nuevo_contacto") {
                $(".nuevo_contacto").removeClass("hidden");
                $(".required_contacto_nuevo").prop("required", true);
            } else {
                $(".nuevo_contacto").addClass("hidden");
                $(".required_contacto_nuevo").prop("required", false);
            }
        }
    </script>

    <script>
        function validar_cliente() {

            var dni_ruc = document.getElementById('dni_ruc').value;

            if ($.trim(dni_ruc) != '') {
                $.get('../consulta_clientes', {
                    dni_ruc: dni_ruc
                }, function(clientes) {

                    $.each(clientes, function(index, value) {

                        // $('.nombre_contacto').addClass('hidden');
                        $('#valida_dni_ruc').css("color", "#be1e37");
                        $('#valida_dni_ruc').val("Este es un cliente existente: " + value);
                    })

                }).fail(function() {
                    console.log("Hay un error")
                    $('#valida_dni_ruc').css("color", "#35993A");
                    $('#valida_dni_ruc').val("Este DNI o RUC no se encuentra registrado");

                }).then(function(data) {
                    // console.log(data);
                    // console.log("--__"+data[0]);
                });
            }

        }
    </script>



    <script>
        $(document).ready(function() {
            $('.buscador_clientes').select2();
            $('.buscador_contactos').select2();
        });
    </script>
    <script>
        function mostrar_contactos_clientes() {
            $('#buscador_contacto').empty();
            $('#buscador_contacto').append("<option value='' selected disabled> ⌛ Cargando Lista...</option>");
            var id_cliente = document.getElementById("buscador_cliente").value;

            //console.log(fecha_hoy);

            if ($.trim(id_cliente) != '') {
                $.get('../consulta_contactos', {
                    id_cliente: id_cliente
                }, function(datos) {
                    var nombres = datos["nombre"];
                    var celular = datos["celular"];
                    var cargo = datos["cargo"];
                    var correo = datos["correo"];
                    var id_contacto = datos["id"];

                    $('#buscador_contacto').empty();
                    $('#buscador_contacto').append(
                        "<option value='' selected disabled> ✔ Seleccionar un Contacto</option>");
                    var z = 0;
                    $.each(datos["nombre"], function(index, value) {
                        $('#buscador_contacto').append("<option value=" + id_contacto[z] + "> 📌 " +
                            nombres[z] + " || 📱 " + celular[z] + " || &#x2709; " + correo[z] +
                            " || 💼 " + cargo[z] + " " + "</option>");
                        z++;

                    })

                    $('#buscador_contacto').append(
                        "<option value='nuevo_contacto'>++ Agregar Nuevo Contacto </option>");

                }).fail(function() {


                }).then(function(data) {

                });
            }
        }
    </script>
    <script>
        function valida_nuevo_contacto() {
            var data_buscador_contacto = document.getElementById("buscador_contacto").value;

            if (data_buscador_contacto == "nuevo_contacto") {
                $(".nuevo_contacto").removeClass("hidden");
                $(".required_contacto_nuevo").prop("required", true);
            } else {
                $(".nuevo_contacto").addClass("hidden");
                $(".required_contacto_nuevo").prop("required", false);
            }
        }
    </script>
    <script>
        /////CLIENTE NUEVO
        function select_cliente_nuevo() {
            $(".required_contacto_nuevo").prop("required", false);
            document.getElementById("select_tipo_cliente").value = "1";
            quitar_select_existente();
            $('.vista_clientes_existentes').addClass('hidden');
            $('.vista_clientes_nuevos').removeClass('hidden');
            $('.required_cliente_nuevo').prop('required', true);
            $('.required_cliente_existente').prop('required', false);
            var cliente = document.getElementById("cliente_nuevo");
            cliente.style.background = "#FFB21B";
            cliente.style.color = "#000";
            cliente.style.border = "1px solid #777";

        }

        /////CLIENTE EXISTENTE
        function select_cliente_existente() {

            document.getElementById("select_tipo_cliente").value = "2";
            quitar_select_nuevo();
            $('.vista_clientes_nuevos').addClass('hidden');
            $('.vista_clientes_existentes').removeClass('hidden');
            $('.required_cliente_existente').prop('required', true);
            $('.required_cliente_nuevo').prop('required', false);
            var cliente = document.getElementById("cliente_existente");
            cliente.style.background = "#FFB21B";
            cliente.style.color = "#000";
            cliente.style.border = "1px solid #777";
        }


        function quitar_select_nuevo() {
            var cliente = document.getElementById("cliente_nuevo");
            cliente.style.background = "#fff";
            cliente.style.color = "#000";
            cliente.style.border = " ";
        }

        function quitar_select_existente() {
            var cliente = document.getElementById("cliente_existente");
            cliente.style.background = "#fff";
            cliente.style.color = "#000";
            cliente.style.border = " ";
        }
    </script>
</body>

</html>

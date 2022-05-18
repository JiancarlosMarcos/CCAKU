@extends('adminlte::page')

@section('content')
@section('titulo', 'Requerimientos')

{{-- <link rel="stylesheet" href="{{ url('css/materialize.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/pantalla-carga.css') }}"> --}}

<style>
    .hidden {
        overflow: hidden;
        visibility: hidden;
        display: none;
    }

</style>

<div class="centrado" id="onload">
    <div class="lds-ring">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
    Cargando...
</div>

<br>
<br>

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



    <input type="hidden" id="fecha_reporte" name="fecha_reporte" readonly style="font-weight:600;text-align:center">

    <h5> Fecha de Transporte:<b style="color:#B61A1A;outline:none">(*)</b>:</h5>

    <input type="date" name="fecha_requerimiento" id="fecha_cotizacion" class="form-control fecha" style="width:200px"
        required>
    <br>

    @include('admin/requerimientos/agregar_origen_destino')
    @include('admin/requerimientos/agregar_cliente')
    <br>
    @include('admin/requerimientos/agregar_transporte')

    <div class="row" style="margin-bottom:5px">
        <div class="col-md-5">
            <div class="form-group">
                <h5>Observaciones:</h5>
                <textarea rows="10" class="form-control" name="observaciones"></textarea>
            </div>
        </div>
    </div>


    <input class="form-control" name="usuario" id="usuario" type="hidden" value="{{ auth()->user()->name }}"
        autocomplete="off" />

    <button type="submit" class="btn btn-primary btn-sm" style="background:#123;color:#fff;border-color:#777">
        <i class="fa fa-file-text"></i>Crear Requerimiento</button>
</form>
<br>




<script>
    function funciones_inicio() {
        $('#onload').fadeOut();
        $('.contenido').removeClass('hidden');


        @error('dni_ruc')
            validacion_dni_ruc();
            // activar_servicio();
            // activar_proyecto();
        @enderror

        @error('razon_social')
            validacion_razon_social();

            // activar_servicio();
            // activar_proyecto();
        @enderror

    }
</script>


<script>
    window.onload = funciones_inicio();
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
    function mostrar_contactos_clientes() {
        $('.select_carga').removeClass('hidden');
        $('#buscador_contacto').empty();
        $('#buscador_contacto').append(
            "<option value='' selected disabled> ⌛ Cargando Lista...</option>");
        var id_cliente = document.getElementById("buscador_cliente").value;


        if ($.trim(id_cliente) != '') {
            $.get('../consulta_contactos', {
                id_cliente: id_cliente
            }, function(datos) {
                var nombres = datos["nombre"];
                var dni = datos["dni"];
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
                $('#buscador_contacto').empty();
                $('#buscador_contacto').append(
                    "<option value='' selected disabled> ❌ El cliente no tiene contactos</option>");
                $('#buscador_contacto').append(
                    "<option value='nuevo_contacto'>++ Agregar Nuevo Contacto </option>");
            }).then(function(data) {

            });
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


{{-- <script>
    $('#add_requerimientos').on('submit', function(evt) {

        // var servicio_select = document.getElementById("valor_tipo_coti").value;
        var cliente_select = document.getElementById("select_tipo_cliente").value;
        var proyecto_select = document.getElementById("valida_select_proyecto").value;
        var count_transportes = $('.transportes').length;


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

        if (count_transportes == 0) {
            alert('No has agregado ningun transporte');
            evt.preventDefault();
            return;
        }

        $('#onload').fadeIn();
        $('.contenido').addClass('hidden');

    });
</script> --}}
{{-- <script type="text/javascript">
    $(document).ready(function() {
        $("table").keypress(function(e) {
            if (e.which == 13) {
                return false;
            }
        });
    });
</script> --}}
{{-- <script>
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
</script> --}}

@endsection

@section('css')
@include('admin.datatable')
@stop

@extends('adminlte::page')

@section('content')
@section('titulo', 'Cotizaciones')

{{-- <link rel="stylesheet" href="{{ url('css/materialize.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/pantalla-carga.css') }}"> --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<style>
.hidden {
    overflow: hidden;
    visibility: hidden;
    display: none;
}

input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

input[type=number] {
    -moz-appearance: textfield;
}
.select2-container--default .select2-selection--single{
    
    height:37px !important;
}

.label,
.numberIndistinto{
                text-align: center;
            }
            .positivos {
                color: black;
            }
            .negativos {
                color: red;
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



<div class="app-title contenido">
    <div>
        <h1> Crear Cotizacion para transportar una Carga </h1>
    </div>
</div>

@include('errores')
<form method="POST" action="{{route('actualizar_cotizacion')}}" autocomplete="off" id="edit_cotizaciones"
    class="contenido " name="edit_cotizaciones">
    @csrf
    @include('notificacion')

    <input class="form-control" name="usuario_responsable" id="usuario_responsable" type="hidden" value="{{ auth()->user()->name }}">
    <input class="form-control" name="id_cotizacion" id="id_cotizacion" type="hidden" value="{{$data_cotizacion->id}}">

    <input type="text" value="" id="fecha_reporte" name="fecha_reporte" readonly
        style="font-weight:600;text-align:center;width:100%"><br>

     <input type="hidden" id="id_requerimiento" name="id_requerimiento" value="{{$id_requerimiento}}"
        readonly style="font-weight:600;text-align:center;background:#f4f6f9;border:0px">

    <h6> Fecha:<b style="color:#B61A1A;outline:none">(*)</b>:</h6>

    <input type="date" value="" name="fecha_requerimiento"
        id="fecha_cotizacion" class="form-control" style="width:140px" onchange="validar_fecha_cotizacion();" readonly>
    <br>
    @include('admin/cotizaciones/editar/editar_cliente')
    <br>



    <h5>Lista de Transportes Requeridos:<a style="color:#B61A1A;outline:none"><b>(*)</b></a>:</h5>
    <input class="form-control" name="contador_t" id="contador_t" type="hidden" value="0" autocomplete="off" />
    <table class="table table-bordered" id="dynamic_field" style="border: 1px solid #123;background:#fff">

        <thead>
            <tr>
                <td>Tipo(*)</td>
                <td>Cantidad(*)</td>
                <td>Cantidad Ejes</td>
                <td>Parte de la Carga(*)</td>
                <td style="text-align:center">Eliminar</td>
            </tr>
        </thead>
        <?php $i='1'; ?>
        @foreach($data_transporte as $transporte)

        <tr id="row<?php echo $i; ?>" class="transportes">

            <td>
                <select class="form-control" style="background:#77777710" name="tipo_transporte[]" required>
                    <option value="" required>Seleccionar</option>
                    <option value='Camabaja' {{($transporte->tipo == 'Camabaja') ? 'selected':''}}>Camabaja</option>
                    <option value='Camacuna' {{($transporte->tipo == 'Camacuna') ? 'selected':''}}>Camacuna</option>
                    <option value='Tracto' {{($transporte->tipo == 'Tracto') ? 'selected':''}}>Tracto</option>
                    <option value='Camion Plataforma' {{($transporte->tipo == 'Camion Plataforma') ? 'selected':''}}>
                        Camion Plataforma</option>
                </select>
            </td>

            <td>
                <input type="text" name="cantidad[]" value="{{$transporte->cantidad}}" title="cantidad"
                    class="form-control" style="background:#77777710">
            </td>

            <td>
                <input type="text" name="cantidad_ejes[]" value="{{$transporte->cantidad_ejes}}" class="form-control"
                    style="background:#77777710" autocomplete="off">
            </td>

            <td>
                <input type="text" name="parte_carga[]" value="{{$transporte->parte_carga}}" class="form-control"
                    style="background:#77777710">
            </td>

            <td style="text-align:center">
                <button type="button" id="<?php echo $i; ?>" class="btn btn-danger btn_remove">X</button>
            </td>
        </tr>
        <?php $i++; ?>
        @endforeach
    </table>
    <div class="row" style="margin-bottom:5px">
        <div class="col-md-3">
            <div class="form-group">
                <a class="btn btn-primary" name="add" id="add" style="margin-rigth:auto;width:180px;font-weight:700;
                        font-size:14px;background:#ECDCC2;border-color:#777">
                    ++ Agregar Equipo </a>
            </div>
        </div>
    </div>

    <div class="row" style="margin-bottom:5px">

        <div class="col-md-5">
            <div class="form-group">
                <h5>COSTO TOTAL:</h5> 
                <input class="numberIndistinto" value="{{number_format($data_cotizacion->monto_total,3)}}" id="costo_total" name="monto_total" style="margin-bottom:5px;border-radius:5px;padding:5px" required><br>
                <input type="radio" name="moneda" onclick="select_dolares()" id="valida1" value="Dolares"
                    style="pointer-events:all;opacity:initial;font-size:6px;transform:scale(1.5);position:initial"
                    required {{($data_cotizacion->moneda=='Dolares') ? "checked":""}}>
                <label for="valida1" style="color:#000;font-size:15px;padding-left:10px;font-weight:500">Dolares</label>
                &nbsp; &nbsp; &nbsp; &nbsp;
                <input type="radio" name="moneda" onclick="select_soles()" id="valida2" value="Soles"
                    style="pointer-events:all;opacity:initial;font-size:6px;transform:scale(1.5);position:initial"
                    required {{($data_cotizacion->moneda=='Soles') ? "checked":""}}>
                <label for="valida2" style="color:#000;font-size:15px;padding-left:10px;font-weight:500">Soles</label>
            </div>
        </div>
    </div>

    <div class="row" style="margin-bottom:5px">
        <div class="col-md-6">
            <div class="form-group">
                <h5>Forma de Pago:</h5>
                <input type="text" value="{{$data_cotizacion->forma_pago}}" class="form-control"
                    name="forma_pago">
            </div>
        </div>
    </div>

    <div class="row" style="margin-bottom:5px">
        <div class="col-md-6">
            <div class="form-group">
                <h5>Descripcion Final:</h5>
                <textarea rows="10" class="form-control" name="descripcion">{{$data_cotizacion->descripcion}}</textarea>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <h5>Observaciones:</h5>
                <textarea rows="10" class="form-control" name="observaciones"
                    readonly>{{$data_requerimiento->observaciones}}</textarea>
            </div>
        </div>
    </div>


    <input class="form-control" name="usuario" id="usuario" type="hidden" value="{{ auth()->user()->name }}"
        autocomplete="off" />

    <button type="submit" class="btn btn-primary btn-sm" style="background:#123;color:#fff;border-color:#777">
        <i class="fa fa-file-text"></i>Actualizar Cotizacion</button>
</form>
<br>

@endsection

@section('css')

<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
-->
@stop



@section('js')

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@stack('child-scripts')
@stack('js-ubicacion')
<script>
$(document).ready(function() {
    $('.buscador_departamento').select2();
    $('.buscador_provincia').select2();
    $('.buscador_distrito').select2();
});
</script>
<script>
$(document).ready(function() {
    var i = $('.transportes').length + 1;

    $('#add').click(function() {

        $('#dynamic_field').append(

            '<tr id="row' + i + '" class="transportes">' +

            '<td>' +
            '<select class="form-control" style="background:#77777710" name="tipo_transporte[]" required>' +
            '<option value="" disabled selected>Seleccionar</option>' +
            '<option value="Camabaja" >Camabaja</option>' +
            '<option value="Camacuna">Camacuna</option>' +
            '<option value="Tracto">Tracto</option>' +
            '<option value="Camion Plataforma">Camion Plataforma</option>' +
            '</select>' +
            '</td>' +

            '<td>' +
            '<input type="text" name="cantidad[]" ' +
            'title="cantidad" class="form-control" style="background:#77777710" >' +
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
        if (!confirm("¿Estas seguro de eliminar este transporte?")) return;

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
    document.querySelectorAll(".numberIndistinto").forEach(el => el.addEventListener("keyup", numberFormatIndistinto));
    $('#onload').fadeOut();
    $('.contenido').removeClass('hidden');
    fecha();
    validar_fecha_cotizacion();
    habilitar_provincia_origen();
    habilitar_distrito_origen();
    habilitar_provincia_destino();
    habilitar_distrito_destino();

    if (document.edit_cotizaciones.moneda[0].checked) {
        $('#valida1').click();
    }else{
        $('#valida2').click();
    }


    
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
$('#edit_cotizaciones').on('submit', function(evt) {

    var count_transportes = $('.transportes').length;

    if (count_transportes == 0) {
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
function valida_nueva_carga() {
    var data_buscador_carga = document.getElementById("buscador_carga").value;

    if (data_buscador_carga == "nueva_carga") {
        $(".nueva_carga").removeClass("hidden");
        $(".required_carga_nueva").prop("required", true);
    } else {
        $(".nueva_carga").addClass("hidden");
        $(".required_carga_nueva").prop("required", false);
    }
}
</script>
<script>
function mostrar_contactos_clientes() {
    $('#buscador_contacto').empty();
    $('#buscador_contacto').append(
        "<option value='' selected disabled> ⌛ Cargando Lista...</option>");
    $('#buscador_carga').empty();
    $('#buscador_carga').append(
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
    if ($.trim(id_cliente) != '') {
        $.get('../consulta_cargas', {
            id_cliente: id_cliente
        }, function(datos) {
            var id_carga = datos["id"];
            var tipo = datos["tipo"];
            var marca = datos["marca"];
            var modelo = datos["modelo"];
            var placa = datos["placa"];
            var peso = datos["peso"];

            $('#buscador_carga').empty();
            $('#buscador_carga').append(
                "<option value='' selected disabled> ✔ Seleccionar una Carga</option>");
            var z = 0;
            $.each(datos["tipo"], function(index, value) {
                $('#buscador_carga').append("<option value=" + id_carga[z] + "> 📌 " +
                    tipo[z] + " || MARCA: " + marca[z] + " || MODELO: ; " + modelo[z] +
                    " || PLACA: " + placa[z] + " || PESO: " + peso[z] + "</option>");
                z++;

            })

            $('#buscador_carga').append(
                "<option value='nueva_carga'>++ Agregar Nueva Carga</option>");

        }).fail(function() {
            $('#buscador_carga').empty();
            $('#buscador_carga').append(
                "<option value='' selected disabled> ❌ El cliente no tiene cargas registradas</option>");
            $('#buscador_carga').append(
                "<option value='nueva_carga'>++ Agregar Nueva Carga </option>");
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




<script>
     //variables globales para definir el separador de millares y decimales
            //Para coma millares y punto en decimales (USA)
            const DECIMALES=".";
            // cambiar por "," para coma decimal y punto en millares (ESPAÑA)
            const INFLOCAL = DECIMALES==="."?new Intl.NumberFormat('en-US'):new Intl.NumberFormat('es-ES');
            //============================================================================
            let regexpInteger = new RegExp('[^0-9]', 'g');
            let regexpNumber = new RegExp('[^0-9' + '\\' + DECIMALES + ']', 'g');
            //============================================================================
            // Formatear numeros enteros indistintamente tanto positivos como negativos

            // Formatear numeros decimales indistintamente tanto positivos como negativos
            function numberFormatIndistinto(e) {
                if (this.value !== "") {
                    //ver si el primer caracter es el simbolo minus "-"
                    let caracterInicial = this.value.substring(0, 1);
                    //si hay caracter negativo al inicio se quita del proceso de formateo
                    //se filtra el contenido de caracteres no admisibles
                    //se divide el numero entre la parte entera y la parte decimal
                    let contenido = caracterInicial === "-" ? this.value.substring(1, this.value.length).replace(regexpNumber, "").split(DECIMALES) : this.value.replace(regexpNumber, "").split(DECIMALES);
                    // añadimos los separadores de miles a la parte entera del numero
                    contenido[0] = contenido[0].length ? INFLOCAL.format(parseInt(contenido[0])) : "0";
                    // Juntamos el numero con los decimales si hay decimales
                    this.value = contenido.length > 1 ? contenido.slice(0, 2).join(DECIMALES) : contenido[0];
                    // Juntamos el signo "-" minus si existe
                    if (caracterInicial === "-") {
                        this.value = caracterInicial + this.value;
                    }
                    //damos color rojo si numero negativo
                    this.className = this.value.substring(0, 1) !== "-" ? "numberIndistinto positivos" : "numberIndistinto negativos";
                }
            }
    </script>
    <script>
        function select_soles(){
$('#costo_total').css('background','#C7CC6299');
        }

        function select_dolares(){
$('#costo_total').css('background','#86B881');
        }
        </script>
<script>
window.onload = funciones_inicio();
</script>
@stop
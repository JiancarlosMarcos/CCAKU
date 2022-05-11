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



<div class="app-title contenido">
    <div>
        <h1> Detalles del Requerimiento de Transporte || Cod. {{ $requerimiento->id }}</h1>
    </div>
</div>

@include('errores')
<form method="POST" action="{{ route('actualizar_requerimiento') }}" autocomplete="nope" id="add_requerimientos"
    class="contenido " name="add_requerimientos">
    @csrf
    @include('notificacion')

    <div class="row" style="margin-bottom:0px">
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label " style="font-weight:600;color:#777"> Registro de requerimiento:</label>
                <input class="form-control" type="text" id="fecha_transporte" name="fecha_transporte" disabled
                    style="font-weight:600;text-align:center"
                    value="{{ $requerimiento->created_at->format('d/m/Y') }}">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label" style="font-weight:600;color:#777"> Estado:</label>
                <input type="text" id="estado" class="form-control " name="estado"
                    style="font-weight:600;text-align:center" disabled value="{{ $requerimiento->estado }}">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label" style="font-weight:600;color:#777"> Responsable de registro:</label>
                <input type="text" id="estado" class="form-control " name="estado"
                    style="font-weight:600;text-align:center" disabled
                    value="{{ $requerimiento->responsable_registro }}">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label" style="font-weight:600;color:#777"> Atendido por:</label>
                <input type="text" id="estado" class="form-control " name="atendido"
                    style="font-weight:600;text-align:center" disabled value="">
            </div>
        </div>
    </div>

    <!--CLIENTES EXISTENTES-->


    <?php $contador_t = count($transportes); ?>
    <input class="form-control" name="contador_t" id="contador_t" type="hidden" value="<?php echo $contador_t; ?>" value="0"
        autocomplete="off" />


    <div class="row vista_clientes_existentes ">

        <div class="col-md-6">
            <div class="form-group">

                <label class="control-label" style="font-weight:600;color:#777"> Empresa:</label>
                @foreach ($clientes as $cliente)
                    @if ($cliente->id == $requerimiento->id_cliente)
                        <input type="text" id="estado" class="form-control " name="empresa" style="font-weight:600"
                            value="Nombre: {{ $cliente->nombre }} || Ruc: {{ $cliente->dni_ruc }}" readonly>
                    @endif
                @endforeach
            </div>
        </div>
        <br>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label" style="font-weight:600;color:#777"> Contacto:</label>
                <input type="text" id="estado" class="form-control " name="empresa" style="font-weight:600"
                    value="{{ $contacto->nombre }}" readonly>
            </div>
        </div>


        <div class="col-md-12">
            <div class="form-group">
                <h6><b style="color:#777">Carga<b style="color:#B61A1A">(*)</b>:</b></h6>
                <select class="form-control buscador_cargas required_cliente_existente" onchange="valida_nueva_carga();"
                    id="buscador_carga" name="id_carga" style="width:100%">
                    @foreach ($cargas as $carga)
                        @if ($carga->id == $requerimiento->id_carga_cliente)
                            <option value="{{ $carga->id }}" selected>Tipo: {{ $carga->tipo }} || Marca:
                                {{ $carga->marca }} || Modelo: {{ $carga->modelo }}</option>
                        @else
                            <option value="{{ $carga->id }}">Tipo: {{ $carga->tipo }} || Marca:
                                {{ $carga->marca }} || Modelo: {{ $carga->modelo }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-12 nueva_carga hidden">
            <h5>Datos de la Carga<b style="color:#B61A1A">(*)</b>:</h5>
        </div>
        <div class="col-md-3 nueva_carga  hidden">
            <div class="form-group">
                <label class="control-label" style="font-weight:600;color:#777"><b>TIPO DE CARGA: </b>
                    <b style="color:#B61A1A">(*)</b></label>
                <input class="form-control estilo_campo required_carga_nueva" name="tipo_carga_cliente_existente"
                    type="text" value="{{ old('tipo_carga_cliente_existente') }}" autocomplete="off"
                    placeholder="Tipo de carga" />
            </div>
        </div>
        <div class="col-md-2 nueva_carga  hidden">
            <div class="form-group">
                <label class="control-label" style="font-weight:600;color:#777"><b>MARCA: </b>
                </label>
                <input class="form-control estilo_campo " name="marca_carga_cliente_existente" type="text"
                    value="{{ old('marca_carga_cliente_existente') }}" autocomplete="off" placeholder="Marca" />
            </div>
        </div>
        <div class="col-md-2 nueva_carga  hidden">
            <div class="form-group">
                <label class="control-label" style="font-weight:600;color:#777"><b>MODELO </b></label>
                <input class="form-control estilo_campo" name="modelo_carga_cliente_existente" type="text"
                    value="{{ old('modelo_carga_cliente_existente') }}" autocomplete="off" placeholder="Modelo" />
            </div>
        </div>

        <div class="col-md-3 nueva_carga  hidden">
            <div class="form-group">
                <label class="control-label" style="font-weight:600;color:#777"><b>PLACA: </b></label>
                <input class="form-control estilo_campo" name="placa_carga_cliente_existente" type="text"
                    value="{{ old('placa_carga_cliente_existente') }}" autocomplete="off" placeholder="Placa" />
            </div>
        </div>

        <div class="col-md-2 nueva_carga  hidden">
            <div class="form-group">
                <label class="control-label" style="font-weight:600;color:#777"><b>VOLUMEN: </b></label>
                <input class="form-control estilo_campo" name="volumen_carga_cliente_existente" type="text"
                    value="{{ old('volumen_carga_cliente_existente') }}" autocomplete="off" placeholder="Volumen" />
            </div>
        </div>


        <div class="col-md-2  nueva_carga hidden">
            <div class="form-group">
                <label class="control-label" style="font-weight:600;color:#777"><b>LARGO:</b></label>
                <input class="form-control estilo_campo " name="largo_carga_cliente_existente" type="text"
                    value="{{ old('largo_carga_cliente_existente') }}" autocomplete="off" placeholder="Largo" />
            </div>
        </div>

        <div class="col-md-2 nueva_carga  hidden">
            <div class="form-group">
                <label class="control-label" style="font-weight:600;color:#777"><b>ANCHO:</b></label>
                <input class="form-control estilo_campo " name="ancho_carga_cliente_existente" type="text"
                    value="{{ old('ancho_carga_cliente_existente') }}" autocomplete="off" placeholder="Ancho" />
            </div>
        </div>

        <div class="col-md-2 nueva_carga  hidden">
            <div class="form-group">
                <label class="control-label" style="font-weight:600;color:#777"><b>ALTURA:</b></label>
                <input class="form-control estilo_campo " name="altura_carga_cliente_existente" type="text"
                    value="{{ old('altura_carga_cliente_existente') }}" autocomplete="off" placeholder="Altura" />
            </div>
        </div>

        <div class="col-md-1 nueva_carga  hidden">
            <div class="form-group">
                <label class="control-label" style="font-weight:600;color:#777"><b>PESO:</b></label>
                <input class="form-control estilo_campo " name="peso_carga_cliente_existente" type="text"
                    value="{{ old('peso') }}" autocomplete="off" placeholder="Peso" />
            </div>
        </div>

        <div class="col-md-2 nueva_carga hidden">
            <div class="form-group ">
                <label class="control-label" style="font-weight:600;color:#777;width:100%"><b>MEDIDA</b>:</label>
                <select name="medida_carga_cliente_existente" class="form-control form_nuevo estilo_campo ">
                    <option value="" selected disabled>Seleccionar Medida</option>
                    <option value="kg">Kilogramo</option>
                    <option value="t">Tonelada</option>
                </select>
            </div>
        </div>

    </div>


    <div class="row" style="margin-bottom:0px">
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label " style="font-weight:600;color:#777">Fecha de Transporte:</label>
                <input class="form-control" type="date" id="fecha_transporte" name="fecha_transporte"
                    style="font-weight:600;text-align:center" value="{{ $requerimiento->fecha }}">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label" style="font-weight:600;color:#777">Origen:</label>
                <select id="origen" name="origen" class="form-control buscador_origen form_nuevo estilo_campo "
                    style="width:100%">
                    @foreach ($departamentos as $departamento)
                        @if ($departamento->departamento == $requerimiento->origen)
                            <option value="{{ $departamento->id }}" selected disabled>
                                {{ $requerimiento->origen }}</option>
                            </option>
                        @endif
                    @endforeach
                    @foreach ($departamentos as $departamento)
                        <option value="{{ $departamento->departamento }}"
                            {{ old('origen') == "$departamento->id" ? 'selected' : '' }}>
                            {{ $departamento->departamento }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label" style="font-weight:600;color:#777">Destino:</label>
                <select id="destino" name="destino" class="form-control buscador_destino form_nuevo estilo_campo "
                    style="width:100%">
                    @foreach ($departamentos as $departamento)
                        @if ($departamento->departamento == $requerimiento->destino)
                            <option value="{{ $departamento->id }}" selected disabled>
                                {{ $requerimiento->destino }}
                            </option>
                        @endif
                    @endforeach
                    @foreach ($departamentos as $departamento)
                        <option value="{{ $departamento->departamento }}"
                            {{ old('destino') == "$departamento->id" ? 'selected' : '' }}>
                            {{ $departamento->departamento }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label " style="font-weight:600;color:#777">Contacto de destino:</label>
                <input class="form-control" type="text" id="fecha_transporte" name="fecha_transporte"
                    style="font-weight:600;text-align:center" value="">
            </div>
        </div>
    </div>

    {{-- <input type="date" name="fecha_requerimiento" id="fecha_cotizacion" class="form-control"
        value="{{ $requerimiento->fecha }}" style="width:140px" onchange="validar_fecha_cotizacion();"> --}}
    <br>

    <br>
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
                {{-- <td>Tiempo(*)</td> --}}
                <td style="text-align:center">Eliminar</td>
            </tr>
        </thead>
        <?php 


        for($j=0;$j<$contador_t;$j++){
     ?>
        <tr id="transporte<?php echo $j; ?>" class="transportes">
            <td>
                {{-- <input type="text" autocomplete="off" class="form-control" style="background:#77777710"
                        value="{{ $transportes[$j]->tipo }}"> --}}


                <input type="hidden" name="id_transporte[]" id="id_transporte<?php echo $j; ?>" autocomplete="off"
                    class="form-control" style="background:#77777710" value="{{ $transportes[$j]->id }}">

                <select name="tipo_t[]" class="form-control " id="tipo_t'+i+'" style="background:#77777710" required>
                    <option value="{{ $transportes[$j]->tipo }}">
                        {{ $transportes[$j]->tipo }}</option>
                    <option value="Camion Plataforma">Camion Plataforma</option>
                    <option value="Camion Rebatible">Camion Rebatible</option>
                    <option value="Camion Normal">Camion Normal</option>
                    <option value="Camacuna">Camacuna</option>
                    <option value="Camabaja">Camabaja</option>
                    <option value="Tracto">Tracto</option>
                    <option value="Modulares">Modulares</option>
                </select>


            </td>

            <td>
                <input type="text" name="cantidad[]" autocomplete="off" class="form-control"
                    style="background:#77777710" value="{{ $transportes[$j]->cantidad }}">
            </td>
            <td>
                <input type="text" name="ejes_t[]" autocomplete="off" class="form-control"
                    style="background:#77777710" value="{{ $transportes[$j]->cantidad_ejes }}">
            </td>

            <td>
                <input type="text" name="parte_carga[]" autocomplete="off" class="form-control"
                    style="background:#77777710" value="{{ $transportes[$j]->parte_carga }}">
            </td>

            <td>
                <button type="button" id="{{ $j }}" class="btn btn-danger btn_remove_data_t">X</button>

            </td>
        </tr>
        <?php }?>


    </table>

    <div class="col-md-3">
        <div class="form-group">
            <a class="btn btn-primary" name="add" id="add" style="margin-rigth:auto;width:180px;font-weight:700;
                        font-size:14px;background:#ECDCC2;border-color:#777">
                ++ Agregar Equipo </a>
        </div>
    </div>

    <div class="row" style="margin-bottom:5px">
        <div class="col-md-12">
            <div class="form-group">
                <h5>Observaciones:</h5>
                <textarea rows="6" class="form-control" name="observaciones"></textarea>
            </div>
        </div>
    </div>


    <input class="form-control" name="responsable_registro" id="responsable_registro" type="hidden"
        value="{{ auth()->user()->name }}" autocomplete="off" />

    <a class="btn btn-primary btn-sm" href="{{ route('cotizaciones.mostrar') }}"
        style="background:#123;color:#fff;border-color:#777">
        <i class="fa fa-file-text"></i>Realizar Cotización</a>
    <a class="btn btn-primary btn-sm" style="background:#123;color:#fff;border-color:#777">
        <i class="fa fa-file-text"></i>Editar Cotizacion</a>
    <a class="btn btn-primary btn-sm" style="background:#123;color:#fff;border-color:#777">
        <i class="fa fa-file-text"></i>Descargar Cotizacion</a>
    <br>
    <br>
    <br>
    <button type="submit" class="btn btn-primary btn-sm"
        style="background:rgb(13, 86, 74);color:#fff;border-color:#777">
        <i class="fa-solid fa-arrows-retweet"></i>Actualizar Requerimiento</button>
</form>
<br>

@endsection

@section('css')

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

@stop
@section('js')

<script>
    $(document).ready(function() {
        var i = 1;

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
        $('.buscardor_cargas').select2();
    });
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


@stop

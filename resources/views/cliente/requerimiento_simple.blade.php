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

    .disponible {
        background-color: #5afa8f !important;
        color: white !important;
    }

    .no_disponible {
        background-color: #fa5050 !important;
        color: white !important;
    }

</style>





<div class="app-title contenido">
    <div>
        <h1> Solicitar un Equipo de Transporte </h1>
    </div>
</div>



@include('errores')
<form method="POST" action="{{ route('agregar_requerimiento_cliente') }}" autocomplete="nope" id="add_requerimientos"
    class="contenido " name="add_requerimientos">
    @csrf
    @include('notificacion')


    <input class="form-control" name="usuario" id="usuario" type="hidden" value="{{ auth()->user()->id }}">
    {{-- <input type="text" id="fecha_reporte" name="fecha_reporte" readonly style="font-weight:600;text-align:center"> --}}

    <h5> Fecha de transporte:<b style="color:#B61A1A;outline:none">(*)</b>:</h5>

    <input type="date" name="fecha_requerimiento" id="fecha_cotizacion" class="form-control fecha" style="width:200px"
        onchange="validar_fecha_cotizacion();" required>
    <br>
    <h5> Seleccionar Origen y Destino de la Carga:<b style="color:#B61A1A;outline:none">(*)</b>:</h5>
    <div class="row" style="margin-bottom:0px">
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label" style="font-weight:600;color:#777"><b>ORIGEN</b><b
                        style="color:#B61A1A">(*)</b>:</label>
                <select id="origen" name="origen" class="form-control buscador_origen form_nuevo estilo_campo "
                    style="width:100%">
                    <option value="" selected disabled> ⬆ Seleccionar</option>
                    @foreach ($departamentos as $departamento)
                        <option value="{{ $departamento->departamento }}"
                            {{ old('origen') == "$departamento->id" ? 'selected' : '' }}>
                            {{ $departamento->departamento }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label" style="font-weight:600;color:#777"><b>DESTINO</b><b
                        style="color:#B61A1A">(*)</b>:</label>
                <select id="destino" name="destino" class="form-control buscador_destino form_nuevo estilo_campo "
                    style="width:100%">
                    <option value="" selected disabled> ⬇ Seleccionar</option>
                    @foreach ($departamentos as $departamento)
                        <option value="{{ $departamento->departamento }}"
                            {{ old('destino') == "$departamento->id" ? 'selected' : '' }}>
                            {{ $departamento->departamento }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <br>
    <div class="form-card" style="color:#000">
        <h5> Seleccionar o Registrar la Carga<b style="color:#B61A1A;outline:none">(*)</b>:</h5>
        <div class="row" style="margin-bottom:5px">

            <div class="col-md-3">

                <div class="form-group">
                    <!--DATA OCULTA-->
                    <input type="hidden" id="valida_select_proyecto" name="valida_select_proyecto"
                        value="{{ old('valida_select_proyecto') }}">

                    <a class="form-control btn" id="select_existente" onclick="select_proyecto_existente();"
                        style="border-color:#777;text-align:center;background:#fff;font-weight:600">CARGA EXISTENTE</a>



                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <a class="form-control btn" id="select_nuevo" onclick="select_proyecto_nuevo();"
                        style="border-color:#777;text-align:center;background:#fff;font-weight:600">CARGA NUEVA</a>


                </div>
            </div>

        </div>
    </div>


    <div class="proyecto_nuevo hidden">


        <div class="row" style="margin-bottom:0px">

            <div class="col-md-3">
                <div class="form-group" style="margin-bottom:0px">
                    <label class="control-label" style="font-weight:600;color:#777"><b>TIPO DE CARGA</b><b
                            style="color:#B61A1A">(*)</b>:</label>
                    <input class="form-control form_nuevo estilo_campo" name="tipo_carga" type="text"
                        style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"
                        value="{{ old('tipo_carga') }}" id="nombre_proyecto" autocomplete="off"
                        placeholder="Tipo de Carga" onkeyup="validar_nombre_proyecto()">
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group ">
                    <label class="control-label" style="font-weight:600;color:#777;width:100%"><b>MARCA:</b><b
                            style="color:#B61A1A">(*)</b>:</label>
                    <input class="form-control estilo_campo " name="marca_carga" type="text"
                        style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"
                        value="{{ old('marca_carga') }}" autocomplete="off" placeholder="Marca" />
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label" style="font-weight:600;color:#777"><b>MODELO:</b><b
                            style="color:#B61A1A">(*)</b>:</label>
                    <input class="form-control estilo_campo " name="modelo_carga" type="text"
                        style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"
                        value="{{ old('modelo_carga') }}" autocomplete="off" placeholder="Modelo" />
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label" style="font-weight:600;color:#777"><b>PESO (opcional):</b></label>
                    <input class="form-control estilo_campo " name="peso" type="number" value="{{ old('peso') }}"
                        autocomplete="off" placeholder="Peso" />
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label" style="font-weight:600;color:#777"><b>Medida (opcional):</b></label>
                    <select name="medida" class="form-control" style="background:#77777710">
                        <option value="" selected>Seleccionar</option>
                        <option value="TN">KG</option>
                        <option value="KG">TN</option>

                    </select>
                </div>
            </div>
        </div>





    </div>


    <!--PROYECTO EXISTENTES FORM-->
    <div class="proyecto_existente hidden">

        <div class="row" style="margin-bottom:0px">
            <div class="col-md-12">
                <div class="form-group">
                    <h6><b style="color:#777">Carga<b style="color:#B61A1A">(*)</b>:</b></h6>
                    <select class="form-control buscador_cargas required_cliente_existente" id="buscador_carga"
                        name="id_carga" style="width:100%">
                        <option value="" disabled selected> ⌛ Cargando lista ...</option>

                    </select>
                </div>
            </div>
        </div>

    </div>

    <h5>Transporte Requerido:</h5>
    <div class="row" style="margin-bottom:0px">

        <div class="col-md-4">
            <div class="form-group">

                <label class="control-label" style="font-weight:600;color:#777"><b>TIPO DE TRANSPORTE: </b>
                </label>

                <select name="tipo" class="form-control" style="background:#77777710">
                    <option value="" disabled selected>Seleccionar</option>
                    <option value="Camabaja">Camabaja</option>
                    <option value="Tracto">Tracto</option>
                    <option value="Camacuna">Camacuna</option>
                    <option value="Camion Plataforma">Camion Plataforma</option>
                    <option value="Camion Normal">Camion Normal</option>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">

                <label class="control-label" style="font-weight:600;color:#777"><b>Cantidad Ejes (Opcional): </b>
                </label>

                <input class="form-control estilo_campo " name="ejes" type="text" value="{{ old('ejes') }}"
                    autocomplete="off" placeholder="Cantidad Ejes" />
            </div>
        </div>
    </div>




    <input class="form-control" name="responsable_registro" id="responsable_registro" type="hidden" value="cliente"
        autocomplete="off" />

    <button type="submit" class="btn btn-primary btn-sm" style="background:#123;color:#fff;border-color:#777">
        <i class="fa fa-file-text"></i>Crear Requerimiento</button>


</form>
<br>



@endsection

@section('css')

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

@stop
@section('js')
@if (old('valida_select_proyecto') == '1')
    <?php echo '<script> function activar_proyecto(){ select_proyecto_nuevo(); } </script>'; ?>
@endif

<script>
    function select_proyecto_nuevo() {
        $('.buscador_equipos').removeClass('hidden');
        quitar_select_proyecto_existente();
        var select = document.getElementById("select_nuevo");
        var valida = document.getElementById("valida_select_proyecto");
        valida.value = "1";
        select.style.background = "#FFB21B";
        select.style.color = "#000";
        select.style.border = "1px solid #777";
        $('.proyecto_nuevo').removeClass('hidden');
        $('.proyecto_existente').addClass('hidden');
        $('.form_nuevo').prop("required", true);
        $('.form_existe').removeAttr("required");
    }


    function select_proyecto_existente() {
        var id_cliente = document.getElementById("usuario").value;
        $('#buscador_carga').empty();
        $('#buscador_carga').append(
            "<option value='' selected disabled> ⌛ Cargando Lista...</option>");


        console.log(id_cliente);
        if ($.trim(id_cliente) != '') {
            $.get('../consulta_cargas_cliente', {
                id_cliente: id_cliente,
            }, function(datos) {
                var id_carga = datos["id"];
                var tipo_carga = datos["tipo"];
                var marca_carga = datos["marca"];
                var modelo_carga = datos["modelo"];
                var peso = datos["peso"];
                var medida = datos["medida"];

                $('#buscador_carga').empty();
                $('#buscador_carga').append(
                    "<option value='' selected disabled> ✔ Seleccionar una Carga</option>");
                var z = 0;
                $.each(datos["tipo"], function(index, value) {
                    $('#buscador_carga').append("<option value=" + id_carga[z] + "> 📌 " +
                        tipo_carga[z] + " || MARCA: " + marca_carga[z] + " || MODELO: " +
                        modelo_carga[z] + " || PESO: " +
                        peso[z] + " " + medida[z] +
                        "</option>");
                    z++;

                })


            }).fail(function() {
                $('#buscador_carga').empty();
                $('#buscador_carga').append(
                    "<option value='' selected disabled> ❌ El cliente no tiene cargas registradas</option>");
            }).then(function(data) {

            });
        }




        $('.buscador_equipos').removeClass('hidden');
        quitar_select_proyecto_nuevo();
        var select = document.getElementById("select_existente");
        var valida = document.getElementById("valida_select_proyecto");
        valida.value = "2";
        select.style.background = "#FFB21B";
        select.style.color = "#000";
        select.style.border = "1px solid #777";
        $('.proyecto_existente').removeClass('hidden');
        $('.proyecto_nuevo').addClass('hidden');
        $('.form_nuevo').removeAttr("required");
        $('.form_existe').prop("required", true);
    }


    function quitar_select_proyecto_existente() {
        var select = document.getElementById("select_existente");
        select.style.background = "#fff";
        select.style.color = "#000";
        select.style.border = " ";
    }

    function quitar_select_proyecto_nuevo() {
        var select = document.getElementById("select_nuevo");
        select.style.background = "#fff";
        select.style.color = "#000";
        select.style.border = " ";
    }
</script>









@stop

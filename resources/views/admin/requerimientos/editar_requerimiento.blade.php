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
        <h1> Detalles del Requerimiento de Transporte || Cod. {{ $requerimiento->id }}</h1>
    </div>
</div>

@include('errores')
<form method="POST" action="{{ route('actualizar_requerimiento') }}" autocomplete="nope" id="add_requerimientos"
    class="contenido " name="add_requerimientos">
    @csrf
    @include('notificacion')

    {{-- OCULTO --}}
    <?php $contador_t = count($transportes); ?>
    <?php $contador_c = count($cargas_reqs); ?>
    <input class="form-control" name="responsable_registro" id="responsable_registro" type="hidden"
        value="{{ auth()->user()->name }}" autocomplete="off" />
    <input class="form-control" name="contador_t" id="contador_t" type="hidden" value="<?php echo $contador_t; ?>" value="0"
        autocomplete="off" />



    <div class="row" style="margin-bottom:0px">
        <div class="col-md-3">
            <div class="form-group">
                <input type="hidden" name="id_requerimiento" value="{{ $requerimiento->id }}">
                <label class="control-label " style="font-weight:600;color:#777"> Registro de requerimiento:</label>
                <input class="form-control" type="text" id="fecha_registro" name="fecha_registro" disabled
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
                <input type="text" id="responsable_registro" class="form-control " name="responsable_registro"
                    style="font-weight:600;text-align:center" disabled
                    value="{{ $requerimiento->responsable_registro }}">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label" style="font-weight:600;color:#777"> Atendido por:</label>
                <input type="text" id="atendido" class="form-control " name="atendido"
                    style="font-weight:600;text-align:center" disabled value="">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">

                <label class="control-label" style="font-weight:600;color:#777"> Empresa:</label>

                @foreach ($clientes as $cliente)
                    @if ($cliente->id == $requerimiento->id_cliente)
                        <input type="hidden" id="buscador_cliente" class="form-control " name="id_cliente"
                            value="{{ $cliente->id }}">
                        <input type="text" id="empresa" class="form-control " name="empresa" style="font-weight:600"
                            value="Nombre: {{ $cliente->nombre }} || Ruc: {{ $cliente->dni_ruc }}" readonly>
                    @endif
                @endforeach
            </div>
        </div>
        <br>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label" style="font-weight:600;color:#777"> Contacto:</label>
                <input type="text" id="contacto" class="form-control " name="contacto" style="font-weight:600"
                    value="{{ $contacto->nombre }}" readonly>
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
                            <option value="{{ $departamento->departamento }}" selected>
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
                            <option value="{{ $departamento->departamento }}" selected>
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
                <input class="form-control" type="text" id="contacto_destino" name="contacto_destino"
                    style="font-weight:600;text-align:center" value="">
            </div>
        </div>

        <div class="col-md-12 ">
            <div class="form-group">
                <h6><b style="color:#777">Carga<b style="color:#B61A1A">(*)</b>:</b></h6>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <a class="form-control btn" name="add_carga_e" id="add_carga_e"
                    style="font-weight:700;font-size:14px;background:#ECDCC2;border-color:#777">Agregar Carga Nueva</a>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <a class="form-control btn" id="carga_existente" onclick="select_carga_existente();"
                    style="font-weight:700;font-size:14px;background:#ECDCC2;border-color:#777">Agregar Carga
                    Existente</a>
            </div>
        </div>

    </div>





    <div class="col-md-12 nueva_carga">
        <h5>Lista de Cargas:</h5>

        <input class="form-control" name="contador_c" id="contador_c" type="hidden" value="0" autocomplete="off" />

        <table class="table table-bordered" id="tabla_carga_e" style="border: 1px solid #123;background:#fff">

            <thead>
                <tr>
                    <td style="width:15%">Tipo de Carga<b style="color:#B61A1A">(*)</b>:</td>
                    <td style="width:10%">Marca</td>
                    <td style="width:10%">Modelo</td>
                    <td style="width:10%">Placa</td>
                    <td style="width:15%">Dimensiones<br>(Largo x Ancho x Alto)</td>
                    <td style="width:10%">Peso</td>
                    <td style="width:10%">Unidad Medida</td>
                    <td style="text-align:center;width:6%">Eliminar</td>
                </tr>
            </thead>
            <?php 

        for($j=0;$j<$contador_c;$j++){
     ?>
            <tr id="carga<?php echo $j; ?>" class="cargas">
                <td>
                    <input type="text" name="tipo_c[]" autocomplete="off" class="form-control"
                        style="background:#77777710" readonly value="{{ $cargas_reqs[$j]->tipo }}">
                    <input type="hidden" name="id_carga[]" autocomplete="off" class="form-control"
                        style="background:#77777710" readonly value="{{ $cargas_reqs[$j]->id }}">
                </td>

                <td>
                    <input type="text" name="marca_c[]" autocomplete="off" class="form-control"
                        style="background:#77777710" readonly value="{{ $cargas_reqs[$j]->marca }}">
                </td>

                <td>
                    <input type="text" name="modelo_c[]" autocomplete="off" class="form-control"
                        style="background:#77777710" readonly value="{{ $cargas_reqs[$j]->modelo }}">
                </td>

                <td>
                    <input type="text" name="placa_c[]" autocomplete="off" class="form-control"
                        style="background:#77777710" readonly value="{{ $cargas_reqs[$j]->placa }}">
                </td>

                <td>
                    <input type="text" name="volumen_c[]" autocomplete="off" class="form-control"
                        style="background:#77777710" readonly value="{{ $cargas_reqs[$j]->volumen }}">
                </td>
                <td>
                    <input type="text" name="peso_c[]" autocomplete="off" class="form-control"
                        style="background:#77777710" readonly value="{{ $cargas_reqs[$j]->peso }}">
                </td>

                <td>
                    <input type="text" name="medida_peso_c[]" autocomplete="off" class="form-control"
                        style="background:#77777710" readonly value="{{ $cargas_reqs[$j]->unidad_medida_peso }}">
                </td>

                <td style="text-align:center">
                    <button type="button" id="{{ $j }}" class="btn btn-danger btn_remove_data_c">X</button>
                </td>
            </tr>
            <?php }?>
        </table>
    </div>
    <br>
    <br>
    <br>

    <div class="col-md-12">
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
            <?php 
    
    
            for($j=0;$j<$contador_t;$j++){
         ?>
            <tr id="transporte<?php echo $j; ?>" class="transportes">
                <td>

                    <input type="hidden" name="id_transporte[]" id="id_transporte<?php echo $j; ?>" autocomplete="off"
                        class="form-control" style="background:#77777710" value="{{ $transportes[$j]->id }}">

                    <select name="tipo_transporte[]" class="form-control " id="tipo_t'+i+'"
                        style="background:#77777710" required>
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
                    <input type="text" name="cantidad_ejes[]" autocomplete="off" class="form-control"
                        style="background:#77777710" value="{{ $transportes[$j]->cantidad_ejes }}">
                </td>

                <td>
                    <input type="text" name="parte_carga[]" autocomplete="off" class="form-control"
                        style="background:#77777710" value="{{ $transportes[$j]->parte_carga }}">
                </td>

                <td style="text-align:center">
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
    </div>
    <div class="row" style="margin-bottom:5px">
        <div class="col-md-6">
            <div class="form-group">
                <h5>Observaciones:</h5>
                <textarea rows="6" class="form-control" name="observaciones"></textarea>
            </div>
        </div>
    </div>

    {{-- BOTONES --}}
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

    function valida_nueva_carga(j) {
        //tabla_carga_existente' + j + ' ES LA CLASE DE LOS INPUT OCULTOS CUANDO SE SELECCIONA AGREGAR CARGAR EXISTENTE
        $('.tabla_carga_existente' + j + '').removeClass('hidden');
        $('#buscador_carga_tabla' + j).addClass('hidden');
        var data_buscador = $('#buscador_carga_tabla' + j).val();
        console.log(data_buscador);
        const dataArray = data_buscador.split("__");
        console.log(dataArray[0]);
        $('#id_carga' + j).val(dataArray[0]);
        $('#tipo' + j).val(dataArray[1]);
        $('#marca' + j).val(dataArray[2]);
        $('#modelo' + j).val(dataArray[3]);
        $('#placa' + j).val(dataArray[4]);
        $('#peso' + j).val(dataArray[5]);
        $('#medida' + j).val(dataArray[6]);
        $('#volumen' + j).val(dataArray[7]);
    }

    function select_carga_existente() {

        var id_cliente = $('#buscador_cliente').val();
        // buscar_carga_cliente(id_cliente, j);
        $('#tabla_carga_e').append(

            '<tr id="carga_e' + j + '" class="cargas_e" >' +

            '<td>' +
            '<select class="form-control buscador_cargas required_cliente_existente"' +
            'onchange="valida_nueva_carga(' + j + ');" id="buscador_carga_tabla' + j +
            '" name="select  style="width:100%">' +
            '<option value="" disabled selected>Seleccionar</option>' +
            @foreach ($cargas as $carga)
                "<option value='{{ $carga->id }}__{{ $carga->tipo }}__{{ $carga->marca }}__{{ $carga->modelo }}__{{ $carga->placa }}__{{ $carga->peso }}__{{ $carga->unidad_medida_peso }}__{{ $carga->volumen }}'>📌TIPO: {{ $carga->tipo }} || MARCA: {{ $carga->marca }} || MODELO: {{ $carga->modelo }} || PLACA: {{ $carga->placa }} ||</option>" +
            @endforeach
            '</select>' +


            '<input readonly type="text"  id="tipo' + j + '" name="tipo_c[]" ' +
            'autocomplete="off" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"' +
            'class="form-control tabla_carga_existente' + j + ' hidden" style="background:#77777710">' +
            '<input readonly type="hidden"  id="id_carga' + j + '" name="id_carga[]" >' +
            '</td>' +

            '<td>' +
            '<input type="text" id="marca' + j + '"  name="marca_c[]" ' +
            'autocomplete="off" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" readonly' +
            ' class="form-control tabla_carga_existente' + j + ' hidden" style="background:#77777710" >' +
            '</td>' +

            '<td>' +
            '<input type="text" id="modelo' + j + '" name="modelo_c[]" ' +
            'autocomplete="off" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" readonly ' +
            'class="form-control tabla_carga_existente' + j + ' hidden" style="background:#77777710" >' +
            '</td>' +

            '<td>' +
            '<input type="text" id="placa' + j + '" name="placa_c[]" ' +
            'autocomplete="off" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" readonly ' +
            'class="form-control tabla_carga_existente' + j + ' hidden" style="background:#77777710" >' +
            '</td>' +

            '<td>' +
            '<input type="text" id="volumen' + j + '"  name="volumen_c[]" ' +
            'autocomplete="off" readonly style="text-transform:uppercase;"  onkeyup="javascript:this.value=this.value.toUpperCase();"' +
            ' class="form-control tabla_carga_existente' + j + ' hidden" style="background:#77777710" >' +
            '</td>' +

            '<td>' +
            '<input type="text" id="peso' + j + '"  name="peso_c[]" ' +
            'autocomplete="off" style="text-transform:uppercase;"  onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control tabla_carga_existente' +
            j +
            ' hidden" readonly  >' +
            '</td>' +

            '<td>' +
            '<input type="text" id="medida' + j + '"  name="medida_peso_c[]" ' +
            'autocomplete="off" readonly style="text-transform:uppercase;"  onkeyup="javascript:this.value=this.value.toUpperCase();"' +
            ' class="form-control tabla_carga_existente' + j + ' hidden" style="background:#77777710" >' +
            '</td>' +

            '<td style="text-align:center">' +
            '<button type="button" onclick="eliminar_fila(' + j +
            ')" class="btn btn-danger btn_remove_c">X</button>' +
            '</td>' +
            '</tr>'
        );
        j++;
    }
</script>

<script>
    function funciones_inicio() {
        $('#onload').fadeOut();
        $('.contenido').removeClass('hidden');


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
    window.onload = funciones_inicio();
</script>

<script>
    var j = $(".cargas_e").length;
    $(document).ready(function() {


        $('#add_carga_e').click(function() {

            $('#tabla_carga_e').append(

                '<tr id="carga_e' + j + '" class="cargas_e" >' +

                '<td>' +
                '<input type="hidden"  name="id_carga[]" autocomplete="off"  style="background:#77777710" value ="0">' +
                '<input type="text"  name="tipo_c[]" ' +
                'autocomplete="off" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" style="background:#77777710" required>' +
                '</td>' +

                '<td>' +
                '<input type="text"  name="marca_c[]" ' +
                'autocomplete="off" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" style="background:#77777710" >' +
                '</td>' +


                '<td>' +
                '<input type="text" name="modelo_c[]" ' +
                'autocomplete="off" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" style="background:#77777710" >' +
                '</td>' +

                '<td>' +
                '<input type="text" name="placa_c[]" ' +
                'autocomplete="off" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" style="background:#77777710" >' +
                '</td>' +

                '<td>' +
                '<input type="text"  name="volumen_c[]" ' +
                'autocomplete="off" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" style="background:#77777710" >' +
                '</td>' +

                '<td>' +
                '<input type="text"  name="peso_c[]" ' +
                'autocomplete="off" class="form-control" style="background:#77777710" >' +
                '</td>' +


                '<td>' +
                '<select name="medida_peso_c[]" class="form-control "' +
                '>' +
                '<option value="" selected disabled>Seleccionar</option>' +
                '<option value="TN">TN</option>' +
                '<option value="KG">KG</option>' +
                '</select>' +
                '</td>' +


                '<td style="text-align:center">' +
                '<button type="button" onclick="eliminar_fila(' + j +
                ')" class="btn btn-danger btn_remove_c">X</button>' +
                '</td>' +
                '</tr>'
            );
            j++;
            document.getElementById("contador_c").value++;
        });



    })

    function eliminar_fila(id) {
        if (!confirm("¿Estas seguro de eliminar esta carga?")) return;

        $('#carga_e' + id).remove();
        document.getElementById("contador_c").value--;

    }
</script>


{{-- <script>
    function buscar_carga_cliente(id_cliente, j) {
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
                var medida = datos["medida"];
                var volumen = datos["volumen"];
                // $('#buscador_carga_tabla').append('<option>' + tipo + '</option>');

                $('#buscador_carga_tabla' + j).empty();
                $('#buscador_carga_tabla' + j).append(
                    "<option value='' selected disabled> ✔ Seleccionar una Carga</option>");
                var z = 0;
                $.each(datos["tipo"], function(index, value) {
                    $('#buscador_carga_tabla' + j).append("<option value=" + id_carga[z] +
                        "__" + tipo[z] + "__" + marca[z] + "__" + modelo[z] + "__" + placa[z] +
                        "__" + peso[z] + "__" + medida[z] + "__" + volumen[z] + "__" + "> 📌 " +
                        tipo[z] + " || MARCA: " + marca[z] + " || MODELO: ; " + modelo[z] +
                        " || MEDIDA: " + volumen[z] +
                        " || PLACA: " + placa[z] + " || PESO: " + peso[z] + " || MEDIDA: " + medida[
                            z] + "</option>");
                    z++;

                })


            }).fail(function() {
                console.log("Hay un error")

            }).then(function(data) {
                console.log(data);
            });

        }
    }
</script> --}}
<script>
    $(document).on('click', '.btn_remove_data_c', function() {
        if (!confirm("¿Estas seguro de eliminar esta carga?")) return;

        var id_c = $(this).attr('id');
        var data_id_c = $('#id_carga' + id_c).val();
        lista_eliminados_c(data_id_c);
        $('#carga' + id_c).remove();
        document.getElementById("contador_c").value--;
    });
</script>
<script>
    let array_lista_c = [];

    function lista_eliminados_c(data) {

        array_lista_c.push(data);
        console.log(array_lista_c);
        $('#ids_eliminar_c').val(array_lista_c);

    }
</script>


@endsection

@section('css')

@include('admin.datatable')

@stop

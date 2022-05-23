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



<br>
<br>

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

    @foreach ($contactos as $contacto)
        @if (auth()->user()->id == $contacto->id_users)
            <input type="hidden" id="id_cliente" name="id_cliente" value="{{ $contacto->id_cliente }}">
            <input type="hidden" id="id_contacto" name="id_contacto" value="{{ $contacto->id }}">
        @endif
    @endforeach

    <input class="form-control" name="usuario" id="usuario" type="hidden" value="{{ auth()->user()->id }}">

    <h5> Fecha de Salida:<b style="color:#B61A1A;outline:none">(*)</b>:</h5>

    <input type="date" name="fecha_requerimiento" id="fecha_cotizacion" class="form-control fecha" style="width:200px"
        onchange="validar_fecha_cotizacion();" required>
    <br>
    <h5> Seleccionar Origen y Destino de la Carga:<b style="color:#B61A1A;outline:none">(*)</b>:</h5>
    <div class="row" style="margin-bottom:0px">

        <div class="col-md-12">

            <label class="control-label" style="font-weight:600;color:#777"><b>ORIGEN</b><b
                    style="color:#B61A1A">(*)</b>:</label>

        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="" class="control-label" style="margin-bottom:1px"><b>Departamento</b><b
                        style="color:#B61A1A">(*)</b>:</label>
                <select id="departamento_o" name="departamento_origen" class="form-control buscador_departamento"
                    style="width:100%" required>
                    <option value="" selected disabled>Seleccionar</option>
                    @foreach ($departamentos as $departamento)
                        <option value="{{ $departamento->id }}"
                            {{ old('departamento_origen') == "$departamento->id" ? 'selected' : '' }}>
                            {{ $departamento->departamento }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="" class="control-label" style="margin-bottom:1px"><b>Provincia</b></label>
                <select id="provincia_o" name="provincia_origen" class="form-control buscador_provincia"
                    style="width:100%">
                    <option value="" selected disabled>Seleccione un departamento</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="" class="control-label" style="margin-bottom:1px"><b>Distrito</b></label>
                <select id="distrito_o" name="distrito_origen" class="form-control buscador_distrito"
                    style="width:100%">
                    <option value="" selected disabled>Seleccione una provincia</option>
                </select>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label for="" class="control-label" style="margin-bottom:1px"><b>Direccion</b></label>
                <input type="text" class="form-control" name="direccion_origen" style="text-transform:uppercase;"
                    onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{ old('direccion_origen') }}"
                    placeholder="Direccion de origen"><br>
            </div>
        </div>


        <div class="col-md-12">

            <label class="control-label" style="font-weight:600;color:#777"><b>DESTINO</b><b
                    style="color:#B61A1A">(*)</b>:</label>

        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="" class="control-label" style="margin-bottom:1px"><b>Departamento</b><b
                        style="color:#B61A1A">(*)</b>:</label>
                <select id="departamento_d" name="departamento_destino" class="form-control buscador_departamento"
                    style="width:100%" required>
                    <option value="" selected disabled>Seleccionar</option>
                    @foreach ($departamentos as $departamento)
                        <option value="{{ $departamento->id }}"
                            {{ old('departamento_destino') == "$departamento->id" ? 'selected' : '' }}>
                            {{ $departamento->departamento }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="" class="control-label" style="margin-bottom:1px"><b>Provincia</b></label>
                <select id="provincia_d" name="provincia_destino" class="form-control buscador_provincia"
                    style="width:100%">
                    <option value="" selected disabled>Seleccione un departamento</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="" class="control-label" style="margin-bottom:1px"><b>Distrito</b></label>
                <select id="distrito_d" name="distrito_destino" class="form-control buscador_distrito"
                    style="width:100%">
                    <option value="" selected disabled>Seleccione una provincia</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="" class="control-label" style="margin-bottom:1px"><b>Direccion</b></label>
                <input type="text" class="form-control" name="direccion_destino" style="text-transform:uppercase;"
                    onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{ old('direccion_destino') }}"
                    placeholder="Direccion de destino"><br>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <h6><b style="color:#777">Carga<b style="color:#B61A1A">(*)</b>:</b></h6>

            </div>
        </div>

        <div class="col-md-3 select_carga">
            <div class="form-group">
                <a class="form-control btn" name="add_carga_e" id="add_carga_e" onclick="select_carga_nueva();"
                    style="font-weight:700;font-size:14px;background:#ECDCC2;border-color:#777">Agregar Carga Nueva</a>
            </div>
        </div>

        <div class="col-md-3 select_carga">
            <div class="form-group">
                <a class="form-control btn" id="carga_existente" onclick="select_carga_existente();"
                    style="font-weight:700;font-size:14px;background:#ECDCC2;border-color:#777">Agregar Carga
                    Existente</a>
            </div>
        </div>

        <div class="col-md-12 nueva_carga">
            <h5>Lista de Cargas<b style="color:#B61A1A">(*)</b>:</h5>
            <br>
            <input class="form-control" name="contador_c_e" id="contador_c_e" type="hidden" value="0"
                autocomplete="off" />
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
            </table>
        </div>
    </div>

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
    </table>

    <div class="col-md-3">
        <div class="form-group">
            <a class="btn btn-primary" name="add" id="add" style="margin-rigth:auto;width:180px;font-weight:700;
                        font-size:14px;background:#ECDCC2;border-color:#777">
                ++ Agregar Transporte</a>
        </div>
    </div>





    <input class="form-control" name="responsable_registro" id="responsable_registro" type="hidden" value="cliente"
        autocomplete="off" />

    <button type="submit" class="btn btn-primary btn-sm" style="background:#123;color:#fff;border-color:#777">
        <i class="fa fa-file-text"></i>Crear Requerimiento</button>


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
                '<option value="Camion Normal">Camion Normal</option>' +

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
</script>

<script>
    function select_carga_nueva() {
        $('.nueva_carga').removeClass('hidden');
    }
</script>
<script>
    var j = $(".cargas_e").length;
    $(document).ready(function() {


        $('#add_carga_e').click(function() {

            $('#tabla_carga_e').append(

                '<tr id="carga_e' + j + '" class="cargas_e" >' +

                '<td>' +
                '<input type="hidden" name="id_c_e[]" autocomplete="off"  style="background:#77777710" value ="0">' +
                '<input type="text"  name="tipo_c_e[]" ' +
                'autocomplete="off" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" style="background:#77777710" required>' +
                '</td>' +

                '<td>' +
                '<input type="text"  name="marca_c_e[]" ' +
                'autocomplete="off" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" style="background:#77777710" >' +
                '</td>' +


                '<td>' +
                '<input type="text" name="modelo_c_e[]" ' +
                'autocomplete="off" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" style="background:#77777710" >' +
                '</td>' +

                '<td>' +
                '<input type="text" name="placa_c_e[]" ' +
                'autocomplete="off" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" style="background:#77777710" >' +
                '</td>' +

                '<td>' +
                '<input type="text"  name="volumen_c_e[]" ' +
                'autocomplete="off" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" style="background:#77777710" >' +
                '</td>' +

                '<td>' +
                '<input type="text"  name="peso_c_e[]" ' +
                'autocomplete="off" class="form-control" style="background:#77777710" >' +
                '</td>' +


                '<td>' +
                '<select name="medida_peso_c_e[]" class="form-control "' +
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

            document.getElementById("contador_c_e").value++;

        });



    })

    function eliminar_fila(id) {
        if (!confirm("¿Estas seguro de eliminar esta carga?")) return;

        $('#carga_e' + id).remove();
        document.getElementById("contador_c_e").value--;

    }


    function valida_nueva_carga(j) {
        //tabla_carga_existente' + j + ' ES LA CLASE DE LOS INPUT OCULTOS CUANDO SE SELECCIONA AGREGAR CARGAR EXISTENTE
        $('.tabla_carga_existente' + j + '').removeClass('hidden');
        $('#buscador_carga_tabla' + j).addClass('hidden');
        var data_buscador = $('#buscador_carga_tabla' + j).val();
        const dataArray = data_buscador.split("__");
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
        $('.nueva_carga').removeClass('hidden');

        // $('#select').removeClass("hidden");
        // $('#carga_existente').addClass("hidden");
        // $('#div_carga_existente').removeClass("col-md-3");
        // $('#div_carga_existente').addClass("col-md-9");

        var id_cliente = document.getElementById("usuario").value;
        buscar_carga_cliente(id_cliente, j);
        $('#tabla_carga_e').append(

            '<tr id="carga_e' + j + '" class="cargas_e" >' +

            '<td>' +
            '<select class="form-control buscador_cargas required_cliente_existente"' +
            'onchange="valida_nueva_carga(' + j + ');" id="buscador_carga_tabla' + j +
            '" name="id_carga"  style="width:100%">' +
            '<option value="" disabled selected> ⌛ Cargando lista ...</option>' +
            '</select>' +


            '<input readonly type="text"  id="tipo' + j + '" name="tipo_c_e[]" ' +
            'autocomplete="off" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"' +
            'class="form-control tabla_carga_existente' + j + ' hidden" style="background:#77777710">' +
            '<input type="hidden" id="id_carga' + j +
            '" name="id_c_e[]" autocomplete="off"  style="background:#77777710" >' +
            '</td>' +

            '<td>' +
            '<input type="text" id="marca' + j + '"  name="marca_c_e[]" ' +
            'autocomplete="off" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" readonly' +
            ' class="form-control tabla_carga_existente' + j + ' hidden" style="background:#77777710" >' +
            '</td>' +

            '<td>' +
            '<input type="text" id="modelo' + j + '" name="modelo_c_e[]" ' +
            'autocomplete="off" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" readonly ' +
            'class="form-control tabla_carga_existente' + j + ' hidden" style="background:#77777710" >' +
            '</td>' +

            '<td>' +
            '<input type="text" id="placa' + j + '" name="placa_c_e[]" ' +
            'autocomplete="off" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" readonly ' +
            'class="form-control tabla_carga_existente' + j + ' hidden" style="background:#77777710" >' +
            '</td>' +

            '<td>' +
            '<input type="text" id="volumen' + j + '"  name="volumen_c_e[]" ' +
            'autocomplete="off" readonly style="text-transform:uppercase;"  onkeyup="javascript:this.value=this.value.toUpperCase();"' +
            ' class="form-control tabla_carga_existente' + j + ' hidden" style="background:#77777710" >' +
            '</td>' +

            '<td>' +
            '<input type="text" id="peso' + j + '"  name="peso_c_e[]" ' +
            'autocomplete="off" style="text-transform:uppercase;"  onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control tabla_carga_existente' +
            j +
            ' hidden" readonly  >' +
            '</td>' +

            '<td>' +
            '<input type="text" id="medida' + j + '"  name="medida_peso_c_e[]" ' +
            'autocomplete="off" style="text-transform:uppercase;" readonly  onkeyup="javascript:this.value=this.value.toUpperCase();"' +
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
    function buscar_carga_cliente(id_cliente, j) {
        if ($.trim(id_cliente) != '') {
            $.get('../consulta_cargas_cliente', {
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
                // console.log("Hay un error")
            }).then(function(data) {
                //console.log(data);
            });

        }

    }
</script>



<script>
    //SCRIPT PARA PROVINCIAS
    $(document).ready(function() {
        $('#departamento_o').on('change', function() {
            var id_departamento = $(this).val();
            if ($.trim(id_departamento) != '') {
                $.get('../provincias', {
                    id_departamento: id_departamento
                }, function(provincias) {
                    $('#provincia_o').empty();
                    $('#distrito_o').empty();
                    $('#provincia_o').append(
                        "<option value=''> ✔ Selecciona una provincia</option>");
                    $('#distrito_o').append(
                        "<option value=''> ⌛ Selecciona una provincia</option>");
                    $.each(provincias, function(index, value) {
                        $('#provincia_o').append("<option value='" + index + "'>" +
                            value + "</option>");
                    })
                });
            }
        });

    });
</script>


<script>
    //SCRIPT PARA DISTRITOS
    $(document).ready(function() {

        $('#provincia_o').on('change', function() {
            console.log("xd");
            var id_provincia = $(this).val();
            if ($.trim(id_provincia) != '') {
                $.get('../distritos', {
                    id_provincia: id_provincia
                }, function(distritos) {
                    $('#distrito_o').empty();
                    $('#distrito_o').append(
                        "<option value=''> ✔ Selecciona un distrito</option>");
                    $.each(distritos, function(index, value) {
                        $('#distrito_o').append("<option value='" + index + "'>" +
                            value +
                            "</option>");
                    })
                });
            }
        });
    });
</script>
<script>
    //SCRIPT PARA PROVINCIAS
    $(document).ready(function() {
        $('#departamento_d').on('change', function() {
            var id_departamento = $(this).val();
            if ($.trim(id_departamento) != '') {
                $.get('../provincias', {
                    id_departamento: id_departamento
                }, function(provincias) {
                    $('#provincia_d').empty();
                    $('#distrito_d').empty();
                    $('#provincia_d').append(
                        "<option value=''> ✔ Selecciona una provincia</option>");
                    $('#distrito_d').append(
                        "<option value=''> ⌛ Selecciona una provincia</option>");
                    $.each(provincias, function(index, value) {
                        $('#provincia_d').append("<option value='" + index + "'>" +
                            value + "</option>");
                    })
                });
            }
        });

    });
</script>


<script>
    //SCRIPT PARA DISTRITOS
    $(document).ready(function() {

        $('#provincia_d').on('change', function() {
            console.log("xd");
            var id_provincia = $(this).val();
            if ($.trim(id_provincia) != '') {
                $.get('../distritos', {
                    id_provincia: id_provincia
                }, function(distritos) {
                    $('#distrito_d').empty();
                    $('#distrito_d').append(
                        "<option value=''> ✔ Selecciona un distrito</option>");
                    $.each(distritos, function(index, value) {
                        $('#distrito_d').append("<option value='" + index + "'>" +
                            value +
                            "</option>");
                    })
                });
            }
        });
    });
</script>



@endsection

@section('css')
@include('admin.datatable')
@stop

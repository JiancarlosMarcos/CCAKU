@extends('adminlte::page')

@section('content')
@section('titulo', 'Editar Transportista')
<style>
    .validar_placa {
        background: transparent;
        border: 0px solid transparent;
        color: #be1e37;
        margin-top: -50px
    }

</style>
<br>
<br>
<div class="app-title centrar-title">
    <div>
        <a href="{{ route('transportistas') }}" class="btn btn-primary"
            style="background:#777;border-color:#777;color:#fff">Transportistas</a>
        <a href="{{ route('transportistas.contactos.mostrar') }}" class="btn btn-primary "
            style="color:#777;background:#fff;border-color:#777">Contactos de Transportistas</a>
        <a href="{{ route('vehiculos') }}" class="btn btn-primary "
            style="color:#777;background:#fff;border-color:#777">Transportes</a>


        <p></p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="{{ route('vehiculos') }}">Transportistas</a></li>
        <li class="breadcrumb-item"><a href=""> Editar Transportista</a></li>
    </ul>
</div>
<!---->
<form method="POST" action="{{ route('actualizar_transportista') }}" class="centrar-form">
    @csrf
    @include('notificacion')
    <div class="form-card" style="color:#000">
        <h4>Datos de la Empresa</h4>

        <div class="row">

            <div class="col-md-3">
                <div class="form-group">
                    <!--ID DE EMPRESA OCULTO-->
                    <input class="form-control" name="id" type="hidden" value="{{ $empresa->id }}">
                    <label class="control-label" style="font-weight:600;color:#777">RUC O DNI: <a
                            style="color:#B61A1A">*</a></label>
                    <input class="form-control" name="dni_ruc" type="number" value="{{ $empresa->dni_ruc }}"
                        autocomplete="off" placeholder="RUC O DNI" required />
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label" style="font-weight:600;color:#777">NOMBRE: <a
                            style="color:#B61A1A">*</a></label>
                    <input class="form-control" name="razon_social" type="text" value="{{ $empresa->nombre }}"
                        autocomplete="off" placeholder="Nombre de la empresa" required />
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label" style="font-weight:600;color:#777">DIRECCION: <a
                            style="color:#B61A1A"></a></label>
                    <input class="form-control" name="direccion" type="text" value="{{ $empresa->direccion }}"
                        autocomplete="off" placeholder="Direccion de la empresa" />
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label" style="font-weight:600;color:#777">PAGINA WEB: <a
                            style="color:#B61A1A"></a></label>
                    <input class="form-control" name="pagina_web" type="text" value="{{ $empresa->pagina_web }}"
                        autocomplete="off" placeholder="Pagina web" />
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label" style="font-weight:600;color:#777">TIPO TRANSPORTISTA: <a
                            style="color:#B61A1A"></a></label>
                    <select class="form-control" name="tipo_transportista">
                        <option value="{{ $empresa->tipo_transportista }}" disabled selected>
                            @if ($empresa->tipo_transportista == null)
                                {{ 'Seleccione' }}
                            @else
                                {{ $empresa->tipo_transportista }}
                            @endif
                        </option>
                        <option value="Propietario">Propietario</option>
                        <option value="Terciarizador">Terciarizador</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!----><br>
    <h4>Datos de Contacto</h4>
    <div class="row">
        <!--OCULTO-->
        <?php $contador = count($contactos); ?>
        <?php $contador_t = count($transportes); ?>
        <input class="form-control" name="contador" id="contador" type="hidden" value="<?php echo $contador; ?>" value="0"
            autocomplete="off" />
        <input class="form-control" name="contador_t" id="contador_t" type="hidden" value="<?php echo $contador_t; ?>"
            value="0" autocomplete="off" />
        <input class="form-control" name="usuario" id="usuario" type="hidden" value="{{ auth()->user()->name }}"
            autocomplete="off" />
        <!---->
    </div>



    <input type="hidden" name="ids_eliminar" id="ids_eliminar">
    <table class="table table-bordered" id="dynamic_field" style="border: 1px solid #123;background:#fff">

        <thead>
            <tr>
                <td>Nombres</td>
                <td>Dni</td>
                <td>Celular</td>
                <td>Cargo</td>
                <td>Correo</td>
                <td style="text-align:center">Eliminar</td>
            </tr>
        </thead>
        <?php 


        for($i=0;$i<$contador;$i++){
     ?>
        <tr id="row<?php echo $i; ?>" class="contactos">
            <td>
                <input type="text" name="nombre_contacto[]" id="nombre_contacto'+i+'" autocomplete="off"
                    class="form-control" style="background:#77777710" value="{{ $contactos[$i]->nombre }}">

                <input type="hidden" name="id_contacto[]" id="id_contacto<?php echo $i; ?>" autocomplete="off"
                    class="form-control" style="background:#77777710" value="{{ $contactos[$i]->id }}">
            </td>

            <td>
                <input type="text" name="dni[]" autocomplete="off" class="form-control" style="background:#77777710"
                    value="{{ $contactos[$i]->dni }}">
            </td>

            <td>
                <input type="text" name="celular[]" autocomplete="off" class="form-control"
                    style="background:#77777710" value="{{ $contactos[$i]->celular }}">
            </td>

            <td>
                <input type="text" name="cargo[]" autocomplete="off" class="form-control" style="background:#77777710"
                    value="{{ $contactos[$i]->cargo }}">
            </td>

            <td>
                <input type="text" name="correo[]" autocomplete="off" class="form-control"
                    style="background:#77777710" value="{{ $contactos[$i]->correo }}">
            </td>

            <td style="text-align:center">
                <button type="button" id="{{ $i }}" class="btn btn-danger btn_remove_data">X</button>
            </td>
        </tr>
        <?php }?>


    </table>


    <div class="col-md-3">
        <div class="form-group">
            <a class="btn btn-primary" name="add" id="add" style="margin-rigth:auto;width:180px;font-weight:700;
            font-size:14px;background:#ECDCC2;border-color:#777">
                ++ Agregar Contacto </a>
        </div>
    </div>

    <!--TABLA EQUIPOS DE TRANSPORTE--><br>
    <h4>Datos de Transporte</h4>
    <div class="row">
        <input type="hidden" name="ids_eliminar_t" id="ids_eliminar_t">
        <table class="table table-bordered" id="tabla_transporte" style="border: 1px solid #123;background:#fff">

            <thead>
                <tr>
                    <td style="width:10%">Tipo Transporte</td>
                    <td style="width:8%">Marca</td>
                    <td style="width:8%">Modelo</td>
                    <td style="width:7%">Placa</td>
                    <td style="width:4%">Cant. Ejes</td>
                    <td style="width:8%">Capacidad</td>
                    <td style="width:12%">Dimensiones</td>
                    <td style="width:5%">Año</td>
                    <td style="width:12%">Ubicacion</td>
                    <td style="width:12%">Estado</td>

                    <td style="text-align:center;width:6%">Eliminar</td>
                </tr>
            </thead>
            <?php 


        for($j=0;$j<$contador_t;$j++){
     ?>
            <tr id="transporte<?php echo $j; ?>" class="transportes">
                <td>
                    {{-- <input type="text" autocomplete="off" class="form-control" style="background:#77777710"
                        value="{{ $transportes[$j]->tipo }}"> --}}


                    <input type="hidden" name="id_transporte[]" id="id_transporte<?php echo $j; ?>"
                        autocomplete="off" class="form-control" style="background:#77777710"
                        value="{{ $transportes[$j]->id }}">

                    <select name="tipo_t[]" class="form-control " id="tipo_t'+i+'" style="background:#77777710"
                        required>
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
                    <input type="text" name="marca_t[]" autocomplete="off" class="form-control"
                        style="background:#77777710" value="{{ $transportes[$j]->marca }}">
                </td>

                <td>
                    <input type="text" name="modelo_t[]" autocomplete="off" class="form-control"
                        style="background:#77777710" value="{{ $transportes[$j]->modelo }}">
                </td>

                <td>
                    <input type="text" id="placa_t{{ $j }}" name="placa_t[]" autocomplete="off"
                        class="form-control" style="background:#77777710" style="text-transform:uppercase;"
                        onkeyup="validar_transporte({{ $j }})" value="{{ $transportes[$j]->placa }}">
                    <input type="text" disabled value="" class="validar_placa" id="valida_placa{{ $j }}">
                </td>

                <td>
                    <input type="text" name="ejes_t[]" autocomplete="off" class="form-control"
                        style="background:#77777710" value="{{ $transportes[$j]->cantidad_ejes }}">
                </td>
                <td>
                    <input type="text" name="capacidad_t[]" autocomplete="off" class="form-control"
                        style="background:#77777710" value="{{ $transportes[$j]->capacidad }}">
                </td>

                <td>
                    <input type="text" name="volumen_t[]" autocomplete="off" class="form-control"
                        style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"
                        style="background:#77777710" value="{{ $transportes[$j]->volumen }}">
                </td>

                <td>
                    <input type="text" name="anio_t[]" autocomplete="off" class="form-control"
                        style="background:#77777710" value="{{ $transportes[$j]->anio }}">
                </td>

                <td>
                    <select name="id_ubicacion_t[]" class="form-control " style="background:#77777710">
                        @foreach ($ubicaciones as $ubicacion)
                            @if ($ubicacion->id == $transportes[$j]->id_ubicacion)
                                <option value="{{ $ubicacion->id }}">{{ $ubicacion->departamento }}
                                </option>
                                @foreach ($ubicaciones as $ubicacion)
                                    <option value="{{ $ubicacion->id }}">
                                        {{ $ubicacion->departamento }}</option>
                                @endforeach
                            @endif
                        @endforeach
                    </select>
                </td>

                <td>

                    <select name="estado_t[]" class="form-control " style="background:#77777710">
                        <option value="{{ $transportes[$j]->estado }}">
                            {{ $transportes[$j]->estado }}</option>
                        <option value="DISPONIBLE">DISPONIBLE</option>
                        <option value="NO DISPONIBLE">NO DISPONIBLE</option>

                    </select>
                </td>



                {{-- <td>
                <input type="text" name="anio_t[]" autocomplete="off" class="form-control"
                    style="background:#77777710" value="{{ $contactos[$i]->anio_t }}">
            </td> --}}
                <td>
                    <button type="button" id="{{ $j }}" class="btn btn-danger btn_remove_data_t">X</button>

                </td>
            </tr>
            <?php }?>
        </table>

        <div class="col-md-2">
            <div class="form-group">
                <a class="btn btn-primary" name="add_transporte" id="add_transporte" style="margin-rigth:auto;width:100%;font-weight:700;
     font-size:14px;background:#ECDCC2;border-color:#777">
                    ++ Agregar Equipo de Transporte </a>
            </div>
        </div>
    </div>


    <div class="col-md-12" style="text-align:center">
        <div class="form-group">
            <button class="btn btn-primary" id="btn_actualizar" type="Submit"> <i class="fa fa-refresh"></i>Actualizar
            </button>
        </div>
    </div>
    </div>
</form>

<script>
    $(document).on('click', '.btn_remove_data', function() {
        if (!confirm("¿Estas seguro de eliminar este contacto?")) return;

        var id = $(this).attr('id');
        var data_id = $('#id_contacto' + id).val();
        lista_eliminados(data_id);
        $('#row' + id).remove();
        document.getElementById("contador").value--;
    });
</script>
<script>
    $(document).on('click', '.btn_remove_data_t', function() {
        if (!confirm("¿Estas seguro de eliminar este transporte?")) return;

        var id_t = $(this).attr('id');
        var data_id_t = $('#id_transporte' + id_t).val();
        lista_eliminados_t(data_id_t);
        $('#transporte' + id_t).remove();
        document.getElementById("contador_t").value--;
    });
</script>
<script>
    $(document).ready(function() {
        var i = $(".contactos").length;

        $('#add').click(function() {

            $('#dynamic_field').append(

                '<tr id="row' + i + '" class="contactos">' +

                '<td>' +
                '<input type="text" name="nombre_contacto[]" required id="nombre_contacto' + i +
                '" ' +
                'autocomplete="off" class="form-control" style="background:#77777710" >' +
                '</td>' +

                '<td>' +
                '<input type="text"  name="dni[]" ' +
                'autocomplete="off" class="form-control" style="background:#77777710" >' +
                '</td>' +

                '<td>' +
                '<input type="text"  name="celular[]" ' +
                'autocomplete="off" class="form-control" style="background:#77777710" >' +
                '</td>' +

                '<td>' +
                '<input type="text" name="cargo[]" ' +
                'autocomplete="off" class="form-control" style="background:#77777710" >' +
                '</td>' +

                '<td>' +
                '<input type="text" name="correo[]" ' +
                'autocomplete="off" class="form-control" style="background:#77777710" >' +
                '</td>' +

                '<td style="text-align:center">' +
                '<button type="button" onclick="eliminar_fila(' + i +
                ')" id="' + i +
                '" class="btn btn-danger">X</button>' +
                '</td>' +
                '</tr>'
            );
            i++;
            //PasarValores();
            //LimpiarForm();
            document.getElementById("contador").value++;


        });
        $(document).on('click', '.btn_remove', function() {
            if (!confirm("¿Estas seguro de eliminar este contacto?")) return;
            var id = $(this).attr('id');
            $('#row' + id).remove();
            document.getElementById("contador").value--;
        });
    })

    function eliminar_fila(id) {
        if (!confirm("¿Estas seguro de eliminar este contacto?")) return;

        $('#row' + id).remove();
        document.getElementById("contador").value--;

    }
</script>

<script>
    $(document).ready(function() {
        var j = $(".transportes").length;

        $('#add_transporte').click(function() {

            $('#tabla_transporte').append(

                '<tr id="transporte' + j + '" class="transportes">' +

                '<td>' +
                '<select name="tipo_t[]" class="form-control " id="tipo_t' + j + '" ' +
                ' required >' +
                '<option value="" selected disabled>Seleccionar</option>' +
                '<option value="Camion Plataforma">Camion Plataforma</option>' +
                '<option value="Camion Rebatible">Camion Rebatible</option>' +
                '<option value="Camion Normal">Camion Normal</option>' +
                '<option value="Camacuna">Camacuna</option>' +
                '<option value="Camabaja">Camabaja</option>' +
                '<option value="Tracto">Tracto</option>' +
                '<option value="Modulares">Modulares</option>' +
                '</select>' +
                '</td>' +

                '<td>' +
                '<input type="text"  name="marca_t[]" ' +
                'autocomplete="off" class="form-control" style="background:#77777710" >' +
                '</td>' +


                '<td>' +
                '<input type="text" name="modelo_t[]" ' +
                'autocomplete="off" class="form-control" style="background:#77777710" >' +
                '</td>' +

                '<td>' +
                '<input type="text" id="placa_t' + j + '" name="placa_t[]" ' +
                'autocomplete="off" onkeyup="validar_transporte(' + j +
                ')" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" style="background:#77777710" >' +
                '<input type="text" disabled value="" class="validar_placa" id="valida_placa' + j +
                '">' +

                '<td>' +
                '<input type="text"  name="ejes_t[]" ' +
                'autocomplete="off" class="form-control" style="background:#77777710" >' +
                '</td>' +

                '<td>' +
                '<input type="text"  name="capacidad_t[]" ' +
                'autocomplete="off" class="form-control" style="background:#77777710" >' +
                '</td>' +

                '<td>' +
                '<input type="text"  name="volumen_t[]" ' +
                'autocomplete="off" class="form-control" style="background:#77777710" >' +
                '</td>' +

                '<td>' +
                '<input type="text"  name="anio_t[]" ' +
                'autocomplete="off" class="form-control" style="background:#77777710" >' +
                '</td>' +

                '<td>' +
                '<select name="id_ubicacion_t[]" required  class="form-control " >' +
                '<option value="" selected disabled>Seleccionar Ubicacion</option>' +
                @foreach ($ubicaciones as $ubicacion)
                    '<option value="{{ $ubicacion->id }}">{{ $ubicacion->departamento }}</option>' +
                @endforeach
                '</select>' +
                '</td>' +


                '<td>' +
                '<select name="estado_t[]" required class="form-control " >' +
                '<option value="" selected disabled>Seleccionar</option>' +
                '<option value="DISPONIBLE">DISPONIBLE</option>' +
                '<option value="NO DISPONIBLE">NO DISPONIBLE</option>' +
                '</select>' +
                '</td>' +


                '<td style="text-align:center">' +
                '<button type="button" onclick="eliminar_fila_t(' + j +
                ')" id="' + j +
                '" class="btn btn-danger ">X</button>' +
                '</td>' +
                '</tr>'
            );
            j++;

            document.getElementById("contador_t").value++;

        });

    })

    function eliminar_fila_t(id) {
        if (!confirm("¿Estas seguro de eliminar este transporte?")) return;

        $('#transporte' + id).remove();
        document.getElementById("contador_t").value--;

    }
</script>
<script>
    let array_lista = [];

    function lista_eliminados(data) {
        array_lista.push(data);
        console.log(array_lista);
        $('#ids_eliminar').val(array_lista);

    }
</script>
<script>
    let array_lista_t = [];

    function lista_eliminados_t(data) {

        array_lista_t.push(data);
        console.log(array_lista_t);
        $('#ids_eliminar_t').val(array_lista_t);

    }

    function validar_transporte(j) {

        var placa = document.getElementById('placa_t' + j).value;
        if ($.trim(placa) != '') {
            $.get('../../consulta_transporte', {
                placa: placa
            }, function(transportes) {

                var data_tipo_transporte = transportes["tipo_transporte"];
                var data_placa_transporte = transportes["placa_transporte"];


                $.each(transportes, function(index, value) {
                    $('#valida_placa' + j).css("color", "#be1e37");
                    $('#valida_placa' + j).val("Placa ya registrada");
                    $('#btn_actualizar').prop('disabled', true);

                })

            }).fail(function() {

                $('#valida_placa' + j).css("color", "#35993A");
                $('#valida_placa' + j).val("Placa no registrada");

                $('#btn_actualizar').prop('disabled', false);

            }).then(function(data) {
                // console.log(data);
                // console.log("--__" + data[0]);

            });

        }


    }
</script>

@endsection
@section('css')
@include('admin.datatable')
@stop

@extends('adminlte::page')
@section('content_header')
    <br>
    <div class="app-title centrar-title">
        <div>
            <a href="{{ route('transportista.vehiculos') }}" class="btn btn-primary "
                style="color:#777;background:#fff;border-color:#777">Lista de Transportes</a>
            <a href="{{ route('transportista.contactos.mostrar') }}" class="btn btn-primary "
                style="color:#777;background:#fff;border-color:#777">Lista de Contactos</a>
            <a href="{{ route('transportista.editar_transportista', $empresa->id) }}" class="btn btn-primary "
                style="background:#777;border-color:#777">Agregar/Modificar Equipos</a>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a>Mi Empresa</a></li>
            <li class="breadcrumb-item"><a>Agregar/Modificar</a></li>
        </ul>
    </div>
@stop
@section('content')
@section('titulo', 'Editar Transportista')
<style>
    .validar_placa {
        background: transparent;
        border: 0px solid transparent;
        color: #be1e37;
        margin-top: -50px
    }

    .tooltip.top .tiptext {
        margin-left: -60px;
        bottom: 150%;
        left: 50%;
    }

    .tooltip.top .tiptext::after {
        margin-left: -5px;
        top: 100%;
        left: 50%;
        border-color: #2E2E2E transparent transparent transparent;
    }

    .modalContainer {
        display: none;
        position: fixed;
        z-index: 1;
        padding-top: 100px;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgb(0, 0, 0);
        background-color: rgba(0, 0, 0, 0.4);
    }

    .modalContainer .modal-content {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid lightgray;
        border-top: 10px solid #cf8d13;
        width: 60%;
    }

    .modalContainer .close {
        color: #aaaaaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .modalContainer .close:hover,
    .modalContainer .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
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
<!---->
<form method="POST" action="{{ route('transportista.actualizar_transportista') }}" class="centrar-form"
    enctype="multipart/form-data">
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
                        autocomplete="off" placeholder="RUC O DNI" required readonly />
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label" style="font-weight:600;color:#777">NOMBRE: <a
                            style="color:#B61A1A">*</a></label>
                    <input class="form-control" name="razon_social" type="text" value="{{ $empresa->nombre }}"
                        autocomplete="off" placeholder="Nombre de la empresa" required readonly />
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
        </div>
    </div>

    <!----><br>
    <div class="row">
        <!--OCULTO-->
        <?php $contador = count($contactos); ?>
        <?php $contador_t = count($transportes); ?>
        <input class="form-control" name="contador" id="contador" type="hidden" value="<?php echo $contador; ?>" value="0"
            autocomplete="off" />
        <input class="form-control" name="contador_t" id="contador_t" type="hidden" value="<?php echo $contador_t; ?>"
            value="0" autocomplete="off" />
        <input class="form-control" name="usuario" id="usuario" type="hidden" value="{{ auth()->user()->id }}"
            autocomplete="off" />
        <!---->
    </div>



    <!--TABLA EQUIPOS DE TRANSPORTE--><br>
    <h4>Datos de Transporte</h4>
    <div class="row">
        <input type="hidden" name="ids_eliminar_t" id="ids_eliminar_t">
        <table class="table table-bordered" id="tabla_transporte" style="border: 1px solid #123;background:#fff">

            <thead>
                <tr>
                    <td style="width:12%">Tipo Transporte</td>
                    <td style="width:8%">Marca</td>
                    <td style="width:8%">Modelo</td>
                    <td style="width:8%">Placa</td>
                    <td style="width:4%">Cant. Ejes</td>
                    <td style="width:6%">Capacidad</td>
                    <td style="width:8%">Dimensiones<br>(Largo x Ancho x Alto) Metros</td>
                    <td style="width:5%">Año</td>
                    <td style="width:10%">Ubicacion</td>
                    <td style="width:10%">Estado <i class="fa-solid fa-circle-question" data-toggle="tooltip"
                            data-original-title="En caso el transporte ya no existe o fue vendido, DAR DE BAJA al vehiculo"></i>
                    </td>
                    <td style="width:10%">Propio/Subarrendado</td>
                    <td style="text-align:center;width:4%">Eliminar</td>
                </tr>
            </thead>
            <?php 
        $img=1;
        for($j=0;$j<$contador_t;$j++){
     ?>
            <tr id="transporte<?php echo $j; ?>" class="transportes">
                <td style="display:flex;">
                    {{-- <input type="text" autocomplete="off" class="form-control" style="background:#77777710"
                        value="{{ $transportes[$j]->tipo }}"> --}}


                    <input type="hidden" name="id_transporte[]" id="id_transporte<?php echo $j; ?>" autocomplete="off"
                        class="form-control" style="background:#77777710" value="{{ $transportes[$j]->id }}">

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
                    <a id="btnModal" onclick="abrirModal({{ $j }})" href="#"><i style="font-size: 2rem"
                            class="fa-solid fa-image"></i></a>
                    <div id="myModal<?php echo $j; ?>" class="modalContainer">
                        <div class="modal-content">
                            <span class="close">×</span>
                            <h2>Imagenes de {{ $transportes[$j]->tipo }}</h2>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="fieldlabels">Cargar imagen :</label>
                                    <input type="file" name="imagen{{ $j }}" accept="image/*"
                                        id="image<?php echo $img; ?>" />
                                </div>
                            </div>

                        </div>
                    </div>
                </td>

                <td>
                    <input type="text" name="marca_t[]" autocomplete="off" class="form-control"
                        style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"
                        style="background:#77777710" value="{{ $transportes[$j]->marca }}">
                </td>

                <td>
                    <input type="text" name="modelo_t[]" autocomplete="off" class="form-control"
                        style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"
                        style="background:#77777710" value="{{ $transportes[$j]->modelo }}">
                </td>

                <td>
                    <input type="text" id="placa_t{{ $j }}" name="placa_t[]" autocomplete="off"
                        class="form-control" style="background:#77777710" style="text-transform:uppercase;"
                        onkeyup="validar_transporte({{ $j }});javascript:this.value=this.value.toUpperCase();"
                        value="{{ $transportes[$j]->placa }}">
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

                    <select name="estado_t[]" id="estado_t{{ $j }}" class="form-control "
                        style="background:#77777710" onchange="mostrar_detalles({{ $j }})">
                        <option value="{{ $transportes[$j]->estado }}">
                            {{ $transportes[$j]->estado }}</option>
                        <option value="DISPONIBLE">DISPONIBLE</option>
                        <option value="NO DISPONIBLE">NO DISPONIBLE</option>
                        <option value="DADO DE BAJA">DADO DE BAJA</option>
                    </select>
                    <label id="label{{ $j }}" hidden>Motivo:</label>
                    <input type="text" id="input{{ $j }}" name="observaciones_t[]" class="form-control"
                        style="background-color: #ec3939;color:white" hidden>
                </td>

                <td>
                    <select name="tipo_transporte[]" class="form-control " style="background:#77777710">
                        <option value="{{ $transportes[$j]->tipo_transporte }}">
                            {{ $transportes[$j]->tipo_transporte }}</option>
                        <option value="PROPIO">PROPIO</option>
                        <option value="SUBARRENDADO">SUBARRENDADO</option>

                    </select>
                </td>


                <td style="text-align:center">
                    <button type="button" id="{{ $j }}" class="btn btn-danger btn_remove_data_t"
                        disabled>X</button>

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
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip({
            placement: 'top'
        });
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
                '<input type="text"  name="marca_t[]" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"' +
                'autocomplete="off" class="form-control" style="background:#77777710" >' +
                '</td>' +


                '<td>' +
                '<input type="text" name="modelo_t[]" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"' +
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
                '<input type="text"  name="volumen_t[]" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"' +
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

                '<td>' +
                '<select name="tipo_transporte[]" required class="form-control " >' +
                '<option value="" selected disabled>Seleccionar</option>' +
                '<option value="PROPIO">PROPIO</option>' +
                '<option value="SUBARRENDADO">SUBARRENADO</option>' +
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

                })

            }).fail(function() {

                $('#valida_placa' + j).css("color", "#35993A");
                $('#valida_placa' + j).val("Placa no registrada");

            }).then(function(data) {
                // console.log(data);
                // console.log("--__" + data[0]);

            });

        }


    }
</script>
<script>
    window.onload = function() {
        $('#onload').fadeOut();
        $('.contenido').removeClass('hidden');
    }
</script>
<script>
    function mostrar_detalles(j) {
        var estado = document.getElementById("estado_t" + j).value;
        console.log(estado);
        if (estado == "DADO DE BAJA") {
            $('#label' + j).attr('hidden', false);
            $('#input' + j).attr('hidden', false);
        } else {
            $('#label' + j).attr('hidden', true);
            $('#input' + j).attr('hidden', true);
        }
    }
</script>


<script>
    function abrirModal(j) {
        var modal = document.getElementById("myModal" + j);
        var span = document.getElementsByClassName("close")[j];
        var body = document.getElementsByTagName("body")[0];


        modal.style.display = "block";
        body.style.position = "static";
        body.style.height = "100%";
        body.style.overflow = "hidden";

        span.onclick = function() {
            modal.style.display = "none";
            body.style.position = "inherit";
            body.style.height = "auto";
            body.style.overflow = "visible";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";

                body.style.position = "inherit";
                body.style.height = "auto";
                body.style.overflow = "visible";
            }
        }
    }

    function vista_previa(index) {
        $('#image' + index).change(function(e) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#showImage' + index).attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });


    }
</script>
@endsection
@section('css')
@include('admin.datatable')
@stop

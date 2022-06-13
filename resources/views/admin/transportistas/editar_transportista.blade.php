@extends('adminlte::page')
@section('content_header')
    <br>
    <div class="app-title centrar-title">
        <div>
            <a href="{{ route('transportistas') }}" class="btn btn-primary"
                style="color:#777;background:#fff;border-color:#777">Transportistas</a>
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
        height: 90%;
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
<script type="text/javascript">
    function vista_previa(j, img) {
        $('#image' + j + img).change(function(e) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#showImage' + j + img).attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    }
</script>
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
<form method="POST" action="{{ route('actualizar_transportista') }}" class="centrar-form"
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
                    <input class="form-control" name="dni_ruc" type="number" maxlength="11"
                        oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                        value="{{ $empresa->dni_ruc }}" autocomplete="off" placeholder="RUC O DNI" required />
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
        <input class="form-control" name="usuario" id="usuario" type="hidden" value="{{ auth()->user()->id }}"
            autocomplete="off" />
        <!---->
    </div>

    <div class="row" style="overflow-x: auto; overflow-y: hidden;">

        <input type="hidden" name="ids_eliminar" id="ids_eliminar">
        <table class="table table-bordered" id="dynamic_field" style="border: 1px solid #123;background:#fff">

            <thead>
                <tr>
                    <td>Nombres<b style="color:#B61A1A;outline:none">(*)</b></td>
                    <td>Dni</td>
                    <td>Celular<b style="color:#B61A1A;outline:none">(*)</b></td>
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
                        style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"
                        class="form-control" style="background:#77777710" value="{{ $contactos[$i]->nombre }}"
                        required>

                    <input type="hidden" name="id_contacto[]" id="id_contacto<?php echo $i; ?>" autocomplete="off"
                        class="form-control" style="background:#77777710" value="{{ $contactos[$i]->id }}">
                </td>

                <td>
                    <input type="number" name="dni[]" autocomplete="off" class="form-control"
                        style="background:#77777710" maxlength="8"
                        oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                        value="{{ $contactos[$i]->dni }}">
                </td>

                <td>
                    <input type="number" name="celular[]" autocomplete="off" class="form-control"
                        style="background:#77777710" value="{{ $contactos[$i]->celular }}" required>
                </td>

                <td>
                    <input type="text" name="cargo[]" autocomplete="off" class="form-control"
                        style="background:#77777710" style="text-transform:uppercase;"
                        onkeyup="javascript:this.value=this.value.toUpperCase();"
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
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <a class="btn btn-primary" name="add" id="add" style="margin-rigth:auto;width:180px;font-weight:700;
            font-size:14px;background:#ECDCC2;border-color:#777">
                ++ Agregar Contacto </a>
        </div>
    </div>

    <!--TABLA EQUIPOS DE TRANSPORTE--><br>
    <h4>Datos de Transporte</h4>
    <div class="row" style="overflow-x: auto; overflow-y: hidden;">
        <input type="hidden" name="ids_eliminar_t" id="ids_eliminar_t">
        <table class="table table-bordered" id="tabla_transporte" style="border: 1px solid #123;background:#fff;">

            <thead>
                <tr>
                    <td style="width:10%">Tipo Transporte<b style="color:#B61A1A;outline:none">(*)</b></td>
                    <td style="width:8%">Marca<b style="color:#B61A1A;outline:none">(*)</b></td>
                    <td style="width:8%">Modelo<b style="color:#B61A1A;outline:none">(*)</b></td>
                    <td style="width:7%">Placa<b style="color:#B61A1A;outline:none">(*)</b> <i
                            class="fa-solid fa-circle-question" data-toggle="tooltip"
                            data-original-title="Escribir placa sin guion (-)"></i></td>
                    {{-- <td style="width:4%">Cant. Ejes</td>
                    <td style="width:8%">Capacidad</td>
                    <td style="width:12%">Dimensiones<br>(Largo x Ancho x Alto) Metros</td>
                    <td style="width:5%">Año</td> --}}
                    <td style="width:12%">Ubicacion<b style="color:#B61A1A;outline:none">(*)</b></td>
                    <td style="width:10%">Estado<b style="color:#B61A1A;outline:none">(*)</b></td>
                    <td style="width:10%">Propio/Subarrendado<b style="color:#B61A1A;outline:none">(*)</b></td>
                    <td style="width:5%">Imagenes</td>
                    <td style="text-align:center;width:4%">Eliminar</td>
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
                        maxlength="6"
                        oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                        onkeyup="validar_transporte({{ $j }});javascript:this.value=this.value.toUpperCase();"
                        value="{{ $transportes[$j]->placa }}">
                    <input type="text" disabled value="" class="validar_placa" id="valida_placa{{ $j }}">
                </td>

                {{-- <td>
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
                </td> --}}

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
                        <option value="DADO DE BAJA">DADO DE BAJA</option>
                    </select>
                </td>

                <td>

                    <select name="tipo_transporte[]" class="form-control " style="background:#77777710">
                        <option value="{{ $transportes[$j]->tipo_transporte }}">
                            {{ $transportes[$j]->tipo_transporte }}</option>
                        <option value="PROPIO">PROPIO</option>
                        <option value="SUBARRENDADO">SUBARRENDADO</option>

                    </select>
                </td>
                <td style="text-align: center">
                    <a id="btnModal" onclick="abrirModal({{ $j }})" href="#"><i style="font-size: 2rem"
                            class="fa-solid fa-image"></i></a>
                    <div id="myModal<?php echo $j; ?>" class="modalContainer">
                        <div class="modal-content">
                            <span class="close">×</span>
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label">Cant. Ejes</label>
                                    <input type="text" name="ejes_t[]" autocomplete="off" class="form-control"
                                        value="{{ $transportes[$j]->cantidad_ejes }}">
                                </div>
                                <div class="col-md-3">
                                    <label class="control-label">Capacidad(TN)</label>
                                    <input type="text" name="capacidad_t[]" autocomplete="off" class="form-control"
                                        value="{{ $transportes[$j]->capacidad }}">
                                </div>
                                <div class="col-md-3">
                                    <label class="control-label">Dimensiones &nbsp;(M) &nbsp;<i
                                            class="fa-solid fa-circle-question" data-toggle="tooltip"
                                            data-original-title="Largo X Ancho X Alto "></i></label>
                                    <input type="text" name="volumen_t[]" autocomplete="off" class="form-control"
                                        style="text-transform:uppercase;"
                                        onkeyup="javascript:this.value=this.value.toUpperCase();"
                                        value="{{ $transportes[$j]->volumen }}">
                                </div>
                                <div class="col-md-3">
                                    <label class="control-label">Año</label>
                                    <input type="text" name="anio_t[]" autocomplete="off" class="form-control"
                                        value="{{ $transportes[$j]->anio }}">
                                </div>
                            </div>

                            <br>
                            <h2>Imagenes de {{ $transportes[$j]->tipo }}:</h2>
                            <div id="imagenes{{ $j }}" class="imagenes{{ $j }}"
                                style="overflow-y: scroll;	display: flex;flex-direction: row;flex-wrap: wrap;justify-content: center;align-items: center;align-content: stretch;">

                                <?php $img = 0; ?>



                                @foreach ($imagenes as $imagen)
                                    @if ($imagen->id_transporte == $transportes[$j]->id)
                                        <div class="contenedor-imagen"
                                            style="display:flex;flex-direction:column;margin:5px;">
                                            <h6><b>Imagen Nro.{{ $img + 1 }}</b></h6>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="file" name="imagen{{ $j }}[]"
                                                        accept="image/*"
                                                        onclick="editar1({{ $j }},{{ $img }})"
                                                        id="image{{ $j . $img }}" />
                                                </div>
                                            </div>
                                            <?php
                                            $nombre_imagen_final = $transportes[$j]->id . '-' . $imagen->nombre;
                                            ?>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <br>
                                                    <div class="form-group">
                                                        <img id="showImage{{ $j . $img }}" class="ix1"
                                                            src="{{ route('descargar_vehiculo_imagen', $nombre_imagen_final) }}"
                                                            style="width:300px; height:150px;border-radius:20px;border:2px solid black">
                                                        <a class="btn btn-danger icon-btn btn_remove_image"
                                                            onclick="remover1({{ $j }},{{ $img }})"
                                                            style="color:#dc3545;background:transparent">
                                                            <i class="fas fa-trash"></i>
                                                        </a>

                                                        <input type="hidden" value="{{ $imagen->nombre }}"
                                                            name="nombre_imagen[]">
                                                        <input type="hidden" value="{{ $imagen->id_transporte }}"
                                                            name="id_transporte_imagen[]">
                                                        <input type="hidden" value="{{ $imagen->id }}"
                                                            name="id_imagen{{ $j }}[]">
                                                        <input type="hidden" id="eliminar_imagen{{ $j . $img }}"
                                                            name="eliminar_imagen{{ $j }}[]">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <?php
                                        echo '<script>';
                                        echo 'vista_previa(' . $j . ',' . $img . ');';
                                        echo '</script>';
                                        $img++;
                                        
                                        ?>
                                    @endif
                                @endforeach
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12" style="display: flex;justify-content: center;">
                                    <br>
                                    <a class="btn btn-primary"
                                        onclick="agregar_imagen({{ $j }},{{ $img }});"
                                        name="add_imagen" style="margin-rigth:auto;width:220px;font-weight:700;
            font-size:13px;background:#F1CF98;border-color:#777">
                                        <i class="fa fa-image" style="font-size:18px"></i> Agregar Imagen</a>
                                </div>
                            </div>
                            <input type="hidden" id="contador_imagenes{{ $j }}"
                                name="contador_imagenes{{ $j }}" value="{{ $img }}">

                        </div>



                    </div>
                </td>

                <td style="text-align: center">
                    <button type="button" id="{{ $j }}" class="btn btn-danger btn_remove_data_t">X</button>

                </td>
            </tr>
            <?php }?>
        </table>


    </div>
    <div class="col-md-2">
        <div class="form-group">
            <a class="btn btn-primary" name="add_transporte" id="add_transporte" style="margin-rigth:auto;width:100%;font-weight:700;
 font-size:14px;background:#ECDCC2;border-color:#777">
                ++ Agregar Equipo de Transporte </a>
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
                '<input type="text" name="nombre_contacto[]" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" required id="nombre_contacto' +
                i +
                '" ' +
                'autocomplete="off" class="form-control" style="background:#77777710" >' +
                '</td>' +

                '<td>' +
                '<input type="number"  name="dni[]" ' +
                'autocomplete="off" maxlength="8" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="form-control" style="background:#77777710" >' +
                '</td>' +

                '<td>' +
                '<input type="number" required  name="celular[]" ' +
                'autocomplete="off"  class="form-control" style="background:#77777710" >' +
                '</td>' +

                '<td>' +
                '<input type="text" name="cargo[]" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" ' +
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
        var img = 0;
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
                'autocomplete="off" class="form-control" style="background:#77777710" required >' +
                '</td>' +


                '<td>' +
                '<input type="text" name="modelo_t[]" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"' +
                'autocomplete="off" class="form-control" style="background:#77777710" required>' +
                '</td>' +

                '<td>' +
                '<input type="text" id="placa_t' + j + '" name="placa_t[]" ' +
                'autocomplete="off" onkeyup="validar_transporte(' + j +
                ')" style="text-transform:uppercase;" maxlength="6" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" style="background:#77777710" >' +
                '<input type="text" disabled value="" class="validar_placa" id="valida_placa' + j +
                '" required>' +

                // '<td>' +
                // '<input type="text"  name="ejes_t[]" ' +
                // 'autocomplete="off" class="form-control" style="background:#77777710" >' +
                // '</td>' +

                // '<td>' +
                // '<input type="text"  name="capacidad_t[]" ' +
                // 'autocomplete="off" class="form-control" style="background:#77777710" >' +
                // '</td>' +

                // '<td>' +
                // '<input type="text"  name="volumen_t[]" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"' +
                // 'autocomplete="off" class="form-control" style="background:#77777710" >' +
                // '</td>' +

                // '<td>' +
                // '<input type="text"  name="anio_t[]" ' +
                // 'autocomplete="off" class="form-control" style="background:#77777710" >' +
                // '</td>' +

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
                '<select name="tipo_transporte[]" required class="form-control " required>' +
                '<option value="" selected disabled>Seleccionar</option>' +
                '<option value="PROPIO">PROPIO</option>' +
                '<option value="SUBARRENDADO">SUBARRENADO</option>' +
                '</select>' +
                '</td>' +

                '<td style="text-align:center">' +
                '<a id="btnModal" onclick="abrirModal(' + j +
                ')" href="#"><i style="font-size: 2rem" class="fa-solid fa-image"></i></a>' +
                '<div id="myModal' + j + '" class="modalContainer">' +
                '<div class="modal-content">' +
                '<span class="close">×</span>' +
                '<div class="row">' +
                '<div class="col-md-3">' +
                ' <label class="control-label">Cant. Ejes</label>' +
                '<input type="text" name="ejes_t[]" autocomplete="off" class="form-control" style="background:#77777710" >' +
                '</div>' +
                '<div class="col-md-3">' +
                '<label class="control-label">Capacidad(TN)</label>' +
                '<input type="text" name="capacidad_t[]" autocomplete="off" class="form-control" style="background:#77777710" >' +
                '</div>' +
                '<div class="col-md-3">' +
                '<label class="control-label">Dimensiones</label>' +
                '<input type="text" name="volumen_t[]" autocomplete="off" class="form-control" style="text-transform:uppercase;"  onkeyup="javascript:this.value=this.value.toUpperCase();" style="background:#77777710" >' +
                '</div>' +
                '<div class="col-md-3">' +
                '<label class="control-label">Año</label>' +
                '<input type="text" name="anio_t[]" autocomplete="off" class="form-control" style="background:#77777710" >' +
                '</div>' +
                ' </div>' +
                '<br>' +
                '<h2>Imagenes:</h2>' +
                '<div id="imagenes' + j + '" class="imagenes' + j +
                '" style="overflow-y: scroll;	display: flex;flex-direction: row;flex-wrap: wrap;justify-content: center;align-items: center;align-content: stretch;">' +
                '</div>' +
                '<br>' +
                '<div class="row">' +
                '<div class="col-md-12" style="display: flex;justify-content: center;">' +
                '<br>' +
                '<a class="btn btn-primary" onclick="agregar_imagen(' + j + ',' + img +
                ');" name="add_imagen" style="margin-rigth:auto;width:220px;font-weight:700;font-size:13px;background:#F1CF98;border-color:#777">' +
                '<i class="fa fa-image" style="font-size:18px"></i> Agregar Imagen</a>' +
                '</div>' +
                '</div>' +
                '<input type="hidden" id="contador_imagenes' + j + '" name="contador_imagenes' + j +
                '" value="' + img + '">' +
                '</div>' +
                '</div>' +
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
    function abrirModal(j) {
        // vista_previa(j);
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
</script>


<script>
    window.onload = function() {
        $('#onload').fadeOut();
        $('.contenido').removeClass('hidden');
    }
</script>

<script type="text/javascript">
    function vista_previa(j, img) {
        $('#image' + j + img).change(function(e) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#showImage' + j + img).attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });



    }
</script>

<script>
    /*const $imagen1 = document.querySelector("#image1");
    $imagen1.addEventListener("change", () => {

        document.getElementById("contador_imagenes").value++;
    });
    */
    function remover1(j, img) {
        if (!confirm("¿Estas seguro de eliminar esta imagen?")) return;
        document.getElementById("eliminar_imagen" + j + img).value = "si";
        const imagen = document.getElementById("image" + j + img);

        document.getElementById("image" + j + img).value = "";
        document.getElementById("showImage" + j + img).src = "{{ asset('image/imagendefault.png') }}";
        // $('.contenedor-imagen' + img).addClass('hidden');
    }

    function remover2(j, img) {

        $('.contenedor-imagen' + img).remove();

        $('#contador_imagenes' + j).val(parseInt($('#contador_imagenes' + j).val()) - 1);
        // console.log(val);
    }

    function editar1(j, img) {
        document.getElementById("eliminar_imagen" + j + img).value = "editar";
        const imagen = document.getElementById("image" + j + img);

        document.getElementById("image" + j + img).value = "";
        document.getElementById("showImage" + j + img).src = "{{ asset('image/imagendefault.png') }}";
    }
</script>
<script>
    function agregar_imagen(j, i) {



        var img = $('#contador_imagenes' + j).val();
        vista_previa(j, img);
        //var cantidad_imagenes=img-1;
        var nro = parseInt(img) + 1;

        $('#imagenes' + j).append(
            '<div class="contenedor-imagen' + img + '" >' +
            '<h6><b>Imagen Nro.' + nro + '</b></h6>' +
            '<div class ="row">' +
            '<div class="col-md-6">' +
            '<input type="file" name="imagen' + j + '[]" accept="image/*" id="image' + j + img +
            '"/>' +
            '</div>' +
            '</div>' +

            '<div class ="row">' +
            '<div class="col-md-12">' +
            '<br>' +
            '<div class="form-group">' +
            '<img id="showImage' + j + img +
            '" class="ix1" src="{{ asset('image/imagendefault.png') }}" alt="" style="width:300px; height:150px; border-radius:20px">' +
            '<a class="btn btn-danger icon-btn btn_remove_image" onclick="remover2(' + j + ',' + img +
            ')" style="color:#dc3545;background:transparent">' +
            '<i class="fas fa-trash"></i>' +
            '</a>' +
            '<input type="hidden" id="eliminar_imagen' + j + img + '"  name="eliminar_imagen' + j +
            '[]" value="nuevo">' +
            '</div>' +
            '</div>' +


            '</div>'

        );

        vista_previa(j, img);
        const $imagen = document.querySelector("#image" + j + img);
        img++;
        //$imagen.addEventListener("change", () => {

        document.getElementById("contador_imagenes" + j).value++;
        //});


        // $(document).on('click', '.btn_remove_image', function() {

        //     document.getElementById("contador_imagenes" + j).value--;


        // });
    }
</script>

@endsection
@section('css')
@include('admin.datatable')
@stop

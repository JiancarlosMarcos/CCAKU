@extends('adminlte::page')
@section('content_header')
    <br>
    <div class="app-title">
        <div>
            <h1>
                <a href="{{ route('cargas.mostrar') }}" class="btn btn-primary "
                    style="color:#777;background:#fff;border-color:#777">Lista de Cargas</a>
                <a href="{{ route('cliente.contactos.mostrar') }}" class="btn btn-primary "
                    style="color:#777;background:#fff;border-color:#777">Lista de Contactos</a>
            </h1>

        </div><br>

        <input type="hidden" name="usuario" id="usuario" value="{{ auth()->user()->id }}">
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home"></i></li>
            <li class="breadcrumb-item"><a href=""></a>Mis Cargas</li>
            <li class="breadcrumb-item"><a href=""></a>Editar</li>
        </ul>
    </div>
@stop
@section('content')
@section('titulo', 'Editar Cliente')
<div class="centrado" id="onload">
    <div class="lds-ring">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
    Cargando...
</div>
<form method="POST" action="{{ route('cliente.actualizar_cliente') }}" class="centrar-form">
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
    <h4>Datos de Contacto</h4>
    <div class="row">
        <!--OCULTO-->
        <?php $contador = count($contactos); ?>
        <?php $contador_c = count($cargas); ?>
        <input class="form-control" name="contador" id="contador" type="hidden" value="<?php echo $contador; ?>" value="0"
            autocomplete="off" />
        <input class="form-control" name="contador_c" id="contador_c" type="hidden" value="<?php echo $contador_c; ?>"
            value="0" autocomplete="off" />
        <input class="form-control" name="usuario" id="usuario" type="hidden" value="{{ auth()->user()->id }}"
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
                {{-- <td style="text-align:center">Eliminar</td> --}}
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
                    readonly>

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
                    style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"
                    value="{{ $contactos[$i]->cargo }}">
            </td>

            <td>
                <input type="text" name="correo[]" autocomplete="off" class="form-control"
                    style="background:#77777710" value="{{ $contactos[$i]->correo }}" readonly>
            </td>

            {{-- <td style="text-align:center">
                <button type="button" id="{{ $i }}" class="btn btn-danger btn_remove_data">X</button>
            </td> --}}
        </tr>
        <?php }?>
    </table>



    <!--TABLA CARGAS DE CLIENTES--><br>
    <h4>Datos de Carga</h4>
    <div class="row">
        <input type="hidden" name="ids_eliminar_c" id="ids_eliminar_c">
        <table class="table table-bordered" id="tabla_carga" style="border: 1px solid #123;background:#fff">

            <thead>
                <tr>
                    <td style="width:15%">Tipo de Carga</td>
                    <td style="width:10%">Marca</td>
                    <td style="width:12%">Modelo</td>
                    <td style="width:8%">Placa</td>
                    <td style="width:8%">Dimensiones<br>(Largo x Ancho x Alto)</td>
                    <td style="width:12%">Peso</td>
                    <td style="width:12%">Ubicacion</td>
                    <td style="text-align:center;width:6%">Eliminar</td>
                </tr>
            </thead>
            <?php 


        for($j=0;$j<$contador_c;$j++){
     ?>
            <tr id="carga<?php echo $j; ?>" class="cargas">
                <td>
                    <input type="text" name="tipo_c[]" autocomplete="off" class="form-control"
                        style="background:#77777710" style="text-transform:uppercase;"
                        onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{ $cargas[$j]->tipo }}">

                    <input type="hidden" name="id_carga[]" id="id_carga<?php echo $j; ?>" autocomplete="off"
                        class="form-control" style="background:#77777710" value="{{ $cargas[$j]->id }}">


                </td>

                <td>
                    <input type="text" name="marca_c[]" autocomplete="off" class="form-control"
                        style="background:#77777710" style="text-transform:uppercase;"
                        onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{ $cargas[$j]->marca }}">
                </td>



                <td>
                    <input type="text" name="modelo_c[]" autocomplete="off" class="form-control"
                        style="background:#77777710" style="text-transform:uppercase;"
                        onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{ $cargas[$j]->modelo }}">
                </td>

                <td>
                    <input type="text" name="placa_c[]" autocomplete="off" class="form-control"
                        style="background:#77777710" style="text-transform:uppercase;"
                        onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{ $cargas[$j]->placa }}">
                </td>

                <td>
                    <input type="text" name="volumen_c[]" autocomplete="off" class="form-control"
                        style="background:#77777710" style="text-transform:uppercase;"
                        onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{ $cargas[$j]->volumen }}">
                </td>
                <td style="display: flex;flex-direction:row,align-items: center;">
                    <input type="text" name="peso_c[]" autocomplete="off" class="form-control"
                        style="background:#77777710" style="text-transform:uppercase;"
                        onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{ $cargas[$j]->peso }}">
                    <label class="form-control" style="background:#77777710;width:3rem" for="">TN</label>
                </td>




                <td>
                    <select name="id_ubicacion_c[]" class="form-control " style="background:#77777710">
                        @foreach ($ubicaciones as $ubicacion)
                            @if ($ubicacion->id == $cargas[$j]->id_ubicacion)
                                <option value="{{ $ubicacion->id }}">{{ $ubicacion->departamento }}
                                </option>
                                @foreach ($ubicaciones as $ubicacion)
                                    <option value="{{ $ubicacion->id }}">{{ $ubicacion->departamento }}</option>
                                @endforeach
                            @endif
                        @endforeach
                    </select>
                </td>


                <td>
                    <button type="button" id="{{ $j }}" class="btn btn-danger btn_remove_data_c">X</button>

                </td>
            </tr>
            <?php }?>
        </table>

        <div class="col-md-2">
            <div class="form-group">
                <a class="btn btn-primary" name="add_carga" id="add_carga" style="margin-rigth:auto;width:100%;font-weight:700;
     font-size:14px;background:#ECDCC2;border-color:#777">
                    ++ Agregar Carga </a>
            </div>
        </div>
    </div>
    <div class="col-md-12" style="text-align:center">
        <div class="form-group">
            <button class="btn btn-primary" type="Submit"> <i class="fa fa-refresh"></i>Actualizar </button>
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
    $(document).ready(function() {
        var i = $(".contactos").length;

        $('#add').click(function() {

            $('#dynamic_field').append(

                '<tr id="row' + i + '" class="contactos">' +

                '<td>' +
                '<input type="text" name="nombre_contacto[]" id="nombre_contacto' + i + '" ' +
                'autocomplete="off" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" style="background:#77777710" >' +
                '</td>' +

                '<td>' +
                '<input type="text"  name="dni[]" ' +
                'autocomplete="off" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" style="background:#77777710" >' +
                '</td>' +

                '<td>' +
                '<input type="text"  name="celular[]" ' +
                'autocomplete="off" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" style="background:#77777710" >' +
                '</td>' +

                '<td>' +
                '<input type="text" name="cargo[]" ' +
                'autocomplete="off" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" style="background:#77777710" >' +
                '</td>' +

                '<td>' +
                '<input type="text" name="correo[]" ' +
                'autocomplete="off"  class="form-control" style="background:#77777710" >' +
                '</td>' +

                '<td style="text-align:center">' +
                '<button type="button" onclick="eliminar_fila(' + i +
                ')" id="' + i +
                '" class="btn btn-danger ">X</button>' +
                '</td>' +
                '</tr>'
            );
            i++;
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
        var j = $(".cargas").length;

        $('#add_carga').click(function() {

            $('#tabla_carga').append(

                '<tr id="carga' + j + '" class="cargas">' +

                '<td>' +
                '<input type="text"  name="tipo_c[]" ' +
                'autocomplete="off" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" style="background:#77777710" >' +
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

                '<td style="display: flex;flex-direction:row,align-items: center;">' +
                '<input type="text"  name="peso_c[]" ' +
                'autocomplete="off" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" style="background:#77777710" >' +
                '<label class="form-control" style="background:#77777710;width:3rem" for="">TN</label>' +
                '</td>' +

                '<td>' +
                '<select name="id_ubicacion_c[]" " class="form-control " >' +
                '<option value="" selected disabled>Seleccionar Ubicacion</option>' +
                @foreach ($ubicaciones as $ubicacion)
                    '<option value="{{ $ubicacion->id }}">{{ $ubicacion->departamento }}</option>' +
                @endforeach
                '</select>' +
                '</td>' +


                '<td style="text-align:center">' +
                '<button type="button" onclick="eliminar_fila_c(' + j +
                ')" id="' + j +
                '" class="btn btn-danger ">X</button>' +
                '</td>' +
                '</tr>'
            );
            j++;

            document.getElementById("contador_c").value++;

        });

    })

    function eliminar_fila_c(id) {
        if (!confirm("¿Estas seguro de eliminar esta carga?")) return;

        $('#carga' + id).remove();
        document.getElementById("contador_c").value--;

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
    let array_lista_c = [];

    function lista_eliminados_c(data) {

        array_lista_c.push(data);
        console.log(array_lista_c);
        $('#ids_eliminar_c').val(array_lista_c);

    }
</script>
<script>
    window.onload = function() {
        $('#onload').fadeOut();
        $('.contenido').removeClass('hidden');
    }
</script>
@endsection
@section('css')
@include('admin.datatable')
@stop

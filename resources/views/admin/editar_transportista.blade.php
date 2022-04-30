@extends('adminlte::page')

@section('content')
@section('titulo', 'Editar Transportista')
<br>
<br>
<div class="app-title centrar-title">
    <div>
        <a href="{{ route('transportistas') }}" class="btn btn-primary"
            style="background:#777;border-color:#777;color:#fff">Transportistas</a>
        <a class="btn btn-primary " style="color:#777;background:#fff;border-color:#777">Contactos de Transportistas</a>
        <a class="btn btn-primary " style="color:#777;background:#fff;border-color:#777">Transportes</a>


        <p></p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a>Transportistas</a></li>
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
        <input class="form-control" name="usuario" id="usuario" type="hidden" value="{{ auth()->user()->Nombres }}"
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

        <table class="table table-bordered" id="tabla_transporte" style="border: 1px solid #123;background:#fff">

            <thead>
                <tr>
                    <td style="width:15%">Tipo Transporte</td>
                    <td style="width:8%">Cantidad <br>de Ejes</td>
                    <td style="width:12%">Capacidad</td>
                    <td style="width:12%">Ubicacion</td>
                    <td style="width:12%">Estado</td>
                    <td style="width:10%">Marca</td>
                    <td style="width:12%">Modelo</td>
                    <td style="width:12%">Placa</td>
                    {{-- <td style="width:8%">Año</td> --}}
                    <td style="text-align:center;width:6%">Eliminar</td>
                </tr>
            </thead>
            <?php 


        for($j=0;$j<$contador_t;$j++){
     ?>
            <tr id="row<?php echo $i; ?>" class="contactos">
                <td>
                    <input type="hidden" name="id_transporte[]" id="id_transporte<?php echo $j; ?>"
                        autocomplete="off" class="form-control" style="background:#77777710"
                        value="{{ $transportes[$j]->id }}">

                    <input type="text" name="tipo_t[]" autocomplete="off" class="form-control"
                        style="background:#77777710" value="{{ $transportes[$j]->tipo }}">

                    {{-- <select name="tipo_t[]" class="form-control " id="tipo_t'+i+'" style="background:#77777710"
                        required>
                        <option value="{{ $transportes[$j]->tipo }}" selected disabled>
                            {{ $transportes[$j]->tipo }}</option>
                        <option value="Camion Plataforma">Camion Plataforma</option>
                        <option value="Camion Rebatible">Camion Rebatible</option>
                        <option value="Camion Normal">Camion Normal</option>
                        <option value="Camacuna">Camacuna</option>
                        <option value="Camabaja">Camabaja</option>
                        <option value="Tracto">Tracto</option>
                        <option value="Modulares">Modulares</option>
                    </select> --}}


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
                    <select name="ubicacion_t[]" class="form-control " style="background:#77777710">
                        @foreach ($ubicaciones as $ubicacion)
                            @if ($ubicacion->id == $transportes[$j]->id_ubicacion)
                                <option value="{{ $ubicacion->id }}" selected>{{ $ubicacion->departamento }}
                                </option>
                                @foreach ($ubicaciones as $ubicacion)
                                    <option value="{{ $ubicacion->id }}">{{ $ubicacion->departamento }}</option>
                                @endforeach
                            @endif
                        @endforeach
                    </select>
                </td>

                <td>
                    <input type="text" name="estado_t[]" autocomplete="off" class="form-control"
                        style="background:#77777710" value="{{ $transportes[$j]->estado }}">
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
                    <input type="text" name="placa_t[]" autocomplete="off" class="form-control"
                        style="background:#77777710" value="{{ $transportes[$j]->placa }}">
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
    $(document).on('click', '.btn_remove_data_t', function() {
        if (!confirm("¿Estas seguro de eliminar este transporte?")) return;

        var id = $(this).attr('id');
        var data_id = $('#id_transporte' + id).val();
        lista_eliminados_trans(data_id);
        $('#row' + id).remove();
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
                '<input type="text" name="nombre_contacto[]" id="nombre_contacto' + i + '" ' +
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
                '<button type="button" id="' + i +
                '" class="btn btn-danger btn_remove">X</button>' +
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
                '<input type="text"  name="ejes_t[]" ' +
                'autocomplete="off" class="form-control" style="background:#77777710" >' +
                '</td>' +

                '<td>' +
                '<input type="text"  name="capacidad_t[]" ' +
                'autocomplete="off" class="form-control" style="background:#77777710" >' +
                '</td>' +

                '<td>' +
                '<select name="id_ubicacion_t[]" " class="form-control " >' +
                '<option value="" selected disabled>Seleccionar Ubicacion</option>' +
                @foreach ($ubicaciones as $ubicacion)
                    '<option value="{{ $ubicacion->id }}">{{ $ubicacion->departamento }}</option>'+
                @endforeach '</select>' +
                '</td>' +

                '<td>' +
                '<input type="text" name="estado_t[]" ' +
                'autocomplete="off" class="form-control" style="background:#77777710" >' +
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
                '<input type="text" name="placa_t[]" ' +
                'autocomplete="off" class="form-control" style="background:#77777710" >' +
                '</td>' +


                '<td style="text-align:center">' +
                '<button type="button" onclick="eliminar_fila(' + j +
                ')" class="btn btn-danger btn_remove_t">X</button>' +
                '</td>' +
                '</tr>'
            );
            j++;

            document.getElementById("contador_t").value++;

        });



    })

    function eliminar_fila(id) {
        if (!confirm("¿Estas seguro de eliminar este equipo?")) return;

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
    let array_lista_trans = [];

    function lista_eliminados_trans(data) {


        array_lista_trans.push(data);
        console.log(array_lista_trans);
        $('#ids_eliminar_trans').val(array_lista_trans);

    }
</script>
<script>
    function LimpiarForm() {

        document.getElementById("nombre_registrador").value = "";
        document.getElementById("celular_registrador").value = "";
        document.getElementById("cargo_registrador").value = "";
        document.getElementById("correo_registrador").value = "";
    }
</script>
<script>
    function PasarValores() {

        var cont = $(".contactos").length;

        var nombre_contacto = document.getElementsByName("nombre_contacto[]");
        var celular = document.getElementsByName("dni[]");
        var celular = document.getElementsByName("celular[]");
        var cargo = document.getElementsByName("cargo[]");
        var correo = document.getElementsByName("correo[]");

        nombre_contacto[cont - 1].value = document.getElementById("nombre_registrador").value;
        celular[cont - 1].value = document.getElementById("celular_registrador").value;
        cargo[cont - 1].value = document.getElementById("cargo_registrador").value;
        correo[cont - 1].value = document.getElementById("correo_registrador").value;

    }
</script>



@section('css')
    <!-- SELECT 2 JS CSS-->
    <script src="{{ asset('js2/jquery/jquery.min.js') }}"></script>
    <!-- NUEVO JQUERY-->

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css2/main.css') }}">

    <link rel="stylesheet" href="{{ asset('css2/product.css') }}">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css"
        href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--  extension responsive  -->

    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">

    <style>
        .bg-principal {
            background: #222d32;
            color: #fff;
        }

    </style>
    <style>
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }

    </style>

@stop
@section('js')
    <!-- Essential javascripts for application to work-->
    <!--<script src="{{ asset('backend/js/jquery-3.3.1.min.js') }}"></script>-->
    <script src="{{ asset('js2/popper.min.js') }}"></script>
    <script src="{{ asset('js2/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js2/main.js') }}"></script>

    <script src="{{ asset('js2/product.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js2/plugins/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js2/plugins/dataTables.bootstrap.min.js') }}"></script>





    <script src="https://kit.fontawesome.com/102c277d5c.js" crossorigin="anonymous"></script>
    <!-- extension responsive -->
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.2.2/js/dataTables.fixedHeader.min.js"></script>

    <!-- The javascript plugin to display page loading on top-->
    <script src="{{ asset('js2/plugins/pace.min.js') }}"></script>
    <!-- Page specific javascripts-->
    <script type="text/javascript" src="{{ asset('js2/plugins/chart.js') }}"></script>
    <script type="text/javascript">

    </script>



    <script type="text/javascript" src="{{ asset('js2/plugins/sweetalert.min.js') }}"></script>

    <script>
        //SweetAlert2 Para eliminar
        $(function() {
            $(document).on('click', '#delete', function(e) {
                e.preventDefault();
                var link = $(this).attr("href");
                swal({
                    title: "Estas Seguro?",
                    text: "Una vez eliminado, no podrás recuperarlo",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Sí, Eliminarlo",
                    cancelButtonText: "No, Cancelarlo",
                    closeOnConfirm: false,
                    closeOnCancel: false
                }, function(isConfirm) {
                    if (isConfirm) {
                        window.location.href = link

                    } else {
                        swal("Cancelado", "", "error");
                    }
                });
            });
        });
    </script>
@stop

@endsection

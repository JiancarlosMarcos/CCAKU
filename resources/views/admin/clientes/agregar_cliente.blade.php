@extends('adminlte::page')
@section('content')
@section('titulo', 'Agregar Clientes')
<br>
<br>
<div class="app-title">
    <div>
        <a href="{{ route('clientes') }}" class="btn btn-primary"
            style="background:#777;border-color:#777">Clientes</a>
        <a class="btn btn-primary " style="color:#777;background:#fff;border-color:#777">Contactos de Clientes</a>
        <a class="btn btn-primary " style="color:#777;background:#fff;border-color:#777">Cargas</a>

        <p></p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a>Clientes</a></li>
        <li class="breadcrumb-item"><a href=""> Cliente Nuevo</a></li>
    </ul>
</div>
<!---->
<form method="POST" action="{{ route('agregar_cliente') }}">
    @csrf
    @include('notificacion')
    <div class="form-card" style="color:#000">
        <h4>Datos de la Empresa</h4>

        <div class="row">

            <div class="col-md-3">
                <div class="form-group">

                    <label class="control-label" style="font-weight:600;color:#777">RUC O DNI: <a
                            style="color:#B61A1A">*
                            @error('dni_ruc')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </a></label>
                    <input class="form-control" name="dni_ruc" type="number" value="{{ old('dni_ruc') }}"
                        autocomplete="off" id="dni_ruc" onkeyup="validar_cliente()" placeholder="RUC O DNI" required
                        pattern="[0-9]" />
                    <input type="text" value="" class="alerta_1" id="valida_dni_ruc_1"
                        style="font-size:14px;background:transparent;border:0px solid transparent;width:400px;color:#be1e37;margin-top:-50px"
                        disabled>

                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label" style="font-weight:600;color:#777">NOMBRE: <a
                            style="color:#B61A1A">*</a></label>
                    <input class="form-control" name="razon_social" type="text" value="{{ old('razon_social') }}"
                        autocomplete="off" placeholder="Nombre de la empresa" required />
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label" style="font-weight:600;color:#777">DIRECCION: <a
                            style="color:#B61A1A"></a></label>
                    <input class="form-control" name="direccion" type="text" value="{{ old('direccion') }}"
                        autocomplete="off" placeholder="Direccion de la empresa" />
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label" style="font-weight:600;color:#777">PAGINA WEB: <a
                            style="color:#B61A1A"></a></label>
                    <input class="form-control" name="pagina_web" type="text" value="{{ old('pagina_web') }}"
                        autocomplete="off" placeholder="Pagina web" />
                </div>
            </div>




        </div>
    </div>

    <!----><br>
    <h4>Datos de Contacto</h4>
    <div class="row">

        <!--OCULTO-->
        <input class="form-control" name="contador" id="contador" type="hidden" value="0" autocomplete="off" />
        <input class="form-control" name="contador" id="contador_c" type="hidden" value="0" autocomplete="off" />
        <input class="form-control" name="usuario" id="usuario" type="hidden" value="{{ auth()->user()->Nombres }}"
            autocomplete="off" />
        <!---->
    </div>




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
    </table>

    <div class="col-md-3">
        <div class="form-group">
            <a class="btn btn-primary" name="add" id="add" style="margin-rigth:auto;width:180px;font-weight:700;
            font-size:14px;background:#ECDCC2;border-color:#777">
                ++ Agregar Contacto </a>
        </div>
    </div>



    <!--TABLA CARGAS DEL CLIENTE--><br>
    <h4>Datos de Carga</h4>
    <div class="row">

        <table class="table table-bordered" id="tabla_carga" style="border: 1px solid #123;background:#fff">

            <thead>
                <tr>
                    <td style="width:15%">Tipo de Carga</td>
                    <td style="width:8%">Volumen</td>
                    <td style="width:12%">Peso</td>
                    <td style="width:12%">Unidad Medida</td>
                    <td style="width:12%">Ubicacion</td>
                    <td style="width:10%">Marca</td>
                    <td style="width:12%">Modelo</td>
                    <td style="width:12%">Placa</td>
                    {{-- <td style="width:8%">Año</td> --}}
                    <td style="text-align:center;width:6%">Eliminar</td>
                </tr>
            </thead>
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
            <button class="btn btn-primary" type="Submit"> <i class="fa fa-plus-square"></i>Registrar </button>
        </div>
    </div>
</form>
<script>
    $(document).ready(function() {
        var j = $(".cargas").length;

        $('#add_carga').click(function() {

            $('#tabla_carga').append(

                '<tr id="carga' + j + '" class="cargas" >' +

                '<td>' +
                '<input type="text"  name="tipo_c[]" ' +
                'autocomplete="off" class="form-control" style="background:#77777710" required>' +
                '</td>' +

                '<td>' +
                '<input type="text"  name="volumen_c[]" ' +
                'autocomplete="off" class="form-control" style="background:#77777710" >' +
                '</td>' +

                '<td>' +
                '<input type="text"  name="peso_c[]" ' +
                'autocomplete="off" class="form-control" style="background:#77777710" >' +
                '</td>' +

                '<td>' +
                '<input type="text"  name="medida_c[]" ' +
                'autocomplete="off" class="form-control" style="background:#77777710" >' +
                '</td>' +

                '<td>' +
                '<select name="id_ubicacion_c[]" " class="form-control " >' +
                '<option value="" selected disabled>Seleccionar Ubicacion</option>' +
                @foreach ($ubicaciones as $ubicacion)
                    '<option value="{{ $ubicacion->id }}">{{ $ubicacion->departamento }}</option>'+
                @endforeach '</select>' +
                '</td>' +


                '<td>' +
                '<input type="text"  name="marca_c[]" ' +
                'autocomplete="off" class="form-control" style="background:#77777710" >' +
                '</td>' +


                '<td>' +
                '<input type="text" name="modelo_c[]" ' +
                'autocomplete="off" class="form-control" style="background:#77777710" >' +
                '</td>' +

                '<td>' +
                '<input type="text" name="placa_c[]" ' +
                'autocomplete="off" class="form-control" style="background:#77777710" >' +
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

        $('#carga' + id).remove();
        document.getElementById("contador_c").value--;

    }
</script>


<script>
    $(document).ready(function() {
        var i = 1;

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
    function validar_cliente() {

        var dni_ruc = document.getElementById('dni_ruc').value;

        if ($.trim(dni_ruc) != '') {
            $.get('../consulta_empresas', {
                dni_ruc: dni_ruc
            }, function(empresas) {

                var data_nombre_empresa = empresas["nombre_empresa"];
                var data_dni_ruc_empresa = empresas["dni_ruc_empresa"];


                $.each(empresas, function(index, value) {
                    $('#valida_dni_ruc_1').css("color", "#be1e37");
                    $('#valida_dni_ruc_1').val(empresas["indicador_empresa"] + " existente");

                })

            }).fail(function() {

                $('#valida_dni_ruc_1').css("color", "#35993A");
                $('#valida_dni_ruc_1').val("Este DNI o RUC no se encuentra registrado");

            }).then(function(data) {
                // console.log(data);
                // console.log("--__"+data[0]);
            });
        }
    }
</script>
@endsection






@section('css')
@include('admin.datatable')
@stop

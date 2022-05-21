@extends('adminlte::page')
@section('content_header')
    <br>
    <div class="app-title">
        <div>
            <h1>
                <a href="{{ route('cargas.mostrar') }}" class="btn btn-primary "
                    style="background:#777;border-color:#777">Lista de Cargas</a>
                <a href="{{ route('cliente.contactos.mostrar') }}" class="btn btn-primary "
                    style="color:#777;background:#fff;border-color:#777">Lista de Contactos</a>
            </h1>

        </div><br>

        <input type="hidden" name="usuario" id="usuario" value="{{ auth()->user()->id }}">
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home"></i></li>
            <li class="breadcrumb-item"><a href=""></a>Mis Cargas</li>
            <li class="breadcrumb-item"><a href=""></a>Cargas</li>
        </ul>
    </div>
@stop
@section('content')
@section('titulo', 'Clientes')
<div class="centrado" id="onload">
    <div class="lds-ring">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
    Cargando...
</div>
<h1 style="text-align: center">Lista de Cargas</h1>
<br>
@include('notificacion')
<div class="col-md-8" style="max-width:100%">

    <div class="tile">

        <div style="display:flex">

            <a class="btn btn-primary " onclick="LimpiarFiltros();" style="margin-rigth:auto;width:140px;
    font-size:14px;background:#ECDCC2;border-color:#777">
                <i class="fas fa-filter" aria-hidden="true"></i> Limpiar Filtros </a>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <a class="btn btn-primary" onclick="Eliminar();" id="eliminar" style="margin-rigth:auto;width:140px;yo
    font-size:14px;background:#ECDCC2;border-color:#777;color:#777">
                <i class="fas fa-trash" aria-hidden="true"></i> Eliminar </a>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <a class="btn btn-primary" onclick="Editar();" id="editar" style="margin-rigth:auto;width:140px;display:block;
    font-size:14px;background:#ECDCC2;border-color:#777;color:#777">
                <i class="fas fa-pencil-alt" aria-hidden="true"></i> Editar </a>
            {{-- <a class="btn btn-primary btn-sm" href="{{route('clientes.formulario.agregar')}}" style="margin-left:auto;width:120px;font-size:14px">
                <i class="fas fa-plus-square" aria-hidden="true"></i> Agregar </a> --}}
        </div><br>
        <div class="tile-body">
            <div class="table-responsive">
                <table class="table table-bordered display" id="tablaClientes">
                    <thead>
                        <tr>
                            <td>
                                <select data-column="0" class="form-control filter-select" id="select_tipo_empresa">
                                    <option value=" " selected></option>
                                    <option value="Empresa">Empresa</option>
                                    <option value="Persona Natural">Persona Natural</option>
                                </select>
                            </td>
                            <td><input autocomplete="off" type="text" class="form-control filter-input" id="dni_ruc"
                                    data-column="1" /></td>
                            <td><input autocomplete="off" type="text" class="form-control filter-input" id="nombre"
                                    data-column="2" /></td>
                            <td><input autocomplete="off" type="text" class="form-control filter-input"
                                    id="clasificacion" data-column="3" /></td>
                            <td><input autocomplete="off" type="text" class="form-control filter-input" id="via_ingreso"
                                    data-column="4" /></td>
                            <td><input autocomplete="off" type="text" class="form-control filter-input" id="pagina_web"
                                    data-column="5" /></td>
                            <td><input autocomplete="off" type="text" class="form-control filter-input"
                                    id="fecha_reacion" data-column="5" /></td>
                            <td><input autocomplete="off" type="text" class="form-control filter-input" id="dni_ruc"
                                    data-column="1" /></td>
                            <td><input autocomplete="off" type="text" class="form-control filter-input" id="dni_ruc"
                                    data-column="1" /></td>
                            <td><input autocomplete="off" type="text" class="form-control filter-input" id="dni_ruc"
                                    data-column="1" /></td>
                            <td><input autocomplete="off" type="text" class="form-control filter-input" id="dni_ruc"
                                    data-column="1" /></td>

                            <td></td>

                        </tr>
                        <tr style="background:#00000099;color:#fff;border:3px solid #fff">
                            <th>Empresa</th>
                            <th>Tipo</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Placa</th>
                            <th>Dimensiones</th>
                            <th>Peso</th>
                            <th>Medida</th>
                            <th>Ubicacion</th>
                            <th>Fecha de<br>Creacion</th>
                            <th>Fecha de<br>Modificacion</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php $user = Auth::user()->id; ?>
</div>

<script>
    $(document).ready(function() {
        var table = $('#tablaClientes').DataTable({

            serverSider: true,
            ajax: '{{ route('lista_cargas_cliente', ['usuario' => $user]) }}',
            columns: [{
                    data: 'empresa'
                },
                {
                    data: 'tipo'
                },
                {
                    data: 'marca'
                },
                {
                    data: 'modelo'
                },
                {
                    data: 'placa'
                },
                {
                    data: 'volumen'
                },
                {
                    data: 'peso'
                },
                {
                    data: 'unidad_medida_peso'
                },
                {
                    data: 'ubicacion'
                },
                {
                    data: 'created_at'
                },
                {
                    data: 'updated_at'
                },
                {
                    data: 'btn_editar_carga'
                },

            ],

            "pageLength": 10,
            "lengthMenu": [10, 50],

            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
            }
        });
        // text search
        $('.filter-input').keyup(function() {
            table.column($(this).data('column'))
                .search($(this).val())
                .draw();
        });
        // dropdown
        $('.filter-select').change(function() {
            table.column($(this).data('column'))
                .search($(this).val())
                .draw();
        });
    });
</script>

<script>
    window.onload = function() {
        $('#onload').fadeOut();
        $('.contenido').removeClass('hidden');
    }
</script>

<script>
    function LimpiarFiltros() {
        var table = $('#tablaClientes').DataTable();
        table.search('').columns().search('').draw();
        document.getElementById("select_tipo_empresa").options.item(0).selected = 'selected';
        document.getElementById("pagina_web").value = ' ';
        document.getElementById("responsable_registro").value = ' ';
        document.getElementById("fecha_creacion").value = ' ';
        document.getElementById("via_ingreso").value = ' ';
        document.getElementById("clasificacion").value = ' ';
        document.getElementById("nombre").value = ' ';
        document.getElementById("dni_ruc").value = ' ';

    }
</script>

<script>
    function Editar() {

        document.getElementById("eliminar").style.display = "block";
        $('.btn-eliminar').addClass('hidden');
        $('.btn-editar').removeClass('hidden');

    }

    function Eliminar() {

        document.getElementById("editar").style.display = "block";
        $('.btn-eliminar').removeClass('hidden');
        $('.btn-editar').addClass('hidden');

    }
</script>
@endsection
@section('css')
@include('admin.datatable')

@stop

@extends('adminlte::page')

@section('content')
@section('titulo', 'Transportistas')



<br>
<br>

<div class="app-title">
    <div>
        <h1>
            <a href="{{ route('transportistas') }}" class="btn btn-primary"
                style="background:#777;border-color:#777">Transportistas</a>
            <a href="{{ route('transportistas.contactos.mostrar') }}" class="btn btn-primary "
                style="color:#777;background:#fff;border-color:#777">Contactos de Transportistas</a>
            <a href="{{ route('vehiculos') }}" class="btn btn-primary "
                style="color:#777;background:#fff;border-color:#777">Transportes</a>

        </h1>

    </div><br>


    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home"></i></li>
        <li class="breadcrumb-item"><a href=""></a>Transportistas</li>
    </ul>
</div>
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

            <a class="btn btn-primary btn-sm" href="{{ route('transportistas.formulario.agregar') }}"
                style="margin-left:auto;width:120px;font-size:14px">
                <i class="fas fa-plus-square" aria-hidden="true"></i> Agregar </a>
        </div><br>
        <div class="tile-body">
            <div class="table-responsive">
                <table class="table table-bordered display" id="tablaTransportistas">
                    <thead>
                        <tr>
                            <td><input autocomplete="off" type="text" class="form-control filter-input" id="nombre"
                                    data-column="0" /></td>
                            <td><input autocomplete="off" type="text" class="form-control filter-input" id="dni_ruc"
                                    data-column="1" /></td>
                            <td>
                                <select data-column="2" class="form-control filter-select" id="select_tipo_empresa">
                                    <option value=" " selected></option>
                                    <option value="Empresa">Empresa</option>
                                    <option value="Persona Natural">Persona Natural</option>
                                </select>
                            </td>
                            <td><input autocomplete="off" type="text" class="form-control filter-input" id="direccion"
                                    data-column="3" /></td>
                            <td><input autocomplete="off" type="text" class="form-control filter-input" id="pagina_web"
                                    data-column="4" /></td>
                            <td><input autocomplete="off" type="text" class="form-control filter-input"
                                    id="tipo_transportista" data-column="5" /></td>
                            <td><input autocomplete="off" type="text" class="form-control filter-input"
                                    id="responsable_registro" data-column="6" /></td>
                            <td><input autocomplete="off" type="text" class="form-control filter-input"
                                    id="fecha_creacion" data-column="7" /></td>


                            <td></td>

                        </tr>
                        <tr style="background:#00000099;color:#fff;border:3px solid #fff">
                            <th>Nombre</th>
                            <th>DNI/RUC</th>
                            <th>Tipo de<br>Transportista</th>
                            <th>Direccion</th>
                            <th>Pagina Web</th>
                            <th>Tipo Transportista</th>
                            <th>Responsable<br>de Registro</th>
                            <th>Fecha de<br>Creacion</th>
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


</div>

<script>
    $(document).ready(function() {
        var table = $('#tablaTransportistas').DataTable({

            serverSider: true,
            ajax: '{{ route('lista_transportistas') }}',
            columns: [{
                    data: 'nombre'
                },
                {
                    data: 'dni_ruc'
                },
                {
                    data: 'tipo_transportista'
                },
                {
                    data: 'direccion'
                },
                {
                    data: 'pagina_web'
                },
                {
                    data: 'tipo_transportista'
                },
                {
                    data: 'responsable_registro'
                },
                {
                    data: 'created_at'
                },
                {
                    data: 'btn_transportistas'
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
        var table = $('#tablaTransportistas').DataTable();
        table.search('').columns().search('').draw();
        document.getElementById("nombre").value = ' ';
        document.getElementById("dni_ruc").value = ' ';
        document.getElementById("select_tipo_empresa").options.item(0).selected = 'selected';
        document.getElementById("direccion").value = ' ';
        document.getElementById("pagina_web").value = ' ';
        document.getElementById("tipo_transportista").value = ' ';
        document.getElementById("responsable_registro").value = ' ';
        document.getElementById("fecha_creacion").value = ' ';


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

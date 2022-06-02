@extends('adminlte::page')

@section('content_header')
    <br>
    <div class="app-title contenido hidden">
        <div>
            <h1>
                <a href="{{ route('transportistas') }}" class="btn btn-primary "
                    style="color:#777;background:#fff;border-color:#777">Transportistas</a>
                <a href="{{ route('transportistas.contactos.mostrar') }}" class="btn btn-primary"
                    style="background:#777;border-color:#777;color:#fff">Contactos de Transportistas</a>
                <a href="{{ route('vehiculos') }}" class="btn btn-primary "
                    style="color:#777;background:#fff;border-color:#777">Transportes</a>

            </h1>

        </div><br>


        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home"></i></li>
            <li class="breadcrumb-item"><a href=""></a>Contactos</li>
        </ul>
    </div>

@stop
@section('content')
@section('titulo', 'Contactos')

<div class="centrado" id="onload">
    <div class="lds-ring">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
    Cargando...
</div>


@include('notificacion')

<div class="col-md-8 contenido hidden" style="max-width:100%">

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
            <input class="form-control" name="usuario" id="usuario" type="hidden" value="{{ auth()->user()->id }}"
                autocomplete="off" />
            {{-- <a class="btn btn-primary btn-sm" href="{{ route('transportistas.formulario.agregar') }}"
                style="margin-left:auto;width:120px;font-size:14px">
                <i class="fas fa-plus-square" aria-hidden="true"></i> Agregar Transportista</a> --}}
        </div><br>
        <div class="tile-body">
            <div class="table-responsive">
                <table class="table table-bordered display" id="sampleTable">
                    <thead>
                        <tr>
                            <td><input autocomplete="off" type="text" class="form-control filter-input"
                                    id="cargo_contacto" data-column="0" /></td>
                            <td><input autocomplete="off" type="text" class="form-control filter-input"
                                    id="nombre_contacto" data-column="1" /></td>
                            <td><input autocomplete="off" type="text" class="form-control filter-input" id="celular"
                                    data-column="2" /></td>
                            <td><input autocomplete="off" type="text" class="form-control filter-input"
                                    id="correo_contacto" data-column="3" /></td>
                            <td><input autocomplete="off" type="text" class="form-control filter-input" id="empresa"
                                    data-column="4" /></td>
                            <td><input autocomplete="off" type="text" class="form-control filter-input" id="dni_ruc"
                                    data-column="5" /></td>
                            <td><input autocomplete="off" type="text" class="form-control filter-input" id="fecha"
                                    data-column="6" /></td>
                            <td></td>
                        </tr>
                        <tr style="background:#00000099;color:#fff;border:3px solid #fff">
                            <th>Nombre</th>
                            <th>DNI</th>
                            <th>Celular</th>
                            <th>Correo</th>
                            <th>Empresa</th>
                            <th>Responsable<br>Registro</th>
                            <th>Fecha<br>de Registro</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>


                        @include('admin.contactos.editar_contacto_transportista')

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


</div>
<script>
    $(document).ready(function() {
        var table = $('#sampleTable').DataTable({

            serverSider: true,
            ajax: '{{ route('lista_transportistas_contactos') }}',
            columns: [{
                    data: 'nombre'
                },
                {
                    data: 'dni'
                },
                {
                    data: 'celular'
                },
                {
                    data: 'correo'
                },
                {
                    data: 'empresa'
                },
                {
                    data: 'responsable_registro'
                },
                {
                    data: 'created_at'
                },
                {
                    data: 'btn_transportistas_contactos'
                }
            ],
            "order": [
                [6, "desc"]
            ],
            "pageLength": 10,
            "lengthMenu": [10, 50],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
            },
            // asigna un id a cada tr
            fnCreatedRow: function(rowEl, data) {
                $(rowEl).attr('id', data['id']);
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

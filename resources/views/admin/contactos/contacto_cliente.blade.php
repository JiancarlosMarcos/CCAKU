@extends('adminlte::page')
@section('titulo', 'Contactos')

@section('content')
    <br>
    <br>
    <div class="centrado" id="onload">
        <div class="lds-ring">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
        Cargando...
    </div>

    <div class="app-title contenido hidden">
        <div>
            <h1>
                <a href="{{ route('clientes') }}" class="btn btn-primary "
                    style="color:#777;background:#fff;border-color:#777">Clientes</a>
                <a href="{{ route('clientes.contactos.mostrar') }}" class="btn btn-primary"
                    style="background:#777;border-color:#777;color:#fff">Contactos de Clientes</a>
                <a href="{{ route('cargas') }}" class="btn btn-primary "
                    style="color:#777;background:#fff;border-color:#777">Carga</a>


            </h1>

        </div><br>


        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home"></i></li>
            <li class="breadcrumb-item"><a href=""></a>Contactos</li>
        </ul>
    </div>

    @include('notificacion')

    <div class="col-md-8 contenido hidden" style="max-width:100%">

        <div class="tile">

            <div style="display:flex">

                <a class="btn btn-primary " onclick="LimpiarFiltros();" style="margin-rigth:auto;width:140px;
                                                            font-size:14px;background:#ECDCC2;border-color:#777">
                    <i class="fas fa-filter" aria-hidden="true"></i> Limpiar Filtros </a>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <a class="btn btn-primary" onclick="Eliminar();" id="eliminar"
                    style="margin-rigth:auto;width:140px;yo
                                                            font-size:14px;background:#ECDCC2;border-color:#777;color:#777">
                    <i class="fas fa-trash" aria-hidden="true"></i> Eliminar </a>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <a class="btn btn-primary" onclick="Editar();" id="editar"
                    style="margin-rigth:auto;width:140px;display:block;
                                                            font-size:14px;background:#ECDCC2;border-color:#777;color:#777">
                    <i class="fas fa-pencil-alt" aria-hidden="true"></i> Editar </a>


            </div><br>
            <div class="tile-body">
                <div class="table-responsive">
                    <table class="table table-bordered display" id="sampleTable">
                        <thead>
                            <tr>
                                <td><input autocomplete="off" type="text" class="form-control filter-input" id="dni_ruc"
                                        data-column="0" /></td>
                                <td><input autocomplete="off" type="text" class="form-control filter-input"
                                        id="nombre_contacto" data-column="1" /></td>
                                <td><input autocomplete="off" type="text" class="form-control filter-input" id="cargo"
                                        data-column="2" /></td>
                                <td><input autocomplete="off" type="text" class="form-control filter-input" id="celuar"
                                        data-column="3" /></td>
                                <td><input autocomplete="off" type="text" class="form-control filter-input" id="correo"
                                        data-column="4" /></td>
                                <td><input autocomplete="off" type="text" class="form-control filter-input" id="empresa"
                                        data-column="5" /></td>
                                <td><input autocomplete="off" type="text" class="form-control filter-input"
                                        id="fecha_creacion" data-column="6" /></td>
                                <td><input autocomplete="off" type="text" class="form-control filter-input"
                                        id="fecha_modificacion" data-column="7" /></td>
                                <td></td>
                            </tr>
                            <tr style="background:#00000099;color:#fff;border:3px solid #fff">
                                <th>DNI</th>
                                <th>Nombre</th>
                                <th>Cargo</th>
                                <th>Celular</th>
                                <th>Correo</th>
                                <th>Empresa</th>
                                <th>Fecha<br>de Creacion</th>
                                <th>Fecha<br>de Actualizacion</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>


                            @include(
                                'admin.contactos.editar_contacto_cliente'
                            )

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
                ajax: '{{ route('lista_clientes_contactos') }}',
                columns: [{
                        data: 'dni'
                    },
                    {
                        data: 'nombre'
                    },
                    {
                        data: 'cargo'
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
                        data: 'created_at'
                    },
                    {
                        data: 'updated_at'
                    },
                    {
                        data: 'btn_clientes_contactos'
                    }
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
        function LimpiarFiltros() {
            var table = $('#sampleTable').DataTable();
            table.search('').columns().search('').draw();
            document.getElementById("dni_ruc");
            document.getElementById("nombre_contacto").value = ' ';
            document.getElementById("cargo").value = ' ';
            document.getElementById("celular").value = ' ';
            document.getElementById("correo").value = ' ';
            document.getElementById("empresa").value = ' ';
            document.getElementById("fecha_creacion").value = ' ';
            document.getElementById("fecha_modificacion").value = ' ';
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

@extends('adminlte::page')
@section('titulo', 'Usuarios')
@section('content_header')
    <br>

    <div class="app-title">
        <div>
            <a href="{{ route('usuarios') }}" class="btn btn-primary"
                style="background:#777;border-color:#777">Usuarios</a>
            <a href="{{ route('usuarios.formulario.agregar.administrador') }}" class="btn btn-primary "
                style="color:#777;background:#fff;border-color:#777">Registrar Administrador</a>
            <a href="{{ route('usuarios.formulario.agregar.transportista') }}" class="btn btn-primary "
                style="color:#777;background:#fff;border-color:#777">Registrar Transportista</a>

            <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a>Usuarios</a></li>
        </ul>
    </div>
@stop
@section('content')

    <style>
        .botones {
            display: flex;
            justify-content: space-between;

        }

        .botones2 {
            display: flex;
            justify-content: center;

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
    @include('notificacion')
    <div class="col-md-8" style="max-width:100%">

        <div class="tile">

            <div class="botones" style="display:flex">
                <div class="botones2">
                    <a class="btn btn-primary " onclick="LimpiarFiltros();" style="margin-rigth:auto;width:140px;
                                                                    font-size:14px;background:#ECDCC2;border-color:#777">
                        <i class="fas fa-filter" aria-hidden="true"></i> Limpiar Filtros </a>
                    <a class="btn btn-primary" onclick="Eliminar();" id="eliminar"
                        style="margin-rigth:auto;width:140px;yo
                                                                    font-size:14px;background:#ECDCC2;border-color:#777;color:#777">
                        <i class="fas fa-trash" aria-hidden="true"></i> Eliminar </a>

                    <a class="btn btn-primary" onclick="Editar();" id="editar"
                        style="margin-rigth:auto;width:140px;display:block;
                                                                    font-size:14px;background:#ECDCC2;border-color:#777;color:#777">
                        <i class="fas fa-pencil-alt" aria-hidden="true"></i> Editar </a>
                </div>
                <div>
                    <a class="btn btn-primary btn-sm" href="{{ route('usuarios.formulario.agregar.administrador') }}"
                        style="margin-left:auto;width:200px;font-size:14px">
                        <i class="fas fa-plus-square" aria-hidden="true"></i> Registrar Administrador </a>
                    <a class="btn btn-primary btn-sm" href="{{ route('usuarios.formulario.agregar.transportista') }}"
                        style="margin-left:auto;width:200px;font-size:14px">
                        <i class="fas fa-plus-square" aria-hidden="true"></i> Registrar Transportista </a>
                </div>





            </div><br>
            <div class="tile-body">
                <div class="table-responsive">
                    <table class="table table-bordered display" id="tablaUsuarios">
                        <thead>
                            <tr>
                                <td><input autocomplete="off" type="text" class="form-control filter-input" id="nombre"
                                        data-column="0" /></td>
                                <td><input autocomplete="off" type="text" class="form-control filter-input" id="email"
                                        data-column="1" /></td>
                                <td>
                                    <select data-column="2" class="form-control filter-select" id="rol">
                                        <option value=" " selected></option>
                                        <option value="administrador">administrador</option>
                                        <option value="cliente">cliente</option>
                                        <option value="transportista">transportista</option>
                                    </select>
                                </td>
                                <td><input autocomplete="off" type="text" class="form-control filter-input" id="empresa"
                                        data-column="3" /></td>
                                <td><input autocomplete="off" type="text" class="form-control filter-input"
                                        id="responsable_registro" data-column="4" /></td>

                                <td><input autocomplete="off" type="text" class="form-control filter-input"
                                        id="fecha_creacion" data-column="5" /></td>

                                <td></td>

                            </tr>
                            <tr style="background:#00000099;color:#fff;border:3px solid #fff">
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Rol</th>
                                <th>Empresa</th>
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
            var table = $('#tablaUsuarios').DataTable({

                serverSider: true,
                ajax: '{{ route('lista_usuarios') }}',
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'rol'
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
                        data: 'btn_usuarios'
                    },

                ],
                "columnDefs": [{
                        "sClass": "hidden",
                        "targets": 0,
                    },

                ],
                "order": [
                    [0, "desc"]
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
            var table = $('#tablaUsuarios').DataTable();
            table.search('').columns().search('').draw();
            document.getElementById("nombre").value = ' ';
            document.getElementById("email").value = ' ';
            document.getElementById("rol").options.item(0).selected = 'selected';
            document.getElementById("empresa").value = ' ';
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

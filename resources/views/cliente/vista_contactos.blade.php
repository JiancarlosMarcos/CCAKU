@extends('adminlte::page')
@section('titulo', 'Contactos')
@section('content_header')
    <br>
    <?php $user = Auth::user()->id; ?>
    @foreach ($contactos as $contacto)
        @if ($contacto->id_users == $user)
            @foreach ($clientes as $cliente)
                @if ($contacto->id_cliente == $cliente->id)
                    <?php $id_cliente = $cliente->id; ?>
                @endif
            @endforeach
        @endif
    @endforeach
    <div class="app-title">
        <div>
            <h1>
                <a href="{{ route('cargas.mostrar') }}" class="btn btn-primary "
                    style="color:#777;background:#fff;border-color:#777">Lista de Equipos</a>
                <a href="{{ route('cliente.contactos.mostrar') }}" class="btn btn-primary "
                    style="background:#777;border-color:#777">Lista de Contactos</a>
                <a href="{{ route('cliente.editar_cliente', $id_cliente) }}" class="btn btn-primary "
                    style="color:#777;background:#fff;border-color:#777">Agregar/Modificar Datos</a>
            </h1>

        </div><br>

        <input type="hidden" name="usuario" id="usuario" value="{{ auth()->user()->id }}">
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home"></i></li>
            <li class="breadcrumb-item"><a href=""></a>Empresa</li>
            <li class="breadcrumb-item"><a href=""></a>Contactos</li>
        </ul>
    </div>
@stop
@section('content')

    <div class="centrado" id="onload">
        <div class="lds-ring">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
        Cargando...
    </div>

    <h1 style="text-align: center">Lista de Contactos</h1>
    <br>
    @include('notificacion')

    <div class="col-md-8 contenido hidden" style="max-width:100%">

        <div class="tile">

            <div style="display:flex">

                <a class="btn btn-primary " onclick="LimpiarFiltros();"
                    style="margin-rigth:auto;width:140px;
                                                                                                                                                                                            font-size:14px;background:#ECDCC2;border-color:#777">
                    <i class="fas fa-filter" aria-hidden="true"></i> Limpiar Filtros </a>
                &nbsp;&nbsp;&nbsp;&nbsp;

                {{-- <a class="btn btn-primary btn-sm" href="{{ route('cliente.editar_cliente', $id_cliente) }}"
                    style="margin-left:auto;width:140px;font-size:14px">
                    Agregar/Modificar </a> --}}
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

                                {{-- <td></td> --}}
                            </tr>
                            <tr style="background:#00000099;color:#fff;border:3px solid #fff">
                                <th>DNI</th>
                                <th>Nombre</th>
                                <th>Cargo</th>
                                <th>Celular</th>
                                <th>Correo</th>
                                <th>Empresa</th>
                                <th>Fecha<br>de Creacion</th>
                                {{-- <th>Acciones</th> --}}
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
            var table = $('#sampleTable').DataTable({

                serverSider: true,
                ajax: '{{ route('cliente.lista_clientes_contactos', ['usuario' => $user]) }}',
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
                    // {
                    //     data: 'btn_editar_carga'
                    // }
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

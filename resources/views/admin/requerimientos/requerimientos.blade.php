@extends('adminlte::page')

@section('content')
@section('titulo', 'Requerimientos')
<style>
    .hidden {
        overflow: hidden;
        visibility: hidden;
    }

    .centrado {
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;

    }

</style>


<br>
<br>

<div class="app-title">
    <div>
        <h3>Requerimientos de Clientes</h3>

    </div><br>


    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home"></i></li>
        <li class="breadcrumb-item"><a href=""></a>Requerimientos</li>
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

            <a class="btn btn-primary btn-sm" href="{{ route('agregar_requerimiento') }}"
                style="margin-left:auto;width:120px;font-size:14px">
                <i class="fas fa-plus-square" aria-hidden="true"></i> Agregar </a>
        </div><br>
        <div class="tile-body">
            <div class="table-responsive">
                <table class="table table-bordered display" id="tablaClientes">
                    <thead>
                        <tr>

                            <td><input autocomplete="off" type="text" class="form-control filter-input" id="empresa"
                                    data-column="0" /></td>
                            <td><input autocomplete="off" type="text" class="form-control filter-input" id="fecha"
                                    data-column="1" /></td>
                            {{-- <td>
                                <select data-column="2" class="form-control filter-select" id="select_tipo_empresa">
                                    <option value=" " selected></option>
                                    <option value="Empresa">Empresa</option>
                                    <option value="Persona Natural">Persona Natural</option>
                                </select>
                            </td> --}}
                            <td><input autocomplete="off" type="text" class="form-control filter-input" id="origen"
                                    data-column="2" /></td>
                            <td><input autocomplete="off" type="text" class="form-control filter-input" id="destino"
                                    data-column="3" /></td>
                            {{-- <td><input autocomplete="off" type="text" class="form-control filter-input" id="carga"
                                    data-column="4" /></td> --}}
                            {{-- <td><input autocomplete="off" type="text" class="form-control filter-input" id="marca"
                                    data-column="5" /></td>
                            <td><input autocomplete="off" type="text" class="form-control filter-input" id="modelo"
                                    data-column="6" /></td> --}}
                            {{-- <td><input autocomplete="off" type="text" class="form-control filter-input" id="volumen"
                                    data-column="7" /></td>
                            <td><input autocomplete="off" type="text" class="form-control filter-input" id="peso"
                                    data-column="8" /></td>
                            <td><input autocomplete="off" type="text" class="form-control filter-input" id="unidad"
                                    data-column="9" /></td> --}}
                            {{-- <td><input autocomplete="off" type="text" class="form-control filter-input" id="transporte"
                                    data-column="10" /></td> --}}
                            {{-- <td><input autocomplete="off" type="text" class="form-control filter-input"
                                    id="observaciones" data-column="11" /></td> --}}
                            <td><input autocomplete="off" type="text" class="form-control filter-input" id="estado"
                                    data-column="12" /></td>
                            <td><input autocomplete="off" type="text" class="form-control filter-input"
                                    id="fecha_creacion" data-column="13" /></td>
                            {{-- <td><input autocomplete="off" type="text" class="form-control filter-input"
                                    id="fecha_modificacion" data-column="14" /></td> --}}




                            <td></td>

                        </tr>
                        <tr style="background:#00000099;color:#fff;border:3px solid #fff">

                            <th>Empresa</th>
                            <th>Fecha</th>
                            <th>Origen</th>
                            <th>Destino</th>
                            {{-- <th>Carga</th> --}}
                            {{-- <th>Marca</th>
                            <th>Modelo</th> --}}
                            {{-- <th>Volumen</th>
                            <th>Peso</th>
                            <th>Unidad Medidad</th> --}}
                            {{-- <th>Transporte<br>Requerido</th> --}}
                            {{-- <th>Observaciones</th> --}}
                            <th>Estado</th>
                            <th>Fecha de<br>Creacion</th>
                            {{-- <th>Fecha de<br>Modificacion</th> --}}
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
        var table = $('#tablaClientes').DataTable({

            serverSider: true,
            ajax: '{{ route('lista_requerimientos') }}',
            columns: [{
                    data: 'empresa'
                },
                {
                    data: 'fecha'
                },
                {
                    data: 'departamento_origen'
                },
                {
                    data: 'departamento_destino'
                },
                // {
                //     data: 'carga'
                // },
                // {
                //     data: 'marca'
                // },
                // {
                //     data: 'modelo'
                // },
                // {
                //     data: 'volumen'
                // },
                // {
                //     data: 'peso'
                // },
                // {
                //     data: 'unidad_medida_peso'
                // },
                // {
                //     data: 'transporte_requerido'
                // },
                // {
                //     data: 'observaciones'
                // },
                {
                    data: 'estado'
                },
                {
                    data: 'created_at'
                },
                // {
                //     data: 'updated_at'
                // },
                {
                    data: 'btn_requerimientos'
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
        document.getElementById("empresa").value = ' ';
        document.getElementById("fecha").value = ' ';

        // document.getElementById("select_tipo_empresa").options.item(0).selected = 'selected';
        document.getElementById("origen").value = ' ';
        document.getElementById("destino").value = ' ';
        // document.getElementById("carga").value = ' ';

        // document.getElementById("transporte").value = ' ';
        document.getElementById("observaciones").value = ' ';
        document.getElementById("estado").value = ' ';
        document.getElementById("fecha_creacion").value = ' ';
        // document.getElementById("fecha_modificacion").value = ' ';
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

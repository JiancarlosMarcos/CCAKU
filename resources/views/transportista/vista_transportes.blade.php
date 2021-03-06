@extends('adminlte::page')
@section('content_header')

    <?php $user = Auth::user()->id; ?>
    @foreach ($contactos as $contacto)
        @if ($contacto->id_users == $user)
            @foreach ($transportistas as $transportista)
                @if ($contacto->id_transportista == $transportista->id)
                    <?php $id_transportista = $transportista->id; ?>
                @endif
            @endforeach
        @endif
    @endforeach
    <br>
    <div class="app-title">
        <div>
            <h1>
                <a href="{{ route('transportista.vehiculos') }}" class="btn btn-primary "
                    style="background:#777;border-color:#777">Lista de Transportes</a>
                <a href="{{ route('transportista.contactos.mostrar') }}" class="btn btn-primary "
                    style="color:#777;background:#fff;border-color:#777">Lista de Contactos</a>
                <a href="{{ route('transportista.editar_transportista', $id_transportista) }}" class="btn btn-primary "
                    style="color:#777;background:#fff;border-color:#777">Agregar/Modificar Equipos</a>
            </h1>

        </div><br>

        <input type="hidden" name="usuario" id="usuario" value="{{ auth()->user()->id }}">
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home"></i></li>
            <li class="breadcrumb-item"><a href=""></a>Mi Empresa</li>
            <li class="breadcrumb-item"><a href=""></a>Equipos</li>
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
<h1 style="text-align: center">Lista de Equipos de Transporte</h1>
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
            <a class="btn btn-primary btn-sm"
                href="{{ route('transportista.editar_transportista', $id_transportista) }}"
                style="margin-left:auto;width:140px;font-size:14px">
                Agregar/Modificar </a>
        </div><br>
        <div class="tile-body">
            <div class="table-responsive">
                <table class="table table-bordered display" id="tablaClientes">
                    <thead>
                        <tr>

                            <td><input autocomplete="off" type="text" class="form-control filter-input" id="empresa"
                                    data-column="0" /></td>
                            <td>
                                <select data-column="1" class="form-control filter-select" id="select_tipo_empresa">
                                    <option value=" " selected></option>
                                    <option value="Camion Plataforma">Camion Plataforma</option>
                                    <option value="Camion Rebatible">Camion Rebatible</option>
                                    <option value="Camion Normal">Camion Normal</option>
                                    <option value="Camacuna">Camacuna</option>
                                    <option value="Camabaja">Camabaja</option>
                                    <option value="Tracto">Tracto</option>
                                    <option value="Modulares">Modulares</option>
                                </select>
                            </td>
                            <td><input autocomplete="off" type="text" class="form-control filter-input" id="marca"
                                    data-column="2" /></td>
                            <td><input autocomplete="off" type="text" class="form-control filter-input" id="modelo"
                                    data-column="3" /></td>
                            <td><input autocomplete="off" type="text" class="form-control filter-input" id="placa"
                                    data-column="4" /></td>
                            <td><input autocomplete="off" type="text" class="form-control filter-input" id="ubicacion"
                                    data-column="5" /></td>
                            <td>
                                <select data-column="6" class="form-control filter-select" id="estado">
                                    <option value=" " selected></option>
                                    <option value="DISPONIBLE">DISPONIBLE</option>
                                    <option value="NO DISPONIBLE">NO DISPONIBLE</option>
                                    <option value="DADO DE BAJA">DADO DE BAJA</option>
                                </select>
                            </td>
                            <td><input autocomplete="off" type="text" class="form-control filter-input" id="dimensiones"
                                    data-column="7" /></td>
                            <td><select data-column="8" class="form-control filter-select" id="tipo_transporte">
                                    <option value=" " selected></option>
                                    <option value="PROPIO">PROPIO</option>
                                    <option value="SUBARRENDADO">SUBARRENDADO</option>
                                </select></td>
                            <td><input autocomplete="off" type="text" class="form-control filter-input"
                                    id="responsable_registro" data-column="9" /></td>



                        </tr>
                        <tr style="background:#00000099;color:#fff;border:3px solid #fff">
                            <th style="width:12%">Empresa</th>
                            <th style="width:10%">Tipo Transporte</th>
                            <th style="width:12%">Marca</th>
                            <th style="width:10%">Modelo</th>
                            <th style="width:4%">Placa</th>
                            <th style="width:8%">Ubicacion</th>
                            <th style="width:8%">Estado</th>
                            <th style="width:12%">Dimensiones<br>(Largo x Ancho x Alto) Metros</th>
                            <th style="width:12%">Propio/Subarrendado</th>
                            <th style="width:12%">Responsable Registro</th>

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
            ajax: '{{ route('lista_vehiculos_transportista', ['usuario' => $user]) }}',
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
                    data: 'departamento'
                },
                {
                    data: 'estado'
                },
                {
                    data: 'volumen'
                },
                {
                    data: 'tipo_transporte'
                },
                {
                    data: 'responsable_registro'
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
        document.getElementById("empresa").value = "";
        document.getElementById("select_tipo_empresa").options.item(0).selected = 'selected';
        document.getElementById("marca").value = "";
        document.getElementById("modelo").value = "";
        document.getElementById("placa").value = "";
        document.getElementById("ubicacion").value = "";
        document.getElementById("estado").options.item(0).selected = 'selected';
        document.getElementById("dimensiones").value = "";
        document.getElementById("tipo_transporte").options.item(0).selected = 'selected';
        document.getElementById("responsable_registro").value = "";
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

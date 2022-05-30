@extends('adminlte::page')

@section('content')
@section('titulo', 'Cotizaciones')
<style>
    .hidden {

        display: none;
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
        {{-- <h1>
      <a href="{{route('clientes')}}" class="btn btn-primary" style="background:#777;border-color:#777">Clientes</a>
        <a href="{{route('clientes.contactos.mostrar')}}" class="btn btn-primary "
            style="color:#777;background:#fff;border-color:#777">Contactos de Clientes</a>
        <a href="{{route('cargas')}}" class="btn btn-primary "
            style="color:#777;background:#fff;border-color:#777">Cargas</a>

        </h1> --}}
        <h3>Cotizaciones de Clientes</h3>
    </div><br>


    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home"></i></li>
        <li class="breadcrumb-item"><a href=""></a>Cotizaciones</li>
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


        </div><br>
        <div class="tile-body">
            <div class="table-responsive">
                <table class="table table-bordered display table-hover" id="tablaCotizaciones">
                    <thead>
                        <tr>

                            <td><input autocomplete="off" type="text" class="form-control filter-input" id="empresa"
                                    data-column="0" /></td>
                            <td><input autocomplete="off" type="text" class="form-control filter-input" id="fecha"
                                    data-column="1" /></td>

                            <td><input autocomplete="off" type="text" class="form-control filter-input" id="origen"
                                    data-column="2" /></td>
                            <td><input autocomplete="off" type="text" class="form-control filter-input" id="destino"
                                    data-column="3" /></td>
                            <td><input autocomplete="off" type="text" class="form-control filter-input" id="carga"
                                    data-column="4" /></td>
                            <td><input autocomplete="off" type="text" class="form-control filter-input" id="marca"
                                    data-column="5" /></td>
                            <td><input autocomplete="off" type="text" class="form-control filter-input" id="modelo"
                                    data-column="6" /></td>
                            <td><input autocomplete="off" type="text" class="form-control filter-input" id="volumen"
                                    data-column="7" /></td>
                            <td><input autocomplete="off" type="text" class="form-control filter-input" id="peso"
                                    data-column="8" /></td>
                            <td></td>
                            <td class="hidden"></td>

                        </tr>
                        <tr style="background:#00000099;color:#fff;border:3px solid #fff">
                            <th>ID</th>
                            <th>Empresa</th>
                            <th>Fecha</th>
                            <th>Origen</th>
                            <th>Destino</th>
                            <th>Carga</th>
                            <th>Monto Total</th>
                            <th>Moneda</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                            <th class="hidden">NRO VERSION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @include('admin.cotizaciones.historial_pdf.mostrar_historial')

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</div>

<script>
    $(document).ready(function() {
        var table = $('#tablaCotizaciones').DataTable({

            serverSider: true,
            ajax: '{{ route('lista_cotizaciones') }}',
            columns: [{
                    data: 'id'
                },
                {
                    data: 'empresa'
                },
                {
                    data: 'fecha_transporte'
                },
                {
                    data: 'departamento_origen'
                },
                {
                    data: 'departamento_destino'
                },
                {
                    data: 'carga'
                },
                {
                    data: 'monto_total'
                },
                {
                    data: 'moneda'
                },

                {
                    data: 'estado'
                },
                {
                    data: 'btn_cotizaciones'
                },
                {
                    data: 'version_cotizacion'
                },


            ],
            "columnDefs": [{
                    "sClass": "hidden",
                    "targets": 10,
                },

                {
                    "render": function(data, type, row) {
                        var nfs = new Intl.NumberFormat("es-PE", {
                            style: "currency",
                            currency: "PEN",
                            maximumFractionDigits: 2,
                            roundingIncrement: 5
                        });
                        var nfd = new Intl.NumberFormat("en-US", {
                            style: "currency",
                            currency: "USD",
                            maximumFractionDigits: 2,
                            roundingIncrement: 5
                        });

                        if (row["monto_total"] == null || row["moneda"] == null) {
                            return "<center>-</center>";
                        } else {
                            if (row["moneda"] == "Soles") {
                                return "<center>" + nfs.format(row["monto_total"]) + " " + row[
                                    "moneda"] + "</center>";
                            }
                            if (row["moneda"] == "Dolares") {
                                return "<center>" + nfd.format(row["monto_total"]) + " " + row[
                                    "moneda"] + "</center>";
                            }
                        }
                    },
                    "targets": 6
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
        //   ////CLICK EN FILA DE TABLA
        // $('#tablaCotizaciones tbody').on('dblclick', 'tr', function () {
        //     var data_tabla = table.row(this).data();
        //     mostrar_vista(data_tabla["id"],data_tabla["version_cotizacion"]);
        // });
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
        var table = $('#tablaCotizaciones').DataTable();
        table.search('').columns().search('').draw();
        document.getElementById("empresa").value = ' ';
        document.getElementById("fecha").value = ' ';

        // document.getElementById("select_tipo_empresa").options.item(0).selected = 'selected';
        document.getElementById("origen").value = ' ';
        document.getElementById("destino").value = ' ';
        document.getElementById("carga").value = ' ';
        document.getElementById("marca").value = ' ';
        document.getElementById("modelo").value = ' ';
        document.getElementById("volumen").value = ' ';
        document.getElementById("peso").value = ' ';
        document.getElementById("unidad").value = ' ';
        // document.getElementById("transporte").value = ' ';
        document.getElementById("observaciones").value = ' ';
        document.getElementById("estado").value = ' ';
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
@include('admin.cotizaciones.historial_pdf.form_historial')

@endsection
@section('css')
@include('admin.datatable')
@stop

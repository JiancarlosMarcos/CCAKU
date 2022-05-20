@extends('adminlte::page')

@section('content')
@section('titulo', 'Clientes')
<style>
    @import url(https://fonts.googleapis.com/css?family=Montserrat);

    .lds-ring {
        display: inline-block;
        position: relative;
        width: 80px;
        height: 80px;
    }

    .lds-ring div {
        box-sizing: border-box;
        display: block;
        position: absolute;
        width: 64px;
        height: 64px;
        margin: 8px;
        border: 8px solid #123;
        border-radius: 50%;
        animation: lds-ring 1.5s cubic-bezier(0.5, 0, 0.5, 1) infinite;
        border-color: #123 transparent transparent transparent;
    }

    .lds-ring div:nth-child(1) {
        animation-delay: -0.30s;
    }

    .lds-ring div:nth-child(2) {
        animation-delay: -0.15s;
    }

    .lds-ring div:nth-child(3) {
        animation-delay: -0.15s;
    }

    @keyframes lds-ring {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

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
        <h1>
            <a href="{{ route('transportistas') }}" class="btn btn-primary"
                style="color:#777;background:#fff;border-color:#777">Transportistas</a>
            <a href="{{ route('transportistas.contactos.mostrar') }}" class="btn btn-primary "
                style="color:#777;background:#fff;border-color:#777">Contactos de Transportistas</a>
            <a href="{{ route('vehiculos') }}" class="btn btn-primary "
                style="background:#777;border-color:#777">Transportes</a>

        </h1>

    </div><br>

    <input type="hidden" name="usuario" id="usuario" value="{{ auth()->user()->id }}">
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home"></i></li>
        <li class="breadcrumb-item"><a href=""></a>Transportes</li>
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

            {{-- <a class="btn btn-primary btn-sm" href="{{ route('transportistas.formulario.agregar') }}"
                style="margin-left:auto;width:120px;font-size:14px">
                <i class="fas fa-plus-square" aria-hidden="true"></i> Agregar Transportista</a> --}}
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

                            <td></td>

                        </tr>
                        <tr style="background:#00000099;color:#fff;border:3px solid #fff">
                            <th style="width:12%">Empresa</th>
                            <th style="width:10%">Tipo Transporte</th>
                            <th style="width:12%">Marca</th>
                            <th style="width:10%">Modelo</th>
                            <th style="width:4%">Placa</th>
                            <th style="width:8%">Ubicacion</th>
                            <th style="width:8%">Estado</th>
                            <th style="width:12%">Dimensiones</th>
                            <th style="width:12%">Propio/Subarrendado</th>
                            <th style="width:12%">Responsable Registro</th>
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
                {
                    data: 'btn_transportes'
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
<!-- SELECT 2 JS CSS-->
<script src="{{ asset('js2/jquery/jquery.min.js') }}"></script>
<!-- NUEVO JQUERY-->

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- Main CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('css2/main.css') }}">

<link rel="stylesheet" href="{{ asset('css2/product.css') }}">
<!-- Font-icon css-->
<link rel="stylesheet" type="text/css"
    href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<!--  extension responsive  -->

<link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">

<style>
    .bg-principal {
        background: #222d32;
        color: #fff;
    }

</style>
<style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type=number] {
        -moz-appearance: textfield;
    }

</style>

@stop
@section('js')
<!-- Essential javascripts for application to work-->
<!--<script src="{{ asset('backend/js/jquery-3.3.1.min.js') }}"></script>-->
<script src="{{ asset('js2/popper.min.js') }}"></script>
<script src="{{ asset('js2/bootstrap.min.js') }}"></script>
<script src="{{ asset('js2/main.js') }}"></script>

<script src="{{ asset('js2/product.js') }}"></script>

<script type="text/javascript" src="{{ asset('js2/plugins/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js2/plugins/dataTables.bootstrap.min.js') }}"></script>





<script src="https://kit.fontawesome.com/102c277d5c.js" crossorigin="anonymous"></script>
<!-- extension responsive -->
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.2.2/js/dataTables.fixedHeader.min.js"></script>

<!-- The javascript plugin to display page loading on top-->
<script src="{{ asset('js2/plugins/pace.min.js') }}"></script>
<!-- Page specific javascripts-->
<script type="text/javascript" src="{{ asset('js2/plugins/chart.js') }}"></script>
<script type="text/javascript"></script>



<script type="text/javascript" src="{{ asset('js2/plugins/sweetalert.min.js') }}"></script>

<script>
    //SweetAlert2 Para eliminar
    $(function() {
        $(document).on('click', '#delete', function(e) {
            e.preventDefault();
            var link = $(this).attr("href");
            swal({
                title: "Estas Seguro?",
                text: "Una vez eliminado, no podrás recuperarlo",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Sí, Eliminarlo",
                cancelButtonText: "No, Cancelarlo",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm) {
                if (isConfirm) {
                    window.location.href = link

                } else {
                    swal("Cancelado", "", "error");
                }
            });
        });
    });
</script>
@stop
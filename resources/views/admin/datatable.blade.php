@extends('adminlte::page')
@section('title', 'Clientes')

@section('content_header')

@stop

@section('content')
    {{-- @include('buscador') --}}
    {{-- <h1>AQUI VAN LOS DASHBOARDS</h1> --}}
@stop

@section('css')

    <!-- SELECT 2 JS CSS-->
    <script src="{{ asset('js2/jquery/jquery.min.js') }}"></script>
    <!-- NUEVO JQUERY-->

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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
    {{-- <script src="{{ asset('js2/popper.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('js2/bootstrap.min.js') }}"></script> --}}
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

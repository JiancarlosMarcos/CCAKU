@extends('adminlte::page')
@section('title', 'Perfil')

@section('content_header')

@stop

@section('content')


    <?php foreach ($usuarios as $usuario) {
        if (auth()->user()->id == $usuario->id) {
            $nombre = $usuario->name;
            $email = $usuario->email;
        }
    }
    foreach ($contactos as $contacto) {
        if (auth()->user()->id == $contacto->id_users) {
            $id_contacto = $contacto->id;
            $id_cliente = $contacto->id_cliente;
            $dni = $contacto->dni;
            $cargo = $contacto->cargo;
            $telefono = $contacto->celular;
        }
    }
    foreach ($clientes as $cliente) {
        if ($id_cliente == $cliente->id) {
            $ruc = $cliente->dni_ruc;
            $empresa = $cliente->nombre;
        }
    }
    ?>
    <div class="Perfil">
        <h3>Informacion del Usuario</h3>
        <br>



        <form method="POST" action="{{ route('actualizar_perfil') }}" class="centrar-form">
            @csrf
            @include('notificacion')
            <h5>Datos personales</h5>
            <input type="hidden" name="id_usuario" value="{{ auth()->user()->id }}">
            <input type="hidden" name="id_contacto" value="{{ $id_contacto }}">
            <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label" style="font-weight:600;color:#777">NOMBRE: </label>
                        <input class="form-control" name="nombre" type="text" value="{{ $nombre }}"
                            autocomplete="off" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label" style="font-weight:600;color:#777">CORREO: <a
                                style="color:#B61A1A"></a></label>
                        <input class="form-control" name="correo" type="text" autocomplete="off"
                            value="{{ $email }}" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label" style="font-weight:600;color:#777">DNI: </label>
                        <input class="form-control" name="dni" type="number" autocomplete="off" id="dni_ruc"
                            value="{{ $dni }}" />
                    </div>
                </div>



                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label" style="font-weight:600;color:#777">TELEFONO: <a
                                style="color:#B61A1A"></a></label>
                        <input class="form-control" name="telefono" type="text" autocomplete="off"
                            value="{{ $telefono }}" />
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label" style="font-weight:600;color:#777">CARGO: <a
                                style="color:#B61A1A"></a></label>
                        <input class="form-control" name="cargo" type="text" autocomplete="off"
                            value="{{ $cargo }}" />
                    </div>
                </div>
            </div>
            <h5>Datos de la empresa</h5>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label" style="font-weight:600;color:#777">RUC: </label>
                        <input class="form-control" name="ruc" type="number" readonly autocomplete="off" id="dni_ruc"
                            value="{{ $ruc }}" />
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label" style="font-weight:600;color:#777">EMPRESA: </label>
                        <input class="form-control" name="empresa" type="text" readonly value="{{ $empresa }}"
                            autocomplete="off" />
                    </div>
                </div>

            </div>


            <button type="submit" class="btn btn-primary btn-sm"
                style="background:rgb(13, 86, 74);color:#fff;border-color:#777">
                <i class="fa-solid fa-arrows-retweet"></i>Actualizar Perfil</button>
        </form>
    </div>


@stop

@section('css')
    <style>
        .Perfil {
            margin: 0px 30px;
        }

    </style>
    @include('admin.datatable')
@stop

@section('js')

@stop

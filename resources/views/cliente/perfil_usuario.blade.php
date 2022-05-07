@extends('adminlte::page')
@section('title', 'Perfil')

@section('content_header')

@stop

@section('content')
    <h3>Informacion del Usuario</h3>
    <h5>Datos personales</h5>
    <div class="row">

        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label" style="font-weight:600;color:#777">DNI: </label>
                <input class="form-control" name="dni_ruc" type="number" autocomplete="off" id="dni_ruc" />
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label" style="font-weight:600;color:#777">NOMBRE: </label>
                <input class="form-control" name="nombre_contacto" type="text" value="" autocomplete="off" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label" style="font-weight:600;color:#777">CORREO: <a
                        style="color:#B61A1A"></a></label>
                <input class="form-control" name="direccion" type="text" autocomplete="off" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label" style="font-weight:600;color:#777">CARGO: <a
                        style="color:#B61A1A"></a></label>
                <input class="form-control" name="direccion" type="text" autocomplete="off" />
            </div>
        </div>
    </div>
    <h5>Datos de la empresa</h5>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label" style="font-weight:600;color:#777">RUC: </label>
                <input class="form-control" name="dni_ruc" type="number" autocomplete="off" id="dni_ruc" />
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label" style="font-weight:600;color:#777">EMPRESA: </label>
                <input class="form-control" name="nombre_contacto" type="text" value="" autocomplete="off" />
            </div>
        </div>
    </div>
@stop

@section('css')

@stop

@section('js')

@stop

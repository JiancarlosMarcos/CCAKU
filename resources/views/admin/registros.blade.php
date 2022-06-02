@extends('adminlte::page')
@section('title', 'Dashboard')

@section('content_header')
    <br>

    <div class="app-title">
        <div>
            <a href="{{ route('dashboard') }}" class="btn btn-primary"
                style="color:#777;background:#fff;border-color:#777">Dashboards</a>
            <a href="{{ route('videos') }}" class="btn btn-primary "
                style="color:#777;background:#fff;border-color:#777">Videos</a>
            <a href="{{ route('registros') }}" class="btn btn-primary " style="background:#777;border-color:#777">Mis
                Registros</a>

            <p></p>
        </div>
    </div>
@stop

@section('content')
    @foreach ($registros as $registro)
        @if ($registro->id == auth()->user()->id)
            <?php
            $transportes = $registro->transportes;
            $transportistas = $registro->empresas_transportistas;
            $contactos_transportistas = $registro->contactos_transportistas;
            $cargas = $registro->cargas;
            $clientes = $registro->empresas_clientes;
            $contactos_clientes = $registro->contactos_clientes;
            ?>
        @endif
    @endforeach
    <h1>Mis registros</h1>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label" for="">Transportistas Registrados</label>
                <input class="form-control" type="text" value="{{ $transportistas }}" disabled>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label" for="">Contactos de transportistas</label>
                <input class="form-control" type="text" value="{{ $contactos_transportistas }}" disabled>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label" for="">Clientes Registrados</label>
                <input class="form-control" type="text" value="{{ $clientes }}" disabled>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label" for="">Contactos de clientes</label>
                <input class="form-control" type="text" value="{{ $contactos_clientes }}" disabled>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label" for="">Transportes Registrados</label>
                <input class="form-control" type="text" value="{{ $transportes }}" disabled>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label" for="">Cargas Registradas</label>
                <input class="form-control" type="text" value="{{ $cargas }}" disabled>
            </div>
        </div>
    </div>

@stop

@section('css')
    @include('admin.datatable')
@stop

@section('js')

@stop

@extends('adminlte::page')
@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')
    {{-- @include('buscador') --}}

    <iframe title="Gestión Comercial (1) - Análisis" width="100%" height="900"
        src="https://app.powerbi.com/view?r=eyJrIjoiZDVhY2FlZmItY2U0ZC00YjgzLTlhNDktOTE3ZTg1NjVlMmY4IiwidCI6ImFjNTIwZmI4LTc2YzEtNDVkNS1iZDQ2LTY1NGJiNGQ1YzA0MyJ9"
        frameborder="0" allowFullScreen="true"></iframe>
@stop

@section('css')

@stop

@section('js')

@stop

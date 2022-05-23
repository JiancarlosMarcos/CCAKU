@extends('adminlte::page')
@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')
    {{-- @include('buscador') --}}
    <h1>Aqui van los dashboard</h1>
    {{-- @include('navigation-menu') --}}
    {{-- <iframe title="Gestión Comercial (1) - Análisis" width="100%" height="900"
        src="https://app.powerbi.com/view?r=eyJrIjoiZDVhY2FlZmItY2U0ZC00YjgzLTlhNDktOTE3ZTg1NjVlMmY4IiwidCI6ImFjNTIwZmI4LTc2YzEtNDVkNS1iZDQ2LTY1NGJiNGQ1YzA0MyJ9"
        frameborder="0" allowFullScreen="true"></iframe> --}}
    <iframe width="560" height="315" src="https://www.youtube.com/embed/gtIaWRW-Pog" title="YouTube video player"
        frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
        allowfullscreen></iframe>
    <iframe width="560" height="315" src="https://www.youtube.com/embed/Osyfn4-qJLA" title="YouTube video player"
        frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
        allowfullscreen></iframe>
@stop

@section('css')
    @include('admin.datatable')
@stop

@section('js')

@stop

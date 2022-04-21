@extends('adminlte::page')
@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')
    {{-- @include('buscador') --}}
    <div id='map' style='width: 800px; height: 800px;'></div>
<script>
mapboxgl.accessToken = 'pk.eyJ1IjoiamFpcm8xMzk3IiwiYSI6ImNsMjZuZGp6NzA0N3AzY3FxeWJiZTl6NGEifQ.KSS4YhkkI_nygWVkGb-f_A';
const map = new mapboxgl.Map({
container: 'map', // container ID
style: 'mapbox://styles/jairo1397/cl29e3hy7001614qpmvse4syc/draft', // style URL
center: [-74.5, -10], // starting position [lng, lat]
zoom: 4.8 // starting zoom
});
</script>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.8.1/mapbox-gl.js'></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v2.8.1/mapbox-gl.css' rel='stylesheet' />

@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
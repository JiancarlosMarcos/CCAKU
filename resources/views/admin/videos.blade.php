@extends('adminlte::page')
@section('title', 'Dashboard')

@section('content_header')
    <br>

    <div class="app-title">
        <div>
            <a href="{{ route('dashboard') }}" class="btn btn-primary"
                style="color:#777;background:#fff;border-color:#777">Dashboards</a>
            <a href="{{ route('videos') }}" class="btn btn-primary " style="background:#777;border-color:#777">Videos</a>


            <p></p>
        </div>
    </div>
@stop

@section('content')

    <iframe width="560" height="315" src="https://www.youtube.com/embed/-2z_zfTVCpU" title="YouTube video player"
        frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
        allowfullscreen></iframe>

@stop

@section('css')
    @include('admin.datatable')
@stop

@section('js')

@stop

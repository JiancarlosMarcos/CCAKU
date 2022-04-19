@extends('adminlte::page')
@section('title', 'Buscador')
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
@stop
@section('content_header')
    <h1>Clientes</h1>
@stop
@section('content')

<table id="example" class="table table-striped" style="width:100%">
<thead>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>DNI/RUC</th>
        <th>Razon Social</th>
        <th>Tipo</th>
        <th>Direccion</th>
        <th>Pagina Web</th>
    </tr>
</thead>
<tbody>
    @foreach($clientes as $cliente)
    <tr>
        <td>{{$cliente->id}}</td>
        <td>{{$cliente->nombre}}</td>
        <td>{{$cliente->dni_ruc}}</td>
        <td>{{$cliente->razon_social}}</td>
        <td>{{$cliente->id_tipo}}</td>
        <td>{{$cliente->direccion}}</td>
        <td>{{$cliente->pagina_web}}</td>
    </tr>
    @endforeach
</tbody>

</table>
@stop
@section('js')
<script>
    $(document).ready(function() {
    $('#example').DataTable();
} );
</script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

{{-- <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('js/buttons.bootstrap.min.js') }}"></script>
<script src="{{ asset('js/buttons.flash.min.js') }}"></script>
<script src="{{ asset('js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('js/buttons.print.min.js') }}"></script>
<script src="{{ asset('js/dataTables.fixedHeader.min.js') }}"></script>
<script src="{{ asset('js/dataTables.keyTable.min.js') }}"></script>
<script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('js/responsive.bootstrap.js') }}"></script>
<script src="{{ asset('js/dataTables.scroller.min.js') }}"></script>
<script src="{{ asset('js/jszip.min.js') }}"></script>
<script src="{{ asset('js/pdfmake.min.js') }}"></script>
<script src="{{ asset('js/vfs_fonts.js') }}"></script> --}}
@stop

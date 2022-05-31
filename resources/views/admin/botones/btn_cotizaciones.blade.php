<div style="padding-left:30%">

    <a class="btn btn-primary btn-sm btn-editar" style="position:absolute;margin:auto;"
        href="{{ route('editar_cotizacion', $id) }}">
        <i class="fa fa-pencil" aria-hidden="true"></i></a>

    <a class="btn btn-danger btn-sm btn-eliminar hidden" style="position:absolute;margin:auto;"
        href="{{ route('eliminar_cotizacion', $id) }}" id="delete" title="Eliminar" type="button">
        <i class="fas fa-trash-alt" aria-hidden="true"></i></a>
</div>


    <a class="btn btn-primary btn-sm"  data-toggle="modal" id="mostrar{{$id}}" 
        data-target="#showModal{{$id}}" title="" value="{{$id}}"
        style="display:none">
    </a>
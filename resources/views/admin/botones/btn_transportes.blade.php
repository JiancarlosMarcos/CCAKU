<div style="padding-left:30%">
    <a class="btn btn-primary btn-sm btn-editar" style="position:absolute;margin:auto;"
        href="{{ route('editar_transportista', $id_transportista) }}">
        <i class="fas fa-pencil-alt" aria-hidden="true"></i></a>

    <a class="btn btn-danger btn-sm btn-eliminar hidden" style="position:absolute;margin:auto;"
        href="{{ route('eliminar_vehiculo', $id) }}" title="Eliminar" type="button" id="delete">
        <i class="fas fa-trash-alt" aria-hidden="true"></i></a>
</div>

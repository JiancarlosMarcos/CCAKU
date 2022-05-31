<div style="padding-left:30%">

    <a class="btn btn-primary btn-sm btn-editar" style="position:absolute;margin:auto;"
        href="{{ route('editar_requerimiento_cliente', $id) }}">
        <i class="fas fa-eye" aria-hidden="true"></i></a>

    <a class="btn btn-danger btn-sm btn-eliminar hidden" style="position:absolute;margin:auto;"
        href="{{ route('eliminar_requerimiento', $id) }}" id="delete" title="Eliminar" type="button">
        <i class="fas fa-trash-alt" aria-hidden="true"></i></a>
</div>

<!-- Modal -->
<div id="modales">

</div>
<script>
    function mostrar_vista(id) {
        console.log(id);
        var dni = document.getElementById(id).cells[0].innerText;
        var nombre = document.getElementById(id).cells[1].innerText;
        var cargo = document.getElementById(id).cells[2].innerText;
        var celular = document.getElementById(id).cells[3].innerText;
        var correo = document.getElementById(id).cells[4].innerText;
        var empresa = document.getElementById(id).cells[5].innerText;
        var usuario = document.getElementById('usuario').value;

        $('#modales').append(
            '<div class="modal fade" id="editModal' + id + '" tabindex="-1" role="dialog" aria-hidden="true">' +
            '<div class="modal-dialog modal-dialog-centered" role="document">' +
            '<div class="modal-content">' +
            '<div class="modal-header">' +
            '<h5 class="modal-title" id="exampleModalCenterTitle">Editar Contacto</h5>' +
            ' <button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
            '<span aria-hidden="true">&times;</span>' +
            '</button>' +
            '</div>' +
            '<div class="modal-body">' +
            '<div class="tile">' +
            '<div class="tile-body" id="editar_usuarios">' +
            '<form action="{{ route('actualizar_contacto_transportista') }}" method="POST">' +
            ' @csrf' +

            '<div class="form-group">' +
            '<input type="hidden" name="id_contacto" class="form-control" value="' + id + '"><br>' +

            '<input class="form-control" name="usuario" id="usuario" type="hidden" value="' + usuario + '">' +

            '<label for="" class="control-label">DNI</label>' +
            '<input type="number" maxlength="8" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" name="dni_contacto_editar" class="form-control" value="' +
            dni + '"><br>' +

            '<label for="" class="control-label">Nombres</label>' +
            '<input type="text" name="nombre_contacto_editar" class="form-control" value="' + nombre + '"><br>' +

            '<label for="" class="control-label">Celular</label>' +
            '<input type="number" maxlength="9" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" name="celular_contacto_editar" class="form-control" value="' +
            celular + '"><br>' +

            '<label for="" class="control-label">Cargo</label>' +
            '<input type="text" name="cargo_contacto_editar" class="form-control" value="' + cargo + '"><br>' +

            '<label for="" class="control-label">Correo</label>' +
            '<input type="text" name="correo_contacto_editar" class="form-control" value="' + correo + '"><br>' +

            '<label for="" class="control-label">Empresa</label>' +
            '<input type="text" class="form-control" value="' + empresa + '" readonly><br>' +
            '<select name="id_empresa" id="empresa' + id +
            '" class="form-control buscador-empresa" style="width:420px">' +
            '<option value="" selected disabled>Seleccionar Empresa</option>' +
            @foreach ($empresas as $empresa)
                '<option value="{{ $empresa->id }}">{{ $empresa->nombre }}</option>' +
            @endforeach
            '</select>' +
            @error('nombre')
                '<span class="text-danger">{{ $mensaje }}</span>' +
            @enderror
            '</div>' +
            '<div class="tile-footer">' +
            '<button class="btn btn-primary" type="submit">' +
            '<i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Actualizar</span>' +
            '</button>&nbsp;&nbsp;&nbsp;' +
            '<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</button>' +
            '</form>' +
            '</div></div></div></div></div></div></div>'
        );

        document.getElementById("mostrar" + id).click();

        $('#empresa' + id).select2({
            dropdownParent: $("#editModal" + id)
        });


    }
</script>

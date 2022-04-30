<h5>Lista de Equipos<a style="color:#B61A1A;outline:none"><b>(*)</b></a>:</h5>
<table class="table table-bordered" id="dynamic_field" style="border: 1px solid #123;background:#fff">

    <thead>
        <tr>
            <td>Tipo(*)</td>
            <td>Cantidad(*)</td>
            <td>Cantidad de Ejes</td>
            <td>Parte de la Carga(*)</td>

            <td style="text-align:center">Eliminar</td>
        </tr>
    </thead>
</table>

<div class="col-md-3">
    <div class="form-group">
        <a class="btn btn-primary" name="add" id="add" style="margin-rigth:auto;width:180px;font-weight:700;
            font-size:14px;background:#ECDCC2;border-color:#777">
            ++ Agregar Equipo </a>
    </div>
</div>
{{-- @if (old('division.0') == 'Div. Equipos Livianos')
    <a>EQUIPOS LIVIANOS{{ count(old('division')) }}</a>
@endif --}}

<script>
    $(document).ready(function() {
        var i = 1;

        $('#add').click(function() {

            $('#dynamic_field').append(

                '<tr id="row' + i + '" class="equipos">' +

                '<td>' +
                '<select class="form-control" style="background:#77777710" name="tipo[]" required>' +
                '<option value="" disabled selected>Seleccionar</option>' +
                '<option value="Camabaja" {{ old('tipo') == 'Camabaja' ? 'selected' : '' }}>Camabaja</option>' +
                '<option value="Camacuna">Camacuna</option>' +
                '<option value="Tracto">Tracto</option>' +
                '<option value="Camion Plataforma">Camion Plataforma</option>' +
                '</select>' +
                '</td>' +

                '<td>' +
                '<input type="text" name="cantidad[]" ' +
                'title="cantidad" class="form-control" style="background:#77777710" >' +
                '</td>' +

                '<td>' +
                '<input type="text"  name="cantidad_ejes[]" ' +
                'class="form-control" style="background:#77777710" autocomplete="off" >' +
                '</td>' +

                '<td>' +
                '<input type="text" name="parte_carga[]" ' +
                'class="form-control" style="background:#77777710" >' +
                '</td>' +


                '<td style="text-align:center">' +
                '<button type="button" id="' + i +
                '" class="btn btn-danger btn_remove">X</button>' +
                '</td>' +
                '</tr>'
            );
            i++;
        });

        $(document).on('click', '.btn_remove', function() {
            if (!confirm("¿Estas seguro de eliminar este equipo?")) return;

            var id = $(this).attr('id');
            $('#row' + id).remove();

        });

    })
</script>

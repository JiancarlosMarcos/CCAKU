<script>
    $(document).ready(function() {
        var j = $(".transportes").length;

        $('#add_transporte').click(function() {

            $('#tabla_transporte').append(

                '<tr id="transporte' + j + '" class="transportes">' +

                '<td>' +
                '<select name="tipo_t[]" class="form-control " id="tipo_t' + j + '" ' +
                ' required >' +
                '<option value="" selected disabled>Seleccionar</option>' +
                '<option value="Camion Plataforma">Camion Plataforma</option>' +
                '<option value="Camion Rebatible">Camion Rebatible</option>' +
                '<option value="Camion Normal">Camion Normal</option>' +
                '<option value="Camacuna">Camacuna</option>' +
                '<option value="Camabaja">Camabaja</option>' +
                '<option value="Tracto">Tracto</option>' +
                '<option value="Modulares">Modulares</option>' +
                '</select>' +
                '</td>' +

                '<td>' +
                '<input type="text"  name="cantidad_ejes_t[]" ' +
                'autocomplete="off" class="form-control" style="background:#77777710" >' +
                '</td>' +

                '<td>' +
                '<input type="text"  name="capacidad_t[]" ' +
                'autocomplete="off" class="form-control" style="background:#77777710" >' +
                '</td>' +

                '<td>' +
                '<select name="id_ubicacion_t[]" " class="form-control " >' +
                '<option value="" selected disabled>Seleccionar Ubicacion</option>' +
                @foreach ($ubicaciones as $ubicacion)
                    '<option value="{{ $ubicacion->id }}">{{ $ubicacion->departamento }}</option>'+
                @endforeach '</select>' +
                '</td>' +

                '<td>' +
                '<input type="text" name="estado_t[]" ' +
                'autocomplete="off" class="form-control" style="background:#77777710" >' +
                '</td>' +

                '<td>' +
                '<input type="text"  name="marca_t[]" ' +
                'autocomplete="off" class="form-control" style="background:#77777710" >' +
                '</td>' +


                '<td>' +
                '<input type="text" name="modelo_t[]" ' +
                'autocomplete="off" class="form-control" style="background:#77777710" >' +
                '</td>' +

                '<td>' +
                '<input type="text" name="placa_t[]" ' +
                'autocomplete="off" class="form-control" style="background:#77777710" >' +
                '</td>' +


                '<td style="text-align:center">' +
                '<button type="button" onclick="eliminar_fila(' + j +
                ')" class="btn btn-danger btn_remove_t">X</button>' +
                '</td>' +
                '</tr>'
            );
            j++;

            document.getElementById("contador_t").value++;

        });



    })

    function eliminar_fila(id) {
        if (!confirm("¿Estas seguro de eliminar este equipo?")) return;

        $('#transporte' + id).remove();
        document.getElementById("contador_t").value--;

    }
</script>

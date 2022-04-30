<div id="mostrarRequerimientos">

</div>

<script>
    function mostrar_vista(id) {

        var id_mostrar = document.getElementById(id).cells[0].innerText;
        var servicio_mostrar = document.getElementById(id).cells[1].innerText;
        var fecha_mostrar = document.getElementById(id).cells[2].innerText;
        var cliente_mostrar = document.getElementById(id).cells[3].innerText;
        var contacto_mostrar = document.getElementById(id).cells[4].innerText;
        var celular_mostrar = document.getElementById(id).cells[5].innerText;
        var proyecto_mostrar = document.getElementById(id).cells[6].innerText;
        var departamento_mostrar = document.getElementById(id).cells[7].innerText;
        var observaciones_mostrar = document.getElementById(id).cells[8].innerText;
        var responsable_mostrar = document.getElementById(id).cells[9].innerText;
        var estado_mostrar = document.getElementById(id).cells[10].innerText;
        var id_empresa_mostrar = document.getElementById(id).cells[11].innerText;
        var id_contacto_mostrar = document.getElementById(id).cells[12].innerText;
        var id_proyecto_mostrar = document.getElementById(id).cells[13].innerText;

        consulta_requerimientos_equipos(id);

        var a;
        var b;
        if (servicio_mostrar == "Alquiler") {
            a = "selected";
            b = "";
        }

        if (servicio_mostrar == "Venta") {
            a = "";
            b = "selected";
        }

        $('#mostrarRequerimientos').append(
            '<div class="modal fade" id="showModal' + id + '" tabindex="-1" role="dialog" aria-hidden="true">' +
            '<div class="modal-dialog modal-dialog-centered" role="document" style="max-width:1450px;padding-left:2%">' +
            '<div class="modal-content" style="">' +
            '<div class="modal-header">' +
            '<h5 class="modal-title" id="exampleModalCenterTitle">Detalle del Requerimiento || Cod. ' + id +
            '</h5>' +
            ' <button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
            '<span aria-hidden="true">&times;</span>' +
            '</button>' +
            '</div>' +
            '<div class="modal-body">' +
            '<div class="tile">' +
            '<div class="tile-body">' +
            '<form method="POST" name="form_update' + id +
            '" action="{{ route('actualizar_requerimiento') }}" autocomplete="nope" class="contenido onload" id="update_requerimientos" role="form">' +
            '@csrf' +

            '<div class="form-group">' +
            '<div class="row">' +
            '<input type="hidden" name="id_registro" value="' + id + '">' +

            '<div class="col-md-2">' +
            '<label for="" class="control-label" style="font-weight:600">FECHA:</label>' +
            '<input type="text" class="form-control" value="' + fecha_mostrar + '" readonly ><br>' +
            '</div>' +

            '<div class="col-md-2">' +
            '<label for="" class="control-label" style="font-weight:600">TIPO DE SERVICIO:</label>' +
            '<select class="form-control" style="width:100%" name="tipo_servicio">' +
            '<option value="Alquiler" ' + a + '>Alquiler</option>' +
            '<option value="Venta" ' + b + '>Venta</option>' +
            '</select>' +
            '<br>' +
            '</div>' +

            '<div class="col-md-2">' +
            '<label for="" class="control-label" style="font-weight:600">RESPONSABLE:</label>' +
            '<input type="text" class="form-control" value="' + responsable_mostrar + '" readonly><br>' +
            '</div>' +

            '<div class="col-md-2">' +
            '<label for="" class="control-label" style="font-weight:600">ESTADO:</label>' +
            '<input type="text" class="form-control" value="' + estado_mostrar + '" readonly><br>' +
            '</div>' +

            '<div class="col-md-2">' +
            '<label for="" class="control-label" style="font-weight:600">ATENDIDO POR:</label>' +
            '<input type="text" id="responsable_cotizacion' + id +
            '" class="form-control" value="-" readonly><br>' +
            '</div>' +

            '</div>' +

            '<div class="row">' +

            '<div class="col-md-6">' +
            '<label for="" class="control-label" style="font-weight:600">CLIENTE:</label>' +
            // '<input type="text" class="form-control" value="'+cliente_mostrar+'" ><br>'+
            '<select name="id_empresa" class="form-control" id="cliente' + id +
            '" onchange="mostrar_contactos_clientes_select(' + id + ')" style="width:100%">' +
            '<option disabled>Seleccionar</option>' +
            @foreach ($clientes as $cliente)
                '<option value="{{ $cliente->id }}">📌DNI/RUC:{{ $cliente->dni_ruc }} || 💼{{ $cliente->nombre }}</option>'+
            @endforeach '</select>' +
            '<br><br>' +
            '</div>' +

            '<div class="col-md-6">' +
            '<label for="" class="control-label" style="font-weight:600">CONTACTO:</label>' +
            //'<input type="text" class="form-control" value="'+contacto_mostrar+'" ><br>'+

            '<select name="id_contacto" class="form-control buscador_contacto' + id + '" style="width:100%">' +
            '</select>' +
            '<br><br>' +
            '</div>' +



            '</div>' +

            '<div class="row">' +

            '<div class="col-md-12">' +
            '<label for="" class="control-label" style="font-weight:600">PROYECTO:</label>' +
            //'<input type="text" class="form-control" value="'+proyecto_mostrar+'" ><br>'+

            '<select name="id_proyecto" class="form-control" id="proyecto' + id + '" style="width:100%">' +
            '<option disabled>Seleccionar</option>' +
            @foreach ($cargas as $proyecto)
                '<option value="{{ $proyecto->id }}" '+
                                                                                                            '>📌
                    Cod.{{ $proyecto->codigo_corto }} || 📎
                    Nombre:
                    {{ $proyecto->nombre }} ||
                    📂 Etapa:
                    {{ $proyecto->etapa }} || 🌎 Departamento: {{ $proyecto->departamento }}</option>'+
            @endforeach '</select>' +
            '</div>' +

            '</div><br>' +


            '<table id="equipos' + id + '" style="font-size:13px;" class="table">' +
            '</table>' +

            '<div class="row">' +
            '<div class="col-md-12">' +
            '<label for="" class="control-label" style="font-weight:600">OBSERVACIONES:</label>' +
            '<textarea rows="5" class="form-control" name="observaciones" id="observaciones' + id + '">' +
            observaciones_mostrar + '</textarea>' +

            '</div></div>' +




            '</div>' +


            '<div class="tile-footer" id="descargar_cotizacion' + id + '" >' +



            '</div>' +
            '<div style="text-align:center">' +
            '<a type="submit" class="btn btn-primary" style="color:#fff" onclick="enviar_form(' + id + ')">' +
            '<i class="fa fa-refresh"></i><span id="btnText">Actualizar Registro</span>' +
            '</a>&nbsp;&nbsp;&nbsp;' +
            '</div>' +
            '</form>' +

            '</div></div></div></div></div></div>'
        );


        $('#proyecto' + id).val(id_proyecto_mostrar);

        $("#cliente" + id).val(id_empresa_mostrar);
        document.getElementById("mostrar" + id).click();


        $('#cliente' + id).select2({
            dropdownParent: $("#showModal" + id)
        });

        $('.buscador_contacto' + id).select2({
            dropdownParent: $("#showModal" + id)
        });

        $('#proyecto' + id).select2({
            dropdownParent: $("#showModal" + id)
        });

        consulta_existencia_cotizacion(id);
        mostrar_contactos_clientes(id_empresa_mostrar, id, id_contacto_mostrar);

    }
</script>


<script>
    function consulta_requerimientos_equipos(id) {

        $.get('consulta_requerimientos_equipos', {
                id: id
            }, function(requerimientos_equipos) {
                var contador_equipos = requerimientos_equipos["nombre"].length;

                var nombre = requerimientos_equipos["nombre"].slice();
                var capacidad = requerimientos_equipos["capacidad"].slice();
                var cantidad = requerimientos_equipos["cantidad"].slice();
                var servicio = requerimientos_equipos["servicio"].slice();
                var tiempo = requerimientos_equipos["tiempo"].slice();
                var division = requerimientos_equipos["division"].slice();

                $("#equipos" + id).empty();

                $('#equipos' + id).append(

                    '<tr style="background:#21252999;color:#fff">' +
                    '<td style="width:10%;text-align:center;padding:8px">EQUIPO</td> <td style="width:10%;text-align:center;padding:8px">CAPACIDAD</td>' +
                    ' <td style="width:10%;text-align:center;padding:8px">CANTIDAD</td> <td style="width:10%;text-align:center;padding:8px">TIEMPO</td>' +
                    '  <td style="width:10%;text-align:center;padding:8px">DIVISION</td>' +
                    '</tr>');

                for (var i = 0; i < contador_equipos; i++) {
                    if (nombre[i] == null)
                        nombre[i] = "";

                    if (capacidad[i] == null)
                        capacidad[i] = "";

                    if (cantidad[i] == null)
                        cantidad[i] = "";

                    if (tiempo[i] == null)
                        tiempo[i] = "";

                    if (division[i] == null) {
                        division[i] = "";
                    } else {
                        var livianos = "";
                        var construccion = "";
                        var movimiento = "";
                        var izaje = "";

                        if (division[i] == "Div. Equipos Livianos")
                            livianos = "selected";
                        if (division[i] == "Div. Construccion Civil")
                            construccion = "selected";
                        if (division[i] == "Div. Movimiento de Tierra")
                            movimiento = "selected";
                        if (division[i] == "Div. Izaje")
                            izaje = "selected";
                    }



                    $('#equipos' + id).append(
                        '<tr>' +

                        '<td>' +
                        '<input type="text" style="border-bottom:0px;margin-bottom:0px;text-align:center;border:1px solid #777" class="form-control" name="nombre_equipo[]" value="' +
                        nombre[i] + '" />' +
                        '</td>' +

                        '<td>' +
                        '<input type="text" style="border-bottom:0px;margin-bottom:0px;text-align:center;border:1px solid #777" class="form-control" name="capacidad_equipo[]" value="' +
                        capacidad[i] + '" />' +
                        '</td>' +

                        '<td>' +
                        '<input type="text" style="border-bottom:0px;margin-bottom:0px;text-align:center;border:1px solid #777" class="form-control" name="cantidad_equipo[]" value="' +
                        cantidad[i] + '" />' +
                        '</td>' +

                        '<td>' +
                        '<input type="text" style="border-bottom:0px;margin-bottom:0px;text-align:center;border:1px solid #777" class="form-control" name="tiempo_equipo[]" value="' +
                        tiempo[i] + '" />' +
                        '</td>' +

                        '<td>' +
                        '<select class="form-control" name="division[]" required>' +
                        '<option value="" disabled selected>Seleccionar</option>' +
                        '<option value="Div. Equipos Livianos" ' + livianos +
                        '>Div. Equipos Livianos</option>' +
                        '<option value="Div. Construccion Civil" ' + construccion +
                        '>Div. Construccion Civil</option>' +
                        '<option value="Div. Movimiento de Tierra" ' + movimiento +
                        '>Div. Movimiento de Tierra</option>' +
                        '<option value="Div. Izaje" ' + izaje + '>Div. Izaje</option>' +
                        '</select>' +
                        '</td>' +

                        '</tr>');

                }
            })


            .fail(function() {



            }).then(function(data) {
                // console.log("--__"+data[0]);
            });

    }
</script>

<script>
    function consulta_existencia_cotizacion(id) {

        $.get('consulta_existencia_cotizacion', {
                id: id
            }, function(requerimientos) {

                var id_cotizacion = requerimientos["id_cotizacion"];
                var validacion = requerimientos["validacion"];
                var ejecutivo = requerimientos["ejecutivo"];


                if (validacion == '0') {

                }

                if (validacion == '1') {

                    $("#descargar_cotizacion" + id).empty();

                    $("#responsable_cotizacion" + id).val(ejecutivo);

                    var url_1 = '';
                    url_1 = url_1.replace('valorIdTemp_1', id_cotizacion);


                    var url = '';
                    url = url.replace('valorIdTemp', id_cotizacion);
                    $('#descargar_cotizacion' + id).append(
                        '<a class="btn btn-primary" href="' + url +
                        '" style="background:#123;border:1px solid #123">' +
                        '<i class="fa fa-download"></i><span id="btnText">Descargar Cotizacion</span>' +
                        '</a>&nbsp;&nbsp;&nbsp;' +

                        '<a href="' + url_1 +
                        '" target="_blank" class="btn btn-secondary" ><i class="fa fa-arrow-right"></i>Ir al registro de Cotizacion</a>'
                    );

                }


            })


            .fail(function() {



            }).then(function(data) {
                // console.log("--__"+data[0]);
            });

    }
</script>


<script>
    function mostrar_contactos_clientes(id_cliente, nro, id_contacto_mostrar) {
        $('.buscador_contacto' + nro).empty();
        $('.buscador_contacto' + nro).append("<option value='' disabled> ⌛ Cargando Lista...</option>");

        //console.log(fecha_hoy);

        if ($.trim(id_cliente) != '') {
            $.get('consulta_contactos', {
                id_cliente: id_cliente
            }, function(datos) {
                var nombres = datos["nombre"];
                var celular = datos["celular"];
                var cargo = datos["cargo"];
                var correo = datos["correo"];
                var id_contacto = datos["id"];

                $('.buscador_contacto' + nro).empty();
                var z = 0;
                $.each(datos["nombre"], function(index, value) {
                    $('.buscador_contacto' + nro).append("<option value=" + id_contacto[z] + "> 📌 " +
                        nombres[z] + " || 📱 " + celular[z] + " || &#x2709; " + correo[z] +
                        " || 💼 " + cargo[z] + " " + "</option>");
                    z++;

                })

                //$('.buscador_contacto'+nro).append("<option value='nuevo_contacto'>++ Agregar Nuevo Contacto </option>");
                $('.buscador_contacto' + nro).val(id_contacto_mostrar);


            }).fail(function() {


            }).then(function(data) {

            });
        }
    }
</script>

<script>
    function mostrar_contactos_clientes_select(id) {
        $('.buscador_contacto' + id).empty();
        $('.buscador_contacto' + id).append("<option value='' disabled> ⌛ Cargando Lista...</option>");
        var id_cliente = document.getElementById("cliente" + id).value;
        console.log(id_cliente);

        //console.log(fecha_hoy);

        if ($.trim(id_cliente) != '') {
            $.get('consulta_contactos', {
                id_cliente: id_cliente
            }, function(datos) {
                var nombres = datos["nombre"];
                var celular = datos["celular"];
                var cargo = datos["cargo"];
                var correo = datos["correo"];
                var id_contacto = datos["id"];

                $('.buscador_contacto' + id).empty();
                $('.buscador_contacto' + id).append("<option value=''> ✔ Seleccionar un Contacto</option>");
                var z = 0;
                $.each(datos["nombre"], function(index, value) {
                    $('.buscador_contacto' + id).append("<option value=" + id_contacto[z] + "> 📌 " +
                        nombres[z] + " || 📱 " + celular[z] + " || &#x2709; " + correo[z] +
                        " || 💼 " + cargo[z] + " " + "</option>");
                    z++;

                })


            }).fail(function() {


            }).then(function(data) {

            });
        }
    }
</script>

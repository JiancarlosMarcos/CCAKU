<style>
    .estilo_1 {
        height: 35px !important;
        background: #fff !important;
        border-radius: 10px !important;
        padding-left: 10px !important;
    }

    .estilo_rows {
        margin-bottom: 0px !important;
    }

    .estilo_campo {
        background: #fff !important;
        border-radius: 8px !important;
        padding-left: 8px !important;
    }

    .tipo_cliente:focus {
        background: #FFB21B;
        color: #000;
        border: 1px solid #777 !important;
        box-shadow: 0 0 0 0rem #123;
    }

    .alerta_1:focus {
        outline: none;
    }

    .btn_actualizar:active {

        padding: 2px !important;
        padding-left: 4px !important;
        padding-right: 4px !important;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0);
    }

    .readonly {
        pointer-events: none;

    }

    .vista_clientes_nuevos {

        border-radius: 3px;
        background-color: #ccc;
    }
</style>


<input type="hidden" id="select_tipo_cliente" name="select_tipo_cliente" value="0">


<h5>Seleccione el Tipo de Cliente<b style="color:#B61A1A;outline:none">(*)</b>:</h5>
<div class="row" style="margin-bottom:5px">

    <div class="col-md-3">
        <div class="form-group">


            <a class="form-control btn" id="cliente_existente" onclick="select_cliente_existente();" style="border-color:#777;text-align:center;font-weight:600">Cliente Existente</a>

        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">

            <a class="form-control btn" id="cliente_nuevo" onclick="select_cliente_nuevo();" style="border-color:#777;text-align:center;font-weight:600">Cliente Nuevo</a>

        </div>
    </div>
</div>


<div class="row vista_clientes_nuevos hidden">
    <br>
    <br>
    <div class="col-md-12">
        <h5>Datos del Cliente<b style="color:#B61A1A">(*)</b>:</h5>
    </div>
    <br>
    <div class="col-md-3">
        <div class="form-group" style="margin-bottom:0px !important">
            <!--DNI/RUC-->
            <label class="control-label" style="font-weight:600;color:#777"><b>RUC O DNI: </b><b style="color:#B61A1A">(*)</b></label>
            @error('dni_ruc')
            <?php echo "<script> function validacion_dni_ruc(){document.getElementById('cliente_nuevo').click();} </script>"; ?>
            <span class="text-danger">Debe tener máximo 11 caracteres</span>
            @enderror
            <input class="form-control estilo_campo required_cliente_nuevo @error('dni_ruc') class_error @enderror" name="dni_ruc" type="number" value="{{ old('dni_ruc') }}" autocomplete="off" id="dni_ruc" onkeyup="validar_cliente()" placeholder="RUC O DNI" pattern="[0-9]" />
            <input type="text" value="" class="alerta_1" id="valida_dni_ruc" style="font-size:14px;background:transparent;border:0px solid transparent;width:700px;color:#be1e37;margin-top:-50px" disabled>
            <!---->
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <!--RAZON SOCIAL-->
            <label class="control-label" style="font-weight:600;color:#777"><b>RAZON SOCIAL: </b>
                <b style="color:#B61A1A">(*)</b></label>
            @error('razon_social')
            <?php echo "<script> function validacion_razon_social(){document.getElementById('cliente_nuevo').click();} </script>"; ?>
            <span class="text-danger">Debe tener máximo 255 caracteres</span>
            @enderror
            <input class="form-control estilo_campo required_cliente_nuevo @error('razon_social') class_error @enderror" name="razon_social" type="text" value="{{ old('razon_social') }}" autocomplete="off" placeholder="Nombre de la empresa" />
            <!---->
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label" style="font-weight:600;color:#777"><b>DIRECCION: </b><a style="color:#B61A1A"></a></label>
            <input class="form-control estilo_campo" name="direccion" type="text" value="{{ old('direccion') }}" autocomplete="off" placeholder="Direccion de la empresa" />
        </div>
    </div>








    <div class="col-md-12">
        <h5>Datos del Contacto<b style="color:#B61A1A">(*)</b>:</h5>
    </div>
    <br>
    <br>
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label" style="font-weight:600;color:#777"><b>NOMBRE DE CONTACTO: </b>
                <b style="color:#B61A1A">(*)</b></label>
            <input class="form-control estilo_campo required_cliente_nuevo" name="nombre_contacto" type="text" value="{{ old('nombre_contacto') }}" autocomplete="off" placeholder="Nombre de contacto" />
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label class="control-label" style="font-weight:600;color:#777"><b>DNI: </b>
                <b style="color:#B61A1A">(*)</b></label>
            <input class="form-control estilo_campo required_cliente_nuevo" name="dni" type="text" value="{{ old('dni') }}" autocomplete="off" placeholder="Nombre de contacto" />
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label class="control-label" style="font-weight:600;color:#777"><b>CELULAR </b></label>
            <input class="form-control estilo_campo" name="celular_contacto" type="text" value="{{ old('celular_contacto') }}" autocomplete="off" placeholder="Celular de contacto" />
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label" style="font-weight:600;color:#777"><b>CORREO: </b></label>
            <input class="form-control estilo_campo" name="correo_contacto" type="text" value="{{ old('correo_contacto') }}" autocomplete="off" placeholder="correo de contacto" />
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label class="control-label" style="font-weight:600;color:#777"><b>CARGO: </b></label>
            <input class="form-control estilo_campo" name="cargo_contacto" type="text" value="{{ old('cargo_contacto') }}" autocomplete="off" placeholder="correo de contacto" />
        </div>
    </div>





    <div class="col-md-12">
        <h5>Datos de la Carga<b style="color:#B61A1A">(*)</b>:</h5>
    </div>
    <br>

    <input class="form-control" name="contador_c" id="contador_c" type="hidden" value="0" autocomplete="off" />

    <table class="table table-bordered" id="tabla_carga_n" style="border: 1px solid #123;background:#fff">

        <thead>
            <tr>
                <td style="width:15%">Tipo de Carga</td>
                <td style="width:8%">Volumen</td>
                <td style="width:12%">Peso</td>
                <td style="width:12%">Unidad Medida</td>
                <td style="width:10%">Marca</td>
                <td style="width:12%">Modelo</td>
                <td style="width:12%">Placa</td>
                <td style="text-align:center;width:6%">Eliminar</td>
            </tr>
        </thead>
    </table>

    <div class="col-md-2">
        <div class="form-group">
            <a class="btn btn-primary" name="add_carga_n" id="add_carga_n" style="margin-rigth:auto;width:100%;font-weight:700;
     font-size:14px;background:#ECDCC2;border-color:#777">
                ++ Agregar Carga </a>
        </div>
    </div>
    <br>

</div>


<!--CLIENTES EXISTENTES-->
<div class="row vista_clientes_existentes hidden">

    <div class="col-md-12">
        <div class="form-group">
            <h6><b style="color:#777">Cliente<b style="color:#B61A1A">(*)</b>:</b></h6>
            <select class="form-control buscador_clientes required_cliente_existente" onchange="mostrar_contactos_clientes();" id="buscador_cliente" name="id_cliente" style="width:100%">
                <option value="" disabled selected> ✔ Seleccionar un Cliente</option>
                @foreach ($clientes as $cliente)
                <option value="{{ $cliente->id }}">📌 DNI/RUC: {{ $cliente->dni_ruc }} || 💼
                    {{ $cliente->nombre }}
                </option>
                @endforeach
            </select>
        </div>
    </div>
    <br>
    <div class="col-md-12">
        <div class="form-group">
            <h6><b style="color:#777">Contacto<b style="color:#B61A1A">(*)</b>:</b></h6>
            <select class="form-control buscador_contactos required_cliente_existente" onchange="valida_nuevo_contacto();" id="buscador_contacto" name="id_contacto" style="width:100%">
                <option value="" disabled selected> ⌛ Cargando lista ...</option>

            </select>
        </div>
    </div>
    <br>
    <div class="col-md-3 nuevo_contacto hidden">
        <div class="form-group">
            <label class="control-label" style="font-weight:600;color:#777"><b>NOMBRE DE CONTACTO: </b>
                <b style="color:#B61A1A">(*)</b></label>
            <input class="form-control estilo_campo required_contacto_nuevo" name="nombre_contacto_nuevo" type="text" value="{{ old('nombre_contacto_nuevo') }}" autocomplete="off" placeholder="Nombre de contacto" />
        </div>
    </div>
    <div class="col-md-2 nuevo_contacto hidden">
        <div class="form-group">
            <label class="control-label" style="font-weight:600;color:#777"><b>DNI: </b>
                <b style="color:#B61A1A">(*)</b></label>
            <input class="form-control estilo_campo required_contacto_nuevo" name="dni" type="text" value="{{ old('dni') }}" autocomplete="off" placeholder="Nombre de contacto" />
        </div>
    </div>
    <div class="col-md-2 nuevo_contacto hidden">
        <div class="form-group">
            <label class="control-label" style="font-weight:600;color:#777"><b>CELULAR </b></label>
            <input class="form-control estilo_campo" name="celular_contacto_nuevo" type="text" value="{{ old('celular_contacto_nuevo') }}" autocomplete="off" placeholder="Celular de contacto" />
        </div>
    </div>
    <div class="col-md-3 nuevo_contacto hidden">
        <div class="form-group">
            <label class="control-label" style="font-weight:600;color:#777"><b>CORREO: </b></label>
            <input class="form-control estilo_campo" name="correo_contacto_nuevo" type="text" value="{{ old('correo_contacto_nuevo') }}" autocomplete="off" placeholder="correo de contacto" />
        </div>
    </div>
    <div class="col-md-2 nuevo_contacto hidden">
        <div class="form-group">
            <label class="control-label" style="font-weight:600;color:#777"><b>CARGO: </b></label>
            <input class="form-control estilo_campo" name="cargo_contacto_nuevo" type="text" value="{{ old('cargo_contacto_nuevo') }}" autocomplete="off" placeholder="correo de contacto" />
        </div>
    </div>
    <br>








    <div class="col-md-12">
        <div class="form-group">
            <h6><b style="color:#777">Carga<b style="color:#B61A1A">(*)</b>:</b></h6>
            <select class="form-control buscador_cargas required_cliente_existente" onchange="valida_nueva_carga();" id="buscador_carga" name="id_carga" style="width:100%">
                <option value="" disabled selected> ⌛ Cargando lista ...</option>

            </select>
        </div>
    </div>


    <div class="col-md-12 nueva_carga hidden">
        <h5>Datos de la Carga<b style="color:#B61A1A">(*)</b>:</h5>

        <br>

        <input class="form-control" name="contador_c_e" id="contador_c_e" type="hidden" value="0" autocomplete="off" />

        <table class="table table-bordered" id="tabla_carga_e" style="border: 1px solid #123;background:#fff">

            <thead>
                <tr>
                    <td style="width:15%">Tipo de Carga</td>
                    <td style="width:10%">Marca</td>
                    <td style="width:12%">Modelo</td>
                    <td style="width:12%">Placa</td>
                    <td style="width:8%">Dimensiones</td>
                    <td style="width:12%">Peso</td>
                    <td style="width:5%">Unidad Medida</td>
                    <td style="text-align:center;width:6%">Eliminar</td>
                </tr>
            </thead>


        </table>

        <div class="col-md-2">
            <div class="form-group">
                <a class="btn btn-primary" name="add_carga_e" id="add_carga_e" style="margin-rigth:auto;width:100%;font-weight:700;
     font-size:14px;background:#ECDCC2;border-color:#777">
                    ++ Agregar Carga </a>
            </div>
        </div>
    </div>


</div>
<script>
    $(document).ready(function() {
        var j = $(".cargas_n").length;

        $('#add_carga_n').click(function() {

            $('#tabla_carga_n').append(

                '<tr id="carga_n' + j + '" class="cargas_n" >' +

                '<td>' +
                '<input type="text"  name="tipo_c_n[]" ' +
                'autocomplete="off" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" style="background:#77777710" required>' +
                '</td>' +

                '<td>' +
                '<input type="text"  name="marca_c_n[]" ' +
                'autocomplete="off" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" style="background:#77777710" >' +
                '</td>' +


                '<td>' +
                '<input type="text" name="modelo_c_n[]" ' +
                'autocomplete="off" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" style="background:#77777710" >' +
                '</td>' +

                '<td>' +
                '<input type="text" name="placa_c_n[]" ' +
                'autocomplete="off" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" style="background:#77777710" >' +
                '</td>' +

                '<td>' +
                '<input type="text"  name="volumen_c_n[]" ' +
                'autocomplete="off" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" style="background:#77777710" >' +
                '</td>' +

                '<td>' +
                '<input type="text"  name="peso_c_n[]" ' +
                'autocomplete="off" class="form-control" style="background:#77777710" >' +
                '</td>' +

                '<td>' +
                '<input type="text"  name="medida_peso_c_n[]" ' +
                'autocomplete="off" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" style="background:#77777710" >' +
                '</td>' +


                '<td style="text-align:center">' +
                '<button type="button" onclick="eliminar_fila_n(' + j +
                ')" class="btn btn-danger btn_remove_c">X</button>' +
                '</td>' +
                '</tr>'
            );
            j++;

            document.getElementById("contador_c_n").value++;

        });



    })

    function eliminar_fila_n(id) {
        if (!confirm("¿Estas seguro de eliminar esta carga?")) return;

        $('#carga_n' + id).remove();
        document.getElementById("contador_c_n").value--;

    }
</script>


<script>
    var j = $(".cargas_e").length;
    $(document).ready(function() {


        $('#add_carga_e').click(function() {

            $('#tabla_carga_e').append(

                '<tr id="carga_e' + j + '" class="cargas_e" >' +

                '<td>' +
                '<input type="hidden"  name="id_c_e[]" autocomplete="off"  style="background:#77777710" value ="0">' +
                '<input type="text"  name="tipo_c_e[]" ' +
                'autocomplete="off" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" style="background:#77777710" required>' +
                '</td>' +

                '<td>' +
                '<input type="text"  name="volumen_c_e[]" ' +
                'autocomplete="off" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" style="background:#77777710" >' +
                '</td>' +

                '<td>' +
                '<input type="text"  name="peso_c_e[]" ' +
                'autocomplete="off" class="form-control" style="background:#77777710" >' +
                '</td>' +

                '<td>' +
                '<input type="text"  name="medida_peso_c_e[]" ' +
                'autocomplete="off" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" style="background:#77777710" >' +
                '</td>' +



                '<td>' +
                '<input type="text"  name="marca_c_e[]" ' +
                'autocomplete="off" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" style="background:#77777710" >' +
                '</td>' +


                '<td>' +
                '<input type="text" name="modelo_c_e[]" ' +
                'autocomplete="off" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" style="background:#77777710" >' +
                '</td>' +

                '<td>' +
                '<input type="text" name="placa_c_e[]" ' +
                'autocomplete="off" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" style="background:#77777710" >' +
                '</td>' +


                '<td style="text-align:center">' +
                '<button type="button" onclick="eliminar_fila(' + j +
                ')" class="btn btn-danger btn_remove_c">X</button>' +
                '</td>' +
                '</tr>'
            );
            j++;

            document.getElementById("contador_c_e").value++;

        });



    })

    function eliminar_fila(id) {
        if (!confirm("¿Estas seguro de eliminar esta carga?")) return;

        $('#carga_e' + id).remove();
        document.getElementById("contador_c_e").value--;

    }


    function valida_nueva_carga() {
        var id_carga = document.getElementById("buscador_carga").value;

        if (id_carga == "nueva_carga") {
            $(".nueva_carga").removeClass("hidden");
            $(".required_carga_nueva").prop("required", true);
        } else {
            $(".nueva_carga").removeClass("hidden");
            if ($.trim(id_carga) != '') {
                $.get('../consulta_carga', {
                    id_carga: id_carga
                }, function(datos) {
                    var id_carga = datos["id"];
                    var tipo = datos["tipo"];
                    var marca = datos["marca"];
                    var modelo = datos["modelo"];
                    var placa = datos["placa"];
                    var peso = datos["peso"];

                    $('#tabla_carga_e').append(

                        '<tr id="carga_e' + j + '" class="cargas_e" >' +

                        '<td>' +
                        '<input type="hidden"  name="id_c_e[]" autocomplete="off"  style="background:#77777710" value ="' +
                        id_carga + '">' +
                        '<input type="text"  name="tipo_c_e[]" ' +
                        'autocomplete="off" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" value="' +
                        tipo + '" class="form-control" style="background:#77777710" readonly required>' +
                        '</td>' +

                        '<td>' +
                        '<input type="text"  name="volumen_c_e[]" ' +
                        'autocomplete="off" style="text-transform:uppercase;" readonly onkeyup="javascript:this.value=this.value.toUpperCase();"  class="form-control" style="background:#77777710" >' +
                        '</td>' +

                        '<td>' +
                        '<input type="text"  name="peso_c_e[]" ' +
                        'autocomplete="off" class="form-control" readonly value="' + peso +
                        '" style="background:#77777710" >' +
                        '</td>' +

                        '<td>' +
                        '<input type="text"  name="medida_peso_c_e[]" ' +
                        'autocomplete="off" style="text-transform:uppercase;" readonly  onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" style="background:#77777710" >' +
                        '</td>' +



                        '<td>' +
                        '<input type="text"  name="marca_c_e[]" ' +
                        'autocomplete="off" style="text-transform:uppercase;" value="' + marca +
                        '" onkeyup="javascript:this.value=this.value.toUpperCase();" readonly class="form-control" style="background:#77777710" >' +
                        '</td>' +


                        '<td>' +
                        '<input type="text" name="modelo_c_e[]" ' +
                        'autocomplete="off" style="text-transform:uppercase;" value="' + modelo +
                        '" onkeyup="javascript:this.value=this.value.toUpperCase();" readonly class="form-control" style="background:#77777710" >' +
                        '</td>' +

                        '<td>' +
                        '<input type="text" name="placa_c_e[]" ' +
                        'autocomplete="off" style="text-transform:uppercase;" value="' + placa +
                        '" onkeyup="javascript:this.value=this.value.toUpperCase();" readonly class="form-control" style="background:#77777710" >' +
                        '</td>' +


                        '<td style="text-align:center">' +
                        '<button type="button" onclick="eliminar_fila(' + j +
                        ')" class="btn btn-danger btn_remove_c">X</button>' +
                        '</td>' +
                        '</tr>'
                    );

                    // $(".nueva_carga").addClass("hidden");
                    // $(".carga_existente").attr("id", "'carga" + cont + "'");
                    // $(".carga_existente").removeClass("hidden");
                    // $("#tipo_c").val(tipo);
                    // $("#marca_c").val(marca);
                    // $("#modelo_c").val(modelo);
                    // $("#placa_c").val(placa);
                    // $("#peso_c").val(peso);
                    console.log(id_carga);
                    $(".required_carga_nueva").prop("required", false);
                    j++;
                }).fail(function() {
                    console.log("Hay un error")
                }).then(function(data) {
                    console.log(data);
                });
            }




        }
    }
</script>
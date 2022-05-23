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


            <a class="form-control btn" id="cliente_existente" onclick="select_cliente_existente();"
                style="border-color:#777;text-align:center;font-weight:600">Cliente Existente</a>

        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">

            <a class="form-control btn" id="cliente_nuevo" onclick="select_cliente_nuevo();"
                style="border-color:#777;text-align:center;font-weight:600">Cliente Nuevo</a>

        </div>
    </div>

</div>


<div class="row vista_clientes_nuevos hidden">
    <br>
    <br>

    <div class="col-md-12">
        <br>
        <h5>Datos del Cliente<b style="color:#B61A1A">(*)</b>:</h5>
    </div>
    <br>
    <div class="col-md-3">
        <div class="form-group" style="margin-bottom:0px !important">
            <!--DNI/RUC-->

            <label class="control-label" style="font-weight:600;color:#777"><b>RUC O DNI: </b><b
                    style="color:#B61A1A">(*)</b></label>
            @error('dni_ruc')
                <?php echo "<script> function validacion_dni_ruc(){document.getElementById('cliente_nuevo').click();} </script>"; ?>
                <span class="text-danger">Debe tener máximo 11 caracteres</span>
            @enderror
            <input class="form-control estilo_campo required_cliente_nuevo @error('dni_ruc') class_error @enderror"
                name="dni_ruc" type="number" value="{{ old('dni_ruc') }}" autocomplete="off" id="dni_ruc"
                maxlength="11"
                oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                onkeyup="validar_cliente()" placeholder="RUC O DNI" pattern="[0-9]" />
            <input type="text" value="" class="alerta_1" id="valida_dni_ruc"
                style="font-size:14px;background:transparent;border:0px solid transparent;width:700px;color:#be1e37;margin-top:-50px"
                disabled>
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
            <input class="form-control estilo_campo required_cliente_nuevo @error('razon_social') class_error @enderror"
                name="razon_social" type="text" value="{{ old('razon_social') }}" autocomplete="off"
                style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"
                placeholder="Nombre de la empresa" />
            <!---->
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label" style="font-weight:600;color:#777"><b>DIRECCION: </b><a
                    style="color:#B61A1A"></a></label>
            <input class="form-control estilo_campo" name="direccion" style="text-transform:uppercase;"
                onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" value="{{ old('direccion') }}"
                autocomplete="off" placeholder="Direccion de la empresa" />
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
            <input class="form-control estilo_campo required_cliente_nuevo" style="text-transform:uppercase;"
                onkeyup="javascript:this.value=this.value.toUpperCase();" name="nombre_contacto" type="text"
                value="{{ old('nombre_contacto') }}" autocomplete="off" placeholder="Nombre de contacto" />
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label class="control-label" style="font-weight:600;color:#777"><b>DNI: </b>
                <b style="color:#B61A1A">(*)</b></label>
            <input class="form-control estilo_campo required_cliente_nuevo" name="dni" type="number" maxlength="8"
                oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                value="{{ old('dni') }}" autocomplete="off" placeholder="Nombre de contacto" />
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label class="control-label" style="font-weight:600;color:#777"><b>CELULAR </b></label>
            <input class="form-control estilo_campo" name="celular_contacto" type="number" maxlength="9"
                oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                value="{{ old('celular_contacto') }}" autocomplete="off" placeholder="Celular de contacto" />
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label" style="font-weight:600;color:#777"><b>CORREO: </b></label>
            <input class="form-control estilo_campo" name="correo_contacto" type="text"
                value="{{ old('correo_contacto') }}" autocomplete="off" placeholder="correo de contacto" />
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label class="control-label" style="font-weight:600;color:#777"><b>CARGO: </b></label>
            <input class="form-control estilo_campo" name="cargo_contacto" style="text-transform:uppercase;"
                onkeyup="javascript:this.value=this.value.toUpperCase();" type="text"
                value="{{ old('cargo_contacto') }}" autocomplete="off" placeholder="correo de contacto" />
        </div>
    </div>





    <div class="col-md-12">
        <h5>Lista de Cargas<b style="color:#B61A1A">(*)</b>:</h5>
        <input class="form-control" name="contador_c_n" id="contador_c_n" type="hidden" value="0"
            autocomplete="off" />

        <table class="table table-bordered" id="tabla_carga_n" style="border: 1px solid #123;background:#fff">

            <thead>
                <tr>
                    <td style="width:15%">Tipo de Carga<b style="color:#B61A1A">(*)</b>:</td>
                    <td style="width:10%">Marca</td>
                    <td style="width:10%">Modelo</td>
                    <td style="width:10%">Placa</td>
                    <td style="width:15%">Dimensiones<br>(Largo x Ancho x Alto)</td>
                    <td style="width:10%">Peso</td>
                    <td style="width:10%">Unidad Medida</td>

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


    </div>
    <br>



</div>


<!--CLIENTES EXISTENTES-->
<div class="row vista_clientes_existentes hidden">

    <div class="col-md-12">
        <div class="form-group">
            <h6><b style="color:#777">Cliente<b style="color:#B61A1A">(*)</b>:</b></h6>
            <select class="form-control buscador_clientes required_cliente_existente"
                onchange="mostrar_contactos_clientes();" id="buscador_cliente" name="id_cliente" style="width:100%">
                <option value="" disabled selected> ✔ Seleccionar un Cliente</option>
                @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id }}">📌 DNI/RUC: {{ $cliente->dni_ruc }} || 💼
                        {{ $cliente->nombre }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <br>
    <div class="col-md-12">
        <div class="form-group">
            <h6><b style="color:#777">Contacto<b style="color:#B61A1A">(*)</b>:</b></h6>
            <select class="form-control buscador_contactos required_cliente_existente"
                onchange="valida_nuevo_contacto();" id="buscador_contacto" name="id_contacto" style="width:100%">
                <option value="" disabled selected> ⌛ Cargando lista ...</option>

            </select>
        </div>
    </div>
    <br>
    <div class="col-md-3 nuevo_contacto hidden">
        <div class="form-group">
            <label class="control-label" style="font-weight:600;color:#777"><b>NOMBRE DE CONTACTO: </b>
                <b style="color:#B61A1A">(*)</b></label>
            <input class="form-control estilo_campo required_contacto_nuevo" style="text-transform:uppercase;"
                onkeyup="javascript:this.value=this.value.toUpperCase();" name="nombre_contacto_nuevo" type="text"
                value="{{ old('nombre_contacto_nuevo') }}" autocomplete="off" placeholder="Nombre de contacto" />
        </div>
    </div>
    <div class="col-md-2 nuevo_contacto hidden">
        <div class="form-group">
            <label class="control-label" style="font-weight:600;color:#777"><b>DNI: </b>
                <b style="color:#B61A1A">(*)</b></label>
            <input class="form-control estilo_campo required_contacto_nuevo" name="dni" type="text"
                value="{{ old('dni') }}" autocomplete="off" placeholder="Nombre de contacto" />
        </div>
    </div>
    <div class="col-md-2 nuevo_contacto hidden">
        <div class="form-group">
            <label class="control-label" style="font-weight:600;color:#777"><b>CELULAR </b></label>
            <input class="form-control estilo_campo" name="celular_contacto_nuevo" type="text"
                value="{{ old('celular_contacto_nuevo') }}" autocomplete="off" placeholder="Celular de contacto" />
        </div>
    </div>
    <div class="col-md-3 nuevo_contacto hidden">
        <div class="form-group">
            <label class="control-label" style="font-weight:600;color:#777"><b>CORREO: </b></label>
            <input class="form-control estilo_campo" name="correo_contacto_nuevo" type="text"
                value="{{ old('correo_contacto_nuevo') }}" autocomplete="off" placeholder="correo de contacto" />
        </div>
    </div>
    <div class="col-md-2 nuevo_contacto hidden">
        <div class="form-group">
            <label class="control-label" style="font-weight:600;color:#777"><b>CARGO: </b></label>
            <input class="form-control estilo_campo" name="cargo_contacto_nuevo" style="text-transform:uppercase;"
                onkeyup="javascript:this.value=this.value.toUpperCase();" type="text"
                value="{{ old('cargo_contacto_nuevo') }}" autocomplete="off" placeholder="correo de contacto" />
        </div>
    </div>
    <br>

    <div class="col-md-12 hidden">
        <div class="form-group">
            <h6><b style="color:#777">Carga<b style="color:#B61A1A">(*)</b>:</b></h6>

        </div>
    </div>
    <div class="col-md-3 select_carga hidden">
        <div class="form-group">


            <a class="form-control btn" name="add_carga_e" id="add_carga_e" onclick="select_carga_nueva();"
                style="font-weight:700;font-size:14px;background:#ECDCC2;border-color:#777">Agregar Carga Nueva</a>

        </div>
    </div>

    <div class="col-md-3 select_carga hidden">
        <div class="form-group">

            <a class="form-control btn" id="carga_existente" onclick="select_carga_existente();"
                style="font-weight:700;font-size:14px;background:#ECDCC2;border-color:#777">Agregar Carga Existente</a>


        </div>
    </div>

    <div class="col-md-12 nueva_carga hidden">
        <h5>Datos de la Carga<b style="color:#B61A1A">(*)</b>:</h5>
        <br>
        <input class="form-control" name="contador_c_e" id="contador_c_e" type="hidden" value="0"
            autocomplete="off" />
        <table class="table table-bordered" id="tabla_carga_e" style="border: 1px solid #123;background:#fff">
            <thead>
                <tr>
                    <td style="width:15%">Tipo de Carga<b style="color:#B61A1A">(*)</b>:</td>
                    <td style="width:10%">Marca</td>
                    <td style="width:10%">Modelo</td>
                    <td style="width:10%">Placa</td>
                    <td style="width:15%">Dimensiones<br>(Largo x Ancho x Alto)</td>
                    <td style="width:10%">Peso</td>
                    <td style="width:10%">Unidad Medida</td>
                    <td style="text-align:center;width:6%">Eliminar</td>
                </tr>
            </thead>
        </table>
    </div>

</div>

<script>
    /////CLIENTE NUEVO
    function select_cliente_nuevo() {
        $(".required_contacto_nuevo").prop("required", false);
        document.getElementById("select_tipo_cliente").value = "1";
        quitar_select_existente();
        $('.vista_clientes_existentes').addClass('hidden');
        $('.vista_clientes_nuevos').removeClass('hidden');
        $('.required_cliente_nuevo').prop('required', true);
        $('.required_cliente_existente').prop('required', false);
        var cliente = document.getElementById("cliente_nuevo");
        cliente.style.background = "#FFB21B";
        cliente.style.color = "#000";
        cliente.style.border = "1px solid #777";



    }

    /////CLIENTE EXISTENTE
    function select_cliente_existente() {
        document.getElementById("carga_n0").remove();
        document.getElementById("contador_c_n").value = "0";
        document.getElementById("select_tipo_cliente").value = "2";
        quitar_select_nuevo();
        $('.vista_clientes_nuevos').addClass('hidden');
        $('.vista_clientes_existentes').removeClass('hidden');
        $('.required_cliente_existente').prop('required', true);
        $('.required_cliente_nuevo').prop('required', false);
        var cliente = document.getElementById("cliente_existente");
        cliente.style.background = "#FFB21B";
        cliente.style.color = "#000";
        cliente.style.border = "1px solid #777";
    }

    function quitar_select_nuevo() {
        var cliente = document.getElementById("cliente_nuevo");
        cliente.style.background = "#fff";
        cliente.style.color = "#000";
        cliente.style.border = " ";

    }

    function quitar_select_existente() {
        var cliente = document.getElementById("cliente_existente");
        cliente.style.background = "#fff";
        cliente.style.color = "#000";
        cliente.style.border = " ";

    }
</script>



<script>
    function select_carga_nueva() {
        $('.nueva_carga').removeClass('hidden');
    }
</script>
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
                '<input type="number"  name="peso_c_n[]" ' +
                'autocomplete="off" class="form-control" style="background:#77777710">' +
                '</td>' +

                '<td>' +
                '<select name="medida_peso_c_n[]" class="form-control "' +
                '>' +
                '<option value="" selected disabled>Seleccionar</option>' +
                '<option value="TN">TN</option>' +
                '<option value="KG">KG</option>' +
                '</select>' +
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
                '<input type="hidden" name="id_c_e[]" autocomplete="off"  style="background:#77777710" value ="0">' +
                '<input type="text"  name="tipo_c_e[]" ' +
                'autocomplete="off" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" style="background:#77777710" required>' +
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

                '<td>' +
                '<input type="text"  name="volumen_c_e[]" ' +
                'autocomplete="off" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" style="background:#77777710" >' +
                '</td>' +

                '<td>' +
                '<input type="text"  name="peso_c_e[]" ' +
                'autocomplete="off" class="form-control" style="background:#77777710" >' +
                '</td>' +


                '<td>' +
                '<select name="medida_peso_c_e[]" class="form-control "' +
                '>' +
                '<option value="" selected disabled>Seleccionar</option>' +
                '<option value="TN">TN</option>' +
                '<option value="KG">KG</option>' +
                '</select>' +
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


    function valida_nueva_carga(j) {
        //tabla_carga_existente' + j + ' ES LA CLASE DE LOS INPUT OCULTOS CUANDO SE SELECCIONA AGREGAR CARGAR EXISTENTE
        $('.tabla_carga_existente' + j + '').removeClass('hidden');
        $('#buscador_carga_tabla' + j).addClass('hidden');
        var data_buscador = $('#buscador_carga_tabla' + j).val();
        const dataArray = data_buscador.split("__");
        $('#id_carga' + j).val(dataArray[0]);
        $('#tipo' + j).val(dataArray[1]);
        $('#marca' + j).val(dataArray[2]);
        $('#modelo' + j).val(dataArray[3]);
        $('#placa' + j).val(dataArray[4]);
        $('#peso' + j).val(dataArray[5]);
        $('#medida' + j).val(dataArray[6]);
        $('#volumen' + j).val(dataArray[7]);


    }

    function select_carga_existente() {
        $('.nueva_carga').removeClass('hidden');

        // $('#select').removeClass("hidden");
        // $('#carga_existente').addClass("hidden");
        // $('#div_carga_existente').removeClass("col-md-3");
        // $('#div_carga_existente').addClass("col-md-9");

        var id_cliente = $('#buscador_cliente').val();
        buscar_carga_cliente(id_cliente, j);
        $('#tabla_carga_e').append(

            '<tr id="carga_e' + j + '" class="cargas_e" >' +

            '<td>' +
            '<select class="form-control buscador_cargas required_cliente_existente"' +
            'onchange="valida_nueva_carga(' + j + ');" id="buscador_carga_tabla' + j +
            '" name="id_carga"  style="width:100%" required>' +
            '<option value="" disabled selected> ⌛ Cargando lista ...</option>' +
            '</select>' +


            '<input readonly type="text"  id="tipo' + j + '" name="tipo_c_e[]" ' +
            'autocomplete="off" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"' +
            'class="form-control tabla_carga_existente' + j + ' hidden" style="background:#77777710">' +
            '<input type="hidden" id="id_carga' + j +
            '" name="id_c_e[]" autocomplete="off"  style="background:#77777710" >' +
            '</td>' +

            '<td>' +
            '<input type="text" id="marca' + j + '"  name="marca_c_e[]" ' +
            'autocomplete="off" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" readonly' +
            ' class="form-control tabla_carga_existente' + j + ' hidden" style="background:#77777710" >' +
            '</td>' +

            '<td>' +
            '<input type="text" id="modelo' + j + '" name="modelo_c_e[]" ' +
            'autocomplete="off" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" readonly ' +
            'class="form-control tabla_carga_existente' + j + ' hidden" style="background:#77777710" >' +
            '</td>' +

            '<td>' +
            '<input type="text" id="placa' + j + '" name="placa_c_e[]" ' +
            'autocomplete="off" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" readonly ' +
            'class="form-control tabla_carga_existente' + j + ' hidden" style="background:#77777710" >' +
            '</td>' +

            '<td>' +
            '<input type="text" id="volumen' + j + '"  name="volumen_c_e[]" ' +
            'autocomplete="off" readonly style="text-transform:uppercase;"  onkeyup="javascript:this.value=this.value.toUpperCase();"' +
            ' class="form-control tabla_carga_existente' + j + ' hidden" style="background:#77777710" >' +
            '</td>' +

            '<td>' +
            '<input type="text" id="peso' + j + '"  name="peso_c_e[]" ' +
            'autocomplete="off" style="text-transform:uppercase;"  onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control tabla_carga_existente' +
            j +
            ' hidden" readonly  >' +
            '</td>' +

            '<td>' +
            '<input type="text" id="medida' + j + '"  name="medida_peso_c_e[]" ' +
            'autocomplete="off" style="text-transform:uppercase;" readonly  onkeyup="javascript:this.value=this.value.toUpperCase();"' +
            ' class="form-control tabla_carga_existente' + j + ' hidden" style="background:#77777710" >' +
            '</td>' +

            '<td style="text-align:center">' +
            '<button type="button" onclick="eliminar_fila(' + j +
            ')" class="btn btn-danger btn_remove_c">X</button>' +
            '</td>' +
            '</tr>'
        );
        j++;
    }
</script>

<script>
    function buscar_carga_cliente(id_cliente, j) {
        if ($.trim(id_cliente) != '') {
            $.get('../consulta_cargas', {
                id_cliente: id_cliente
            }, function(datos) {
                var id_carga = datos["id"];
                var tipo = datos["tipo"];
                var marca = datos["marca"];
                var modelo = datos["modelo"];
                var placa = datos["placa"];
                var peso = datos["peso"];
                var medida = datos["medida"];
                var volumen = datos["volumen"];
                // $('#buscador_carga_tabla').append('<option>' + tipo + '</option>');

                $('#buscador_carga_tabla' + j).empty();
                $('#buscador_carga_tabla' + j).append(
                    "<option value='' selected disabled> ✔ Seleccionar una Carga</option>");
                var z = 0;
                $.each(datos["tipo"], function(index, value) {
                    $('#buscador_carga_tabla' + j).append("<option value=" + id_carga[z] +
                        "__" + tipo[z] + "__" + marca[z] + "__" + modelo[z] + "__" + placa[z] +
                        "__" + peso[z] + "__" + medida[z] + "__" + volumen[z] + "__" + "> 📌 " +
                        tipo[z] + " || MARCA: " + marca[z] + " || MODELO: ; " + modelo[z] +
                        " || MEDIDA: " + volumen[z] +
                        " || PLACA: " + placa[z] + " || PESO: " + peso[z] + " || MEDIDA: " + medida[
                            z] + "</option>");
                    z++;

                })


            }).fail(function() {
                // console.log("Hay un error")
            }).then(function(data) {
                //console.log(data);
            });

        }
    }
</script>

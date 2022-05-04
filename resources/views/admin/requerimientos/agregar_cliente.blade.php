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
                placeholder="Nombre de la empresa" />
            <!---->
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label" style="font-weight:600;color:#777"><b>DIRECCION: </b><a
                    style="color:#B61A1A"></a></label>
            <input class="form-control estilo_campo" name="direccion" type="text" value="{{ old('direccion') }}"
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
            <input class="form-control estilo_campo required_cliente_nuevo" name="nombre_contacto" type="text"
                value="{{ old('nombre_contacto') }}" autocomplete="off" placeholder="Nombre de contacto" />
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label class="control-label" style="font-weight:600;color:#777"><b>DNI: </b>
                <b style="color:#B61A1A">(*)</b></label>
            <input class="form-control estilo_campo required_cliente_nuevo" name="dni" type="text"
                value="{{ old('dni') }}" autocomplete="off" placeholder="Nombre de contacto" />
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label class="control-label" style="font-weight:600;color:#777"><b>CELULAR </b></label>
            <input class="form-control estilo_campo" name="celular_contacto" type="text"
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
            <input class="form-control estilo_campo" name="cargo_contacto" type="text"
                value="{{ old('cargo_contacto') }}" autocomplete="off" placeholder="correo de contacto" />
        </div>
    </div>





    <div class="col-md-12">
        <h5>Datos de la Carga<b style="color:#B61A1A">(*)</b>:</h5>
    </div>
    <br>
    <br>
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label" style="font-weight:600;color:#777"><b>TIPO DE CARGA: </b>
                <b style="color:#B61A1A">(*)</b></label>
            <input class="form-control estilo_campo required_cliente_nuevo" name="tipo_carga" type="text"
                value="{{ old('tipo_carga') }}" autocomplete="off" placeholder="Tipo de carga" />
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label" style="font-weight:600;color:#777"><b>MARCA: </b>
            </label>
            <input class="form-control estilo_campo required_cliente_nuevo" name="marca_carga" type="text"
                value="{{ old('marca_carga') }}" autocomplete="off" placeholder="Marca" />
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label" style="font-weight:600;color:#777"><b>MODELO </b></label>
            <input class="form-control estilo_campo" name="modelo_carga" type="text"
                value="{{ old('modelo_carga') }}" autocomplete="off" placeholder="Modelo" />
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label" style="font-weight:600;color:#777"><b>PLACA: </b></label>
            <input class="form-control estilo_campo" name="placa_carga" type="text" value="{{ old('placa_carga') }}"
                autocomplete="off" placeholder="Placa" />
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label class="control-label" style="font-weight:600;color:#777"><b>VOLUMEN: </b></label>
            <input class="form-control estilo_campo" name="volumen_carga" type="text"
                value="{{ old('volumen_carga') }}" autocomplete="off" placeholder="Volumen" />
        </div>
    </div>


    <div class="col-md-2">
        <div class="form-group">
            <label class="control-label" style="font-weight:600;color:#777"><b>LARGO:</b></label>
            <input class="form-control estilo_campo " name="largo_carga" type="text" value="{{ old('largo_carga') }}"
                autocomplete="off" placeholder="Largo" />
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label class="control-label" style="font-weight:600;color:#777"><b>ANCHO:</b></label>
            <input class="form-control estilo_campo " name="ancho_carga" type="text" value="{{ old('ancho_carga') }}"
                autocomplete="off" placeholder="Ancho" />
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label class="control-label" style="font-weight:600;color:#777"><b>ALTURA:</b></label>
            <input class="form-control estilo_campo " name="altura_carga" type="text"
                value="{{ old('altura_carga') }}" autocomplete="off" placeholder="Altura" />
        </div>
    </div>

    <div class="col-md-1">
        <div class="form-group">
            <label class="control-label" style="font-weight:600;color:#777"><b>PESO:</b></label>
            <input class="form-control estilo_campo " name="peso_carga" type="text" value="{{ old('peso_carga') }}"
                autocomplete="off" placeholder="Peso" />
        </div>
    </div>

    <div class="col-md-1">
        <div class="form-group ">
            <label class="control-label" style="font-weight:600;color:#777;width:100%"><b>MEDIDA</b><b
                    style="color:#B61A1A">(*)</b>:</label>
            <select name="medida_peso_carga" class="form-control form_nuevo estilo_campo ">
                <option value="" selected disabled>Seleccionar</option>
                <option value="kg">Kilogramo</option>
                <option value="t">Tonelada</option>
            </select>
        </div>
    </div>

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
            <input class="form-control estilo_campo required_contacto_nuevo" name="nombre_contacto_nuevo" type="text"
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
            <input class="form-control estilo_campo" name="cargo_contacto_nuevo" type="text"
                value="{{ old('cargo_contacto_nuevo') }}" autocomplete="off" placeholder="correo de contacto" />
        </div>
    </div>
    <br>








    <div class="col-md-12">
        <div class="form-group">
            <h6><b style="color:#777">Carga<b style="color:#B61A1A">(*)</b>:</b></h6>
            <select class="form-control buscador_cargas required_cliente_existente" onchange="valida_nueva_carga();"
                id="buscador_carga" name="id_carga" style="width:100%">
                <option value="" disabled selected> ⌛ Cargando lista ...</option>

            </select>
        </div>
    </div>

    <div class="col-md-12 nueva_carga hidden">
        <h5>Datos de la Carga<b style="color:#B61A1A">(*)</b>:</h5>
    </div>
    <div class="col-md-3 nueva_carga  hidden">
        <div class="form-group">
            <label class="control-label" style="font-weight:600;color:#777"><b>TIPO DE CARGA: </b>
                <b style="color:#B61A1A">(*)</b></label>
            <input class="form-control estilo_campo required_carga_nueva" name="tipo_carga_cliente_existente"
                type="text" value="{{ old('tipo_carga_cliente_existente') }}" autocomplete="off"
                placeholder="Tipo de carga" />
        </div>
    </div>
    <div class="col-md-2 nueva_carga  hidden">
        <div class="form-group">
            <label class="control-label" style="font-weight:600;color:#777"><b>MARCA: </b>
            </label>
            <input class="form-control estilo_campo " name="marca_carga_cliente_existente" type="text"
                value="{{ old('marca_carga_cliente_existente') }}" autocomplete="off" placeholder="Marca" />
        </div>
    </div>
    <div class="col-md-2 nueva_carga  hidden">
        <div class="form-group">
            <label class="control-label" style="font-weight:600;color:#777"><b>MODELO </b></label>
            <input class="form-control estilo_campo" name="modelo_carga_cliente_existente" type="text"
                value="{{ old('modelo_carga_cliente_existente') }}" autocomplete="off" placeholder="Modelo" />
        </div>
    </div>

    <div class="col-md-3 nueva_carga  hidden">
        <div class="form-group">
            <label class="control-label" style="font-weight:600;color:#777"><b>PLACA: </b></label>
            <input class="form-control estilo_campo" name="placa_carga_cliente_existente" type="text"
                value="{{ old('placa_carga_cliente_existente') }}" autocomplete="off" placeholder="Placa" />
        </div>
    </div>

    <div class="col-md-2 nueva_carga  hidden">
        <div class="form-group">
            <label class="control-label" style="font-weight:600;color:#777"><b>VOLUMEN: </b></label>
            <input class="form-control estilo_campo" name="volumen_carga_cliente_existente" type="text"
                value="{{ old('volumen_carga_cliente_existente') }}" autocomplete="off" placeholder="Volumen" />
        </div>
    </div>


    <div class="col-md-2  nueva_carga hidden">
        <div class="form-group">
            <label class="control-label" style="font-weight:600;color:#777"><b>LARGO:</b></label>
            <input class="form-control estilo_campo " name="largo_carga_cliente_existente" type="text"
                value="{{ old('largo_carga_cliente_existente') }}" autocomplete="off" placeholder="Largo" />
        </div>
    </div>

    <div class="col-md-2 nueva_carga  hidden">
        <div class="form-group">
            <label class="control-label" style="font-weight:600;color:#777"><b>ANCHO:</b></label>
            <input class="form-control estilo_campo " name="ancho_carga_cliente_existente" type="text"
                value="{{ old('ancho_carga_cliente_existente') }}" autocomplete="off" placeholder="Ancho" />
        </div>
    </div>

    <div class="col-md-2 nueva_carga  hidden">
        <div class="form-group">
            <label class="control-label" style="font-weight:600;color:#777"><b>ALTURA:</b></label>
            <input class="form-control estilo_campo " name="altura_carga_cliente_existente" type="text"
                value="{{ old('altura_carga_cliente_existente') }}" autocomplete="off" placeholder="Altura" />
        </div>
    </div>

    <div class="col-md-1 nueva_carga  hidden">
        <div class="form-group">
            <label class="control-label" style="font-weight:600;color:#777"><b>PESO:</b></label>
            <input class="form-control estilo_campo " name="peso_carga_cliente_existente" type="text"
                value="{{ old('peso') }}" autocomplete="off" placeholder="Peso" />
        </div>
    </div>

    <div class="col-md-2 nueva_carga hidden">
        <div class="form-group ">
            <label class="control-label" style="font-weight:600;color:#777;width:100%"><b>MEDIDA</b>:</label>
            <select name="medida_carga_cliente_existente" class="form-control form_nuevo estilo_campo ">
                <option value="" selected disabled>Seleccionar Medida</option>
                <option value="kg">Kilogramo</option>
                <option value="t">Tonelada</option>
            </select>
        </div>
    </div>



</div>

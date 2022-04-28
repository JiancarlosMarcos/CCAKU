{{-- <style>
    .hidden {
        overflow: hidden;
        visibility: hidden;
        display: none;
    }

</style> --}}

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
    &nbsp;&nbsp;&nbsp;
    <div class="col-md-1.5">
        <div class="form-group">
            <label class="control-label" style="font-weight:600;color:#777"><b>TIPO: </b><b
                    style="color:#B61A1A">(*)</b></label>
            <select id="tipo_cliente" class="form-control buscador-linea required_cliente_nuevo" name="tipo_cliente">
                <option value="" selected disabled>Seleccionar</option>
                <option value="1" {{ old('tipo_cliente') == '1' ? 'selected' : '' }}>Empresa</option>
                <option value="2" {{ old('tipo_cliente') == '2' ? 'selected' : '' }}>Persona Natural</option>
            </select>
        </div>
    </div>
    &nbsp;&nbsp;&nbsp;&nbsp;
    {{-- <div class="col-md-1.5">
        <div class="form-group">
            <label class="control-label" style="font-weight:600;color:#777"><b>VIA DE INGRESO: </b>
                <b style="color:#B61A1A">(*)</b></label>
            <select name="id_via_ingreso" class="form-control buscador-linea required_cliente_nuevo" style="">
                <option value="" selected disabled>Seleccionar</option>

                <option value="1" {{ old('id_via_ingreso') == '1' ? 'selected' : '' }}>Pagina Web</option>
                <option value="2" {{ old('id_via_ingreso') == '2' ? 'selected' : '' }}>Facebook</option>
                <option value="3" {{ old('id_via_ingreso') == '3' ? 'selected' : '' }}>Referido</option>
                <option value="4" {{ old('id_via_ingreso') == '4' ? 'selected' : '' }}>Mailling </option>
                <option value="6" {{ old('id_via_ingreso') == '6' ? 'selected' : '' }}>No Aplica</option>

            </select>
        </div>
    </div> --}}

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


    <div class="col-md-3 nuevo_contacto hidden">
        <div class="form-group">
            <label class="control-label" style="font-weight:600;color:#777"><b>NOMBRE DE CONTACTO: </b>
                <b style="color:#B61A1A">(*)</b></label>
            <input class="form-control estilo_campo required_contacto_nuevo" name="nombre_contacto_nuevo" type="text"
                value="{{ old('nombre_contacto_nuevo') }}" autocomplete="off" placeholder="Nombre de contacto" />
        </div>
    </div>
    <div class="col-md-3 nuevo_contacto hidden">
        <div class="form-group">
            <label class="control-label" style="font-weight:600;color:#777"><b>DNI: </b>
                <b style="color:#B61A1A">(*)</b></label>
            <input class="form-control estilo_campo required_contacto_nuevo" name="dni" type="text"
                value="{{ old('dni') }}" autocomplete="off" placeholder="Nombre de contacto" />
        </div>
    </div>

    <div class="col-md-3 nuevo_contacto hidden">
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

    <div class="col-md-3 nuevo_contacto hidden">
        <div class="form-group">
            <label class="control-label" style="font-weight:600;color:#777"><b>CARGO: </b></label>
            <input class="form-control estilo_campo" name="cargo_contacto_nuevo" type="text"
                value="{{ old('cargo_contacto_nuevo') }}" autocomplete="off" placeholder="correo de contacto" />
        </div>
    </div>


</div>

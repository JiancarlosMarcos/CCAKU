<div class="row vista_clientes_existentes ">

    <div class="col-md-6">
        <div class="form-group">

            <label class="control-label" style="font-weight:600;color:#777"> Empresa:</label>
            @foreach ($clientes as $cliente)
            @if ($cliente->id == $data_requerimiento->id_cliente)
            <input type="text" id="estado" class="form-control " name="empresa" style="font-weight:600"
                value="Nombre: {{ $cliente->nombre }} || Ruc: {{ $cliente->dni_ruc }}" readonly>
            @endif
            @endforeach
        </div>
    </div>
    <br>
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label" style="font-weight:600;color:#777"> Contacto:</label>
            <input type="text" id="estado" class="form-control " name="empresa" style="font-weight:600"
                value="{{ $data_requerimiento->contacto->nombre }}" readonly>
        </div>
    </div>

    @include('admin/cotizaciones/agregar/agregar_carga')

</div>


<div class="row" style="margin-bottom:0px">
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label " style="font-weight:600;color:#777">Fecha de Transporte:</label>
            <input class="form-control" type="date" id="fecha_transporte" name="fecha_transporte"
                style="font-weight:600;text-align:center" value="{{ $data_requerimiento->fecha->format('Y-m-d') }}"
                required>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label " style="font-weight:600;color:#777">Contacto de destino:</label>
            <input class="form-control" type="text" id="" name="" style="font-weight:600;text-align:center" value="">
        </div>
    </div>
</div>
<h6><u>ORIGEN:</u></h6>
<div class="row" style="margin-bottom:0px">
    <div class="col-md-4">
        <div class="form-group">
            <label class="control-label" style="font-weight:600;color:#777">DEPARTAMENTO<a
                    style="color:#B61A1A"><b>(*)</b></a></label>
            <select id="departamento_origen" name="id_departamento_origen"
                class="form-control buscador_departamento form_nuevo estilo_campo " style="width:100%; heigth:30px"
                required>
                <option value="" selected disabled> ✔️ Selecciona un Departamento</option>
                @foreach ($departamentos as $departamento)
                <option value="{{ $departamento->id }}"
                    {{ ($departamento->id == $id_departamento_origen)? 'selected' : '' }}>
                    📌 {{ $departamento->departamento }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label class="control-label" style="font-weight:600;color:#777">PROVINCIA</label>
            <select id="provincia_origen" name="id_provincia_origen"
                class="form-control buscador_provincia form_nuevo estilo_campo " style="width:100%; heigth:30px">



            </select>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label class="control-label" style="font-weight:600;color:#777">DISTRITO</label>
            <select id="distrito_origen" name="id_distrito_origen"
                class="form-control buscador_distrito form_nuevo estilo_campo " style="width:100%; heigth:30px">


            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label" style="font-weight:600;color:#777">DIRECCIÓN</label>
            <input type="text" name="direccion_origen" class="form-control">
            </select>
        </div>
    </div>
</div>
<hr>
<h6><u>DESTINO:</u></h6>
<div class="row" style="margin-bottom:0px">
    <div class="col-md-4">
        <div class="form-group">
            <label class="control-label" style="font-weight:600;color:#777">DEPARTAMENTO<a
                    style="color:#B61A1A"><b>(*)</b></a></label>
            <select id="departamento_destino" name="id_departamento_destino"
                class="form-control buscador_departamento form_nuevo estilo_campo " style="width:100%" required>
                <option value="" selected disabled>✔️ Selecciona un Departamento</option>
                @foreach ($departamentos as $departamento)
                <option value="{{ $departamento->id }}"
                    {{ ($departamento->id == $id_departamento_destino) ? 'selected' : '' }}>
                    📍 {{ $departamento->departamento }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label class="control-label" style="font-weight:600;color:#777">PROVINCIA</label>
            <select id="provincia_destino" name="id_provincia_destino"
                class="form-control buscador_provincia form_nuevo estilo_campo " style="width:100%; heigth:30px">


            </select>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label class="control-label" style="font-weight:600;color:#777">DISTRITO</label>
            <select id="distrito_destino" name="id_distrito_destino"
                class="form-control buscador_distrito form_nuevo estilo_campo " style="width:100%; heigth:30px">


            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label" style="font-weight:600;color:#777">DIRECCIÓN</label>
            <input type="text" name="direccion_destino" class="form-control">
            </select>
        </div>
    </div>

</div>


@push('js-ubicacion')
<script>
//SCRIPT PARA PROVINCIAS ORIGEN
$(document).ready(function() {
    $('#departamento_origen').on('change', function() {
        var id_departamento = $(this).val();
        if ($.trim(id_departamento) != '') {
            $.get('../../provincias', {
                id_departamento: id_departamento
            }, function(provincias) {
                $('#provincia_origen').empty();
                $('#distrito_origen').empty();
                $('#provincia_origen').append(
                    "<option value=''> ✔️ Selecciona una Provincia</option>");
                $('#distrito_origen').append(
                    "<option value=''> ⏳ Selecciona una Provincia</option>");
                $.each(provincias, function(index, value) {
                    $('#provincia_origen').append("<option value='" + index + "'> 📌 " +
                        value + "</option>");
                })
            });
        }
    });

});
</script>

<script>
//SCRIPT PARA DISTRITOS ORIGEN
$(document).ready(function() {

    $('#provincia_origen').on('change', function() {
        var id_provincia = $(this).val();
        if ($.trim(id_provincia) != '') {
            $.get('../../distritos', {
                id_provincia: id_provincia
            }, function(distritos) {
                $('#distrito_origen').empty();
                $('#distrito_origen').append(
                    "<option value=''> ✔️ Selecciona un distrito</option>");
                $.each(distritos, function(index, value) {
                    $('#distrito_origen').append("<option value='" + index + "'> 📌 " +
                        value + "</option>");
                })
            });
        }
    });
});
</script>


<script>
//SCRIPT PARA PROVINCIAS DESTINO
$(document).ready(function() {
    $('#departamento_destino').on('change', function() {
        var id_departamento = $(this).val();
        if ($.trim(id_departamento) != '') {
            $.get('../../provincias', {
                id_departamento: id_departamento
            }, function(provincias) {
                $('#provincia_destino').empty();
                $('#distrito_destino').empty();
                $('#provincia_destino').append(
                    "<option value=''> ✔️ Selecciona una Provincia</option>");
                $('#distrito_destino').append(
                    "<option value=''> ⏳ Selecciona una Provincia</option>");
                $.each(provincias, function(index, value) {
                    $('#provincia_destino').append("<option value='" + index +
                        "'> 📍 " + value + "</option>");
                })
            });
        }
    });

});
</script>

<script>
//SCRIPT PARA DISTRITOS DESTINO
$(document).ready(function() {

    $('#provincia_destino').on('change', function() {
        var id_provincia = $(this).val();
        if ($.trim(id_provincia) != '') {
            $.get('../../distritos', {
                id_provincia: id_provincia
            }, function(distritos) {
                $('#distrito_destino').empty();
                $('#distrito_destino').append(
                    "<option value=''> ✔️ Selecciona un distrito</option>");
                $.each(distritos, function(index, value) {
                    $('#distrito_destino').append("<option value='" + index + "'> 📍 " +
                        value + "</option>");
                })
            });
        }
    });
});
</script>

<script>
function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

async function habilitar_provincia_origen() {
    var id_departamento = document.getElementById("departamento_origen").value;
    if ($.trim(id_departamento) != '') {
        $.get('../../provincias', {
            id_departamento: id_departamento
        }, function(provincias) {
            $('#provincia_origen').empty();

            $('#provincia_origen').append("<option value=''  > ✔️ Selecciona una provincia</option>");
            $('#distrito_origen').append("<option value='' > ⏳ Selecciona una provincia</option>");
            $.each(provincias, function(index, value) {
                var estado = "";
                if (index == "<?php echo $id_provincia_origen; ?>") {
                    estado = "selected";
                }

                $('#provincia_origen').append("<option value='" + index + "' " + estado + "> 📌 " +
                    value + "</option>");
            })
        });
    }
}

async function habilitar_distrito_origen() {
    var id_provincia = document.getElementById("provincia_origen").value;
    if (id_provincia == "") {
        await sleep(1000);
        habilitar_distrito_origen();
    } else {
        if ($.trim(id_provincia) != '') {
            $.get('../../distritos', {
                id_provincia: id_provincia
            }, function(distritos) {
                $('#distrito_origen').empty();
                $('#distrito_origen').append("<option value=''> ✔️ Selecciona un distrito</option>");
                $.each(distritos, function(index, value) {
                    var estado = "";
                    if (index == "<?php echo $id_distrito_origen; ?>") {
                        estado = "selected";
                    }
                    $('#distrito_origen').append("<option value='" + index + "' " + estado +
                        "> 📌 " + value + "</option>");
                })
            });
        }


    }
}
</script>


<script>


async function habilitar_provincia_destino() {
    var id_departamento = document.getElementById("departamento_destino").value;
    if ($.trim(id_departamento) != '') {
        $.get('../../provincias', {
            id_departamento: id_departamento
        }, function(provincias) {
            $('#provincia_destino').empty();

            $('#provincia_destino').append("<option value=''  > ✔️ Selecciona una provincia</option>");
            $('#distrito_destino').append("<option value='' > ⏳ Selecciona una provincia</option>");
            $.each(provincias, function(index, value) {
                var estado = "";
                if (index == "<?php echo $id_provincia_destino; ?>") {
                    estado = "selected";
                }

                $('#provincia_destino').append("<option value='" + index + "' " + estado + "> 📌 " +
                    value + "</option>");
            })
        });
    }
}

async function habilitar_distrito_destino() {
    var id_provincia = document.getElementById("provincia_destino").value;
    if (id_provincia == "") {
        await sleep(1000);
        habilitar_distrito_destino();
    } else {
        if ($.trim(id_provincia) != '') {
            $.get('../../distritos', {
                id_provincia: id_provincia
            }, function(distritos) {
                $('#distrito_destino').empty();
                $('#distrito_destino').append("<option value=''> ✔️ Selecciona un distrito</option>");
                $.each(distritos, function(index, value) {
                    var estado = "";
                    if (index == "<?php echo $id_distrito_destino; ?>") {
                        estado = "selected";
                    }
                    $('#distrito_destino').append("<option value='" + index + "' " + estado +
                        "> 📌 " + value + "</option>");
                })
            });
        }


    }
}
</script>
@endpush
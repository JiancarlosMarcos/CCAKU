<h5> Seleccionar Origen y Destino de la Carga:<b style="color:#B61A1A;outline:none">(*)</b>:</h5>
<div class="row" style="margin-bottom:0px">
    <div class="col-md-12">

        <label class="control-label" style="font-weight:600;color:#777"><b>ORIGEN</b><b
                style="color:#B61A1A">(*)</b>:</label>

    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="" class="control-label" style="margin-bottom:1px"><b>Departamento</b><b
                    style="color:#B61A1A">(*)</b>:</label>
            <select id="departamento_o" name="departamento_origen" class="form-control buscador_departamento"
                style="width:100%" required>
                <option value="" selected disabled>Seleccionar</option>
                @foreach ($departamentos as $departamento)
                    <option value="{{ $departamento->id }}"
                        {{ old('departamento_origen') == "$departamento->id" ? 'selected' : '' }}>
                        {{ $departamento->departamento }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="" class="control-label" style="margin-bottom:1px"><b>Provincia</b></label>
            <select id="provincia_o" name="provincia_origen" class="form-control buscador_provincia" style="width:100%">
                <option value="" selected disabled>Seleccione un departamento</option>
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="" class="control-label" style="margin-bottom:1px"><b>Distrito</b></label>
            <select id="distrito_o" name="distrito_origen" class="form-control buscador_distrito" style="width:100%">
                <option value="" selected disabled>Seleccione una provincia</option>
            </select>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label for="" class="control-label" style="margin-bottom:1px"><b>Direccion</b></label>
            <input type="text" class="form-control" name="direccion_origen" style="text-transform:uppercase;"
                onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{ old('direccion_origen') }}"
                placeholder="Direccion de origen"><br>
        </div>
    </div>


    <div class="col-md-12">

        <label class="control-label" style="font-weight:600;color:#777"><b>DESTINO</b><b
                style="color:#B61A1A">(*)</b>:</label>

    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="" class="control-label" style="margin-bottom:1px"><b>Departamento</b><b
                    style="color:#B61A1A">(*)</b>:</label>
            <select id="departamento_d" name="departamento_destino" class="form-control buscador_departamento"
                style="width:100%" required>
                <option value="" selected disabled>Seleccionar</option>
                @foreach ($departamentos as $departamento)
                    <option value="{{ $departamento->id }}"
                        {{ old('departamento_destino') == "$departamento->id" ? 'selected' : '' }}>
                        {{ $departamento->departamento }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="" class="control-label" style="margin-bottom:1px"><b>Provincia</b></label>
            <select id="provincia_d" name="provincia_destino" class="form-control buscador_provincia"
                style="width:100%">
                <option value="" selected disabled>Seleccione un departamento</option>
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="" class="control-label" style="margin-bottom:1px"><b>Distrito</b></label>
            <select id="distrito_d" name="distrito_destino" class="form-control buscador_distrito" style="width:100%">
                <option value="" selected disabled>Seleccione una provincia</option>
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="" class="control-label" style="margin-bottom:1px"><b>Direccion</b></label>
            <input type="text" class="form-control" name="direccion_destino" style="text-transform:uppercase;"
                onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{ old('direccion_destino') }}"
                placeholder="Direccion de destino"><br>
        </div>
    </div>
</div>
<script>
    //SCRIPT PARA PROVINCIAS
    $(document).ready(function() {
        $('#departamento_o').on('change', function() {
            var id_departamento = $(this).val();
            if ($.trim(id_departamento) != '') {
                $.get('../provincias', {
                    id_departamento: id_departamento
                }, function(provincias) {
                    $('#provincia_o').empty();
                    $('#distrito_o').empty();
                    $('#provincia_o').append(
                        "<option value=''> ✔ Selecciona una provincia</option>");
                    $('#distrito_o').append(
                        "<option value=''> ⌛ Selecciona una provincia</option>");
                    $.each(provincias, function(index, value) {
                        $('#provincia_o').append("<option value='" + index + "'>" +
                            value + "</option>");
                    })
                });
            }
        });

    });
</script>


<script>
    //SCRIPT PARA DISTRITOS
    $(document).ready(function() {

        $('#provincia_o').on('change', function() {
            console.log("xd");
            var id_provincia = $(this).val();
            if ($.trim(id_provincia) != '') {
                $.get('../distritos', {
                    id_provincia: id_provincia
                }, function(distritos) {
                    $('#distrito_o').empty();
                    $('#distrito_o').append(
                        "<option value=''> ✔ Selecciona un distrito</option>");
                    $.each(distritos, function(index, value) {
                        $('#distrito_o').append("<option value='" + index + "'>" +
                            value +
                            "</option>");
                    })
                });
            }
        });
    });
</script>
<script>
    //SCRIPT PARA PROVINCIAS
    $(document).ready(function() {
        $('#departamento_d').on('change', function() {
            var id_departamento = $(this).val();
            if ($.trim(id_departamento) != '') {
                $.get('../provincias', {
                    id_departamento: id_departamento
                }, function(provincias) {
                    $('#provincia_d').empty();
                    $('#distrito_d').empty();
                    $('#provincia_d').append(
                        "<option value=''> ✔ Selecciona una provincia</option>");
                    $('#distrito_d').append(
                        "<option value=''> ⌛ Selecciona una provincia</option>");
                    $.each(provincias, function(index, value) {
                        $('#provincia_d').append("<option value='" + index + "'>" +
                            value + "</option>");
                    })
                });
            }
        });

    });
</script>


<script>
    //SCRIPT PARA DISTRITOS
    $(document).ready(function() {

        $('#provincia_d').on('change', function() {
            console.log("xd");
            var id_provincia = $(this).val();
            if ($.trim(id_provincia) != '') {
                $.get('../distritos', {
                    id_provincia: id_provincia
                }, function(distritos) {
                    $('#distrito_d').empty();
                    $('#distrito_d').append(
                        "<option value=''> ✔ Selecciona un distrito</option>");
                    $.each(distritos, function(index, value) {
                        $('#distrito_d').append("<option value='" + index + "'>" +
                            value +
                            "</option>");
                    })
                });
            }
        });
    });
</script>

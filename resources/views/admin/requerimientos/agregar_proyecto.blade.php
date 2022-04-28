<div class="form-card" style="color:#000">
    <h5> Seleccionar o Registrar la carga<b style="color:#B61A1A;outline:none">(*)</b>:</h5>
    <div class="row" style="margin-bottom:5px">

        <div class="col-md-3">

            <div class="form-group">
                <!--DATA OCULTA-->
                <input type="hidden" id="valida_select_carga" name="valida_select_carga"
                    value="{{ old('valida_select_carga') }}">

                <a class="form-control btn" id="select_existente" onclick="select_proyecto_existente();"
                    style="border-color:#777;text-align:center;background:#fff;font-weight:600">Carga Existente</a>



            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <a class="form-control btn" id="select_nuevo" onclick="select_proyecto_nuevo();"
                    style="border-color:#777;text-align:center;background:#fff;font-weight:600">Carga Nueva</a>


            </div>
        </div>

    </div>
</div>

@if (old('valida_select_carga') == '1')
    <?php echo '<script> function activar_proyecto(){ select_proyecto_nuevo(); } </script>'; ?>
@endif

<script>
    function select_proyecto_nuevo() {
        $('.buscador_equipos').removeClass('hidden');
        quitar_select_proyecto_existente();
        var select = document.getElementById("select_nuevo");
        var valida = document.getElementById("valida_select_carga");
        valida.value = "1";
        select.style.background = "#FFB21B";
        select.style.color = "#000";
        select.style.border = "1px solid #777";
        $('.proyecto_nuevo').removeClass('hidden');
        $('.proyecto_existente').addClass('hidden');
        $('.form_nuevo').prop("required", true);
        $('.form_existe').removeAttr("required");
    }

    function select_proyecto_existente() {
        $('.buscador_equipos').removeClass('hidden');
        quitar_select_proyecto_nuevo();
        var select = document.getElementById("select_existente");
        var valida = document.getElementById("valida_select_carga");
        valida.value = "2";
        select.style.background = "#FFB21B";
        select.style.color = "#000";
        select.style.border = "1px solid #777";
        $('.proyecto_existente').removeClass('hidden');
        $('.proyecto_nuevo').addClass('hidden');
        $('.form_nuevo').removeAttr("required");
        $('.form_existe').prop("required", true);
    }


    function quitar_select_proyecto_existente() {
        var select = document.getElementById("select_existente");
        select.style.background = "#fff";
        select.style.color = "#000";
        select.style.border = " ";
    }

    function quitar_select_proyecto_nuevo() {
        var select = document.getElementById("select_nuevo");
        select.style.background = "#fff";
        select.style.color = "#000";
        select.style.border = " ";
    }
</script>

<div class="proyecto_nuevo hidden">


    <div class="row" style="margin-bottom:0px">

        <div class="col-md-3">
            <div class="form-group" style="margin-bottom:0px">
                <label class="control-label" style="font-weight:600;color:#777"><b>TIPO DE CARGA</b><b
                        style="color:#B61A1A">(*)</b>:</label>
                <input class="form-control form_nuevo estilo_campo" name="tipo" type="text" value="{{ old('tipo') }}"
                    id="tipo" autocomplete="off" placeholder="" onkeyup="validar_tipo()">

                <input type="text" value="" class="alerta_1" id="valida_tipo"
                    style="font-size:14px;background:transparent;border:0px solid transparent;width:700px;color:#be1e37;margin-top:-50px"
                    disabled>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label" style="font-weight:600;color:#777"><b>MARCA:</b></label>
                <input class="form-control estilo_campo " name="marca" type="text" value="{{ old('marca') }}"
                    autocomplete="off" placeholder="" />
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label" style="font-weight:600;color:#777"><b>MODELO:</b></label>
                <input class="form-control estilo_campo " name="modelo" type="text" value="{{ old('modelo') }}"
                    autocomplete="off" placeholder="" />
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label" style="font-weight:600;color:#777"><b>PLACA:</b></label>
                <input class="form-control estilo_campo " name="placa" type="text" value="{{ old('placa') }}"
                    autocomplete="off" placeholder="" />
            </div>
        </div>



        <div class="col-md-2">
            <div class="form-group">
                <label class="control-label" style="font-weight:600;color:#777"><b>VOLUMEN:</b></label>
                <input class="form-control estilo_campo " name="volumen" type="text" value="{{ old('volumen') }}"
                    autocomplete="off" placeholder="" />
            </div>
        </div>

        <div class="col-md-2">
            <div class="form-group">
                <label class="control-label" style="font-weight:600;color:#777"><b>LARGO:</b></label>
                <input class="form-control estilo_campo " name="largo" type="text" value="{{ old('largo') }}"
                    autocomplete="off" placeholder="" />
            </div>
        </div>

        <div class="col-md-2">
            <div class="form-group">
                <label class="control-label" style="font-weight:600;color:#777"><b>ANCHO:</b></label>
                <input class="form-control estilo_campo " name="ancho" type="text" value="{{ old('ancho') }}"
                    autocomplete="off" placeholder="" />
            </div>
        </div>

        <div class="col-md-2">
            <div class="form-group">
                <label class="control-label" style="font-weight:600;color:#777"><b>ALTURA:</b></label>
                <input class="form-control estilo_campo " name="altura" type="text" value="{{ old('altura') }}"
                    autocomplete="off" placeholder="" />
            </div>
        </div>

        <div class="col-md-1">
            <div class="form-group">
                <label class="control-label" style="font-weight:600;color:#777"><b>PESO:</b></label>
                <input class="form-control estilo_campo " name="peso" type="text" value="{{ old('peso') }}"
                    autocomplete="off" placeholder="" />
            </div>
        </div>

        <div class="col-md-1">
            <div class="form-group ">
                <label class="control-label" style="font-weight:600;color:#777;width:100%"><b>MEDIDA</b><b
                        style="color:#B61A1A">(*)</b>:</label>
                <select name="medida" class="form-control form_nuevo estilo_campo ">
                    <option value="" selected disabled>Seleccionar</option>
                    <option value="kg">Kilogramo</option>
                    <option value="t">Tonelada</option>
                </select>
            </div>
        </div>
        {{-- <div class="col-md-2">
            <div class="form-group">
                <label class="control-label" style="font-weight:600;color:#777"><b>DEPARTAMENTO</b><b
                        style="color:#B61A1A">(*)</b>:</label>
                <select id="departamento" name="departamento"
                    class="form-control buscador_departamento form_nuevo estilo_campo " style="width:100%">
                    <option value="" selected disabled> ✔ Seleccionar</option>
                    @foreach ($departamentos as $departamento)
                        <option value="{{ $departamento->id }}"
                            {{ old('departamento') == "$departamento->id" ? 'selected' : '' }}>
                            {{ $departamento->departamento }}</option>
                    @endforeach
                </select>
            </div>
        </div> --}}

    </div>

    <div class="row" style="margin-bottom:5px">



        {{-- <div class="col-md-3">
            <div class="form-group">
                <label class="control-label" style="font-weight:600;color:#777"><b>PROVINCIA:</b><a
                        style="color:#B61A1A"></a></label>
                <select id="provincia" name="provincia" class="form-control buscador_provincia estilo_campo "
                    style="width:100%">
                    <option value="" selected disabled> ⌛ Cargando Lista...</option>
                </select>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label" style="font-weight:600;color:#777"><b>DISTRITO:</b><a
                        style="color:#B61A1A"></a></label>
                <select id="distrito" name="distrito" class="form-control buscador_distrito estilo_campo "
                    style="width:100%">
                    <option value="" selected disabled> ⌛ Cargando Lista..</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
        </div> --}}

        {{-- <div class="col-md-3">
            <div class="form-group">
                <label class="control-label" style="font-weight:600;color:#777"><b>FECHA DE INICIO DEL PROYECTO:</b><a
                        style="color:#B61A1A"></a></label>
                <input type="date" name="fecha_inicio_proyecto" class="form-control estilo_campo ">

            </div>
        </div> --}}


    </div>
</div>



<!--PROYECTO EXISTENTES FORM-->
<div class="proyecto_existente hidden">

    <div class="col-md-3">
        <div class="form-group" style="margin-bottom:0px">

        </div>
    </div>
    <div class="row" style="margin-bottom:5px">
        <div class="col-md-12">
            <div class="form-group">
                <h6><b style="color:#777">Carga<b style="color:#B61A1A">(*)</b>:</b> </h6>
                <select name="id_carga_existente" class="form-control buscador_clientes form_existe" style="width:100%">
                    <option value="" selected disabled> ✔ Seleccionar una Carga Existente</option>
                    @foreach ($proyectos as $proyecto)
                        <option value="{{ $proyecto->id }}">Cod.{{ $proyecto->tipo }} || Nombre:
                            {{ $proyecto->marca }} || Etapa: {{ $proyecto->volumen }} || Departamento:
                            {{ $proyecto->departamento }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>


{{-- <script>
    //SCRIPT PARA PROVINCIAS
    $(document).ready(function() {
        $('#departamento').on('change', function() {
            var id_departamento = $(this).val();
            if ($.trim(id_departamento) != '') {
                $.get('../provincias', {
                    id_departamento: id_departamento
                }, function(provincias) {
                    $('#provincia').empty();
                    $('#distrito').empty();
                    $('#provincia').append(
                        "<option value=''> ✔ Selecciona una provincia</option>");
                    $('#distrito').append(
                        "<option value=''> ⌛ Selecciona una provincia</option>");
                    $.each(provincias, function(index, value) {
                        $('#provincia').append("<option value='" + index + "'>" +
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

        $('#provincia').on('change', function() {
            console.log("xd");
            var id_provincia = $(this).val();
            if ($.trim(id_provincia) != '') {
                $.get('../distritos', {
                    id_provincia: id_provincia
                }, function(distritos) {
                    $('#distrito').empty();
                    $('#distrito').append(
                        "<option value=''> ✔ Selecciona un distrito</option>");
                    $.each(distritos, function(index, value) {
                        $('#distrito').append("<option value='" + index + "'>" + value +
                            "</option>");
                    })
                });
            }
        });
    });
</script> --}}

<script>
    function validar_tipo() {

        var tipo = document.getElementById('tipo').value;

        if ($.trim(tipo) != '') {
            $.get('../consulta_proyectos', {
                tipo: tipo
            }, function(proyectos_data) {

                $.each(proyectos_data, function(index, value) {
                    $('#valida_tipo').css("color", "#be1e37");
                    $('#valida_tipo').val("Proyecto existente: " + value);

                })

            }).fail(function() {
                $('#valida_tipo').css("color", "#35993A");
                $('#valida_tipo').val("Este Proyecto no se encuentra registrado");

            }).then(function(data) {
                console.log(data);

            });
        }

    }
</script>
{{-- <script>
    $(document).ready(function() {
        $('.buscador_departamento').select2();
        $('.buscador_provincia').select2();
        $('.buscador_distrito').select2();
    });
</script> --}}

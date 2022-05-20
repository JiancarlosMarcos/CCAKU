<div class="col-md-12">
    <div class="form-group">
    <h6><b style="color:#777">Lista de Cargas<b style="color:#B61A1A">(*)</b>:</b></h6>
        @foreach($data_carga as $carga_id)

        <select class="form-control buscador_cargas required_cliente_existente hidden"
            onchange="valida_nueva_busqueda();" id="buscador_carga" name="carga[]" style="width:100%">
            <option value="" disabled selected>Busca otra carga existente</option>
            @foreach($cargas as $carga)
            <option value="{{ $carga->id }}" {{($carga->id==$carga_id) ? 'selected':''}}>Tipo: {{ $carga->tipo }} ||
                Marca: {{ $carga->marca }} || Modelo: {{ $carga->modelo }}</option>
            @endforeach

        </select>
        @endforeach
    </div>
</div>


<div class="col-md-12">
    <div class="form-group">
        <table class="table bordered" style="background:#fff" id="tablaCargas">
            <tr>
                <td>ID</td>
                <td>TIPO</td>
                <td>MARCA</td>
                <td>MODELO</td>
               <!-- <td>ELIMINAR</td>-->
            </tr>
            <?php $c=1; ?>
            @foreach($data_carga as $carga_id)
            @foreach($cargas as $carga)
            @if($carga->id==$carga_id)
            <tr id="row_carga<?php echo $c; ?>" class="cargas">
                <td>
                    <input type="text" name="carga_id[]" value="{{ $carga->id }}" title="id" class="form-control"
                        style="background:#77777710" readonly>
                </td>
                <td>
                    <input type="text" name="carga_tipo[]" value="{{ $carga->tipo }}" title="tipo" class="form-control"
                        style="background:#77777710" readonly>
                </td>
                <td>
                    <input type="text" name="carga_marca[]" value="{{ $carga->marca }}" title="marca" class="form-control"
                        style="background:#77777710" readonly>
                </td>
                <td>
                    <input type="text" name="carga_modelo[]" value="{{ $carga->modelo }}" title="modelo" class="form-control"
                        style="background:#77777710" readonly>
                </td>
                <!--<td style="text-align:center">
                    <button type="button" id="<?php //echo $c; ?>" class="btn btn-danger btn_remove_carga">X</button>
                </td>-->

            </tr>
            @endif
            @endforeach
            <?php $c++; ?>
            @endforeach
        </table>
    </div>
</div>

<!--<div class="col-md-3">
    <div class="form-group">
        <a class="btn btn-primary" name="add_carga" id="add_carga" style="margin-rigth:auto;width:250px;font-weight:700;
                        font-size:14px;background:#ECDCC2;border-color:#777">
            ++ Agregar Carga Existente</a>
    </div>
</div>

<div class="col-md-3">
    <div class="form-group">
        <a class="btn btn-primary" name="add_carga_nueva" id="add_carga_nueva" style="margin-rigth:auto;width:250px;font-weight:700;
                        font-size:14px;background:#ECDCC2;border-color:#777">
            ++ Agregar Carga Nueva </a>
    </div>
</div>-->

@push('child-scripts')
<script>
function valida_nueva_busqueda() {
    $('#buscador_carga').value('');
}
</script>

<script>
    var j = $('.cargas').length+1;
$(document).ready(function() {
    

    $('#add_carga_nueva').click(function() {

        $('#tablaCargas').append(

            '<tr id="row_carga' + j + '" class="cargas">' +

            '<td>' +
            '<input type="text" name="carga_id[]" ' +
            'title="id" class="form-control" style="background:#77777710" >' +
            '</td>' +

            '<td>' +
            '<input type="text" name="carga_tipo[]" ' +
            'title="tipo" class="form-control" style="background:#77777710" >' +
            '</td>' +

            '<td>' +
            '<input type="text"  name="carga_marca[]" ' +
            'class="form-control" style="background:#77777710" autocomplete="off" >' +
            '</td>' +

            '<td>' +
            '<input type="text" name="carga_modelo[]" ' +
            'class="form-control" style="background:#77777710" >' +
            '</td>' +


            '<td style="text-align:center">' +
            '<button type="button" id="carga' + j +
            '" class="btn btn-danger btn_remove_carga">X</button>' +
            '</td>' +
            '</tr>'
        );
        j++;
        //document.getElementById("contador_t").value++;
    });
    $(document).on('click', '.btn_remove_carga', function() {
        if (!confirm("¿Estas seguro de eliminar esta carga?")) return;

        var id = $(this).attr('id');
        $('#row_' + id).remove();
       // document.getElementById("contador_t").value--;

    });
   

})
</script>

<script>
$(document).ready(function() {


    $('#add_carga').click(function() {

        $('#tablaCargas').append(

            '<tr id="row_carga' + j + '" class="cargas">' +

            '<td>' +
            '<select id="select_carga_nueva'+j+'" class="form-control select_carga_nueva" style="background:#77777710" onchange="valida_select_carga('+j+')" required>'+
            '<option value="" selected disabled>Seleccionar una Carga Existente</option>'+
            @foreach($cargas as $carga)
            '<option value="{{ $carga->id.'__'.$carga->tipo.'__'.$carga->marca.'__'.$carga->modelo }}">Tipo: {{ $carga->tipo }} || Marca: {{ $carga->marca }} || Modelo: {{ $carga->modelo }}</option>'+
            @endforeach
            '</select>'+
            '<input type="text" name="id[]" id="id'+j+'" ' +
            'title="id" class="form-control carga_existente'+j+' hidden" style="background:#77777710" >' +
            '</td>' +

            '<td>' +
            '<input type="text" name="tipo[]" id="tipo'+j+'" ' +
            'title="tipo" class="form-control carga_existente'+j+' hidden" style="background:#77777710" >' +
            '</td>' +

            '<td>' +
            '<input type="text"  name="marca[]" id="marca'+j+'" ' +
            'class="form-control carga_existente'+j+' hidden" style="background:#77777710" autocomplete="off" >' +
            '</td>' +

            '<td>' +
            '<input type="text" name="modelo[]" id="modelo'+j+'" ' +
            'class="form-control carga_existente'+j+' hidden" style="background:#77777710" >' +
            '</td>' +


            '<td style="text-align:center">' +
            '<button type="button" id="carga' + j +
            '" class="btn btn-danger btn_remove_carga">X</button>' +
            '</td>' +
            '</tr>'
        );
        j++;
        //document.getElementById("contador_t").value++;
    });



})
</script>
<script>
function valida_select_carga(index){
$('#select_carga_nueva'+index).prop("required",false);
$('#select_carga_nueva'+index).addClass("hidden");
$('.carga_existente'+index).removeClass("hidden");
var data = $('#select_carga_nueva'+index).val();
const dataArray = data.split("__");
$('#id'+index).val(dataArray[0]);
$('#tipo'+index).val(dataArray[1]);
$('#marca'+index).val(dataArray[2]);
$('#modelo'+index).val(dataArray[3]);


}
</script>
<script>
function mensaje(){
    console.log("test2");
}
</script>
@endpush


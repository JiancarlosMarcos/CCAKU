<script>

function mostrar_vista(id,version){
 $('#mostrarHistorial').append(
 '<div class="modal fade" id="showModal'+id+'" tabindex="-1" role="dialog" aria-hidden="true">'+
 '<div class="modal-dialog modal-dialog-centered" role="document" style="max-width:1450px">'+
   '<div class="modal-content">'+
    '<div class="modal-header">'+
       '<h5 class="modal-title" id="exampleModalCenterTitle">Historial de Cotizaciones</h5>'+
      ' <button type="button" class="close" data-dismiss="modal" aria-label="Close">'+
         '<span aria-hidden="true">&times;</span>'+
       '</button>'+
    '</div>'+
     '<div class="modal-body">'+
       '<div class="tile">'+
          '<div class="tile-body">'+
           '<form>'+
                   '<div class="form-group">'+
                    
                   '<input type="text" class="form-control" value="Registro Nro. '+id+'" style="width:50%" readonly>'+
                   '<input type="text" class="form-control" value="Ultima version: '+version+'" style="width:50%" readonly><br>'+
                   
                   '<table id="tablaHistorialPDFCotizaciones'+id+'" style="font-size:12px" class="table-hover">'+
                   '<thead style="background:#777;color:#fff;font-weigth:600">'+
                   '<tr>'+
                   '<td class="no-sort" style="width:7%;text-align:center">Version</td>'+
                   '<td class="no-sort" style="width:7%">Descargar</td>'+
                   '<td class="no-sort" style="width:79%;text-align:center">Nombre de Cotizacion</td>'+
                   '<td class="no-sort" style="width:7%;text-align:center">Fecha</td>'+
                   '</tr></thead>'+   
                   '<tbody></tbody>'+         
                   '</table>'+

                   '</div>'+
                   '<div class="tile-footer">'+
                     
              '</form>'+
              '</div></div></div></div></div></div></div>'
         );   

        document.getElementById("mostrar"+id).click();
        tablaHistorial(id);
        



}             
</script>

<script>
var contador='0';
function tablaHistorial(id){

var tablehistorial = $('#tablaHistorialPDFCotizaciones'+id).DataTable({
      destroy:true,
      serverSider: true,
     
      ajax: {
        url:'{!! route('lista_historial_cotizaciones') !!}',
        type: "GET",
        data:{"id": id}
    
      },
      columns: [
        {data: 'version'},
        {data: 'btn_descargar'},
        {data: 'nombre_cotizacion'},
        {data: 'created_at'},
      
      ],
      "columnDefs": [
        {
           "render": function ( data, type, row ) {
                return '<center>'+row["version"]+'</center>';
            },
            "targets": 0
        },
        {
           "render": function ( data, type, row ) {

        var url = '{{ route('cotizacion.cliente.descargar', ['id' => 'valorIdTemp','version' => 'valorIdTemp2']) }}';
        url = url.replace('valorIdTemp', id);
        url = url.replace('valorIdTemp2', row["version"]);

                return '<a href="'+url+'" class="btn" style="background:#123;color:#fff"><i class="fa fa-download"></i></a>';
            },
            "targets": 1
        },
        {
           "render": function ( data, type, row ) {
                return '<center>'+row["created_at"]+'</center>';
            },
            "targets": 3
        },

      ],

      order: [ [0, 'desc'] ],
     
      "pageLength": 10,
      "lengthMenu": [10, 50],
      "language":{
        "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
      },

    });

    contador++;
  }

</script>
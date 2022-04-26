@extends('adminlte::page')
@section('content')
@section("titulo", "Agregar Clientes")
<br>
<br>
      <div class="app-title">
        <div>
    <a href="{{route('clientes')}}" class="btn btn-primary" style="color:#777;background:#fff;border-color:#777">Transportistas</a>
    <a  class="btn btn-primary " style="color:#777;background:#fff;border-color:#777">Contactos de Transportistas</a> 
    <a  class="btn btn-primary " style="background:#777;border-color:#777">Transporte</a> 
    {{-- <a href="{{route('proveedores.contactos.mostrar')}}" class="btn btn-primary " style="color:#777;background:#fff;border-color:#777">Contactos de Proveedores</a>  --}}
    {{-- <a href="{{route('grupo_mdn.mostrar')}}" class="btn btn-primary " style="background:#fff;border-color:#777;color:#777">Grupo MDN</a> --}}
  
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a >Transportes</a></li>
          <li class="breadcrumb-item"><a href=""> Transporte Nuevo</a></li>
        </ul>
      </div>
      <!---->
   <form method="POST" action="{{route('agregar_vehiculo')}}">
   @csrf 
   @include("notificacion")
      <div class="form-card" style="color:#000"><h4>Datos del Transporte</h4>
      
      <div class="row">
        
       {{-- <div class="col-md-3">
         <div class="form-group">
  
         <label class="control-label" style="font-weight:600;color:#777">RUC O DNI: <a style="color:#B61A1A">*
          @error('dni_ruc')
         <span class="text-danger">{{ $message }}</span>
           @enderror
          </a></label>
         <input class="form-control" name="dni_ruc" type="number" value="{{old('dni_ruc')}}"
          autocomplete ="off" id="dni_ruc" onkeyup="validar_cliente()" 
          placeholder="RUC O DNI" required pattern="[0-9]" />
          <input type="text" value="" class="alerta_1" id="valida_dni_ruc_1" 
        style="font-size:14px;background:transparent;border:0px solid transparent;width:400px;color:#be1e37;margin-top:-50px" 
        disabled>

         </div>
        </div> --}}

        <div class="col-md-3">
         <div class="form-group">
         <label class="control-label" style="font-weight:600;color:#777">EMPRESA: <a style="color:#B61A1A">*</a></label>
         <input class="form-control" name="razon_social" type="text" value="{{old('razon_social')}}"
          autocomplete ="off"
          placeholder="Nombre de la empresa" required  />
         </div>
        </div>

        <div class="col-md-3">
         <div class="form-group">
         <label class="control-label" style="font-weight:600;color:#777">TIPO: <a style="color:#B61A1A"></a></label>
          <select class="form-control" name="tipo" type="text" value="{{old('tipo')}}"
          autocomplete ="off">
            <option value="" selected >--Seleccion el tipo--</option>
             <option value="Tracto">Tracto</option>
             <option value="Camabaja">Camabaja</option>
             <option value="Camion Plataforma">Camion Plataforma</option>
            </select>
         </div>
         
        </div>

        <div class="col-md-3">
         <div class="form-group">
         <label class="control-label" style="font-weight:600;color:#777">MARCA: <a style="color:#B61A1A"></a></label>
         <input class="form-control" name="marca" type="text" value="{{old('marca')}}"
          autocomplete ="off"
          placeholder="Marca" />
         </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
            <label class="control-label" style="font-weight:600;color:#777">MODELO: <a style="color:#B61A1A"></a></label>
            <input class="form-control" name="modelo" type="text" value="{{old('modelo')}}"
             autocomplete ="off"
             placeholder="Modelo" />
            </div>
           </div>

           <div class="col-md-3">
            <div class="form-group">
            <label class="control-label" style="font-weight:600;color:#777">PLACA: <a style="color:#B61A1A"></a></label>
            <input class="form-control" name="placa" type="text" value="{{old('placa')}}"
             autocomplete ="off"
             placeholder="Placa" />
            </div>
           </div>

           <div class="col-md-3">
            <div class="form-group">
            <label class="control-label" style="font-weight:600;color:#777">VOLUMEN: <a style="color:#B61A1A"></a></label>
            <input class="form-control" name="volumen" type="text" value="{{old('volumen')}}"
             autocomplete ="off"
             placeholder="Volumen" />
            </div>
           </div>

           <div class="col-md-3">
            <div class="form-group">
            <label class="control-label" style="font-weight:600;color:#777">LARGO: <a style="color:#B61A1A"></a></label>
            <input class="form-control" name="largo" type="text" value="{{old('largo')}}"
             autocomplete ="off"
             placeholder="Largo" />
            </div>
           </div>

           <div class="col-md-3">
            <div class="form-group">
            <label class="control-label" style="font-weight:600;color:#777">ANCHO: <a style="color:#B61A1A"></a></label>
            <input class="form-control" name="ancho" type="text" value="{{old('ancho')}}"
             autocomplete ="off"
             placeholder="Ancho" />
            </div>
           </div>


       

       </div>
    </div>

       {{-- <!----><br>
       <h4>Datos de Contacto</h4>
      <div class="row">
         
          <!--OCULTO-->
            <input class="form-control" name="contador" id="contador" type="hidden"
            value="0" autocomplete ="off" />
            <input class="form-control" name="usuario" id="usuario" type="hidden" value="{{auth()->user()->Nombres}}"
            autocomplete ="off" />
          <!---->
      </div> --}}
     
       
{{-- 
   
        <table class="table table-bordered" id="dynamic_field" style="border: 1px solid #123;background:#fff">

    <thead>
    <tr>
    <td>Nombres</td><td>Dni</td> <td>Celular</td> <td>Cargo</td> <td>Correo</td>  <td style="text-align:center">Eliminar</td>
    </tr>
    </thead>
    </table> --}}

    {{-- <div class="col-md-3">
         <div class="form-group">
            <a class="btn btn-primary" name="add" id="add" 
            style="margin-rigth:auto;width:180px;font-weight:700;
            font-size:14px;background:#ECDCC2;border-color:#777">
            ++ Agregar Contacto </a>
         </div>
        </div> --}}

    <div class="col-md-12" style="text-align:center">
         <div class="form-group">
<button class="btn btn-primary" type="Submit"> <i class="fa fa-plus-square"></i>Registrar </button>
</div>
        </div>
        </div>
</form>
        {{-- <script>

    $(document).ready(function(){
        var i = 1;

        $('#add').click(function () {
           
            $('#dynamic_field').append(
           
            '<tr id="row'+i+'" class="contactos">' +

            '<td>'+
             '<input type="text" name="nombre_contacto[]" id="nombre_contacto'+i+'" '+
             'autocomplete="off" class="form-control" style="background:#77777710" >'+
            '</td>'+

            '<td>'+
             '<input type="text"  name="dni[]" '+
             'autocomplete="off" class="form-control" style="background:#77777710" >'+
            '</td>'+

            '<td>'+
             '<input type="text"  name="celular[]" '+
             'autocomplete="off" class="form-control" style="background:#77777710" >'+
            '</td>'+


            '<td>'+
             '<input type="text" name="cargo[]" '+
             'autocomplete="off" class="form-control" style="background:#77777710" >'+
            '</td>'+

            '<td>'+
             '<input type="text" name="correo[]" '+
             'autocomplete="off" class="form-control" style="background:#77777710" >'+
            '</td>'+

            '<td style="text-align:center">'+
            '<button type="button" id="'+i+'" class="btn btn-danger btn_remove">X</button>'+
            '</td>' +
            '</tr>'
            );   
            i++;
            //PasarValores();
            //LimpiarForm();
            document.getElementById("contador").value++;
                                  
        });
        
       $(document).on('click', '.btn_remove', function () {
        if (!confirm("¿Estas seguro de eliminar este contacto?")) return;

            var id = $(this).attr('id');
           $('#row'+ id).remove();
           document.getElementById("contador").value--;
           
        });

    }) --}}
</script>
<script>
function LimpiarForm(){

    document.getElementById("nombre_registrador").value="";
    document.getElementById("celular_registrador").value="";
    document.getElementById("cargo_registrador").value="";
    document.getElementById("correo_registrador").value="";
}
</script>
<script>
function PasarValores(){

    var cont = $(".contactos").length;

    var nombre_contacto = document.getElementsByName("nombre_contacto[]");
    var dni = document.getElementsByName("dni[]");
    var celular = document.getElementsByName("celular[]");
    var cargo = document.getElementsByName("cargo[]");
    var correo = document.getElementsByName("correo[]");

    
    nombre_contacto[cont-1].value = document.getElementById("nombre_registrador").value;
    celular[cont-1].value = document.getElementById("celular_registrador").value;
    cargo[cont-1].value = document.getElementById("cargo_registrador").value;
    correo[cont-1].value = document.getElementById("correo_registrador").value;

    
}

</script>

<script>
function validar_cliente(){

var dni_ruc = document.getElementById('dni_ruc').value;

if($.trim(dni_ruc) != ''){
  $.get('../consulta_empresas', {dni_ruc:dni_ruc}, function(empresas){

    var data_nombre_empresa = empresas["nombre_empresa"];
    var data_dni_ruc_empresa = empresas["dni_ruc_empresa"];
 

  $.each(empresas, function(index,value){
  $('#valida_dni_ruc_1').css("color","#be1e37");
  $('#valida_dni_ruc_1').val(empresas["indicador_empresa"]+" existente");

    })
 
 }).fail( function() {
    
     $('#valida_dni_ruc_1').css("color","#35993A");
     $('#valida_dni_ruc_1').val("Este DNI o RUC no se encuentra registrado");

 }).then(function(data){
    // console.log(data);
    // console.log("--__"+data[0]);
 });
}
}
  </script>
@endsection






@section('css')
       <!-- SELECT 2 JS CSS-->
       <script src="{{asset('js2/jquery/jquery.min.js')}}"></script>
       <!-- NUEVO JQUERY-->

      <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
      <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

      <!-- Main CSS-->
      <link rel="stylesheet" type="text/css" href="{{asset('css2/main.css')}}">

      <link rel="stylesheet" href="{{asset('css2/product.css')}}">
      <!-- Font-icon css-->
      <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <!--  extension responsive  -->
    
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">

    <style>
      .bg-principal{
        background:#222d32;
        color:#fff;
      }
    </style>
    <style>
    input[type=number]::-webkit-inner-spin-button, 
    input[type=number]::-webkit-outer-spin-button { 
    -webkit-appearance: none; 
    margin: 0; 
    }
    input[type=number] { -moz-appearance:textfield; }
    </style>

@stop
@section('js')
<!-- Essential javascripts for application to work-->
    <!--<script src="{{asset('backend/js/jquery-3.3.1.min.js')}}"></script>-->
    <script src="{{asset('js2/popper.min.js')}}"></script>
    <script src="{{asset('js2/bootstrap.min.js')}}"></script>
    <script src="{{asset('js2/main.js')}}"></script>

    <script src="{{asset('js2/product.js')}}"></script>

    <script type="text/javascript" src="{{asset('js2/plugins/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js2/plugins/dataTables.bootstrap.min.js')}}"></script>





    <script src="https://kit.fontawesome.com/102c277d5c.js" crossorigin="anonymous"></script>
    <!-- extension responsive -->
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.2.2/js/dataTables.fixedHeader.min.js"></script> 

    <!-- The javascript plugin to display page loading on top-->
    <script src="{{asset('js2/plugins/pace.min.js')}}"></script>
    <!-- Page specific javascripts-->
    <script type="text/javascript" src="{{asset('js2/plugins/chart.js')}}"></script>
    <script type="text/javascript">
    
    </script>



     <script type="text/javascript" src="{{asset('js2/plugins/sweetalert.min.js')}}"></script>

    <script>
   

        //SweetAlert2 Para eliminar
        $(function(){
          $(document).on('click','#delete',function(e){
          e.preventDefault();
          var link = $(this).attr("href");
            swal({
              title: "Estas Seguro?",
              text: "Una vez eliminado, no podrás recuperarlo",
              type: "warning",
              showCancelButton: true,
              confirmButtonText: "Sí, Eliminarlo",
              cancelButtonText: "No, Cancelarlo",
              closeOnConfirm: false,
              closeOnCancel: false
            }, function(isConfirm) {
              if (isConfirm) {
                window.location.href = link
              
              } else {
                swal("Cancelado","", "error");
              }
            });
          });
        });
         
    </script>
@stop



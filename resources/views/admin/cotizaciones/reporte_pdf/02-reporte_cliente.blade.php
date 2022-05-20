<div style="margin-top:10px;text-align:right;">
<b><i>{{$fecha_cotizacion}}</i></b>
    <table style="border:1px solid #000;text-align:center;width:100%" id="tabla_cliente">
    <tr style="font-size:12px">
        @if($cliente_tipo=='Empresa')
        <td style="width:15%;height:64px"><b>SEÑORES</b></td>
        <td style="font-size:10.5px">{{$empresa_nombre}}</td>
        <td style="width:15%"><b>COT.</b></td>
        <td >00{{$numero_cotizacion}}-v{{$version_cotizacion}}</td>

        @else
        <td style="width:15%;height:64px"><b>COT.</b></td>
        <td >00{{$numero_cotizacion}}-v{{$version_cotizacion}}</td>
        <td style="border:1px">-</td>
        <td style="border:1px">-</td>
        @endif


    </tr>
<?php
    $descripcion='';
    
    if($cliente_tipo=='Empresa')
        $descripcion='RUC';
        else
        $descripcion='DNI';

?>
    @if($descripcion=='RUC')
    <tr style="font-size:12px">
        @if($dni_ruc=='0')
        <td><b>CELULAR</b></td>
        <td>{{$cliente_celular}}</td>
        <td style="border:1px">-</td>
        <td style="border:1px">-</td>
        @else
        <td><b>{{$descripcion}}</b></td>
        <td>{{$dni_ruc}}</td>
        <td><b>CELULAR</b></td>
        <td>{{$cliente_celular}}</td>
        @endif
    </tr>
    @endif
    @if($descripcion=='DNI')
    <tr style="font-size:12px">
        @if($dni_ruc=='0')
        <td><b>CELULAR</b></td>
        <td>{{$cliente_celular}}</td>
        <td style="border:1px">-</td>
        <td style="border:1px">-</td>
        @else
        <td><b>{{$descripcion}}</b></td>
        <td>{{$dni_ruc}}</td>
        <td><b>CELULAR</b></td>
        <td>{{$cliente_celular}}</td>
        @endif
    </tr>
    @endif

    <tr style="font-size:12px">
        <td style="height:64px"><b>ATENCIÓN</b></td>
        <td style="font-size:10.5px">{{$cliente_nombre}}</td>
        <td><b>CORREO</b></td>
        <td>{{$cliente_correo}}</td>
    </tr>
  

    </table>
    <br>
    </div>
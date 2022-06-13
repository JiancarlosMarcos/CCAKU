<div style="page-break-inside: avoid;">
Mediante la presente cotización referencial nos dirigirnos a Ud. Para saludarlo muy cordialmente, a la vez hacerles llegar nuestra cotización para el servicio de transporte que a continuación detallamos:
<br>
<h7 style="margin-bottom:0px"><b><u>ORIGEN:</u></b></h7><br>
{{$informacion_origen}}
<br>
<h7 style="margin-bottom:0px;margin-top:4px"><b><u>DESTINO:</u></b></h7><br>
{{$informacion_destino}}
<br>
<br>
 
    <table class="tabla_equipos" style="width:100%;">
    <tr style="border:1px solid #000">
        <td style="background:#D1CDCD;font-weight:700;border:1px solid #000">CARGA(S)</td>
        <td style="background:#D1CDCD;font-weight:700;border:1px solid #000">TRANSPORTE(S)</td>
        <td style="background:#D1CDCD;font-weight:700;border:1px solid #000;text-align:center">MONTO TOTAL(SIN IGV)</td>
    </tr>
    <tr>
        <td style="border:1px solid #000;padding-bottom:0px;margin-bottom:0px">
        <table class="descripcion_equipos">
        <tr>
            <td>
                @foreach($data_cargas as $data_carga)
                - {{$data_carga}}<br>
                @endforeach
            </td>
        </tr>
        </table>
        </td>

        <td style="border:1px solid #000;padding-bottom:0px;margin-bottom:0px">
        <table class="descripcion_equipos">
        <tr>
            <td>
                @foreach($data_transportes as $data_transporte)
                - {{$data_transporte}}<br>
                @endforeach
            </td>
        </tr>
        </table>
        </td>

        <td style="border:1px solid #000;padding-bottom:0px;margin-bottom:0px">
        <table class="descripcion_equipos">
        <tr style="text-align:center">
            <td style="text-align:center"> {{($moneda=='Soles') ? "S/.":"$."}} {{number_format($monto_total,2)}} + IGV
            <br>
            </td>
        </tr>
        </table>
        </td>
        
        
    </tr>
    </table>  
    </div>
    <br>

    <div style="width:90%;margin-left:auto;margin-right:auto;page-break-inside: avoid">
<b><u>FORMA DE PAGO:</u></b><br>
{{$forma_pago}}
</div>
<br>


<div style="width:90%;margin-left:auto;margin-right:auto;page-break-inside: avoid">
<b><u>NOTAS:</u></b><br>
- El monto total del servicio no incluye IGV.<br>

<?php
$descripcion_convertida = str_replace("-","•",$descripcion);
$descripcion_nueva = explode("•", $descripcion_convertida);
$contador_descripcion = count($descripcion_nueva);

for($z=1;$z<$contador_descripcion;$z++){
    if($z==1){
        echo "- ".$descripcion_nueva[$z]."<br>";
    }else{
        echo "• ".$descripcion_nueva[$z]."<br>";
    }
}
?>
</div>
<br>

<div style="page-break-inside: avoid">
<br>
--
Atentamente,
<br><br>
{{$nombre_asesor}}<br>
<u>{{$correo_asesor}}</u><br>
<b>{{$cargo_asesor}}</b><br>
</div>

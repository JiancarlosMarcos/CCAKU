<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COT. Nro.{{$numero_cotizacion}}-v{{$version_cotizacion}} </title>
  <link rel="stylesheet" href="css/style-report.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <style>
        @page {
            margin: 0cm 0cm;
            font-family: Arial;
        }

        body {
            margin: 3cm 2cm 1.2cm;
            font-size:13.5px;
      

        }

        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            background-color: transparent;
            color: white;
            text-align: center;
            line-height: 30px;
        }

        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 1.2cm;
            background-color: transparent;
            color: white;
            text-align: center;
            line-height: 0px;
          
        }
        .tabla_cliente{
            border:1px solid #000;
        }
        #tabla_cliente td{
            border:1px solid #000;
        }
        .descripcion_equipos tr{
            font-size:12px;
        }
        .descripcion_equipos td{
            padding-left:5px;
        }
 
   

        #tabla_tarifas thead tr{
            padding-left:5px;
            background:#a5a5a5;
        }

        .tabla_equipos{
            margin-left:auto;
            margin-right:auto;
        }

        .oscuro-tabla{
            padding-left:5px;
            background:#a5a5a580;
        }
    
        .claro-tabla{
            padding-left:5px;
            background:#00000010;
        }
        .hidden{
            display:none;
        }
        .hidden-2{
            visibility:hidden !important;
        }
    </style>
</head>
<body>
<header>
    <img src="image/reporte_pdf/header-reporte-cotizaciones.png" style="width:800px;height:117px">

</header>


<footer>
<img src="image/reporte_pdf/footer-reporte-cotizaciones.png" style="width:800px;height:45px;margin-top:0px">

</footer>

<main>

@include('admin/cotizaciones/reporte_pdf/02-reporte_cliente')
@include('admin/cotizaciones/reporte_pdf/03-reporte_detalle')


</main>
</body>
</html>
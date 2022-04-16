<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cliente')->insert([
            [

                "id_tipo" => 1,
                "dni_ruc" => "20538452409",
                "nombre" => "GRUPO ACHIRANA  INGENIEROS  CONTRATISTAS  GENERALES S.A.C.",
                "direccion" => "CAL.JOSE MARIA MORELOS NRO. 249 DPTO. 401 URB. MARANGA ET. SEIS LIMA - LIMA - SAN MIGUEL",
                "pagina_web" => "https=>\/\/www.grupoachirana.com.pe\/",
                "razon_social" => null
            ],
            [

                "id_tipo" => 2,
                "dni_ruc" => "40477567",
                "nombre" => "ALEX ALBERTO CORTEZ CHAVEZ",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20608196936",
                "nombre" => "CONSTRUCTORA  CONSULTORA Y PROYECTOS  AS S.A.C.",
                "direccion" => "JR. LAS LILAS MZA. Q1 LOTE. 03 A.H. ANCIETA ALTA 1RA ETAPA LIMA - LIMA - EL AGUSTINO",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20602627005",
                "nombre" => "CONSORCIO SAN CAMILO",
                "direccion" => "AV. EL DERBY NRO. 254 DPTO. 1602 URB. EL DERBY DE MONTERRICO LIMA - LIMA - SANTIAGO DE SURCO",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20544263642",
                "nombre" => "ODEBRECHT PERU OPERACIONESY SERVICIOS S.A.C.",
                "direccion" => "AV. VICTOR ANDRES BELAUNDE 280 INT. 502 LIMA LIMA SAN ISIDRO",
                "pagina_web" => "https=>\/\/www.oec-eng.com\/es",
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20600059735",
                "nombre" => "GEMIN ASSOCIATES S.A.C.",
                "direccion" => "AV. EL DERBY 055 INT. 301 CENTRODE NEGOCIOS CRONOS TORRE 1LIMA-LIMA-SANTIAGO DE SURCO",
                "pagina_web" => "http=>\/\/www.geminassociates.com\/",
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20546121250",
                "nombre" => "STRACON S.A.",
                "direccion" => "AV. RIVERA NAVARRETE 762 DPTO.501 LIMA-LIMA-SAN ISIDRO",
                "pagina_web" => "http=>\/\/www.stracon.com\/inicio",
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20471254305",
                "nombre" => "BOUBY S.A.C.",
                "direccion" => "AV. LA MAR 267 COO. DE VIV. 27 DEABRIL A UNA CDRA DEL OVALOSTA ANITA LIMA-LIMA-ATE",
                "pagina_web" => "https=>\/\/boubysac.com\/",
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20508891149",
                "nombre" => "JRC INGENIERÍA Y CONSTRUCCIÓN S.A.C.",
                "direccion" => "AV. GENERAL TRINIDAD MORAN NRO. 1340 URB. RISSO LIMA - LIMA - LINCE",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20601979587",
                "nombre" => "GRUPO MUNDO MAQ JFR S.A.C.",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "10428925322",
                "nombre" => "Julio Cesar Quispe Diaz",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20509859541",
                "nombre" => "V & J Ingeniería y Construcción",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null,
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20601237840",
                "nombre" => "TAC GYC S.A.C",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20417063928",
                "nombre" => "JUSAN SERVICIOS DE LA CONSTRUCCION S.A.C",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "10413684256",
                "nombre" => "CONCEPCION ARIAS KARIN JUNET",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20546240852",
                "nombre" => "EMP. SUVAR S.A.C.",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "10430972648",
                "nombre" => "CAMILO ENRIQUE FLORES BENAVIDES",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20608772970",
                "nombre" => "CONSORCIO CUMARIA",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20392504894",
                "nombre" => "MIRANDA CONSTRUCTORES S.A.",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20601214831",
                "nombre" => "TREMACH GROUP S.A.C.",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20503180449",
                "nombre" => "PEVOEX CONTRATISTAS S.A.C.",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20601517796",
                "nombre" => "EMERSON HT COMPANY E.I.R.L.",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20605252401",
                "nombre" => "CONCRETOS ECOLÓGICOS F'C PERÚ SAC",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20523320522",
                "nombre" => "CORPORACION ARIS S.A.C.",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 2,
                "dni_ruc" => "0",
                "nombre" => "CONSORCIO INTI PUNKU",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20533615521",
                "nombre" => "CONTRATISTAS MINERO LIBRA S.A.C.",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20601193087",
                "nombre" => "GRUPO KSAR S.A.C.",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20393625890",
                "nombre" => "JVJ SERVICE ORIENTE S.A.C.",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20551270778",
                "nombre" => "SIENERG S.A.C.",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20131377224",
                "nombre" => "MUNICIPALIDAD DISTRITAL DE MIRAFLORES",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20527402078",
                "nombre" => "INGENIERIA EN LA CONSTRUCCION S.R.L.",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20603384149",
                "nombre" => "CONSORCIO MEFRED HUABAL",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20560099496",
                "nombre" => "STEEL ASESORIA E.I.R.L.",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20516385813",
                "nombre" => "ECOSERMY",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20600307232",
                "nombre" => "M & C DEPROINCO S.A.C.",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "10473557431",
                "nombre" => "RUIZ VERA OMAR SAMUEL",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20607107808",
                "nombre" => "CERVECERIA BERNARDIUS S.A.C.",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20601323461",
                "nombre" => "INVYCONS E.I.R.L.",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20494744237",
                "nombre" => "ECOCIMET INGENIEROS CONSULTORES SOCIEDAD COMERCIAL DE RESPONSABILIDAD LIMITADA",
                "direccion" => "AV. EL PARQUE NRO. 610 C.P. LA TINGUIÑA ZN. B ICA - ICA - LA TINGUIÑA",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20600373863",
                "nombre" => "SBP S.A.C.",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20545316561",
                "nombre" => "TACTICAL IT S.A.C.",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20543916928",
                "nombre" => "RUIZ RODRIGUEZ Y COMPAÑIA S.A.C.",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20513250445",
                "nombre" => "INMAC PERÚ SAC",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20604521484",
                "nombre" => "CONSTRUCTORA Y MULTISERVICIOS CEFE’S S.A.C",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20349311608",
                "nombre" => "JJR DURAND SAC",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20407917104",
                "nombre" => "CORPORATION TEKNY & RAN EIRL",
                "direccion" => "CAL.1 MZA. C LOTE. 13 URB. SANTA MARIA DE CAMPOY (POR EL COLEGIO GONZALES PRADA) LIMA - LIMA - SAN JUAN DE LURIGANCHO",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20564174433",
                "nombre" => "GRUPO JYNSA SAC",
                "direccion" => "AV. DE LOS PATRIOTAS NRO. 342 URB. MARANGA ET. DOS (ENTRE ELMER FAUCETT Y AVENIDA LA MARINA) LIMA - LIMA - SAN MIGUEL",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20600977661",
                "nombre" => "CHINA RAILWAY TUNNEL GROUP CO., LTD SUCURSAL DEL PERU",
                "direccion" => "AV. ALFREDO BENAVIDES NRO. 768 INT. 401 URB. LEURO LIMA - LIMA - MIRAFLORES",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20603798075",
                "nombre" => "CHINA CAMC ENGINEERING CO., LTD. SUCURSAL PERU",
                "direccion" => "AV. JAVIER PRADO ESTE NRO. 560 INT. 2104 LIMA - LIMA - SAN ISIDRO",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20510675411",
                "nombre" => "NASAO CORPORATION SAC",
                "direccion" => "JR. LOS MOLINOS NRO. 790 URB. VILLACAMPA LIMA - LIMA - RIMAC",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20380289360",
                "nombre" => "MIXERCON S.A",
                "direccion" => "CAR.PANAMERICANA SUR KM.17.5 MZA. C LOTE. 4 ASOCIACION LA CONCORDIA (PARADERO LA CAPILLA KM 17.5 PAN-SUR) LIMA - LIMA - VILLA EL SALVADOR",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20254556654",
                "nombre" => "MDH-PD S.A.C.",
                "direccion" => "AV. MALECON CHECA NRO. 3677 LIMA - LIMA - SAN JUAN DE LURIGANCHO",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20605867414",
                "nombre" => "DMT FUXUAN S.A.C.",
                "direccion" => "CAL.MARISCAL RAMON CASTILLA NRO. 529 (FRENTE PLAZA TUPAC AMARU) LIMA - LIMA - MAGDALENA DEL MAR",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20518775783",
                "nombre" => "COMPAÑIA MINERA ARCO DE ORO S.A.C.",
                "direccion" => "CAL.LUIS ARIAS SCHREIBER NRO. 148 DPTO. 302 URB. PROLONGACION AURORA LIMA - LIMA - MIRAFLORES",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20467463684",
                "nombre" => "HLC S.A.C",
                "direccion" => "AV. MANUEL OLGUIN NRO. 335 INT. 1701 URB. MONTERRICO CHICO (ESPALDA DEL JOCKEY PLAZA) LIMA - LIMA - SANTIAGO DE SURCO",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20600146522",
                "nombre" => "OLMAQ E.I.R.L",
                "direccion" => "CAL.CALLE U MZA. 88 LOTE. 40 URB. TORRE BLANCA LIMA - LIMA - CARABAYLLO",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20100039207",
                "nombre" => "RANSA COMERCIAL S A",
                "direccion" => "AV. ARGENTINA NRO. 2833 Z.I. INDUSTRIAL PROV. CONST. DEL CALLAO - PROV. CONST. DEL CALLAO - CALLAO",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20603913753",
                "nombre" => "CONSORCIO AGUA SCM",
                "direccion" => "CAL.MAXIMILIANO CARRANZA NRO. 632 URB. SAN JUAN ZN. D (FRENTE ACADEMIA PITAGORAS) LIMA - LIMA - SAN JUAN DE MIRAFLORES",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20100348501",
                "nombre" => "ESTREMADOYRO Y FASSIOLI CONTRATISTAS GENERALES S.A.",
                "direccion" => "CAL.TOMAS RAMSEY NRO. 930 INT. 201 LIMA - LIMA - MAGDALENA DEL MAR",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20601116082",
                "nombre" => "CHINA RAILWAY N° 10 ENGINEERING GROUP CO., LTD SUCURSAL DEL PERU",
                "direccion" => "CAL.DEAN VALDIVIA NRO. 243 INT. 601 URB. JARDIN LIMA - LIMA - SAN ISIDRO",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20601235367",
                "nombre" => "JR RENTAL IMPORTACIONES",
                "direccion" => "AV. RICARDO RIVERA NAVARRETE NRO. 765 INT. 031 URB. JARDIN LIMA - LIMA - SAN ISIDRO",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20574717940",
                "nombre" => "DESA PERU CONTRATISTAS GENERALES S.A.C.",
                "direccion" => "JR. JOSE CARLOS MARIATEGUI NRO. 462 AYACUCHO - HUAMANGA - AYACUCHO",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "10097292871",
                "nombre" => "GIL SAUÑE EDGARD MICHEL",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20106740004",
                "nombre" => "VULCO PERU S.A.",
                "direccion" => "AV. SEPARADORA INDUSTRIAL NRO. 2201 URB. VULCANO LIMA - LIMA - ATE",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20601832390",
                "nombre" => "ALFA CO SOCIEDAD ANONIMA CERRADA",
                "direccion" => "CAL.MARIE CURIE NRO. 410 URB. INDUSTRIAL SANTA ROSA LIMA - LIMA - ATE",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20608677390",
                "nombre" => "SECOMBA S.A.C.",
                "direccion" => "MZA. F2 LOTE. 17 A.H. LA RINCONADA (A 2 CDRAS DE LA COMISARÍA) LIMA - LIMA - SAN JUAN DE MIRAFLORES",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20558716984",
                "nombre" => "CONSTRUCTORA PRAXIKAR SRL",
                "direccion" => "AV. INDEPENDENCIA NRO. 600 DPTO. D INT. 327 AREQUIPA - AREQUIPA - AREQUIPA",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20492109496",
                "nombre" => "M Y V COMEIMPRO SAC",
                "direccion" => "MZA. A1 LOTE. 4 ASC. III AMPLIACION DE LA ASOCIACION AGRUPACION AGROPECUARIA SUMAC PACHA (--) LIMA - LIMA - LURIN",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20519219922",
                "nombre" => "CONSTRUCTORA INARCO PERU S.A.C.",
                "direccion" => "AV. LA MOLINA NRO. 140 (OVALO SANTA ANITA) LIMA - LIMA - ATE",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20608585819",
                "nombre" => "INGECONCRETO S.A.C.",
                "direccion" => "JR. KENKO NRO. 239 LIMA - LIMA - SANTIAGO DE SURCO",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20523461347",
                "nombre" => "SUNRISE CUSTOMERS AND SALES SOCIEDAD ANONIMA CERRADA",
                "direccion" => "PZA.COMPOSICION NRO. 163 DPTO. 202 (EDIFICIO 25-A) LIMA - LIMA - SURQUILLO",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20523603664",
                "nombre" => "PRZ INGENIEROS S.A.C.",
                "direccion" => "AV. GUZMAN BLANCO NRO. 240 DPTO. 1101 (A 2 CDRAS DE PLAZA BOLOGNESI) LIMA - LIMA - LIMA",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20506285314",
                "nombre" => "COMPAÑIA MINERA MISKI MAYO S.R.L.",
                "direccion" => "CAL.DIONISIO DERTEANO NRO. 184 INT. 301 URB. SANTA ANA (EDIFICIO TORRE ICHMA) LIMA - LIMA - SAN ISIDRO",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20568511604",
                "nombre" => "CIKA INVERSIONES & NEGOCIACIONES E.I.R.L.",
                "direccion" => "CAL.CALLE 100 MZA. M4 LOTE. 4B A.H. SECTOR VIRGEN DEL CARMEN LIMA - LIMA - PACHACAMAC",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20126702737",
                "nombre" => "COMPAñIA MINERA CARAVELI S.A.C.",
                "direccion" => "AV. PABLO CARRIQUIRRY NRO. 691 URB. URB. EL PALOMAR SAN ISIDR (A UNA CUADRA MINISTERIO DEL INTERIOR) LIMA - LIMA - SAN ISIDRO",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20100163471",
                "nombre" => "JJC CONTRATISTAS GENERALES S.A.",
                "direccion" => "AV. ALFREDO BENAVIDES NRO. 768 INT. P9 URB. LEURO LIMA - LIMA - MIRAFLORES",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20510711824",
                "nombre" => "EMOBYSER S.A.C.",
                "direccion" => "AV. JUAN J.ELIAS NRO. 349 URB. SAN ISIDRO (COST. COLEGIO SAN LUIS GONZAGA) ICA - ICA - ICA",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20503039347",
                "nombre" => "CSM SERV. DE LOG. DEL PERU SA",
                "direccion" => "JR. CONTRALMIRANTE MONTERO-EX ALBERTO DEL CAMPO NRO. 429 INT. 902 (ALTURA DE LA CUADRA 31 DE AV. SALAVERRY) LIMA - LIMA - MAGDALENA DEL MAR",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20538546489",
                "nombre" => "GEXA INGENIEROS SOCIEDAD ANONIMA CERRADA",
                "direccion" => "AV. DEL PARQUE SUR NRO. 129 DPTO. 301 URB. CORPAC LIMA - LIMA - SAN ISIDRO",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20495696961",
                "nombre" => "IGC",
                "direccion" => "JR. SAN LUIS NRO. 530 DULCE NOMBRE DE JESUS (3 CDRAS DEL CRUCE AV. LA PAZ CON CENEPA) CAJAMARCA - CAJAMARCA - CAJAMARCA",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20551442064",
                "nombre" => "GRUPO SEFEME S.A.C.",
                "direccion" => "JR. SATURNO NRO. 106 INT. 302 LIMA - LIMA - LOS OLIVOS",
                "pagina_web" => "https=>\/\/gruposefeme.com.pe\/",
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20469634079",
                "nombre" => "CONSTRUCTORES P Y H E.I.R.L.",
                "direccion" => "CAL.SANTA LIBERATA NRO. 196 (ALT. CDRA. 9 DE LA AV. BERTELLO) LIMA - LIMA - LIMA",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20606385138",
                "nombre" => "MAJO SOLUCIONES E.I.R.L.",
                "direccion" => "JR. CUZCO NRO. 1387 JUNIN - HUANCAYO - HUANCAYO",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20505789092",
                "nombre" => "DITRANSERVA S.A.C.",
                "direccion" => "AV. CIRCUNVALACIÓN DEL CLUB GOLF LOS INCAS NRO. 134 DPTO. 905 (EDIF PANORAMA CENTRO EMP TORRE 2) LIMA - LIMA - SANTIAGO DE SURCO",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20515632124",
                "nombre" => "AYASTA INGENIEROS SOCIEDAD ANONIMA",
                "direccion" => "MZA. B-1 LOTE. 07 URB. LUCYANA (FTE A PARQUE NRO. 4 LUCYANA) LIMA - LIMA - CARABAYLLO",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20548187266",
                "nombre" => "DE VICENTE CONSTRUCTORA S.A.C.",
                "direccion" => "AV. JAVIER PRADO OESTE NRO. 757 URB. SAN FELIPE (OFICINA 1201,1203,1204,1205,1206) LIMA - LIMA - MAGDALENA DEL MAR",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20418826119",
                "nombre" => "MAS ERRAZURIZ DEL PERU S.A.C.",
                "direccion" => "AV. 28 DE JULIO NRO. 757 INT. 501 LIMA - LIMA - MIRAFLORES",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20100082391",
                "nombre" => "COSAPI S A",
                "direccion" => "AV. REPÚBLICA DE COLOMBIA NRO. 791 URB. CHACARILLA DE SANTA CRUZ LIMA - LIMA - SAN ISIDRO",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20604335290",
                "nombre" => "MANALBA CORP S.A.C.",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20607057169",
                "nombre" => "CORPORACION LARRY S.A.C.",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20606341769",
                "nombre" => "ASOCIACION EDUCATIVA SANTO DOMINGO, CHORRILLOS",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20600881028",
                "nombre" => "ARCHEAN ANDEAN ANTHRACITE S.A.",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20604070865",
                "nombre" => "SEMGEK S.A.C.",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "10094990365",
                "nombre" => "ANGELES PEREZ CARLOS ROBERTO",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20602567096",
                "nombre" => "KERRY LOGISTICS PERU S.A.C.",
                "direccion" => "AV. DEL PINAR NRO. 180 INT. 406 URB. CHACARILLA DEL ESTANQUE LIMA - LIMA - SANTIAGO DE SURCO",
                "pagina_web" => "https=>\/\/www.kerrylogistics.com\/en\/network\/latin-america\/peru\/",
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20393044498",
                "nombre" => "AUSPIC S.A.C.",
                "direccion" => "AV. PRADERAS DE LURIN MZA. A LOTE. 9 GRU. D (PANAMERICANA SUR KM 37.2 SECTOR 3) LIMA - LIMA - LURIN",
                "pagina_web" => "https=>\/\/www.auspic.com.pe\/",
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20601398606",
                "nombre" => "EIFFAGE ENERGIA PERU S.A.C.",
                "direccion" => "AV. CAMINOS DEL INCA NRO. 390 INT. 901 URB. TAMBO DE MONTERRICO LIMA - LIMA - SANTIAGO DE SURCO",
                "pagina_web" => "https=>\/\/www.energia.eiffage.es\/tag\/eiffage-energia-peru\/",
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20195592200",
                "nombre" => "CORBAZ SRLTDA",
                "direccion" => "JR. CRISTOBAL DE PERALTA NORT NRO. 110 DPTO. 702 URB. VALLE HERMOSO (ALTURA DE LA CDRA 11 DE LA AV. PRIMAVERA) LIMA - LIMA - SANTIAGO DE SURCO",
                "pagina_web" => "https=>\/\/corbazsrl.com\/",
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "10411462647",
                "nombre" => "ROBLES YARIN ESVIT",
                "direccion" => "URUBAMBA",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20600635663",
                "nombre" => "FUNDO INCAHUASI AGROINDUSTRIAL S.A.C.",
                "direccion" => "AV. CIRCUNVALACION CLUB GOLF LOS INCAS NRO. 208 INT. 806B URB. CLUB GOLF LOS INCAS LIMA - LIMA - SANTIAGO DE SURCO",
                "pagina_web" => "https=>\/\/fundoincahuasi.com\/",
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20553327971",
                "nombre" => "PENTATECH CONSTRUCCION S.A.C.",
                "direccion" => "CAL.8 DE OCTUBRE NRO. 271 DPTO. 302 URB. SANTA CRUZ (ALTURA CUADRA 8 DE LA MAR) LIMA - LIMA - MIRAFLORES",
                "pagina_web" => "http=>\/\/pentatechsac.com\/",
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20606189258",
                "nombre" => "EAH CONTRATISTAS GENERALES S.A.C.",
                "direccion" => "MZA. A LOTE. 4 URB. 200 MILLAS PROV. CONST. DEL CALLAO - PROV. CONST. DEL CALLAO - CALLAO",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20489332621",
                "nombre" => "COPSEM S.A.C.",
                "direccion" => "JR. HUASCAR NRO. 2020 DPTO. 501 EDIF. RESID. EL BOULEVARD (RESIDENCIAL EL BOULEVARD) LIMA - LIMA - JESUS MARIA",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20607092835",
                "nombre" => "CONSORCIO ANCAYLLA",
                "direccion" => "JR. LLOQUE YUPANQUI NRO. 1026 LIMA - LIMA - JESUS MARIA",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20604732876",
                "nombre" => "FERRO INTERPRICE E.I.R.L.",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20407920156",
                "nombre" => "ANDINA DEL PERU S.R.L.",
                "direccion" => "CAL.MARISCAL ANDRES AVELINO CACERES NRO. 175 INT. 101 URB. CERCADO DE HUARAZ ANCASH - HUARAZ - HUARAZ",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20603696574",
                "nombre" => "CHINA RAILWAY 20 BUREAU GROUP CORPORATION SUCURSAL DEL PERU",
                "direccion" => "CAL.RICARDO ANGULO RAMIREZ NRO. 222 URB. CORPAC (A LA ESPALDA DE LA CLINICA RICARDO PALMA) LIMA - LIMA - SAN ISIDRO",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20602429670",
                "nombre" => "KOMACV S.A.C.",
                "direccion" => "CAL.LOS LAURELES LOTE. 3 URB. ALTO MOCHICA LA LIBERTAD - TRUJILLO - TRUJILLO",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20100003351",
                "nombre" => "SIMA PERU S. A.",
                "direccion" => "AV. CONTRALMIRANTE MORA NRO. 1102 BASE NAVAL PROV. CONST. DEL CALLAO - PROV. CONST. DEL CALLAO - CALLAO",
                "pagina_web" => "https=>\/\/www.sima.com.pe\/",
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20478078677",
                "nombre" => "MULTISERVIS MECHITA E.I.R.L.",
                "direccion" => "BL. EDIF.LOS LAURELES OF.103 NRO. 44 RES. SAN FELIPE (AV.GREGORIO ESCOBEDO CRDA-6) LIMA - LIMA - JESUS MARIA",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20366979973",
                "nombre" => "SARITA COLONIA EIRL",
                "direccion" => "AV. GRAU NRO. 314 TUMBES - TUMBES - SAN JACINTO",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20606275227",
                "nombre" => "MAQUINARIAS IRUN S.A.C.",
                "direccion" => "CAL.TABLADA CHICA NRO. 102 OTR. CALLE LIMA - BARRANCA - SUPE",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20516450810",
                "nombre" => "CHF CONSULTORES SOCIEDAD CIVIL DE RESPONSABILIDAD LIMITADA",
                "direccion" => "CAL.MANUEL SEGURA NRO. 418 DPTO. 21 (ALT DE LA CDRA 14 Y 15 DE AV. AREQUIPA) LIMA - LIMA - LINCE",
                "pagina_web" => "https=>\/\/chfconsultores.com\/",
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20146663461",
                "nombre" => "MUNICIPALIDAD PROVINCIAL DE CHANCHAMAYO",
                "direccion" => "CAL.CALLAO NRO. 245 URB. LA MERCED JUNIN - CHANCHAMAYO - CHANCHAMAYO",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20507508503",
                "nombre" => "TERRAMOVE S.A.C",
                "direccion" => "AV. MANUEL OLGUIN NRO. 211 INT. 1103 URB. LOS GRANADOS LIMA - LIMA - SANTIAGO DE SURCO",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20207553698",
                "nombre" => "PROGRAMA NACIONAL DE SANEAMIENTO URBANO",
                "direccion" => "AV. REPUBLICA DE PANAMA NRO. 3650 LIMA - LIMA - SAN ISIDRO",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20483912227",
                "nombre" => "TECNOR S.A.C.",
                "direccion" => "MZA. A LOTE. 46 Z.I. TALARA ALTA (FRENTE A AAHH HERRERA CARLIN) PIURA - TALARA - PARIÑAS",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20511492115",
                "nombre" => "CONSERMET S.A.C.",
                "direccion" => "AV. LA PLAYA MZA. O-5 LOTE. 23 A.H. LOS LICENCIADOS (FRENTE A LA PLAZA CIVICA) PROV. CONST. DEL CALLAO - PROV. CONST. DEL CALLAO - VENTANILLA",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20608629409",
                "nombre" => "CONSORCIO VIAL SONDOR VADO GRANDE",
                "direccion" => "CAL.CORONEL ANDRES REYES NRO. 420 INT. 901 URB. JARDIN LIMA - LIMA - SAN ISIDRO",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20556777781",
                "nombre" => "ZB CONSULTORES S.A.C.",
                "direccion" => "JR. HUACA DE LA LUNA MZA. T'1 LOTE. 2 URB. PORTADA DEL SOL (PISO 1 POR LA ESQ DE HUACA PALAO) LIMA - LIMA - LA MOLINA",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20546978053",
                "nombre" => "FLOR TOURS S.A.C",
                "direccion" => "JR. STA MARIA DE LOS ANGELES NRO. 662 URB. SAN DIEGO - VIPOL LIMA - LIMA - SAN MARTIN DE PORRES",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20543192661",
                "nombre" => "AZIZE INGENIEROS S.A.C.",
                "direccion" => "CAL.COROT NRO. 147 LIMA - LIMA - SAN BORJA",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20504730663",
                "nombre" => "J.R.VER S.A.C.",
                "direccion" => "AV. NESTOR GAMBETTA MZA. B6 LOTE. 13 COO. TRABAJ EMP NAC PUERTOS-EN (FTE. A LA FAB. AJINOMOTO) PROV. CONST. DEL CALLAO - PROV. CONST. DEL CALLAO - CALLAO",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "10069000288",
                "nombre" => "ADANAQUE ACEVEDO JUAN FRANCISCO",
                "direccion" => "LIMA",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20607959600",
                "nombre" => "LOPEZ INVERSIONES & CONSTRUCCIONES S.A.C.",
                "direccion" => "CAL.OLLANTAYTAMBO NRO. 155 URB. PORTADA DEL SOL ET3 LIMA - LIMA - LA MOLINA",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20522890171",
                "nombre" => "SUEZ WATER ADVANCED SOLUTIONS PERU S.A.C.",
                "direccion" => "AV. ALFREDO BENAVIDES NRO. 1579 DPTO. 905 (CON AV. REPÚBLICA DE PANAMÁ) LIMA - LIMA - MIRAFLORES",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20603878397",
                "nombre" => "MEMACARSA",
                "direccion" => "AV. REPUBLICA ARGENTINA NRO. 344 INT. E019 LIMA - LIMA - LIMA",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20534838019",
                "nombre" => "CONTRATISTAS ASOCIADOS SAN MIGUEL ARCANGEL S.A.C.",
                "direccion" => "MZA. B LOTE. 09 ASOC. ALTAMIRANO YAÑEZ (POR RECREO CHECCOHUASI) AYACUCHO - HUAMANGA - AYACUCHO",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20554851356",
                "nombre" => "PROFAMEL INGENIEROS S.A.C.",
                "direccion" => "----LA PAZ MZA. B LOTE. 6 INT. 48C C.P. SANTA MARIA DE HUACHIPA (ENTRADA DE MAFRE) LIMA - LIMA - LURIGANCHO",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20326764214",
                "nombre" => "A I D INGENIEROS S.A.C.",
                "direccion" => "MZA. C LOTE. 5B URB. MAGISTERIAL II ETAPA (A ESPALDAS DEL GRIFO PECSA) AREQUIPA - AREQUIPA - YANAHUARA",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20606995700",
                "nombre" => "GRUPO EMPRESARIAL INFRAESTRUCTURA TECNOLOGIA Y CONSTRUCCION S.A.C.",
                "direccion" => "JR. ODONOVAN NRO. 659 CAJAMARCA - CAJABAMBA - CAJABAMBA",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20601226015",
                "nombre" => "AGROCASAGRANDE S.A.C.",
                "direccion" => "AV. PARQUE FABRICA NRO. S\/N CASA GRANDE (OFIC. DE EMPRESA CASA GRANDE) LA LIBERTAD - ASCOPE - CASA GRANDE",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20271407263",
                "nombre" => "ECOMPHISA",
                "direccion" => "AV. PROLONG MARISCAL CASTILLA NRO. S\/N (CAR PIMENTEL STA ROSA DREN 4000) LAMBAYEQUE - CHICLAYO - SANTA ROSA",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20267086487",
                "nombre" => "SAN JOSE CONSTRUCTORA PERU S.A.",
                "direccion" => "AV. LA PAZ NRO. 1049 INT. 301 URB. ARMENDARIZ LIMA - LIMA - MIRAFLORES",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20608300415",
                "nombre" => "CONSORCIO NATIVIDAD DE CHINCHERO",
                "direccion" => "AV. CAMINO REAL NRO. 1281 INT. 503 LIMA - LIMA - SAN ISIDRO",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20607248169",
                "nombre" => "ACEROS FAEM & INGENIEROS S.A.C.",
                "direccion" => "CAL.GRAN PAJATEN NRO. 170 DPTO. 4P URB. ZARATE LIMA - LIMA - SAN JUAN DE LURIGANCHO",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20600799020",
                "nombre" => "ANDROMEDA PROYECTOS Y CONSTRUCCIONES SCRL",
                "direccion" => "MZA. B1 LOTE. 21 ASC. LOS CLAVELES (PASANDO MERCADO LURIN INT. 301) LIMA - LIMA - LURIN",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "10454233471",
                "nombre" => "MONTALVO PEREZ CARINA EDITT",
                "direccion" => "CHICLAYO-LAMBAYEQUE",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20505074247",
                "nombre" => "ANDINA FREIGHT SAC",
                "direccion" => "AV. DEL EJERCITO EX AUGUSTO P NRO. 1180 DPTO. 1201 LIMA - LIMA - MAGDALENA DEL MAR",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20607908754",
                "nombre" => "CONSORCIO GCZ-ORION II",
                "direccion" => "AV. PANAMERICANA SUR KM. 19.5 FND. VILLA EL OLIVAR FP CERCAD (.) LIMA - LIMA - VILLA EL SALVADOR",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20548990689",
                "nombre" => "TDM CONSTRUCCION S.A.",
                "direccion" => "ALM.LOS HORIZONTES NRO. 905 URB. HUERTOS DE VILLA LIMA - LIMA - CHORRILLOS",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20454162324",
                "nombre" => "OPERADORES MINEROS DEL PERU S.A.C.",
                "direccion" => "PREDIO STA ISABEL LTRAL1 MZA. A IRRIGACION ZAMACOLA (AV. AVIACION ALTURA KM 6) AREQUIPA - AREQUIPA - CERRO COLORADO",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20609035791",
                "nombre" => "SINERGIA AMC S.A.C.",
                "direccion" => "CAL.RAMÓN CASTILLA NRO. 102 URB. SAN PATRICIO LIMA - BARRANCA - PARAMONGA",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20606852798",
                "nombre" => "R & L SERVICIOS GENERALES Y MAQUINARIAS S.A.C.",
                "direccion" => "CAL.LOS RUISEÑORES NRO. 648 URB. SANTA ANITA 2DO SECTOR LIMA - LIMA - LA MOLINA",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20608593013",
                "nombre" => "CONSORCIO EJECUTOR TOTORA",
                "direccion" => "JR. SINCHI ROCA NRO. 301 SEC. SAN LUIS BAJO (SUM=> 3979) AMAZONAS - UTCUBAMBA - BAGUA GRANDE",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20533210385",
                "nombre" => "JALD INVERSIONES E.I.R.L.",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20298669707",
                "nombre" => "ENEL DISTRIBUCION PERU S.A.A",
                "direccion" => "C. Teniente Cesar Lopez Rojas 155, San Miguel 15088",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20571516099",
                "nombre" => "MULTISERVICIOS Y CONSTRUCTORA YEMARAH E.I.R.L.",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20545286719",
                "nombre" => "SACYR CONSTRUCCION PERU S.A.C.",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20545286719",
                "nombre" => "SACYR CONSTRUCCION PERU S.A.C.",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20511004251",
                "nombre" => "CONCESIONARIA IIRSA NORTE S.A.",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20604269009",
                "nombre" => "CHINA CIVIL ENGINEERING CONSTRUCTION CORPORATION SUCURSAL DEL PERU",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20100045517",
                "nombre" => "MOTA-ENGIL PERU",
                "direccion" => "Av. Javier Prado Este 444 – San Isidro",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20495042333",
                "nombre" => "DLTA INGENIEROS CONSULTORES CONTRATISTAS S.R.L.",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20601016347",
                "nombre" => "ALTICA CONSTRUCCIONES S.R.L.",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20531084072",
                "nombre" => "AFENA CONTRATISTAS GENERALES E.I.R.L.",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20606859652",
                "nombre" => "CONSORCIO HOSPITAL ESPINAR",
                "direccion" => "AV. ALBERTO DEL CAMPO NRO. 409 INT. 601 (AV.ALBERTO DEL CAMPO 409-411 INT.601-605) LIMA - LIMA - MAGDALENA DEL MAR",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20550780501",
                "nombre" => "CORPORACION CONSTRUCTORA MULTISERVICIOS HYC S.A.C.",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20608488287",
                "nombre" => "MULTISERVICIOS ZEÑA E.I.R.L.",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20486968487",
                "nombre" => "EMPRESA JEVIL S.A.C.",
                "direccion" => "JR. TUMI NRO. 486 INT. 301 (EDIFICIO TORRE TORRE) JUNIN - HUANCAYO - EL TAMBO",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20508947543",
                "nombre" => "HIDRO AMERICA SOCIEDAD ANONIMA CERRADA - HIDRA SAC",
                "direccion" => "CAL.RIO BLANCO MZA. E LOTE. 19 URB. LA ATARJEA (AL COSTADO DE SEDAPAL) LIMA - LIMA - EL AGUSTINO",
                "pagina_web" => null,
                "razon_social" => null,
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20508947543",
                "nombre" => "HIDRO AMERICA SOCIEDAD ANONIMA CERRADA - HIDRA SAC",
                "direccion" => "CAL.RIO BLANCO MZA. E LOTE. 19 URB. LA ATARJEA (AL COSTADO DE SEDAPAL) LIMA - LIMA - EL AGUSTINO",
                "pagina_web" => null,
                "razon_social" => null,
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20508947543",
                "nombre" => "HIDRO AMERICA SOCIEDAD ANONIMA CERRADA - HIDRA SAC",
                "direccion" => "CAL.RIO BLANCO MZA. E LOTE. 19 URB. LA ATARJEA (AL COSTADO DE SEDAPAL) LIMA - LIMA - EL AGUSTINO",
                "pagina_web" => null,
                "razon_social" => null,
            ],
            [

                "id_tipo" => 2,
                "dni_ruc" => "44995846",
                "nombre" => "Franklin Caceres Cabanaconza",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20544517687",
                "nombre" => "BASA CONSTRUCTORA & INMOBILIARIA S.A.C",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20544517687",
                "nombre" => "BASA CONSTRUCTORA & INMOBILIARIA S.A.C",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20566163811",
                "nombre" => "CLJ CONSTRUCTORA S.A.C",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20568792182",
                "nombre" => "CORPORACION CONSTRUCTORA CRONOX S.R.L.",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20164113532",
                "nombre" => "UNIVERSIDAD CESAR VALLEJO S.A.C.",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20606458585",
                "nombre" => "CONSORCIO INTI PUNKU",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20173223626",
                "nombre" => "MENORCA INVERSIONES S.A.C.",
                "direccion" => "AV. JAVIER PRADO ESTE NRO. 488 DPTO. 402 LIMA - LIMA - SAN ISIDRO",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20605491201",
                "nombre" => "SANTO DOMINGO INGENIERIA Y PROYECTOS S.A.C.",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 2,
                "dni_ruc" => "10414026511",
                "nombre" => "CAIRA TICONA HECTOR RAFAEL",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20519892104",
                "nombre" => "EMPRESA SERVICIOS GENERALES Y CONTRATISTA MAVISA S.R.L.",
                "direccion" => "MZA. D LOTE. 31 MIRAMAR PARTE BAJA MOQUEGUA - ILO - ILO",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20601564743",
                "nombre" => "PROJECT MANAGEMENT ENGINEERS S.A.C.",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20455278750",
                "nombre" => "COIMSER S.A.C.",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20406325815",
                "nombre" => "GOBIERNO REGIONAL PUNO",
                "direccion" => "JR. DEUSTUA NRO. 356 (PLAZA DE ARMAS) PUNO - PUNO - PUNO",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20607900052",
                "nombre" => "CONSORCIO SAN MIGUEL",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20518583108",
                "nombre" => "KUJI S.A.C.",
                "direccion" => "CAL.TARATA NRO. 160 INT. MEZZ (ALTURA CUADRA 6 DE AVENIDA LARCO) LIMA - LIMA - MIRAFLORES",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20146673776",
                "nombre" => "MUNICIPALIDAD DISTRITAL DE PANGOA",
                "direccion" => "CAL.7 DE JUNIO NRO. 641 (FRENTE A LA PLAZA PRINCIPAL) JUNIN - SATIPO - PANGOA",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20609010879",
                "nombre" => "INRESORTS WORLD S.A.C.",
                "direccion" => "MZA. B LOTE. 72 LIMA - LIMA - CIENEGUILLA",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20491560496",
                "nombre" => "CONSULTORA Y EJECUTORA GRUPO GALVEZ SOCIEDAD ANONIMA CERRADA",
                "direccion" => "PJ. JUAN XXIII NRO. 150 CAJAMARCA - CHOTA - CHOTA",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20607099228",
                "nombre" => "PR5 CORPSUR S.R.L",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20208070674",
                "nombre" => "MUNICIPALIDAD DISTRITAL DE CORDOVA",
                "direccion" => "CAL.MUNICIPALIDAD NRO. S\/N (EN PLAZA DE ARMAS DE CORDOVA) HUANCAVELICA - HUAYTARA - CORDOVA",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20488007697",
                "nombre" => "TRANSPORTA SERVICIOS LOGISTICOS S.A.C.",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20494817994",
                "nombre" => "CONSTRUCTORA SR CAUTIVO VT & BZ S.A.",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20606563371",
                "nombre" => "GARCIA MONTEIRO & CIA LTDA, SUCURSAL DEL PERU",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20491082811",
                "nombre" => "PASURI E.I.R.L.",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20609067072",
                "nombre" => "INMOBILIARIA CHACRA Y MAR S.A.C.",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20551503462",
                "nombre" => "FLESAN ANCLAJES S.A.C.",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20264941840",
                "nombre" => "GACSAC",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "0493040643",
                "nombre" => "VIVA NEGOCIO INMOBILIARIO S.A",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 2,
                "dni_ruc" => "10103517953",
                "nombre" => "ORTIZ MANTARI GERARDO ELEAZAR",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20552332092",
                "nombre" => "2H INGENIERIA Y CONSTRUCCION S.A.C.",
                "direccion" => "AV. EL DERBY NRO. 254 DPTO. 601 URB. EL DERBY DE MONTERRICO LIMA - LIMA - SANTIAGO DE SURCO",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20601192404",
                "nombre" => "THE PISONAY COMPANY S.A.C",
                "direccion" => "AV. CAMINOS DEL INCA NRO. 1168 URB. ALBORADA (ESQ CAMINOS DEL INCA CN VELASCO ASTETE) LIMA - LIMA - SANTIAGO DE SURCO",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20524243211",
                "nombre" => "SAETA INGENIERIA Y CONSTRUCCION S.A.C.",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 2,
                "dni_ruc" => "41635774",
                "nombre" => "Miguel Pomez",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20407816332",
                "nombre" => "Construcción y Gestión de Proyectos de Ingeniería S.A.C.",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20606444894",
                "nombre" => "CONSORCIO MANTENIMIENTO DE GASODUCTOS DEL PERU - MGP",
                "direccion" => "CAR.PANAMERICANA SUR KM. 29.5 LIMA - LIMA - LURIN",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 2,
                "dni_ruc" => "10414183587",
                "nombre" => "ALMANZA HUAMAN NORMA",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20529450380",
                "nombre" => "GROUP AUTOGRUAS S.R.L.",
                "direccion" => "MZA. A LOTE. SN CAS. CASERIO ISCOCONGA (FRENTE A RESTAURANT LA PONDEROSA)",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20498573739",
                "nombre" => "CONSTRUCTORA A & G S.R.L.CONSTRUCTORA A & G S.R.L.",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20564298833",
                "nombre" => "VAROS C&C S.R.L.",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20108397005",
                "nombre" => "USA CONTRATISTAS GENERALES S.R.L.",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20496159811",
                "nombre" => "QIAN BEI S.R.L.",
                "direccion" => "AV. PERU NRO. 1010 BR SAN SEBASTIAN CAJAMARCA - CAJAMARCA - CAJAMARCA",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20439586665",
                "nombre" => "INGECO SOCIEDAD ANONIMA CERRADA",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20606539003",
                "nombre" => "CONSORCIO PMRT",
                "direccion" => "CAL.CORONEL INCLAN NRO. 235 INT. 706 LIMA - LIMA - MIRAFLORES",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20601293618",
                "nombre" => "INMOBILIARIA & CONSTRUCTORA ASIS S.A.C.",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20600579054",
                "nombre" => "P.G OBRAS GENERALES S.A.C.",
                "direccion" => "MZA. B LOTE. 24 APV. SARITA COLONIA (ESPALDA DEL MERCADO SARITA COLONIA) LIMA - LIMA - CHORRILLOS",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20131366702",
                "nombre" => "MUNICIPALIDAD PUENTE PIEDRA",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 2,
                "dni_ruc" => "07873098",
                "nombre" => "GERMAN CANISTO BATTISTINI",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20545585465",
                "nombre" => "PALCON PERU S.A.C.",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20564496121",
                "nombre" => "GRUPO GLEY S.A.C.",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20606885939",
                "nombre" => "CONSORCIO SAM BLASS",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 2,
                "dni_ruc" => "00000000",
                "nombre" => "VERONIKA PEZANTES PALOMINO",
                "direccion" => "COMAS",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20495644902",
                "nombre" => "NICOMAR SERVICIOS GENERALES S.R.L.",
                "direccion" => "JR. JACARANDA NRO. 285 URB. SANTA MERCEDES (A 2 CDR. DE BITEL) CAJAMARCA - CAJAMARCA - CAJAMARCA",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 2,
                "dni_ruc" => "10255137366",
                "nombre" => "TORRES LOPEZ MERCEDES GERARDA",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20526474792",
                "nombre" => "AGUA PARA LA VIDA PERFORACIONES Y SERVICIOS GENERALES S.A.C.",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20539535065",
                "nombre" => "CONSTRUCCIÓN, MINERIA Y TRANSPORTE NEYRA",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20606712741",
                "nombre" => "CUBIK INGENIERIA Y CONSTRUCCION S.A.C.",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20608737686",
                "nombre" => "CONSORCIO VIRGEN DE LA PUERTA- RIOJA",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20608737686",
                "nombre" => "CONSORCIO VIRGEN DE LA PUERTA- RIOJA",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20608737686",
                "nombre" => "CONSORCIO VIRGEN DE LA PUERTA- RIOJA",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20608737686",
                "nombre" => "CONSORCIO VIRGEN DE LA PUERTA- RIOJA",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20341671681",
                "nombre" => "HM SERVICIOS INDUSTRIALES SAC",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20606391812",
                "nombre" => "CONSORCIO SAN NICOLÁS",
                "direccion" => "MARISCAL LA MAR NRO. 638 INT. 706 URB. FUNDO SANTA CRUZ LIMA - LIMA - MIRAFLORES",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20535096652",
                "nombre" => "TELLUS CONTRATISTAS GENERALES S.A.C.",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20571320607",
                "nombre" => "INVERSIONES LA ROSA NAUTICA S.R.L.",
                "direccion" => "AV. NICOLAS DE PIEROLA NRO. 981 CERCADO DE LIMA",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 2,
                "dni_ruc" => "42137218",
                "nombre" => "EDITH TREJO RODRIGUEZ",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20482548459",
                "nombre" => "FUERZA CONSTRUCTORES S.A.C.",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20607704989",
                "nombre" => "SAICO’S CONSULTORÍA, ASESORÍA & SERVICIOS MÚLTIPLES S.A.C.",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20541365878",
                "nombre" => "CORPORACION GEMZAR E.I.R.L.",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20455739234",
                "nombre" => "MULTISERVICIOS DIPOOL'S E.I.R.L.",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20508009977",
                "nombre" => "OPERACIONES SEPROCAL S.A.C.",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ]
        ]);
    }
}

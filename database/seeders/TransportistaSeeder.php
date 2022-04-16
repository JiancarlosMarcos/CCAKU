<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransportistaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transportista')->insert([
            [

                "id_tipo" => 1,
                "dni_ruc" => "10306748161",
                "nombre" => "RIVERA LLERENA ARIANA ALEJANDRA",
                "direccion" => "Av César Vallejo Nro 1403 Dpto\/ Ofc 1002 Lince (Lima)\/Urbanización La Molina MZ E Lote Nro 2 Cerro Colorado (Arequipa)",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20608210726",
                "nombre" => "BUSSINES & CHARGE TRANSPORT S.A.C.",
                "direccion" => "CAL.LOS EDAFOLOGOS NRO. 143 DPTO. 301 URB. SANTA RAQUEL LIMA - LIMA - ATE",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20527442291",
                "nombre" => "PRODUCTOS INKATAMBO S.R.L. - PROINKA S.R.L.",
                "direccion" => "AV. LOS INCAS MZA. A LOTE. 8 ALAMEDA SANTA ROSA (A MEDIA CUDRA DEL PUENTE SANTA ROSA)",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20600714270",
                "nombre" => "VKAM OPERADOR LOGISTICO S.A.C.",
                "direccion" => "AV. DE LOS PRECURSORES BQ B NRO. 440 DPTO. 902 INT. 9PIS (COSTADO COMISARIA DE MARANGA)",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "10294633010",
                "nombre" => "CAHUI AUQUILLA JAVIER AMERICO",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20604443734",
                "nombre" => "INVERSIONES AASSHKA E & D S.A.C.",
                "direccion" => "JR. LIBERTAD MZA. A LOTE. 36B URB. SAN FRANCISCO (ALT DE HUAYRUROPATA PARALELA)",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "10091167838",
                "nombre" => "BELLIDO VARGAS OSCAR ELISEO",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20602478085",
                "nombre" => "INVERSIONES TRANSPORTES VEGA S.A.C",
                "direccion" => "MZA. B LOTE. 6 APV. VALLECITO (A 2 CDRS DE GRIFO STA ELENA)",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20606384166",
                "nombre" => "GRUPO EUSEBIO VALENCIA S.A.C.",
                "direccion" => "CAL.LOS EUCALIPTOS NRO. 100 P.J. JOSE CARLOS MARIATEGUI SECTOR SAN GABRIEL B",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "10208948950",
                "nombre" => "ROBERTO CABANILLAS URETA",
                "direccion" => null,
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20564013774",
                "nombre" => "E.T. 3 DE MAYO ANTA S.A.C.",
                "direccion" => "JR. JUNIN NRO. 8 IZCUCHACA (COSTADO MUNICIPIO TIENDA MERY) CUSCO - ANTA - ANTA",
                "pagina_web" => null,
                "razon_social" => null
            ],
            [

                "id_tipo" => 1,
                "dni_ruc" => "20607071323",
                "nombre" => "TRANSPORTES UMANTAY E.I.R.L.",
                "direccion" => "NRO. Y5 APV. PATRON SAN JERONIMO (SAN JERONIMO POR PARADERO PEGASO) CUSCO - CUSCO - SAN JERONIMO",
                "pagina_web" => null,
                "razon_social" => null
            ]
        ]);
    }
}

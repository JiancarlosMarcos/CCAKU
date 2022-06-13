<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transportista;
use Illuminate\Support\Facades\DB;

class TransportistasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Transportista::create(
            [
                "nombre" => "RIVERA LLERENA ARIANA ALEJANDRA",
                "dni_ruc" => "10306748161",
                "id_tipo" => 1,
                "direccion" => "Av César Vallejo Nro 1403 Dpto/ Ofc 1002 Lince (Lima)/ Urbanización La Molina MZ E Lote Nro 2 Cerro Colorado (Arequipa)",
                "responsable_registro" => "Jackeline Espino"
            ],
            [
                "nombre" => "BUSSINES & CHARGE TRANSPORT S.A.C.",
                "dni_ruc" => "20608210726",
                "id_tipo" => 1,
                "direccion" => "CAL.LOS EDAFOLOGOS NRO. 143 DPTO. 301 URB. SANTA RAQUEL LIMA - LIMA - ATE",
                "responsable_registro" => "Jackeline Espino"
            ],
            [
                "nombre" => "PRODUCTOS INKATAMBO S.R.L. - PROINKA S.R.L.",
                "dni_ruc" => "20527442291",
                "id_tipo" => 1,
                "direccion" => "AV. LOS INCAS MZA. A LOTE. 8 ALAMEDA SANTA ROSA (A MEDIA CUDRA DEL PUENTE SANTA ROSA)",
                "responsable_registro" => "Jackeline Espino"
            ],
            [
                "nombre" => "VKAM OPERADOR LOGISTICO S.A.C.",
                "dni_ruc" => "20600714270",
                "id_tipo" => 1,
                "direccion" => "AV. DE LOS PRECURSORES BQ B NRO. 440 DPTO. 902 INT. 9PIS (COSTADO COMISARIA DE MARANGA)",
                "responsable_registro" => "Jackeline Espino"
            ],
            [
                "nombre" => "CAHUI AUQUILLA JAVIER AMERICO",
                "dni_ruc" => "10294633010",
                "id_tipo" => 1,
                "responsable_registro" => "Jackeline Espino"
            ],
            [
                "nombre" => "INVERSIONES AASSHKA E & D S.A.C.",
                "dni_ruc" => "20604443734",
                "id_tipo" => 1,
                "direccion" => "JR. LIBERTAD MZA. A LOTE. 36B URB. SAN FRANCISCO (ALT DE HUAYRUROPATA PARALELA)",
                "responsable_registro" => "Jackeline Espino"
            ],
            [
                "nombre" => "BELLIDO VARGAS OSCAR ELISEO",
                "dni_ruc" => "10091167838",
                "id_tipo" => 1,
                "responsable_registro" => "Jackeline Espino"
            ],
            [
                "nombre" => "INVERSIONES TRANSPORTES VEGA S.A.C",
                "dni_ruc" => "20602478085",
                "id_tipo" => 1,
                "direccion" => "MZA. B LOTE. 6 APV. VALLECITO (A 2 CDRS DE GRIFO STA ELENA)",
                "responsable_registro" => "Jackeline Espino"
            ],
            [
                "nombre" => "GRUPO EUSEBIO VALENCIA S.A.C.",
                "dni_ruc" => "20606384166",
                "id_tipo" => 1,
                "direccion" => "CAL.LOS EUCALIPTOS NRO. 100 P.J. JOSE CARLOS MARIATEGUI SECTOR SAN GABRIEL B",
                "responsable_registro" => "Jackeline Espino"
            ],
            [
                "nombre" => "ROBERTO CABANILLAS URETA",
                "dni_ruc" => "10208948950",
                "id_tipo" => 1,
                "responsable_registro" => "Jackeline Espino"
            ],
            [
                "nombre" => "E.T. 3 DE MAYO ANTA S.A.C.",
                "dni_ruc" => "20564013774",
                "id_tipo" => 1,
                "direccion" => "JR. JUNIN NRO. 8 IZCUCHACA (COSTADO MUNICIPIO TIENDA MERY) CUSCO - ANTA - ANTA",
                "responsable_registro" => "Jackeline Espino"
            ],
            [
                "nombre" => "TRANSPORTES UMANTAY E.I.R.L.",
                "dni_ruc" => "20607071323",
                "id_tipo" => 1,
                "direccion" => "NRO. Y5 APV. PATRON SAN JERONIMO (SAN JERONIMO POR PARADERO PEGASO) CUSCO - CUSCO - SAN JERONIMO",
                "responsable_registro" => "Jackeline Espino"
            ],
            [
                "nombre" => "TRANSPORTES CHASQUI WAVE E.I.R.L.",
                "dni_ruc" => "2051596307",
                "id_tipo" => 2,
                "direccion" => "CAL.C MZA. A LOTE. 12 ASOC VIV LOS CLAVELES DE (KM 14.5 CARRET CENTRAL PARAD SAN GERMAN) LIMA - LIMA - ATE",
                "responsable_registro" => "Brando Loo"
            ]
        );
    }
}

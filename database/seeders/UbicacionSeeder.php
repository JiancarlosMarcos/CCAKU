<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UbicacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ubicacion')->insert([
            [
                "id" => 1,
                "departamento" => "AMAZONAS",
                "coordenadas" => "-5.280829203462117, -78.15370232390322",
                "latitud" => "-5.280829203462117",
                "longitud" => "-78.15370232390322"
            ],
            [
                "id" => 2,
                "departamento" => "ANCASH",
                "coordenadas" => "-9.37295055530649, -77.79166997581643",
                "latitud" => "-9.37295055530649",
                "longitud" => "-77.79166997581643"
            ],
            [
                "id" => 3,
                "departamento" => "APURIMAC",
                "coordenadas" => "-14.011408136258819, -72.96872101932684",
                "latitud" => "-14.011408136258819",
                "longitud" => "-72.96872101932684"
            ],
            [
                "id" => 4,
                "departamento" => "AREQUIPA",
                "coordenadas" => "-16.406476126706714, -71.53497704562004",
                "latitud" => "-16.406476126706714",
                "longitud" => "-71.53497704562004"
            ],
            [
                "id" => 5,
                "departamento" => "AYACUCHO",
                "coordenadas" => "-13.162207345682205, -74.21127477472147",
                "latitud" => "-13.162207345682205",
                "longitud" => "-74.21127477472147"
            ],
            [
                "id" => 6,
                "departamento" => "CAJAMARCA",
                "coordenadas" => "-7.161315864309064, -78.50351631545789",
                "latitud" => "-7.161315864309064",
                "longitud" => "-78.50351631545789"
            ],
            [
                "id" => 7,
                "departamento" => "CALLAO",
                "coordenadas" => "-12.009981644560595, -77.12235578871298",
                "latitud" => "-12.009981644560595",
                "longitud" => "-77.12235578871298"
            ],
            [
                "id" => 8,
                "departamento" => "CUSCO",
                "coordenadas" => "-13.526678893966956, -71.95693081278829",
                "latitud" => "-13.526678893966956",
                "longitud" => "-71.95693081278829"
            ],
            [
                "id" => 9,
                "departamento" => "HUANCAVELICA",
                "coordenadas" => "-12.785393765746907, -74.97735518622767",
                "latitud" => "-12.785393765746907",
                "longitud" => "-74.97735518622767"
            ],
            [
                "id" => 10,
                "departamento" => "HUANUCO",
                "coordenadas" => "-9.89195618725416, -76.2853690970805",
                "latitud" => "-9.89195618725416",
                "longitud" => "-76.2853690970805"
            ],
            [
                "id" => 11,
                "departamento" => "ICA",
                "coordenadas" => "-14.083751672503732, -75.73878586195417",
                "latitud" => "-14.083751672503732",
                "longitud" => "-75.73878586195417"
            ],
            [
                "id" => 12,
                "departamento" => "JUNIN",
                "coordenadas" => "-11.494179492833496, -74.9049430426116",
                "latitud" => "-11.494179492833496",
                "longitud" => "-74.9049430426116"
            ],
            [
                "id" => 13,
                "departamento" => "LA LIBERTAD",
                "coordenadas" => "-7.795275346094314, -77.94171372584552",
                "latitud" => "-7.795275346094314",
                "longitud" => "-77.94171372584552"
            ],
            [
                "id" => 14,
                "departamento" => "LAMBAYEQUE",
                "coordenadas" => "-6.713374306131668, -79.90758198926001",
                "latitud" => "-6.713374306131668",
                "longitud" => "-79.90758198926001"
            ],
            [
                "id" => 15,
                "departamento" => "LIMA",
                "coordenadas" => "-12.027946520215657, -76.92187161112938",
                "latitud" => "-12.027946520215657",
                "longitud" => "-76.92187161112938"
            ],
            [
                "id" => 16,
                "departamento" => "LORETO",
                "coordenadas" => "-4.706381765219258, -75.09711337220409",
                "latitud" => "-4.706381765219258",
                "longitud" => "-75.09711337220409"
            ],
            [
                "id" => 17,
                "departamento" => "MADRE DE DIOS",
                "coordenadas" => "-12.754002632328755, -69.60285688051779",
                "latitud" => "-12.754002632328755",
                "longitud" => "-69.60285688051779"
            ],
            [
                "id" => 18,
                "departamento" => "MOQUEGUA",
                "coordenadas" => "-17.19008755154197, -70.92630547849811",
                "latitud" => "-17.19008755154197",
                "longitud" => "-70.92630547849811"
            ],
            [
                "id" => 19,
                "departamento" => "PASCO",
                "coordenadas" => "-10.356997784193364, -75.00009843137337",
                "latitud" => "-10.356997784193364",
                "longitud" => "-75.00009843137337"
            ],
            [
                "id" => 20,
                "departamento" => "PIURA",
                "coordenadas" => "-5.18145961687072, -80.66251543098304",
                "latitud" => "-5.18145961687072",
                "longitud" => "-80.66251543098304"
            ],
            [
                "id" => 21,
                "departamento" => "PUNO",
                "coordenadas" => "-15.828841351159017, -70.0289533102429",
                "latitud" => "-15.828841351159017",
                "longitud" => "-70.0289533102429"
            ],
            [
                "id" => 22,
                "departamento" => "SAN MARTIN",
                "coordenadas" => "-7.2538277758605645, -76.76650849922353",
                "latitud" => "-7.2538277758605645",
                "longitud" => "-76.76650849922353"
            ],
            [
                "id" => 23,
                "departamento" => "TACNA",
                "coordenadas" => "-18.023843727007044, -70.25372925555635",
                "latitud" => "-18.023843727007044",
                "longitud" => "-70.25372925555635"
            ],
            [
                "id" => 24,
                "departamento" => "TUMBES",
                "coordenadas" => "-3.552869941111338, -80.42949262320816",
                "latitud" => "-3.552869941111338",
                "longitud" => "-80.42949262320816"
            ],
            [
                "id" => 25,
                "departamento" => "UCAYALI",
                "coordenadas" => "-8.380944237086858, -74.66369092387282",
                "latitud" => "-8.380944237086858",
                "longitud" => "-74.66369092387282"
            ]

        ]);
    }
}

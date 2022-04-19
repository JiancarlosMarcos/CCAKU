<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('carga_cliente')->insert([
            [
                "id_cliente" => 7,
                "tipo" => "CARGADOR FRONTAL",
                "marca" => "KOMATSU",
                "modelo" => "WA 380-6",
                "id_ubicacion" => "2",
                "peso" => null
            ],
            [
                "id_cliente" => 5,
                "tipo" => "BAÑOS QUIMICOS",
                "marca" => null,
                "modelo" => null,
                "id_ubicacion" => "1",
                "peso" => null
            ],
            [
                "id_cliente" => 14,
                "tipo" => "CARGADOR FRONTAL",
                "marca" => "SEM",
                "modelo" => "659C",
                "id_ubicacion" => "3",
                "peso" => null
            ],
            [
                "id_cliente" => 15,
                "tipo" => "CARGADOR FRONTAL",
                "marca" => "KOMATSU",
                "modelo" => null,
                "id_ubicacion" => "4",
                "peso" => null
            ],
            [
                "id_cliente" => 14,
                "tipo" => "CARGADOR FRONTAL",
                "marca" => "VOLVO",
                "modelo" => null,
                "id_ubicacion" => "5",
                "peso" => null
            ],
            [
                "id_cliente" => 16,
                "tipo" => "Retroexcavadora",
                "marca" => "CAT",
                "modelo" => "420F",
                "id_ubicacion" => "6",
                "peso" => null
            ],
            [
                "id_cliente" => 22,
                "tipo" => "MINICARGADOR",
                "marca" => "CAT",
                "modelo" => "262",
                "id_ubicacion" => "20",
                "peso" => null
            ],
            [
                "id_cliente" => 5,
                "tipo" => "MINICARGADOR",
                "marca" => "BOBCAT",
                "modelo" => "S630",
                "id_ubicacion" => "9",
                "peso" => null
            ],
            [
                "id_cliente" => 30,
                "tipo" => "MOTONIVELADORA",
                "marca" => "CATERPILLAR",
                "modelo" => "140H",
                "id_ubicacion" => "1",
                "peso" => null
            ]
        ]);
    }
}

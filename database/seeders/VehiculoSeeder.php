<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehiculoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vehiculo_transportista')->insert([
            [
                "tipo" => "Camabaja",
                "marca" => "ALELUYA",
                "modelo" => "TERESITA",
                "placa" => "B2O970",
                "anio" => "2011",
                "id_transportista" => 4,
                "cantidad_ejes" => "3",
                "capacidad" => "35000",
                "id_ubicacion" => "1"
            ],
            [
                "tipo" => "Tracto",
                "marca" => "VOLVO",
                "modelo" => "VNL64T670",
                "placa" => "C3F808",
                "anio" => "2007",
                "id_transportista" => 4,
                "cantidad_ejes" => "3",
                "capacidad" => "17105",
                "id_ubicacion" => "2"
            ],
            [
                "tipo" => "Tracto",
                "marca" => "VOLVO",
                "modelo" => "FH 6X4T",
                "placa" => "T3F823",
                "anio" => null,
                "id_transportista" => 5,
                "cantidad_ejes" => null,
                "capacidad" => null,
                "id_ubicacion" => "5"
            ],
            [
                "tipo" => "Camabaja",
                "marca" => "SGM INGENIEROS",
                "modelo" => "3-B",
                "placa" => "V9K989",
                "anio" => null,
                "id_transportista" => 5,
                "cantidad_ejes" => null,
                "capacidad" => null,
                "id_ubicacion" => "7"
            ],
            [
                "tipo" => "Tracto",
                "marca" => "FREIGHTLINER",
                "modelo" => "D-800",
                "placa" => "P1I920",
                "anio" => null,
                "id_transportista" => 7,
                "cantidad_ejes" => null,
                "capacidad" => null,
                "id_ubicacion" => "8"
            ],
            [
                "tipo" => "Camion Plataforma",
                "marca" => "MONTENEGRO",
                "modelo" => "ESTRUCTURAL",
                "placa" => "A2L984",
                "anio" => null,
                "id_transportista" => 7,
                "cantidad_ejes" => null,
                "capacidad" => null,
                "id_ubicacion" => "2"
            ],
            [
                "tipo" => "Camion Plataforma",
                "marca" => "LIM",
                "modelo" => "LIM\/SRP-03",
                "placa" => "F7W977",
                "anio" => "2016",
                "id_transportista" => 8,
                "cantidad_ejes" => "3",
                "capacidad" => "32000",
                "id_ubicacion" => "3"
            ],
            [
                "tipo" => "Tracto",
                "marca" => "VOLVO",
                "modelo" => "FM400",
                "placa" => "W1I917",
                "anio" => "2008",
                "id_transportista" => 8,
                "cantidad_ejes" => "3",
                "capacidad" => "16600",
                "id_ubicacion" => "21"
            ],
            [
                "tipo" => "Camabaja",
                "marca" => "NATIONAL STANDART",
                "modelo" => "INTECPO",
                "placa" => "B7U976",
                "anio" => "2012",
                "id_transportista" => 2,
                "cantidad_ejes" => "4",
                "capacidad" => "49500",
                "id_ubicacion" => "2"
            ],
            [
                "tipo" => "Tracto",
                "marca" => "INTERNATIONAL",
                "modelo" => "7600 SBA 8X4",
                "placa" => "C9Y831",
                "anio" => "2012",
                "id_transportista" => 2,
                "cantidad_ejes" => "4",
                "capacidad" => "27384",
                "id_ubicacion" => "2"
            ],
            [
                "tipo" => "Tracto",
                "marca" => "MACK",
                "modelo" => "CXU613E",
                "placa" => "V8H837",
                "anio" => "2015",
                "id_transportista" => 3,
                "cantidad_ejes" => "3",
                "capacidad" => "16983",
                "id_ubicacion" => "4"
            ],
            [
                "tipo" => "Camion Plataforma",
                "marca" => "SGM INGENIEROS",
                "modelo" => "3-L",
                "placa" => "V9G992",
                "anio" => "2014",
                "id_transportista" => 3,
                "cantidad_ejes" => "3",
                "capacidad" => "25000",
                "id_ubicacion" => "5"
            ],
            [
                "tipo" => "Camion Plataforma",
                "marca" => "SGM INGENIEROS",
                "modelo" => "3-S",
                "placa" => "V8J990",
                "anio" => null,
                "id_transportista" => 6,
                "cantidad_ejes" => null,
                "capacidad" => null,
                "id_ubicacion" => "8"
            ],
            [
                "tipo" => "Tracto",
                "marca" => "MACK",
                "modelo" => "CXU613E",
                "placa" => "ANY845",
                "anio" => null,
                "id_transportista" => 6,
                "cantidad_ejes" => null,
                "capacidad" => null,
                "id_ubicacion" => "2"
            ],
            [
                "tipo" => "Tracto",
                "marca" => "FREIGHTLINER",
                "modelo" => "ARGOSY",
                "placa" => "V4Y844",
                "anio" => "2011",
                "id_transportista" => 6,
                "cantidad_ejes" => "3",
                "capacidad" => "18582",
                "id_ubicacion" => "2"
            ],
            [
                "tipo" => "Camion Plataforma",
                "marca" => "FAMEDI",
                "modelo" => "SRP-FMD",
                "placa" => "C0V990",
                "anio" => "2008",
                "id_transportista" => 6,
                "cantidad_ejes" => "3",
                "capacidad" => "32500",
                "id_ubicacion" => "1"
            ]

        ]);
    }
}

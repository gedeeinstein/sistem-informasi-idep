<?php

namespace Database\Seeders;

use App\Models\Provinsi;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProvinsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provinsi = 
        [
            [
                "id"=> 11,
                "kode"=> 11,
                "nama"=> "ACEH"
            ],
            [
                "id"=> 12,
                "kode"=> 12,
                "nama"=> "SUMATERA UTARA"
            ],
            [
                "id"=> 13,
                "kode"=> 13,
                "nama"=> "SUMATERA BARAT"
            ],
            [
                "id"=> 14,
                "kode"=> 14,
                "nama"=> "RIAU"
            ],
            [
                "id"=> 15,
                "kode"=> 15,
                "nama"=> "JAMBI"
            ],
            [
                "id"=> 16,
                "kode"=> 16,
                "nama"=> "SUMATERA SELATAN"
            ],
            [
                "id"=> 17,
                "kode"=> 17,
                "nama"=> "BENGKULU"
            ],
            [
                "id"=> 18,
                "kode"=> 18,
                "nama"=> "LAMPUNG"
            ],
            [
                "id"=> 19,
                "kode"=> 19,
                "nama"=> "KEPULAUAN BANGKA BELITUNG"
            ],
            [
                "id"=> 21,
                "kode"=> 21,
                "nama"=> "KEPULAUAN RIAU"
            ],
            [
                "id"=> 31,
                "kode"=> 31,
                "nama"=> "DKI JAKARTA"
            ],
            [
                "id"=> 32,
                "kode"=> 32,
                "nama"=> "JAWA BARAT"
            ],
            [
                "id"=> 33,
                "kode"=> 33,
                "nama"=> "JAWA TENGAH"
            ],
            [
                "id"=> 34,
                "kode"=> 34,
                "nama"=> "DI YOGYAKARTA"
            ],
            [
                "id"=> 35,
                "kode"=> 35,
                "nama"=> "JAWA TIMUR"
            ],
            [
                "id"=> 36,
                "kode"=> 36,
                "nama"=> "BANTEN"
            ],
            [
                "id"=> 51,
                "kode"=> 51,
                "nama"=> "BALI"
            ],
            [
                "id"=> 52,
                "kode"=> 52,
                "nama"=> "NUSA TENGGARA BARAT"
            ],
            [
                "id"=> 53,
                "kode"=> 53,
                "nama"=> "NUSA TENGGARA TIMUR"
            ],
            [
                "id"=> 61,
                "kode"=> 61,
                "nama"=> "KALIMANTAN BARAT"
            ],
            [
                "id"=> 62,
                "kode"=> 62,
                "nama"=> "KALIMANTAN TENGAH"
            ],
            [
                "id"=> 63,
                "kode"=> 63,
                "nama"=> "KALIMANTAN SELATAN"
            ],
            [
                "id"=> 64,
                "kode"=> 64,
                "nama"=> "KALIMANTAN TIMUR"
            ],
            [
                "id"=> 65,
                "kode"=> 65,
                "nama"=> "KALIMANTAN UTARA"
            ],
            [
                "id"=> 71,
                "kode"=> 71,
                "nama"=> "SULAWESI UTARA"
            ],
            [
                "id"=> 72,
                "kode"=> 72,
                "nama"=> "SULAWESI TENGAH"
            ],
            [
                "id"=> 73,
                "kode"=> 73,
                "nama"=> "SULAWESI SELATAN"
            ],
            [
                "id"=> 74,
                "kode"=> 74,
                "nama"=> "SULAWESI TENGGARA"
            ],
            [
                "id"=> 75,
                "kode"=> 75,
                "nama"=> "GORONTALO"
            ],
            [
                "id"=> 76,
                "kode"=> 76,
                "nama"=> "SULAWESI BARAT"
            ],
            [
                "id"=> 81,
                "kode"=> 81,
                "nama"=> "MALUKU"
            ],
            [
                "id"=> 82,
                "kode"=> 82,
                "nama"=> "MALUKU UTARA"
            ],
            [
                "id"=> 91,
                "kode"=> 91,
                "nama"=> "PAPUA BARAT"
            ],
            [
                "id"=> 92,
                "kode"=> 92,
                "nama"=> "PAPUA BARAT DAYA"
            ],
            [
                "id"=> 94,
                "kode"=> 94,
                "nama"=> "PAPUA"
            ],
            [
                "id"=> 95,
                "kode"=> 95,
                "nama"=> "PAPUA SELATAN"
            ],
            [
                "id"=> 96,
                "kode"=> 96,
                "nama"=> "PAPUA TENGAH"
            ],
            [
                "id"=> 97,
                "kode"=> 97,
                "nama"=> "PAPUA PEGUNUNGAN"
            ]
        ];
        Provinsi::insert($provinsi);
    }
}

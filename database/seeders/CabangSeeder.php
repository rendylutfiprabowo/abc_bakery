<?php

namespace Database\Seeders;

use App\Models\Cabang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CabangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cabang::create([
            'name' => 'Rajabasa',
            'kota_id' => '139',
            'provinsi_id' => '18'
        ]);

        Cabang::create([
            'name' => 'Kimaja',
            'kota_id' => '139',
            'provinsi_id' => '18'
        ]);

        Cabang::create([
            'name' => 'ZA Pagaralam',
            'kota_id' => '139',
            'provinsi_id' => '18'
        ]);

        Cabang::create([
            'name' => 'Kemiling',
            'kota_id' => '139',
            'provinsi_id' => '18'
        ]);

        Cabang::create([
            'name' => 'Kedaton',
            'kota_id' => '139',
            'provinsi_id' => '18'
        ]);

        Cabang::create([
            'name' => 'Raden Intan',
            'kota_id' => '139',
            'provinsi_id' => '18'
        ]);
    }
}

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
            'kota' => 'Bandar Lampung'
        ]);

        Cabang::create([
            'name' => 'Kimaja',
            'kota' => 'Bandar Lampung'
        ]);

        Cabang::create([
            'name' => 'ZA Pagaralam',
            'kota' => 'Bandar Lampung'
        ]);

        Cabang::create([
            'name' => 'Kemiling',
            'kota' => 'Bandar Lampung'
        ]);

        Cabang::create([
            'name' => 'Kedaton',
            'kota' => 'Bandar Lampung'
        ]);

        Cabang::create([
            'name' => 'Raden Intan',
            'kota' => 'Bandar Lampung'
        ]);
    }
}

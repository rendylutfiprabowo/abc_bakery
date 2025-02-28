<?php

namespace Database\Seeders;

use App\Models\Kota;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil path file CSV
        $csvFile = storage_path('app/csv/kota.csv');
        $csv = array_map('str_getcsv', file($csvFile));

        // Hapus baris pertama yang merupakan header
        array_shift($csv);

        foreach ($csv as $row) {
            Kota::create([
                'id' => $row[0],
                'kode_wilayah' => $row[1],
                'name' => $row[2],
                'province' => $row[3],
            ]);
        }
    }
}

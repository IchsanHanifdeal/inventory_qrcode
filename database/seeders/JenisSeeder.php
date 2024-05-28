<?php

namespace Database\Seeders;

use App\Models\jenis;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Jenis::create([
            'id_jenis' => '1',
            'kode_jenis' => 'J01',
            'jenis' => 'Makanan',
        ]);

        Jenis::create([
            'id_jenis' => '2',
            'kode_jenis' => 'J02',
            'jenis' => 'Minuman',
        ]);

        Jenis::create([
            'id_jenis' => '3',
            'kode_jenis' => 'J03',
            'jenis' => 'Baju',
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Merk;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MerkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Merk::create([
            'id_merk' => '1',
            'kode' => 'M01',
            'merk' => 'H&M',
        ]);
        Merk::create([
            'id_merk' => '2',
            'kode' => 'M02',
            'merk' => 'Hermes',
        ]);
        Merk::create([
            'id_merk' => '3',
            'kode' => 'M03',
            'merk' => 'Gucci',
        ]);
    }
}

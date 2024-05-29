<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Barang::create([
            'foto' => 'https://img.freepik.com/free-photo/close-up-mystery-box_23-2149631472.jpg',
            'kode' => 'B001',
            'nama' => 'Barang 001',
            'stok' => '0',
            'satuan' => 'pcs',
            'id_jenis' => '1',
            'id_merk' => '2',
        ]);
        Barang::create([
            'foto' => 'https://img.freepik.com/free-photo/close-up-mystery-box_23-2149631472.jpg',
            'kode' => 'B002',
            'nama' => 'Barang 002',
            'stok' => '10',
            'satuan' => 'pcs',
            'id_jenis' => '2',
            'id_merk' => '3',
        ]);
    }
}

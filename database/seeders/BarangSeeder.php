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
            'kode' => 'B001',
            'nama' => 'Barang 001',
            'gambar' => '001',
            'lokasi' => 'gudang',
            'stok' => '0',
            'satuan' => 'pcs',
            'id_jenis' => '1',
            'id_merk' => '2',
            'status' => 'layak',
        ]);
        Barang::create([
            'kode' => 'B002',
            'nama' => 'Barang 002',
            'gambar' => '002',
            'lokasi' => 'gudang',
            'stok' => '10',
            'satuan' => 'pcs',
            'id_jenis' => '2',
            'id_merk' => '3',
            'status' => 'layak',
        ]);
    }
}

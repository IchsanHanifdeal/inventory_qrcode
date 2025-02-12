<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $table = "barang";
    protected $primaryKey = "id_barang";
    protected $fillable = ['kode', 'nama', 'gambar','stok', 'satuan', 'id_jenis', 'id_merk', 'status', 'lokasi'];

    public function jenis()
    {
        return $this->belongsTo(Jenis::class, 'id_jenis');
    }
    public function merk()
    {
        return $this->belongsTo(Merk::class, 'id_merk');
    }
}

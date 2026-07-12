<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;
    protected $table = "peminjaman";
    protected $primaryKey = "id_peminjaman";
    protected $fillable = ['id_user', 'perihal', 'id_barang', 'jumlah', 'pengembalian', 'validasi', 'status', 'ruangan', 'mata_pelajaran', 'digital_signature', 'ttd_date'];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}

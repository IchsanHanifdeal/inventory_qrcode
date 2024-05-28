<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merk extends Model
{
    use HasFactory;
    protected $table = "merk";
    protected $primaryKey = "id_merk";
    protected $fillable = ['kode', 'merk'];
}

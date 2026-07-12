<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id('id_peminjaman');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
            $table->string('perihal');
            $table->unsignedBigInteger('id_barang');
            $table->foreign('id_barang')->references('id_barang')->on('barang')->onDelete('cascade');
            $table->string('jumlah');
            $table->date('pengembalian');
            $table->string('ruangan')->nullable();
            $table->string('mata_pelajaran')->nullable();
            $table->enum('validasi', ['dikonfirmasi', 'disetujui sarpras', 'menunggu persetujuan operator', 'ditolak'])->default('menunggu persetujuan operator');
            $table->enum('status', ['dipinjam', 'dikembalikan', 'ditolak', 'menunggu persetujuan operator', 'disetujui sarpras'])->default('menunggu persetujuan operator');
            $table->text('digital_signature')->nullable();
            $table->timestamp('ttd_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};

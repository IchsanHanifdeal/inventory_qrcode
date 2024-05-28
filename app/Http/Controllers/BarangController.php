<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;

class BarangController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return view('dashboard.barang', [
      'total_barang' => Barang::count(),
      'stok_barang' => Barang::sum('stok'),
      'barang_masuk' => BarangMasuk::Count(),
      'barang_keluar' => BarangKeluar::Count(),
      'barang' => Barang::all(),
    ]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   */
  public function show(Barang $barang)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Barang $barang)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Barang $barang)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Barang $barang)
  {
    //
  }
}

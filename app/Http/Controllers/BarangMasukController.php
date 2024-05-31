<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangMasukController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return view('dashboard.barang_masuk', [
      'barang_masuk' => BarangMasuk::all(),
      'jumlah_masuk' => BarangMasuk::sum('jumlah'),
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
    $request->validate([
      'barang_masuk' => 'required|exists:barang,id_barang',
      'jumlah_barang' => 'required|integer|min:1',
    ]);

    DB::beginTransaction();

    try {
      $masuk = BarangMasuk::create([
        'id_barang' => $request->barang_masuk,
        'jumlah' => $request->jumlah_barang,
        'tanggal' => now(),
      ]);

      $barang = Barang::findOrFail($request->barang_masuk);
      $barang->stok += $request->jumlah_barang;
      $barang->save();

      DB::commit();

      toastr()->success('Input barang masuk berhasil!');
      return redirect()->back();
    } catch (\Exception $e) {
      DB::rollBack();
      toastr()->error('Input barang masuk gagal: ' . $e->getMessage());
      return redirect()->back()->withInput();
    }
  }

  /**
   * Display the specified resource.
   */
  public function show(BarangMasuk $barangMasuk)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(BarangMasuk $barangMasuk)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, BarangMasuk $barangMasuk)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(BarangMasuk $barangMasuk)
  {
    //
  }
}

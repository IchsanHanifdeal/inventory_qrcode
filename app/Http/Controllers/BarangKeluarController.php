<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangKeluarController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return view('dashboard.barang_keluar', [
      'barang_keluar' => BarangKeluar::all(),
      'jumlah_keluar' => BarangKeluar::sum('jumlah'),
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
      'barang_keluar' => 'required|exists:barang,id_barang',
      'jumlah_barang' => 'required|integer|min:1',
    ], [
      'barang_keluar.required' => 'ID Barang harus diisi.',
      'barang_keluar.exists' => 'Barang tidak ditemukan.',
      'jumlah_barang.required' => 'Jumlah harus diisi.',
      'jumlah_barang.integer' => 'Jumlah harus berupa angka.',
      'jumlah_barang.min' => 'Jumlah harus minimal 1.',
    ]);

    DB::beginTransaction();

    try {
      $barang = Barang::findOrFail($request->barang_keluar);

      if ($request->jumlah_barang > $barang->stok) {
        return redirect()->back()->withErrors(['jumlah_barang' => 'Jumlah barang keluar melebihi stok yang ada.'])->withInput();
      }

      $keluar = BarangKeluar::create([
        'id_barang' => $request->barang_keluar,
        'jumlah' => $request->jumlah_barang,
        'tanggal' => now(),
      ]);

      $barang->stok -= $request->jumlah_barang;
      $barang->save();

      DB::commit();

      toastr()->success('Input barang keluar berhasil!');
      return redirect()->back();
    } catch (\Exception $e) {
      DB::rollBack();
      toastr()->error('Input barang keluar gagal: ' . $e->getMessage());
      return redirect()->back()->withInput();
    }
  }

  /**
   * Display the specified resource.
   */
  public function show(BarangKeluar $barangKeluar)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(BarangKeluar $barangKeluar)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, BarangKeluar $barangKeluar)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(BarangKeluar $barangKeluar)
  {
    //
  }
}

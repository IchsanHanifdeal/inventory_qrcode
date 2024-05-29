<?php

namespace App\Http\Controllers;

use App\Models\Merk;
use App\Models\User;
use App\Models\Jenis;
use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use App\Models\Dashboard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class DashboardController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $today = Date::now()->toDateString();
    $barang_masuk = BarangMasuk::whereDate('tanggal', $today)->get();
    $barang_keluar = BarangKeluar::whereDate('tanggal', $today)->get();
    return view('dashboard.index', [
      'data' => [
        'labels' => ['January', 'February', 'March', 'April', 'May'],
        'data' => [65, 59, 80, 81, 56],
      ],
      'totalBarang' => Barang::Count(),
      'totalMerk' => Merk::Count(),
      'totalJenis' => Jenis::Count(),
      'totalUser' => User::Count(),
      'totalMasuk' => BarangMasuk::count(),
      'totalKeluar' => BarangKeluar::count(),
      'barang_keluar' => $barang_keluar,
      'barang_masuk' => $barang_masuk,
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
  public function show(Dashboard $dashboard)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Dashboard $dashboard)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Dashboard $dashboard)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Dashboard $dashboard)
  {
    //
  }
}

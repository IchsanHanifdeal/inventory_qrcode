<?php

namespace App\Http\Controllers;

use App\Models\Merk;
use App\Models\Jenis;
use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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
      'barang_masuk' => BarangMasuk::count(),
      'barang_keluar' => BarangKeluar::count(),
      'barang' => Barang::all(),
      'merk' => Merk::all(),
      'jenis' => Jenis::all(),
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
    // Validasi input termasuk file gambar
    $validator = Validator::make($request->all(), [
      'kode_barang' => 'required|unique:barang,kode',
      'nama_barang' => 'required|unique:barang,nama',
      'jenis_barang' => 'required|exists:jenis,id_jenis',
      'merek_barang' => 'required|exists:merk,id_merk',
      'satuan_barang' => 'required|string|max:255',
      'lokasi_barang' => 'required|string|max:255',
      'status' => 'required|string|max:255',
      'gambar_barang' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg'
    ], [
      'kode_barang.unique' => 'Kode barang sudah terdaftar, silahkan daftarkan Kode barang lain',
      'nama_barang.unique' => 'Nama barang sudah terdaftar, silahkan daftarkan Nama barang lain',
      'gambar_barang.image' => 'File harus berupa gambar',
    ]);

    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator)->withInput();
    }

    try {
      $pathGambar = null;

      // Cek jika ada gambar yang diunggah
      if ($request->hasFile('gambar_barang')) {
        $pathGambar = $request->file('gambar_barang')->store('images/barang', 'public');
      }

      // Buat data barang
      $barang = Barang::create([
        'kode' => $request->kode_barang,
        'nama' => $request->nama_barang,
        'stok' => 0,
        'status' => $request->status,
        'lokasi' => $request->lokasi_barang,
        'satuan' => $request->satuan_barang,
        'id_jenis' => $request->jenis_barang,
        'id_merk' => $request->merek_barang,
        'gambar' => $pathGambar,
      ]);

      toastr()->success('Pendaftaran barang Berhasil!');
      return redirect()->route('barang');
    } catch (\Exception $e) {
      toastr()->error('Pendaftaran gagal: ' . $e->getMessage());
      return redirect()->back()->withInput();
    }
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
  public function update(Request $request, $id_barang)
  {
    // Validasi data yang diperbarui
    $request->validate([
      'up_kode_barang' => 'required|string|max:255|unique:barang,kode,' . $id_barang . ',id_barang',
      'up_nama_barang' => 'required|string|max:255|unique:barang,nama,' . $id_barang . ',id_barang',
      'up_jenis_barang' => 'required|exists:jenis,id_jenis',
      'up_merek_barang' => 'required|exists:merk,id_merk',
      'up_satuan_barang' => 'required|string|max:255',
      'up_lokasi_barang' => 'required|string|max:255',
      'up_status' => 'required|string|max:255',
      'up_gambar_barang' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    ]);

    $barang = Barang::where('id_barang', $id_barang)->firstOrFail();

    if ($request->hasFile('up_gambar_barang')) {
      if ($barang->gambar && Storage::disk('public')->exists($barang->gambar)) {
        Storage::disk('public')->delete($barang->gambar);
      }

      $barang->gambar = $request->file('up_gambar_barang')->store('images/barang', 'public');
    }

    $barang->kode = $request->input('up_kode_barang');
    $barang->nama = $request->input('up_nama_barang');
    $barang->id_jenis = $request->input('up_jenis_barang');
    $barang->id_merk = $request->input('up_merek_barang');
    $barang->satuan = $request->input('up_satuan_barang');
    $barang->status = $request->input('up_status');
    $barang->lokasi = $request->input('up_lokasi_barang');
    $barang->save();

    return redirect()->back()->with('success', 'Barang berhasil diupdate');
  }
}

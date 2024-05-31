<?php

namespace App\Http\Controllers;

use App\Models\Merk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MerkController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return view('dashboard.merk', [
      'total_merk' => Merk::Count(),
      'merk_terbaru' => Merk::latest()->first(),
      'merk' => Merk::all(),
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
    $validator = Validator::make($request->all(), [
      'kode_merek' => 'required|unique:merk,kode',
      'nama_merek' => 'required|unique:merk,merk',
    ], [
      'kode_merek.unique' => 'Kode Merk sudah terdaftar, silahkan daftarkan Kode Merk lain',
      'nama_merek.unique' => 'Nama Merk sudah terdaftar, silahkan daftarkan Nama Merk lain',
    ]);

    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator)->withInput();
    }

    try {
      $merk = Merk::create([
        'kode' => $request->kode_merek,
        'merk' => $request->nama_merek,
      ]);

      toastr()->success('Pendaftaran Merk Berhasil!');
      return redirect()->route('merk');
    } catch (\Exception $e) {
      toastr()->error('Pendaftaran gagal: ' . $e->getMessage());
      return redirect()->back()->withInput();
    }
  }

  /**
   * Display the specified resource.
   */
  public function show(Merk $merk)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Merk $merk)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, $id_merk)
  {
    $merk = merk::findOrFail($id_merk);

    $validatedData = $request->validate([
      'up_kode_merek' => 'required|string|unique:merk,kode',
      'up_nama_merek' => 'required|string|unique:merk,merk',
    ]);

    $merk->kode = $validatedData['up_kode_merek'];
    $merk->merk = $validatedData['up_nama_merek'];

    $merk->update();

    if (!$merk) {
      toastr()->error('gagal merk merk!');
      return redirect()->back();
    }

    toastr()->success('Ubah merk berhasil!');
    return redirect()->back();
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Merk $merk)
  {
    //
  }
}

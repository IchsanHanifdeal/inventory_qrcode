<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JenisController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return view('dashboard.jenis', [
      'total_jenis' => Jenis::Count(),
      'jenis_terbaru' => Jenis::latest()->first(),
      'jenis' => Jenis::all(),
    ]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'kode_jenis' => 'required|unique:jenis,kode_jenis',
      'nama_jenis' => 'required|unique:jenis,jenis',
    ], [
      'kode_jenis.unique' => 'Kode jenis sudah terdaftar, silahkan daftarkan Kode jenis lain',
      'nama_jenis.unique' => 'Nama jenis sudah terdaftar, silahkan daftarkan Nama jenis lain',
    ]);

    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator)->withInput();
    }

    try {
      $jenis = jenis::create([
        'kode_jenis' => $request->kode_jenis,
        'jenis' => $request->nama_jenis,
      ]);

      toastr()->success('Pendaftaran jenis Berhasil!');
      return redirect()->route('jenis');
    } catch (\Exception $e) {
      toastr()->error('Pendaftaran gagal: ' . $e->getMessage());
      return redirect()->back()->withInput();
    }
  }

  /**
   * Display the specified resource.
   */
  public function show(Jenis $jenis)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Jenis $jenis)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Jenis $jenis)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Jenis $jenis)
  {
    //
  }
}

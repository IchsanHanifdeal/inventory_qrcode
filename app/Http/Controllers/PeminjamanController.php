<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.peminjaman', [
            'total_peminjaman' => Peminjaman::count(),
            'peminjaman' => Peminjaman::all(),
            'total_diterima' => Peminjaman::where('validasi', 'dikonfirmasi')->count(),
            'total_ditolak' => Peminjaman::where('validasi', 'ditolak')->count(),
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
    public function show(Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function terima(Request $request, $id_peminjaman)
    {
        $peminjaman = Peminjaman::findorfail($id_peminjaman);

        $peminjaman->update([
            'validasi' => 'dikonfirmasi',
        ]);

        return redirect()->back()->with('success', 'Peminjaman diterima');
    }

    public function tolak(Request $request, $id_peminjaman)
    {
        $peminjaman = Peminjaman::findorfail($id_peminjaman);

        $peminjaman->update([
            'validasi' => 'ditolak',
        ]);

        return redirect()->back()->with('success', 'Peminjaman ditolak');
    }

    /**
     * Remove the specified resource from storage.
     */
}

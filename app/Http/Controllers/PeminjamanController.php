<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Barang;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role == 'user') {
            $total_peminjaman = Peminjaman::where('id_user', $user->id_user)->count();
            $total_diterima = Peminjaman::where('id_user', $user->id_user)->where('validasi', 'dikonfirmasi')->count();
            $total_ditolak = Peminjaman::where('id_user', $user->id_user)->where('validasi', 'ditolak')->count();
        } else {
            $total_peminjaman = Peminjaman::count();
            $total_diterima = Peminjaman::where('validasi', 'dikonfirmasi')->count();
            $total_ditolak = Peminjaman::where('validasi', 'ditolak')->count();
        }

        return view('dashboard.peminjaman', [
            'total_peminjaman' => $total_peminjaman,
            'peminjaman' => $user->role == 'user' ? Peminjaman::where('id_user', $user->id_user)->get() : Peminjaman::all(),
            'total_diterima' => $total_diterima,
            'total_ditolak' => $total_ditolak,
            'user' => $user,
            'barang' => Barang::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function ajukan_peminjaman(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'perihal' => 'required',
            'id_barang' => 'required|exists:barang,id_barang',
            'jumlah' => 'required|integer|min:1',
            'pengembalian' => 'required',
        ]);

        $validator->after(function ($validator) use ($request) {
            $barang = Barang::find($request->input('id_barang'));

            if ($barang && $request->input('jumlah') > $barang->stok) {
                $validator->errors()->add('jumlah', 'Permintaan tidak bisa melebihi stok.');
            }

            $returnDate = Carbon::parse($request->input('pengembalian'));
            $today = Carbon::today();
            $minReturnDate = $today->copy()->addDays(3);

            if ($returnDate->lt($today)) {
                $validator->errors()->add('pengembalian', 'Pengembalian tidak bisa sebelum hari ini.');
            } elseif ($returnDate->lt($minReturnDate)) {
                $validator->errors()->add('pengembalian', 'Tanggal pengembalian harus 3 hari setelah hari ini.');
            }
        });

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        try {
            $peminjaman = Peminjaman::create([
                'id_user' => $user->id_user,
                'id_barang' => $request->id_barang,
                'perihal' => $request->perihal,
                'jumlah' => $request->jumlah,
                'pengembalian' => $request->pengembalian,
            ]);
            toastr()->success('Pengajuan Peminjaman Berhasil!');
            return redirect()->back();
        } catch (\Exception $e) {
            toastr()->error('Pengajuan Peminjaman gagal: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function kembalikan(Request $request, $id_peminjaman)
    {
        DB::beginTransaction();

        try {
            $peminjaman = Peminjaman::findOrFail($id_peminjaman);

            $barang = Barang::findOrFail($peminjaman->id_barang);

            $peminjaman->update([
                'status' => 'dikembalikan',
            ]);

            $barang->stok += $peminjaman->jumlah;
            $barang->save();

            DB::commit();

            return redirect()->back()->with('success', 'Pengembalian diterima');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Gagal melakukan pengembalian: ' . $e->getMessage());
        }
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
        DB::beginTransaction();

        try {
            $peminjaman = Peminjaman::findOrFail($id_peminjaman);

            $barang = Barang::findOrFail($peminjaman->id_barang);

            if ($barang->stok < $peminjaman->jumlah) {
                return redirect()->back()->with('error', 'Stock tidak cukup untuk peminjaman.');
            }

            $peminjaman->update([
                'validasi' => 'dikonfirmasi',
                'status' => 'dipinjam',
            ]);

            $barang->stok -= $peminjaman->jumlah;
            $barang->save();

            DB::commit();

            return redirect()->back()->with('success', 'Peminjaman diterima');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Gagal menerima peminjaman: ' . $e->getMessage());
        }
    }

    public function tolak(Request $request, $id_peminjaman)
    {
        $peminjaman = Peminjaman::findorfail($id_peminjaman);

        $peminjaman->update([
            'validasi' => 'ditolak',
            'status' => 'ditolak',
        ]);

        return redirect()->back()->with('success', 'Peminjaman ditolak');
    }

    /**
     * Remove the specified resource from storage.
     */
}

<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Barang;
use App\Models\Jenis;
use App\Models\Merk;
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

        if (in_array($user->role, ['user', 'guru'])) {
            $total_peminjaman = Peminjaman::where('id_user', $user->id_user)->count();
            $total_diterima = Peminjaman::where('id_user', $user->id_user)->where('validasi', 'dikonfirmasi')->count();
            $total_ditolak = Peminjaman::where('id_user', $user->id_user)->where('validasi', 'ditolak')->count();
            $total_dikembalikan = Peminjaman::where('id_user', $user->id_user)->where('status', 'dikembalikan')->count();
        } else {
            $total_peminjaman = Peminjaman::count();
            $total_diterima = Peminjaman::where('validasi', 'dikonfirmasi')->count();
            $total_ditolak = Peminjaman::where('validasi', 'ditolak')->count();
            $total_dikembalikan = Peminjaman::where('status', 'dikembalikan')->count();
        }

        return view('dashboard.peminjaman', [
            'total_peminjaman' => $total_peminjaman,
            'total_dikembalikan' => $total_dikembalikan,
            'peminjaman' => in_array($user->role, ['user', 'guru']) ? Peminjaman::where('id_user', $user->id_user)->get() : Peminjaman::all(),
            'total_diterima' => $total_diterima,
            'total_ditolak' => $total_ditolak,
            'user' => $user,
            'barang' => Barang::all(),
            'merk' => Merk::all(),
            'jenis' => Jenis::all(),
            'total_barang' => Barang::count(),
            'stok_barang' => Barang::sum('stok'),
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
            'ruangan' => 'nullable|string|max:255',
            'mata_pelajaran' => 'nullable|string|max:255',
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
                'ruangan' => $request->ruangan,
                'mata_pelajaran' => $request->mata_pelajaran,
                'validasi' => 'menunggu persetujuan operator',
                'status' => 'menunggu persetujuan operator',
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
    public function ajukan_peminjaman_qr(Request $request)
    {
        $user = Auth::user();

        // Validate the request
        $validator = Validator::make($request->all(), [
            'perihal' => 'required',
            'id_barang' => 'required|exists:barang,id_barang',
            'jumlah' => 'required|integer|min:1',
            'pengembalian' => 'required|date',
            'ruangan' => 'nullable|string|max:255',
            'mata_pelajaran' => 'nullable|string|max:255',
        ]);

        // Custom validation for stock and return date
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

        // Handle validation failures
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422); // Unprocessable Entity
        }

        try {
            // Create the peminjaman record
            $peminjaman = Peminjaman::create([
                'id_user' => $user->id_user,
                'id_barang' => $request->id_barang,
                'perihal' => $request->perihal,
                'jumlah' => $request->jumlah,
                'pengembalian' => $request->pengembalian,
                'ruangan' => $request->ruangan,
                'mata_pelajaran' => $request->mata_pelajaran,
                'validasi' => 'menunggu persetujuan operator',
                'status' => 'menunggu persetujuan operator',
            ]);

            // Success response
            return response()->json(['message' => 'Pengajuan Peminjaman Berhasil!'], 200);
        } catch (\Exception $e) {
            // Error response
            return response()->json(['error' => 'Pengajuan Peminjaman gagal: ' . $e->getMessage()], 500);
        }
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

    public function terima_operator(Request $request, $id_peminjaman)
    {
        try {
            $peminjaman = Peminjaman::findOrFail($id_peminjaman);
            $barang = Barang::findOrFail($peminjaman->id_barang);

            if ($barang->stok < $peminjaman->jumlah) {
                return redirect()->back()->with('error', 'Stok barang tidak cukup.');
            }

            $peminjaman->update([
                'validasi' => 'disetujui sarpras',
                'status' => 'disetujui sarpras',
            ]);

            toastr()->success('Peminjaman disetujui Operator!');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memproses persetujuan Operator: ' . $e->getMessage());
        }
    }

    public function terima_kepala(Request $request, $id_peminjaman)
    {
        DB::beginTransaction();
        try {
            $peminjaman = Peminjaman::findOrFail($id_peminjaman);
            $barang = Barang::findOrFail($peminjaman->id_barang);

            if ($barang->stok < $peminjaman->jumlah) {
                return redirect()->back()->with('error', 'Stok barang tidak cukup.');
            }

            // Generate digital signature hash (SHA256)
            $hash = hash('sha256', $peminjaman->id_peminjaman . '-' . $peminjaman->id_user . '-' . now()->toDateTimeString());

            $peminjaman->update([
                'validasi' => 'dikonfirmasi',
                'status' => 'dipinjam',
                'digital_signature' => $hash,
                'ttd_date' => now(),
            ]);

            $barang->stok -= $peminjaman->jumlah;
            $barang->save();

            DB::commit();
            toastr()->success('Peminjaman dikonfirmasi oleh Kepala Sarpras dengan TTD Digital!');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal mengonfirmasi Peminjaman: ' . $e->getMessage());
        }
    }

    public function cetak_surat($id_peminjaman)
    {
        $peminjaman = Peminjaman::with(['barang', 'user'])->findOrFail($id_peminjaman);
        return view('dashboard.surat_peminjaman', [
            'pe' => $peminjaman,
            'title' => 'Surat Bukti Peminjaman Barang'
        ]);
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

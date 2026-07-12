<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Bukti Peminjaman - {{ $pe->barang->nama }}</title>
    @vite('resources/css/app.css')
    <script src="/qrcodejs/qrcode.min.js"></script>
    <style>
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                background-color: white !important;
                color: black !important;
                padding: 0 !important;
            }
        }
    </style>
</head>
<body class="bg-zinc-100 py-10 font-[sans-serif] print:py-0">
    
    <!-- Floating Action Menu (No Print) -->
    <div class="no-print fixed top-5 left-1/2 transform -translate-x-1/2 bg-white shadow-xl border border-zinc-200 px-6 py-3 rounded-full flex gap-4 z-50">
        <button onclick="window.print()" class="btn btn-primary btn-sm text-white capitalize flex items-center gap-1.5 shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-5a2 2 0 00-2-2H5a2 2 0 00-2 2v5a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
            </svg>
            Cetak Dokumen
        </button>
        <button onclick="window.close()" class="btn btn-outline btn-sm capitalize">
            Tutup
        </button>
    </div>

    <!-- Letter Sheet -->
    <div class="max-w-3xl mx-auto bg-white p-10 border border-zinc-300 shadow-lg print:border-0 print:shadow-none min-h-[297mm] flex flex-col justify-between">
        <div>
            <!-- Letter Head (Kop Surat) -->
            <div class="flex items-center justify-between border-b-4 border-black pb-4 mb-6">
                <div class="w-16 h-16 bg-zinc-200 rounded-full flex items-center justify-center font-bold text-xs text-zinc-600 print:bg-zinc-100">
                    LOGO
                </div>
                <div class="text-center flex-1">
                    <h1 class="text-xl font-bold uppercase tracking-wider">DINAS PENDIDIKAN DAN KEBUDAYAAN</h1>
                    <h2 class="text-lg font-bold uppercase tracking-wider">SMA NEGERI INVENTARISASI KOTA</h2>
                    <p class="text-xs text-zinc-500">Jl. Teknologi Inventory No. 100, Kota Digital. Telp: (021) 123456</p>
                </div>
                <div class="w-16"></div>
            </div>

            <!-- Title -->
            <div class="text-center mb-8">
                <h3 class="text-lg font-bold uppercase underline decoration-2">SURAT BUKTI PEMINJAMAN INVENTARIS</h3>
                <p class="text-sm font-mono text-zinc-600">Nomor: {{ str_pad($pe->id_peminjaman, 5, '0', STR_PAD_LEFT) }}/SBY/INV/{{ now()->year }}</p>
            </div>

            <!-- Description -->
            <p class="text-sm text-zinc-700 leading-relaxed mb-6">
                Yang bertanda tangan di bawah ini menerangkan bahwa permohonan peminjaman barang inventaris sekolah yang diajukan oleh Guru yang bersangkutan telah disetujui dengan rincian data sebagai berikut:
            </p>

            <!-- Table Info -->
            <table class="table-auto w-full text-sm border-collapse border border-zinc-300 mb-8">
                <tbody>
                    <tr>
                        <td class="border border-zinc-300 px-4 py-2.5 font-bold w-1/3 bg-zinc-50">Nama Peminjam</td>
                        <td class="border border-zinc-300 px-4 py-2.5">{{ $pe->user->name }}</td>
                    </tr>
                    <tr>
                        <td class="border border-zinc-300 px-4 py-2.5 font-bold bg-zinc-50">NIK / NIP</td>
                        <td class="border border-zinc-300 px-4 py-2.5 font-mono">{{ $pe->user->nik ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="border border-zinc-300 px-4 py-2.5 font-bold bg-zinc-50">Ruangan</td>
                        <td class="border border-zinc-300 px-4 py-2.5">{{ $pe->ruangan ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="border border-zinc-300 px-4 py-2.5 font-bold bg-zinc-50">Mata Pelajaran</td>
                        <td class="border border-zinc-300 px-4 py-2.5">{{ $pe->mata_pelajaran ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="border border-zinc-300 px-4 py-2.5 font-bold bg-zinc-50">Perihal / Tujuan</td>
                        <td class="border border-zinc-300 px-4 py-2.5">{{ $pe->perihal }}</td>
                    </tr>
                    <tr>
                        <td class="border border-zinc-300 px-4 py-2.5 font-bold bg-zinc-50">Barang dipinjam</td>
                        <td class="border border-zinc-300 px-4 py-2.5 font-semibold">{{ $pe->barang->kode }} - {{ $pe->barang->nama }}</td>
                    </tr>
                    <tr>
                        <td class="border border-zinc-300 px-4 py-2.5 font-bold bg-zinc-50">Jumlah Pinjam</td>
                        <td class="border border-zinc-300 px-4 py-2.5">{{ $pe->jumlah }} {{ $pe->barang->satuan }}</td>
                    </tr>
                    <tr>
                        <td class="border border-zinc-300 px-4 py-2.5 font-bold bg-zinc-50">Tanggal Batas Kembali</td>
                        <td class="border border-zinc-300 px-4 py-2.5">{{ \Carbon\Carbon::parse($pe->pengembalian)->locale('id')->translatedFormat('d F Y') }}</td>
                    </tr>
                </tbody>
            </table>

            <p class="text-xs text-zinc-500 italic mb-8">
                * Surat bukti peminjaman ini wajib ditunjukkan kepada petugas saat pengambilan barang serta pada saat pengembalian barang untuk proses verifikasi.
            </p>
        </div>

        <!-- Signature Area -->
        <div class="flex justify-between items-end mt-12">
            <!-- Left Side Verification Details -->
            <div class="text-xs text-zinc-600 flex flex-col gap-1.5 border border-zinc-200 p-3 rounded-lg bg-zinc-50 print:bg-white w-72">
                <span class="font-bold border-b pb-1 text-zinc-700">RIWAYAT PERSETUJUAN:</span>
                <span>• Diajukan: {{ \Carbon\Carbon::parse($pe->created_at)->locale('id')->translatedFormat('d M Y, H:i') }} WIB</span>
                <span>• Operator / Sarpras: VERIFIKASI READY ({{ \Carbon\Carbon::parse($pe->updated_at)->locale('id')->translatedFormat('d M Y, H:i') }} WIB)</span>
                <span>• Kepala Sarpras: DISETUJUI & DITANDATANGANI</span>
            </div>

            <!-- Right Side Digital Signature Badge -->
            <div class="flex flex-col items-center justify-center text-center w-64">
                <p class="text-xs font-bold mb-1">Kepala Sarana Prasarana (Sarpras)</p>
                
                <!-- Digital Stamp Container -->
                <div class="relative my-2 p-3 border-2 border-dashed border-emerald-500 rounded-xl bg-emerald-50/50 flex flex-col items-center gap-1.5 print:bg-white w-full">
                    <span class="absolute text-[8px] font-bold text-emerald-600 top-0.5 bg-emerald-100/80 px-1 rounded-sm uppercase tracking-wide">Tanda Tangan Digital Resmi</span>
                    
                    <div id="verify_qr" class="bg-white p-1 rounded-md shadow-sm border border-emerald-200"></div>
                    
                    <span class="text-[9px] font-mono text-zinc-500 max-w-full truncate" title="{{ $pe->digital_signature }}">HASH: {{ substr($pe->digital_signature, 0, 16) }}...</span>
                    <span class="text-[9px] font-bold text-emerald-700">DIVERIFIKASI SISTEM</span>
                </div>
                
                <p class="text-xs font-bold underline">H. Ahmad Dahlan, M.Pd.</p>
                <p class="text-[10px] text-zinc-500">NIP. 19750820 200212 1 002</p>
            </div>
        </div>
    </div>

    <!-- QR Code Generator -->
    <script>
        new QRCode(document.getElementById("verify_qr"), {
            text: "{{ request()->url() }}",
            width: 75,
            height: 75,
            colorDark: "#10b981",
            colorLight: "#ffffff"
        });
    </script>
</body>
</html>

<x-dashboard.main title="Peminjaman Barang">
    <div class="flex flex-col xl:flex-row gap-5">
        @foreach (['jumlah_peminjaman_masuk', 'jumlah_peminjaman_dikonfirmasi', 'jumlah_peminjaman_ditolak', 'jumlah_barang_dikembalikan'] as $item)
            <div onclick="{{ $item . '_modal' }}.showModal()"
                class="
                  {{ $item == 'jumlah_peminjaman_masuk' ? '' : 'flex-col sm:flex-row !items-start sm:items-center gap-5' }}
                  flex {{ $item == 'jumlah_peminjaman_dikonfirmasi' ? 'flex-col sm:flex-row !items-start sm:items-center gap-5' : '' }} 
                  flex {{ $item == 'jumlah_peminjaman_ditolak' ? 'flex-col sm:flex-row !items-start sm:items-center gap-5' : '' }} 
                  flex {{ $item == 'jumlah_barang_dikembalikan' ? 'flex-col sm:flex-row !items-start sm:items-center gap-5' : '' }} items-center justify-between p-5 sm:p-7 bg-white border-back rounded-xl w-full">
                <div>
                    <h1 class="flex items-start gap-3 font-semibold font-[onest] sm:text-lg capitalize">
                        {{ str_replace('_', ' ', $item) }}
                    </h1>
                    <p class="text-sm opacity-60">
                        {{ $item == 'jumlah_peminjaman_masuk' ? 'Jumlah Peminjaman yang masuk.' : '' }}
                        {{ $item == 'jumlah_peminjaman_dikonfirmasi' ? 'Jumlah Peminjaman yang telah dikonfirmasi.' : '' }}
                        {{ $item == 'jumlah_peminjaman_ditolak' ? 'Jumlah Peminjaman yang telah ditolak.' : '' }}
                        {{ $item == 'jumlah_barang_dikembalikan' ? 'Jumlah Barang yang telah dikembalikan.' : '' }}
                    </p>
                </div>
                <h1 class="{{ $item == 'jumlah_peminjaman_masuk' ? '' : 'hidden' }} text-3xl sm:text-4xl font-semibold">
                    {{ $total_peminjaman }}
                </h1>
                <h1
                    class="{{ $item == 'jumlah_peminjaman_dikonfirmasi' ? '' : 'hidden' }} text-3xl sm:text-4xl font-semibold">
                    {{ $total_diterima }}
                </h1>
                <h1
                    class="{{ $item == 'jumlah_peminjaman_ditolak' ? '' : 'hidden' }} text-3xl sm:text-4xl font-semibold">
                    {{ $total_ditolak }}
                </h1>
                <h1
                    class="{{ $item == 'jumlah_barang_dikembalikan' ? '' : 'hidden' }} text-3xl sm:text-4xl font-semibold">
                    {{ $total_dikembalikan }}
                </h1>
            </div>
        @endforeach
    </div>
    <div class="flex flex-col xl:flex-row gap-5">
        @foreach (['ajukan_peminjaman', 'ajukan_peminjaman_scan_kode'] as $i => $item)
            <div onclick="{{ $item . '_modal' }}.showModal();{{ $item == 'ajukan_peminjaman_scan_kode' ? 'initScanner()' : '' }}"
                class="flex items-center justify-between p-5 sm:p-7 hover:shadow-md active:scale-[.97] border border-blue-200 bg-white cursor-pointer border-back rounded-xl w-full">
                <div>
                    <h1 class="flex items-start gap-3 font-semibold font-[onest] sm:text-lg capitalize">
                        {{ str_replace('_', ' ', $item) }}
                    </h1>
                    <p class="text-sm opacity-60 capitalize">
                        @if ($item === 'ajukan_peminjaman')
                            Pengajuan Peminjaman Barang Inventaris
                        @elseif('ajukan_peminjaman_scan_kode')
                            Pengajuan peminjaman dengan scan kamera
                        @else
                            Tombol Tak ada
                        @endif
                    </p>
                </div>
                <x-lucide-circle-arrow-up class="size-5 sm:size-7 opacity-100" />
            </div>
        @endforeach
    </div>
    <div class="flex gap-5">
        @foreach (['manajemen_peminjaman'] as $item)
            <div class="flex flex-col border-back rounded-xl w-full">
                <div class="p-5 sm:p-7 bg-white rounded-t-xl">
                    <h1 class="flex items-start gap-3 font-semibold font-[onest] sm:text-lg capitalize">
                        {{ str_replace('_', ' ', $item) }}
                    </h1>
                    <p class="text-sm opacity-60">Kelola Peminjaman barang dengan cermat dan efektif</p>
                </div>
                <div class="w-full px-5 sm:px-7 bg-zinc-50">
                    <input type="text" id="searchInput" placeholder="Cari data disini...." name="nama_barang"
    class="input input-sm shadow-md w-full bg-zinc-100">
                </div>
                <div class="flex flex-col bg-zinc-50 rounded-b-xl gap-3 divide-y pt-0 p-5 sm:p-7">
                    <div class="overflow-x-auto">
                        <table class="table table-zebra" id="dataTable">
                            <thead>
                                <tr>
                                    @foreach (['no', 'Nama Peminjam', 'Perihal', 'Nama Barang', 'jumlah', 'Ruangan', 'Mata Pelajaran', 'Pengembalian', 'validasi', 'status', 'last update', 'register', 'aksi'] as $item)
                                        <th class="uppercase font-bold">{{ $item }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @if ($peminjaman->isEmpty())
                                    <tr>
                                        <td colspan="13" class="text-center">Tidak ada Peminjaman</td>
                                    </tr>
                                @endif
                                @foreach ($peminjaman as $i => $item)
                                    <tr class="whitespace-nowrap">
                                        <th>{{ $i + 1 }}</th>
                                        <td class="uppercase font-semibold">{{ $item->user->name }}</td>
                                        <td class="uppercase font-semibold">
                                            {{ $item->perihal }}
                                        </td>
                                        <td class="font-semibold">{{ $item->barang->kode }} -
                                            {{ $item->barang->nama }}
                                        </td>
                                        <td class="font-semibold">{{ $item->jumlah }}</td>
                                        <td class="font-semibold capitalize">{{ $item->ruangan ?? '-' }}</td>
                                        <td class="font-semibold capitalize">{{ $item->mata_pelajaran ?? '-' }}</td>
                                        <td class="font-semibold uppercase">
                                            {{ \Carbon\Carbon::parse($item->pengembalian)->locale('id')->translatedFormat('d F Y') }}
                                        </td>
                                        <td>
                                            <span class="badge 
                                                {{ $item->validasi === 'dikonfirmasi' ? 'badge-success text-white' : '' }}
                                                {{ $item->validasi === 'disetujui sarpras' ? 'badge-info text-white' : '' }}
                                                {{ $item->validasi === 'menunggu persetujuan operator' ? 'badge-warning text-white' : '' }}
                                                {{ $item->validasi === 'ditolak' ? 'badge-error text-white' : '' }}
                                                capitalize font-medium">
                                                {{ $item->validasi }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge 
                                                {{ $item->status === 'dipinjam' ? 'badge-primary text-white' : '' }}
                                                {{ $item->status === 'dikembalikan' ? 'badge-success text-white' : '' }}
                                                {{ $item->status === 'menunggu persetujuan operator' ? 'badge-warning text-white' : '' }}
                                                {{ $item->status === 'disetujui sarpras' ? 'badge-info text-white' : '' }}
                                                {{ $item->status === 'ditolak' ? 'badge-error text-white' : '' }}
                                                capitalize font-medium">
                                                {{ $item->status }}
                                            </span>
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($item->updated_at)->locale('id')->translatedFormat('d F Y H:i') }}
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($item->created_at)->locale('id')->translatedFormat('d F Y H:i') }}
                                        </td>
                                        <td>
                                            <div class="flex items-center gap-2">
                                                {{-- 1. Operator / Sarpras Approval --}}
                                                @if (in_array($role, ['admin', 'operator', 'sarpras']) && $item->validasi === 'menunggu persetujuan operator')
                                                    <button
                                                        onclick="document.getElementById('terima_operator_peminjaman_modal_{{ $item->id_peminjaman }}').showModal();"
                                                        class="btn btn-sm btn-info text-white capitalize">Setujui Operator</button>
                                                    <button
                                                        onclick="document.getElementById('tolak_peminjaman_modal_{{ $item->id_peminjaman }}').showModal();"
                                                        class="btn btn-sm btn-outline btn-error capitalize">Tolak</button>
                                                @endif

                                                {{-- 2. Kepala Sarpras Approval --}}
                                                @if (in_array($role, ['admin', 'kepala_sarpras']) && $item->validasi === 'disetujui sarpras')
                                                    <button
                                                        onclick="document.getElementById('terima_kepala_peminjaman_modal_{{ $item->id_peminjaman }}').showModal();"
                                                        class="btn btn-sm btn-success text-white capitalize">ACC Kepala (TTD)</button>
                                                    <button
                                                        onclick="document.getElementById('tolak_peminjaman_modal_{{ $item->id_peminjaman }}').showModal();"
                                                        class="btn btn-sm btn-outline btn-error capitalize">Tolak</button>
                                                @endif

                                                {{-- 3. Return Action (Operator, Sarpras, Admin can verify return) --}}
                                                @if (in_array($role, ['admin', 'operator', 'sarpras']) && $item->validasi === 'dikonfirmasi' && $item->status === 'dipinjam')
                                                    <button
                                                        onclick="document.getElementById('kembalikan_peminjaman_modal_{{ $item->id_peminjaman }}').showModal();"
                                                        class="btn btn-sm btn-emerald text-white capitalize">Terima Kembali</button>
                                                @elseif (in_array($role, ['user', 'guru']) && $item->validasi === 'dikonfirmasi' && $item->status === 'dipinjam')
                                                    <span class="text-sm font-semibold text-emerald-600">Barang Dipinjam</span>
                                                @endif

                                                {{-- 4. Surat Peminjaman (Cetak Surat) for Guru or any role once confirmed --}}
                                                @if ($item->validasi === 'dikonfirmasi')
                                                    <a href="{{ route('cetak_surat_peminjaman', $item->id_peminjaman) }}" target="_blank"
                                                        class="btn btn-sm btn-primary capitalize text-white flex items-center gap-1">
                                                        <x-lucide-printer class="size-4" /> Surat Bukti
                                                    </a>
                                                @endif

                                                {{-- 5. Status indicators --}}
                                                @if ($item->validasi === 'ditolak')
                                                    <span class="badge badge-error text-white capitalize">Ditolak</span>
                                                @elseif ($item->status === 'dikembalikan')
                                                    <span class="badge badge-success text-white capitalize">Selesai</span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-dashboard.main>

@foreach ($peminjaman as $i => $pe)
    @foreach (['terima_operator', 'terima_kepala', 'tolak', 'kembalikan'] as $action)
        @php
            $routeName = $action;
            if ($action === 'tolak' || $action === 'kembalikan') {
                $routeName = $action . '_peminjaman';
            }
        @endphp
        <dialog id="{{ $action }}_peminjaman_modal_{{ $pe->id_peminjaman }}"
            class="modal modal-bottom sm:modal-middle">
            <form action="{{ route($routeName, ['id_peminjaman' => $pe->id_peminjaman]) }}"
                method="POST" class="modal-box">
                @csrf
                @method('PUT')
                <h3 class="modal-title capitalize text-lg font-bold border-b pb-2">
                    Konfirmasi {{ str_replace('_', ' ', $action) }}
                </h3>
                <div class="modal-body py-4">
                    <div class="input-label">
                        <p class="text-gray-600">
                            Anda sedang memproses tindakan <strong class="text-blue-600">{{ str_replace('_', ' ', $action) }}</strong> peminjaman untuk barang 
                            <strong>{{ $pe->barang->kode }} - {{ $pe->barang->nama }}</strong> yang diajukan oleh 
                            <strong>{{ $pe->user->name }}</strong>.
                        </p>
                        <p class="mt-2 text-sm text-gray-500">Apakah Anda yakin ingin melanjutkan tindakan ini?</p>
                    </div>
                </div>
                <div class="modal-action border-t pt-2">
                    <button
                        onclick="document.getElementById('{{ $action }}_peminjaman_modal_{{ $pe->id_peminjaman }}').close();"
                        class="btn btn-outline" type="button">Batal</button>
                    <button type="submit" class="btn btn-primary capitalize text-white">
                        Ya, Lanjutkan
                    </button>
                </div>
            </form>
        </dialog>
    @endforeach
@endforeach

<dialog id="ajukan_peminjaman_modal" class="modal modal-bottom sm:modal-middle">
    <form action="{{ route('ajukan_peminjaman') }}" method="POST" class="modal-box">
        @csrf
        <h3 class="modal-title capitalize">
            Ajukan peminjaman
        </h3>
        <div class="modal-body">
            <div class="input-label">
                <h1 class="label">Nama Peminjam</h1>
                <input required name="nama_pengguna" type="text" value="{{ $user->name }}" readonly>
            </div>
            <div class="input-label">
                <h1 class="label">Perihal</h1>
                <textarea required class="block p-2.5 w-full text-sm rounded-lg border border-gray-300" name="perihal" rows="4"></textarea>
            </div>
            <div class="input-label">
                <h1 class="label">Barang yang akan dipinjam</h1>
                <select required class="uppercase select select-sm" name="id_barang">
                    @foreach ($barang as $b)
                        <option value="{{ $b->id_barang }}">{{ $b->kode . '-' . $b->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="input-label">
                <h1 class="label">Ruangan (Opsional)</h1>
                <input name="ruangan" type="text" placeholder="Contoh: Lab Komputer 1 / Ruang Kelas VII-A" class="input input-sm shadow-md w-full bg-zinc-100">
            </div>
            <div class="input-label">
                <h1 class="label">Mata Pelajaran (Opsional)</h1>
                <input name="mata_pelajaran" type="text" placeholder="Contoh: Matematika / Informatika" class="input input-sm shadow-md w-full bg-zinc-100">
            </div>
            <div class="input-label">
                <h1 class="label">Jumlah Barang yang dipinjam</h1>
                <input required name="jumlah" type="number">
                @error('jumlah')
                    <span class="validated">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-label">
                <h1 class="label">Tanggal Barang akan dikembalikan</h1>
                <input required name="pengembalian" type="date">
                @error('pengembalian')
                    <span class="validated">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="modal-action">
            <button type="button" class="btn" onclick="ajukan_peminjaman_modal.close()">Tutup</button>
            <button type="submit" class="btn btn-secondary capitalize">Ajukan</button>
        </div>
    </form>
</dialog>

<dialog id="detail_barang_modal" class="modal modal-bottom sm:modal-middle">
    <div class="modal-box p-6 rounded-lg shadow-lg bg-base-200">
        <h3 class="modal-title text-lg font-semibold capitalize mb-4" id="dtb_nama_header"></h3>
        <div class="modal-body">
            @foreach (['dtb_kode_barang', 'dtb_nama_barang', 'dtb_satuan_barang', 'dtb_barang_didaftar', 'dtb_barang_diupdate'] as $item)
                <div class="mb-4">
                    <h1 class="font-bold text-sm capitalize text-gray-600">
                        {{ explode('dtb', str_replace('_', ' ', $item))[1] }}
                    </h1>
                    <h1 id="{{ $item }}" class="text-lg font-medium text-gray-800"></h1>
                </div>
            @endforeach
        </div>
        <form id="pinjam_form" action="{{ route('ajukan_peminjaman_qr', ':id_barang') }}" method="POST"
            class="mt-4">
            @csrf
            <div class="input-label">
                <h1 class="label">Perihal</h1>
                <input type="text" name="perihal"
                    class="block p-2.5 w-full text-sm rounded-lg border border-gray-300" required>
            </div>
            <div class="input-label">
                <h1 class="label">Ruangan (Opsional)</h1>
                <input type="text" name="ruangan"
                    class="block p-2.5 w-full text-sm rounded-lg border border-gray-300" placeholder="Contoh: Lab Komputer 1">
            </div>
            <div class="input-label">
                <h1 class="label">Mata Pelajaran (Opsional)</h1>
                <input type="text" name="mata_pelajaran"
                    class="block p-2.5 w-full text-sm rounded-lg border border-gray-300" placeholder="Contoh: Informatika">
            </div>
            <div class="input-label">
                <h1 class="label">Jumlah</h1>
                <input type="number" name="jumlah" min="1" required class="mt-2 w-full"
                    placeholder="Jumlah">
            </div>
            <div class="input-label">
                <h1 class="label">Tanggal Pengembalian</h1>
                <input type="date" name="pengembalian" required class="mt-2 w-full"
                    placeholder="Tanggal Pengembalian">
            </div>
            <input type="hidden" name="id_barang" id="id_barang_input">
            <button type="submit" id="pinjamButton"
                class="btn btn-primary w-full mt-4 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg shadow-lg transition-transform transform hover:scale-105 active:scale-95 hover:shadow-xl">
                Pinjam
            </button>

        </form>

        <form method="dialog" class="mt-4">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>
    </div>
</dialog>

<script>
    let dataz = {!! json_encode($barang) !!};
    let s = 0;
    let e = 0;

    setInterval(() => {
        s = 1;
        e = 1;
    }, 1000);

    var scanner = new QrScanner(el('bc_scanner'), scan => {
        let scannedCode = parseQrData(scan.data);
        let data = dataz.find(y => y.kode == scannedCode);

        el('bc_scanner_output').innerText = scannedCode;
        el('bc_scanner_output').classList.remove('text-red-500');

        if (data) {
            if (s) {
                s = 0;
                createjs.Sound.play('ding');
            }
            stopScanner();

            // Set the modal content
            el('dtb_nama_header').innerText = data.nama;
            el('dtb_kode_barang').innerText = data.kode;
            el('dtb_nama_barang').innerText = data.nama;
            el('dtb_satuan_barang').innerText = data.satuan;
            el('dtb_barang_didaftar').innerText = dayjs(data.created_at).format('HH:mm:ss DD/MM/YYYY');
            el('dtb_barang_diupdate').innerText = dayjs(data.updated_at).format('HH:mm:ss DD/MM/YYYY');

            // Set the hidden input for the form
            el('id_barang_input').value = data.id_barang;

            el('detail_barang_modal').showModal();
            el('scan_kode_barang_modal').close();
        } else {
            el('bc_scanner_output').innerText = 'Tidak dapat menemukan barang.';
            el('bc_scanner_output').classList.add('text-red-500');
            if (e) {
                e = 0;
                createjs.Sound.play('error');
            }
        }
    }, {
        highlightScanRegion: true,
        highlightCodeOutline: true,
    });

    stopScanner();

    function initScanner() {
        scanner.start();
    }

    function stopScanner() {
        s = 0;
        e = 0;
        scanner.stop();
        el('bc_scanner_output').innerText = '';
    }

    document.getElementById('pinjam_form').addEventListener('submit', function(event) {
        event.preventDefault();

        const id_barang = document.getElementById('id_barang_input').value;
        this.action = this.action.replace(':id_barang', id_barang);

        const formData = new FormData(this);

        const modal = document.getElementById('detail_barang_modal');
        modal.close();

        fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
            })
            .then(response => {
                if (response.ok) {
                    return response.json();
                } else if (response.status === 422) {
                    return response.json().then(data => {
                        const errors = data.errors;
                        let errorMessage = '';
                        for (const key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                errorMessage += `${errors[key].join(', ')}\n`;
                            }
                        }
                        throw new Error(errorMessage);
                    });
                }
                throw new Error('Network response was not ok.');
            })
            .then(data => {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: data.message,
                    confirmButtonText: 'OK',
                }).then(() => {
                    this.reset();
                    window.location.href =
                        '{{ route('kelola_peminjaman') }}';
                });
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: error.message || 'Terjadi kesalahan. Silakan coba lagi.',
                    confirmButtonText: 'OK',
                });
            });
    });
</script>
